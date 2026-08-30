<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';
require_once dirname(__DIR__) . '/includes/safari-helpers.php';

require_admin();

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$safari = null;
$days = [];
$tiers = [];
$pricingOptions = null;
$errors = [];

if ($id) {
    $stmt = db()->prepare('SELECT * FROM safaris WHERE id = ?');
    $stmt->execute([$id]);
    $safari = $stmt->fetch();

    if (!$safari) {
        http_response_code(404);
        exit('Safari not found.');
    }

    $daysStmt = db()->prepare('SELECT * FROM safari_days WHERE safari_id = ? ORDER BY day_number');
    $daysStmt->execute([$id]);
    $days = $daysStmt->fetchAll();

    $tiersStmt = db()->prepare('SELECT * FROM pricing_tiers WHERE safari_id = ? ORDER BY up_to_travelers');
    $tiersStmt->execute([$id]);
    $tiers = $tiersStmt->fetchAll();

    $optStmt = db()->prepare('SELECT * FROM safari_pricing_options WHERE safari_id = ?');
    $optStmt->execute([$id]);
    $pricingOptions = $optStmt->fetch() ?: null;
}

$pageTitle = $id ? 'Edit Safari' : 'Add Safari';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Your session expired, please try again.';
    } else {
        $titleEn = trim((string) ($_POST['title_en'] ?? ''));
        $titleIt = trim((string) ($_POST['title_it'] ?? ''));
        $durationDays = max(1, (int) ($_POST['duration_days'] ?? 1));
        $status = in_array($_POST['status'] ?? '', admin_safari_statuses(), true) ? $_POST['status'] : 'draft';

        if ($titleEn === '') {
            $errors[] = 'English title is required.';
        }
        if ($titleIt === '') {
            $errors[] = 'Italian title is required.';
        }

        $mainImage = trim((string) ($_POST['main_image'] ?? ''));

        if (!$errors) {
            $slugInput = trim((string) ($_POST['slug'] ?? '')) ?: $titleEn;
            $slug = admin_unique_safari_slug($slugInput, $id);

            $fields = [
                'slug' => $slug,
                'title_en' => $titleEn,
                'title_it' => $titleIt,
                'short_description_en' => trim((string) ($_POST['short_description_en'] ?? '')),
                'short_description_it' => trim((string) ($_POST['short_description_it'] ?? '')),
                'description_en' => trim((string) ($_POST['description_en'] ?? '')),
                'description_it' => trim((string) ($_POST['description_it'] ?? '')),
                'duration_days' => $durationDays,
                'safari_type' => trim((string) ($_POST['safari_type'] ?? '')) ?: null,
                'destination' => trim((string) ($_POST['destination'] ?? '')) ?: null,
                'start_location' => trim((string) ($_POST['start_location'] ?? '')) ?: null,
                'end_location' => trim((string) ($_POST['end_location'] ?? '')) ?: null,
                'main_image' => $mainImage ?: null,
                'status' => $status,
            ];

            if ($id) {
                $set = implode(', ', array_map(fn($k) => "$k = :$k", array_keys($fields)));
                $stmt = db()->prepare("UPDATE safaris SET $set WHERE id = :id");
                $stmt->execute($fields + ['id' => $id]);
                $safariId = $id;
            } else {
                $fields['created_by'] = current_admin()['id'];
                $cols = implode(', ', array_keys($fields));
                $placeholders = implode(', ', array_map(fn($k) => ":$k", array_keys($fields)));
                $stmt = db()->prepare("INSERT INTO safaris ($cols) VALUES ($placeholders)");
                $stmt->execute($fields);
                $safariId = (int) db()->lastInsertId();
            }

            // Replace itinerary days
            db()->prepare('DELETE FROM safari_days WHERE safari_id = ?')->execute([$safariId]);
            $dayTitlesEn = $_POST['day_title_en'] ?? [];
            $dayInsert = db()->prepare('INSERT INTO safari_days
                (safari_id, day_number, title_en, title_it, description_en, description_it, activities_en, activities_it, meals, accommodation)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)');

            foreach ($dayTitlesEn as $i => $titleEnDay) {
                $titleEnDay = trim((string) $titleEnDay);
                $titleItDay = trim((string) ($_POST['day_title_it'][$i] ?? ''));
                if ($titleEnDay === '' && $titleItDay === '') {
                    continue;
                }
                $dayInsert->execute([
                    $safariId,
                    $i + 1,
                    $titleEnDay,
                    $titleItDay,
                    trim((string) ($_POST['day_description_en'][$i] ?? '')),
                    trim((string) ($_POST['day_description_it'][$i] ?? '')),
                    trim((string) ($_POST['day_activities_en'][$i] ?? '')),
                    trim((string) ($_POST['day_activities_it'][$i] ?? '')),
                    trim((string) ($_POST['day_meals'][$i] ?? '')),
                    trim((string) ($_POST['day_accommodation'][$i] ?? '')),
                ]);
            }

            // Replace pricing tiers
            db()->prepare('DELETE FROM pricing_tiers WHERE safari_id = ?')->execute([$safariId]);
            $tierUpTo = $_POST['tier_up_to'] ?? [];
            $tierInsert = db()->prepare('INSERT INTO pricing_tiers (safari_id, up_to_travelers, price_per_person, currency) VALUES (?, ?, ?, ?)');

            foreach ($tierUpTo as $i => $upTo) {
                $upTo = (int) $upTo;
                $price = (float) ($_POST['tier_price'][$i] ?? 0);
                if ($upTo <= 0 || $price <= 0) {
                    continue;
                }
                $tierInsert->execute([$safariId, $upTo, $price, trim((string) ($_POST['tier_currency'][$i] ?? 'USD')) ?: 'USD']);
            }

            // Upsert optional supplement pricing (child/single/private) — only
            // stored if at least one value was actually entered.
            $childPrice = trim((string) ($_POST['child_price_per_person'] ?? ''));
            $singleSupp = trim((string) ($_POST['single_supplement'] ?? ''));
            $privateSupp = trim((string) ($_POST['private_supplement'] ?? ''));

            if ($childPrice !== '' || $singleSupp !== '' || $privateSupp !== '') {
                db()->prepare(
                    'INSERT INTO safari_pricing_options (safari_id, child_price_per_person, single_supplement, private_supplement)
                     VALUES (?, ?, ?, ?)
                     ON DUPLICATE KEY UPDATE
                        child_price_per_person = VALUES(child_price_per_person),
                        single_supplement = VALUES(single_supplement),
                        private_supplement = VALUES(private_supplement)'
                )->execute([
                    $safariId,
                    $childPrice !== '' ? (float) $childPrice : null,
                    $singleSupp !== '' ? (float) $singleSupp : null,
                    $privateSupp !== '' ? (float) $privateSupp : null,
                ]);
            } else {
                db()->prepare('DELETE FROM safari_pricing_options WHERE safari_id = ?')->execute([$safariId]);
            }

            header('Location: ' . admin_base_url() . '/safaris/edit.php?id=' . $safariId . '&saved=1');
            exit;
        }
    }
}

