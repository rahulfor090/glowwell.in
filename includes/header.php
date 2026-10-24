<?php
require_once __DIR__ . '/../config/settings.php';

// Page-specific variables with sensible fallbacks
$page_title = isset($page_title) ? $page_title : get_setting('site_name', 'Glow Well Consultants Pvt. Ltd. (GCPL)') . ' | Management Consultancy & Compliance';
$meta_desc = isset($meta_desc) ? $meta_desc : 'Glow Well Consultants Pvt. Ltd. (GCPL) - Premier Corporate Management Consultancy & Regulatory Compliance firm in Patna, Bihar. Established in 2011. ISO Management Systems, Barcode Registration, EPF/ESIC Compliances, and Brand Asset Facilitation.';
$current_page = basename($_SERVER['PHP_SELF']);
$practices_list = get_active_practices();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($page_title) ?></title>
    <meta name="description" content="<?= e($meta_desc) ?>">
    
    <!-- Favicon -->
    <link rel="icon" type="image/png" sizes="32x32" href="<?= BASE_URL ?>/assets/images/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="96x96" href="<?= BASE_URL ?>/assets/images/favicon-96x96.png">

    <!-- Stylesheets -->
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
</head>
<body>

<!-- Top Announcement & Contact Bar -->
<div class="top-bar">
    <div class="container">
        <div class="top-bar-inner">
            <div class="top-contacts">
                <a href="tel:<?= preg_replace('/[^0-9+]/', '', get_setting('contact_landline', '+916122999299')) ?>" title="Call Patna Office Landline">
                    <i class="fa fa-phone"></i> <?= e(get_setting('contact_landline', '+91 612 2999299')) ?>
                </a>
                <a href="https://wa.me/<?= e(get_setting('whatsapp_number', '917488961920')) ?>" target="_blank" title="WhatsApp Advisory">
                    <i class="fa fa-whatsapp"></i> <?= e(get_setting('header_phone_display', '+91 7488961920 / 21')) ?>
                </a>
                <a href="mailto:<?= e(get_setting('contact_email', 'info@glowwell.in')) ?>">
                    <i class="fa fa-envelope-o"></i> <?= e(get_setting('contact_email', 'info@glowwell.in')) ?>
                </a>
                <span class="top-location">
                    <i class="fa fa-map-marker"></i> Exhibition Rd, Patna - 800001, Bihar, India
                </span>
            </div>
            <div class="top-right">
                <a href="<?= BASE_URL ?>/login.php" class="top-portal-link">
                    <i class="fa fa-lock"></i> Staff Login
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Main Sticky Site Header -->
<header class="site-header">
    <div class="container">
        <div class="header-inner">
            <!-- Brand Logo -->
            <a href="<?= BASE_URL ?>/index.php" class="brand-logo" aria-label="Glow Well Consultants Pvt. Ltd. (GCPL)">
                <img src="<?= BASE_URL ?>/assets/images/logo_g.png" alt="Glow Well Logo" onerror="this.onerror=null; this.src='<?= BASE_URL ?>/assets/images/logo_s.png';">
                <span class="brand-name">Glow Well Consultants Pvt. Ltd. <small style="font-size:0.85em; opacity:0.85; font-weight:600;">(GCPL)</small></span>
            </a>

            <!-- Main Navigation -->
            <nav class="main-nav" id="mainNav">
                <ul class="nav-list">
                    <li class="nav-item <?= is_active('index.php') ?>">
                        <a href="<?= BASE_URL ?>/index.php" class="nav-link">Home</a>
                    </li>
                    <li class="nav-item <?= is_active('who.php') ?>">
                        <a href="<?= BASE_URL ?>/who.php" class="nav-link">Who We Are</a>
                    </li>
                    <li class="nav-item has-dropdown <?= ($current_page === 'services.php' || isset($service_slug) || in_array($current_page, array_map(function($p) { return $p['slug'].'.php'; }, $practices_list))) ? 'active' : '' ?>">
                        <a href="<?= BASE_URL ?>/services.php" class="nav-link">
                            Services <i class="fa fa-angle-down"></i>
                        </a>
                        <div class="dropdown-menu">
                            <?php foreach ($practices_list as $p): ?>
                                <a href="<?= BASE_URL ?>/<?= e($p['slug']) ?>.php" class="dropdown-item">
                                    <i class="fa <?= e($p['icon'] ?? 'fa-briefcase') ?>"></i> <?= e($p['title']) ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    </li>
                    <li class="nav-item <?= is_active('career.php') ?>">
                        <a href="<?= BASE_URL ?>/career.php" class="nav-link">Career</a>
                    </li>
                    <li class="nav-item <?= is_active('downloads.php') ?>">
                        <a href="<?= BASE_URL ?>/downloads.php" class="nav-link">Downloads</a>
                    </li>
                    <li class="nav-item <?= (is_active('blog.php') || is_active('blog-single.php') || is_active('news.php') || is_active('news-single.php')) ? 'active' : '' ?>">
                        <a href="<?= BASE_URL ?>/blog.php" class="nav-link">Blog</a>
                    </li>
                    <li class="nav-item <?= is_active('contact.php') ?>">
                        <a href="<?= BASE_URL ?>/contact.php" class="nav-link">Contact Us</a>
                    </li>
                </ul>
            </nav>

            <!-- Actions & Mobile Toggle -->
            <div class="header-actions">
                <a href="<?= BASE_URL ?>/enquiry.php" class="btn btn-primary btn-sm open-consultation-modal">
                    <i class="fa fa-calendar-check-o"></i> Advisory Enquiry
                </a>
                <button class="mobile-nav-toggle" id="mobileNavToggle" aria-label="Toggle Navigation">
                    <i class="fa fa-bars"></i>
                </button>
            </div>
        </div>
    </div>
</header>
