<?php
$active_tab = 'applications';
require_once __DIR__ . '/header.php';

$pdo = get_pdo();

// Delete action
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $stmt = $pdo->prepare("SELECT resume_path FROM job_applications WHERE id = ?");
    $stmt->execute([$id]);
    $filePath = $stmt->fetchColumn();
    if ($filePath && file_exists(__DIR__ . '/../' . $filePath)) {
        unlink(__DIR__ . '/../' . $filePath);
    }
    $pdo->prepare("DELETE FROM job_applications WHERE id = ?")->execute([$id]);
    header("Location: " . BASE_URL . "/admin/applications.php");
    exit;
}

$applications = $pdo->query("SELECT * FROM job_applications ORDER BY id DESC")->fetchAll();
?>

<div class="container" style="padding-top: 40px; padding-bottom: 40px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 24px;">
        <div>
            <h1 style="font-size: 2rem; color: var(--primary);">Career Job Applications</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Review legal candidate submissions, qualifications, and downloadable resumes.</p>
        </div>
    </div>

    <?php if (empty($applications)): ?>
        <div style="background:#ffffff; border-radius:var(--radius-lg); padding:40px; text-align:center; border:1px solid var(--border-color);">
            <p style="color:var(--text-muted); font-size:1.1rem; margin:0;">No candidate applications received yet.</p>
        </div>
    <?php else: ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Candidate</th>
                    <th>Position Applied</th>
                    <th>Experience</th>
                    <th>Cover Note</th>
                    <th>Resume</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($applications as $app): ?>
                    <tr>
                        <td><?= date('d M Y', strtotime($app['applied_at'])) ?></td>
                        <td>
                            <strong><?= e($app['name']) ?></strong><br>
                            <i class="fa fa-phone"></i> <?= e($app['phone']) ?><br>
                            <i class="fa fa-envelope-o"></i> <a href="mailto:<?= e($app['email']) ?>"><?= e($app['email']) ?></a>
                        </td>
                        <td>
                            <strong style="color:var(--primary); font-size:0.92rem;"><?= e($app['job_title'] ?: 'General Application') ?></strong>
                        </td>
                        <td><?= e($app['experience_years'] ?: 'Not stated') ?></td>
                        <td style="max-width: 280px; font-size:0.86rem; color:#475569;">
                            <?= nl2br(e($app['cover_note'])) ?>
                        </td>
                        <td>
                            <?php if (!empty($app['resume_path']) && file_exists(__DIR__ . '/../' . $app['resume_path'])): ?>
                                <a href="<?= BASE_URL ?>/<?= e($app['resume_path']) ?>" target="_blank" class="btn btn-navy btn-sm" style="padding:4px 10px; font-size:0.8rem;">
                                    <i class="fa fa-file-text-o"></i> Download CV
                                </a>
                            <?php else: ?>
                                <span style="color:var(--text-muted); font-size:0.82rem;">No file</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/applications.php?delete=<?= $app['id'] ?>" onclick="return confirm('Delete this applicant record?')" style="color:#ef4444; font-size:0.85rem;">
                                <i class="fa fa-trash"></i> Delete
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
