<?php
require_once __DIR__ . '/config/settings.php';

$page_title = get_setting('about_meta_title', 'Who We Are | Glow Well Consultants Pvt Ltd (GCPL) | Management Consultancy Patna');
$meta_desc = get_setting('about_meta_desc', 'Learn about Glow Well Consultants Pvt Ltd (GCPL), incorporated in 2011 in Patna, Bihar. Over 13 years of excellence in ISO certifications, Barcode registration, EPF/ESIC compliances, and brand facilitation.');

$practices = get_active_practices();

include __DIR__ . '/includes/header.php';
?>

<!-- Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <div class="breadcrumb-nav">
                <a href="<?= BASE_URL ?>/index.php">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Who We Are</span>
            </div>
            <h1 class="page-banner-title">
                <?= e(get_setting('about_banner_title', 'Pioneering Business Management & Regulatory Compliance')) ?>
            </h1>
            <p class="page-banner-subtitle">
                <?= e(get_setting('about_banner_subtitle', 'Guiding enterprises, startups, and institutions with institutional rigor, statutory precision, and strategic foresight since 2011.')) ?>
            </p>
        </div>
    </div>
</div>

<!-- Main Content Layout -->
<section class="section">
    <div class="container">
        <div class="layout-grid">
            <!-- Left Main Column -->
            <article class="detail-article">
                <span class="section-badge"><?= e(get_setting('about_badge', 'Company Profile & Heritage')) ?></span>
                <h2><?= e(get_setting('about_title', 'Eastern India’s Trusted Corporate Management Consultancy (GCPL)')) ?></h2>
                
                <p>
                    <strong>Glow Well Consultants Pvt Ltd (GCPL)</strong> is a premier corporate management consultancy and statutory compliance advisory firm headquartered in Patna, Bihar, with nationwide operational capabilities. Incorporated in <strong>2011</strong>, the company was established to cater to the burgeoning needs of regulatory compliance, statutory governance, and operational standardization for both emerging startups and seasoned business houses.
                </p>
                <p>
                    For over <strong>13 years</strong>, our firm has served as a trusted partner for enterprises navigating the complexities of modern business administration. We provide comprehensive, end-to-end <strong>Consultancy, Gap Assessment, Standard Operating Procedure (SOP) Documentation, Statutory Registration Facilitation, and Lifecycle Implementation Support</strong>.
                </p>

                <!-- Consulting Philosophy Quote -->
                <div style="background: var(--bg-light); border-left: 4px solid var(--accent); padding: 22px 24px; border-radius: 0 var(--radius-md) var(--radius-md) 0; margin: 30px 0;">
                    <h3 style="font-size: 1.25rem; color: var(--primary); margin-bottom: 8px;">
                        <?= e(get_setting('about_quote_title', 'Our Consulting Philosophy')) ?>
                    </h3>
                    <p style="margin-bottom: 0; color: #475569; font-style: italic;">
                        <?= e(get_setting('about_quote_text', '"We enjoy an immense success rate across all our consulting assignments. We do not merely consult to achieve a statutory certificate; our mission is to elevate and fortify the overall business processes, brand integrity, and competitive defensibility of the organizations we serve."')) ?>
                    </p>
                </div>

                <!-- ============================================================
                     Leadership & Heritage Section
                     ============================================================ -->
                <div style="margin: 40px 0 35px;">
                    <span class="section-badge">Leadership &amp; Corporate Heritage</span>
                    <h2 style="margin-top: 10px; margin-bottom: 20px;">The Leadership Behind GCPL</h2>
                    <p style="color: var(--text-muted); margin-bottom: 25px;">
                        Founded by visionary leaders dedicated to academic rigor, scientific discipline, and corporate ethics, Glow Well Consultants Pvt Ltd combines deep multidisciplinary insights across science, business administration, and economics.
                    </p>

                    <!-- Memorial Card: Late Shri Ashok Kumar -->
                    <div style="background: linear-gradient(135deg, #f8fafc 0%, #edf2f7 100%); border: 1px solid #cbd5e1; border-left: 5px solid #081a36; border-radius: var(--radius-md); padding: 28px; margin-bottom: 26px; box-shadow: var(--shadow-sm);">
                        <div style="display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 12px; margin-bottom: 12px;">
                            <div>
                                <span style="display: inline-block; font-size: 0.76rem; font-weight: 800; text-transform: uppercase; letter-spacing: 0.08em; background: #081a36; color: #ffffff; padding: 3px 10px; border-radius: 4px; margin-bottom: 6px;">
                                    In Revered Memory &bull; Co-Founder &amp; Founding Director
                                </span>
                                <h3 style="font-size: 1.45rem; color: var(--primary); margin-bottom: 2px;">
                                    Late Shri Ashok Kumar
                                </h3>
                                <div style="font-size: 0.92rem; color: var(--accent-hover); font-weight: 700;">
                                    Master of Science (Physics) &bull; 1974 &ndash; 2021
                                </div>
                            </div>
                            <div style="color: #64748b; font-size: 0.88rem; font-style: italic; background: rgba(255,255,255,0.7); padding: 6px 12px; border-radius: 4px; border: 1px solid #e2e8f0;">
                                <i class="fa fa-heart" style="color: #ef4444;"></i> Remembering His Enduring Legacy
                            </div>
                        </div>
                        <p style="color: #334155; font-size: 0.95rem; line-height: 1.7; margin-bottom: 0;">
                            A visionary mentor gifted with profound scientific acumen and analytical precision, Late Shri Ashok Kumar was the founding pillar of Glow Well Consultants Pvt Ltd in 2011. As elder brother and co-founder, his moral clarity, methodical thinking, and unwavering dedication to institutional excellence laid the foundational ethos of GCPL. Tragically, he was called to heavenly abode during the COVID-19 pandemic on <strong>27th May 2021</strong>. His founding principles of uncompromising integrity, intellectual rigor, and compassionate guidance remain the permanent lodestar guiding every operation of our company.
                        </p>
                    </div>

                    <!-- Grid of Current Directors -->
                    <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 24px; margin-top: 20px;">
                        <!-- Director: Mrs. Amrita -->
                        <div style="background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 24px; box-shadow: var(--shadow-sm); border-top: 4px solid var(--accent);">
                            <span style="font-size: 0.74rem; font-weight: 700; color: var(--accent-hover); text-transform: uppercase; letter-spacing: 0.06em; display: block; margin-bottom: 4px;">
                                Co-Founder &amp; Director
                            </span>
                            <h3 style="font-size: 1.25rem; color: var(--primary); margin-bottom: 4px;">Mrs. Amrita</h3>
                            <div style="font-size: 0.88rem; color: var(--text-muted); font-weight: 600; margin-bottom: 14px;">
                                MBA (HR + Marketing)
                            </div>
                            <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin-bottom: 0;">
                                Steering GCPL since its incorporation in 2011, Mrs. Amrita brings extensive strategic management expertise in organizational behavior, human resources, and client relations. She directs executive management, stakeholder communications, and compliance service delivery across all corporate domains.
                            </p>
                        </div>

                        <!-- Director: Mrs. Ambuj Kumari -->
                        <div style="background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-md); padding: 24px; box-shadow: var(--shadow-sm); border-top: 4px solid var(--primary);">
                            <span style="font-size: 0.74rem; font-weight: 700; color: var(--primary); text-transform: uppercase; letter-spacing: 0.06em; display: block; margin-bottom: 4px;">
                                Director
                            </span>
                            <h3 style="font-size: 1.25rem; color: var(--primary); margin-bottom: 4px;">Mrs. Ambuj Kumari</h3>
                            <div style="font-size: 0.88rem; color: var(--text-muted); font-weight: 600; margin-bottom: 14px;">
                                Master of Arts (Economics)
                            </div>
                            <p style="font-size: 0.92rem; color: #475569; line-height: 1.65; margin-bottom: 0;">
                                Inducted onto the Board of Directors, Mrs. Ambuj Kumari enriches GCPL with macro-economic analysis, fiscal policy interpretation, and corporate compliance insight. She oversees statutory alignment, MSME economic advisory frameworks, and institutional business growth.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- ============================================================
                     Core Consultancy Domains
                     ============================================================ -->
                <h2>Our Core Practice Capabilities</h2>
                <p>
                    Glow Well Consultants Pvt Ltd (GCPL) provides specialized consulting services designed to optimize management processes, ensure full statutory adherence, and secure commercial brand assets:
                </p>

                <ul style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin: 25px 0 35px;">
                    <?php foreach ($practices as $p): ?>
                        <li style="background: var(--bg-subtle); padding: 16px 18px; border-radius: var(--radius-sm); border-left: 3px solid var(--accent);">
                            <a href="<?= BASE_URL ?>/<?= e($p['slug']) ?>.php" style="color:var(--primary); font-weight:700; font-size:1rem; display:block; margin-bottom:4px;">
                                <i class="fa <?= e($p['icon'] ?? 'fa-check') ?> text-gold"></i> <?= e($p['title']) ?>
                            </a>
                            <span style="font-size: 0.88rem; color: var(--text-muted); line-height: 1.5; display:block;">
                                <?= e($p['short_description']) ?>
                            </span>
                        </li>
                    <?php endforeach; ?>
                </ul>

                <!-- ============================================================
                     Our 4-Stage Corporate Engagement Model
                     ============================================================ -->
                <h2>Our 4-Stage Corporate Engagement Model</h2>
                <div style="display: flex; flex-direction: column; gap: 20px; margin-top: 24px;">
                    <div style="display: flex; gap: 18px; align-items: flex-start; padding: 20px; background: var(--bg-subtle); border-radius: var(--radius-md);">
                        <span style="font-size: 1.5rem; font-weight: 800; color: var(--accent); width: 36px; flex-shrink: 0;">01</span>
                        <div>
                            <h4 style="font-size: 1.15rem; color: var(--primary); margin-bottom: 4px;">
                                Comprehensive Diagnostic &amp; Gap Assessment
                            </h4>
                            <p style="margin-bottom: 0; font-size: 0.94rem; color: var(--text-muted);">
                                We conduct an initial evaluation of your existing business processes, quality standards, statutory registrations, or brand names to identify compliance gaps, conflicts, and optimization pathways before any major expenditure.
                            </p>
                        </div>
                    </div>

                    <div style="display: flex; gap: 18px; align-items: flex-start; padding: 20px; background: var(--bg-subtle); border-radius: var(--radius-md);">
                        <span style="font-size: 1.5rem; font-weight: 800; color: var(--accent); width: 36px; flex-shrink: 0;">02</span>
                        <div>
                            <h4 style="font-size: 1.15rem; color: var(--primary); margin-bottom: 4px;">
                                SOP Drafting &amp; Management Documentation
                            </h4>
                            <p style="margin-bottom: 0; font-size: 0.94rem; color: var(--text-muted);">
                                Precision drafting of Standard Operating Procedures (SOPs), Quality Manuals (for ISO), statutory wage records (for EPF/ESIC), GS1 product catalogs (for Barcode), or trademark specifications in compliance with regulatory mandates.
                            </p>
                        </div>
                    </div>

                    <div style="display: flex; gap: 18px; align-items: flex-start; padding: 20px; background: var(--bg-subtle); border-radius: var(--radius-md);">
                        <span style="font-size: 1.5rem; font-weight: 800; color: var(--accent); width: 36px; flex-shrink: 0;">03</span>
                        <div>
                            <h4 style="font-size: 1.15rem; color: var(--primary); margin-bottom: 4px;">
                                Procedural Filing &amp; Departmental Facilitation
                            </h4>
                            <p style="margin-bottom: 0; font-size: 0.94rem; color: var(--text-muted);">
                                Seamless procedural submission of documentation through respective government and standards portals (MCA, EPFO, ESIC, GS1 India, and Trademark Registry) with active monitoring of departmental acknowledgments.
                            </p>
                        </div>
                    </div>

                    <div style="display: flex; gap: 18px; align-items: flex-start; padding: 20px; background: var(--bg-subtle); border-radius: var(--radius-md);">
                        <span style="font-size: 1.5rem; font-weight: 800; color: var(--accent); width: 36px; flex-shrink: 0;">04</span>
                        <div>
                            <h4 style="font-size: 1.15rem; color: var(--primary); margin-bottom: 4px;">
                                Implementation, Audit Readiness &amp; Maintenance
                            </h4>
                            <p style="margin-bottom: 0; font-size: 0.94rem; color: var(--text-muted);">
                                Internal audit preparation for third-party certification audits, monthly ECR challan generation, brand asset commercialization guidance, and timely statutory renewals for sustained enterprise longevity.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- ============================================================
                     Statutory Regulatory Notice & Corporate Disclaimer
                     ============================================================ -->
                <div style="margin-top: 35px; padding: 22px 24px; background: #fffbeb; border: 1px solid #fef3c7; border-left: 4px solid #d97706; border-radius: var(--radius-md); font-size: 0.88rem; color: #78350f; line-height: 1.7;">
                    <strong style="display: block; font-size: 0.92rem; color: #92400e; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em;">
                        <i class="fa fa-info-circle"></i> Statutory Regulatory Notice &amp; Bar Council Compliance Statement
                    </strong>
                    <p style="margin-bottom: 8px;">
                        <strong>Glow Well Consultants Pvt Ltd (GCPL)</strong> is an independent corporate management consultancy company incorporated in 2011 under the Companies Act (CIN: [U74140BR2011PTC017326 / Under ROC Records]).
                    </p>
                    <p style="margin-bottom: 8px;">
                        In strict adherence to Rule 36 of the Bar Council of India (BCI) Rules and Section 35 of the Advocates Act, 1961, <strong>GCPL is not a law firm</strong> and does not practice law, engage in litigation advocacy, or solicit legal work. All intellectual property services offered by GCPL are strictly confined to procedural facilitation, brand clearance search assistance, document preparation, and commercial monetization guidance. Any contentious dispute representation, hearings before statutory tribunals, or courtroom litigation are referred to or handled exclusively by clients' own independent legal counsel.
                    </p>
                    <p style="margin-bottom: 0;">
                        Management System certifications (ISO 9001, 14001, 22000, 45001) are awarded solely by accredited third-party Certification Bodies; GCPL provides professional consultancy, documentation, and implementation support to prepare organizations for audit readiness.
                    </p>
                </div>

                <!-- Consultation CTA Banner -->
                <div style="margin-top: 40px; padding: 30px; background: var(--navy-grad); border-radius: var(--radius-lg); color: #ffffff; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 20px;">
                    <div>
                        <h3 style="color: #ffffff; font-size: 1.5rem; margin-bottom: 6px;">Consult With Our Corporate Advisory Team</h3>
                        <p style="color: #cbd5e1; font-size: 0.94rem; margin-bottom: 0;">Visit our Patna head office or schedule a consultation today.</p>
                    </div>
                    <a href="<?= BASE_URL ?>/enquiry.php" class="btn btn-primary open-consultation-modal">
                        <i class="fa fa-calendar"></i> Book Advisory Session
                    </a>
                </div>
            </article>

            <!-- Sidebar -->
            <aside class="sidebar">
                <!-- Key Services Widget -->
                <div class="widget-box">
                    <h3 class="widget-title">Key Services</h3>
                    <ul class="widget-links">
                        <?php foreach ($practices as $p): ?>
                            <li>
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
                    <h4>Direct Assistance</h4>
                    <p>Contact our Patna head office for prompt evaluation of your regulatory and compliance requirements.</p>
                    <div style="display:flex; flex-direction:column; gap:12px; font-size:0.92rem;">
                        <div>
                            <i class="fa fa-phone text-gold"></i> <strong>Landline:</strong> <?= e(get_setting('contact_landline', '+91 612 2999299')) ?>
                        </div>
                        <div>
                            <i class="fa fa-whatsapp text-gold"></i> <strong>WhatsApp:</strong> <?= e(get_setting('contact_mobile', '+91 7488961920')) ?> / 21
                        </div>
                        <div>
                            <i class="fa fa-envelope-o text-gold"></i> <strong>Email:</strong> <?= e(get_setting('contact_email', 'info@glowwell.in')) ?>
                        </div>
                        <div>
                            <i class="fa fa-clock-o text-gold"></i> <strong>Hours:</strong> Mon &ndash; Sat: 10:00 AM &ndash; 7:00 PM
                        </div>
                    </div>
                    <a href="<?= BASE_URL ?>/contact.php" class="btn btn-outline-gold" style="width: 100%; margin-top: 22px;">
                        Contact Head Office
                    </a>
                </div>

                <!-- Quick Download Widget -->
                <div class="widget-box" style="margin-top: 30px; background: #f8fafc;">
                    <h3 class="widget-title" style="font-size: 1.15rem;">Corporate Information</h3>
                    <p style="font-size: 0.88rem; color: var(--text-muted); line-height: 1.6; margin-bottom: 12px;">
                        <strong>Entity:</strong> Glow Well Consultants Pvt. Ltd. (GCPL)<br>
                        <strong>Year of Inc.:</strong> 2011<br>
                        <strong>Headquarters:</strong> Patna, Bihar, India
                    </p>
                    <a href="<?= BASE_URL ?>/downloads.php" style="font-size: 0.88rem; font-weight: 700; color: var(--accent-hover);">
                        <i class="fa fa-download"></i> View Compliance Resources &rarr;
                    </a>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
