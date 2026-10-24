<?php
$page_title = "Legal Blog & Intellectual Property Insights | Glow Well Consultants Pvt. Ltd.";
$meta_desc = "Explore expert legal analysis, patent drafting tips, trademark prosecution precedents, and startup incorporation guides from Glow Well Consultants in Patna, Bihar.";
require_once __DIR__ . '/config/settings.php';

$pdo = get_pdo();

// Filter handling
$category = trim($_GET['category'] ?? '');
$search = trim($_GET['q'] ?? '');

$query = "SELECT * FROM news WHERE status = 'published'";
$params = [];

if (!empty($category)) {
    $query .= " AND category = ?";
    $params[] = $category;
}

if (!empty($search)) {
    $query .= " AND (title LIKE ? OR excerpt LIKE ? OR content LIKE ?)";
    $like = '%' . $search . '%';
    $params[] = $like;
    $params[] = $like;
    $params[] = $like;
}

$query .= " ORDER BY published_date DESC, id DESC";
$stmt = $pdo->prepare($query);
$stmt->execute($params);
$posts = $stmt->fetchAll();

// Get distinct categories with counts for filter pills
$cat_stmt = $pdo->query("SELECT category, COUNT(*) as cnt FROM news WHERE status = 'published' AND category IS NOT NULL GROUP BY category ORDER BY cnt DESC");
$categories = $cat_stmt->fetchAll();

// Latest featured post for hero highlight (if no active filter)
$featured_post = null;
if (empty($category) && empty($search) && count($posts) > 0) {
    $featured_post = $posts[0];
    // Remaining posts for grid
    $grid_posts = array_slice($posts, 1);
} else {
    $grid_posts = $posts;
}

include __DIR__ . '/includes/header.php';
?>

<!-- Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <div class="breadcrumb-nav">
                <a href="<?= BASE_URL ?>/index.php">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Blog &amp; Legal Insights</span>
            </div>
            <h1 class="page-banner-title">Legal Blog &amp; Intellectual Property Insights</h1>
            <p class="page-banner-subtitle">
                Expert commentary, regulatory notices from the Indian Patent &amp; Trademark Registries, case law analysis, and strategic guides for business leaders.
            </p>
        </div>
    </div>
</div>

