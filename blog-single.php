<?php
require_once __DIR__ . '/config/settings.php';

$slug = trim($_GET['slug'] ?? '');
if (empty($slug)) {
    header("Location: " . BASE_URL . "/blog.php");
    exit;
}

$pdo = get_pdo();
$stmt = $pdo->prepare("SELECT * FROM news WHERE slug = ? AND status = 'published' LIMIT 1");
$stmt->execute([$slug]);
$post = $stmt->fetch();

if (!$post) {
    header("Location: " . BASE_URL . "/blog.php");
    exit;
}

$page_title = !empty($post['meta_title']) ? $post['meta_title'] : ($post['title'] . " | Glow Well Legal Blog");
$meta_desc = !empty($post['meta_description']) ? $post['meta_description'] : ($post['excerpt'] ?? "Read expert legal analysis by Glow Well Consultants Pvt. Ltd.");

// Related posts from same category or latest
$rel_stmt = $pdo->prepare("SELECT * FROM news WHERE slug != ? AND status = 'published' ORDER BY (category = ?) DESC, id DESC LIMIT 3");
$rel_stmt->execute([$slug, $post['category'] ?? '']);
$related = $rel_stmt->fetchAll();

// Categories with counts for sidebar
$categories = $pdo->query("SELECT category, COUNT(*) as cnt FROM news WHERE status = 'published' GROUP BY category ORDER BY cnt DESC LIMIT 6")->fetchAll();

include __DIR__ . '/includes/header.php';
?>

<!-- Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <div class="breadcrumb-nav">
                <a href="<?= BASE_URL ?>/index.php">Home</a>
                <i class="fa fa-angle-right"></i>
                <a href="<?= BASE_URL ?>/blog.php">Blog &amp; Insights</a>
                <i class="fa fa-angle-right"></i>
                <span>Article</span>
            </div>
            <div style="display: flex; gap: 10px; align-items: center; margin-bottom: 12px; flex-wrap: wrap;">
                <span class="section-badge" style="background: rgba(255,255,255,0.12); color: var(--accent-light); margin-bottom: 0;">
                    <?= e($post['category']) ?>
                </span>
                <span style="color: #cbd5e1; font-size: 0.85rem;">
                    <i class="fa fa-clock-o text-gold"></i> <?= e($post['read_time']) ?>
                </span>
                <span style="color: #cbd5e1; font-size: 0.85rem;">
                    <i class="fa fa-calendar-o text-gold"></i> <?= date('F j, Y', strtotime($post['published_date'] ?? $post['created_at'])) ?>
                </span>
            </div>
            <h1 class="page-banner-title" style="font-size: 2.35rem; line-height: 1.3; max-width: 900px;"><?= e($post['title']) ?></h1>
            <p style="color: #cbd5e1; font-size: 0.96rem; margin-top: 10px;">
                By <strong style="color: #ffffff;"><?= e($post['author_name'] ?? 'Glow Well Legal Advisory') ?></strong> &bull; Patna Head Office
            </p>
        </div>
    </div>
</div>

