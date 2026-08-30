<?php
declare(strict_types=1);

require_once dirname(__DIR__, 2) . '/config/config.php';
require_once dirname(__DIR__, 2) . '/includes/functions.php';
require_once dirname(__DIR__) . '/includes/auth.php';

require_admin();

$id = isset($_GET['id']) ? (int) $_GET['id'] : null;
$testimonial = null;
$errors = [];

if ($id) {
    $stmt = db()->prepare('SELECT * FROM testimonials WHERE id = ?');
    $stmt->execute([$id]);
    $testimonial = $stmt->fetch();

    if (!$testimonial) {
        http_response_code(404);
        exit('Testimonial not found.');
    }
}

$pageTitle = $id ? 'Edit Testimonial' : 'Add Testimonial';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $errors[] = 'Your session expired, please try again.';
    } else {
        $guestName = trim((string) ($_POST['guest_name'] ?? ''));
        $guestCountry = trim((string) ($_POST['guest_country'] ?? ''));
        $quoteEn = trim((string) ($_POST['quote_en'] ?? ''));
        $quoteIt = trim((string) ($_POST['quote_it'] ?? ''));
        $rating = max(1, min(5, (int) ($_POST['rating'] ?? 5)));
        $sortOrder = (int) ($_POST['sort_order'] ?? 0);
        $status = ($_POST['status'] ?? 'published') === 'hidden' ? 'hidden' : 'published';

        if ($guestName === '') {
            $errors[] = 'Guest name is required.';
        }
        if ($quoteEn === '') {
            $errors[] = 'The English quote is required.';
        }

        if (!$errors) {
            $fields = [
                'guest_name' => $guestName,
                'guest_country' => $guestCountry ?: null,
                'quote_en' => $quoteEn,
                'quote_it' => $quoteIt ?: null,
                'rating' => $rating,
                'sort_order' => $sortOrder,
                'status' => $status,
            ];

            if ($id) {
                $set = implode(', ', array_map(fn($k) => "$k = :$k", array_keys($fields)));
                db()->prepare("UPDATE testimonials SET $set WHERE id = :id")->execute($fields + ['id' => $id]);
                $testimonialId = $id;
            } else {
                $fields['created_by'] = current_admin()['id'];
                $cols = implode(', ', array_keys($fields));
                $placeholders = implode(', ', array_map(fn($k) => ":$k", array_keys($fields)));
                db()->prepare("INSERT INTO testimonials ($cols) VALUES ($placeholders)")->execute($fields);
                $testimonialId = (int) db()->lastInsertId();
            }

            header('Location: ' . admin_base_url() . '/testimonials/edit.php?id=' . $testimonialId . '&saved=1');
            exit;
        }
    }
}

require dirname(__DIR__) . '/includes/layout-head.php';
?>
<?php if (!empty($_GET['saved'])): ?>
    <div class="admin-success-msg">Testimonial saved successfully.</div>
<?php endif; ?>
<?php foreach ($errors as $error): ?>
    <div class="admin-error"><?= e($error) ?></div>
<?php endforeach; ?>

<form method="post" action="">
    <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />

    <div class="admin-card">
        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="guest_name">Guest Name</label>
                <input type="text" id="guest_name" name="guest_name" required value="<?= e($testimonial['guest_name'] ?? '') ?>" />
            </div>
            <div class="admin-form-group">
                <label for="guest_country">Country</label>
                <input type="text" id="guest_country" name="guest_country" value="<?= e($testimonial['guest_country'] ?? '') ?>" placeholder="e.g. United Kingdom" />
            </div>
        </div>

        <div class="admin-form-group">
            <label for="quote_en">Quote (English)</label>
            <textarea id="quote_en" name="quote_en" rows="4" required><?= e($testimonial['quote_en'] ?? '') ?></textarea>
        </div>
        <div class="admin-form-group">
            <label for="quote_it">Quote (Italian) — optional, falls back to English if left blank</label>
            <textarea id="quote_it" name="quote_it" rows="4"><?= e($testimonial['quote_it'] ?? '') ?></textarea>
        </div>

        <div class="admin-form-row">
            <div class="admin-form-group">
                <label for="rating">Rating (1-5 stars)</label>
                <select id="rating" name="rating">
                    <?php for ($r = 5; $r >= 1; $r--): ?>
                        <option value="<?= $r ?>" <?= (int) ($testimonial['rating'] ?? 5) === $r ? 'selected' : '' ?>><?= str_repeat('★', $r) ?> (<?= $r ?>)</option>
                    <?php endfor; ?>
                </select>
            </div>
            <div class="admin-form-group">
                <label for="sort_order">Sort Order (lower shows first)</label>
                <input type="number" id="sort_order" name="sort_order" value="<?= e((string) ($testimonial['sort_order'] ?? 0)) ?>" />
            </div>
            <div class="admin-form-group">
                <label for="status">Status</label>
                <select id="status" name="status">
                    <option value="published" <?= ($testimonial['status'] ?? 'published') === 'published' ? 'selected' : '' ?>>Published</option>
                    <option value="hidden" <?= ($testimonial['status'] ?? '') === 'hidden' ? 'selected' : '' ?>>Hidden</option>
                </select>
            </div>
        </div>
    </div>

    <div class="admin-form-actions">
        <button type="submit" class="admin-btn primary">Save Testimonial</button>
        <a href="<?= admin_base_url() ?>/testimonials/index.php" class="admin-btn">Cancel</a>
    </div>
</form>
<?php require dirname(__DIR__) . '/includes/layout-foot.php'; ?>
