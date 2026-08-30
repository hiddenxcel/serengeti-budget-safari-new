<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

require_admin();

$pageTitle = 'Customers';
$search = trim((string) ($_GET['q'] ?? ''));

$where = '';
$params = [];

if ($search !== '') {
    $where = 'WHERE c.first_name LIKE ? OR c.last_name LIKE ? OR c.email LIKE ? OR c.country LIKE ?';
    $like = '%' . $search . '%';
    $params = [$like, $like, $like, $like];
}

$sql = "SELECT c.id, c.first_name, c.last_name, c.email, c.country, c.created_at,
               COUNT(b.id) AS booking_count,
               COALESCE((SELECT SUM(p.amount) FROM payments p INNER JOIN bookings b2 ON b2.id = p.booking_id WHERE b2.customer_id = c.id), 0) AS total_spent
        FROM customers c
        LEFT JOIN bookings b ON b.customer_id = c.id
        $where
        GROUP BY c.id
        ORDER BY c.created_at DESC";

$stmt = db()->prepare($sql);
$stmt->execute($params);
$customers = $stmt->fetchAll();

$totalCount = (int) db()->query('SELECT COUNT(*) FROM customers')->fetchColumn();

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<div class="admin-toolbar">
    <div><strong><?= $totalCount ?></strong> total customers</div>
</div>

<form method="get" class="admin-card" style="display:flex;gap:0.75rem;flex-wrap:wrap;align-items:end;">
    <div class="admin-form-group" style="flex:1;min-width:220px;margin-bottom:0;">
        <label for="q">Search by name, email, or country</label>
        <input type="text" id="q" name="q" value="<?= e($search) ?>" placeholder="e.g. John or Germany" />
    </div>
    <button type="submit" class="admin-btn">Search</button>
</form>

<div class="admin-card">
    <?php if (!$customers): ?>
        <div class="admin-empty-state">No customers found.</div>
    <?php else: ?>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Country</th>
                    <th>Bookings</th>
                    <th>Total Spent</th>
                    <th>Customer Since</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($customers as $c): ?>
                <tr>
                    <td><a href="<?= admin_base_url() ?>/customers/view.php?id=<?= $c['id'] ?>"><strong><?= e($c['first_name'] . ' ' . $c['last_name']) ?></strong></a></td>
                    <td><?= e($c['email']) ?></td>
                    <td><?= e($c['country'] ?: '—') ?></td>
                    <td><?= (int) $c['booking_count'] ?></td>
                    <td>$<?= number_format((float) $c['total_spent'], 2) ?></td>
                    <td><?= e(date('d M Y', strtotime($c['created_at']))) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
