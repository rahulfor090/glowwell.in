<?php
$page_title = "Online Enquiry & Cost Estimation | Glow Well Consultants Pvt. Ltd.";
$meta_desc = "Submit your trademark, patent, copyright, or ISO consultation enquiry online. Receive detailed cost estimations and filing procedures within 24 hours.";
require_once __DIR__ . '/config/settings.php';

$selected_service = $_GET['service'] ?? '';
$brand_query = $_GET['query'] ?? '';

include __DIR__ . '/includes/header.php';
?>

<!-- Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <div class="breadcrumb-nav">
                <a href="<?= BASE_URL ?>/index.php">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Enquiry &amp; Cost Estimation</span>
            </div>
            <h1 class="page-banner-title">Online Consultation &amp; Cost Enquiry</h1>
            <p class="page-banner-subtitle">
                Provide your requirements below to receive a formal quotation, statutory government fee breakdown, and filing roadmap from our senior attorneys.
            </p>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <!-- Notification Alerts -->
        <?php if (isset($_GET['success'])): ?>
            <div class="alert alert-success" style="margin-bottom: 30px;">
                <i class="fa fa-check-circle"></i> <strong>Consultation Request Submitted Successfully!</strong> Thank you for reaching out to Glow Well Consultants. Our legal department in Patna will review your case and contact you within 24 hours.
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="alert alert-danger" style="margin-bottom: 30px;">
                <i class="fa fa-exclamation-triangle"></i> <strong>Submission Incomplete:</strong> Please ensure all mandatory fields (*) are completed.
            </div>
        <?php endif; ?>

        <div class="layout-grid">
            <!-- Left Form Area -->
            <div class="form-card">
                <h2 style="font-size: 1.85rem; color: var(--primary); margin-bottom: 8px;">Case Evaluation &amp; Quotation Request</h2>
                <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 28px;">
                    All inquiries are treated with strict legal non-disclosure confidentiality.
                </p>

                <form action="<?= BASE_URL ?>/process_enquiry.php" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="source" value="enquiry_page">
                    <input type="hidden" name="return_url" value="<?= e($_SERVER['REQUEST_URI']) ?>">

                    <div class="form-row">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="name" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Full Name *</label>
                            <input type="text" id="name" name="name" class="form-control" placeholder="e.g. Anand Kumar" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="company" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Organization / Company Name</label>
                            <input type="text" id="company" name="company" class="form-control" placeholder="e.g. Acme Innovations Pvt Ltd">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="email" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Email Address *</label>
                            <input type="email" id="email" name="email" class="form-control" placeholder="name@company.com" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="phone" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Mobile / WhatsApp Number *</label>
                            <input type="tel" id="phone" name="phone" class="form-control" placeholder="+91 7488961920" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="service_interest" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Service of Interest *</label>
                            <select id="service_interest" name="service_interest" class="form-control" required>
                                <option value="">Select Service Area</option>
                                <option value="Trademark Registration" <?= $selected_service === 'trademark' ? 'selected' : '' ?>>Trademark Registration &amp; Search</option>
                                <option value="Patent Law & Filing" <?= $selected_service === 'patent' ? 'selected' : '' ?>>Patent Drafting &amp; Prosecution</option>
                                <option value="Copyright Protection" <?= $selected_service === 'copyright' ? 'selected' : '' ?>>Copyright Registration &amp; TM NOC</option>
                                <option value="Industrial Designs" <?= $selected_service === 'design' ? 'selected' : '' ?>>Industrial Design (Designs Act 2000)</option>
                                <option value="Geographical Indication" <?= $selected_service === 'geographical' ? 'selected' : '' ?>>Geographical Indication (GI Tagging)</option>
                                <option value="ISO Certification" <?= $selected_service === 'iso' ? 'selected' : '' ?>>ISO 9001 / 14001 / 27001 Certification</option>
                                <option value="Company Incorporation" <?= $selected_service === 'company' ? 'selected' : '' ?>>Pvt Ltd / LLP / Startup Incorporation</option>
                                <option value="Cyber Law Advisory" <?= $selected_service === 'cyber' ? 'selected' : '' ?>>Cyber Law &amp; Domain Disputes</option>
                                <option value="IP Litigation & Dispute" <?= $selected_service === 'litigation' ? 'selected' : '' ?>>IP Infringement &amp; Court Litigation</option>
                            </select>
                        </div>
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="subject" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Subject / Brand Name</label>
                            <input type="text" id="subject" name="subject" class="form-control" placeholder="e.g. Trademark Search for <?= e($brand_query ?: 'BrandName') ?>" value="<?= e($brand_query ? "Trademark search for '$brand_query'" : "") ?>">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 24px;">
                        <label for="message" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Case Particulars &amp; Specific Queries *</label>
                        <textarea id="message" name="message" class="form-control" rows="5" placeholder="Please describe your invention, goods/services manufactured, current status of usage, or specific legal questions..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                        <i class="fa fa-paper-plane"></i> Submit Formal Enquiry
                    </button>
                </form>
            </div>

            <!-- Right Sidebar Info -->
            <aside class="sidebar">
                <div class="widget-box">
                    <h3 class="widget-title">Why Enquire Online?</h3>
                    <ul style="display:flex; flex-direction:column; gap:16px; font-size:0.94rem; color:var(--text-muted);">
                        <li style="display:flex; gap:12px;">
                            <i class="fa fa-clock-o text-gold" style="font-size:1.2rem; margin-top:2px;"></i>
                            <div><strong>Rapid Response:</strong> Receive attorney review and itemized quotation within 24 hours.</div>
                        </li>
                        <li style="display:flex; gap:12px;">
                            <i class="fa fa-lock text-gold" style="font-size:1.2rem; margin-top:2px;"></i>
                            <div><strong>Complete Confidentiality:</strong> Your proprietary concepts and brand identities are protected under attorney-client privilege.</div>
                        </li>
                        <li style="display:flex; gap:12px;">
                            <i class="fa fa-calculator text-gold" style="font-size:1.2rem; margin-top:2px;"></i>
                            <div><strong>Clear Fee Breakdown:</strong> Transparent breakdown of official government filing fees and professional attorney charges.</div>
                        </li>
                    </ul>
                </div>

                <div class="widget-contact-card">
                    <h4>Prefer to Call Us?</h4>
                    <p>Speak directly with our consultancy desk right now:</p>
                    <div style="display:flex; flex-direction:column; gap:12px; font-size:0.92rem;">
                        <div><i class="fa fa-phone text-gold"></i> <?= e(get_setting('contact_landline', '+91 612 2999299')) ?></div>
                        <div><i class="fa fa-whatsapp text-gold"></i> <a href="https://wa.me/<?= e(get_setting('whatsapp_number', '917488961920')) ?>" target="_blank" style="color:inherit;">+91 7488961920 &amp; 21</a></div>
                        <div><i class="fa fa-envelope-o text-gold"></i> <a href="mailto:<?= e(get_setting('contact_email', 'info@glowwell.in')) ?>" style="color:inherit;"><?= e(get_setting('contact_email', 'info@glowwell.in')) ?></a></div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
