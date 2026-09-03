<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'my-trip';
$altPath = 'my-trip/';
$pageMetaTitle = 'mytrip_meta_title';
$pageMetaDescription = 'mytrip_meta_description';

$booking = null;
$error = null;
$lookedUp = false;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $lookedUp = true;

    if (!csrf_verify($_POST['csrf_token'] ?? null)) {
        $error = t('mytrip_error_expired');
    } elseif (!rate_limit_check('mytrip_lookup', 10, 600)) {
        $error = t('mytrip_error_rate_limited');
    } else {
        $reference = strtoupper(trim((string) ($_POST['reference'] ?? '')));
        $email = trim((string) ($_POST['email'] ?? ''));

        if ($reference === '' || $email === '') {
            $error = t('mytrip_error_required');
        } else {
            $stmt = db()->prepare(
                "SELECT b.*, c.first_name, c.last_name, c.email,
                        COALESCE(s.title_en, b.special_requests, 'Custom request') AS safari_title_en,
                        COALESCE(s.title_it, b.special_requests, 'Custom request') AS safari_title_it,
                        s.id AS safari_id_found
                 FROM bookings b
                 INNER JOIN customers c ON c.id = b.customer_id
                 LEFT JOIN safaris s ON s.id = b.safari_id
                 WHERE b.reference = ? AND c.email = ?
                 LIMIT 1"
            );
            $stmt->execute([$reference, $email]);
            $booking = $stmt->fetch() ?: null;

            if (!$booking) {
                $error = t('mytrip_error_not_found');
            }
        }
    }
}

$itineraryDays = [];
$payments = [];
$totalPaid = 0.0;
$balance = 0.0;

if ($booking) {
    if (!empty($booking['safari_id_found'])) {
        $daysStmt = db()->prepare('SELECT * FROM safari_days WHERE safari_id = ? ORDER BY day_number');
        $daysStmt->execute([$booking['safari_id_found']]);
        $itineraryDays = $daysStmt->fetchAll();
    }

    $paymentsStmt = db()->prepare('SELECT * FROM payments WHERE booking_id = ? ORDER BY paid_at ASC');
    $paymentsStmt->execute([$booking['id']]);
    $payments = $paymentsStmt->fetchAll();

    $totalPaid = array_sum(array_column($payments, 'amount'));
    $balance = max(0, (float) ($booking['estimated_total'] ?? 0) - $totalPaid);
}

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-badge"><?= icon('suitcase-rolling') ?> <?= e(t('mytrip_hero_badge')) ?></span>
                <h1><?= e(t('mytrip_hero_title')) ?></h1>
                <p class="hero-sub"><?= e(t('mytrip_hero_sub')) ?></p>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <?php if (!$booking): ?>
                <div class="contact-form-card" style="max-width:520px;margin:0 auto;">
                    <h2><?= e(t('mytrip_form_title')) ?></h2>
                    <p class="hero-sub" style="margin-bottom:1.5rem;"><?= e(t('mytrip_form_intro')) ?></p>

                    <?php if ($error): ?>
                        <div class="contact-form-error visible"><?= e($error) ?></div>
                    <?php endif; ?>

                    <form method="post" action="">
                        <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                        <div class="contact-field">
                            <label for="mt-reference"><?= e(t('mytrip_form_reference')) ?> *</label>
                            <input type="text" id="mt-reference" name="reference" required placeholder="TZ1042" value="<?= e($_POST['reference'] ?? '') ?>" />
                        </div>
                        <div class="contact-field">
                            <label for="mt-email"><?= e(t('mytrip_form_email')) ?> *</label>
                            <input type="email" id="mt-email" name="email" required value="<?= e($_POST['email'] ?? '') ?>" />
                        </div>
                        <button type="submit" class="btn btn-primary btn-lg" style="width:100%;margin-top:1rem;"><?= e(t('mytrip_form_submit')) ?></button>
                    </form>
                    <p style="text-align:center;color:#777;font-size:0.85rem;margin-top:1rem;"><?= e(t('mytrip_form_help')) ?> <a href="https://wa.me/255697612865" target="_blank" rel="noopener">WhatsApp</a></p>
                </div>

                <?php else: ?>
                <div class="booking-review-card" style="max-width:720px;margin:0 auto 1.5rem;">
                    <div class="booking-review-row"><span><?= e(t('mytrip_label_reference')) ?></span><strong>#<?= e($booking['reference']) ?></strong></div>
                    <div class="booking-review-row"><span><?= e(t('mytrip_label_status')) ?></span><strong><span class="admin-badge <?= e($booking['status']) ?>" style="background:none;padding:0;"><?= ucwords(str_replace('_', ' ', $booking['status'])) ?></span></strong></div>
                    <div class="booking-review-row"><span><?= e(t('mytrip_label_safari')) ?></span><strong><?= e($lang === 'it' ? $booking['safari_title_it'] : $booking['safari_title_en']) ?></strong></div>
                    <div class="booking-review-row"><span><?= e(t('mytrip_label_date')) ?></span><strong><?= $booking['travel_date'] ? e(date('d M Y', strtotime($booking['travel_date']))) : e(t('mytrip_date_tbc')) ?></strong></div>
                    <div class="booking-review-row"><span><?= e(t('mytrip_label_travelers')) ?></span><strong><?= (int) $booking['adults'] ?> <?= e(t('mytrip_adults')) ?><?= $booking['children'] > 0 ? ', ' . (int) $booking['children'] . ' ' . e(t('mytrip_children')) : '' ?></strong></div>
                </div>

                <div class="booking-review-total" style="max-width:720px;margin:0 auto 2rem;">
                    <div class="booking-review-total-row"><span><?= e(t('mytrip_label_total')) ?></span><strong><?= e($booking['currency'] . ' ' . number_format((float) ($booking['estimated_total'] ?? 0), 2)) ?></strong></div>
                    <p class="booking-review-note"><?= e(t('mytrip_label_paid')) ?>: <?= e($booking['currency'] . ' ' . number_format($totalPaid, 2)) ?> &middot; <?= e(t('mytrip_label_balance')) ?>: <strong style="color:<?= $balance > 0 ? '#c0392b' : '#1e824c' ?>;"><?= e($booking['currency'] . ' ' . number_format($balance, 2)) ?></strong></p>
                </div>

                <?php if ($itineraryDays): ?>
                <div style="max-width:720px;margin:0 auto 2rem;">
                    <h2 class="section-title"><?= e(t('mytrip_itinerary_title')) ?></h2>
                    <?php foreach ($itineraryDays as $day): ?>
                    <div class="admin-card" style="margin-bottom:0.75rem;">
                        <strong>Day <?= (int) $day['day_number'] ?>: <?= e($lang === 'it' ? $day['title_it'] : $day['title_en']) ?></strong>
                        <p style="margin:0.5rem 0 0;color:#555;"><?= e($lang === 'it' ? $day['description_it'] : $day['description_en']) ?></p>
                        <?php if (!empty($day['accommodation'])): ?>
                        <p style="margin:0.5rem 0 0;color:#888;font-size:0.85rem;"><?= icon('bed') ?> <?= e($day['accommodation']) ?></p>
                        <?php endif; ?>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <div style="max-width:720px;margin:0 auto;text-align:center;">
                    <div class="btn-group" style="justify-content:center;">
                        <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('mytrip_cta_whatsapp')) ?></a>
                        <a href="<?= url('my-trip/') ?>" class="btn btn-light"><?= e(t('mytrip_cta_lookup_another')) ?></a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </section>
    </main>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
