<?php
$settings = get_all_settings();
?>
<!-- Footer Top Consultation Banner -->
<section class="footer-top-banner">
    <div class="container">
        <div class="footer-top-inner">
            <div>
                <h3><?= e(get_setting('footer_cta_title', 'Ready to Protect Your Intellectual Property & Business Assets?')) ?></h3>
                <p style="color: #1e293b; font-size: 0.96rem; margin-top: 4px;">
                    <?= e(get_setting('footer_cta_desc', 'Get in touch with our certified legal consultants in Patna for strategic advice and cost estimation.')) ?>
                </p>
            </div>
            <div style="display: flex; gap: 14px; flex-wrap: wrap;">
                <a href="<?= BASE_URL ?>/enquiry.php" class="btn btn-navy open-consultation-modal">
                    <i class="fa fa-calendar-check-o"></i> Book Consultation
                </a>
                <a href="tel:<?= preg_replace('/[^0-9+]/', '', get_setting('contact_landline', '+916122999299')) ?>" class="btn btn-outline" style="border-color: #040d1c; color: #040d1c;">
                    <i class="fa fa-phone"></i> Call <?= e(get_setting('contact_landline', '+91 612 2999299')) ?>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- Main Site Footer -->
<footer class="site-footer" id="footer" role="contentinfo">
    <div class="container footer-main">
        <div class="footer-grid">
            <!-- Col 1: Brand Info -->
            <div class="footer-brand">
                <a href="<?= BASE_URL ?>/index.php" style="display: inline-flex; align-items: center; gap: 10px;">
                    <img src="<?= BASE_URL ?>/assets/images/logo_s.png" alt="Glow Well" style="height: 52px; width: auto;" onerror="this.onerror=null; this.src='<?= BASE_URL ?>/assets/images/logo_g.png';">
                    <span style="font-family: var(--font-serif); font-size: 1.15rem; font-weight: 800; color: #ffffff; line-height: 1.25;">Glow Well Consultants Pvt. Ltd. <small style="display:block; font-size:0.75rem; color:var(--accent-light); font-weight:600; letter-spacing:0.05em; margin-top:2px;">(GCPL - Est. 2011)</small></span>
                </a>
                <p>
                    <?= e(get_setting('footer_about', 'Glow Well Consultants Pvt Ltd (GCPL) is a premier corporate management consultancy firm incorporated in 2011. Headquartered in Patna, Bihar, we specialize in Management System Certification (ISO), GS1 Barcode Registration, EPF & ESIC Social Security Compliances, and Brand Asset Facilitation (Trademark, Copyright & Designs).')) ?>
                </p>
                <div style="margin: 14px 0 18px; padding: 10px 14px; background: rgba(255,255,255,0.05); border-radius: var(--radius-sm); font-size: 0.82rem; color: #cbd5e1; line-height: 1.6;">
                    <div><strong>CIN:</strong> <?= e(get_setting('company_cin', 'U74140BR2011PTC017326')) ?></div>
                    <!--<div><strong>GSTIN:</strong> <?= e(get_setting('company_gstin', '[10AAACG....]')) ?></div>-->
                </div>
                <div class="footer-socials">
                    <a href="https://wa.me/<?= e(get_setting('whatsapp_number', '917488961920')) ?>" target="_blank" class="social-link" title="WhatsApp"><i class="fa fa-whatsapp"></i></a>
                    <a href="mailto:<?= e(get_setting('contact_email', 'info@glowwell.in')) ?>" class="social-link" title="Email Us"><i class="fa fa-envelope"></i></a>
                    <a href="tel:<?= preg_replace('/[^0-9+]/', '', get_setting('contact_landline', '+916122999299')) ?>" class="social-link" title="Call Us"><i class="fa fa-phone"></i></a>
                    <a href="<?= e(get_setting('facebook', 'https://facebook.com/glowwell')) ?>" target="_blank" class="social-link" title="Facebook"><i class="fa fa-facebook"></i></a>
                    <a href="<?= e(get_setting('linkedin', 'https://linkedin.com/company/glowwell')) ?>" target="_blank" class="social-link" title="LinkedIn"><i class="fa fa-linkedin"></i></a>
                </div>
            </div>

            <!-- Col 2: Quick Links -->
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="<?= BASE_URL ?>/index.php"><i class="fa fa-angle-right"></i> Home</a></li>
                    <li><a href="<?= BASE_URL ?>/who.php"><i class="fa fa-angle-right"></i> Who We Are</a></li>
                    <li><a href="<?= BASE_URL ?>/services.php"><i class="fa fa-angle-right"></i> All Practice Areas</a></li>
                    <li><a href="<?= BASE_URL ?>/career.php"><i class="fa fa-angle-right"></i> Careers &amp; Jobs</a></li>
                    <li><a href="<?= BASE_URL ?>/blog.php"><i class="fa fa-angle-right"></i> Industry Blog &amp; Insights</a></li>
                    <li><a href="<?= BASE_URL ?>/contact.php"><i class="fa fa-angle-right"></i> Contact Patna Office</a></li>
                    <li><a href="<?= BASE_URL ?>/login.php"><i class="fa fa-angle-right"></i> Staff / Client Portal</a></li>
                </ul>
            </div>

            <!-- Col 3: Key Services -->
            <div class="footer-col">
                <h4>Key Services</h4>
                <ul class="footer-links">
                    <?php 
                    $foot_practices = array_slice(get_active_practices(), 0, 8);
                    foreach ($foot_practices as $fp): 
                    ?>
                        <li><a href="<?= BASE_URL ?>/<?= e($fp['slug']) ?>.php"><i class="fa fa-angle-right"></i> <?= e($fp['title']) ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Col 4: Patna Head Office Contact Details -->
            <div class="footer-col">
                <h4>Head Office</h4>
                <ul class="footer-contact-info">
                    <li>
                        <i class="fa fa-map-marker"></i>
                        <span>
                            <strong>2nd Floor, Mohini Market</strong><br>
                            Near SBI Exhibition Road Branch,<br>
                            Opp. Hotel Gargee Grand, Exhibition Road, Patna - 800001, Bihar, India
                        </span>
                    </li>
                    <li>
                        <i class="fa fa-phone"></i>
                        <span>
                            <strong>Landline:</strong> <?= e(get_setting('contact_landline', '+91 612 2999299')) ?><br>
                            <strong>Mobile:</strong> <a href="tel:+917488961920">+91 7488961920</a> &amp; <a href="tel:+917488961921">21</a>
                        </span>
                    </li>
                    <li>
                        <i class="fa fa-whatsapp"></i>
                        <span>
                            <a href="https://wa.me/<?= e(get_setting('whatsapp_number', '917488961920')) ?>" target="_blank" style="color: #4ade80;">
                                +91 7488961920 (Instant Chat)
                            </a>
                        </span>
                    </li>
                    <li>
                        <i class="fa fa-envelope-o"></i>
                        <span>
                            <a href="mailto:<?= e(get_setting('contact_email', 'info@glowwell.in')) ?>"><?= e(get_setting('contact_email', 'info@glowwell.in')) ?></a>
                        </span>
                    </li>
                    <li>
                        <i class="fa fa-clock-o"></i>
                        <span>
                            Monday – Saturday: 10:00 AM – 7:00 PM<br>
                            Sunday: Closed
                        </span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Google Maps Embed -->
        <div style="margin-top: 50px; border-radius: var(--radius-lg); overflow: hidden; border: 1px solid rgba(255,255,255,0.12); box-shadow: var(--shadow-lg);">
            <iframe 
                src="<?= e(get_setting('map_embed', 'https://maps.google.com/maps?q=2nd+Floor,+Mohini+Market,+Near+SBI+Exhibition+Road+Branch,+Opp.+Hotel+Gargee+Grand,+Exhibition+Road,+Patna+-+800001,+Bihar,+India&t=&z=16&ie=UTF8&iwloc=&output=embed')) ?>" 
                width="100%" 
                height="320" 
                style="border:0; display:block;" 
                allowfullscreen="" 
                loading="lazy"
                title="Glow Well Patna Office Location Map">
            </iframe>
        </div>

        <!-- Statutory Regulatory Notice & Corporate Disclaimer -->
        <div style="margin-top: 35px; padding: 20px 24px; background: rgba(255, 255, 255, 0.04); border-left: 4px solid var(--accent); border-radius: var(--radius-sm); font-size: 0.83rem; color: #94a3b8; line-height: 1.65;">
            <strong style="color: #f8fafc; display: block; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.05em; font-size: 0.82rem;">
                <i class="fa fa-info-circle text-gold"></i> Statutory Regulatory Notice &amp; Bar Council Compliance Disclaimer:
            </strong>
            Glow Well Consultants Pvt Ltd (GCPL) is a separate corporate business management consultancy and advisory company incorporated in 2011 under the Companies Act (CIN: [U74140BR2011PTC017326 / Under ROC Records]). GCPL is <strong>not a law firm</strong> and does not engage in legal practice, advocacy, or solicitation of work under Rule 36 of the Bar Council of India (BCI) Rules and the Advocates Act, 1961. Intellectual Property services are strictly confined to procedural facilitation, brand clearance search assistance, document preparation, and commercial monetization guidance; contentious dispute representation and litigation are handled exclusively by clients' own independent legal counsel. Management System certifications (ISO 9001, 14001, etc.) are officially awarded by accredited third-party certification bodies; GCPL provides consultancy, process documentation, and implementation support.
        </div>
    </div>

    <!-- Bottom Copyright Bar -->
    <div class="footer-bottom">
        <div class="container footer-bottom-inner">
            <p>&copy; <?= date('Y') ?> Glow Well Consultants Pvt. Ltd. (GCPL). All Rights Reserved.</p>
            <p>
                Corporate Management Consultancy &bull; ISO Systems &bull; Barcode Registration &bull; EPF &amp; ESIC Compliances &bull; Brand Asset Facilitation
            </p>
        </div>
    </div>
</footer>

<!-- Modals & Widgets -->
<?php include __DIR__ . '/enquiry-modal.php'; ?>
<?php include __DIR__ . '/whatsapp-widget.php'; ?>

<!-- Main JavaScript -->
<script src="<?= BASE_URL ?>/assets/js/main.js"></script>

</body>
</html>
