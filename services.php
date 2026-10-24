<?php
$page_title = "Our Consultancy & Compliance Services | Glow Well Consultants Pvt Ltd (GCPL)";
$meta_desc = "Explore comprehensive management consultancy services by GCPL: ISO Management Systems, GS1 Barcode Registration, EPF & ESIC Compliances, Company Incorporation, and Brand Asset Facilitation.";
require_once __DIR__ . '/config/settings.php';

$pdo = get_pdo();
$practices = $pdo->query("SELECT * FROM practices WHERE status = 'published' ORDER BY sort_order ASC")->fetchAll();

include __DIR__ . '/includes/header.php';
?>

<!-- Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <div class="breadcrumb-nav">
                <a href="<?= BASE_URL ?>/index.php">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Services</span>
            </div>
            <h1 class="page-banner-title">Our Consultancy &amp; Compliance Services</h1>
            <p class="page-banner-subtitle">
                Delivering strategic management systems, statutory compliance filings, and brand asset facilitation across the entire enterprise lifecycle.
            </p>
        </div>
    </div>
</div>

<!-- Services Grid Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Enterprise Solutions</span>
            <h2 class="section-title">Specialized Management &amp; Regulatory Services</h2>
            <p class="section-desc">
                Select a service area below to explore statutory requirements, detailed procedures, and frequently asked business questions.
            </p>
        </div>

        <div class="services-grid">
            <?php foreach ($practices as $p): ?>
                <div class="service-card">
                    <div class="service-icon-wrap">
                        <i class="fa <?= e($p['icon'] ?? 'fa-briefcase') ?>"></i>
                    </div>
                    <h3 class="service-title">
                        <a href="<?= BASE_URL ?>/<?= e($p['slug']) ?>.php"><?= e($p['title']) ?></a>
                    </h3>
                    <p class="service-desc"><?= e($p['short_description']) ?></p>
                    <a href="<?= BASE_URL ?>/<?= e($p['slug']) ?>.php" class="service-link">
                        Explore Service &amp; FAQs <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Bottom CTA Section -->
<section class="section section-bg">
    <div class="container" style="text-align: center; max-width: 800px;">
        <span class="section-badge">Customized Solutions</span>
        <h2 class="section-title" style="margin-bottom: 16px;">Ready to Elevate Your Business Systems?</h2>
        <p class="section-desc" style="margin-bottom: 30px;">
            Whether you are a budding startup, an expanding MSME, or an established enterprise, our corporate consultants will structure an efficient compliance and management system tailored to your organizational goals.
        </p>
        <div style="display: inline-flex; gap: 16px; flex-wrap: wrap; justify-content: center;">
            <a href="<?= BASE_URL ?>/enquiry.php" class="btn btn-primary btn-lg open-consultation-modal">
                <i class="fa fa-calendar-check-o"></i> Book Advisory Session
            </a>
            <a href="<?= BASE_URL ?>/contact.php" class="btn btn-navy btn-lg">
                <i class="fa fa-map-marker"></i> Visit Patna Head Office
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