// Ensure at least the safari's duration in day rows are available to edit
$dayRows = $days;
if ($id && count($dayRows) < ($safari['duration_days'] ?? 0)) {
    for ($n = count($dayRows) + 1; $n <= $safari['duration_days']; $n++) {
        $dayRows[] = ['day_number' => $n, 'title_en' => '', 'title_it' => '', 'description_en' => '', 'description_it' => '', 'activities_en' => '', 'activities_it' => '', 'meals' => '', 'accommodation' => ''];
    }
}
if (!$dayRows) {
    $dayRows[] = ['day_number' => 1, 'title_en' => '', 'title_it' => '', 'description_en' => '', 'description_it' => '', 'activities_en' => '', 'activities_it' => '', 'meals' => '', 'accommodation' => ''];
}
if (!$tiers) {
    $tiers = [['up_to_travelers' => '', 'price_per_person' => '', 'currency' => 'USD']];
}
if (!$pricingOptions) {
    $pricingOptions = ['child_price_per_person' => null, 'single_supplement' => null, 'private_supplement' => null];
}

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<?php if (!empty($_GET['saved'])): ?>
    <div class="admin-success-msg">Safari saved successfully.</div>
<?php endif; ?>
<?php foreach ($errors as $error): ?>
    <div class="admin-error"><?= e($error) ?></div>
<?php endforeach; ?>

