<?php
$page_title = "Downloads & Legal Resources | Glow Well Consultants Pvt. Ltd.";
$meta_desc = "Download official patent filing checklists, trademark TM-A application guides, Nice classification reference index, and copyright NOC formats.";
require_once __DIR__ . '/config/settings.php';

$pdo = get_pdo();
$downloads = $pdo->query("SELECT * FROM downloads ORDER BY sort_order ASC")->fetchAll();

include __DIR__ . '/includes/header.php';
?>

<!-- Page Banner -->
<div class="page-banner">
    <div class="container">
        <div class="page-banner-content">
            <div class="breadcrumb-nav">
                <a href="<?= BASE_URL ?>/index.php">Home</a>
                <i class="fa fa-angle-right"></i>
                <span>Downloads</span>
            </div>
            <h1 class="page-banner-title">Downloads &amp; Legal Filing Resources</h1>
            <p class="page-banner-subtitle">
                Access statutory application guidelines, prior-art disclosure formats, Nice classification charts, and copyright documentation checklists.
            </p>
        </div>
    </div>
</div>

<section class="section">
    <div class="container">
        <div class="section-header">
            <span class="section-badge">Client Library</span>
            <h2 class="section-title">Official Guides &amp; Regulatory Checklists</h2>
            <p class="section-desc">
                Prepared by our senior attorney consultants to assist innovators and enterprises in preparing documentation prior to formal filing.
            </p>
        </div>

        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 24px;">
            <?php foreach ($downloads as $item): ?>
                <div style="background: var(--white); border: 1px solid var(--border-color); border-radius: var(--radius-lg); padding: 28px; box-shadow: var(--shadow-sm); display: flex; align-items: flex-start; gap: 20px; transition: var(--transition);">
                    <div style="width: 54px; height: 54px; border-radius: var(--radius-md); background: #fee2e2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 1.6rem; flex-shrink: 0;">
                        <i class="fa fa-file-pdf-o"></i>
                    </div>
                    <div style="flex-grow: 1;">
                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom: 6px;">
                            <span style="font-size: 0.78rem; font-weight: 700; color: var(--accent-hover); text-transform: uppercase;">
                                <?= e($item['category']) ?> &bull; <?= e($item['file_size']) ?>
                            </span>
                            <span style="font-size: 0.8rem; color: var(--text-light);">
                                <i class="fa fa-download"></i> <?= e($item['downloads_count']) ?> downloads
                            </span>
                        </div>
                        <h3 style="font-size: 1.18rem; color: var(--primary); margin-bottom: 8px;">
                            <?= e($item['title']) ?>
                        </h3>
                        <p style="color: var(--text-muted); font-size: 0.9rem; line-height: 1.5; margin-bottom: 16px;">
                            <?= e($item['description']) ?>
                        </p>
                        <a href="<?= BASE_URL ?>/enquiry.php?service=<?= urlencode(strtolower($item['category'])) ?>" class="btn btn-outline btn-sm open-consultation-modal">
                            <i class="fa fa-download"></i> Request Resource &amp; Guide
                        </a>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Help Banner -->
        <div style="margin-top: 50px; background: var(--bg-subtle); border: 1px dashed var(--accent); border-radius: var(--radius-lg); padding: 34px; text-align: center;">
            <h3 style="color: var(--primary); font-size: 1.35rem; margin-bottom: 8px;">Need a Specific Legal Precedent or Drafting Format?</h3>
            <p style="color: var(--text-muted); font-size: 0.95rem; max-width: 650px; margin: 0 auto 20px;">
                Our legal research department maintains an extensive archive of trademark opposition pleadings, patent specification templates, and technology licensing agreements.
            </p>
            <a href="<?= BASE_URL ?>/enquiry.php" class="btn btn-primary open-consultation-modal">
                <i class="fa fa-envelope-o"></i> Contact Research Desk
            </a>
        </div>
    </div>
</section>

<?php include __DIR__ . '/includes/footer.php'; ?>
