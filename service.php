<?php
/**
 * Dynamic Service / Practice Area Template
 * Glow Well Consultants Pvt. Ltd.
 */
require_once __DIR__ . '/config/settings.php';

$pdo = get_pdo();

// Determine slug from variable (if included) or GET param
$slug = $service_slug ?? ($_GET['slug'] ?? '');
$slug = trim(preg_replace('/[^a-zA-Z0-9_-]/', '', $slug));

if (empty($slug)) {
    header("Location: " . BASE_URL . "/services.php");
    exit;
}

$stmt = $pdo->prepare("SELECT * FROM practices WHERE slug = ? AND status = 'published' LIMIT 1");
$stmt->execute([$slug]);
$practice = $stmt->fetch();

if (!$practice) {
    // Service not found or temporarily hidden - redirect to services directory
    header("Location: " . BASE_URL . "/services.php");
    exit;
}

// SEO & Metadata
$page_title = !empty($practice['meta_title']) ? $practice['meta_title'] : ($practice['title'] . ' | Glow Well Consultants Pvt. Ltd.');
$meta_desc = !empty($practice['meta_description']) ? $practice['meta_description'] : ($practice['short_description'] ?? 'Comprehensive legal, IPR and corporate advisory services in Patna, Bihar.');

// Fetch FAQs specific to this practice area
$faq_stmt = $pdo->prepare("SELECT * FROM faqs WHERE practice_slug = ? ORDER BY sort_order ASC, id ASC");
$faq_stmt->execute([$slug]);
$faqs = $faq_stmt->fetchAll();

// All active practices for the sidebar navigation
$all_practices = get_active_practices();

include __DIR__ . '/includes/header.php';
?>

<!-- Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <div class="breadcrumb-nav">
                <a href="<?= BASE_URL ?>/index.php">Home</a>
                <i class="fa fa-angle-right"></i>
                <a href="<?= BASE_URL ?>/services.php">Services</a>
                <i class="fa fa-angle-right"></i>
                <span><?= e($practice['title']) ?></span>
            </div>
            <h1 class="page-banner-title">
                <?= !empty($practice['banner_title']) ? $practice['banner_title'] : e($practice['title']) ?>
            </h1>
            <?php if (!empty($practice['banner_subtitle'])): ?>
                <p class="page-banner-subtitle">
                    <?= $practice['banner_subtitle'] ?>
                </p>
            <?php elseif (!empty($practice['intro'])): ?>
                <p class="page-banner-subtitle">
                    <?= e($practice['intro']) ?>
                </p>
            <?php endif; ?>
        </div>
    </div>
</div>

<!-- Main Content Layout -->
<section class="section">
    <div class="container">
        <div class="layout-grid">
            <!-- Left Main Column -->
            <article class="detail-article">
                <span class="section-badge"><?= e($practice['badge'] ?? 'Intellectual Property Rights') ?></span>

                <!-- Dynamic Rich Content from Database -->
                <?php if (!empty($practice['content'])): ?>
                    <div class="practice-rich-body">
                        <?= $practice['content'] ?>
                    </div>
                <?php else: ?>
                    <h2>About <?= e($practice['title']) ?></h2>
                    <p><?= nl2br(e($practice['intro'] ?? $practice['short_description'])) ?></p>
                <?php endif; ?>

                <!-- Practice-Specific FAQs from Database -->
                <?php if (!empty($faqs)): ?>
                    <div style="margin-top: 45px; border-top: 2px solid var(--border-color); padding-top: 35px;">
                        <span class="section-badge">Client Knowledge Base</span>
                        <h2 style="margin-bottom: 24px;">Frequently Asked Questions on <?= e($practice['title']) ?></h2>
                        <div class="faq-accordion">
                            <?php foreach ($faqs as $idx => $f): ?>
                                <div class="faq-item <?= $idx === 0 ? 'active' : '' ?>">
                                    <button class="faq-question">
                                        <span><?= e($f['question']) ?></span>
                                        <i class="fa fa-chevron-down"></i>
                                    </button>
                                    <div class="faq-answer">
                                        <p><?= nl2br(e($f['answer'])) ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>

                <!-- Consultation Box -->
                <div style="margin-top: 45px; padding: 32px; background: var(--navy-grad); border-radius: var(--radius-lg); color: #ffffff; box-shadow: var(--shadow-lg);">
                    <div style="display: flex; gap: 20px; align-items: flex-start; flex-wrap: wrap;">
                        <div style="flex: 1; min-width: 260px;">
                            <span style="color: var(--accent-light); font-weight: 700; text-transform: uppercase; font-size: 0.8rem; letter-spacing: 0.08em; display: block; margin-bottom: 6px;">Confidential Evaluation</span>
                            <h3 style="color: #ffffff; font-size: 1.45rem; margin-bottom: 8px;">
                                Consult Our <?= e($practice['title']) ?> Advisors
                            </h3>
                            <p style="color: #cbd5e1; font-size: 0.94rem; margin-bottom: 16px; line-height: 1.6;">
                                Receive strategic guidance on eligibility, documentation requirements, and competitive fee estimates. In-person meetings available at our Patna head office or via direct phone/video consultation.
                            </p>
                            <div style="display: flex; gap: 14px; flex-wrap: wrap;">
                                <a href="<?= BASE_URL ?>/enquiry.php?service=<?= urlencode($slug) ?>" class="btn btn-primary open-consultation-modal">
                                    <i class="fa fa-calculator"></i> Request Cost Estimation
                                </a>
                                <a href="https://wa.me/<?= e(get_setting('whatsapp_number', '917488961920')) ?>" target="_blank" class="btn btn-outline-gold">
                                    <i class="fa fa-whatsapp"></i> Chat on WhatsApp
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="sidebar">
                <!-- Practice Navigation Widget -->
                <div class="widget-box">
                    <h3 class="widget-title">Key Services</h3>
                    <ul class="widget-links">
                        <?php foreach ($all_practices as $p): ?>
                            <li class="<?= $p['slug'] === $slug ? 'active' : '' ?>">
                                <a href="<?= BASE_URL ?>/<?= e($p['slug']) ?>.php">
                                    <span><?= e($p['title']) ?></span>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>

                <!-- Office Contact Widget -->
                <div class="widget-contact-card">
                    <h4>Direct Advisory Desk</h4>
                    <p>Speak directly with our experienced consultants regarding <?= e($practice['title']) ?>.</p>
                    <div style="display:flex; flex-direction:column; gap:12px; font-size:0.92rem;">
                        <div>
                            <i class="fa fa-phone text-gold"></i> 
                            <strong>Phone:</strong> <?= e(get_setting('contact_landline', '+91 612 2999299')) ?>
                        </div>
                        <div>
                            <i class="fa fa-whatsapp text-gold"></i> 
                            <strong>WhatsApp:</strong> <?= e(get_setting('contact_mobile', '+91 7488961920')) ?> / 21
                        </div>
                        <div>
                            <i class="fa fa-envelope-o text-gold"></i> 
                            <strong>Email:</strong> <?= e(get_setting('contact_email', 'info@glowwell.in')) ?>
                        </div>
                        <div>
                            <i class="fa fa-map-marker text-gold"></i> 
                            <strong>Office:</strong> Exhibition Road, Patna
                        </div>
                    </div>
                    <a href="<?= BASE_URL ?>/enquiry.php?service=<?= urlencode($slug) ?>" class="btn btn-outline-gold open-consultation-modal" style="width: 100%; margin-top: 22px;">
                        Book Advisory Consultation
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