<form method="post" action="">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />

    <div class="admin-card">
        <h2 style="margin-top:0;font-size:1.05rem;">Basic Details</h2>
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="title_en">Title (English)</label>
                <input type="text" id="title_en" name="title_en" required value="<?= e($safari['title_en'] ?? '') ?>" />
            </div>
            <div class="admin-form-group">
                <label for="title_it">Title (Italian)</label>
                <input type="text" id="title_it" name="title_it" required value="<?= e($safari['title_it'] ?? '') ?>" />
            </div>
        </div>
        <div class="admin-form-group">
            <label for="slug">Slug (leave blank to auto-generate from English title)</label>
            <input type="text" id="slug" name="slug" value="<?= e($safari['slug'] ?? '') ?>" placeholder="e.g. 5-day-serengeti-safari" />
        </div>
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="short_description_en">Short Description (English)</label>
                <textarea id="short_description_en" name="short_description_en" rows="2"><?= e($safari['short_description_en'] ?? '') ?></textarea>
            </div>
            <div class="admin-form-group">
                <label for="short_description_it">Short Description (Italian)</label>
                <textarea id="short_description_it" name="short_description_it" rows="2"><?= e($safari['short_description_it'] ?? '') ?></textarea>
            </div>
        </div>
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="description_en">Full Description (English)</label>
                <textarea id="description_en" name="description_en" rows="5"><?= e($safari['description_en'] ?? '') ?></textarea>
            </div>
            <div class="admin-form-group">
                <label for="description_it">Full Description (Italian)</label>
                <textarea id="description_it" name="description_it" rows="5"><?= e($safari['description_it'] ?? '') ?></textarea>
            </div>
        </div>
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="duration_days">Duration (days)</label>
                <input type="number" id="duration_days" name="duration_days" min="1" value="<?= e((string) ($safari['duration_days'] ?? 1)) ?>" />
            </div>
            <div class="admin-form-group">
                <label for="safari_type">Safari Type</label>
                <select id="safari_type" name="safari_type">
                    <option value="">—</option>
                    <?php foreach (admin_safari_types() as $type): ?>
                        <option value="<?= e($type) ?>" <?= ($safari['safari_type'] ?? '') === $type ? 'selected' : '' ?>><?= e(ucwords(str_replace('_', ' ', $type))) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="admin-form-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <?php foreach (admin_safari_statuses() as $s): ?>
                        <option value="<?= e($s) ?>" <?= ($safari['status'] ?? 'draft') === $s ? 'selected' : '' ?>><?= ucfirst($s) ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        </div>
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="destination">Destination</label>
                <input type="text" id="destination" name="destination" value="<?= e($safari['destination'] ?? '') ?>" />
            </div>
            <div class="admin-form-group">
                <label for="start_location">Start Location</label>
                <input type="text" id="start_location" name="start_location" value="<?= e($safari['start_location'] ?? '') ?>" />
            </div>
            <div class="admin-form-group">
                <label for="end_location">End Location</label>
                <input type="text" id="end_location" name="end_location" value="<?= e($safari['end_location'] ?? '') ?>" />
            </div>
        </div>
        <div class="admin-form-group">
            <label for="main_image">Main Image path (relative to /assets/images/)</label>
            <input type="text" id="main_image" name="main_image" value="<?= e($safari['main_image'] ?? '') ?>" placeholder="e.g. safaris/5-day-serengeti.jpg" />
        </div>
    </div>

    <div class="admin-card">
        <h2 style="margin-top:0;font-size:1.05rem;">Pricing Tiers (per-person price by group size)</h2>
        <div id="tierRows">
            <?php foreach ($tiers as $i => $tier): ?>
            <div class="admin-form-row tier-row" style="align-items:end;margin-bottom:0.75rem;">
                <div class="admin-form-group" style="margin-bottom:0;">
                    <label>Up to how many travelers</label>
                    <input type="number" name="tier_up_to[]" min="1" value="<?= e((string) $tier['up_to_travelers']) ?>" />
                </div>
                <div class="admin-form-group" style="margin-bottom:0;">
                    <label>Price per person</label>
                    <input type="number" step="0.01" name="tier_price[]" value="<?= e((string) $tier['price_per_person']) ?>" />
                </div>
                <div class="admin-form-group" style="margin-bottom:0;">
                    <label>Currency</label>
                    <input type="text" name="tier_currency[]" maxlength="3" value="<?= e($tier['currency'] ?? 'USD') ?>" />
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="admin-btn" id="addTierRow" style="margin-top:0.5rem;">+ Add price tier</button>

        <h2 style="font-size:1.05rem;margin-top:1.75rem;">Optional Supplements (leave blank if not applicable)</h2>
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="child_price_per_person">Child price per person</label>
                <input type="number" step="0.01" id="child_price_per_person" name="child_price_per_person" value="<?= e($pricingOptions['child_price_per_person'] !== null ? (string) $pricingOptions['child_price_per_person'] : '') ?>" />
            </div>
            <div class="admin-form-group">
                <label for="single_supplement">Single supplement</label>
                <input type="number" step="0.01" id="single_supplement" name="single_supplement" value="<?= e($pricingOptions['single_supplement'] !== null ? (string) $pricingOptions['single_supplement'] : '') ?>" />
            </div>
            <div class="admin-form-group">
                <label for="private_supplement">Private safari supplement</label>
                <input type="number" step="0.01" id="private_supplement" name="private_supplement" value="<?= e($pricingOptions['private_supplement'] !== null ? (string) $pricingOptions['private_supplement'] : '') ?>" />
            </div>
        </div>
    </div>

    <div class="admin-card">
        <h2 style="margin-top:0;font-size:1.05rem;">Day-by-Day Itinerary</h2>
        <div id="dayRows">
            <?php foreach ($dayRows as $i => $day): ?>
            <div class="admin-day-card day-row">
                <div class="admin-day-card-title">Day <?= $i + 1 ?></div>
                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label>Title (English)</label>
                        <input type="text" name="day_title_en[]" value="<?= e($day['title_en'] ?? '') ?>" />
                    </div>
                    <div class="admin-form-group">
                        <label>Title (Italian)</label>
                        <input type="text" name="day_title_it[]" value="<?= e($day['title_it'] ?? '') ?>" />
                    </div>
                </div>
                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label>Description (English)</label>
                        <textarea name="day_description_en[]" rows="2"><?= e($day['description_en'] ?? '') ?></textarea>
                    </div>
                    <div class="admin-form-group">
                        <label>Description (Italian)</label>
                        <textarea name="day_description_it[]" rows="2"><?= e($day['description_it'] ?? '') ?></textarea>
                    </div>
                </div>
                <div class="admin-form-row">
                    <div class="admin-form-group">
                        <label>Activities (English)</label>
                        <input type="text" name="day_activities_en[]" value="<?= e($day['activities_en'] ?? '') ?>" />
                    </div>
                    <div class="admin-form-group">
                        <label>Activities (Italian)</label>
                        <input type="text" name="day_activities_it[]" value="<?= e($day['activities_it'] ?? '') ?>" />
                    </div>
                    <div class="admin-form-group">
                        <label>Meals</label>
                        <input type="text" name="day_meals[]" value="<?= e($day['meals'] ?? '') ?>" placeholder="B, L, D" />
                    </div>
                    <div class="admin-form-group">
                        <label>Accommodation</label>
                        <input type="text" name="day_accommodation[]" value="<?= e($day['accommodation'] ?? '') ?>" />
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <button type="button" class="admin-btn" id="addDayRow" style="margin-top:0.5rem;">+ Add day</button>
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="admin-btn primary">Save Safari</button>
        <a href="<?= admin_base_url() ?>/safaris/index.php" class="admin-btn">Cancel</a>
    </div>
</form>

<script>
document.getElementById('addTierRow').addEventListener('click', function () {
    var container = document.getElementById('tierRows');
    var row = container.querySelector('.tier-row').cloneNode(true);
    row.querySelectorAll('input').forEach(function (el) { el.value = el.name === 'tier_currency[]' ? 'USD' : ''; });
    container.appendChild(row);
});

document.getElementById('addDayRow').addEventListener('click', function () {
    var container = document.getElementById('dayRows');
    var rows = container.querySelectorAll('.day-row');
    var row = rows[rows.length - 1].cloneNode(true);
    row.querySelectorAll('input, textarea').forEach(function (el) { el.value = ''; });
    row.querySelector('.admin-day-card-title').textContent = 'Day ' + (rows.length + 1);
    container.appendChild(row);
});
</script>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
