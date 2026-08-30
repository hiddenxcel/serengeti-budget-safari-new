<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';
require_once dirname(__DIR__) . '/includes/booking-helpers.php';

require_admin();

$id = (int) ($_GET['id'] ?? 0);

$stmt = db()->prepare(
    "SELECT b.*, c.first_name, c.last_name, c.email, c.phone, c.country,
            COALESCE(s.title_en, b.special_requests, 'Custom request') AS safari_title,
            s.slug AS safari_slug
     FROM bookings b
     INNER JOIN customers c ON c.id = b.customer_id
     LEFT JOIN safaris s ON s.id = b.safari_id
     WHERE b.id = ?"
);
$stmt->execute([$id]);
$booking = $stmt->fetch();

if (!$booking) {
    http_response_code(404);
    exit('Booking not found.');
}

$pageTitle = 'Booking #' . $booking['reference'];
$errors = [];
$success = null;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Your session expired, please try again.';
    } else {
        $action = (string) ($_POST['action'] ?? '');

        if ($action === 'set_status' && in_array($_POST['status'] ?? '', admin_booking_statuses(), true)) {
            db()->prepare('UPDATE bookings SET status = ? WHERE id = ?')->execute([$_POST['status'], $id]);
            $success = 'Booking status updated.';
        } elseif ($action === 'record_payment') {
            $amount = (float) ($_POST['amount'] ?? 0);
            $method = in_array($_POST['method'] ?? '', ['bank_transfer', 'mobile_money', 'cash', 'other'], true) ? $_POST['method'] : 'other';
            $paidAt = trim((string) ($_POST['paid_at'] ?? '')) ?: date('Y-m-d');
            $note = trim((string) ($_POST['note'] ?? ''));

            if ($amount <= 0) {
                $errors[] = 'Payment amount must be greater than zero.';
            } else {
                db()->prepare('INSERT INTO payments (booking_id, amount, currency, method, paid_at, note, recorded_by) VALUES (?, ?, ?, ?, ?, ?, ?)')
                    ->execute([$id, $amount, $booking['currency'], $method, $paidAt, $note ?: null, current_admin()['id']]);

                // Auto-advance status based on paid vs estimated total.
                $paidStmt = db()->prepare('SELECT COALESCE(SUM(amount), 0) FROM payments WHERE booking_id = ?');
                $paidStmt->execute([$id]);
                $totalPaid = (float) $paidStmt->fetchColumn();
                $estimatedTotal = (float) ($booking['estimated_total'] ?? 0);

                $autoAdvanceableStatuses = ['pending', 'confirmed', 'partially_paid'];
                if (in_array($booking['status'], $autoAdvanceableStatuses, true)) {
                    if ($estimatedTotal > 0 && $totalPaid >= $estimatedTotal) {
                        db()->prepare("UPDATE bookings SET status = 'paid' WHERE id = ?")->execute([$id]);
                    } elseif ($totalPaid > 0) {
                        db()->prepare("UPDATE bookings SET status = 'partially_paid' WHERE id = ?")->execute([$id]);
                    }
                }
                $success = 'Payment recorded.';
            }
        } elseif ($action === 'delete_payment') {
            $paymentId = (int) ($_POST['payment_id'] ?? 0);
            db()->prepare('DELETE FROM payments WHERE id = ? AND booking_id = ?')->execute([$paymentId, $id]);
            $success = 'Payment removed.';
        }

        // Re-fetch after any update
        $stmt->execute([$id]);
        $booking = $stmt->fetch();
    }
}

$paymentsStmt = db()->prepare('SELECT p.*, u.name AS recorded_by_name FROM payments p LEFT JOIN users u ON u.id = p.recorded_by WHERE p.booking_id = ? ORDER BY p.paid_at DESC, p.id DESC');
$paymentsStmt->execute([$id]);
$payments = $paymentsStmt->fetchAll();

$totalPaid = array_sum(array_column($payments, 'amount'));
$estimatedTotal = (float) ($booking['estimated_total'] ?? 0);
$balance = $estimatedTotal - $totalPaid;

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<?php if ($success): ?>
    <div class="admin-success-msg"><?= e($success) ?></div>
<?php endif; ?>
<?php foreach ($errors as $error): ?>
    <div class="admin-error"><?= e($error) ?></div>
<?php endforeach; ?>

