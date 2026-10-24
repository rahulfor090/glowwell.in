<?php
$active_tab = 'home_content';
require_once __DIR__ . '/header.php';

$pdo = get_pdo();
$msg = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!verify_csrf()) {
        $msg = ['type' => 'danger', 'text' => 'Security token invalid. Please refresh.'];
    } else {
        $fields = [
            'hero_badge', 'hero_title', 'hero_desc', 'hero_btn1_text', 'hero_btn2_text',
            'trust_badge_1', 'trust_badge_2', 'trust_badge_3',
            'stats_years_num', 'stats_years_label', 'stats_cases_num', 'stats_cases_label',
            'stats_success_num', 'stats_success_label', 'stats_clients_num', 'stats_clients_label',
            'services_section_badge', 'services_section_title', 'services_section_desc',
            'tm_box_badge', 'tm_box_title', 'tm_box_desc',
            'why_badge', 'why_title', 'why_desc', 'why_float_title', 'why_float_desc',
            'why_f1_title', 'why_f1_desc', 'why_f2_title', 'why_f2_desc',
            'why_f3_title', 'why_f3_desc', 'why_f4_title', 'why_f4_desc',
            'testimonials_section_badge', 'testimonials_section_title', 'testimonials_section_desc', 'show_testimonials',
            'news_section_badge', 'news_section_title', 'news_section_desc',
            'footer_cta_title', 'footer_cta_desc'
        ];

        $stmt = $pdo->prepare("INSERT INTO settings (setting_key, setting_value) VALUES (?, ?) ON DUPLICATE KEY UPDATE setting_value = VALUES(setting_value)");
        foreach ($fields as $f) {
            if (isset($_POST[$f])) {
                $val = trim($_POST[$f]);
                $stmt->execute([$f, $val]);
            }
        }
        $msg = ['type' => 'success', 'text' => 'Home Page content successfully updated!'];
    }
}

// Reload fresh settings
$settings = get_all_settings();
?>

