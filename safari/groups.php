<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'safari';
$altPath = 'safari/groups.php';
$pageMetaTitle = 'groups_meta_title';
$pageMetaDescription = 'groups_meta_description';

require dirname(__DIR__) . '/includes/header.php';

$departureRows = db()->query(
    "SELECT d.*,
            (SELECT COALESCE(SUM(b.adults + b.children), 0) FROM bookings b
             WHERE b.departure_id = d.id AND b.status != 'cancelled') AS booked_seats
     FROM departures d
     WHERE d.status = 'open' AND d.departure_date >= CURDATE()
     ORDER BY d.departure_date ASC
     LIMIT 12"
)->fetchAll();

$isUsingRealDepartures = count($departureRows) > 0;

if ($isUsingRealDepartures) {
    $departures = array_map(static function (array $d): array {
        $available = (int) $d['capacity'] - (int) $d['booked_seats'];
        $status = $available <= 0 ? 'full' : ($available <= 2 ? 'filling' : 'open');
        return [
            'id' => (int) $d['id'],
            'date' => date('M d, Y', strtotime($d['departure_date'])),
            'itinerary' => $d['itinerary_label'],
            'price' => $d['currency'] . ' ' . number_format((float) $d['price_per_person'], 0),
            'status' => $status,
            'available' => max(0, $available),
        ];
    }, $departureRows);
} else {
    // No real departures entered yet — show clearly-labeled illustrative
    // examples so the page isn't empty, per the standing decision to
    // avoid a bare "coming soon" page (see project memory).
    $departures = [
        ['id' => null, 'date' => 'Jan 12, 2027', 'itinerary' => '4-Day Big Five Safari', 'price' => '€1,250', 'status' => 'open', 'available' => 4],
        ['id' => null, 'date' => 'Jan 26, 2027', 'itinerary' => '3-Day Serengeti Safari', 'price' => '€1,000', 'status' => 'open', 'available' => 5],
        ['id' => null, 'date' => 'Feb 09, 2027', 'itinerary' => '5-Day Migration Safari', 'price' => '€1,100', 'status' => 'filling', 'available' => 2],
        ['id' => null, 'date' => 'Feb 23, 2027', 'itinerary' => '4-Day Big Five Safari', 'price' => '€1,250', 'status' => 'open', 'available' => 3],
        ['id' => null, 'date' => 'Mar 09, 2027', 'itinerary' => '3-Day Serengeti Safari', 'price' => '€1,000', 'status' => 'full', 'available' => 0],
        ['id' => null, 'date' => 'Mar 23, 2027', 'itinerary' => '5-Day Migration Safari', 'price' => '€1,100', 'status' => 'open', 'available' => 4],
    ];
}
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/team/ranger-clients-safari-vehicle-logo.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-badge"><?= icon('users') ?> <?= e(t('groups_hero_badge')) ?></span>
                <h1><span><?= e(t('groups_hero_title_1')) ?></span> <?= e(t('groups_hero_title_2')) ?></h1>
                <p class="hero-sub"><?= e(t('groups_hero_sub')) ?></p>
                <div class="page-hero-actions">
                    <a href="https://wa.me/255697612865" class="btn btn-primary" target="_blank" rel="noopener"><?= e(t('groups_hero_cta_quote')) ?></a>
                    <a href="<?= url('contact.php') ?>" class="btn btn-success"><?= icon('envelope') ?> <?= e(t('nav_contact')) ?></a>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('diagram-project') ?> <?= e(t('groups_how_badge')) ?></span>
                    <h2><?= e(t('groups_how_title')) ?></h2>
                </div>

                <div class="how-steps-grid">
                    <div class="how-step">
                        <span class="how-step-number">1</span>
                        <h3><?= e(t('groups_how_1_title')) ?></h3>
                        <p><?= e(t('groups_how_1_desc')) ?></p>
                    </div>
                    <div class="how-step">
                        <span class="how-step-number">2</span>
                        <h3><?= e(t('groups_how_2_title')) ?></h3>
                        <p><?= e(t('groups_how_2_desc')) ?></p>
                    </div>
                    <div class="how-step">
                        <span class="how-step-number">3</span>
                        <h3><?= e(t('groups_how_3_title')) ?></h3>
                        <p><?= e(t('groups_how_3_desc')) ?></p>
                    </div>
                    <div class="how-step">
                        <span class="how-step-number">4</span>
                        <h3><?= e(t('groups_how_4_title')) ?></h3>
                        <p><?= e(t('groups_how_4_desc')) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('heart') ?> <?= e(t('groups_why_badge')) ?></span>
                    <h2><?= e(t('groups_why_title')) ?></h2>
                </div>
                <div class="why-add-grid">
                    <div class="why-add-item">
                        <span class="why-add-icon"><?= icon('coins') ?></span>
                        <h3><?= e(t('groups_why_1_title')) ?></h3>
                        <p><?= e(t('groups_why_1_desc')) ?></p>
                    </div>
                    <div class="why-add-item">
                        <span class="why-add-icon"><?= icon('user-group') ?></span>
                        <h3><?= e(t('groups_why_2_title')) ?></h3>
                        <p><?= e(t('groups_why_2_desc')) ?></p>
                    </div>
                    <div class="why-add-item">
                        <span class="why-add-icon"><?= icon('medal') ?></span>
                        <h3><?= e(t('groups_why_3_title')) ?></h3>
                        <p><?= e(t('groups_why_3_desc')) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('calendar-days') ?> <?= e(t('groups_departures_badge')) ?></span>
                    <h2><?= e(t('groups_departures_title')) ?></h2>
                    <p><?= e(t('groups_departures_intro')) ?></p>
                </div>

                <div class="departures-table-wrap">
                    <table class="departures-table">
                        <thead>
                            <tr>
                                <th><?= e(t('groups_departures_col_departure')) ?></th>
                                <th><?= e(t('groups_departures_col_itinerary')) ?></th>
                                <th><?= e(t('groups_departures_col_price')) ?></th>
                                <th><?= e(t('groups_departures_col_seats')) ?></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($departures as $dep): ?>
                            <tr>
                                <td><strong><?= e($dep['date']) ?></strong></td>
                                <td><?= e($dep['itinerary']) ?></td>
                                <td><?= e($dep['price']) ?></td>
                                <td>
                                    <span class="departure-seats <?= e($dep['status']) ?>">
                                        <?= icon('circle') ?>
                                        <?= e(t('groups_seats_' . $dep['status'])) ?>
                                    </span>
                                </td>
                                <td>
                                    <?php if ($dep['status'] !== 'full' && $isUsingRealDepartures): ?>
                                        <a class="btn btn-primary btn-sm" href="<?= url('booking/?departure=' . $dep['id'] . '&adults=1') ?>"><?= e(t('groups_join_cta')) ?></a>
                                    <?php elseif ($dep['status'] === 'full'): ?>
                                        <span style="color:#999;font-size:0.85rem;"><?= e(t('groups_seats_full')) ?></span>
                                    <?php else: ?>
                                        <a class="btn btn-light btn-sm" href="https://wa.me/255697612865" target="_blank" rel="noopener"><?= e(t('groups_join_cta')) ?></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <p class="departures-note"><?= icon('circle-info') ?> <?= e($isUsingRealDepartures ? t('groups_departures_note_real') : t('groups_departures_note')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="availability-card">
                    <h2><?= e(t('groups_availability_title')) ?></h2>
                    <p><?= e(t('groups_availability_intro')) ?></p>
                    <div class="availability-stats">
                        <div class="availability-stat">
                            <strong><?= e(t('groups_availability_stat1')) ?></strong>
                            <span><?= e(t('groups_availability_stat1_label')) ?></span>
                        </div>
                        <div class="availability-stat">
                            <strong><?= e(t('groups_availability_stat2')) ?></strong>
                            <span><?= e(t('groups_availability_stat2_label')) ?></span>
                        </div>
                        <div class="availability-stat">
                            <strong><?= e(t('groups_availability_stat3')) ?></strong>
                            <span><?= e(t('groups_availability_stat3_label')) ?></span>
                        </div>
                    </div>
                    <div class="btn-group" style="justify-content:center;">
                        <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('groups_availability_whatsapp')) ?></a>
                    </div>
                    <p style="margin-top:1rem;margin-bottom:0;"><a href="<?= url('contact.php') ?>" style="color:var(--gold);"><?= e(t('groups_availability_contact')) ?></a></p>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <h2 class="section-title"><?= e(t('groups_faq_title')) ?></h2>
                <div class="faq-column">
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('groups_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('groups_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('groups_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('groups_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('groups_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('groups_faq_a3')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('groups_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('groups_faq_a4')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
