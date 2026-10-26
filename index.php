<?php
require_once __DIR__ . '/config/settings.php';

$page_title = get_setting('site_name', 'Glow Well Consultants Pvt. Ltd.') . " | Premier Patent, Trademark, IPR & Legal Consultancy";
$meta_desc = get_setting('footer_about', "Eastern India's leading attorney and consultancy firm for Patents, Trademarks, Copyrights, Designs, Geographical Indications, and ISO Certification based in Patna.");

$pdo = get_pdo();

// Fetch practices
$practices = $pdo->query("SELECT * FROM practices WHERE status = 'published' ORDER BY sort_order ASC")->fetchAll();

// Fetch testimonials
$testimonials = $pdo->query("SELECT * FROM testimonials WHERE status = 'published' ORDER BY sort_order ASC LIMIT 3")->fetchAll();

include __DIR__ . '/includes/header.php';
?>

<!-- Alert Feedback Messages -->
<?php if (isset($_GET['success'])): ?>
    <div class="container" style="margin-top: 24px;">
        <div class="alert alert-success">
            <i class="fa fa-check-circle"></i> <strong>Thank You!</strong> Your consultation request has been securely received. Our legal team will review your details and contact you shortly.
        </div>
    </div>
<?php endif; ?>

<?php if (isset($_GET['error'])): ?>
    <div class="container" style="margin-top: 24px;">
        <div class="alert alert-danger">
            <i class="fa fa-exclamation-triangle"></i> <strong>Notice:</strong> Please make sure all required fields are filled out correctly.
        </div>
    </div>
<?php endif; ?>

<!-- Hero Section -->
<section class="hero-section">
    <div class="hero-overlay-pattern"></div>
    <div class="container">
        <div class="hero-grid">
            <!-- Hero Left: Content -->
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="fa fa-shield"></i> <?= e(get_setting('hero_badge', '13+ Years of Management Consultancy & Regulatory Excellence (Est. 2011)')) ?>
                </div>
                <h1 class="hero-title">
                    <?= get_setting('hero_title', 'Empowering Business Growth. <br><span class="text-gold">Regulatory Compliance & Management System Implementation.</span> <br>Brand Asset Facilitation.') ?>
                </h1>
                <p class="hero-desc">
                    <?= e(get_setting('hero_desc', 'Glow Well Consultants Pvt Ltd (GCPL) is Eastern India\'s premier corporate management and regulatory consultancy firm. Incorporated in 2011, we guide startups, MSMEs, and established enterprises across ISO Management Systems, Barcode Registration, EPF & ESIC Social Security, and Brand Asset Facilitation.')) ?>
                </p>
                <div class="hero-actions">
                    <a href="#quick-consult" class="btn btn-primary btn-lg open-consultation-modal">
                        <i class="fa fa-calendar-check-o"></i> <?= e(get_setting('hero_btn1_text', 'Book Consultation')) ?>
                    </a>
                    <a href="<?= BASE_URL ?>/services.php" class="btn btn-outline-gold btn-lg">
                        <i class="fa fa-th-large"></i> <?= e(get_setting('hero_btn2_text', 'Explore Our Services')) ?>
                    </a>
                </div>
                <div class="hero-trust-list">
                    <div class="trust-item">
                        <i class="fa fa-check-circle"></i> <?= e(get_setting('trust_badge_1', 'Incorporated in 2011 (GCPL)')) ?>
                    </div>
                    <div class="trust-item">
                        <i class="fa fa-check-circle"></i> <?= e(get_setting('trust_badge_2', '3,500+ Businesses Advised')) ?>
                    </div>
                    <div class="trust-item">
                        <i class="fa fa-check-circle"></i> <?= e(get_setting('trust_badge_3', '100% Statutory Compliance')) ?>
                    </div>
                </div>
            </div>

            <!-- Hero Right: Quick Consultation Card -->
            <div class="hero-card" id="quick-consult">
                <div class="hero-card-header">
                    <h3>Request Advisory Session</h3>
                    <p>Speak directly with our experienced corporate consultants.</p>
                </div>
                <form action="<?= BASE_URL ?>/process_enquiry.php" method="POST" class="quick-enquiry-form">
                    <?= csrf_field() ?>
                    <input type="hidden" name="source" value="hero_card">
                    <input type="hidden" name="return_url" value="<?= e($_SERVER['REQUEST_URI']) ?>">

                    <div class="form-group">
                        <label for="hero_name">Full Name *</label>
                        <input type="text" id="hero_name" name="name" class="form-control" placeholder="Your Full Name" required>
                    </div>

                    <div class="form-group">
                        <label for="hero_phone">Mobile / WhatsApp Number *</label>
                        <input type="tel" id="hero_phone" name="phone" class="form-control" placeholder="+91 9876543210" required>
                    </div>

                    <div class="form-group">
                        <label for="hero_email">Email Address *</label>
                        <input type="email" id="hero_email" name="email" class="form-control" placeholder="name@company.com" required>
                    </div>

                    <div class="form-group">
                        <label for="hero_service">Service of Interest *</label>
                        <select id="hero_service" name="service_interest" class="form-control" required>
                            <option value="">Select Required Service</option>
                            <?php foreach ($practices as $p): ?>
                                <option value="<?= e($p['title']) ?>"><?= e($p['title']) ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; margin-top: 10px;">
                        <i class="fa fa-lock"></i> Request Consultation
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Stats Bar / Key Metrics Section -->
<section class="stats-section">
    <div class="container">
        <div class="stats-card-wrap">
            <div class="stat-item">
                <div class="stat-icon"><i class="fa fa-history"></i></div>
                <div>
                    <div class="stat-number"><?= e(get_setting('stats_years_num', '13+')) ?></div>
                    <div class="stat-label"><?= e(get_setting('stats_years_label', 'Years of Trust (Est. 2011)')) ?></div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="fa fa-briefcase"></i></div>
                <div>
                    <div class="stat-number"><?= e(get_setting('stats_cases_num', '3,500+')) ?></div>
                    <div class="stat-label"><?= e(get_setting('stats_cases_label', 'Businesses & Startups Advised')) ?></div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="fa fa-check-square-o"></i></div>
                <div>
                    <div class="stat-number"><?= e(get_setting('stats_success_num', '99.4%')) ?></div>
                    <div class="stat-label"><?= e(get_setting('stats_success_label', 'Audit Readiness & Compliance')) ?></div>
                </div>
            </div>
            <div class="stat-item">
                <div class="stat-icon"><i class="fa fa-users"></i></div>
                <div>
                    <div class="stat-number"><?= e(get_setting('stats_clients_num', '100%')) ?></div>
                    <div class="stat-label"><?= e(get_setting('stats_clients_label', 'Dedicated Advisory Support')) ?></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Practice Areas / Services Grid Section -->