<div class="admin-card">
    <div class="admin-toolbar">
        <div>
            <span class="admin-badge <?= e($booking['status']) ?>" style="font-size:0.9rem;"><?= ucwords(str_replace('_', ' ', $booking['status'])) ?></span>
        </div>
        <div>
            <a href="<?= admin_base_url() ?>/bookings/invoice.php?id=<?= $id ?>" class="admin-btn" target="_blank">Download Invoice</a>
            <a href="<?= admin_base_url() ?>/bookings/index.php" class="admin-btn">← Back to Bookings</a>
        </div>
    </div>

    <div class="admin-form-row" style="margin-top:1.5rem;">
        <div>
            <h3 style="margin:0 0 0.5rem;font-size:0.85rem;color:#888;text-transform:uppercase;">Customer</h3>
            <p style="margin:0;"><?= e($booking['first_name'] . ' ' . $booking['last_name']) ?><br>
            <?= e($booking['email']) ?><br>
            <?= e($booking['phone'] ?: '—') ?><br>
            <?= e($booking['country'] ?: '—') ?></p>
        </div>
        <div>
            <h3 style="margin:0 0 0.5rem;font-size:0.85rem;color:#888;text-transform:uppercase;">Safari</h3>
            <p style="margin:0;"><?= e($booking['safari_title']) ?><br>
            Travel date: <?= $booking['travel_date'] ? e(date('d M Y', strtotime($booking['travel_date']))) : 'Not specified' ?><br>
            Travelers: <?= (int) $booking['adults'] ?> adult(s)<?= $booking['children'] > 0 ? ', ' . (int) $booking['children'] . ' child(ren)' : '' ?></p>
        </div>
        <div>
            <h3 style="margin:0 0 0.5rem;font-size:0.85rem;color:#888;text-transform:uppercase;">Payment</h3>
            <p style="margin:0;">
                Total: <strong><?= e($booking['currency'] . ' ' . number_format($estimatedTotal, 2)) ?></strong><br>
                Paid: <strong style="color:#1e824c;"><?= e($booking['currency'] . ' ' . number_format($totalPaid, 2)) ?></strong><br>
                Balance: <strong style="color:<?= $balance > 0 ? '#c0392b' : '#1e824c' ?>;"><?= e($booking['currency'] . ' ' . number_format(max(0, $balance), 2)) ?></strong>
            </p>
        </div>
    </div>

    <?php if (!empty($booking['special_requests'])): ?>
    <div style="margin-top:1.25rem;">
        <h3 style="margin:0 0 0.5rem;font-size:0.85rem;color:#888;text-transform:uppercase;">Notes / Special Requests</h3>
        <p style="margin:0;white-space:pre-wrap;"><?= e($booking['special_requests']) ?></p>
    </div>
    <?php endif; ?>

    <div class="admin-row-actions" style="margin-top:1.5rem;">
        <?php foreach (admin_booking_statuses() as $s): ?>
            <?php if ($s !== $booking['status']): ?>
            <form method="post" style="display:inline;">
                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                <input type="hidden" name="action" value="set_status" />
                <input type="hidden" name="status" value="<?= e($s) ?>" />
                <button type="submit" class="admin-btn <?= $s === 'cancelled' ? 'danger' : '' ?>">Mark <?= ucwords(str_replace('_', ' ', $s)) ?></button>
            </form>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
</div>

<div class="admin-card">
    <h2 style="margin-top:0;font-size:1.05rem;">Record a Payment</h2>
    <p style="color:#666;font-size:0.88rem;">Payment happens off-site (bank transfer, mobile money, or cash). Record it here once received.</p>
    <form method="post">
        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
        <input type="hidden" name="action" value="record_payment" />
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="amount">Amount (<?= e($booking['currency']) ?>)</label>
                <input type="number" step="0.01" id="amount" name="amount" required />
            </div>
            <div class="admin-form-group">
                <label for="method">Method</label>
                <select id="method" name="method">
                    <option value="bank_transfer">Bank Transfer</option>
                    <option value="mobile_money">Mobile Money</option>
                    <option value="cash">Cash</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="admin-form-group">
                <label for="paid_at">Date Received</label>
                <input type="date" id="paid_at" name="paid_at" value="<?= e(date('Y-m-d')) ?>" />
            </div>
        </div>
        <div class="admin-form-group">
            <label for="note">Note (optional)</label>
            <input type="text" id="note" name="note" placeholder="e.g. Deposit via M-Pesa" />
        </div>
        <button type="submit" class="admin-btn primary">Record Payment</button>
    </form>

    <?php if ($payments): ?>
    <h3 style="margin-top:2rem;font-size:0.95rem;">Payment History</h3>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead><tr><th>Date</th><th>Amount</th><th>Method</th><th>Note</th><th>Recorded By</th><th></th></tr></thead>
            <tbody>
                <?php foreach ($payments as $p): ?>
                <tr>
                    <td><?= e(date('d M Y', strtotime($p['paid_at']))) ?></td>
                    <td><?= e($p['currency'] . ' ' . number_format((float) $p['amount'], 2)) ?></td>
                    <td><?= ucwords(str_replace('_', ' ', $p['method'])) ?></td>
                    <td><?= e($p['note'] ?: '—') ?></td>
                    <td><?= e($p['recorded_by_name'] ?: '—') ?></td>
                    <td>
                        <form method="post" onsubmit="return confirm('Remove this payment record?');">
                            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                            <input type="hidden" name="action" value="delete_payment" />
                            <input type="hidden" name="payment_id" value="<?= $p['id'] ?>" />
                            <button type="submit" class="admin-btn danger" style="padding:0.3rem 0.6rem;font-size:0.78rem;">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
