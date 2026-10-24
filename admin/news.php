<?php
$active_tab = 'news';
require_once __DIR__ . '/header.php';

$pdo = get_pdo();

// Delete
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $pdo->prepare("DELETE FROM news WHERE id = ?")->execute([$id]);
    header("Location: " . BASE_URL . "/admin/news.php?deleted=1");
    exit;
}

// Add/Edit
$edit_id = (int)($_GET['edit'] ?? 0);
$edit_news = null;
if ($edit_id > 0) {
    $stmt = $pdo->prepare("SELECT * FROM news WHERE id = ?");
    $stmt->execute([$edit_id]);
    $edit_news = $stmt->fetch();
}

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        die("Security error.");
    }
    $title = trim($_POST['title'] ?? '');
    $slug = trim($_POST['slug'] ?? '');
    $category = trim($_POST['category'] ?? 'IPR News');
    $read_time = trim($_POST['read_time'] ?? '4 min read');
    $excerpt = trim($_POST['excerpt'] ?? '');
    $content = trim($_POST['content'] ?? '');
    $author_name = trim($_POST['author_name'] ?? 'Glow Well Legal Advisory');

    if (empty($slug)) {
        $slug = strtolower(trim(preg_replace('/[^A-Za-z0-9-]+/', '-', $title)));
    }

    if (!empty($title) && !empty($content)) {
        if ($edit_id > 0) {
            $stmt = $pdo->prepare("UPDATE news SET title = ?, slug = ?, category = ?, read_time = ?, excerpt = ?, content = ?, author_name = ? WHERE id = ?");
            $stmt->execute([$title, $slug, $category, $read_time, $excerpt, $content, $author_name, $edit_id]);
            header("Location: " . BASE_URL . "/admin/news.php?saved=1");
            exit;
        } else {
            $stmt = $pdo->prepare("INSERT INTO news (title, slug, category, read_time, excerpt, content, author_name, published_date, status, is_featured) VALUES (?, ?, ?, ?, ?, ?, ?, CURDATE(), 'published', 1)");
            $stmt->execute([$title, $slug, $category, $read_time, $excerpt, $content, $author_name]);
            header("Location: " . BASE_URL . "/admin/news.php?saved=1");
            exit;
        }
    }
}

$articles = $pdo->query("SELECT * FROM news ORDER BY id DESC")->fetchAll();
?>

