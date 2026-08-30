<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';
require_once dirname(__DIR__) . '/includes/booking-helpers.php';

require_admin();

$pageTitle = 'Bookings';

$statusFilter = $_GET['status'] ?? 'all';
$search = trim((string) ($_GET['q'] ?? ''));

$where = [];
$params = [];

if (in_array($statusFilter, admin_booking_statuses(), true)) {
    $where[] = 'b.status = ?';
    $params[] = $statusFilter;
}

if ($search !== '') {
    $where[] = '(b.reference LIKE ? OR c.first_name LIKE ? OR c.last_name LIKE ? OR c.email LIKE ? OR s.title_en LIKE ? OR b.special_requests LIKE ?)';
    $like = '%' . $search . '%';
    array_push($params, $like, $like, $like, $like, $like, $like);
}

$sql = "SELECT b.id, b.reference, b.status, b.estimated_total, b.currency, b.travel_date, b.created_at,
               c.first_name, c.last_name, c.email,
               COALESCE(s.title_en, b.special_requests, 'Custom request') AS safari_title,
               (SELECT COALESCE(SUM(p.amount), 0) FROM payments p WHERE p.booking_id = b.id) AS paid_amount
        FROM bookings b
        INNER JOIN customers c ON c.id = b.customer_id
        LEFT JOIN safaris s ON s.id = b.safari_id";

if ($where) {
    $sql .= ' WHERE ' . implode(' AND ', $where);
}
$sql .= ' ORDER BY b.created_at DESC';

$stmt = db()->prepare($sql);
$stmt->execute($params);
$bookings = $stmt->fetchAll();

$counts = db()->query('SELECT status, COUNT(*) c FROM bookings GROUP BY status')->fetchAll(PDO::FETCH_KEY_PAIR);
$totalCount = array_sum($counts);

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<div class="admin-toolbar">
    <div class="admin-filter-bar">
        <a href="?status=all" class="<?= $statusFilter === 'all' ? 'active' : '' ?>">All (<?= $totalCount ?>)</a>
        <?php foreach (admin_booking_statuses() as $s): ?>
            <a href="?status=<?= e($s) ?>" class="<?= $statusFilter === $s ? 'active' : '' ?>"><?= ucwords(str_replace('_', ' ', $s)) ?> (<?= $counts[$s] ?? 0 ?>)</a>
        <?php endforeach; ?>
    </div>
</div>

<form method="get" class="admin-card" style="display:flex;gap:0.75rem;flex-wrap:wrap;align-items:end;">
    <input type="hidden" name="status" value="<?= e($statusFilter) ?>" />
    <div class="admin-form-group" style="flex:1;min-width:220px;margin-bottom:0;">
        <label for="q">Search by reference, customer, email, or safari</label>
        <input type="text" id="q" name="q" value="<?= e($search) ?>" placeholder="e.g. TZ1042 or John" />
    </div>
    <button type="submit" class="admin-btn">Search</button>
</form>

<div class="admin-card">
    <?php if (!$bookings): ?>
        <div class="admin-empty-state">No bookings found.</div>
    <?php else: ?>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Reference</th>
                    <th>Customer</th>
                    <th>Safari</th>
                    <th>Travel Date</th>
                    <th>Total</th>
                    <th>Paid</th>
                    <th>Status</th>
                    <th>Received</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($bookings as $b): ?>
                <tr>
                    <td><a href="<?= admin_base_url() ?>/bookings/view.php?id=<?= $b['id'] ?>"><strong>#<?= e($b['reference']) ?></strong></a></td>
                    <td><?= e($b['first_name'] . ' ' . $b['last_name']) ?><br><span style="color:#888;font-size:0.8rem;"><?= e($b['email']) ?></span></td>
                    <td><?= e($b['safari_title']) ?></td>
                    <td><?= $b['travel_date'] ? e(date('d M Y', strtotime($b['travel_date']))) : '—' ?></td>
                    <td><?= $b['estimated_total'] !== null ? e($b['currency'] . ' ' . number_format((float) $b['estimated_total'], 2)) : '—' ?></td>
                    <td><?= e($b['currency'] . ' ' . number_format((float) $b['paid_amount'], 2)) ?></td>
                    <td><span class="admin-badge <?= e($b['status']) ?>"><?= ucwords(str_replace('_', ' ', $b['status'])) ?></span></td>
                    <td><?= e(date('d M Y', strtotime($b['created_at']))) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
