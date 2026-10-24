<?php
$active_tab = 'settings';
require_once __DIR__ . '/header.php';

$pdo = get_pdo();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        die("Security error.");
    }

    // Check if password change requested
    if (!empty($_POST['new_password'])) {
        $new_pass = trim($_POST['new_password']);
        if (strlen($new_pass) < 6) {
            $msg = ['type' => 'danger', 'text' => 'New password must be at least 6 characters.'];
        } else {
            $new_hash = password_hash($new_pass, PASSWORD_BCRYPT);
            $pdo->prepare("UPDATE admins SET password_hash = ? WHERE username = ?")->execute([$new_hash, $_SESSION['admin_user']]);
            $msg = ['type' => 'success', 'text' => 'Admin password successfully changed!'];
        }
    } else {
        $keys = [
            'site_name', 'tagline', 'contact_landline', 'contact_mobile', 'contact_mobile_alt',
            'whatsapp_number', 'contact_email', 'contact_email_enquiry', 'contact_address',
            'office_hours', 'map_embed', 'footer_about',
            'facebook', 'linkedin', 'twitter', 'instagram', 'youtube', 'copyright'
        ];

        $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
        foreach ($keys as $k) {
            if (isset($_POST[$k])) {
                $val = trim($_POST[$k]);
                $stmt->execute([$k, $val]);
            }
        }
        $msg = ['type' => 'success', 'text' => 'Contact details and site settings saved successfully!'];
    }
}

$settings = get_all_settings();
?>

<div class="container" style="padding-top: 35px; padding-bottom: 50px; max-width: 900px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px;">
        <div>
            <h1 style="font-size: 1.85rem; color: var(--primary);">Contact &amp; Global Site Settings</h1>
            <p style="color: var(--text-muted); font-size: 0.92rem;">Update official company contact numbers, address, emails, and admin security.</p>
        </div>
    </div>

    <?php if (!empty($msg)): ?>
        <div class="alert alert-<?= $msg['type'] ?>">
            <i class="fa fa-check-circle"></i> <?= e($msg['text']) ?>
        </div>
    <?php endif; ?>

    <!-- Contact & Info Form -->
    <div class="admin-card">
        <h2><i class="fa fa-building-o text-gold"></i> Official Company &amp; Contact Details</h2>
        <form action="<?= BASE_URL ?>/admin/settings.php" method="POST">
            <?= csrf_field() ?>

            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Company / Firm Legal Name</label>
                    <input type="text" name="site_name" class="form-control" value="<?= e($settings['site_name'] ?? '') ?>" required>
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Corporate Tagline</label>
                    <input type="text" name="tagline" class="form-control" value="<?= e($settings['tagline'] ?? '') ?>">
                </div>
            </div>

            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Office Landline Number</label>
                    <input type="text" name="contact_landline" class="form-control" value="<?= e($settings['contact_landline'] ?? '') ?>" placeholder="+91 612 2999299">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Primary Mobile / WhatsApp Number</label>
                    <input type="text" name="contact_mobile" class="form-control" value="<?= e($settings['contact_mobile'] ?? '') ?>" placeholder="+91 7488961920">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Alternative Mobile</label>
                    <input type="text" name="contact_mobile_alt" class="form-control" value="<?= e($settings['contact_mobile_alt'] ?? '') ?>" placeholder="+91 7488961921">
                </div>
            </div>

            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">WhatsApp Click-To-Chat (Digits only with country code)</label>
                    <input type="text" name="whatsapp_number" class="form-control" value="<?= e($settings['whatsapp_number'] ?? '917488961920') ?>">
                    <span style="font-size:0.75rem; color:var(--text-muted);">e.g. <code>917488961920</code></span>
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Primary Email Address</label>
                    <input type="email" name="contact_email" class="form-control" value="<?= e($settings['contact_email'] ?? '') ?>" placeholder="info@glowwell.in">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Enquiry Email Address</label>
                    <input type="email" name="contact_email_enquiry" class="form-control" value="<?= e($settings['contact_email_enquiry'] ?? '') ?>" placeholder="info@glowwell.in">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 16px;">
                <label style="font-size:0.84rem; font-weight:700;">Full Physical Office Address</label>
                <textarea name="contact_address" class="form-control" rows="2"><?= e($settings['contact_address'] ?? '') ?></textarea>
            </div>

            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Working Hours</label>
                    <input type="text" name="office_hours" class="form-control" value="<?= e($settings['office_hours'] ?? '') ?>" placeholder="Monday – Saturday: 10:00 AM – 7:00 PM">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Google Maps Embed URL (Iframe Src)</label>
                    <input type="text" name="map_embed" class="form-control" value="<?= e($settings['map_embed'] ?? '') ?>">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 22px;">
                <label style="font-size:0.84rem; font-weight:700;">Footer About Blurb</label>
                <textarea name="footer_about" class="form-control" rows="2"><?= e($settings['footer_about'] ?? '') ?></textarea>
            </div>

            <div class="admin-section-divider"></div>

            <h3 style="font-size: 1.15rem; color: var(--primary); margin-bottom: 14px;"><i class="fa fa-share-alt text-gold"></i> Social Media Links &amp; Footer Copyright</h3>
            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;"><i class="fa fa-facebook"></i> Facebook Page URL</label>
                    <input type="url" name="facebook" class="form-control" value="<?= e($settings['facebook'] ?? '') ?>" placeholder="https://facebook.com/glowwell">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;"><i class="fa fa-linkedin"></i> LinkedIn URL</label>
                    <input type="url" name="linkedin" class="form-control" value="<?= e($settings['linkedin'] ?? '') ?>" placeholder="https://linkedin.com/company/glowwell">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;"><i class="fa fa-twitter"></i> Twitter / X URL</label>
                    <input type="url" name="twitter" class="form-control" value="<?= e($settings['twitter'] ?? '') ?>" placeholder="https://twitter.com/glowwell">
                </div>
            </div>

            <div class="form-row" style="margin-bottom: 24px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;"><i class="fa fa-instagram"></i> Instagram URL</label>
                    <input type="url" name="instagram" class="form-control" value="<?= e($settings['instagram'] ?? '') ?>" placeholder="https://instagram.com/glowwell">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;"><i class="fa fa-youtube"></i> YouTube URL</label>
                    <input type="url" name="youtube" class="form-control" value="<?= e($settings['youtube'] ?? '') ?>" placeholder="https://youtube.com/glowwell">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Footer Copyright Text</label>
                    <input type="text" name="copyright" class="form-control" value="<?= e($settings['copyright'] ?? '© 2026 Glowwell. All rights reserved.') ?>">
                </div>
            </div>

            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fa fa-save"></i> Save Global Settings
            </button>
        </form>
    </div>

    <!-- Admin Account Security Card -->
    <div class="admin-card" style="border-left: 4px solid #ef4444;">
        <h2><i class="fa fa-key text-gold"></i> Change Admin Password</h2>
        <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 20px;">Update password for admin user <code><?= e($_SESSION['admin_user']) ?></code>.</p>
        <form action="<?= BASE_URL ?>/admin/settings.php" method="POST">
            <?= csrf_field() ?>
            <div class="form-row" style="margin-bottom: 18px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">New Password (min 6 characters)</label>
                    <input type="password" name="new_password" class="form-control" placeholder="Enter new strong password" required>
                </div>
            </div>
            <button type="submit" class="btn btn-navy btn-sm">
                <i class="fa fa-lock"></i> Update Password
            </button>
        </form>
    </div>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
