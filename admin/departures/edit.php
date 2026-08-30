<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

require_admin();

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$departure = null;
$errors = [];

if ($id) {
    $stmt = db()->prepare('SELECT * FROM departures WHERE id = ?');
    $stmt->execute([$id]);
    $departure = $stmt->fetch();

    if (!$departure) {
        http_response_code(404);
        exit('Departure not found.');
    }
}

$pageTitle = $id ? 'Edit Departure' : 'Add Departure';

$safaris = db()->query("SELECT id, title_en FROM safaris WHERE status = 'published' ORDER BY title_en")->fetchAll();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Your session expired, please try again.';
    } else {
        $itineraryLabel = trim((string) ($_POST['itinerary_label'] ?? ''));
        $departureDate = trim((string) ($_POST['departure_date'] ?? ''));
        $price = (float) ($_POST['price_per_person'] ?? 0);
        $currency = trim((string) ($_POST['currency'] ?? 'USD')) ?: 'USD';
        $capacity = max(1, (int) ($_POST['capacity'] ?? 6));
        $safariId = (int) ($_POST['safari_id'] ?? 0) ?: null;

        if ($itineraryLabel === '') {
            $errors[] = 'Itinerary label is required.';
        }
        if ($departureDate === '' || !DateTime::createFromFormat('Y-m-d', $departureDate)) {
            $errors[] = 'A valid departure date is required.';
        }
        if ($price <= 0) {
            $errors[] = 'Price per person must be greater than zero.';
        }

        if (!$errors) {
            if ($id) {
                db()->prepare(
                    'UPDATE departures SET safari_id = ?, itinerary_label = ?, departure_date = ?, price_per_person = ?, currency = ?, capacity = ? WHERE id = ?'
                )->execute([$safariId, $itineraryLabel, $departureDate, $price, $currency, $capacity, $id]);
                $departureId = $id;
            } else {
                db()->prepare(
                    'INSERT INTO departures (safari_id, itinerary_label, departure_date, price_per_person, currency, capacity) VALUES (?, ?, ?, ?, ?, ?)'
                )->execute([$safariId, $itineraryLabel, $departureDate, $price, $currency, $capacity]);
                $departureId = (int) db()->lastInsertId();
            }

            header('Location: ' . admin_base_url() . '/departures/edit.php?id=' . $departureId . '&saved=1');
            exit;
        }
    }
}

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<?php if (!empty($_GET['saved'])): ?>
    <div class="admin-success-msg">Departure saved successfully.</div>
<?php endif; ?>
<?php foreach ($errors as $error): ?>
    <div class="admin-error"><?= e($error) ?></div>
<?php endforeach; ?>

<form method="post" action="">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />

    <div class="admin-card">
        <div class="admin-form-group">
            <label for="itinerary_label">Itinerary Label</label>
            <input type="text" id="itinerary_label" name="itinerary_label" required value="<?= e($departure['itinerary_label'] ?? '') ?>" placeholder="e.g. 4-Day Big Five Safari" />
        </div>
        <div class="admin-form-group">
            <label for="safari_id">Link to a published safari (optional)</label>
            <select id="safari_id" name="safari_id">
                <option value="">— None (just a label) —</option>
                <?php foreach ($safaris as $s): ?>
                    <option value="<?= $s['id'] ?>" <?= (int) ($departure['safari_id'] ?? 0) === (int) $s['id'] ? 'selected' : '' ?>><?= e($s['title_en']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="departure_date">Departure Date</label>
                <input type="date" id="departure_date" name="departure_date" required value="<?= e($departure['departure_date'] ?? '') ?>" />
            </div>
            <div class="admin-form-group">
                <label for="capacity">Vehicle Capacity (seats)</label>
                <input type="number" id="capacity" name="capacity" min="1" value="<?= e((string) ($departure['capacity'] ?? 6)) ?>" />
            </div>
        </div>
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="price_per_person">Price per person</label>
                <input type="number" step="0.01" id="price_per_person" name="price_per_person" required value="<?= e((string) ($departure['price_per_person'] ?? '')) ?>" />
            </div>
            <div class="admin-form-group">
                <label for="currency">Currency</label>
                <input type="text" id="currency" name="currency" maxlength="3" value="<?= e($departure['currency'] ?? 'USD') ?>" />
            </div>
        </div>
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="admin-btn primary">Save Departure</button>
        <a href="<?= admin_base_url() ?>/departures/index.php" class="admin-btn">Cancel</a>
    </div>
</form>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
