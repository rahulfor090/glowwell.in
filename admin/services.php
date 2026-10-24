<?php
$active_tab = 'services';
require_once __DIR__ . '/header.php';

$pdo = get_pdo();

// Delete action
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM practices WHERE id = ?")->execute([$id]);
    header("Location: " . BASE_URL . "/admin/services.php?deleted=1");
    exit;
}

// Toggle status (published / draft)
if (isset($_GET['toggle_status'])) {
    $id = (int)$_GET['toggle_status'];
    $stmt = $pdo->prepare("SELECT status FROM practices WHERE id = ?");
    $stmt->execute([$id]);
    $current = $stmt->fetchColumn();
    if ($current !== false) {
        $new_status = ($current === 'published') ? 'draft' : 'published';
        $pdo->prepare("UPDATE practices SET status = ? WHERE id = ?")->execute([$new_status, $id]);
    }
    header("Location: " . BASE_URL . "/admin/services.php?toggled=1");
    exit;
}

$practices = $pdo->query("SELECT * FROM practices ORDER BY sort_order ASC, id ASC")->fetchAll();
?>

<div class="container" style="padding-top: 35px; padding-bottom: 50px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px;">
        <div>
            <h1 style="font-size: 1.85rem; color: var(--primary);">Practice Areas &amp; Services Manager</h1>
            <p style="color: var(--text-muted); font-size: 0.92rem;">Control all services shown on the homepage grid and services menu. Click on any status button to toggle visibility.</p>
        </div>
        <a href="<?= BASE_URL ?>/admin/service-edit.php" class="btn btn-primary btn-sm">
            <i class="fa fa-plus"></i> Add New Practice
        </a>
    </div>

    <?php if (isset($_GET['saved'])): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Practice area successfully saved!</div>
    <?php endif; ?>

    <?php if (isset($_GET['toggled'])): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Service visibility status successfully updated!</div>
    <?php endif; ?>

    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Practice area removed.</div>
    <?php endif; ?>

    <div class="admin-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 50px;">Sort</th>
                    <th style="width: 60px;">Icon</th>
                    <th>Practice Title</th>
                    <th>Slug / URL</th>
                    <th>Short Description</th>
                    <th>Status</th>
                    <th style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($practices as $p): ?>
                    <tr>
                        <td style="font-weight:700; color:var(--text-muted); text-align:center;">
                            <?= e($p['sort_order']) ?>
                        </td>
                        <td style="text-align:center;">
                            <i class="fa <?= e($p['icon'] ?? 'fa-gavel') ?>" style="font-size:1.4rem; color:var(--accent);"></i>
                        </td>
                        <td>
                            <strong style="color:var(--primary); font-size:1rem;"><?= e($p['title']) ?></strong>
                        </td>
                        <td>
                            <code><?= e($p['slug']) ?>.php</code>
                        </td>
                        <td style="max-width:320px; font-size:0.86rem; color:var(--text-muted);">
                            <?= e($p['short_description']) ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/services.php?toggle_status=<?= $p['id'] ?>" class="btn btn-sm" style="display:inline-flex; align-items:center; gap:5px; padding:3px 9px; font-size:0.78rem; text-decoration:none; border-radius:4px; font-weight:700; background: <?= $p['status'] === 'published' ? '#dcfce7; color:#15803d; border:1px solid #86efac;' : '#f1f5f9; color:#64748b; border:1px solid #cbd5e1;' ?>;" title="Click to Toggle Visibility (Published / Draft)">
                                <i class="fa <?= $p['status'] === 'published' ? 'fa-eye' : 'fa-eye-slash' ?>"></i> <?= ucfirst(e($p['status'])) ?>
                            </a>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/service-edit.php?id=<?= $p['id'] ?>" class="btn btn-outline btn-sm" style="padding:3px 10px; font-size:0.8rem; margin-right:4px;">
                                <i class="fa fa-pencil"></i> Edit
                            </a>
                            <a href="<?= BASE_URL ?>/admin/services.php?delete=<?= $p['id'] ?>" onclick="return confirm('Are you sure you want to delete this practice?')" style="color:#ef4444; font-size:0.82rem;">
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
