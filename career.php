<?php
$page_title = "Careers & Legal Vacancies | Glow Well Consultants Pvt. Ltd.";
$meta_desc = "Explore career opportunities at Glow Well Consultants Pvt. Ltd. in Patna. Join our team of trademark attorneys, patent drafting associates, and corporate legal consultants.";
require_once __DIR__ . '/config/settings.php';

$pdo = get_pdo();
$careers = $pdo->query("SELECT * FROM careers WHERE status = 'published' ORDER BY sort_order ASC")->fetchAll();

include __DIR__ . '/includes/header.php';
?>

<!-- Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <div class="breadcrumb-nav">
                <a href="<?= BASE_URL ?>/index.php">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Careers</span>
            </div>
            <h1 class="page-banner-title">Careers at Glow Well Consultants</h1>
            <p class="page-banner-subtitle">
                Join Eastern India's most respected intellectual property and corporate legal advisory firm. Work on landmark trademark defenses, patent filings, and corporate transactions.
            </p>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <!-- Notification Feedback -->
        <?php if (isset($_GET['applied'])): ?>
            <div class="alert alert-success" style="margin-bottom: 30px;">
                <i class="fa fa-check-circle"></i> <strong>Application Submitted!</strong> Thank you for applying to Glow Well Consultants. Our HR and talent acquisition team will review your profile and reach out if shortlisted.
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['err'])): ?>
            <div class="alert alert-danger" style="margin-bottom: 30px;">
                <i class="fa fa-exclamation-triangle"></i> <strong>Notice:</strong> <?= e($_GET['err'] === 'file_type' ? 'Please upload a PDF or DOC resume under 5MB.' : 'Please ensure all required fields are filled out.') ?>
            </div>
        <?php endif; ?>

        <div style="max-width: 820px; margin: 0 auto;">
            <!-- Application Form Card -->
            <div class="form-card" id="apply-now">
                <span class="section-badge">Join Our Team</span>
                <h2 style="font-size: 1.85rem; color: var(--primary); margin-bottom: 8px;">Submit Job Application</h2>
                <p style="color: var(--text-muted); font-size: 0.95rem; margin-bottom: 26px;">
                    Upload your CV and cover note for immediate review by our senior partners and recruitment team.
                </p>

                <form action="<?= BASE_URL ?>/process_application.php" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="form-group" style="margin-bottom: 18px;">
                        <label for="applied_position" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Target Position *</label>
                        <select id="applied_position" name="career_id" class="form-control" required>
                            <option value="0" selected>General Legal / Paralegal Application</option>
                            <?php foreach ($careers as $job): ?>
                                <option value="<?= e($job['id']) ?>"><?= e($job['title']) ?> (<?= e($job['department']) ?>)</option>
                            <?php endforeach; ?>
                        </select>
                    </div>

                    <div class="form-row">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="app_name" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Full Name *</label>
                            <input type="text" id="app_name" name="name" class="form-control" placeholder="Your Full Name" required>
                        </div>

                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="app_email" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Email Address *</label>
                            <input type="email" id="app_email" name="email" class="form-control" placeholder="name@email.com" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="app_phone" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Mobile / WhatsApp *</label>
                            <input type="tel" id="app_phone" name="phone" class="form-control" placeholder="+91 9876543210" required>
                        </div>

                        <div class="form-group" style="margin-bottom: 18px;">
                            <label for="app_exp" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Years of Experience</label>
                            <input type="text" id="app_exp" name="experience_years" class="form-control" placeholder="e.g. 3.5 Years">
                        </div>
                    </div>

                    <div class="form-group" style="margin-bottom: 18px;">
                        <label for="resume_file" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Upload Resume (PDF, DOC, DOCX) *</label>
                        <input type="file" id="resume_file" name="resume" class="form-control" accept=".pdf,.doc,.docx" required>
                        <small style="display:block; margin-top:5px; color:var(--text-muted); font-size:0.82rem;">Accepted formats: PDF, DOC, DOCX (Max size: 5MB).</small>
                    </div>

                    <div class="form-group" style="margin-bottom: 24px;">
                        <label for="cover_note" style="display:block; font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Brief Cover Note</label>
                        <textarea id="cover_note" name="cover_note" class="form-control" rows="4" placeholder="Tell us briefly about your legal education, IPR experience, or interest in Glow Well Consultants..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%; justify-content: center;">
                        <i class="fa fa-send"></i> Submit Resume
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
