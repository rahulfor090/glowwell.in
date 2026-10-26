<?php
require_once __DIR__ . '/config/settings.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        $error = "Security validation failed. Please refresh.";
    } else {
        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if (empty($username) || empty($password)) {
            $error = "Please provide both username and password.";
        } else {
            $pdo = get_pdo();
            $stmt = $pdo->prepare("SELECT * FROM admins WHERE username = ? OR email = ?");
            $stmt->execute([$username, $username]);
            $admin = $stmt->fetch();

            if ($admin && password_verify($password, $admin['password_hash'])) {
                // Successful login
                $_SESSION['admin_logged'] = true;
                $_SESSION['admin_id'] = $admin['id'];
                $_SESSION['admin_user'] = $admin['username'];
                $_SESSION['admin_role'] = $admin['role'];

                // Update last login
                $pdo->prepare("UPDATE admins SET last_login = NOW() WHERE id = ?")->execute([$admin['id']]);

                header("Location: " . BASE_URL . "/admin/index.php");
                exit;
            } else {
                $error = "Invalid username or password.";
            }
        }
    }
}

$page_title = "Staff & Attorney Portal Login | Glow Well Consultants Pvt. Ltd.";
include __DIR__ . '/includes/header.php';
?>

<div class="page-banner" style="padding: 40px 0 50px;">
    <div class="container text-center" style="text-align: center;">
        <h1 class="page-banner-title" style="font-size: 2.2rem;">Internal Management Portal</h1>
        <p class="page-banner-subtitle">Authorized access for attorneys, consultants, and administrative staff.</p>
    </div>
</div>

<section class="section">
    <div class="container container-narrow" style="max-width: 480px;">
        <div class="form-card" style="box-shadow: var(--shadow-xl);">
            <div style="text-align: center; margin-bottom: 24px;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--navy-grad); color: var(--accent-light); display: inline-flex; align-items: center; justify-content: center; font-size: 1.6rem; margin-bottom: 12px;">
                    <i class="fa fa-lock"></i>
                </div>
                <h2 style="font-size: 1.6rem; color: var(--primary);">Secure Team Login</h2>
                <p style="color: var(--text-muted); font-size: 0.88rem;">Authorized access for administrative staff and consultants.</p>
            </div>

            <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <i class="fa fa-exclamation-circle"></i> <?= e($error) ?>
                </div>
            <?php endif; ?>

            <form action="<?= BASE_URL ?>/login.php" method="POST">
                <?= csrf_field() ?>

                <div class="form-group" style="margin-bottom: 18px;">
                    <label for="login_user" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Username or Email</label>
                    <div style="position: relative;">
                        <input type="text" id="login_user" name="username" class="form-control" placeholder="Enter your username or email" required autofocus>
                    </div>
                </div>

                <div class="form-group" style="margin-bottom: 24px;">
                    <label for="login_pass" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Password</label>
                    <input type="password" id="login_pass" name="password" class="form-control" placeholder="Enter password" required>
                </div>

                <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                    <i class="fa fa-sign-in"></i> Sign In to Dashboard
                </button>
            </form>

            <div style="margin-top: 24px; text-align: center; font-size: 0.85rem; color: var(--text-muted);">
                <a href="<?= BASE_URL ?>/index.php" style="color: var(--primary);">
                    <i class="fa fa-arrow-left"></i> Return to Homepage
                </a>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