<section class="section" id="services">
    <div class="container">
        <div class="section-header">
            <span class="section-badge"><?= e(get_setting('services_section_badge', 'Comprehensive Business Solutions')) ?></span>
            <h2 class="section-title"><?= e(get_setting('services_section_title', 'Our Core Consultancy & Compliance Services')) ?></h2>
            <p class="section-desc">
                <?= e(get_setting('services_section_desc', 'From management system certifications (ISO) and barcode allocation to social security filings and brand asset facilitation, we deliver end-to-end regulatory solutions for enterprises.')) ?>
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
                        Learn More &amp; FAQs <i class="fa fa-arrow-right"></i>
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- Trademark Search & Quick Brand Lookup Widget -->
<section class="container">
    <div class="search-widget-box">
        <div class="search-widget-inner">
            <div class="search-widget-text">
                <span class="section-badge" style="background: rgba(255,255,255,0.12); color: var(--accent-light);">
                    <?= e(get_setting('tm_box_badge', 'Brand Clearance & Asset Search')) ?>
                </span>
                <h3><?= e(get_setting('tm_box_title', 'Is Your Brand or Business Name Available?')) ?></h3>
                <p><?= e(get_setting('tm_box_desc', 'Protect your brand identity from conflicts. Enter your proposed trademark, brand name, or logo for an official Trade Marks Registry search and clearance report.')) ?></p>
            </div>
            <div class="search-widget-action">
                <div class="search-input-group">
                    <input type="text" id="tmSearchInput" placeholder="Enter Brand Name (e.g. MyBrand, EcoClean)..." aria-label="Brand name search">
                    <button class="btn btn-primary" id="tmSearchBtn" type="button">
                        <i class="fa fa-search"></i> Check Availability
                    </button>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Why Choose Glow Well Section -->