<!-- Main Blog Reading Layout -->
<section class="section">
    <div class="container">
        <div class="layout-grid">
            <!-- Left Main Column: Blog Content -->
            <article class="detail-article">
                
                <!-- Excerpt Lead Paragraph -->
                <?php if (!empty($post['excerpt'])): ?>
                    <div style="font-size: 1.18rem; color: var(--primary); font-weight: 500; line-height: 1.75; padding-bottom: 24px; border-bottom: 2px solid var(--border-color); margin-bottom: 30px;">
                        <?= e($post['excerpt']) ?>
                    </div>
                <?php endif; ?>

                <!-- Full Article Content -->
                <div class="blog-article-content" style="font-size: 1.08rem; color: #1e293b; line-height: 1.85;">
                    <?= $post['content'] ?>
                </div>

                <!-- Social Share & Return Actions -->
                <div style="border-top: 2px solid var(--border-color); padding-top: 28px; margin-top: 45px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
                    <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
                        <span style="font-size: 0.88rem; font-weight: 700; color: var(--primary);">Share this article:</span>
                        <a href="https://wa.me/?text=<?= urlencode($post['title'] . ' ' . BASE_URL . '/blog-single.php?slug=' . $post['slug']) ?>" target="_blank" class="btn btn-sm btn-outline" style="color: #25d366; border-color: #25d366;">
                            <i class="fa fa-whatsapp"></i> WhatsApp
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(BASE_URL . '/blog-single.php?slug=' . $post['slug']) ?>" target="_blank" class="btn btn-sm btn-outline" style="color: #0077b5; border-color: #0077b5;">
                            <i class="fa fa-linkedin"></i> LinkedIn
                        </a>
                        <a href="https://twitter.com/intent/tweet?text=<?= urlencode($post['title']) ?>&url=<?= urlencode(BASE_URL . '/blog-single.php?slug=' . $post['slug']) ?>" target="_blank" class="btn btn-sm btn-outline" style="color: #1da1f2; border-color: #1da1f2;">
                            <i class="fa fa-twitter"></i> Twitter
                        </a>
                    </div>
                    <a href="<?= BASE_URL ?>/blog.php" class="btn btn-navy btn-sm">
                        <i class="fa fa-arrow-left"></i> Back to Blog Directory
                    </a>
                </div>

                <!-- Author Bio Card -->
                <div style="margin-top: 40px; background: var(--bg-subtle); border-radius: var(--radius-md); padding: 26px; display: flex; gap: 20px; align-items: center; border-left: 4px solid var(--accent);">
                    <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--navy-grad); color: var(--accent-light); font-weight: 800; font-size: 1.3rem; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                        GW
                    </div>
                    <div>
                        <strong style="color: var(--primary); font-size: 1.1rem; display: block; margin-bottom: 4px;">
                            <?= e($post['author_name'] ?? 'Glow Well Legal Advisory Cell') ?>
                        </strong>
                        <p style="margin: 0; font-size: 0.92rem; color: var(--text-muted); line-height: 1.5;">
                            Experienced attorneys and statutory consultants specializing in Patents, Trademarks, Copyrights, and Corporate Corporate Governance at Glow Well Consultants Pvt. Ltd., Patna.
                        </p>
                    </div>
                </div>

                <!-- Consultation Box for this Blog Post -->
                <div style="margin-top: 40px; padding: 32px; background: var(--navy-grad); border-radius: var(--radius-lg); color: #ffffff; box-shadow: var(--shadow-md);">
                    <span style="color: var(--accent-light); font-weight: 700; text-transform: uppercase; font-size: 0.78rem; letter-spacing: 0.08em; display: block; margin-bottom: 6px;">
                        Practical Legal Guidance
                    </span>
                    <h3 style="color: #ffffff; font-size: 1.45rem; margin-bottom: 10px;">
                        Need Tailored Advice on this Topic?
                    </h3>
                    <p style="color: #cbd5e1; font-size: 0.95rem; margin-bottom: 20px; line-height: 1.6;">
                        Every business situation has unique regulatory nuances. Consult our advisors directly for a confidential preliminary evaluation.
                    </p>
                    <div style="display: flex; gap: 14px; flex-wrap: wrap;">
                        <a href="<?= BASE_URL ?>/enquiry.php" class="btn btn-primary open-consultation-modal">
                            <i class="fa fa-calendar-check-o"></i> Book Consultation
                        </a>
                        <a href="https://wa.me/<?= e(get_setting('whatsapp_number', '917488961920')) ?>" target="_blank" class="btn btn-outline-gold">
                            <i class="fa fa-whatsapp"></i> Chat on WhatsApp
                        </a>
                    </div>
                </div>

            </article>

            <!-- Sidebar -->
            <aside class="sidebar">
                <!-- Search Widget -->
                <div class="widget-box">
                    <h3 class="widget-title">Search Blog</h3>
                    <form action="<?= BASE_URL ?>/blog.php" method="GET">
                        <div style="position: relative;">
                            <input type="text" name="q" placeholder="Keywords..." class="form-control" style="padding-right: 36px; font-size: 0.88rem;">
                            <button type="submit" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-muted); cursor: pointer;">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </form>
                </div>

                <!-- Categories Widget -->
                <div class="widget-box">
                    <h3 class="widget-title">Blog Topics</h3>
                    <ul class="widget-links">
                        <?php foreach ($categories as $cat): ?>
                            <li>
                                <a href="<?= BASE_URL ?>/blog.php?category=<?= urlencode($cat['category']) ?>">
                                    <span><?= e($cat['category']) ?></span>
                                    <span style="font-size: 0.8rem; background: var(--bg-subtle); padding: 2px 8px; border-radius: 10px; font-weight: 700;"><?= $cat['cnt'] ?></span>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Related / Recent Articles -->
                <div class="widget-box">
                    <h3 class="widget-title">Related Articles</h3>
                    <div style="display: flex; flex-direction: column; gap: 16px;">
                        <?php foreach ($related as $r): ?>
                            <div style="border-bottom: 1px solid var(--border-color); padding-bottom: 12px;">
                                <span style="font-size: 0.74rem; font-weight: 700; color: var(--accent-hover); text-transform: uppercase;">
                                    <?= e($r['category']) ?>
                                </span>
                                <h5 style="margin: 4px 0 6px; font-size: 0.95rem; line-height: 1.4;">
                                    <a href="<?= BASE_URL ?>/blog-single.php?slug=<?= e($r['slug']) ?>" style="color: var(--primary);">
                                        <?= e($r['title']) ?>
                                    </a>
                                </h5>
                                <span style="font-size: 0.75rem; color: var(--text-muted);">
                                    <?= date('M j, Y', strtotime($r['published_date'] ?? $r['created_at'])) ?> &bull; <?= e($r['read_time']) ?>
                                </span>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Office Contact Widget -->
                <div class="widget-contact-card">
                    <h4>Direct Legal Desk</h4>
                    <p>Speak directly with our Patna attorneys regarding your brand, patent, or business matter.</p>
                    <div style="display:flex; flex-direction:column; gap:12px; font-size:0.92rem;">
                        <div>
                            <i class="fa fa-phone text-gold"></i> <?= e(get_setting('contact_landline', '+91 612 2999299')) ?>
                        </div>
                        <div>
                            <i class="fa fa-whatsapp text-gold"></i> <?= e(get_setting('contact_mobile', '+91 7488961920')) ?>
                        </div>
                        <div>
                            <i class="fa fa-envelope-o text-gold"></i> <?= e(get_setting('contact_email', 'info@glowwell.in')) ?>
                        </div>
                    </div>
                    <a href="<?= BASE_URL ?>/enquiry.php" class="btn btn-outline-gold open-consultation-modal" style="width: 100%; margin-top: 22px;">
                        Schedule Call
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
