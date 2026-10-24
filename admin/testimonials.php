<?php
$active_tab = 'testimonials';
require_once __DIR__ . '/header.php';

$pdo = get_pdo();

// Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM testimonials WHERE id = ?")->execute([$id]);
    header("Location: " . BASE_URL . "/admin/testimonials.php?deleted=1");
    exit;
}

// Toggle Homepage Visibility
if (isset($_GET['toggle_visibility'])) {
    $current = get_setting('show_testimonials', '0');
    $new_val = ($current === '1') ? '0' : '1';
    $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES ('show_testimonials', ?) ON DUPLICATE KEY UPDATE setting_value = ?");
    $stmt->execute([$new_val, $new_val]);
    header("Location: " . BASE_URL . "/admin/testimonials.php?visibility_updated=1");
    exit;
}

// Add
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        die("Security error.");
    }
    $name = trim($_POST['client_name'] ?? '');
    $role = trim($_POST['client_role'] ?? '');
    $company = trim($_POST['company'] ?? '');
    $rating = (int)($_POST['rating'] ?? 5);
    $feedback = trim($_POST['feedback'] ?? '');
    $sort_order = (int)($_POST['sort_order'] ?? 0);

    if (!empty($name) && !empty($feedback)) {
        $stmt = $pdo->prepare("INSERT INTO testimonials (client_name, client_role, company, rating, feedback, sort_order, status) VALUES (?, ?, ?, ?, ?, ?, 'published')");
        $stmt->execute([$name, $role, $company, $rating, $feedback, $sort_order]);
        header("Location: " . BASE_URL . "/admin/testimonials.php?saved=1");
        exit;
    }
}

$testimonials = $pdo->query("SELECT * FROM testimonials ORDER BY sort_order ASC, id ASC")->fetchAll();
?>

<div class="container" style="padding-top: 35px; padding-bottom: 50px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px;">
        <div>
            <h1 style="font-size: 1.85rem; color: var(--primary);">Client Testimonials Manager</h1>
            <p style="color: var(--text-muted); font-size: 0.92rem;">Control client reviews and ratings displayed on the homepage.</p>
        </div>
    </div>

    <!-- Status / Visibility Toggle Banner -->
    <div style="background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 16px 20px; margin-bottom: 24px; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 14px;">
        <div>
            <strong style="color: var(--primary); font-size: 0.95rem;">Homepage Status:</strong>
            <?php if (get_setting('show_testimonials', '0') === '1'): ?>
                <span style="background: #16a34a; color: white; padding: 4px 10px; border-radius: 12px; font-size: 0.8rem; font-weight:700; margin-left: 6px;"><i class="fa fa-eye"></i> Visible on Homepage</span>
            <?php else: ?>
                <span style="background: #64748b; color: white; padding: 4px 10px; border-radius: 12px; font-size: 0.8rem; font-weight:700; margin-left: 6px;"><i class="fa fa-eye-slash"></i> Currently Hidden on Homepage</span>
            <?php endif; ?>
            <p style="margin: 4px 0 0; font-size: 0.84rem; color: var(--text-muted);">
                Testimonials are temporarily hidden on the live website. Click the button to toggle visibility anytime.
            </p>
        </div>
        <a href="<?= BASE_URL ?>/admin/testimonials.php?toggle_visibility=1" class="btn btn-sm <?= get_setting('show_testimonials', '0') === '1' ? 'btn-outline' : 'btn-primary' ?>">
            <i class="fa <?= get_setting('show_testimonials', '0') === '1' ? 'fa-eye-slash' : 'fa-eye' ?>"></i>
            <?= get_setting('show_testimonials', '0') === '1' ? 'Hide From Website' : 'Show On Website' ?>
        </a>
    </div>

    <?php if (isset($_GET['visibility_updated'])): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Testimonial homepage visibility status updated!</div>
    <?php endif; ?>
    <?php if (isset($_GET['saved'])): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Testimonial successfully added!</div>
    <?php endif; ?>
    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Testimonial removed.</div>
    <?php endif; ?>

    <!-- Add Testimonial Card -->
    <div class="admin-card" style="border-left: 4px solid var(--accent);">
        <h2>Add Client Review</h2>
        <form action="<?= BASE_URL ?>/admin/testimonials.php" method="POST">
            <?= csrf_field() ?>
            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Client Name *</label>
                    <input type="text" name="client_name" class="form-control" placeholder="e.g. Dr. Alok Verma" required>
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Role / Title</label>
                    <input type="text" name="client_role" class="form-control" placeholder="e.g. Managing Director">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Company Name</label>
                    <input type="text" name="company" class="form-control" placeholder="e.g. Patliputra Biotech Labs">
                </div>
            </div>

            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Star Rating (1 - 5)</label>
                    <select name="rating" class="form-control">
                        <option value="5" selected>5 Stars (★★★★★)</option>
                        <option value="4">4 Stars (★★★★)</option>
                        <option value="3">3 Stars (★★★)</option>
                    </select>
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="0">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-size:0.84rem; font-weight:700;">Client Feedback / Endorsement *</label>
                <textarea name="feedback" class="form-control" rows="3" placeholder="Enter quote or testimonial text..." required></textarea>
            </div>

            <button type="submit" class="btn btn-primary btn-sm">
                <i class="fa fa-plus"></i> Add Testimonial
            </button>
        </form>
    </div>

    <!-- Testimonials List Table -->
    <div class="admin-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Client</th>
                    <th>Designation &amp; Company</th>
                    <th>Rating</th>
                    <th>Feedback Quote</th>
                    <th style="width: 100px;">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($testimonials as $t): ?>
                    <tr>
                        <td><strong><?= e($t['client_name']) ?></strong></td>
                        <td><?= e($t['client_role']) ?>, <?= e($t['company']) ?></td>
                        <td>
                            <span style="color:var(--accent);">
                                <?php for ($i=0; $i<$t['rating']; $i++): ?>★<?php endfor; ?>
                            </span>
                        </td>
                        <td style="color:var(--text-muted); font-size:0.88rem; max-width:340px;">
                            "<?= e($t['feedback']) ?>"
                        </td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/testimonials.php?delete=<?= $t['id'] ?>" onclick="return confirm('Delete this testimonial?')" style="color:#ef4444;">
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
