<?php
$active_tab = 'downloads';
require_once __DIR__ . '/header.php';

$pdo = get_pdo();

// Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM downloads WHERE id = ?")->execute([$id]);
    header("Location: " . BASE_URL . "/admin/downloads.php?deleted=1");
    exit;
}

// Add Resource
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        die("Security error.");
    }
    $title = trim($_POST['title'] ?? '');
    $category = trim($_POST['category'] ?? 'General');
    $description = trim($_POST['description'] ?? '');
    $file_type = trim($_POST['file_type'] ?? 'PDF');
    $file_size = trim($_POST['file_size'] ?? '1.2 MB');
    $sort_order = (int)($_POST['sort_order'] ?? 0);

    if (!empty($title)) {
        $stmt = $pdo->prepare("INSERT INTO downloads (title, category, description, file_type, file_size, sort_order) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->execute([$title, $category, $description, $file_type, $file_size, $sort_order]);
        header("Location: " . BASE_URL . "/admin/downloads.php?saved=1");
        exit;
    }
}

$downloads = $pdo->query("SELECT * FROM downloads ORDER BY sort_order ASC, id DESC")->fetchAll();
?>

<div class="container" style="padding-top: 35px; padding-bottom: 50px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px;">
        <div>
            <h1 style="font-size: 1.85rem; color: var(--primary);">Downloads &amp; Legal Guides Manager</h1>
            <p style="color: var(--text-muted); font-size: 0.92rem;">Control client resource guides, checklists, and statutory forms.</p>
        </div>
        <a href="<?= BASE_URL ?>/downloads.php" target="_blank" class="btn btn-navy btn-sm">
            <i class="fa fa-eye"></i> View Live Downloads Page
        </a>
    </div>

    <?php if (isset($_GET['saved'])): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Resource guide added successfully!</div>
    <?php endif; ?>
    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Resource guide removed.</div>
    <?php endif; ?>

    <!-- Add Resource Card -->
    <div class="admin-card" style="border-left: 4px solid var(--accent);">
        <h2>Add Downloadable Resource</h2>
        <form action="<?= BASE_URL ?>/admin/downloads.php" method="POST">
            <?= csrf_field() ?>
            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Document Title *</label>
                    <input type="text" name="title" class="form-control" placeholder="e.g. Patent Filing Provisional Checklist" required>
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Category</label>
                    <select name="category" class="form-control">
                        <option value="Trademark">Trademark</option>
                        <option value="Patent">Patent</option>
                        <option value="Copyright">Copyright</option>
                        <option value="Design">Industrial Design</option>
                        <option value="ISO">ISO Certification</option>
                        <option value="General">General Legal</option>
                    </select>
                </div>
            </div>

            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">File Type</label>
                    <input type="text" name="file_type" class="form-control" value="PDF">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">File Size Display</label>
                    <input type="text" name="file_size" class="form-control" value="1.5 MB">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="0">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-size:0.84rem; font-weight:700;">Brief Summary / Description</label>
                <textarea name="description" class="form-control" rows="2" placeholder="Brief outline of what this form/checklist covers..."></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Add Resource Guide
            </button>
        </form>
    </div>

    <!-- Active Downloads Table -->
    <div class="admin-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Document Title</th>
                    <th>Category</th>
                    <th>Format &amp; Size</th>
                    <th>Summary</th>
                    <th style="width: 100px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($downloads as $d): ?>
                    <tr>
                        <td><strong><?= e($d['title']) ?></strong></td>
                        <td>
                            <span style="display:inline-block; padding:3px 8px; border-radius:4px; background:var(--accent-soft); color:var(--accent-hover); font-weight:700; font-size:0.8rem;">
                                <?= e($d['category']) ?>
                            </span>
                        </td>
                        <td><?= e($d['file_type']) ?> &bull; <?= e($d['file_size']) ?></td>
                        <td style="font-size:0.86rem; color:var(--text-muted); max-width:320px;">
                            <?= e($d['description']) ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/downloads.php?delete=<?= $d['id'] ?>" onclick="return confirm('Delete this download resource?')" style="color:#ef4444;">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
