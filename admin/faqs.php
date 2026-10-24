<?php
$active_tab = 'faqs';
require_once __DIR__ . '/header.php';

$pdo = get_pdo();

// Handle Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM faqs WHERE id = ?")->execute([$id]);
    header("Location: " . BASE_URL . "/admin/faqs.php?deleted=1");
    exit;
}

// Handle Add / Edit
$edit_id = (int)($_GET['edit'] ?? 0);
$edit_faq = null;
if ($edit_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM faqs WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_faq = $stmt->fetch();
}

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        $msg = ['type' => 'danger', 'text' => 'Security token invalid.'];
    } else {
        $practice_slug = trim($_POST['practice_slug'] ?? 'trademark');
        $question = trim($_POST['question'] ?? '');
        $answer = trim($_POST['answer'] ?? '');
        $sort_order = (int)($_POST['sort_order'] ?? 0);

        if (empty($question) || empty($answer)) {
            $msg = ['type' => 'danger', 'text' => 'Both question and answer are required.'];
        } else {
            if ($edit_id > 0) {
                $stmt = $pdo->prepare("UPDATE faqs SET practice_slug = ?, question = ?, answer = ?, sort_order = ? WHERE id = ?");
                $stmt->execute([$practice_slug, $question, $answer, $sort_order, $edit_id]);
                header("Location: " . BASE_URL . "/admin/faqs.php?saved=1");
                exit;
            } else {
                $stmt = $pdo->prepare("INSERT INTO faqs (practice_slug, question, answer, sort_order) VALUES (?, ?, ?, ?)");
                $stmt->execute([$practice_slug, $question, $answer, $sort_order]);
                header("Location: " . BASE_URL . "/admin/faqs.php?saved=1");
                exit;
            }
        }
    }
}

// Filter by practice
$filter_slug = $_GET['filter'] ?? 'all';
$query = "SELECT * FROM faqs ";
if ($filter_slug !== 'all') {
    $query .= " WHERE practice_slug = " . $pdo->quote($filter_slug);
}
$query .= " ORDER BY practice_slug ASC, sort_order ASC, id ASC";
$faqs = $pdo->query($query)->fetchAll();

// Get unique practices with FAQs
$practices = $pdo->query("SELECT slug, title FROM practices ORDER BY sort_order ASC")->fetchAll();
?>

<div class="container" style="padding-top: 35px; padding-bottom: 50px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px;">
        <div>
            <h1 style="font-size: 1.85rem; color: var(--primary);">Frequently Asked Questions (FAQs) Manager</h1>
            <p style="color: var(--text-muted); font-size: 0.92rem;">Add, update, and manage legal FAQ accordions across practice areas.</p>
        </div>
    </div>

    <?php if (isset($_GET['saved'])): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> FAQ entry saved successfully!</div>
    <?php endif; ?>
    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> FAQ entry deleted.</div>
    <?php endif; ?>

    <!-- FAQ Add/Edit Form Card -->
    <div class="admin-card" style="border-left: 4px solid var(--accent);">
        <h2><?= $edit_faq ? 'Edit FAQ Item' : 'Add New FAQ Item' ?></h2>
        <form action="<?= BASE_URL ?>/admin/faqs.php<?= $edit_id > 0 ? '?edit='.$edit_id : '' ?>" method="POST">
            <?= csrf_field() ?>
            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Practice Area *</label>
                    <select name="practice_slug" class="form-control" required>
                        <?php foreach ($practices as $p): ?>
                            <option value="<?= e($p['slug']) ?>" <?= (($edit_faq['practice_slug'] ?? '') === $p['slug']) ? 'selected' : '' ?>>
                                <?= e($p['title']) ?> (<?= e($p['slug']) ?>)
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= e($edit_faq['sort_order'] ?? '0') ?>">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 16px;">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Question *</label>
                <input type="text" name="question" class="form-control" value="<?= e($edit_faq['question'] ?? '') ?>" placeholder="e.g. What is the validity period of a registered trademark?" required>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Answer *</label>
                <textarea name="answer" class="form-control" rows="4" placeholder="Detailed legal answer..." required><?= e($edit_faq['answer'] ?? '') ?></textarea>
            </div>

            <div style="display:flex; gap:12px;">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-save"></i> <?= $edit_faq ? 'Update FAQ' : 'Add FAQ' ?>
                </button>
                <?php if ($edit_faq): ?>
                    <a href="<?= BASE_URL ?>/admin/faqs.php" class="btn btn-outline btn-sm">Cancel Edit</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Filter Bar -->
    <div style="margin-bottom: 18px; display:flex; align-items:center; gap:10px; flex-wrap:wrap;">
        <span style="font-size:0.88rem; font-weight:700; color:var(--primary);">Filter by Practice:</span>
        <a href="<?= BASE_URL ?>/admin/faqs.php?filter=all" class="btn btn-sm <?= $filter_slug === 'all' ? 'btn-navy' : 'btn-outline' ?>" style="padding:4px 12px;">All (<?= count($faqs) ?>)</a>
        <?php foreach ($practices as $p): ?>
            <a href="<?= BASE_URL ?>/admin/faqs.php?filter=<?= e($p['slug']) ?>" class="btn btn-sm <?= $filter_slug === $p['slug'] ? 'btn-navy' : 'btn-outline' ?>" style="padding:4px 12px;">
                <?= e($p['title']) ?>
            </a>
        <?php endforeach; ?>
    </div>

    <!-- FAQs Table -->
    <div class="admin-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 140px;">Practice</th>
                    <th>Question</th>
                    <th>Answer Snippet</th>
                    <th style="width: 80px;">Order</th>
                    <th style="width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($faqs as $f): ?>
                    <tr>
                        <td>
                            <span style="display:inline-block; padding:3px 8px; border-radius:4px; background:var(--accent-soft); color:var(--accent-hover); font-weight:700; font-size:0.8rem;">
                                <?= ucfirst(e($f['practice_slug'])) ?>
                            </span>
                        </td>
                        <td>
                            <strong style="color:var(--primary); font-size:0.92rem;"><?= e($f['question']) ?></strong>
                        </td>
                        <td style="color:var(--text-muted); font-size:0.85rem; max-width:380px;">
                            <?= e(mb_strimwidth($f['answer'], 0, 140, '...')) ?>
                        </td>
                        <td style="text-align:center; font-weight:700; color:#64748b;">
                            <?= e($f['sort_order']) ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/faqs.php?edit=<?= $f['id'] ?>" class="btn btn-outline btn-sm" style="padding:3px 8px; font-size:0.78rem;">
                                Edit
                            </a>
                            <a href="<?= BASE_URL ?>/admin/faqs.php?delete=<?= $f['id'] ?>" onclick="return confirm('Delete this FAQ?')" style="color:#ef4444; font-size:0.82rem; margin-left:6px;">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
