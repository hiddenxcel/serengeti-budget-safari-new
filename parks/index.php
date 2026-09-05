<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'parks';
$altPath = 'parks/';
$pageMetaTitle = 'parks_meta_title';
$pageMetaDescription = 'parks_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-tagline"><?= e(badge_tagline('parks_hero_badge')) ?></span>
                <h1><?= e(t('parks_hero_title')) ?></h1>
                <p class="hero-sub"><?= e(t('parks_hero_sub')) ?></p>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('parks_northern_badge')) ?></span>
                    <h2><?= e(t('parks_northern_title')) ?></h2>
                    <p><?= e(t('parks_northern_intro')) ?></p>
                </div>

                <div class="park-preview-grid">
                    <a href="<?= url('parks/serengeti-national-park.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>" alt="Serengeti National Park" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('parks_days_3plus')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3><?= e(t('parks_serengeti_name')) ?></h3>
                            <p><?= e(t('parks_serengeti_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                    <a href="<?= url('parks/ngorongoro-conservation-area.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="Ngorongoro Conservation Area" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('parks_days_1')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3><?= e(t('parks_ngorongoro_name')) ?></h3>
                            <p><?= e(t('parks_ngorongoro_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                    <a href="<?= url('parks/tarangire-national-park.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" alt="Tarangire National Park" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('parks_days_1to2')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3><?= e(t('parks_tarangire_name')) ?></h3>
                            <p><?= e(t('parks_tarangire_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                    <a href="<?= url('parks/lake-manyara-national-park.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/wildlife/spotted-hyena-savanna.jpg') ?>" alt="Lake Manyara National Park" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('parks_days_half')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3><?= e(t('parks_manyara_name')) ?></h3>
                            <p><?= e(t('parks_manyara_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                    <a href="<?= url('parks/arusha-national-park.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/wildlife/cheetahs-resting-shade.jpg') ?>" alt="Arusha National Park" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('parks_days_half')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3><?= e(t('parks_arusha_name')) ?></h3>
                            <p><?= e(t('parks_arusha_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                    <a href="<?= url('parks/kilimanjaro-national-park.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/hero/male-lion-portrait-mane.jpg') ?>" alt="Kilimanjaro National Park" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('parks_days_5to9')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3><?= e(t('parks_kilimanjaro_name')) ?></h3>
                            <p><?= e(t('parks_kilimanjaro_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('parks_southern_badge')) ?></span>
                    <h2><?= e(t('parks_southern_title')) ?></h2>
                    <p><?= e(t('parks_southern_intro')) ?></p>
                </div>

                <div class="park-preview-grid cols-3">
                    <a href="<?= url('parks/nyerere-national-park.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/wildlife/white-rhino-grazing.jpg') ?>" alt="Nyerere National Park (Selous)" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('parks_days_3to4')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3><?= e(t('parks_nyerere_name')) ?></h3>
                            <p><?= e(t('parks_nyerere_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                    <a href="<?= url('parks/ruaha-national-park.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>" alt="Ruaha National Park" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('parks_days_3to4')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3><?= e(t('parks_ruaha_name')) ?></h3>
                            <p><?= e(t('parks_ruaha_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                    <a href="<?= url('parks/mikumi-national-park.php') ?>" class="park-preview-card">
                        <div class="park-preview-img">
                            <img src="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>" alt="Mikumi National Park" loading="lazy" />
                            <span class="park-preview-days"><?= e(t('parks_days_1to2')) ?></span>
                        </div>
                        <div class="park-preview-body">
                            <h3><?= e(t('parks_mikumi_name')) ?></h3>
                            <p><?= e(t('parks_mikumi_desc')) ?></p>
                            <span class="park-preview-link"><?= e(t('parks_full_guide')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('parks_compare_badge')) ?></span>
                    <h2><?= e(t('parks_compare_title')) ?></h2>
                    <p><?= e(t('parks_compare_intro')) ?></p>
                </div>

                <div class="table-wrap">
                    <table class="safari-table">
                        <thead>
                            <tr>
                                <th><?= e(t('parks_table_park')) ?></th>
                                <th><?= e(t('parks_table_circuit')) ?></th>
                                <th><?= e(t('parks_table_size')) ?></th>
                                <th><?= e(t('parks_table_entry')) ?></th>
                                <th><?= e(t('parks_table_days')) ?></th>
                                <th><?= e(t('parks_table_known_for')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><strong><?= e(t('parks_serengeti_name')) ?></strong></td><td><?= e(t('parks_circuit_north')) ?></td><td>14,763 km&sup2;</td><td>$82.60</td><td>3+</td><td><?= e(t('parks_known_serengeti')) ?></td></tr>
                            <tr><td><strong><?= e(t('parks_ngorongoro_name')) ?></strong></td><td><?= e(t('parks_circuit_north')) ?></td><td>260 km&sup2;</td><td>$82.60 + $295</td><td>1</td><td><?= e(t('parks_known_ngorongoro')) ?></td></tr>
                            <tr><td><strong><?= e(t('parks_tarangire_name')) ?></strong></td><td><?= e(t('parks_circuit_north')) ?></td><td>2,850 km&sup2;</td><td>$59.00</td><td>1&ndash;2</td><td><?= e(t('parks_known_tarangire')) ?></td></tr>
                            <tr><td><strong><?= e(t('parks_manyara_name')) ?></strong></td><td><?= e(t('parks_circuit_north')) ?></td><td>325 km&sup2;</td><td>$59.00</td><td>&frac12;&ndash;1</td><td><?= e(t('parks_known_manyara')) ?></td></tr>
                            <tr><td><strong><?= e(t('parks_arusha_name')) ?></strong></td><td><?= e(t('parks_circuit_north')) ?></td><td>552 km&sup2;</td><td>$59.00</td><td>&frac12;</td><td><?= e(t('parks_known_arusha')) ?></td></tr>
                            <tr><td><strong><?= e(t('parks_kilimanjaro_name')) ?></strong></td><td><?= e(t('parks_circuit_north')) ?></td><td>1,688 km&sup2;</td><td>$82.60/<?= e(t('parks_day')) ?></td><td>5&ndash;9</td><td><?= e(t('parks_known_kilimanjaro')) ?></td></tr>
                            <tr><td><strong><?= e(t('parks_nyerere_name')) ?></strong></td><td><?= e(t('parks_circuit_south')) ?></td><td>30,893 km&sup2;</td><td>$59.00</td><td>3&ndash;4</td><td><?= e(t('parks_known_nyerere')) ?></td></tr>
                            <tr><td><strong><?= e(t('parks_ruaha_name')) ?></strong></td><td><?= e(t('parks_circuit_south')) ?></td><td>20,226 km&sup2;</td><td>$35.40</td><td>3&ndash;4</td><td><?= e(t('parks_known_ruaha')) ?></td></tr>
                            <tr><td><strong><?= e(t('parks_mikumi_name')) ?></strong></td><td><?= e(t('parks_circuit_south')) ?></td><td>3,230 km&sup2;</td><td>$35.40</td><td>1&ndash;2</td><td><?= e(t('parks_known_mikumi')) ?></td></tr>
                        </tbody>
                    </table>
                </div>
                <p class="subtitle" style="margin-top:1.2rem;"><?= e(t('parks_table_note')) ?></p>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('parks_which_badge')) ?></span>
                    <h2><?= e(t('parks_which_title')) ?></h2>
                    <p><?= e(t('parks_which_intro')) ?></p>
                </div>

                <div class="table-wrap">
                    <table class="safari-table">
                        <thead>
                            <tr>
                                <th><?= e(t('parks_table_if_you_want')) ?></th>
                                <th><?= e(t('parks_table_go_to')) ?></th>
                                <th><?= e(t('parks_table_why')) ?></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr><td><strong><?= e(t('parks_want_migration')) ?></strong></td><td><?= e(t('parks_serengeti_name')) ?></td><td><?= e(t('parks_why_migration')) ?></td></tr>
                            <tr><td><strong><?= e(t('parks_want_bigfive')) ?></strong></td><td><?= e(t('parks_ngorongoro_name')) ?></td><td><?= e(t('parks_why_bigfive')) ?></td></tr>
                            <tr><td><strong><?= e(t('parks_want_elephants')) ?></strong></td><td><?= e(t('parks_tarangire_name')) ?>, <?= e(t('parks_then')) ?> <?= e(t('parks_ruaha_name')) ?></td><td><?= e(t('parks_why_elephants')) ?></td></tr>
                            <tr><td><strong><?= e(t('parks_want_walking')) ?></strong></td><td><?= e(t('parks_arusha_name')) ?>, <?= e(t('parks_nyerere_name')) ?>, <?= e(t('parks_ruaha_name')) ?></td><td><?= e(t('parks_why_walking')) ?></td></tr>
                            <tr><td><strong><?= e(t('parks_want_oneday')) ?></strong></td><td><?= e(t('parks_ngorongoro_name')) ?> / <?= e(t('parks_tarangire_name')) ?></td><td><?= e(t('parks_why_oneday')) ?></td></tr>
                            <tr><td><strong><?= e(t('parks_want_budget')) ?></strong></td><td><?= e(t('parks_mikumi_name')) ?></td><td><?= e(t('parks_why_budget')) ?></td></tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <section class="detail-section">
            <div class="container text-center">
                <a href="<?= url('safari/') ?>" class="btn btn-outline"><?= e(t('parks_see_safaris')) ?> <?= icon('arrow-right') ?></a>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-tagline"><?= e(badge_tagline('parks_faq_badge')) ?></span>
                    <h2><?= e(t('parks_faq_title')) ?></h2>
                </div>
                <div class="faq-column">
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('parks_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('parks_faq_a1')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('parks_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('parks_faq_a2')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('parks_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('parks_faq_a3')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('parks_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('parks_faq_a4')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('parks_faq_q5')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('parks_faq_a5')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('parks_faq_q6')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('parks_faq_a6')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('parks_faq_q7')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('parks_faq_a7')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('parks_faq_q8')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('parks_faq_a8')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('parks_faq_q9')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('parks_faq_a9')) ?></p></div>
                    </div>
                    <div class="faq-item-acc">
                        <div class="faq-question-acc"><?= e(t('parks_faq_q10')) ?> <span><?= icon('chevron-down') ?></span></div>
                        <div class="faq-answer-acc"><p><?= e(t('parks_faq_a10')) ?></p></div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('parks_cta_title')) ?></h2>
            <p><?= e(t('parks_cta_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('parks_cta_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('parks_cta_contact_form')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
