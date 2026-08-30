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
    <aside class="admin-sidebar">
        <div class="admin-sidebar-brand">Serengeti Admin</div>
        <nav class="admin-nav">
            <a href="<?= admin_base_url() ?>/index.php">Dashboard</a>
            <a href="<?= admin_base_url() ?>/safaris/index.php">Safaris</a>
            <a href="<?= admin_base_url() ?>/bookings/index.php">Bookings</a>
            <a href="<?= admin_base_url() ?>/customers/index.php">Customers</a>
        </nav>
        <div class="admin-sidebar-user">
            <div class="admin-user-name"><?= e(current_admin()['name'] ?? '') ?></div>
            <a href="<?= admin_base_url() ?>/logout.php" class="admin-logout-link">Log out</a>
        </div>
    </aside>
    <main class="admin-main">
        <h1 class="admin-page-title"><?= e($pageTitle ?? '') ?></h1>