<!-- Blog Main Section -->
<section class="section">
    <div class="container">
        
        <!-- Filter & Search Toolbar -->
        <div style="background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 20px 24px; margin-bottom: 40px; box-shadow: var(--shadow-sm); display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 16px;">
            <!-- Category Pills -->
            <div style="display: flex; gap: 8px; flex-wrap: wrap; align-items: center;">
                <span style="font-size: 0.84rem; font-weight: 700; color: var(--primary); margin-right: 6px;">
                    <i class="fa fa-filter text-gold"></i> Topics:
                </span>
                <a href="<?= BASE_URL ?>/blog.php" class="btn btn-sm <?= empty($category) ? 'btn-primary' : 'btn-outline' ?>" style="padding: 5px 14px; font-size: 0.82rem;">
                    All Topics (<?= count($posts) + ($featured_post ? 1 : 0) ?>)
                </a>
                <?php foreach ($categories as $c): ?>
                    <a href="<?= BASE_URL ?>/blog.php?category=<?= urlencode($c['category']) ?>" class="btn btn-sm <?= ($category === $c['category']) ? 'btn-primary' : 'btn-outline' ?>" style="padding: 5px 14px; font-size: 0.82rem;">
                        <?= e($c['category']) ?> <span style="opacity: 0.75; font-size: 0.75rem;">(<?= $c['cnt'] ?>)</span>
                    </a>
                <?php endforeach; ?>
            </div>

            <!-- Search Form -->
            <form action="<?= BASE_URL ?>/blog.php" method="GET" style="display: flex; gap: 8px; min-width: 260px;">
                <?php if (!empty($category)): ?>
                    <input type="hidden" name="category" value="<?= e($category) ?>">
                <?php endif; ?>
                <div style="position: relative; width: 100%;">
                    <input type="text" name="q" value="<?= e($search) ?>" placeholder="Search legal topics..." class="form-control" style="padding: 7px 36px 7px 14px; font-size: 0.88rem; width: 100%;">
                    <button type="submit" style="position: absolute; right: 10px; top: 50%; transform: translateY(-50%); background: none; border: none; color: var(--text-muted); cursor: pointer;">
                        <i class="fa fa-search"></i>
                    </button>
                </div>
                <?php if (!empty($search) || !empty($category)): ?>
                    <a href="<?= BASE_URL ?>/blog.php" class="btn btn-outline btn-sm" title="Clear Filters" style="padding: 7px 12px;">
                        <i class="fa fa-times"></i>
                    </a>
                <?php endif; ?>
            </form>
        </div>

        <!-- Featured Post Hero Card (Only on initial view) -->
        <?php if ($featured_post): ?>
            <div style="background: var(--navy-grad); border-radius: var(--radius-lg); padding: 42px; color: #ffffff; margin-bottom: 50px; box-shadow: var(--shadow-lg); position: relative; overflow: hidden;">
                <div style="position: absolute; right: -20px; bottom: -30px; opacity: 0.08; font-size: 15rem; color: #ffffff; pointer-events: none;">
                    <i class="fa fa-newspaper-o"></i>
                </div>
                <div style="position: relative; z-index: 1; max-width: 820px;">
                    <div style="display: flex; gap: 12px; align-items: center; margin-bottom: 14px; flex-wrap: wrap;">
                        <span class="section-badge" style="background: var(--accent); color: var(--primary-dark); font-weight: 800; font-size: 0.75rem;">
                            ★ Featured Analysis
                        </span>
                        <span style="color: var(--accent-light); font-size: 0.85rem; font-weight: 700;">
                            <?= e($featured_post['category']) ?> &bull; <?= e($featured_post['read_time']) ?>
                        </span>
                    </div>
                    <h2 style="font-size: 2.1rem; color: #ffffff; margin-bottom: 16px; line-height: 1.3;">
                        <a href="<?= BASE_URL ?>/blog-single.php?slug=<?= e($featured_post['slug']) ?>" style="color: #ffffff; text-decoration: none;">
                            <?= e($featured_post['title']) ?>
                        </a>
                    </h2>
                    <p style="color: #cbd5e1; font-size: 1.05rem; line-height: 1.7; margin-bottom: 25px;">
                        <?= e($featured_post['excerpt']) ?>
                    </p>
                    <div style="display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; border-top: 1px solid rgba(255,255,255,0.15); padding-top: 20px;">
                        <div style="display: flex; align-items: center; gap: 12px;">
                            <div style="width: 40px; height: 40px; border-radius: 50%; background: var(--accent); color: var(--primary-dark); font-weight: 800; display: flex; align-items: center; justify-content: center; font-size: 0.95rem;">
                                GW
                            </div>
                            <div>
                                <strong style="display: block; font-size: 0.92rem; color: #ffffff;"><?= e($featured_post['author_name'] ?? 'Glow Well Legal Advisory') ?></strong>
                                <span style="font-size: 0.78rem; color: #94a3b8;"><?= date('F j, Y', strtotime($featured_post['published_date'] ?? $featured_post['created_at'])) ?></span>
                            </div>
                        </div>
                        <a href="<?= BASE_URL ?>/blog-single.php?slug=<?= e($featured_post['slug']) ?>" class="btn btn-primary btn-md">
                            Read Full Article <i class="fa fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Active Search / Filter Status Banner -->
        <?php if (!empty($category) || !empty($search)): ?>
            <div style="margin-bottom: 25px; display: flex; justify-content: space-between; align-items: center;">
                <p style="font-size: 1.05rem; color: var(--primary); margin: 0;">
                    Showing results <?php if (!empty($category)): ?>in <strong><?= e($category) ?></strong><?php endif; ?>
                    <?php if (!empty($search)): ?>for keyword "<strong><?= e($search) ?></strong>"<?php endif; ?>:
                    <span style="color: var(--text-muted); font-size: 0.92rem;">(<?= count($posts) ?> articles found)</span>
                </p>
                <a href="<?= BASE_URL ?>/blog.php" style="font-size: 0.88rem; font-weight: 700; color: var(--accent);">
                    <i class="fa fa-refresh"></i> Reset All
                </a>
            </div>
        <?php endif; ?>

        <!-- 3-Column Blog Grid -->
        <?php if (empty($grid_posts)): ?>
            <div class="admin-card" style="text-align: center; padding: 60px 20px;">
                <i class="fa fa-folder-open-o text-gold" style="font-size: 3rem; margin-bottom: 16px; display: inline-block;"></i>
                <h3 style="color: var(--primary); font-size: 1.4rem;">No articles found</h3>
                <p style="color: var(--text-muted); max-width: 480px; margin: 0 auto 20px;">
                    We couldn't find any articles matching your search criteria. Try a different keyword or explore our full library.
                </p>
                <a href="<?= BASE_URL ?>/blog.php" class="btn btn-primary btn-sm">
                    View All Articles
                </a>
            </div>
        <?php else: ?>
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
                <?php foreach ($grid_posts as $post): ?>
                    <article style="background: var(--white); border-radius: var(--radius-lg); border: 1px solid var(--border-color); overflow: hidden; box-shadow: var(--shadow-sm); display: flex; flex-direction: column; transition: transform 0.25s ease, box-shadow 0.25s ease;">
                        <div style="padding: 30px; flex-grow: 1; display: flex; flex-direction: column;">
                            <!-- Header Meta -->
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 14px;">
                                <span style="font-size: 0.78rem; font-weight: 700; color: var(--accent-hover); text-transform: uppercase; letter-spacing: 0.05em; background: var(--bg-subtle); padding: 4px 10px; border-radius: 4px;">
                                    <?= e($post['category']) ?>
                                </span>
                                <span style="font-size: 0.78rem; color: var(--text-muted);">
                                    <i class="fa fa-clock-o"></i> <?= e($post['read_time']) ?>
                                </span>
                            </div>

                            <!-- Title -->
                            <h3 style="font-size: 1.28rem; margin-bottom: 14px; line-height: 1.4;">
                                <a href="<?= BASE_URL ?>/blog-single.php?slug=<?= e($post['slug']) ?>" style="color: var(--primary); text-decoration: none;">
                                    <?= e($post['title']) ?>
                                </a>
                            </h3>

                            <!-- Excerpt -->
                            <p style="color: var(--text-muted); font-size: 0.92rem; line-height: 1.65; margin-bottom: 22px; flex-grow: 1;">
                                <?= e($post['excerpt']) ?>
                            </p>

                            <!-- Bottom Author & Action -->
                            <div style="border-top: 1px solid var(--border-color); padding-top: 16px; display: flex; justify-content: space-between; align-items: center;">
                                <div style="display: flex; align-items: center; gap: 8px;">
                                    <div style="width: 32px; height: 32px; border-radius: 50%; background: var(--bg-subtle); color: var(--primary); font-weight: 700; display: flex; align-items: center; justify-content: center; font-size: 0.78rem;">
                                        <i class="fa fa-user"></i>
                                    </div>
                                    <div>
                                        <span style="font-size: 0.82rem; font-weight: 700; color: var(--primary); display: block; line-height: 1.2;">
                                            <?= e($post['author_name'] ?? 'Legal Advisory') ?>
                                        </span>
                                        <span style="font-size: 0.72rem; color: var(--text-muted);">
                                            <?= date('M j, Y', strtotime($post['published_date'] ?? $post['created_at'])) ?>
                                        </span>
                                    </div>
                                </div>
                                <a href="<?= BASE_URL ?>/blog-single.php?slug=<?= e($post['slug']) ?>" style="font-weight: 700; font-size: 0.88rem; color: var(--primary); display: inline-flex; align-items: center; gap: 5px;">
                                    Read <i class="fa fa-arrow-right text-gold"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <!-- Newsletter / Legal Advisory CTA -->
        <div style="margin-top: 60px; background: var(--bg-light); border: 2px dashed var(--accent); border-radius: var(--radius-lg); padding: 36px; text-align: center; max-width: 820px; margin-left: auto; margin-right: auto;">
            <span class="section-badge" style="margin-bottom: 10px;">Stay Ahead</span>
            <h3 style="color: var(--primary); font-size: 1.55rem; margin-bottom: 10px;">Have a Question Regarding Recent Statutory Changes?</h3>
            <p style="color: var(--text-muted); font-size: 0.95rem; max-width: 600px; margin: 0 auto 22px;">
                Our corporate advisors in Patna actively advise enterprises, corporate directors, and growing startups on regulatory compliance and brand assets.
            </p>
            <div style="display: inline-flex; gap: 14px; flex-wrap: wrap; justify-content: center;">
                <a href="<?= BASE_URL ?>/enquiry.php" class="btn btn-primary open-consultation-modal">
                    <i class="fa fa-calendar-check-o"></i> Book Consultation
                </a>
                <a href="https://wa.me/<?= e(get_setting('whatsapp_number', '917488961920')) ?>" target="_blank" class="btn btn-navy">
                    <i class="fa fa-whatsapp"></i> Chat on WhatsApp
                </a>
            </div>
        </div>

    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
