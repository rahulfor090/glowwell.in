<?php
$page_title = "Contact Us | Glow Well Consultants Pvt. Ltd. | Exhibition Road, Patna";
$meta_desc = "Get in touch with Glow Well Consultants Pvt. Ltd. in Patna, Bihar. Office address: 201 Mohini Market, Exhibition Road. Landline: +91 612 2999299, Mobile / WhatsApp: +91 7488961920 / 21.";
require_once __DIR__ . '/config/settings.php';
include __DIR__ . '/includes/header.php';
?>

<!-- Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <div class="breadcrumb-nav">
                <a href="<?= BASE_URL ?>/index.php">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Contact Us</span>
            </div>
            <h1 class="page-banner-title">Contact Our Patna Head Office</h1>
            <p class="page-banner-subtitle">
                Visit our corporate office on Exhibition Road or reach out to our legal advisory team via phone, WhatsApp, or online message.
            </p>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <!-- Contact Cards Row -->
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px; margin-bottom: 50px;">
            <div style="background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 32px; box-shadow: var(--shadow-sm); text-align: center;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--accent-soft); color: var(--accent); display: inline-flex; align-items: center; justify-content: center; font-size: 1.6rem; margin-bottom: 18px;">
                    <i class="fa fa-map-marker"></i>
                </div>
                <h3 style="font-size: 1.25rem; color: var(--primary); margin-bottom: 8px;">Patna Head Office</h3>
                <p style="color: var(--text-muted); font-size: 0.94rem; line-height: 1.6; margin: 0;">
                    201, 2nd Floor, Mohini Market,<br>
                    (SBI Exhibition Road Branch),<br>
                    Opp Hotel Gargee Grand, Near HAI COMPLEX,<br>
                    Exhibition Road, Patna - 800001, Bihar, India
                </p>
            </div>

            <div style="background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 32px; box-shadow: var(--shadow-sm); text-align: center;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--accent-soft); color: var(--accent); display: inline-flex; align-items: center; justify-content: center; font-size: 1.6rem; margin-bottom: 18px;">
                    <i class="fa fa-phone"></i>
                </div>
                <h3 style="font-size: 1.25rem; color: var(--primary); margin-bottom: 8px;">Direct Telephone Lines</h3>
                <p style="color: var(--text-muted); font-size: 0.94rem; line-height: 1.6; margin: 0;">
                    <strong>Landline:</strong> <?= e(get_setting('contact_landline', '+91 612 2999299')) ?><br>
                    <strong>WhatsApp / Mobile:</strong><br>
                    <a href="tel:+917488961920" style="color: var(--primary); font-weight: 600;">+91 7488961920</a> &amp; 
                    <a href="tel:+917488961921" style="color: var(--primary); font-weight: 600;">21</a><br>
                    <a href="https://wa.me/917488961920" target="_blank" style="color: #16a34a; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; margin-top: 4px;">
                        <i class="fa fa-whatsapp"></i> Chat on WhatsApp
                    </a>
                </p>
            </div>

            <div style="background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 32px; box-shadow: var(--shadow-sm); text-align: center;">
                <div style="width: 60px; height: 60px; border-radius: 50%; background: var(--accent-soft); color: var(--accent); display: inline-flex; align-items: center; justify-content: center; font-size: 1.6rem; margin-bottom: 18px;">
                    <i class="fa fa-envelope-o"></i>
                </div>
                <h3 style="font-size: 1.25rem; color: var(--primary); margin-bottom: 8px;">Official Email Desks</h3>
                <p style="color: var(--text-muted); font-size: 0.94rem; line-height: 1.6; margin: 0;">
                    <strong>Email:</strong> <a href="mailto:<?= e(get_setting('contact_email', 'info@glowwell.in')) ?>" style="color: var(--primary); font-weight: 600;"><?= e(get_setting('contact_email', 'info@glowwell.in')) ?></a><br>
                    <span style="display:inline-block; margin-top:8px; font-size:0.85rem; color:var(--accent-hover);">
                        <i class="fa fa-clock-o"></i> Mon–Sat: 10:00 AM – 7:00 PM
                    </span>
                </p>
            </div>
        </div>

        <!-- Form and Map Split -->
        <div class="layout-grid">
            <div class="form-card">
                <span class="section-badge">Get in Touch</span>
                <h2 style="font-size: 1.85rem; color: var(--primary); margin-bottom: 8px;">Send a Direct Message</h2>
                <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 24px;">
                    Fill out the form below and an attorney will respond promptly.
                </p>

                <?php if (isset($_GET['success'])): ?>
                    <div class="alert alert-success">
                        <i class="fa fa-check-circle"></i> <strong>Message Received!</strong> We have received your communication and will reply shortly.
                    </div>
                <?php endif; ?>

                <form action="<?= BASE_URL ?>/process_enquiry.php" method="POST">
                    <?= csrf_field() ?>
                    <input type="hidden" name="source" value="contact_page">
                    <input type="hidden" name="return_url" value="<?= e($_SERVER['REQUEST_URI']) ?>">

                    <div class="form-row">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="contact_name" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Your Name *</label>
                            <input type="text" id="contact_name" name="name" class="form-control" placeholder="Full Name" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="contact_phone" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Phone / WhatsApp *</label>
                            <input type="tel" id="contact_phone" name="phone" class="form-control" placeholder="+91 7488961920" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="contact_email" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Email Address *</label>
                            <input type="email" id="contact_email" name="email" class="form-control" placeholder="name@company.com" required>
                        </div>
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="contact_service" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Service Area</label>
                            <select id="contact_service" name="service_interest" class="form-control">
                                <option value="General Consultation">General Legal Consultation</option>
                                <option value="Trademark Registration">Trademark Registration</option>
                                <option value="Patent Law & Filing">Patent Prosecution</option>
                                <option value="Copyright Protection">Copyright Protection</option>
                                <option value="Industrial Designs">Industrial Designs</option>
                                <option value="Geographical Indication">Geographical Indication</option>
                                <option value="ISO Certification">ISO Certification</option>
                                <option value="Company Incorporation">Company Incorporation</option>
                                <option value="IP Litigation & Dispute">IP Litigation</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 22px;">
                        <label for="contact_message" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Your Message *</label>
                        <textarea id="contact_message" name="message" class="form-control" rows="4" placeholder="How can our attorneys assist you?" required></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                        <i class="fa fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>

            <!-- Map Area -->
            <div>
                <div style="background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-lg); overflow: hidden; box-shadow: var(--shadow-sm); height: 100%; display: flex; flex-direction: column;">
                    <div style="padding: 24px; border-bottom: 1px solid var(--border-color);">
                        <h3 style="font-size: 1.35rem; color: var(--primary); margin-bottom: 4px;">Interactive Location Map</h3>
                        <p style="color: var(--text-muted); font-size: 0.88rem; margin: 0;">Located at Mohini Market, opposite Hotel Gargee Grand, Exhibition Road, Patna.</p>
                    </div>
                    <div style="flex-grow: 1; min-height: 380px;">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m23!1m12!1m3!1d115128.33215753247!2d85.07362666644445!3d25.61287751229096!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!4m8!3e6!4m0!4m5!1s0x39ed59770d942f5d%3A0x3fe4b3ce4474f7b9!2sCopyright+Registration+in+Patna+-Glow+Well%2C+M%2FS+GLOW+WELL%2C+201%2C+2nd+Floor%2C+Mohini+Market%2C+Near+Hai+Complex+(SBI+ATM+Opp.+Hotel+Gargee+grand%2C+Exhibition+Rd%2C+Patna%2C+Bihar+800001!3m2!1d25.6128942!2d85.143667!5e0!3m2!1sen!2sin!4v1531109383735" 
                            width="100%" 
                            height="100%" 
                            style="border:0; min-height: 380px;" 
                            allowfullscreen="" 
                            loading="lazy"
                            title="Patna Office Map">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
