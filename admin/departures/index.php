<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

require_admin();

$pageTitle = 'Group Departures';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        http_response_code(400);
        exit('Invalid request.');
    }

    $action = (string) ($_POST['action'] ?? '');
    $id = (int) ($_POST['id'] ?? 0);

    if ($id > 0 && $action === 'cancel') {
        db()->prepare("UPDATE departures SET status = 'cancelled' WHERE id = ?")->execute([$id]);
    } elseif ($id > 0 && $action === 'reopen') {
        db()->prepare("UPDATE departures SET status = 'open' WHERE id = ?")->execute([$id]);
    } elseif ($id > 0 && $action === 'delete') {
        db()->prepare('DELETE FROM departures WHERE id = ?')->execute([$id]);
    }

    header('Location: ' . admin_base_url() . '/departures/index.php');
    exit;
}

$departures = db()->query(
    "SELECT d.*,
            (SELECT COALESCE(SUM(b.adults + b.children), 0) FROM bookings b
             WHERE b.departure_id = d.id AND b.status != 'cancelled') AS booked_seats
     FROM departures d
     ORDER BY d.departure_date ASC"
)->fetchAll();

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<div class="admin-toolbar">
    <div></div>
    <a href="<?= admin_base_url() ?>/departures/edit.php" class="admin-btn primary">+ Add Departure</a>
</div>

<div class="admin-card">
    <?php if (!$departures): ?>
        <div class="admin-empty-state">No departures yet. Add one to start showing real group-joining dates on the site.</div>
    <?php else: ?>
    <div class="admin-table-wrap">
        <table class="admin-table">
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Itinerary</th>
                    <th>Price</th>
                    <th>Seats</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($departures as $d): ?>
                <?php
                    $available = (int) $d['capacity'] - (int) $d['booked_seats'];
                    $seatStatus = $available <= 0 ? 'full' : ($available <= 2 ? 'filling' : 'open');
                ?>
                <tr>
                    <td><strong><?= e(date('d M Y', strtotime($d['departure_date']))) ?></strong></td>
                    <td><?= e($d['itinerary_label']) ?></td>
                    <td><?= e($d['currency'] . ' ' . number_format((float) $d['price_per_person'], 2)) ?></td>
                    <td>
                        <span class="admin-badge <?= $seatStatus === 'full' ? 'cancelled' : ($seatStatus === 'filling' ? 'pending' : 'published') ?>">
                            <?= (int) $d['booked_seats'] ?> / <?= (int) $d['capacity'] ?>
                            <?= $available > 0 ? '(' . $available . ' left)' : '(FULL)' ?>
                        </span>
                    </td>
                    <td><span class="admin-badge <?= $d['status'] === 'cancelled' ? 'cancelled' : 'published' ?>"><?= ucfirst($d['status']) ?></span></td>
                    <td>
                        <div class="admin-row-actions">
                            <a class="admin-btn" href="<?= admin_base_url() ?>/departures/edit.php?id=<?= $d['id'] ?>">Edit</a>
                            <?php if ($d['status'] === 'open'): ?>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                                <input type="hidden" name="id" value="<?= $d['id'] ?>" />
                                <input type="hidden" name="action" value="cancel" />
                                <button type="submit" class="admin-btn danger">Cancel</button>
                            </form>
                            <?php else: ?>
                            <form method="post" style="display:inline;">
                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                                <input type="hidden" name="id" value="<?= $d['id'] ?>" />
                                <input type="hidden" name="action" value="reopen" />
                                <button type="submit" class="admin-btn">Reopen</button>
                            </form>
                            <?php endif; ?>
                            <form method="post" style="display:inline;" onsubmit="return confirm('Delete this departure permanently?');">
                                <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                                <input type="hidden" name="id" value="<?= $d['id'] ?>" />
                                <input type="hidden" name="action" value="delete" />
                                <button type="submit" class="admin-btn danger">Delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php endif; ?>
</div>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