<div class="container" style="padding-top: 35px; padding-bottom: 50px;">
    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 25px;">
        <div>
            <h1 style="font-size: 1.85rem; color: var(--primary);">Home Page Content Editor</h1>
            <p style="color: var(--text-muted); font-size: 0.92rem;">Update headlines, badges, counters, and text across the entire homepage.</p>
        </div>
        <a href="<?= BASE_URL ?>/index.php" target="_blank" class="btn btn-navy btn-sm">
            <i class="fa fa-eye"></i> View Live Homepage
        </a>
    </div>

    <?php if (!empty($msg)): ?>
        <div class="alert alert-<?= $msg['type'] ?>">
            <i class="fa fa-check-circle"></i> <?= e($msg['text']) ?>
        </div>
    <?php endif; ?>

    <form action="<?= BASE_URL ?>/admin/home-content.php" method="POST">
        <?= csrf_field() ?>

        <!-- SECTION 1: HERO -->
        <div class="admin-card">
            <h2><i class="fa fa-television text-gold"></i> 1. Hero Banner Section</h2>
            <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 20px;">Top visual section above the fold.</p>

            <div class="form-group" style="margin-bottom: 16px;">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary);">Top Floating Badge</label>
                <input type="text" name="hero_badge" class="form-control" value="<?= e($settings['hero_badge'] ?? '') ?>">
            </div>

            <div class="form-group" style="margin-bottom: 16px;">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary);">Hero Main Headline (HTML allowed, e.g. &lt;span class="text-gold"&gt;)</label>
                <textarea name="hero_title" class="form-control" rows="3"><?= e($settings['hero_title'] ?? '') ?></textarea>
            </div>

            <div class="form-group" style="margin-bottom: 16px;">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary);">Hero Subtitle / Description</label>
                <textarea name="hero_desc" class="form-control" rows="3"><?= e($settings['hero_desc'] ?? '') ?></textarea>
            </div>

            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary);">Primary Button Text</label>
                    <input type="text" name="hero_btn1_text" class="form-control" value="<?= e($settings['hero_btn1_text'] ?? '') ?>">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary);">Secondary Button Text</label>
                    <input type="text" name="hero_btn2_text" class="form-control" value="<?= e($settings['hero_btn2_text'] ?? '') ?>">
                </div>
            </div>

            <div class="form-row">
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary);">Trust Item 1</label>
                    <input type="text" name="trust_badge_1" class="form-control" value="<?= e($settings['trust_badge_1'] ?? '') ?>">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary);">Trust Item 2</label>
                    <input type="text" name="trust_badge_2" class="form-control" value="<?= e($settings['trust_badge_2'] ?? '') ?>">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary);">Trust Item 3</label>
                    <input type="text" name="trust_badge_3" class="form-control" value="<?= e($settings['trust_badge_3'] ?? '') ?>">
                </div>
            </div>
        </div>

        <!-- SECTION 2: STATS COUNTERS -->
        <div class="admin-card">
            <h2><i class="fa fa-tachometer text-gold"></i> 2. Stats Bar / Key Metrics</h2>
            <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 20px;">The floating stats ribbon.</p>

            <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 16px;">
                <div>
                    <label style="font-size:0.82rem; font-weight:700;">Stat 1 Number</label>
                    <input type="text" name="stats_years_num" class="form-control" value="<?= e($settings['stats_years_num'] ?? '') ?>">
                    <label style="font-size:0.82rem; font-weight:700; margin-top:8px;">Stat 1 Label</label>
                    <input type="text" name="stats_years_label" class="form-control" value="<?= e($settings['stats_years_label'] ?? '') ?>">
                </div>
                <div>
                    <label style="font-size:0.82rem; font-weight:700;">Stat 2 Number</label>
                    <input type="text" name="stats_cases_num" class="form-control" value="<?= e($settings['stats_cases_num'] ?? '') ?>">
                    <label style="font-size:0.82rem; font-weight:700; margin-top:8px;">Stat 2 Label</label>
                    <input type="text" name="stats_cases_label" class="form-control" value="<?= e($settings['stats_cases_label'] ?? '') ?>">
                </div>
                <div>
                    <label style="font-size:0.82rem; font-weight:700;">Stat 3 Number</label>
                    <input type="text" name="stats_success_num" class="form-control" value="<?= e($settings['stats_success_num'] ?? '') ?>">
                    <label style="font-size:0.82rem; font-weight:700; margin-top:8px;">Stat 3 Label</label>
                    <input type="text" name="stats_success_label" class="form-control" value="<?= e($settings['stats_success_label'] ?? '') ?>">
                </div>
                <div>
                    <label style="font-size:0.82rem; font-weight:700;">Stat 4 Number</label>
                    <input type="text" name="stats_clients_num" class="form-control" value="<?= e($settings['stats_clients_num'] ?? '') ?>">
                    <label style="font-size:0.82rem; font-weight:700; margin-top:8px;">Stat 4 Label</label>
                    <input type="text" name="stats_clients_label" class="form-control" value="<?= e($settings['stats_clients_label'] ?? '') ?>">
                </div>
            </div>
        </div>

        <!-- SECTION 3: SERVICES INTRO & TRADEMARK SEARCH -->
        <div class="admin-card">
            <h2><i class="fa fa-briefcase text-gold"></i> 3. Services Header &amp; Trademark Search Box</h2>

            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary);">Services Section Badge</label>
                    <input type="text" name="services_section_badge" class="form-control" value="<?= e($settings['services_section_badge'] ?? '') ?>">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary);">Services Section Title</label>
                    <input type="text" name="services_section_title" class="form-control" value="<?= e($settings['services_section_title'] ?? '') ?>">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 24px;">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary);">Services Section Description</label>
                <textarea name="services_section_desc" class="form-control" rows="2"><?= e($settings['services_section_desc'] ?? '') ?></textarea>
            </div>

            <div class="admin-section-divider"></div>

            <h3 style="font-size: 1.15rem; color: var(--primary); margin-bottom: 14px;">Trademark Clearance Box Banner</h3>
            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary);">Search Box Badge</label>
                    <input type="text" name="tm_box_badge" class="form-control" value="<?= e($settings['tm_box_badge'] ?? '') ?>">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700; color:var(--primary);">Search Box Title</label>
                    <input type="text" name="tm_box_title" class="form-control" value="<?= e($settings['tm_box_title'] ?? '') ?>">
                </div>
            </div>
            <div class="form-group">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary);">Search Box Description</label>
                <input type="text" name="tm_box_desc" class="form-control" value="<?= e($settings['tm_box_desc'] ?? '') ?>">
            </div>
        </div>

        <!-- SECTION 4: WHY CHOOSE US -->
        <div class="admin-card">
            <h2><i class="fa fa-star text-gold"></i> 4. Why Choose Us Section</h2>

            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Section Badge</label>
                    <input type="text" name="why_badge" class="form-control" value="<?= e($settings['why_badge'] ?? '') ?>">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Section Title</label>
                    <input type="text" name="why_title" class="form-control" value="<?= e($settings['why_title'] ?? '') ?>">
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 16px;">
                <label style="font-size:0.84rem; font-weight:700;">Section Description</label>
                <textarea name="why_desc" class="form-control" rows="2"><?= e($settings['why_desc'] ?? '') ?></textarea>
            </div>

            <div class="form-row" style="margin-bottom: 24px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Floating Card Badge Title</label>
                    <input type="text" name="why_float_title" class="form-control" value="<?= e($settings['why_float_title'] ?? '') ?>">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Floating Card Description</label>
                    <input type="text" name="why_float_desc" class="form-control" value="<?= e($settings['why_float_desc'] ?? '') ?>">
                </div>
            </div>

            <div class="admin-section-divider"></div>

            <h3 style="font-size: 1.15rem; color: var(--primary); margin-bottom: 16px;">4 Value Pillars</h3>
            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div style="background:var(--bg-subtle); padding:16px; border-radius:var(--radius-sm);">
                    <label style="font-size:0.82rem; font-weight:700;">Feature 1 Title</label>
                    <input type="text" name="why_f1_title" class="form-control" value="<?= e($settings['why_f1_title'] ?? '') ?>" style="margin-bottom:8px;">
                    <label style="font-size:0.82rem; font-weight:700;">Feature 1 Description</label>
                    <textarea name="why_f1_desc" class="form-control" rows="2"><?= e($settings['why_f1_desc'] ?? '') ?></textarea>
                </div>
                <div style="background:var(--bg-subtle); padding:16px; border-radius:var(--radius-sm);">
                    <label style="font-size:0.82rem; font-weight:700;">Feature 2 Title</label>
                    <input type="text" name="why_f2_title" class="form-control" value="<?= e($settings['why_f2_title'] ?? '') ?>" style="margin-bottom:8px;">
                    <label style="font-size:0.82rem; font-weight:700;">Feature 2 Description</label>
                    <textarea name="why_f2_desc" class="form-control" rows="2"><?= e($settings['why_f2_desc'] ?? '') ?></textarea>
                </div>
                <div style="background:var(--bg-subtle); padding:16px; border-radius:var(--radius-sm);">
                    <label style="font-size:0.82rem; font-weight:700;">Feature 3 Title</label>
                    <input type="text" name="why_f3_title" class="form-control" value="<?= e($settings['why_f3_title'] ?? '') ?>" style="margin-bottom:8px;">
                    <label style="font-size:0.82rem; font-weight:700;">Feature 3 Description</label>
                    <textarea name="why_f3_desc" class="form-control" rows="2"><?= e($settings['why_f3_desc'] ?? '') ?></textarea>
                </div>
                <div style="background:var(--bg-subtle); padding:16px; border-radius:var(--radius-sm);">
                    <label style="font-size:0.82rem; font-weight:700;">Feature 4 Title</label>
                    <input type="text" name="why_f4_title" class="form-control" value="<?= e($settings['why_f4_title'] ?? '') ?>" style="margin-bottom:8px;">
                    <label style="font-size:0.82rem; font-weight:700;">Feature 4 Description</label>
                    <textarea name="why_f4_desc" class="form-control" rows="2"><?= e($settings['why_f4_desc'] ?? '') ?></textarea>
                </div>
            </div>
        </div>

        <!-- SECTION 5: TESTIMONIALS & NEWS HEADERS -->
        <div class="admin-card">
            <h2><i class="fa fa-comments text-gold"></i> 5. Testimonials &amp; Legal Insights Section Headers</h2>
            <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 20px;">Control the section headings and badges shown above the reviews and news grids.</p>

            <h3 style="font-size: 1.15rem; color: var(--primary); margin-bottom: 12px;">Client Testimonials Header</h3>
            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Testimonials Badge</label>
                    <input type="text" name="testimonials_section_badge" class="form-control" value="<?= e($settings['testimonials_section_badge'] ?? 'Client Trust & Testimonials') ?>">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Testimonials Main Title</label>
                    <input type="text" name="testimonials_section_title" class="form-control" value="<?= e($settings['testimonials_section_title'] ?? 'What Our Clients Say') ?>">
                </div>
            </div>
            <div class="form-group" style="margin-bottom: 20px; background: var(--bg-subtle); padding: 16px; border-radius: var(--radius-sm);">
                <label style="font-size:0.86rem; font-weight:700; color:var(--primary); display:block; margin-bottom:6px;">Display Testimonials Section on Homepage</label>
                <select name="show_testimonials" class="form-control" style="max-width: 320px;">
                    <option value="0" <?= ($settings['show_testimonials'] ?? '0') === '0' ? 'selected' : '' ?>>Hidden (Currently Disabled)</option>
                    <option value="1" <?= ($settings['show_testimonials'] ?? '0') === '1' ? 'selected' : '' ?>>Visible (Active on Homepage)</option>
                </select>
                <span style="font-size:0.78rem; color:var(--text-muted); display:block; margin-top:4px;">Keep hidden until testimonials are reviewed, or enable whenever ready to display.</span>
            </div>

            <div class="form-group" style="margin-bottom: 24px;">
                <label style="font-size:0.84rem; font-weight:700;">Testimonials Subtitle / Description</label>
                <input type="text" name="testimonials_section_desc" class="form-control" value="<?= e($settings['testimonials_section_desc'] ?? 'Over 13 years of trusted partnership with corporations, institutions, and entrepreneurs.') ?>">
            </div>

            <div class="admin-section-divider"></div>

            <h3 style="font-size: 1.15rem; color: var(--primary); margin-bottom: 12px;">Legal Insights Header</h3>
            <div class="form-row" style="margin-bottom: 16px;">
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Insights Badge</label>
                    <input type="text" name="news_section_badge" class="form-control" value="<?= e($settings['news_section_badge'] ?? 'Knowledge Hub') ?>">
                </div>
                <div>
                    <label style="font-size:0.84rem; font-weight:700;">Insights Main Title</label>
                    <input type="text" name="news_section_title" class="form-control" value="<?= e($settings['news_section_title'] ?? 'Recent Legal Insights & Updates') ?>">
                </div>
            </div>
            <div class="form-group">
                <label style="font-size:0.84rem; font-weight:700;">Insights Subtitle / Description</label>
                <input type="text" name="news_section_desc" class="form-control" value="<?= e($settings['news_section_desc'] ?? 'Stay ahead of legal regulatory shifts, landmark IP judgments, and compliance best practices.') ?>">
            </div>
        </div>

        <!-- SECTION 6: BOTTOM CONSULTATION BANNER -->
        <div class="admin-card">
            <h2><i class="fa fa-bullhorn text-gold"></i> 6. Pre-Footer Consultation Banner (Global)</h2>
            <p style="color: var(--text-muted); font-size: 0.88rem; margin-bottom: 20px;">The prominent gold/navy call-to-action banner displayed just above the footer across the website.</p>

            <div class="form-group" style="margin-bottom: 16px;">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Banner Main Headline</label>
                <input type="text" name="footer_cta_title" class="form-control" value="<?= e($settings['footer_cta_title'] ?? 'Ready to Protect Your Intellectual Property & Business Assets?') ?>">
            </div>

            <div class="form-group">
                <label style="font-size:0.84rem; font-weight:700; color:var(--primary); margin-bottom:6px; display:block;">Banner Subtitle / Description</label>
                <textarea name="footer_cta_desc" class="form-control" rows="2"><?= e($settings['footer_cta_desc'] ?? 'Get in touch with our certified legal consultants in Patna for strategic advice and cost estimation.') ?></textarea>
            </div>
        </div>

        <div style="position: sticky; bottom: 20px; z-index: 99; background: rgba(8, 26, 54, 0.95); backdrop-filter: blur(10px); padding: 18px 24px; border-radius: var(--radius-md); box-shadow: var(--shadow-xl); display: flex; justify-content: space-between; align-items: center;">
            <span style="color: #cbd5e1; font-size: 0.92rem;"><i class="fa fa-info-circle text-gold"></i> Changes take effect on the live website immediately upon saving.</span>
            <button type="submit" class="btn btn-primary btn-lg">
                <i class="fa fa-save"></i> Save All Home Page Content
            </button>
        </div>
    </form>
</div>

<?php require_once __DIR__ . '/footer.php'; ?>
