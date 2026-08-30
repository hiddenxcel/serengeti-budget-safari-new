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

$recentBookings = db()->query(
    "SELECT b.id, b.reference, b.status, b.estimated_total, b.currency, b.created_at,
            c.first_name, c.last_name,
            COALESCE(s.title_en, b.special_requests, 'Custom request') AS safari_title
     FROM bookings b
     INNER JOIN customers c ON c.id = b.customer_id
     LEFT JOIN safaris s ON s.id = b.safari_id
     ORDER BY b.created_at DESC
     LIMIT 8"
)->fetchAll();

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
    <div class="admin-toolbar" style="margin-bottom:1rem;">
        <h2 style="margin:0;font-size:1.05rem;">Recent Bookings</h2>
        <a href="<?= admin_base_url() ?>/bookings/index.php" class="admin-btn">View all</a>
    </div>

    <?php if (!$recentBookings): ?>
        <div class="admin-empty-state">No bookings yet. They will appear here as customers submit booking requests on the site.</div>
    <?php else: ?>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>Customer</th>
                    <th>Safari</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Received</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($recentBookings as $b): ?>
                <tr>
                    <td><a href="<?= admin_base_url() ?>/bookings/view.php?id=<?= $b['id'] ?>"><strong>#<?= e($b['reference']) ?></strong></a></td>
                    <td><?= e($b['first_name'] . ' ' . $b['last_name']) ?></td>
                    <td><?= e($b['safari_title']) ?></td>
                    <td><?= $b['estimated_total'] !== null ? e($b['currency'] . ' ' . number_format((float) $b['estimated_total'], 2)) : '—' ?></td>
                    <td><span class="admin-badge <?= e($b['status']) ?>"><?= ucwords(str_replace('_', ' ', $b['status'])) ?></span></td>
                    <td><?= e(date('d M Y', strtotime($b['created_at']))) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php require __DIR__ . '/includes/layout-foot.php'; ?>
