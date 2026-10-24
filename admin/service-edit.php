<?php
$active_tab = 'services';
require_once __DIR__ . '/header.php';

$pdo = get_pdo();
$id = (int)($_GET['id'] ?? 0);
$practice = null;

if ($id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM practices WHERE id = ?");
    $stmt->execute([$id]);
    $practice = $stmt->fetch();
}

$error = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        $error = "Security token mismatch.";
    } else {
        $title = trim($_POST['title'] ?? '');
        $slug = trim($_POST['slug'] ?? '');
        $badge = trim($_POST['badge'] ?? 'Intellectual Property Rights');
        $banner_title = trim($_POST['banner_title'] ?? '');
        $banner_subtitle = trim($_POST['banner_subtitle'] ?? '');
        $short_desc = trim($_POST['short_description'] ?? '');
        $icon = trim($_POST['icon'] ?? 'fa-gavel');
        $content = trim($_POST['content'] ?? '');
        $meta_title = trim($_POST['meta_title'] ?? '');
        $meta_desc = trim($_POST['meta_description'] ?? '');
        $sort_order = (int)($_POST['sort_order'] ?? 0);
        $status = $_POST['status'] ?? 'published';
        $is_featured = isset($_POST['is_featured']) ? 1 : 0;

        // Auto-generate clean slug if needed
        if (empty($slug)) {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
        } else {
            $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $slug)));
        }

        if (empty($title) || empty($slug)) {
            $error = "Title and slug are required.";
        } else {
            if ($id > 0) {
                // Update
                $stmt = $pdo->prepare("UPDATE practices SET 
                    title = ?, 
                    slug = ?, 
                    badge = ?,
                    banner_title = ?,
                    banner_subtitle = ?,
                    short_description = ?, 
                    icon = ?, 
                    content = ?, 
                    meta_title = ?,
                    meta_description = ?,
                    sort_order = ?, 
                    status = ?, 
                    is_featured = ? 
                    WHERE id = ?");
                $stmt->execute([$title, $slug, $badge, $banner_title, $banner_subtitle, $short_desc, $icon, $content, $meta_title, $meta_desc, $sort_order, $status, $is_featured, $id]);
            } else {
                // Insert
                $stmt = $pdo->prepare("INSERT INTO practices (title, slug, badge, banner_title, banner_subtitle, short_description, icon, content, meta_title, meta_description, sort_order, status, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
                $stmt->execute([$title, $slug, $badge, $banner_title, $banner_subtitle, $short_desc, $icon, $content, $meta_title, $meta_desc, $sort_order, $status, $is_featured]);
                $id = (int)$pdo->lastInsertId();
            }

            // Create individual clean endpoint file if it doesn't exist
            $serviceFile = __DIR__ . '/../' . $slug . '.php';
            if (!file_exists($serviceFile)) {
                $stub = "<?php\n\$service_slug = '{$slug}';\nrequire __DIR__ . '/service.php';\n";
                @file_put_contents($serviceFile, $stub);
            }

            header("Location: " . BASE_URL . "/admin/services.php?saved=1");
            exit;
        }
    }
}
?>

