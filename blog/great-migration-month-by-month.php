<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'blog';
$altPath = 'blog/great-migration-month-by-month.php';
$pageMetaTitle = 'blogmig_meta_title';
$pageMetaDescription = 'blogmig_meta_description';

$months = [1,2,3,4,5,6,7,8,9,10,11,12];

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="detail-hero" style="padding-bottom:3rem;">
        <div class="detail-hero-bg" style="background-image:url('<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>');"></div>
        <div class="detail-hero-overlay"></div>
        <div class="container detail-hero-content">
            <div class="detail-hero-meta">
                <span><?= e(t('blog_cat_wildlife')) ?></span>
                <span class="dot">·</span>
                <span><?= e(t('blogmig_updated')) ?></span>
            </div>
            <h1><?= e(t('blogmig_h1')) ?></h1>
            <p class="detail-hero-route"><?= e(t('blogmig_hero_sub')) ?></p>
            <div class="article-meta-bar">
                <span><?= icon('user-pen') ?> <?= e(t('blogcost_author')) ?></span>
                <span><?= icon('clock') ?> 9 <?= e(t('blog_min_read')) ?></span>
                <span><?= icon('calendar') ?> <?= e(t('blogcost_date')) ?></span>
            </div>
        </div>
    </section>

    <main>
        <article>
            <div class="container" style="max-width:840px;padding-top:2.5rem;">

                <!-- Quick answers -->
                <div class="quick-questions-card" style="margin-bottom:2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogmig_quick_badge')) ?></span>
                    <h2><?= e(t('blogmig_quick_title')) ?></h2>
                    <p><?= e(t('blogmig_quick_intro')) ?></p>
                    <div class="quick-questions-grid">
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('calendar-days') ?></span>
                            <div><h4><?= e(t('blogmig_qq1_q')) ?></h4><p><?= e(t('blogmig_qq1_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('baby') ?></span>
                            <div><h4><?= e(t('blogmig_qq2_q')) ?></h4><p><?= e(t('blogmig_qq2_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('water') ?></span>
                            <div><h4><?= e(t('blogmig_qq3_q')) ?></h4><p><?= e(t('blogmig_qq3_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('bed') ?></span>
                            <div><h4><?= e(t('blogmig_qq4_q')) ?></h4><p><?= e(t('blogmig_qq4_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('clock') ?></span>
                            <div><h4><?= e(t('blogmig_qq5_q')) ?></h4><p><?= e(t('blogmig_qq5_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('circle-exclamation') ?></span>
                            <div><h4><?= e(t('blogmig_qq6_q')) ?></h4><p><?= e(t('blogmig_qq6_a')) ?></p></div>
                        </div>
                    </div>
                    <a href="#faq" class="btn btn-outline btn-sm"><?= e(t('blogcost_see_faq')) ?> <?= icon('arrow-right') ?></a>
                </div>

                <!-- Table of contents -->
                <nav class="article-toc" aria-label="Table of contents">
                    <h3><?= icon('list-ul') ?> <?= e(t('blogmig_toc_title')) ?></h3>
                    <ul>
                        <li><a href="#what-it-is">📖 <?= e(t('blogmig_toc_1')) ?></a></li>
                        <li><a href="#month-by-month">📅 <?= e(t('blogmig_toc_2')) ?></a></li>
                        <li><a href="#calving">🍼 <?= e(t('blogmig_toc_3')) ?></a></li>
                        <li><a href="#river-crossings">🌊 <?= e(t('blogmig_toc_4')) ?></a></li>
                        <li><a href="#where-to-stay">🏕️ <?= e(t('blogmig_toc_5')) ?></a></li>
                        <li><a href="#planning">🗺️ <?= e(t('blogmig_toc_6')) ?></a></li>
                        <li><a href="#myths">❌ <?= e(t('blogmig_toc_7')) ?></a></li>
                        <li><a href="#faq">❓ <?= e(t('blogmig_toc_8')) ?></a></li>
                    </ul>
                </nav>

                <!-- What it is -->
                <section id="what-it-is" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogmig_s1_badge')) ?></span>
                    <h2><?= e(t('blogmig_s1_title')) ?></h2>
                    <p><?= t('blogmig_s1_p1') ?></p>
                    <p><?= t('blogmig_s1_p2') ?></p>
                    <p><?= e(t('blogmig_s1_p3')) ?></p>
                    <div class="tag-cloud" style="margin-top:1.2rem;">
                        <span>🐃 <?= e(t('blogmig_fact_wildebeest')) ?> ~1.3M</span>
                        <span>🦓 <?= e(t('blogmig_fact_zebra')) ?> ~250K</span>
                        <span>🦌 <?= e(t('blogmig_fact_gazelle')) ?> ~470K</span>
                        <span>📏 <?= e(t('blogmig_fact_distance')) ?> ~800km</span>
                        <span>🍼 <?= e(t('blogmig_fact_calves')) ?> ~400K/<?= e(t('blogmig_fact_year')) ?></span>
                        <span>🌍 <?= e(t('blogmig_fact_ecosystem')) ?> ~30,000km²</span>
                    </div>
                </section>

                <!-- Related safari CTA -->
                <a href="<?= url('safari/5-day-serengeti-ngorongoro-safari.php') ?>" class="article-safari-cta">
                    <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="5-Day Serengeti & Ngorongoro Safari" loading="lazy" />
                    <div class="article-safari-cta-body">
                        <span><?= e(t('blogcost_cta_label')) ?></span>
                        <strong><?= e(t('blogcost_cta_title')) ?></strong>
                        <em><?= e(t('blogcost_cta_price')) ?></em>
                    </div>
                    <?= icon('arrow-right', '', 'font-size:1.3rem;') ?>
                </a>

                <!-- Month by month -->
                <section id="month-by-month" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogmig_s2_badge')) ?></span>
                    <h2><?= e(t('blogmig_s2_title')) ?></h2>
                    <p><?= e(t('blogmig_s2_intro')) ?></p>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead>
                                <tr><th><?= e(t('blogmig_t1_h1')) ?></th><th><?= e(t('blogmig_t1_h2')) ?></th><th><?= e(t('blogmig_t1_h3')) ?></th><th><?= e(t('blogmig_t1_h4')) ?></th></tr>
                            </thead>
                            <tbody>
                                <?php foreach ($months as $m): ?>
                                <tr>
                                    <td><strong><?= e(t('blogmig_m' . $m . '_name')) ?></strong></td>
                                    <td><?= e(t('blogmig_m' . $m . '_where')) ?></td>
                                    <td><?= t('blogmig_m' . $m . '_what') ?></td>
                                    <td><?= e(t('blogmig_m' . $m . '_stay')) ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Calving -->
                <section id="calving" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogmig_s3_badge')) ?></span>
                    <h2><?= e(t('blogmig_s3_title')) ?></h2>
                    <p><?= t('blogmig_s3_p1') ?></p>
                    <h3><?= e(t('blogmig_s3_sub1')) ?></h3>
                    <p><?= e(t('blogmig_s3_p2')) ?></p>
                    <h3><?= e(t('blogmig_s3_sub2')) ?></h3>
                    <p><?= e(t('blogmig_s3_p3')) ?></p>
                    <h3><?= e(t('blogmig_s3_sub3')) ?></h3>
                    <p><?= e(t('blogmig_s3_p4')) ?></p>
                    <div class="migration-badge">
                        <?= icon('star') ?>
                        <span><strong><?= e(t('blogmig_s3_note_t')) ?></strong> <?= e(t('blogmig_s3_note_d')) ?></span>
                    </div>
                </section>

                <!-- River crossings -->
                <section id="river-crossings" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogmig_s4_badge')) ?></span>
                    <h2><?= e(t('blogmig_s4_title')) ?></h2>
                    <p><?= t('blogmig_s4_p1') ?></p>
                    <h3><?= e(t('blogmig_s4_sub1')) ?></h3>
                    <p><?= e(t('blogmig_s4_p2')) ?></p>
                    <p><?= e(t('blogmig_s4_p3')) ?></p>
                    <h3><?= e(t('blogmig_s4_sub2')) ?></h3>
                    <p><?= t('blogmig_s4_p4') ?></p>
                    <div class="migration-badge">
                        <?= icon('triangle-exclamation') ?>
                        <span><strong><?= e(t('blogmig_s4_note_t')) ?></strong> <?= e(t('blogmig_s4_note_d')) ?></span>
                    </div>
                    <h3 style="margin-top:1.4rem;"><?= e(t('blogmig_s4_sub3')) ?></h3>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th></th><th><?= e(t('blogmig_s4_mara')) ?></th><th><?= e(t('blogmig_s4_grumeti')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><?= e(t('blogmig_s4_row_months')) ?></td><td><?= e(t('blogmig_s4_mara_months')) ?></td><td><?= e(t('blogmig_s4_grumeti_months')) ?></td></tr>
                                <tr><td><?= e(t('blogmig_s4_row_scale')) ?></td><td><?= e(t('blogmig_s4_mara_scale')) ?></td><td><?= e(t('blogmig_s4_grumeti_scale')) ?></td></tr>
                                <tr><td><?= e(t('blogmig_s4_row_croc')) ?></td><td><?= e(t('blogmig_s4_mara_croc')) ?></td><td><?= e(t('blogmig_s4_grumeti_croc')) ?></td></tr>
                                <tr><td><?= e(t('blogmig_s4_row_vehicles')) ?></td><td><?= e(t('blogmig_s4_mara_vehicles')) ?></td><td><?= e(t('blogmig_s4_grumeti_vehicles')) ?></td></tr>
                                <tr><td><?= e(t('blogmig_s4_row_stay')) ?></td><td><?= e(t('blogmig_s4_mara_stay')) ?></td><td><?= e(t('blogmig_s4_grumeti_stay')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Where to stay -->
                <section id="where-to-stay" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogmig_s5_badge')) ?></span>
                    <h2><?= e(t('blogmig_s5_title')) ?></h2>
                    <p><?= e(t('blogmig_s5_p1')) ?></p>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogmig_t2_h1')) ?></th><th><?= e(t('blogmig_t2_h2')) ?></th><th><?= e(t('blogmig_t2_h3')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><?= e(t('blogmig_t2_r1_a')) ?></td><td><strong><?= e(t('blogmig_t2_r1_b')) ?></strong></td><td><?= e(t('blogmig_t2_r1_c')) ?></td></tr>
                                <tr><td><?= e(t('blogmig_t2_r2_a')) ?></td><td><strong><?= e(t('blogmig_t2_r2_b')) ?></strong></td><td><?= e(t('blogmig_t2_r2_c')) ?></td></tr>
                                <tr><td><?= e(t('blogmig_t2_r3_a')) ?></td><td><strong><?= e(t('blogmig_t2_r3_b')) ?></strong></td><td><?= e(t('blogmig_t2_r3_c')) ?></td></tr>
                                <tr><td><?= e(t('blogmig_t2_r4_a')) ?></td><td><strong><?= e(t('blogmig_t2_r4_b')) ?></strong></td><td><?= e(t('blogmig_t2_r4_c')) ?></td></tr>
                                <tr><td><?= e(t('blogmig_t2_r5_a')) ?></td><td><strong><?= e(t('blogmig_t2_r5_b')) ?></strong></td><td><?= e(t('blogmig_t2_r5_c')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                    <h3><?= e(t('blogmig_s5_sub1')) ?></h3>
                    <p><?= e(t('blogmig_s5_p2')) ?></p>
                    <p><a href="<?= url('contact.php') ?>" class="btn btn-primary btn-sm"><?= e(t('blogmig_s5_link')) ?> <?= icon('arrow-right') ?></a></p>
                </section>

                <!-- Planning -->
                <section id="planning" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogmig_s6_badge')) ?></span>
                    <h2><?= e(t('blogmig_s6_title')) ?></h2>
                    <h3><?= e(t('blogmig_s6_step1_t')) ?></h3>
                    <p><?= e(t('blogmig_s6_step1_d')) ?></p>
                    <h3><?= e(t('blogmig_s6_step2_t')) ?></h3>
                    <p><?= t('blogmig_s6_step2_d') ?></p>
                    <h3><?= e(t('blogmig_s6_step3_t')) ?></h3>
                    <p><?= e(t('blogmig_s6_step3_d')) ?></p>
                    <h3><?= e(t('blogmig_s6_step4_t')) ?></h3>
                    <p><?= e(t('blogmig_s6_step4_d')) ?></p>
                    <h3><?= e(t('blogmig_s6_step5_t')) ?></h3>
                    <p><?= e(t('blogmig_s6_step5_d')) ?></p>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogmig_t3_h1')) ?></th><th><?= e(t('blogmig_t3_h2')) ?></th></tr></thead>
                            <tbody>
                                <tr><td><strong>5 <?= e(t('blogmig_days')) ?></strong></td><td><?= e(t('blogmig_t3_r1_b')) ?></td></tr>
                                <tr><td><strong>7 <?= e(t('blogmig_days')) ?></strong></td><td><?= e(t('blogmig_t3_r2_b')) ?></td></tr>
                                <tr><td><strong>10 <?= e(t('blogmig_days')) ?></strong></td><td><?= e(t('blogmig_t3_r3_b')) ?></td></tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <!-- Myths -->
                <section id="myths" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogmig_s7_badge')) ?></span>
                    <h2><?= e(t('blogmig_s7_title')) ?></h2>
                    <h3>1. "<?= e(t('blogmig_s7_myth1_t')) ?>"</h3>
                    <p><?= t('blogmig_s7_myth1_d') ?></p>
                    <h3>2. "<?= e(t('blogmig_s7_myth2_t')) ?>"</h3>
                    <p><?= e(t('blogmig_s7_myth2_d')) ?></p>
                    <h3>3. "<?= e(t('blogmig_s7_myth3_t')) ?>"</h3>
                    <p><?= e(t('blogmig_s7_myth3_d')) ?></p>
                    <h3>4. "<?= e(t('blogmig_s7_myth4_t')) ?>"</h3>
                    <p><?= e(t('blogmig_s7_myth4_d')) ?></p>
                    <h3>5. "<?= e(t('blogmig_s7_myth5_t')) ?>"</h3>
                    <p><?= e(t('blogmig_s7_myth5_d')) ?></p>
                </section>

                <!-- FAQ -->
                <section id="faq" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogcost_faq_badge')) ?></span>
                    <h2><?= e(t('blogmig_faq_title')) ?></h2>
                    <div class="faq-grid-2col">
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogmig_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogmig_faq_a1')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogmig_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogmig_faq_a2')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogmig_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogmig_faq_a3')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogmig_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogmig_faq_a4')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogmig_faq_q5')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogmig_faq_a5')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogmig_faq_q6')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogmig_faq_a6')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogmig_faq_q7')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogmig_faq_a7')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogmig_faq_q8')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogmig_faq_a8')) ?></p></div></div>
                    </div>
                </section>

                <!-- Related articles -->
                <section style="margin-bottom:1rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogcost_related_badge')) ?></span>
                    <h2><?= e(t('blogcost_related_title')) ?></h2>
                    <div class="related-grid">
                        <a href="<?= url('blog/how-much-does-a-safari-cost.php') ?>" class="related-link"><?= icon('money-bill-wave') ?> <?= e(t('blog_art_cost_title')) ?></a>
                        <a href="<?= url('contact.php') ?>" class="related-link"><?= icon('calendar-days') ?> <?= e(t('blog_art_besttime_title')) ?></a>
                        <a href="<?= url('contact.php') ?>" class="related-link"><?= icon('bed') ?> <?= e(t('blog_art_stay_title')) ?></a>
                        <a href="<?= url('parks/serengeti-national-park.php') ?>" class="related-link"><i class="fas fa-paw"></i> <?= e(t('nav_safaris_featured_title')) ?></a>
                        <a href="<?= url('blog/') ?>" class="related-link"><?= icon('book') ?> <?= e(t('blog_hero_title')) ?></a>
                        <a href="<?= url('safari/') ?>" class="related-link"><?= icon('binoculars') ?> <?= e(t('blogcost_related_itineraries')) ?></a>
                    </div>
                </section>

            </div>
        </article>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('blogmig_final_title')) ?></h2>
            <p><?= e(t('blogmig_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('blogcost_final_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('blogcost_final_contact')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
