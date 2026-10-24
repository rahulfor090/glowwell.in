<?php
$active_tab = 'enquiries';
require_once __DIR__ . '/header.php';

$pdo = get_pdo();

// Mark as read action
if (isset($_GET['mark_read'])) {
    $id = (int)$_GET['mark_read'];
    $pdo->prepare("UPDATE contact_messages SET is_read = 1 WHERE id = ?")->execute([$id]);
    header("Location: " . BASE_URL . "/admin/enquiries.php");
    exit;
}

// Delete action
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM contact_messages WHERE id = ?")->execute([$id]);
    header("Location: " . BASE_URL . "/admin/enquiries.php");
    exit;
}

$enquiries = $pdo->query("SELECT * FROM contact_messages ORDER BY id DESC")->fetchAll();
?>

<div class="container" style="padding-top: 40px; padding-bottom: 40px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 24px;">
        <div>
            <h1 style="font-size: 2rem; color: var(--primary);">Client Consultation Inquiries</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">All incoming website consultation requests, brand searches, and messages.</p>
        </div>
    </div>

    <?php if (empty($enquiries)): ?>
        <div style="background:#ffffff; border-radius:var(--radius-lg); padding:40px; text-align:center; border:1px solid var(--border-color);">
            <p style="color:var(--text-muted); font-size:1.1rem; margin:0;">No inquiries in the system yet.</p>
        </div>
    <?php else: ?>
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 140px;">Received</th>
                    <th>Client / Company</th>
                    <th>Contact Details</th>
                    <th>Practice / Requirement</th>
                    <th>Message Details</th>
                    <th>Status</th>
                    <th style="width: 120px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($enquiries as $row): ?>
                    <tr style="<?= $row['is_read'] ? '' : 'background: #fffbeb;' ?>">
                        <td>
                            <strong style="font-size:0.85rem;"><?= date('d M Y', strtotime($row['created_at'])) ?></strong><br>
                            <span style="font-size:0.78rem; color:var(--text-muted);"><?= date('h:i A', strtotime($row['created_at'])) ?></span>
                        </td>
                        <td>
                            <strong><?= e($row['name']) ?></strong><br>
                            <span style="font-size:0.82rem; color:var(--text-muted);"><?= e($row['company'] ?: 'Individual / Startup') ?></span>
                        </td>
                        <td>
                            <div><i class="fa fa-phone text-gold"></i> <?= e($row['phone']) ?></div>
                            <div>
                                <a href="https://wa.me/<?= preg_replace('/[^0-9]/', '', $row['whatsapp'] ?: $row['phone']) ?>" target="_blank" style="color:#16a34a; font-weight:600; font-size:0.82rem;">
                                    <i class="fa fa-whatsapp"></i> Chat on WhatsApp
                                </a>
                            </div>
                            <div style="font-size:0.82rem;"><i class="fa fa-envelope-o"></i> <a href="mailto:<?= e($row['email']) ?>"><?= e($row['email']) ?></a></div>
                        </td>
                        <td>
                            <span style="display:inline-block; padding:3px 10px; border-radius:4px; background:var(--accent-soft); color:var(--accent-hover); font-weight:700; font-size:0.82rem;">
                                <?= e($row['service_interest'] ?: 'General Legal') ?>
                            </span><br>
                            <span style="font-size:0.82rem; color:var(--primary); font-weight:600;"><?= e($row['subject']) ?></span>
                        </td>
                        <td style="max-width: 320px;">
                            <div style="font-size:0.88rem; color:#334155; line-height:1.5;">
                                <?= nl2br(e($row['message'])) ?>
                            </div>
                        </td>
                        <td>
                            <?php if ($row['is_read']): ?>
                                <span style="color:#16a34a; font-weight:700; font-size:0.82rem;"><i class="fa fa-check"></i> Reviewed</span>
                            <?php else: ?>
                                <span style="color:#dc2626; font-weight:700; font-size:0.82rem;"><i class="fa fa-circle"></i> New</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <div style="display:flex; flex-direction:column; gap:6px;">
                                <?php if (!$row['is_read']): ?>
                                    <a href="<?= BASE_URL ?>/admin/enquiries.php?mark_read=<?= $row['id'] ?>" class="btn btn-outline btn-sm" style="padding:3px 8px; font-size:0.78rem;">
                                        Mark Read
                                    </a>
                                <?php endif; ?>
                                <a href="<?= BASE_URL ?>/admin/enquiries.php?delete=<?= $row['id'] ?>" onclick="return confirm('Delete this inquiry?')" style="color:#ef4444; font-size:0.82rem; text-align:center;">
                                    <i class="fa fa-trash"></i> Delete
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
