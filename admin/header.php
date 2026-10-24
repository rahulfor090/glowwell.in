<?php
require_once __DIR__ . '/auth-check.php';
$active_tab = $active_tab ?? 'dashboard';

$pdo = get_pdo();
$unread_cnt = $pdo->query("SELECT COUNT(*) FROM contact_messages WHERE is_read = 0")->fetchColumn();
$new_app_cnt = $pdo->query("SELECT COUNT(*) FROM job_applications WHERE status = 'new'")->fetchColumn();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Management Console | Glow Well Consultants Pvt. Ltd.</title>
    <link rel="stylesheet" href="<?= BASE_URL ?>/assets/css/style.css">
    <style>
        .admin-top-nav {
            background: var(--primary-dark);
            border-bottom: 2px solid var(--accent);
            padding: 12px 0;
            color: #ffffff;
        }
        .admin-sub-nav {
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            box-shadow: var(--shadow-sm);
            padding: 8px 0;
            position: sticky;
            top: 0;
            z-index: 100;
        }
        .admin-menu-list {
            display: flex;
            align-items: center;
            gap: 6px;
            flex-wrap: wrap;
        }
        .admin-menu-link {
            color: #334155;
            padding: 8px 14px;
            border-radius: var(--radius-sm);
            font-size: 0.88rem;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: var(--transition);
        }
        .admin-menu-link:hover, .admin-menu-link.active {
            background: var(--navy-grad);
            color: #ffffff;
        }
        .admin-menu-link.active i {
            color: var(--accent-light);
        }
        .badge-count {
            background: #ef4444;
            color: #ffffff;
            font-size: 0.72rem;
            padding: 2px 6px;
            border-radius: 10px;
            font-weight: 800;
            margin-left: 3px;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
            background: #ffffff;
            border-radius: var(--radius-md);
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border-color);
        }
        .data-table th {
            background: var(--bg-subtle);
            color: var(--primary);
            text-align: left;
            padding: 12px 16px;
            font-size: 0.82rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            border-bottom: 2px solid var(--border-color);
        }
        .data-table td {
            padding: 12px 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 0.9rem;
            vertical-align: middle;
        }
        .data-table tr:hover {
            background: #f8fafc;
        }
        .admin-card {
            background: #ffffff;
            border: 1px solid var(--border-color);
            border-radius: var(--radius-lg);
            padding: 30px;
            box-shadow: var(--shadow-sm);
            margin-bottom: 30px;
        }
        .admin-card h2 {
            font-size: 1.45rem;
            color: var(--primary);
            margin-bottom: 6px;
        }
        .admin-section-divider {
            border-top: 2px dashed var(--border-color);
            margin: 30px 0;
            padding-top: 20px;
        }
    </style>
</head>
<body style="background: #f1f5f9; min-height: 100vh; display: flex; flex-direction: column;">

<!-- Admin Top Header -->
<div class="admin-top-nav">
    <div class="container" style="display:flex; justify-content:space-between; align-items:center;">
        <div style="display:flex; align-items:center; gap:14px;">
            <a href="<?= BASE_URL ?>/admin/index.php" style="color:#ffffff; font-weight:800; font-family:var(--font-serif); font-size:1.3rem;">
                Glow Well <span style="color:var(--accent-light); font-size:0.82rem; font-family:var(--font-sans); text-transform:uppercase; letter-spacing:0.05em;">[CMS Master Panel]</span>
            </a>
        </div>
        <div style="display:flex; align-items:center; gap:16px;">
            <a href="<?= BASE_URL ?>/index.php" target="_blank" style="color:var(--accent-light); font-size:0.86rem; font-weight:700;">
                <i class="fa fa-external-link"></i> View Website
            </a>
            <span style="font-size:0.86rem; color:#94a3b8;">
                <i class="fa fa-user-circle"></i> <?= e($_SESSION['admin_user']) ?>
            </span>
            <a href="<?= BASE_URL ?>/admin/logout.php" class="btn btn-outline-gold btn-sm" style="padding:4px 12px; font-size:0.8rem;">
                <i class="fa fa-sign-out"></i> Logout
            </a>
        </div>
    </div>
</div>

<!-- Admin Module Navigation Bar -->
<div class="admin-sub-nav">
    <div class="container">
        <div class="admin-menu-list">
            <a href="<?= BASE_URL ?>/admin/index.php" class="admin-menu-link <?= $active_tab === 'dashboard' ? 'active' : '' ?>">
                <i class="fa fa-dashboard"></i> Overview
            </a>
            <a href="<?= BASE_URL ?>/admin/home-content.php" class="admin-menu-link <?= $active_tab === 'home_content' ? 'active' : '' ?>">
                <i class="fa fa-home"></i> Home Content
            </a>
            <a href="<?= BASE_URL ?>/admin/about-content.php" class="admin-menu-link <?= $active_tab === 'about_content' ? 'active' : '' ?>">
                <i class="fa fa-info-circle"></i> About Page
            </a>
            <a href="<?= BASE_URL ?>/admin/services.php" class="admin-menu-link <?= $active_tab === 'services' ? 'active' : '' ?>">
                <i class="fa fa-gavel"></i> Services
            </a>
            <a href="<?= BASE_URL ?>/admin/faqs.php" class="admin-menu-link <?= $active_tab === 'faqs' ? 'active' : '' ?>">
                <i class="fa fa-question-circle"></i> FAQs
            </a>
            <a href="<?= BASE_URL ?>/admin/testimonials.php" class="admin-menu-link <?= $active_tab === 'testimonials' ? 'active' : '' ?>">
                <i class="fa fa-star"></i> Testimonials
            </a>
            <a href="<?= BASE_URL ?>/admin/careers.php" class="admin-menu-link <?= $active_tab === 'careers' ? 'active' : '' ?>">
                <i class="fa fa-briefcase"></i> Careers
            </a>
            <a href="<?= BASE_URL ?>/admin/downloads.php" class="admin-menu-link <?= $active_tab === 'downloads' ? 'active' : '' ?>">
                <i class="fa fa-download"></i> Downloads
            </a>
            <a href="<?= BASE_URL ?>/admin/news.php" class="admin-menu-link <?= in_array($active_tab, ['news', 'blog']) ? 'active' : '' ?>">
                <i class="fa fa-pencil-square-o"></i> Blog &amp; Articles
            </a>
            <a href="<?= BASE_URL ?>/admin/enquiries.php" class="admin-menu-link <?= $active_tab === 'enquiries' ? 'active' : '' ?>">
                <i class="fa fa-inbox"></i> Inquiries <?php if ($unread_cnt > 0): ?><span class="badge-count"><?= $unread_cnt ?></span><?php endif; ?>
            </a>
            <a href="<?= BASE_URL ?>/admin/applications.php" class="admin-menu-link <?= $active_tab === 'applications' ? 'active' : '' ?>">
                <i class="fa fa-users"></i> Applications <?php if ($new_app_cnt > 0): ?><span class="badge-count"><?= $new_app_cnt ?></span><?php endif; ?>
            </a>
            <a href="<?= BASE_URL ?>/admin/settings.php" class="admin-menu-link <?= $active_tab === 'settings' ? 'active' : '' ?>">
                <i class="fa fa-cog"></i> Settings &amp; Contact
            </a>
        </div>
    </div>
</div>

<main style="flex-grow: 1;">
