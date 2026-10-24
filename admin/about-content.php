<?php
$active_tab = 'about_content';
require_once __DIR__ . '/header.php';

$pdo = get_pdo();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        $msg = ['type' => 'danger', 'text' => 'Security token invalid. Please refresh.'];
    } else {
        $fields = [
            'about_banner_title', 'about_banner_subtitle',
            'about_badge', 'about_title', 'about_p1', 'about_p2',
            'about_quote_title', 'about_quote_text',
            'about_stage1_title', 'about_stage1_desc',
            'about_stage2_title', 'about_stage2_desc',
            'about_stage3_title', 'about_stage3_desc',
            'about_stage4_title', 'about_stage4_desc',
            'about_meta_title', 'about_meta_desc'
        ];

        $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
        foreach ($fields as $f) {
            if (isset($_POST[$f])) {
                $stmt->execute([$f, trim($_POST[$f])]);
            }
        }
        $msg = ['type' => 'success', 'text' => 'Who We Are page content successfully updated!'];
    }
}

$settings = get_all_settings();
?>

<div class="container" style="padding-top: 35px; padding-bottom: 50px; max-width: 900px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px; flex-wrap:wrap; gap:12px;">
        <div>
            <h1 style="font-size: 1.85rem; color: var(--primary);">About Us ("Who We Are") Editor</h1>
            <p style="color: var(--text-muted); font-size: 0.92rem;">Control the firm story, consulting philosophy, and 4-stage client engagement model.</p>
        </div>
        <a href="<?= BASE_URL ?>/who.php" target="_blank" class="btn btn-navy btn-sm">
            <i class="fa fa-eye"></i> View Live Page
        </a>
    </div>

    <?php if (!empty($msg)): ?>
        <div class="alert alert-<?= $msg['type'] ?>">
            <i class="fa fa-check-circle"></i> <?= e($msg['text']) ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/admin/about-content.php" method="POST">
        <?= csrf_field() ?>

        <!-- SECTION 1: BANNER -->
        <div class="admin-card">
            <h2><i class="fa fa-header text-gold"></i> 1. Page Header &amp; Banner</h2>
            <div class="form-group" style="margin-bottom: 16px;">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Page Banner Big Title</label>
                <input type="text" name="about_banner_title" class="form-control" value="<?= e($settings['about_banner_title'] ?? 'Pioneering Intellectual Property & Legal Excellence') ?>">
            </div>
            <div class="form-group">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Page Banner Subtitle</label>
                <textarea name="about_banner_subtitle" class="form-control" rows="2"><?= e($settings['about_banner_subtitle'] ?? 'Guiding corporations, startups, inventors, and research institutions with relentless dedication, statutory precision, and strategic foresight.') ?></textarea>
            </div>
        </div>

        <!-- SECTION 2: PROFILE INTRO -->
        <div class="admin-card">
            <h2><i class="fa fa-building-o text-gold"></i> 2. Firm Profile &amp; Introduction</h2>
            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Section Badge</label>
                    <input type="text" name="about_badge" class="form-control" value="<?= e($settings['about_badge'] ?? 'Firm Profile') ?>">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Main Heading</label>
                    <input type="text" name="about_title" class="form-control" value="<?= e($settings['about_title'] ?? 'Eastern India’s Benchmark IPR & Corporate Advisory') ?>">
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 16px;">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Paragraph 1 (HTML allowed)</label>
                <textarea name="about_p1" class="form-control" rows="4"><?= e($settings['about_p1'] ?? '<strong>Glow Well Consultants Pvt. Ltd.</strong> is a premier attorney and corporate consultancy firm headquartered in Patna, Bihar, with nationwide operational capabilities. For over 13 years, our firm has stood as a bastion of trust, legal acumen, and strategic guidance for businesses seeking to protect, enforce, and capitalize on their intellectual property assets.') ?></textarea>
            </div>
            <div class="form-group">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Paragraph 2 (HTML allowed)</label>
                <textarea name="about_p2" class="form-control" rows="3"><?= e($settings['about_p2'] ?? 'We provide end-to-end <strong>Consultancy, Documentation, Implementation, Registration Facilitation, and Post-Registration Services</strong>. We deliver the most comprehensive, competitive, easy to implement, cost-effective, and result-oriented legal solutions designed for organizational growth and enterprise longevity.') ?></textarea>
            </div>
        </div>

        <!-- SECTION 3: PHILOSOPHY QUOTE -->
        <div class="admin-card">
            <h2><i class="fa fa-quote-left text-gold"></i> 3. Consulting Philosophy Callout</h2>
            <div class="form-group" style="margin-bottom: 16px;">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Philosophy Box Title</label>
                <input type="text" name="about_quote_title" class="form-control" value="<?= e($settings['about_quote_title'] ?? 'Our Consulting Philosophy') ?>">
            </div>
            <div class="form-group">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Philosophy Statement</label>
                <textarea name="about_quote_text" class="form-control" rows="3"><?= e($settings['about_quote_text'] ?? '"We enjoy an immense success rate across all our consulting assignments. We do not merely consult to achieve a statutory certificate; our mission is to elevate and fortify the overall business processes, brand integrity, and competitive defensibility of the organizations we serve."') ?></textarea>
            </div>
        </div>

        <!-- SECTION 4: 4-STAGE MODEL -->
        <div class="admin-card">
            <h2><i class="fa fa-tasks text-gold"></i> 4. 4-Stage Client Engagement Model</h2>
            <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px;">
                <div style="background:var(--bg-subtle); padding:16px; border-radius:var(--radius-sm);">
                    <span style="font-weight:800; color:var(--accent);">Stage 01</span>
                    <input type="text" name="about_stage1_title" class="form-control" value="<?= e($settings['about_stage1_title'] ?? 'Exhaustive Search & Advisory') ?>" style="margin:8px 0;">
                    <textarea name="about_stage1_desc" class="form-control" rows="3"><?= e($settings['about_stage1_desc'] ?? 'We conduct thorough market and official registry searches to identify potential conflicts, evaluating registrability and patentability before any expenditure.') ?></textarea>
                </div>
                <div style="background:var(--bg-subtle); padding:16px; border-radius:var(--radius-sm);">
                    <span style="font-weight:800; color:var(--accent);">Stage 02</span>
                    <input type="text" name="about_stage2_title" class="form-control" value="<?= e($settings['about_stage2_title'] ?? 'Strategic Drafting & Statutory Filing') ?>" style="margin:8px 0;">
                    <textarea name="about_stage2_desc" class="form-control" rows="3"><?= e($settings['about_stage2_desc'] ?? 'Precision drafting of specifications, claim boundaries, and formal applications aligned with regulatory statutes and international treaties (PCT, Madrid, TRIPS).') ?></textarea>
                </div>
                <div style="background:var(--bg-subtle); padding:16px; border-radius:var(--radius-sm);">
                    <span style="font-weight:800; color:var(--accent);">Stage 03</span>
                    <input type="text" name="about_stage3_title" class="form-control" value="<?= e($settings['about_stage3_title'] ?? 'Prosecution & Registry Hearings') ?>" style="margin:8px 0;">
                    <textarea name="about_stage3_desc" class="form-control" rows="3"><?= e($settings['about_stage3_desc'] ?? 'Robust defense against examination objections, third-party oppositions, and direct attorney representation before the Registrar.') ?></textarea>
                </div>
                <div style="background:var(--bg-subtle); padding:16px; border-radius:var(--radius-sm);">
                    <span style="font-weight:800; color:var(--accent);">Stage 04</span>
                    <input type="text" name="about_stage4_title" class="form-control" value="<?= e($settings['about_stage4_title'] ?? 'Post-Grant Compliance & Enforcement') ?>" style="margin:8px 0;">
                    <textarea name="about_stage4_desc" class="form-control" rows="3"><?= e($settings['about_stage4_desc'] ?? 'Timely renewals, commercial licensing agreements, assignments, and aggressive legal litigation against counterfeiters and infringers.') ?></textarea>
                </div>
            </div>
        </div>

        <!-- Sticky Save Button -->
        <div style="position: sticky; bottom: 20px; z-index: 99; background: rgba(8, 26, 54, 0.95); backdrop-filter: blur(10px); padding: 18px 24px; border-radius: var(--radius-md); box-shadow: var(--shadow-xl); display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #cbd5e1; font-size: 0.92rem;"><i class="fa fa-info-circle text-gold"></i> Changes take effect on the live website immediately upon saving.</span>
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fa fa-save"></i> Save About Us Content
            </button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
