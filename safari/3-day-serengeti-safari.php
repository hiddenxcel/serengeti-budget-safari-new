<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'safari';
$altPath = 'safari/3-day-serengeti-safari.php';
$pageMetaTitle = 'pkg3d_meta_title';
$pageMetaDescription = 'pkg3d_meta_description';
$waMessage = t('pkg3d_calc_wa_template');
$waMessage = str_replace(['{people}', '{pp}', '{total}'], ['2', '€1,000', '€2,000'], $waMessage);

require dirname(__DIR__) . '/includes/header.php';

$priceTiers = pricing_tiers_for_slug('3-day-serengeti-safari', [
    ['upTo' => 1, 'pp' => 950],
    ['upTo' => 2, 'pp' => 650],
    ['upTo' => 3, 'pp' => 540],
    ['upTo' => 4, 'pp' => 490],
    ['upTo' => 5, 'pp' => 450],
    ['upTo' => 20, 'pp' => 420],
]);
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-badge"><i class="fas fa-star"></i> <?= e(t('pkg3d_hero_badge')) ?></span>
                <h1><?= e(t('pkg3d_hero_title')) ?></h1>
                <p class="hero-sub"><?= e(t('pkg3d_hero_sub')) ?></p>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="fact-box" style="margin-bottom:2.5rem;">
                    <div class="fact"><span class="fact-label"><?= e(t('pkg3d_fact_duration')) ?></span><span class="fact-value"><?= e(t('pkg3d_fact_duration_val')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('pkg3d_fact_difficulty')) ?></span><span class="fact-value"><?= e(t('pkg3d_fact_difficulty_val')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('pkg3d_fact_group')) ?></span><span class="fact-value"><?= e(t('pkg3d_fact_group_val')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('pkg3d_fact_best_time')) ?></span><span class="fact-value"><?= e(t('pkg3d_fact_best_time_val')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('pkg3d_fact_accommodation')) ?></span><span class="fact-value"><?= e(t('pkg3d_fact_accommodation_val')) ?></span></div>
                    <div class="fact"><span class="fact-label"><?= e(t('pkg3d_fact_start')) ?></span><span class="fact-value"><?= e(t('pkg3d_fact_start_val')) ?></span></div>
                </div>

                <div class="grid-2" style="grid-template-columns: 1.4fr 1fr; gap: 2.5rem; align-items: start;">
                    <div>
                        <div class="section-title-left centered">
                            <span class="section-badge"><i class="fas fa-route"></i> <?= e(t('pkg3d_itinerary_badge')) ?></span>
                            <h2><?= e(t('pkg3d_itinerary_title')) ?></h2>
                        </div>

                        <h3><?= e(t('pkg3d_day1_title')) ?></h3>
                        <p><?= e(t('pkg3d_day1_desc')) ?></p>
                        <h3><?= e(t('pkg3d_day2_title')) ?></h3>
                        <p><?= e(t('pkg3d_day2_desc')) ?></p>
                        <h3><?= e(t('pkg3d_day3_title')) ?></h3>
                        <p><?= e(t('pkg3d_day3_desc')) ?></p>
                    </div>

                    <div class="price-calc"
                         data-currency="€"
                         data-tiers='<?= e(json_encode($priceTiers)) ?>'
                         data-wa-template="<?= e(t('pkg3d_calc_wa_template')) ?>">
                        <div class="price-calc-heading"><?= e(t('pkg3d_calc_heading')) ?></div>
                        <div class="price-calc-subtext"><?= e(t('pkg3d_calc_subtext')) ?></div>

                        <div class="price-calc-row">
                            <span class="price-calc-label"><?= e(t('pkg3d_calc_people_label')) ?></span>
                            <div class="price-calc-stepper">
                                <button type="button" class="price-calc-minus" aria-label="Fewer travellers">−</button>
                                <input type="number" class="price-calc-people" value="2" min="1" max="20" inputmode="numeric" />
                                <button type="button" class="price-calc-plus" aria-label="More travellers">+</button>
                            </div>
                        </div>

                        <div class="price-calc-breakdown">
                            <div class="price-calc-line">
                                <span><?= e(t('pkg3d_calc_pp_label')) ?></span>
                                <span class="price-calc-per-person">€650</span>
                            </div>
                            <div class="price-calc-total-line">
                                <span><?= e(t('pkg3d_calc_total_label')) ?></span>
                                <span class="price-calc-total">€1,300</span>
                            </div>
                        </div>

                        <a href="https://wa.me/255697612865" target="_blank" rel="noopener" class="btn btn-success price-calc-whatsapp"><i class="fab fa-whatsapp"></i> <?= e(t('pkg3d_calc_cta')) ?></a>
                        <p class="price-calc-tiers-note"><?= e(t('pkg3d_calc_note')) ?></p>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="included-icon-grid">
                    <div>
                        <h3><?= e(t('pkg3d_included_heading')) ?></h3>
                        <ul class="included-icon-list yes">
                            <li><i class="fas fa-check-circle"></i> <?= e(t('pkg3d_included_1')) ?></li>
                            <li><i class="fas fa-check-circle"></i> <?= e(t('pkg3d_included_2')) ?></li>
                            <li><i class="fas fa-check-circle"></i> <?= e(t('pkg3d_included_3')) ?></li>
                            <li><i class="fas fa-check-circle"></i> <?= e(t('pkg3d_included_4')) ?></li>
                            <li><i class="fas fa-check-circle"></i> <?= e(t('pkg3d_included_5')) ?></li>
                            <li><i class="fas fa-check-circle"></i> <?= e(t('pkg3d_included_6')) ?></li>
                        </ul>
                    </div>
                    <div>
                        <h3><?= e(t('pkg3d_excluded_heading')) ?></h3>
                        <ul class="included-icon-list no">
                            <li><i class="fas fa-times-circle"></i> <?= e(t('pkg3d_excluded_1')) ?></li>
                            <li><i class="fas fa-times-circle"></i> <?= e(t('pkg3d_excluded_2')) ?></li>
                            <li><i class="fas fa-times-circle"></i> <?= e(t('pkg3d_excluded_3')) ?></li>
                            <li><i class="fas fa-times-circle"></i> <?= e(t('pkg3d_excluded_4')) ?></li>
                            <li><i class="fas fa-times-circle"></i> <?= e(t('pkg3d_excluded_5')) ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><i class="fas fa-camera-retro"></i> <?= e(t('pkg3d_gallery_badge')) ?></span>
                    <h2><?= e(t('pkg3d_gallery_title')) ?></h2>
                </div>
                <div class="gallery-grid">
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>" alt="Lion pride stalking zebra in the Serengeti" loading="lazy" />
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/leopard-resting-in-tree.jpg') ?>" alt="Leopard resting in a tree" loading="lazy" />
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="Ngorongoro Crater panorama" loading="lazy" />
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/white-rhino-grazing.jpg') ?>" alt="White rhino grazing" loading="lazy" />
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>" alt="Zebra herd grazing" loading="lazy" />
                    </div>
                    <div class="gallery-grid-item">
                        <img src="<?= asset('images/hero/male-lion-portrait-mane.jpg') ?>" alt="Male lion portrait" loading="lazy" />
                    </div>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <h2 class="section-title"><?= e(t('pkg3d_faq_title')) ?></h2>
                <div class="faq-column">
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('pkg3d_faq_q1')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('pkg3d_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('pkg3d_faq_q2')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('pkg3d_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('pkg3d_faq_q3')) ?> <span><i class="fas fa-chevron-down"></i></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('pkg3d_faq_a3')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('pkg3d_cta_title')) ?></h2>
            <p><?= e(t('pkg3d_cta_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('pkg3d_cta_whatsapp')) ?></a>
                <a href="<?= url('booking/?safari=3-day-serengeti-safari&title=' . rawurlencode(t('pkg3d_hero_title') ?: '3-Day Serengeti Safari') . '&pp=' . $priceTiers[0]['pp'] . '&adults=2') ?>" class="btn btn-light btn-lg"><?= e(t('pkg3d_cta_contact_form')) ?></a>
            </div>
        </div>
    </section>

<?php
$extraScripts = ['js/price-calculator.js'];
require dirname(__DIR__) . '/includes/footer.php';
?>
