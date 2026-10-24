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

        <div class="layout-grid">
            <!-- Left: Open Positions List -->
            <div>
                <span class="section-badge">Current Openings</span>
                <h2 style="font-size: 2.1rem; color: var(--primary); margin-bottom: 12px;">Active Legal &amp; Consulting Vacancies</h2>
                <p style="color: var(--text-muted); font-size: 1rem; margin-bottom: 34px;">
                    We offer competitive compensation, continuous professional mentorship, and direct exposure to substantive intellectual property prosecution.
                </p>

                <div style="display:flex; flex-direction:column; gap:24px;">
                    <?php if (empty($careers)): ?>
                        <div style="padding: 30px; background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-md);">
                            <p style="margin: 0; color: var(--text-muted);">No current vacancies listed. You may still submit a general application using the form.</p>
                        </div>
                    <?php else: ?>
                        <?php foreach ($careers as $job): ?>
                            <div style="background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 30px; box-shadow: var(--shadow-sm); transition: var(--transition);">
                                <div style="display:flex; justify-content:space-between; align-items:flex-start; flex-wrap:wrap; gap:12px; margin-bottom:12px;">
                                    <div>
                                        <h3 style="font-size: 1.35rem; color: var(--primary); margin-bottom: 6px;"><?= e($job['title']) ?></h3>
                                        <div style="display:flex; gap:16px; font-size:0.86rem; color:var(--text-muted); flex-wrap:wrap;">
                                            <span><i class="fa fa-briefcase text-gold"></i> <?= e($job['department']) ?></span>
                                            <span><i class="fa fa-clock-o text-gold"></i> <?= e($job['job_type']) ?></span>
                                            <span><i class="fa fa-graduation-cap text-gold"></i> <?= e($job['experience']) ?></span>
                                            <span><i class="fa fa-map-marker text-gold"></i> <?= e($job['location']) ?></span>
                                        </div>
                                    </div>
                                    <a href="#apply-now" class="btn btn-outline btn-sm select-job-btn" data-job="<?= e($job['title']) ?>" data-id="<?= e($job['id']) ?>">
                                        Apply Online <i class="fa fa-arrow-down"></i>
                                    </a>
                                </div>
                                <p style="color: #475569; font-size: 0.94rem; line-height: 1.6; margin-bottom: 12px;">
                                    <?= e($job['description']) ?>
                                </p>
                                <div style="background: var(--bg-subtle); padding: 12px 16px; border-radius: var(--radius-sm); font-size: 0.88rem; color: var(--primary);">
                                    <strong>Requirements:</strong> <?= e($job['requirements']) ?>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Right: Application Form Card -->
            <div class="form-card" id="apply-now" style="align-self: flex-start;">
                <span class="section-badge">Join Our Team</span>
                <h3 style="font-size: 1.45rem; color: var(--primary); margin-bottom: 6px;">Submit Job Application</h3>
                <p style="color: var(--text-muted); font-size: 0.9rem; margin-bottom: 22px;">
                    Upload your CV and cover note for immediate review by our senior partners.
                </p>

                <form action="<?= BASE_URL ?>/process_application.php" method="POST" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label for="applied_position" style="display:block; font-size:0.82rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Target Position *</label>
                        <select id="applied_position" name="career_id" class="form-control" required>
                            <option value="">Select Opening</option>
                            <?php foreach ($careers as $job): ?>
                                <option value="<?= e($job['id']) ?>"><?= e($job['title']) ?></option>
                            <?php endforeach; ?>
                            <option value="0">General Legal / Paralegal Application</option>
                        </select>
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label for="app_name" style="display:block; font-size:0.82rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Full Name *</label>
                        <input type="text" id="app_name" name="name" class="form-control" placeholder="Your Full Name" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label for="app_email" style="display:block; font-size:0.82rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Email Address *</label>
                        <input type="email" id="app_email" name="email" class="form-control" placeholder="name@email.com" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label for="app_phone" style="display:block; font-size:0.82rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Mobile / WhatsApp *</label>
                        <input type="tel" id="app_phone" name="phone" class="form-control" placeholder="+91 9876543210" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label for="app_exp" style="display:block; font-size:0.82rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Years of Experience</label>
                        <input type="text" id="app_exp" name="experience_years" class="form-control" placeholder="e.g. 3.5 Years">
                    </div>

                    <div class="form-group" style="margin-bottom: 16px;">
                        <label for="resume_file" style="display:block; font-size:0.82rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Upload Resume (PDF, DOCX) *</label>
                        <input type="file" id="resume_file" name="resume" class="form-control" accept=".pdf,.doc,.docx" required>
                    </div>

                    <div class="form-group" style="margin-bottom: 22px;">
                        <label for="cover_note" style="display:block; font-size:0.82rem; font-weight:700; color:var(--primary); margin-bottom:6px;">Brief Cover Note</label>
                        <textarea id="cover_note" name="cover_note" class="form-control" rows="3" placeholder="Tell us briefly about your legal education, IPR experience, or interest in Glow Well..."></textarea>
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg" style="width: 100%;">
                        <i class="fa fa-send"></i> Submit Resume
                    </button>
                </form>
            </div>
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const selectBtns = document.querySelectorAll('.select-job-btn');
    const selectElem = document.getElementById('applied_position');
    selectBtns.forEach(btn => {
        btn.addEventListener('click', () => {
            const jobId = btn.getAttribute('data-id');
            if (selectElem && jobId) {
                selectElem.value = jobId;
            }
        });
    });
});
</script>

<?php include __DIR__ . '/includes/footer.php'; ?>
