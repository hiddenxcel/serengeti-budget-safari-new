<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'blog';
$altPath = 'blog/big-five-tanzania.php';
$pageMetaTitle = 'blogbig5_meta_title';
$pageMetaDescription = 'blogbig5_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="detail-hero" style="padding-bottom:3rem;">
        <div class="detail-hero-bg" style="background-image:url('<?= asset('images/wildlife/white-rhino-grazing.jpg') ?>');"></div>
        <div class="detail-hero-overlay"></div>
        <div class="container detail-hero-content">
            <div class="detail-hero-meta">
                <span><?= e(t('blog_cat_wildlife')) ?></span>
                <span class="dot">·</span>
                <span><?= e(t('blogbig5_updated')) ?></span>
            </div>
            <h1><?= e(t('blogbig5_h1')) ?></h1>
            <p class="detail-hero-route"><?= e(t('blogbig5_hero_sub')) ?></p>
            <div class="article-meta-bar">
                <span><?= icon('user-pen') ?> <?= e(t('blogcost_author')) ?></span>
                <span><?= icon('clock') ?> 6 <?= e(t('blog_min_read')) ?></span>
                <span><?= icon('calendar') ?> <?= e(t('blogcost_date')) ?></span>
            </div>
        </div>
    </section>

    <main>
        <article>
            <div class="container" style="max-width:840px;padding-top:2.5rem;">

                <!-- Quick answers -->
                <div class="quick-questions-card" style="margin-bottom:2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogbig5_quick_badge')) ?></span>
                    <h2><?= e(t('blogbig5_quick_title')) ?></h2>
                    <p><?= e(t('blogbig5_quick_intro')) ?></p>
                    <div class="quick-questions-grid">
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-paw"></i></span>
                            <div><h4><?= e(t('blogbig5_qq1_q')) ?></h4><p><?= e(t('blogbig5_qq1_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-cat"></i></span>
                            <div><h4><?= e(t('blogbig5_qq2_q')) ?></h4><p><?= e(t('blogbig5_qq2_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><i class="fas fa-hippo"></i></span>
                            <div><h4><?= e(t('blogbig5_qq3_q')) ?></h4><p><?= e(t('blogbig5_qq3_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('clock') ?></span>
                            <div><h4><?= e(t('blogbig5_qq4_q')) ?></h4><p><?= e(t('blogbig5_qq4_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('binoculars') ?></span>
                            <div><h4><?= e(t('blogbig5_qq5_q')) ?></h4><p><?= e(t('blogbig5_qq5_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('circle-exclamation') ?></span>
                            <div><h4><?= e(t('blogbig5_qq6_q')) ?></h4><p><?= e(t('blogbig5_qq6_a')) ?></p></div>
                        </div>
                    </div>
                    <a href="#faq" class="btn btn-outline btn-sm"><?= e(t('blogcost_see_faq')) ?> <?= icon('arrow-right') ?></a>
                </div>

                <!-- Table of contents -->
                <nav class="article-toc" aria-label="Table of contents">
                    <h3><?= icon('list-ul') ?> <?= e(t('blogbig5_toc_title')) ?></h3>
                    <ul>
                        <li><a href="#what-they-are">📖 <?= e(t('blogbig5_toc_1')) ?></a></li>
                        <li><a href="#each-animal">🦁 <?= e(t('blogbig5_toc_2')) ?></a></li>
                        <li><a href="#itineraries">🗺️ <?= e(t('blogbig5_toc_3')) ?></a></li>
                        <li><a href="#beyond">⭐ <?= e(t('blogbig5_toc_4')) ?></a></li>
                        <li><a href="#faq">❓ <?= e(t('blogbig5_toc_5')) ?></a></li>
                    </ul>
                </nav>

                <!-- What they are -->
                <section id="what-they-are" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogbig5_s1_badge')) ?></span>
                    <h2><?= e(t('blogbig5_s1_title')) ?></h2>
                    <p><?= t('blogbig5_s1_p1') ?></p>
                    <p><?= e(t('blogbig5_s1_p2')) ?></p>
                    <p><?= t('blogbig5_s1_p3') ?></p>
                    <div class="quick-facts">
                        <div class="fact"><span>🦁 <?= e(t('blogbig5_fact_lion_label')) ?></span> <strong><?= e(t('blogbig5_fact_lion_value')) ?></strong></div>
                        <div class="fact"><span>🐘 <?= e(t('blogbig5_fact_elephant_label')) ?></span> <strong><?= e(t('blogbig5_fact_elephant_value')) ?></strong></div>
                        <div class="fact"><span>🐃 <?= e(t('blogbig5_fact_buffalo_label')) ?></span> <strong><?= e(t('blogbig5_fact_buffalo_value')) ?></strong></div>
                        <div class="fact"><span>🐆 <?= e(t('blogbig5_fact_leopard_label')) ?></span> <strong><?= e(t('blogbig5_fact_leopard_value')) ?></strong></div>
                        <div class="fact"><span>🦏 <?= e(t('blogbig5_fact_rhino_label')) ?></span> <strong><?= e(t('blogbig5_fact_rhino_value')) ?></strong></div>
                        <div class="fact"><span>⏱️ <?= e(t('blogbig5_fact_days_label')) ?></span> <strong><?= e(t('blogbig5_fact_days_value')) ?></strong></div>
                    </div>
                </section>

                <!-- Related safari CTA (embedded mid-article) -->
                <a href="<?= url('safari/5-day-serengeti-ngorongoro-safari.php') ?>" class="article-safari-cta">
                    <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="5-Day Serengeti & Ngorongoro Safari" loading="lazy" />
                    <div class="article-safari-cta-body">
                        <span><?= e(t('blogcost_cta_label')) ?></span>
                        <strong><?= e(t('blogcost_cta_title')) ?></strong>
                        <em><?= e(t('blogcost_cta_price')) ?></em>
                    </div>
                    <?= icon('arrow-right', '', 'font-size:1.3rem;') ?>
                </a>

                <!-- Where to see each -->
                <section id="each-animal" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogbig5_s2_badge')) ?></span>
                    <h2><?= e(t('blogbig5_s2_title')) ?></h2>

                    <h3><?= e(t('blogbig5_s2_lion_h')) ?></h3>
                    <p><?= t('blogbig5_s2_lion_p') ?></p>
                    <p><em><?= e(t('blogbig5_s2_lion_odds')) ?></em></p>

                    <h3><?= e(t('blogbig5_s2_elephant_h')) ?></h3>
                    <p><?= t('blogbig5_s2_elephant_p') ?></p>
                    <p><em><?= e(t('blogbig5_s2_elephant_odds')) ?></em></p>

                    <h3><?= e(t('blogbig5_s2_buffalo_h')) ?></h3>
                    <p><?= e(t('blogbig5_s2_buffalo_p')) ?></p>
                    <p><em><?= e(t('blogbig5_s2_buffalo_odds')) ?></em></p>

                    <h3><?= e(t('blogbig5_s2_leopard_h')) ?></h3>
                    <p><?= t('blogbig5_s2_leopard_p') ?></p>
                    <p><em><?= e(t('blogbig5_s2_leopard_odds')) ?></em></p>

                    <h3><?= e(t('blogbig5_s2_rhino_h')) ?></h3>
                    <p><?= t('blogbig5_s2_rhino_p1') ?></p>
                    <p><?= e(t('blogbig5_s2_rhino_p2')) ?></p>
                    <p><em><?= e(t('blogbig5_s2_rhino_odds')) ?></em></p>
                </section>

                <!-- Itineraries -->
                <section id="itineraries" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogbig5_s3_badge')) ?></span>
                    <h2><?= e(t('blogbig5_s3_title')) ?></h2>
                    <div class="article-table-wrap">
                        <table class="article-table">
                            <thead><tr><th><?= e(t('blogbig5_t1_h1')) ?></th><th><?= e(t('blogbig5_t1_h2')) ?></th><th><?= e(t('blogbig5_t1_h3')) ?></th></tr></thead>
                            <tbody>
                                <tr>
                                    <td><strong><?= e(t('blogbig5_t1_r1_a')) ?></strong></td>
                                    <td><?= e(t('blogbig5_t1_r1_b')) ?></td>
                                    <td><?= t('blogbig5_t1_r1_c') ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?= e(t('blogbig5_t1_r2_a')) ?></strong></td>
                                    <td><?= e(t('blogbig5_t1_r2_b')) ?></td>
                                    <td><?= t('blogbig5_t1_r2_c') ?></td>
                                </tr>
                                <tr>
                                    <td><strong><?= e(t('blogbig5_t1_r3_a')) ?></strong></td>
                                    <td><?= e(t('blogbig5_t1_r3_b')) ?></td>
                                    <td><?= t('blogbig5_t1_r3_c') ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="migration-badge">
                        <?= icon('triangle-exclamation') ?>
                        <span><strong><?= e(t('blogbig5_s3_warn_t')) ?></strong> <?= e(t('blogbig5_s3_warn_d')) ?></span>
                    </div>
                </section>

                <!-- Beyond the five -->
                <section id="beyond" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogbig5_s4_badge')) ?></span>
                    <h2><?= e(t('blogbig5_s4_title')) ?></h2>
                    <p><?= e(t('blogbig5_s4_intro')) ?></p>
                    <ul class="included-icon-list yes">
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogbig5_s4_i1_t')) ?></strong> — <?= e(t('blogbig5_s4_i1_d')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogbig5_s4_i2_t')) ?></strong> — <?= e(t('blogbig5_s4_i2_d')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogbig5_s4_i3_t')) ?></strong> — <?= e(t('blogbig5_s4_i3_d')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogbig5_s4_i4_t')) ?></strong> — <?= e(t('blogbig5_s4_i4_d')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogbig5_s4_i5_t')) ?></strong> — <?= e(t('blogbig5_s4_i5_d')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogbig5_s4_i6_t')) ?></strong></li>
                    </ul>
                    <p><?= e(t('blogbig5_s4_outro')) ?></p>
                    <div class="tag-cloud" style="margin-top:1.2rem;">
                        <span>🦁 <?= e(t('blogbig5_tag_lion')) ?></span>
                        <span>🐆 <?= e(t('blogbig5_tag_leopard')) ?></span>
                        <span>🐘 <?= e(t('blogbig5_tag_elephant')) ?></span>
                        <span>🐃 <?= e(t('blogbig5_tag_buffalo')) ?></span>
                        <span>🦏 <?= e(t('blogbig5_tag_rhino')) ?></span>
                        <span>🐆 <?= e(t('blogbig5_tag_cheetah')) ?></span>
                        <span>🐕 <?= e(t('blogbig5_tag_wilddog')) ?></span>
                        <span>🦒 <?= e(t('blogbig5_tag_giraffe')) ?></span>
                        <span>🦛 <?= e(t('blogbig5_tag_hippo')) ?></span>
                    </div>
                </section>

                <!-- FAQ -->
                <section id="faq" style="margin-bottom:2.2rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogcost_faq_badge')) ?></span>
                    <h2><?= e(t('blogbig5_faq_title')) ?></h2>
                    <div class="faq-grid-2col">
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbig5_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogbig5_faq_a1')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbig5_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogbig5_faq_a2')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbig5_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogbig5_faq_a3')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbig5_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogbig5_faq_a4')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbig5_faq_q5')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogbig5_faq_a5')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbig5_faq_q6')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogbig5_faq_a6')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbig5_faq_q7')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogbig5_faq_a7')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbig5_faq_q8')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogbig5_faq_a8')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbig5_faq_q9')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogbig5_faq_a9')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbig5_faq_q10')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogbig5_faq_a10')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbig5_faq_q11')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogbig5_faq_a11')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbig5_faq_q12')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogbig5_faq_a12')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbig5_faq_q13')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogbig5_faq_a13')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogbig5_faq_q14')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogbig5_faq_a14')) ?></p></div></div>
                    </div>
                </section>

                <!-- Related articles -->
                <section style="margin-bottom:1rem;">
                    <span class="section-tagline"><?= e(badge_tagline('blogcost_related_badge')) ?></span>
                    <h2><?= e(t('blogbig5_related_title')) ?></h2>
                    <div class="related-grid">
                        <a href="<?= url('parks/ngorongoro-conservation-area.php') ?>" class="related-link"><?= icon('mountain') ?> <?= e(t('blogbig5_related_ngorongoro')) ?></a>
                        <a href="<?= url('blog/how-much-does-a-safari-cost.php') ?>" class="related-link"><?= icon('money-bill-wave') ?> <?= e(t('blog_art_cost_title')) ?></a>
                        <a href="<?= url('blog/great-migration-month-by-month.php') ?>" class="related-link"><?= icon('calendar-days') ?> <?= e(t('blog_art_migration_title')) ?></a>
                        <a href="<?= url('blog/') ?>" class="related-link"><?= icon('book') ?> <?= e(t('blog_hero_title')) ?></a>
                        <a href="<?= url('safari/') ?>" class="related-link"><?= icon('binoculars') ?> <?= e(t('blogcost_related_itineraries')) ?></a>
                    </div>
                </section>

            </div>
        </article>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('blogbig5_final_title')) ?></h2>
            <p><?= e(t('blogbig5_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('blogcost_final_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('blogcost_final_contact')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
