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

// Activity feed: union new-booking and payment-received events from
// existing tables, ordered by recency. No separate notifications table
// to keep in sync — this is always accurate by construction.
$activity = db()->query(
    "(SELECT 'booking' AS type, b.id AS booking_id, b.reference, b.created_at AS event_at,
             c.first_name, c.last_name, b.estimated_total AS amount, b.currency
      FROM bookings b
      INNER JOIN customers c ON c.id = b.customer_id)
     UNION ALL
     (SELECT 'payment' AS type, p.booking_id, b.reference, p.created_at AS event_at,
             c.first_name, c.last_name, p.amount, p.currency
      FROM payments p
      INNER JOIN bookings b ON b.id = p.booking_id
      INNER JOIN customers c ON c.id = b.customer_id)
     ORDER BY event_at DESC
     LIMIT 10"
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

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Recent Activity</h2>

    <?php if (!$activity): ?>
        <div class="admin-empty-state">No activity yet. New bookings and recorded payments will show up here.</div>
    <?php else: ?>
    <ul class="admin-activity-feed">
        <?php foreach ($activity as $event): ?>
        <li class="admin-activity-item admin-activity-<?= e($event['type']) ?>">
            <span class="admin-activity-icon"><?= $event['type'] === 'payment' ? '💰' : '📅' ?></span>
            <span class="admin-activity-text">
                <?php if ($event['type'] === 'payment'): ?>
                    Payment of <strong><?= e($event['currency'] . ' ' . number_format((float) $event['amount'], 2)) ?></strong> received from <?= e($event['first_name'] . ' ' . $event['last_name']) ?>
                <?php else: ?>
                    New booking request <strong>#<?= e($event['reference']) ?></strong> from <?= e($event['first_name'] . ' ' . $event['last_name']) ?>
                <?php endif; ?>
                — <a href="<?= admin_base_url() ?>/bookings/view.php?id=<?= $event['booking_id'] ?>">view booking</a>
            </span>
            <span class="admin-activity-time"><?= e(date('d M, H:i', strtotime($event['event_at']))) ?></span>
        </li>
        <?php endforeach; ?>
    </ul>
    <?php endif; ?>
</div>
<?php require __DIR__ . '/includes/layout-foot.php'; ?>