<div class="container" style="padding-top: 35px; padding-bottom: 50px; max-width: 900px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size: 1.85rem; color: var(--primary);"><?= $id > 0 ? 'Edit Practice Area' : 'Add New Practice Area' ?></h1>
            <p style="color: var(--text-muted); font-size: 0.92rem;">Control all text, banner, body article, FAQs, and SEO for this service.</p>
        </div>
        <div style="display:flex; gap:10px;">
            <?php if ($id > 0 && !empty($practice['slug'])): ?>
                <a href="<?= BASE_URL ?>/<?= e($practice['slug']) ?>.php" target="_blank" class="btn btn-navy btn-sm">
                    <i class="fa fa-external-link"></i> View Live Page
                </a>
            <?php endif; ?>
            <a href="<?= BASE_URL ?>/admin/services.php" class="btn btn-outline btn-sm">
                <i class="fa fa-arrow-left"></i> Back to Services
            </a>
        </div>
    </div>

    <?php if (!empty($error)): ?>
        <div class="alert alert-danger"><i class="fa fa-exclamation-triangle"></i> <?= e($error) ?></div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/admin/service-edit.php<?= $id > 0 ? '?id='.$id : '' ?>" method="POST">
        <?= csrf_field() ?>

        <!-- Basic Info -->
        <div class="admin-card">
            <h2><i class="fa fa-info-circle text-gold"></i> 1. Identification &amp; Routing</h2>
            <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 20px;">Title, URL slug, and category badge.</p>

            <div class="form-row" style="margin-bottom: 18px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Practice Title *</label>
                    <input type="text" name="title" class="form-control" value="<?= e($practice['title'] ?? '') ?>" placeholder="e.g. Trademark Registration & Protection" required>
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Slug / URL Key *</label>
                    <input type="text" name="slug" class="form-control" value="<?= e($practice['slug'] ?? '') ?>" placeholder="e.g. trademark" required>
                    <span style="font-size:0.75rem; color:var(--text-muted);">Accessible at: <code>/<?= e($practice['slug'] ?? 'slug') ?>.php</code> and <code>/service.php?slug=<?= e($practice['slug'] ?? 'slug') ?></code></span>
                </div>
            </div>

            <div class="form-row" style="margin-bottom: 18px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Category Badge</label>
                    <input type="text" name="badge" class="form-control" value="<?= e($practice['badge'] ?? 'Intellectual Property Rights') ?>" placeholder="e.g. Intellectual Property Rights, Corporate Structuring">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">FontAwesome Icon Class</label>
                    <input type="text" name="icon" class="form-control" value="<?= e($practice['icon'] ?? 'fa-gavel') ?>" placeholder="e.g. fa-registered, fa-lightbulb-o, fa-shield">
                    <span style="font-size:0.75rem; color:var(--text-muted);">Current Icon: <i class="fa <?= e($practice['icon'] ?? 'fa-gavel') ?>" style="color:var(--accent); font-size:1.1rem; margin-left:4px;"></i></span>
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Display Sort Order</label>
                    <input type="number" name="sort_order" class="form-control" value="<?= e($practice['sort_order'] ?? '0') ?>">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Publishing Status</label>
                    <select name="status" class="form-control">
                        <option value="published" <?= ($practice['status'] ?? '') === 'published' ? 'selected' : '' ?>>Published (Live on Website)</option>
                        <option value="draft" <?= ($practice['status'] ?? '') === 'draft' ? 'selected' : '' ?>>Draft (Hidden)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Banner & Summary -->
        <div class="admin-card">
            <h2><i class="fa fa-header text-gold"></i> 2. Page Header &amp; Card Summary</h2>
            <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 20px;">Content shown in the top hero banner and homepage grid cards.</p>

            <div class="form-group" style="margin-bottom: 18px;">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Page Banner Big Title</label>
                <input type="text" name="banner_title" class="form-control" value="<?= e($practice['banner_title'] ?? '') ?>" placeholder="e.g. Trademark Registration & Brand Protection">
                <span style="font-size:0.75rem; color:var(--text-muted);">Leave empty to default to Practice Title.</span>
            </div>

            <div class="form-group" style="margin-bottom: 18px;">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Page Banner Subtitle / Tagline</label>
                <textarea name="banner_subtitle" class="form-control" rows="2" placeholder="e.g. Securing exclusive nationwide monopoly, preventing commercial counterfeiting..."><?= e($practice['banner_subtitle'] ?? '') ?></textarea>
            </div>

            <div class="form-group">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Short Summary (Shows in Homepage Grid &amp; Services Directory) *</label>
                <textarea name="short_description" class="form-control" rows="3" placeholder="Brief summary for listings..." required><?= e($practice['short_description'] ?? '') ?></textarea>
            </div>
        </div>

        <!-- Main Body Content -->
        <div class="admin-card">
            <h2><i class="fa fa-file-text-o text-gold"></i> 3. Full Page Article / Body Content</h2>
            <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 15px;">
                The complete comprehensive content of this practice area. Full HTML formatting (headings <code>&lt;h2&gt;</code>, lists <code>&lt;ul&gt;</code>, bold tags <code>&lt;strong&gt;</code>, grid divs) is supported and renders directly on the live page.
            </p>

            <div class="form-group">
                <textarea name="content" class="form-control" rows="18" style="font-family:monospace; font-size:0.88rem; line-height:1.5;"><?= htmlspecialchars($practice['content'] ?? '') ?></textarea>
            </div>
        </div>

        <!-- SEO Metadata -->
        <div class="admin-card">
            <h2><i class="fa fa-search text-gold"></i> 4. Search Engine Optimization (SEO)</h2>
            <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 20px;">Meta tags for Google and search engines.</p>

            <div class="form-group" style="margin-bottom: 18px;">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Meta Page Title</label>
                <input type="text" name="meta_title" class="form-control" value="<?= e($practice['meta_title'] ?? '') ?>" placeholder="e.g. Trademark Registration in Patna | Glow Well Consultants Pvt. Ltd.">
            </div>

            <div class="form-group">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Meta Description</label>
                <textarea name="meta_description" class="form-control" rows="3" placeholder="Search engine description (150-160 characters)..."><?= e($practice['meta_description'] ?? '') ?></textarea>
            </div>
        </div>

        <!-- Actions -->
        <div style="position: sticky; bottom: 20px; z-index: 99; background: rgba(8, 26, 54, 0.95); backdrop-filter: blur(10px); padding: 18px 24px; border-radius: var(--radius-md); box-shadow: var(--shadow-xl); display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #cbd5e1; font-size: 0.92rem;"><i class="fa fa-info-circle text-gold"></i> Updates take effect on the live website immediately.</span>
            <div style="display:flex; gap:12px;">
                <a href="<?= BASE_URL ?>/admin/services.php" class="btn btn-outline" style="border-color:#64748b; color:#ffffff;">Cancel</a>
                <button type="submit" class="btn btn-primary btn-lg">
                    <i class="fa fa-save"></i> Save Practice Area
                </button>
            </div>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
