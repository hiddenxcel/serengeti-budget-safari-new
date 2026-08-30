<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

require_admin();

$pageTitle = 'Reports & Analytics';

// Revenue by period (based on when the payment was recorded).
$revenueToday = (float) db()->query("SELECT COALESCE(SUM(amount), 0) FROM payments WHERE paid_at = CURDATE()")->fetchColumn();
$revenueWeek = (float) db()->query("SELECT COALESCE(SUM(amount), 0) FROM payments WHERE paid_at >= DATE_SUB(CURDATE(), INTERVAL 7 DAY)")->fetchColumn();
$revenueMonth = (float) db()->query("SELECT COALESCE(SUM(amount), 0) FROM payments WHERE paid_at >= DATE_FORMAT(CURDATE(), '%Y-%m-01')")->fetchColumn();
$revenueYear = (float) db()->query("SELECT COALESCE(SUM(amount), 0) FROM payments WHERE paid_at >= DATE_FORMAT(CURDATE(), '%Y-01-01')")->fetchColumn();

// Booking counts by status.
$bookingCounts = db()->query('SELECT status, COUNT(*) c FROM bookings GROUP BY status')->fetchAll(PDO::FETCH_KEY_PAIR);
$totalBookings = array_sum($bookingCounts);
$allStatuses = ['pending', 'confirmed', 'partially_paid', 'paid', 'cancelled', 'completed'];

// Popular safaris — by booking count, only counting bookings linked to a real safari.
$popularSafaris = db()->query(
    "SELECT s.id, s.title_en, COUNT(b.id) AS booking_count
     FROM safaris s
     INNER JOIN bookings b ON b.safari_id = s.id
     GROUP BY s.id, s.title_en
     ORDER BY booking_count DESC
     LIMIT 10"
)->fetchAll();

// Revenue by safari — sum of payments for bookings linked to each safari.
$revenueBySafari = db()->query(
    "SELECT s.id, s.title_en, COALESCE(SUM(p.amount), 0) AS revenue
     FROM safaris s
     INNER JOIN bookings b ON b.safari_id = s.id
     INNER JOIN payments p ON p.booking_id = b.id
     GROUP BY s.id, s.title_en
     ORDER BY revenue DESC
     LIMIT 10"
)->fetchAll();

// Custom/legacy (non-DB-linked) bookings still contribute overall revenue —
// surfaced separately so the "by safari" report doesn't silently omit them.
$customBookingsRevenue = (float) db()->query(
    "SELECT COALESCE(SUM(p.amount), 0) FROM payments p
     INNER JOIN bookings b ON b.id = p.booking_id
     WHERE b.safari_id IS NULL"
)->fetchColumn();

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<div class="admin-stats-grid">
    <div class="admin-stat-card">
        <div class="admin-stat-number">$<?= number_format($revenueToday, 2) ?></div>
        <div class="admin-stat-label">Revenue Today</div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-number">$<?= number_format($revenueWeek, 2) ?></div>
        <div class="admin-stat-label">Last 7 Days</div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-number">$<?= number_format($revenueMonth, 2) ?></div>
        <div class="admin-stat-label">This Month</div>
    </div>
    <div class="admin-stat-card">
        <div class="admin-stat-number">$<?= number_format($revenueYear, 2) ?></div>
        <div class="admin-stat-label">This Year</div>
    </div>
</div>

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Bookings by Status</h2>
    <div class="admin-stats-grid">
        <div class="admin-stat-card">
            <div class="admin-stat-number"><?= $totalBookings ?></div>
            <div class="admin-stat-label">Total</div>
        </div>
        <?php foreach ($allStatuses as $s): ?>
        <div class="admin-stat-card">
            <div class="admin-stat-number"><?= $bookingCounts[$s] ?? 0 ?></div>
            <div class="admin-stat-label"><?= ucwords(str_replace('_', ' ', $s)) ?></div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Popular Safaris</h2>
    <?php if (!$popularSafaris): ?>
        <div class="admin-empty-state">No bookings linked to a safari yet.</div>
    <?php else: ?>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>#</th><th>Safari</th><th>Bookings</th></tr></thead>
            <tbody>
                <?php foreach ($popularSafaris as $i => $s): ?>
                <tr>
                    <td><?= $i + 1 ?></td>
                    <td><a href="<?= admin_base_url() ?>/safaris/edit.php?id=<?= $s['id'] ?>"><?= e($s['title_en']) ?></a></td>
                    <td><?= (int) $s['booking_count'] ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Revenue by Safari</h2>
    <?php if (!$revenueBySafari): ?>
        <div class="admin-empty-state">No payments recorded against a DB-linked safari yet.</div>
    <?php else: ?>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>Safari</th><th>Revenue</th></tr></thead>
            <tbody>
                <?php foreach ($revenueBySafari as $s): ?>
                <tr>
                    <td><a href="<?= admin_base_url() ?>/safaris/edit.php?id=<?= $s['id'] ?>"><?= e($s['title_en']) ?></a></td>
                    <td>$<?= number_format((float) $s['revenue'], 2) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
    <?php if ($customBookingsRevenue > 0): ?>
    <p style="color:#888;font-size:0.85rem;margin-top:1rem;margin-bottom:0;">
        Plus $<?= number_format($customBookingsRevenue, 2) ?> from custom/legacy bookings not linked to a safari record.
    </p>
    <?php endif; ?>
</div>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
