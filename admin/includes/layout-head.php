<?php
declare(strict_types=1);
/** Included after require_admin() passes. Expects $pageTitle to be set. */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title><?= e($pageTitle ?? 'Admin') ?> — Serengeti Budget Safari Admin</title>
    <meta name="robots" content="noindex, nofollow" />
    <link rel="stylesheet" href="<?= admin_base_url() ?>/assets/admin.css" />
</head>
<body>
<div class="admin-shell">
    <header class="admin-topbar">
        <button type="button" class="admin-menu-toggle" id="adminMenuToggle" aria-label="Toggle menu" aria-expanded="false" aria-controls="adminSidebar">
            <span></span><span></span><span></span>
        </button>
        <div class="admin-topbar-brand">Serengeti Admin</div>
    </header>
    <div class="admin-sidebar-overlay" id="adminSidebarOverlay"></div>
    <aside class="admin-sidebar" id="adminSidebar">
        <div class="admin-sidebar-brand">Serengeti Admin</div>
        <nav class="admin-nav">
            <a href="<?= admin_base_url() ?>/index.php"<?= admin_nav_active('index.php') ?>>Dashboard</a>
            <a href="<?= admin_base_url() ?>/safaris/index.php"<?= admin_nav_active('safaris') ?>>Safaris</a>
            <a href="<?= admin_base_url() ?>/bookings/index.php"<?= admin_nav_active('bookings') ?>>Bookings</a>
            <a href="<?= admin_base_url() ?>/customers/index.php"<?= admin_nav_active('customers') ?>>Customers</a>
        </nav>
        <div class="admin-sidebar-user">
            <div class="admin-user-name"><?= e(current_admin()['name'] ?? '') ?></div>
            <a href="<?= admin_base_url() ?>/logout.php" class="admin-logout-link">Log out</a>
        </div>
    </aside>
    <main class="admin-main">
        <h1 class="admin-page-title"><?= e($pageTitle ?? '') ?></h1>