<div class="container" style="padding-top: 35px; padding-bottom: 50px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size: 1.85rem; color: var(--primary);">Legal Blog &amp; Articles Manager</h1>
            <p style="color: var(--text-muted); font-size: 0.92rem;">Publish and manage blog posts, legal case studies, and statutory IP updates.</p>
        </div>
        <div style="display:flex; gap:10px;">
            <a href="<?= BASE_URL ?>/blog.php" target="_blank" class="btn btn-navy btn-sm">
                <i class="fa fa-eye"></i> View Live Blog
            </a>
            <?php if ($edit_id > 0): ?>
                <a href="<?= BASE_URL ?>/admin/news.php" class="btn btn-primary btn-sm">
                    <i class="fa fa-plus"></i> Add New Post
                </a>
            <?php endif; ?>
        </div>
    </div>

    <?php if (isset($_GET['saved'])): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Insight article saved successfully!</div>
    <?php endif; ?>
    <?php if (isset($_GET['deleted'])): ?>
        <div class="alert alert-success"><i class="fa fa-check-circle"></i> Article removed.</div>
    <?php endif; ?>

    <!-- Add/Edit Article Card -->
    <div class="admin-card" style="border-left: 4px solid var(--accent);">
        <h2><?= $edit_news ? 'Edit Legal Insight' : 'Publish New Legal Insight' ?></h2>
        <form action="<?= BASE_URL ?>/admin/news.php<?= $edit_id > 0 ? '?edit='.$edit_id : '' ?>" method="POST">
            <?= csrf_field() ?>
            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Article Title *</label>
                    <input type="text" name="title" class="form-control" value="<?= e($edit_news['title'] ?? '') ?>" placeholder="e.g. Navigating Trademark Opposition Procedures in 2026" required>
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Slug / URL Key (leave blank to auto-generate)</label>
                    <input type="text" name="slug" class="form-control" value="<?= e($edit_news['slug'] ?? '') ?>" placeholder="e.g. trademark-opposition-procedures">
                </div>
            </div>

            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Category</label>
                    <input type="text" name="category" class="form-control" value="<?= e($edit_news['category'] ?? 'IPR Insights') ?>" placeholder="e.g. Trademark Law, Patent Trends, Corporate Legal">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Read Time</label>
                    <input type="text" name="read_time" class="form-control" value="<?= e($edit_news['read_time'] ?? '4 min read') ?>" placeholder="e.g. 5 min read">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Author Name</label>
                    <input type="text" name="author_name" class="form-control" value="<?= e($edit_news['author_name'] ?? 'Glow Well Legal Advisory') ?>">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 16px;">
                <label style="font-size:0.84rem; font-weight:700;">Short Excerpt (Shows on Cards &amp; Previews) *</label>
                <textarea name="excerpt" class="form-control" rows="2" placeholder="Brief summary of the article..." required><?= e($edit_news['excerpt'] ?? '') ?></textarea>
            </div>

            <div class="form-group" style="margin-bottom: 20px;">
                <label style="font-size:0.84rem; font-weight:700;">Full Article Content (HTML allowed: &lt;p&gt;, &lt;h3&gt;, &lt;ul&gt;) *</label>
                <textarea name="content" class="form-control" rows="8" placeholder="Complete article content..." required><?= e($edit_news['content'] ?? '') ?></textarea>
            </div>

            <div style="display:flex; gap:12px;">
                <button type="submit" class="btn btn-primary btn-sm">
                    <i class="fa fa-save"></i> <?= $edit_news ? 'Update Insight' : 'Publish Insight' ?>
                </button>
                <?php if ($edit_news): ?>
                    <a href="<?= BASE_URL ?>/admin/news.php" class="btn btn-outline btn-sm">Cancel Edit</a>
                <?php endif; ?>
            </div>
        </form>
    </div>

    <!-- Articles Table -->
    <div class="admin-card">
        <table class="data-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Article Title</th>
                    <th>Category</th>
                    <th>Author</th>
                    <th style="width: 140px;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $a): ?>
                    <tr>
                        <td><?= date('d M Y', strtotime($a['published_date'] ?? $a['created_at'])) ?></td>
                        <td>
                            <strong><?= e($a['title']) ?></strong><br>
                            <span style="font-size:0.8rem; color:var(--text-muted);">Slug: <?= e($a['slug']) ?></span>
                        </td>
                        <td>
                            <span style="display:inline-block; padding:3px 8px; border-radius:4px; background:var(--accent-soft); color:var(--accent-hover); font-weight:700; font-size:0.8rem;">
                                <?= e($a['category']) ?>
                            </span>
                        </td>
                        <td><?= e($a['author_name']) ?></td>
                        <td>
                            <a href="<?= BASE_URL ?>/admin/news.php?edit=<?= $a['id'] ?>" class="btn btn-outline btn-sm" style="padding:3px 8px; font-size:0.78rem;">
                                Edit
                            </a>
                            <a href="<?= BASE_URL ?>/blog-single.php?slug=<?= e($a['slug']) ?>" target="_blank" title="View live blog post" style="font-size:0.8rem; color:var(--primary); margin:0 6px;">
                                <i class="fa fa-external-link"></i>
                            </a>
                            <a href="<?= BASE_URL ?>/admin/news.php?delete=<?= $a['id'] ?>" onclick="return confirm('Delete this insight article?')" style="color:#ef4444; font-size:0.82rem;">
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
