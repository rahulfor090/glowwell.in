<?php
require_once __DIR__ . '/../config/db.php';
$pdo = get_pdo();

$files = [
    'patent' => 'patent.php',
    'trademark' => 'trademark.php',
    'copyright' => 'copyright.php',
    'designs' => 'designs.php',
    'geographical' => 'geographical.php',
    'iso-certification' => 'iso-certification.php',
    'company-registration' => 'company-registration.php',
    'cyber-law' => 'cyber-law.php',
    'litigation' => 'litigation.php'
];

foreach ($files as $slug => $filename) {
    $filepath = __DIR__ . '/../' . $filename;
    if (!file_exists($filepath)) {
        echo "File not found: $filename\n";
        continue;
    }

    $raw = file_get_contents($filepath);

    // Extract meta title
    $meta_title = '';
    if (preg_match('/\$page_title\s*=\s*["\']([^"\']+)["\'];/', $raw, $m)) {
        $meta_title = $m[1];
    }

    // Extract meta desc
    $meta_desc = '';
    if (preg_match('/\$meta_desc\s*=\s*["\']([^"\']+)["\'];/', $raw, $m)) {
        $meta_desc = $m[1];
    }

    // Extract banner title
    $banner_title = '';
    if (preg_match('/<h1 class="page-banner-title">(.*?)<\/h1>/s', $raw, $m)) {
        $banner_title = trim(strip_tags($m[1]));
    }

    // Extract banner subtitle
    $banner_subtitle = '';
    if (preg_match('/<p class="page-banner-subtitle">\s*(.*?)\s*<\/p>/s', $raw, $m)) {
        $banner_subtitle = trim($m[1]);
    }

    // Extract section badge
    $badge = 'Intellectual Property Rights';
    if (preg_match('/<span class="section-badge">(.*?)<\/span>/s', $raw, $m)) {
        $badge = trim(strip_tags($m[1]));
    }

    // Extract article content before FAQs / CTA
    $content = '';
    if (preg_match('/<article class="detail-article">\s*<span class="section-badge">.*?<\/span>\s*(.*?)(\s*<!--.*?FAQs|(?=\s*<\?php if \(!empty\(\$faqs\)\):)|(?=\s*<div style="margin-top:\s*40px;\s*padding:\s*30px;\s*background:\s*var\(--navy-grad\)))/s', $raw, $m)) {
        $content = trim($m[1]);
    } elseif (preg_match('/<article class="detail-article">(.*?)<\/article>/s', $raw, $m)) {
        $content = trim($m[1]);
    }

    // Clean up content: strip outer badge if still in it
    $content = preg_replace('/<span class="section-badge">.*?<\/span>\s*/s', '', $content);

    echo "Slug: $slug\n";
    echo "Meta Title: $meta_title\n";
    echo "Banner Title: $banner_title\n";
    echo "Badge: $badge\n";
    echo "Content length: " . strlen($content) . " bytes\n";

    // Update in practices table
    $stmt = $pdo->prepare("UPDATE practices SET 
        badge = :badge,
        banner_title = :banner_title,
        banner_subtitle = :banner_subtitle,
        content = :content,
        meta_title = :meta_title,
        meta_description = :meta_description
        WHERE slug = :slug");
    
    $stmt->execute([
        ':badge' => $badge,
        ':banner_title' => $banner_title,
        ':banner_subtitle' => $banner_subtitle,
        ':content' => $content,
        ':meta_title' => $meta_title,
        ':meta_description' => $meta_desc,
        ':slug' => $slug
    ]);

    echo "Updated successfully!\n-----------------------------------\n";
}

echo "All 9 practices migrated with full database content!\n";
