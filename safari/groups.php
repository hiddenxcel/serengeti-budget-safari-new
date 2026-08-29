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

$sampleDepartures = [
    ['date' => 'Jan 12, 2027', 'itinerary' => '4-Day Big Five Safari', 'price' => '€1,250', 'status' => 'open'],
    ['date' => 'Jan 26, 2027', 'itinerary' => '3-Day Serengeti Safari', 'price' => '€1,000', 'status' => 'open'],
    ['date' => 'Feb 09, 2027', 'itinerary' => '5-Day Migration Safari', 'price' => '€1,100', 'status' => 'filling'],
    ['date' => 'Feb 23, 2027', 'itinerary' => '4-Day Big Five Safari', 'price' => '€1,250', 'status' => 'open'],
    ['date' => 'Mar 09, 2027', 'itinerary' => '3-Day Serengeti Safari', 'price' => '€1,000', 'status' => 'full'],
    ['date' => 'Mar 23, 2027', 'itinerary' => '5-Day Migration Safari', 'price' => '€1,100', 'status' => 'open'],
];
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/team/ranger-clients-safari-vehicle-logo.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-badge"><i class="fas fa-users"></i> <?= e(t('groups_hero_badge')) ?></span>
                <h1><span><?= e(t('groups_hero_title_1')) ?></span> <?= e(t('groups_hero_title_2')) ?></h1>
                <p class="hero-sub"><?= e(t('groups_hero_sub')) ?></p>
                <div class="page-hero-actions">
                    <a href="https://wa.me/255697612865" class="btn btn-primary" target="_blank" rel="noopener"><?= e(t('groups_hero_cta_quote')) ?></a>
                    <a href="<?= url('contact.php') ?>" class="btn btn-success"><i class="fas fa-envelope"></i> <?= e(t('nav_contact')) ?></a>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-diagram-project"></i> <?= e(t('groups_how_badge')) ?></span>
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
                    <span class="section-badge"><i class="fas fa-heart"></i> <?= e(t('groups_why_badge')) ?></span>
                    <h2><?= e(t('groups_why_title')) ?></h2>
                </div>
                <div class="why-add-grid">
                    <div class="why-add-item">
                        <span class="why-add-icon"><i class="fas fa-coins"></i></span>
                        <h3><?= e(t('groups_why_1_title')) ?></h3>
                        <p><?= e(t('groups_why_1_desc')) ?></p>
                    </div>
                    <div class="why-add-item">
                        <span class="why-add-icon"><i class="fas fa-user-group"></i></span>
                        <h3><?= e(t('groups_why_2_title')) ?></h3>
                        <p><?= e(t('groups_why_2_desc')) ?></p>
                    </div>
                    <div class="why-add-item">
                        <span class="why-add-icon"><i class="fas fa-medal"></i></span>
                        <h3><?= e(t('groups_why_3_title')) ?></h3>
                        <p><?= e(t('groups_why_3_desc')) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-calendar-days"></i> <?= e(t('groups_departures_badge')) ?></span>
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
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($sampleDepartures as $dep): ?>
                            <tr>
                                <td><strong><?= e($dep['date']) ?></strong></td>
                                <td><?= e($dep['itinerary']) ?></td>
                                <td><?= e($dep['price']) ?></td>
                                <td>
                                    <span class="departure-seats <?= e($dep['status']) ?>">
                                        <i class="fas fa-circle"></i>
                                        <?= e(t('groups_seats_' . $dep['status'])) ?>
                                    </span>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <p class="departures-note"><i class="fas fa-circle-info"></i> <?= e(t('groups_departures_note')) ?></p>
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
                        <div class="faq-question-acc"><?= e(t('groups_faq_q1')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('groups_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('groups_faq_q2')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('groups_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('groups_faq_q3')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('groups_faq_a3')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('groups_faq_q4')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('groups_faq_a4')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
