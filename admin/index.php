<?php
$active_tab = 'dashboard';
require_once __DIR__ . '/header.php';

$pdo = get_pdo();

// Stats
$total_enquiries = $pdo->query("SELECT COUNT(*) FROM contact_messages")->fetchColumn();
$unread_enquiries = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE is_read = 0")->fetchColumn();
$total_apps = $pdo->query("SELECT COUNT(*) FROM job_applications")->fetchColumn();
$new_apps = $pdo->query("SELECT COUNT(*) FROM job_applications WHERE status = 'new'")->fetchColumn();

// Recent 5 inquiries
$recent_enquiries = $pdo->query("SELECT * FROM contact_messages ORDER BY id DESC LIMIT 5")->fetchAll();
?>

<div class="container" style="padding-top: 40px; padding-bottom: 40px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 30px;">
        <div>
            <h1 style="font-size: 2rem; color: var(--primary);">Management Dashboard</h1>
            <p style="color: var(--text-muted); font-size: 0.95rem;">Real-time consultation inquiries, client requests, and talent applications.</p>
        </div>
        <a href="<?= BASE_URL ?>/index.php" target="_blank" class="btn btn-outline btn-sm">
            <i class="fa fa-external-link"></i> View Live Site
        </a>
    </div>

    <!-- Metrics Cards -->
    <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 20px; margin-bottom: 40px;">
        <div style="background:#ffffff; border-radius:var(--radius-md); padding:24px; border:1px solid var(--border-color); box-shadow:var(--shadow-sm);">
            <span style="font-size:0.82rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Total Inquiries</span>
            <div style="font-size:2.4rem; font-weight:800; color:var(--primary); font-family:var(--font-serif); margin-top:6px;">
                <?= $total_enquiries ?>
            </div>
            <a href="<?= BASE_URL ?>/admin/enquiries.php" style="font-size:0.85rem; color:var(--accent); font-weight:600;">View Inquiries &rarr;</a>
        </div>

        <div style="background:#ffffff; border-radius:var(--radius-md); padding:24px; border:1px solid var(--border-color); box-shadow:var(--shadow-sm);">
            <span style="font-size:0.82rem; font-weight:700; color:#ef4444; text-transform:uppercase;">Unread Messages</span>
            <div style="font-size:2.4rem; font-weight:800; color:#ef4444; font-family:var(--font-serif); margin-top:6px;">
                <?= $unread_enquiries ?>
            </div>
            <span style="font-size:0.85rem; color:var(--text-muted);">Requires follow-up</span>
        </div>

        <div style="background:#ffffff; border-radius:var(--radius-md); padding:24px; border:1px solid var(--border-color); box-shadow:var(--shadow-sm);">
            <span style="font-size:0.82rem; font-weight:700; color:var(--text-muted); text-transform:uppercase;">Job Applications</span>
            <div style="font-size:2.4rem; font-weight:800; color:var(--primary); font-family:var(--font-serif); margin-top:6px;">
                <?= $total_apps ?>
            </div>
            <a href="<?= BASE_URL ?>/admin/applications.php" style="font-size:0.85rem; color:var(--accent); font-weight:600;">View Resumes &rarr;</a>
        </div>

        <div style="background:#ffffff; border-radius:var(--radius-md); padding:24px; border:1px solid var(--border-color); box-shadow:var(--shadow-sm);">
            <span style="font-size:0.82rem; font-weight:700; color:var(--accent-hover); text-transform:uppercase;">New Applicants</span>
            <div style="font-size:2.4rem; font-weight:800; color:var(--accent-hover); font-family:var(--font-serif); margin-top:6px;">
                <?= $new_apps ?>
            </div>
            <span style="font-size:0.85rem; color:var(--text-muted);">Awaiting screening</span>
        </div>
    </div>

    <!-- Recent Inquiries Table -->
    <div style="background:#ffffff; border-radius:var(--radius-lg); border:1px solid var(--border-color); padding:30px; box-shadow:var(--shadow-sm);">
        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px;">
            <h2 style="font-size:1.4rem; color:var(--primary);">Recent Client Consultations</h2>
            <a href="<?= BASE_URL ?>/admin/enquiries.php" class="btn btn-outline btn-sm">View All Inquiries</a>
        </div>

        <?php if (empty($recent_enquiries)): ?>
            <p style="color:var(--text-muted); margin:0;">No inquiries received yet. Submit a test form on the homepage!</p>
        <?php else: ?>
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Client Name</th>
                        <th>Contact</th>
                        <th>Service Required</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recent_enquiries as $row): ?>
                        <tr>
                            <td><?= date('d M Y, H:i', strtotime($row['created_at'])) ?></td>
                            <td>
                                <strong><?= e($row['name']) ?></strong><br>
                                <span style="font-size:0.82rem; color:var(--text-muted);"><?= e($row['company'] ?: 'Individual') ?></span>
                            </td>
                            <td>
                                <i class="fa fa-phone"></i> <?= e($row['phone']) ?><br>
                                <i class="fa fa-envelope-o"></i> <a href="mailto:<?= e($row['email']) ?>"><?= e($row['email']) ?></a>
                            </td>
                            <td>
                                <span style="display:inline-block; padding:3px 10px; border-radius:4px; background:var(--accent-soft); color:var(--accent-hover); font-weight:700; font-size:0.82rem;">
                                    <?= e($row['service_interest'] ?: 'General') ?>
                                </span>
                            </td>
                            <td>
                                <span style="color: <?= $row['is_read'] ? '#10b981' : '#ef4444' ?>; font-weight:700;">
                                    <?= $row['is_read'] ? 'Reviewed' : 'New' ?>
                                </span>
                            </td>
                            <td>
                                <a href="<?= BASE_URL ?>/admin/enquiries.php" class="btn btn-navy btn-sm" style="padding:4px 10px; font-size:0.8rem;">
                                    View
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        <?php endif; ?>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