<section class="section section-bg">
    <div class="container">
        <div class="why-grid">
            <!-- Left: Visual Card -->
            <div class="why-image-card">
                <img src="<?= BASE_URL ?>/assets/images/why_consultancy.jpg" alt="Glow Well Corporate Management Consultancy" onerror="this.onerror=null; this.src='<?= BASE_URL ?>/assets/images/world_trans.png';">
                <div class="why-floating-badge">
                    <h4><?= e(get_setting('why_float_title', 'Trusted Since 2011')) ?></h4>
                    <p><?= e(get_setting('why_float_desc', 'Over 13 years of excellence in business management consultancy and regulatory compliance in Patna, Bihar.')) ?></p>
                </div>
            </div>

            <!-- Right: Content Features -->
            <div class="why-content">
                <span class="section-badge"><?= e(get_setting('why_badge', 'The GCPL Advantage')) ?></span>
                <h2 class="section-title"><?= e(get_setting('why_title', 'Why Enterprises & Startups Choose Glow Well')) ?></h2>
                <p class="section-desc" style="text-align: left; margin-bottom: 30px;">
                    <?= e(get_setting('why_desc', 'We do not merely consult for certificates; we help organizations structure robust management systems, ensure statutory compliance, and protect brand value for long-term growth.')) ?>
                </p>

                <div class="why-features">
                    <div class="why-feature-item">
                        <div class="feature-check"><i class="fa fa-certificate"></i></div>
                        <div class="feature-info">
                            <h4><?= e(get_setting('why_f1_title', 'ISO & System Certification Readiness')) ?></h4>
                            <p><?= e(get_setting('why_f1_desc', 'Complete preparation, gap analysis, and documentation support for ISO 9001, 14001, 22000, 45001, and HACCP certifications issued by accredited certification bodies.')) ?></p>
                        </div>
                    </div>

                    <div class="why-feature-item">
                        <div class="feature-check"><i class="fa fa-barcode"></i></div>
                        <div class="feature-info">
                            <h4><?= e(get_setting('why_f2_title', 'Barcode & Supply Chain Enablement')) ?></h4>
                            <p><?= e(get_setting('why_f2_desc', 'Seamless GS1 barcode registration, product allocation, and retail inventory setup for domestic and international markets.')) ?></p>
                        </div>
                    </div>

                    <div class="why-feature-item">
                        <div class="feature-check"><i class="fa fa-users"></i></div>
                        <div class="feature-info">
                            <h4><?= e(get_setting('why_f3_title', 'Social Security & Statutory Labor Compliance')) ?></h4>
                            <p><?= e(get_setting('why_f3_desc', 'End-to-end EPF and ESIC registration, monthly return filings, electronic challans, and complete labor law statutory compliance.')) ?></p>
                        </div>
                    </div>

                    <div class="why-feature-item">
                        <div class="feature-check"><i class="fa fa-handshake-o"></i></div>
                        <div class="feature-info">
                            <h4><?= e(get_setting('why_f4_title', 'Transparent Fixed-Fee Policy')) ?></h4>
                            <p><?= e(get_setting('why_f4_desc', 'Zero ambiguity with itemized statutory fees and consultancy milestones—ensuring cost efficiency for emerging startups and established enterprises.')) ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php if (get_setting('show_testimonials', '0') === '1' && !empty($testimonials)): ?>
<!-- Client Testimonials Section -->
<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge"><?= e(get_setting('testimonials_section_badge', 'Client Trust & Testimonials')) ?></span>
            <h2 class="section-title"><?= e(get_setting('testimonials_section_title', 'What Our Clients Say')) ?></h2>
            <p class="section-desc"><?= e(get_setting('testimonials_section_desc', 'Over 13 years of trusted partnership with corporations, institutions, and entrepreneurs.')) ?></p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
            <?php foreach ($testimonials as $t): ?>
                <div style="background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 32px; box-shadow: var(--shadow-sm); display:flex; flex-direction:column; justify-content:space-between;">
                    <div>
                        <div style="color: var(--accent); margin-bottom: 14px; font-size: 1.1rem;">
                            <?php for ($i = 0; $i < $t['rating']; $i++): ?>
                                <i class="fa fa-star"></i>
                            <?php endfor; ?>
                        </div>
                        <p style="font-style: italic; color: #475569; font-size: 0.98rem; line-height: 1.7; margin-bottom: 22px;">
                            "<?= e($t['feedback']) ?>"
                        </p>
                    </div>
                    <div style="border-top: 1px solid var(--border-color); padding-top: 16px;">
                        <strong style="color: var(--primary); font-size: 1.05rem; display:block; font-family: var(--font-serif);"><?= e($t['client_name']) ?></strong>
                        <span style="font-size: 0.85rem; color: var(--text-muted);"><?= e($t['client_role']) ?>, <?= e($t['company']) ?></span>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>

<?php include __DIR__ . '/includes/footer.php'; ?>
