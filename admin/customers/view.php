<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

require_admin();

$id = (int) ($_GET['id'] ?? 0);

$stmt = db()->prepare('SELECT * FROM customers WHERE id = ?');
$stmt->execute([$id]);
$customer = $stmt->fetch();

if (!$customer) {
    http_response_code(404);
    exit('Customer not found.');
}

$pageTitle = $customer['first_name'] . ' ' . $customer['last_name'];
$success = null;
$errors = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Your session expired, please try again.';
    } else {
        $notes = trim((string) ($_POST['notes'] ?? ''));
        db()->prepare('UPDATE customers SET notes = ? WHERE id = ?')->execute([$notes ?: null, $id]);
        $customer['notes'] = $notes ?: null;
        $success = 'Notes saved.';
    }
}

$bookingsStmt = db()->prepare(
    "SELECT b.id, b.reference, b.status, b.estimated_total, b.currency, b.travel_date, b.created_at,
            COALESCE(s.title_en, b.special_requests, 'Custom request') AS safari_title
     FROM bookings b
     LEFT JOIN safaris s ON s.id = b.safari_id
     WHERE b.customer_id = ?
     ORDER BY b.created_at DESC"
);
$bookingsStmt->execute([$id]);
$bookings = $bookingsStmt->fetchAll();

$paymentsStmt = db()->prepare(
    "SELECT p.*, b.reference AS booking_reference
     FROM payments p
     INNER JOIN bookings b ON b.id = p.booking_id
     WHERE b.customer_id = ?
     ORDER BY p.paid_at DESC"
);
$paymentsStmt->execute([$id]);
$payments = $paymentsStmt->fetchAll();

$totalSpent = array_sum(array_column($payments, 'amount'));

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<?php if ($success): ?>
    <div class="admin-success-msg"><?= e($success) ?></div>
<?php endif; ?>
<?php foreach ($errors as $error): ?>
    <div class="admin-error"><?= e($error) ?></div>
<?php endforeach; ?>

<div class="admin-toolbar">
    <div></div>
    <a href="<?= admin_base_url() ?>/customers/index.php" class="admin-btn">← Back to Customers</a>
</div>

<div class="admin-card">
    <div class="admin-form-row">
        <div>
            <h3 style="margin:0 0 0.5rem;font-size:0.85rem;color:#888;text-transform:uppercase;">Personal Details</h3>
            <p style="margin:0;">
                <?= e($customer['first_name'] . ' ' . $customer['last_name']) ?><br>
                <?= e($customer['email']) ?><br>
                <?= e($customer['phone'] ?: '—') ?><br>
                <?= e($customer['country'] ?: '—') ?>
            </p>
        </div>
        <div>
            <h3 style="margin:0 0 0.5rem;font-size:0.85rem;color:#888;text-transform:uppercase;">Bookings</h3>
            <p style="margin:0;"><?= count($bookings) ?> total</p>
        </div>
        <div>
            <h3 style="margin:0 0 0.5rem;font-size:0.85rem;color:#888;text-transform:uppercase;">Total Paid</h3>
            <p style="margin:0;">$<?= number_format($totalSpent, 2) ?></p>
        </div>
        <div>
            <h3 style="margin:0 0 0.5rem;font-size:0.85rem;color:#888;text-transform:uppercase;">Customer Since</h3>
            <p style="margin:0;"><?= e(date('d M Y', strtotime($customer['created_at']))) ?></p>
        </div>
    </div>
</div>

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Bookings</h2>
    <?php if (!$bookings): ?>
        <div class="admin-empty-state">No bookings yet.</div>
    <?php else: ?>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>Reference</th><th>Safari</th><th>Travel Date</th><th>Total</th><th>Status</th><th>Received</th></tr></thead>
            <tbody>
                <?php foreach ($bookings as $b): ?>
                <tr>
                    <td><a href="<?= admin_base_url() ?>/bookings/view.php?id=<?= $b['id'] ?>"><strong>#<?= e($b['reference']) ?></strong></a></td>
                    <td><?= e($b['safari_title']) ?></td>
                    <td><?= $b['travel_date'] ? e(date('d M Y', strtotime($b['travel_date']))) : '—' ?></td>
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
    <h2 style="margin-top:0;font-size:1.05rem;">Payment History</h2>
    <?php if (!$payments): ?>
        <div class="admin-empty-state">No payments recorded yet.</div>
    <?php else: ?>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>Date</th><th>Booking</th><th>Amount</th><th>Method</th><th>Note</th></tr></thead>
            <tbody>
                <?php foreach ($payments as $p): ?>
                <tr>
                    <td><?= e(date('d M Y', strtotime($p['paid_at']))) ?></td>
                    <td><a href="<?= admin_base_url() ?>/bookings/view.php?id=<?= $p['booking_id'] ?>">#<?= e($p['booking_reference']) ?></a></td>
                    <td><?= e($p['currency'] . ' ' . number_format((float) $p['amount'], 2)) ?></td>
                    <td><?= ucwords(str_replace('_', ' ', $p['method'])) ?></td>
                    <td><?= e($p['note'] ?: '—') ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Internal Notes</h2>
    <p style="color:#666;font-size:0.85rem;">Private notes visible only to staff — not shown to the customer.</p>
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
        <div class="admin-form-group">
            <textarea name="notes" rows="4" placeholder="e.g. Prefers window seat, repeat customer, allergic to nuts..."><?= e($customer['notes'] ?? '') ?></textarea>
        </div>
        <button type="submit" class="admin-btn primary">Save Notes</button>
    </form>
</div>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
