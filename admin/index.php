<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/config/config.php';
require_once dirname(__DIR__) . '/includes/functions.php';
require_once __DIR__ . '/includes/auth.php';

require_admin();

$pageTitle = 'Dashboard';
$bookingsCount = (int) db()->query('SELECT COUNT(*) FROM bookings')->fetchColumn();
$customersCount = (int) db()->query('SELECT COUNT(*) FROM customers')->fetchColumn();
$pendingCount = (int) db()->query("SELECT COUNT(*) FROM bookings WHERE status = 'pending'")->fetchColumn();
$revenue = (float) db()->query('SELECT COALESCE(SUM(amount), 0) FROM payments')->fetchColumn();

require __DIR__ . '/includes/layout-head.php';
?>
<div class="admin-stats-grid">
    <div class="admin-stat-card">
        <div class="admin-stat-number"><?= $bookingsCount ?></div>
        <div class="admin-stat-label">Bookings</div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-number"><?= $customersCount ?></div>
        <div class="admin-stat-label">Customers</div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-number">$<?= number_format($revenue, 2) ?></div>
        <div class="admin-stat-label">Revenue recorded</div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-number"><?= $pendingCount ?></div>
        <div class="admin-stat-label">Pending bookings</div>
    </div>
</div>

<div class="admin-card">
    <p style="margin:0;color:#666;">Phase 1 is complete: database, admin auth, and dashboard scaffolding are in place. Safari management (Phase 2) is next.</p>
</div>
<?php require __DIR__ . '/includes/layout-foot.php'; ?>
