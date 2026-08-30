<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

require_admin();

$id = (int) ($_GET['id'] ?? 0);

$stmt = db()->prepare(
    "SELECT b.*, c.first_name, c.last_name, c.email, c.phone, c.country,
            COALESCE(s.title_en, b.special_requests, 'Custom request') AS safari_title
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

$paymentsStmt = db()->prepare('SELECT * FROM payments WHERE booking_id = ? ORDER BY paid_at ASC, id ASC');
$paymentsStmt->execute([$id]);
$payments = $paymentsStmt->fetchAll();

$totalPaid = array_sum(array_column($payments, 'amount'));
$estimatedTotal = (float) ($booking['estimated_total'] ?? 0);
$balance = max(0, $estimatedTotal - $totalPaid);
$invoiceNumber = 'INV-' . str_pad((string) $booking['id'], 4, '0', STR_PAD_LEFT);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Invoice <?= e($invoiceNumber) ?> — Serengeti Budget Safari</title>
    <meta name="robots" content="noindex, nofollow" />
    <style>
        * { box-sizing: border-box; }
        body { font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif; color: #202020; margin: 0; background: #f4f5f7; }
        .invoice-wrap { max-width: 760px; margin: 2rem auto; background: #fff; padding: 2.5rem; border-radius: 10px; box-shadow: 0 1px 4px rgba(0,0,0,0.08); }
        .invoice-header { display: flex; justify-content: space-between; align-items: flex-start; flex-wrap: wrap; gap: 1rem; border-bottom: 2px solid #1c1f26; padding-bottom: 1.5rem; margin-bottom: 1.5rem; }
        .invoice-brand { font-size: 1.3rem; font-weight: 700; }
        .invoice-brand small { display: block; font-weight: 400; font-size: 0.85rem; color: #666; margin-top: 0.25rem; }
        .invoice-meta { text-align: right; font-size: 0.9rem; color: #555; }
        .invoice-meta strong { display: block; font-size: 1.1rem; color: #202020; }
        .invoice-badge { display: inline-block; padding: 0.25rem 0.75rem; border-radius: 999px; font-size: 0.78rem; font-weight: 600; margin-top: 0.4rem; }
        .invoice-badge.pending { background: #fdf3d9; color: #b8860b; }
        .invoice-badge.confirmed { background: #dbeafe; color: #1d4ed8; }
        .invoice-badge.partially_paid { background: #fef0d9; color: #c2740b; }
        .invoice-badge.paid { background: #d9f2e3; color: #1e824c; }
        .invoice-badge.cancelled { background: #fbe0dd; color: #c0392b; }
        .invoice-badge.completed { background: #e7e7e7; color: #444; }
        .invoice-columns { display: flex; gap: 2rem; flex-wrap: wrap; margin-bottom: 2rem; }
        .invoice-columns > div { flex: 1; min-width: 220px; }
        .invoice-columns h3 { margin: 0 0 0.5rem; font-size: 0.78rem; text-transform: uppercase; color: #888; letter-spacing: 0.03em; }
        .invoice-columns p { margin: 0; line-height: 1.6; }
        table.invoice-table { width: 100%; border-collapse: collapse; margin-bottom: 1.5rem; }
        .invoice-table th, .invoice-table td { text-align: left; padding: 0.7rem 0.5rem; border-bottom: 1px solid #e1e3e8; font-size: 0.92rem; }
        .invoice-table th { color: #666; font-size: 0.78rem; text-transform: uppercase; }
        .invoice-table td.num, .invoice-table th.num { text-align: right; }
        .invoice-totals { margin-left: auto; max-width: 320px; }
        .invoice-totals-row { display: flex; justify-content: space-between; padding: 0.5rem 0; font-size: 0.95rem; }
        .invoice-totals-row.grand { border-top: 2px solid #1c1f26; margin-top: 0.5rem; padding-top: 0.75rem; font-size: 1.15rem; font-weight: 700; }
        .invoice-totals-row.balance-due span:last-child { color: #c0392b; font-weight: 700; }
        .invoice-totals-row.balance-clear span:last-child { color: #1e824c; font-weight: 700; }
        .invoice-note { margin-top: 2rem; padding: 1rem 1.25rem; background: #fafafa; border-left: 4px solid #d4a843; border-radius: 6px; font-size: 0.85rem; color: #555; }
        .invoice-actions { max-width: 760px; margin: 0 auto 1rem; text-align: right; }
        .invoice-actions a, .invoice-actions button { display: inline-block; padding: 0.6rem 1.2rem; border-radius: 6px; border: 1px solid #e1e3e8; background: #fff; color: #202020; text-decoration: none; font-size: 0.9rem; cursor: pointer; margin-left: 0.5rem; }
        .invoice-actions .primary { background: #1c1f26; color: #fff; border-color: #1c1f26; }
        @media print {
            body { background: #fff; }
            .invoice-actions { display: none; }
            .invoice-wrap { box-shadow: none; margin: 0; max-width: 100%; }
        }
        @media (max-width: 600px) {
            .invoice-wrap { margin: 0.75rem; padding: 1.5rem; }
            .invoice-header { flex-direction: column; }
            .invoice-meta { text-align: left; }
        }
    </style>
</head>
<body>
    <div class="invoice-actions">
        <a href="<?= admin_base_url() ?>/bookings/view.php?id=<?= $id ?>">← Back to Booking</a>
        <button type="button" class="primary" onclick="window.print()">Print / Save as PDF</button>
    </div>

    <div class="invoice-wrap">
        <div class="invoice-header">
            <div class="invoice-brand">
                Serengeti Budget Safari
                <small>Arusha, Tanzania<br />serengetibudgetsafari@gmail.com &middot; +255 697 612 865</small>
            </div>
            <div class="invoice-meta">
                <strong>Invoice <?= e($invoiceNumber) ?></strong>
                Booking #<?= e($booking['reference']) ?><br>
                Issued <?= e(date('d M Y')) ?>
                <br><span class="invoice-badge <?= e($booking['status']) ?>"><?= ucwords(str_replace('_', ' ', $booking['status'])) ?></span>
            </div>
        </div>

        <div class="invoice-columns">
            <div>
                <h3>Billed To</h3>
                <p>
                    <?= e($booking['first_name'] . ' ' . $booking['last_name']) ?><br>
                    <?= e($booking['email']) ?><br>
                    <?= e($booking['phone'] ?: '') ?><br>
                    <?= e($booking['country'] ?: '') ?>
                </p>
            </div>
            <div>
                <h3>Trip Details</h3>
                <p>
                    <?= e($booking['safari_title']) ?><br>
                    Travel date: <?= $booking['travel_date'] ? e(date('d M Y', strtotime($booking['travel_date']))) : 'To be confirmed' ?><br>
                    Travelers: <?= (int) $booking['adults'] ?> adult(s)<?= $booking['children'] > 0 ? ', ' . (int) $booking['children'] . ' child(ren)' : '' ?>
                </p>
            </div>
        </div>

        <table class="invoice-table">
            <thead>
                <tr>
                    <th>Description</th>
                    <th class="num">Travelers</th>
                    <th class="num">Amount</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= e($booking['safari_title']) ?></td>
                    <td class="num"><?= (int) $booking['adults'] + (int) $booking['children'] ?></td>
                    <td class="num"><?= e($booking['currency'] . ' ' . number_format($estimatedTotal, 2)) ?></td>
                </tr>
            </tbody>
        </table>

        <?php if ($payments): ?>
        <h3 style="font-size:0.9rem;margin-bottom:0.5rem;">Payments Received</h3>
        <table class="invoice-table">
            <thead>
                <tr><th>Date</th><th>Method</th><th class="num">Amount</th></tr>
            </thead>
            <tbody>
                <?php foreach ($payments as $p): ?>
                <tr>
                    <td><?= e(date('d M Y', strtotime($p['paid_at']))) ?></td>
                    <td><?= ucwords(str_replace('_', ' ', $p['method'])) ?></td>
                    <td class="num"><?= e($p['currency'] . ' ' . number_format((float) $p['amount'], 2)) ?></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>

        <div class="invoice-totals">
            <div class="invoice-totals-row grand"><span>Total</span><span><?= e($booking['currency'] . ' ' . number_format($estimatedTotal, 2)) ?></span></div>
            <div class="invoice-totals-row"><span>Paid</span><span><?= e($booking['currency'] . ' ' . number_format($totalPaid, 2)) ?></span></div>
            <div class="invoice-totals-row <?= $balance > 0 ? 'balance-due' : 'balance-clear' ?>"><span>Balance Due</span><span><?= e($booking['currency'] . ' ' . number_format($balance, 2)) ?></span></div>
        </div>

        <div class="invoice-note">
            Payment for this booking is arranged directly with our team (bank transfer, mobile money, or cash) — no online payment is processed through our website. Please contact us on WhatsApp at +255 697 612 865 with any questions about this invoice.
        </div>
    </div>
</body>
</html>
