<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'blog';
$altPath = 'blog/what-to-pack-for-safari.php';
$pageMetaTitle = 'blogpack_meta_title';
$pageMetaDescription = 'blogpack_meta_description';

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="detail-hero" style="padding-bottom:3rem;">
        <div class="detail-hero-bg" style="background-image:url('<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>');"></div>
        <div class="detail-hero-overlay"></div>
        <div class="container detail-hero-content">
            <div class="detail-hero-meta">
                <span><?= e(t('blog_cat_tips')) ?></span>
                <span class="dot">·</span>
                <span><?= e(t('blogpack_updated')) ?></span>
            </div>
            <h1><?= e(t('blogpack_h1')) ?></h1>
            <p class="detail-hero-route"><?= e(t('blogpack_hero_sub')) ?></p>
            <div class="article-meta-bar">
                <span><?= icon('user-pen') ?> <?= e(t('blogpack_author')) ?></span>
                <span><?= icon('clock') ?> 5 <?= e(t('blog_min_read')) ?></span>
                <span><?= icon('calendar') ?> <?= e(t('blogpack_date')) ?></span>
            </div>
        </div>
    </section>

    <main>
        <article>
            <div class="container" style="max-width:840px;padding-top:2.5rem;">

                <!-- Quick answers -->
                <div class="quick-questions-card" style="margin-bottom:2rem;">
                    <span class="section-badge"><?= icon('bolt') ?> <?= e(t('blogpack_quick_badge')) ?></span>
                    <h2><?= e(t('blogpack_quick_title')) ?></h2>
                    <p><?= e(t('blogpack_quick_intro')) ?></p>
                    <div class="quick-questions-grid">
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('layer-group') ?></span>
                            <div><h4><?= e(t('blogpack_qq1_q')) ?></h4><p><?= e(t('blogpack_qq1_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('suitcase') ?></span>
                            <div><h4><?= e(t('blogpack_qq2_q')) ?></h4><p><?= e(t('blogpack_qq2_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('palette') ?></span>
                            <div><h4><?= e(t('blogpack_qq3_q')) ?></h4><p><?= e(t('blogpack_qq3_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('binoculars') ?></span>
                            <div><h4><?= e(t('blogpack_qq4_q')) ?></h4><p><?= e(t('blogpack_qq4_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('ban') ?></span>
                            <div><h4><?= e(t('blogpack_qq5_q')) ?></h4><p><?= e(t('blogpack_qq5_a')) ?></p></div>
                        </div>
                        <div class="quick-question-item">
                            <span class="qq-icon"><?= icon('shirt') ?></span>
                            <div><h4><?= e(t('blogpack_qq6_q')) ?></h4><p><?= e(t('blogpack_qq6_a')) ?></p></div>
                        </div>
                    </div>
                    <a href="#faq" class="btn btn-outline btn-sm"><?= e(t('blogpack_see_faq')) ?> <?= icon('arrow-right') ?></a>
                </div>

                <!-- Table of contents -->
                <nav class="article-toc" aria-label="Table of contents">
                    <h3><?= icon('list-ul') ?> <?= e(t('blogpack_toc_title')) ?></h3>
                    <ul>
                        <li><a href="#principle">👕 <?= e(t('blogpack_toc_1')) ?></a></li>
                        <li><a href="#clothing">👔 <?= e(t('blogpack_toc_2')) ?></a></li>
                        <li><a href="#health-kit">💊 <?= e(t('blogpack_toc_3')) ?></a></li>
                        <li><a href="#photography">📸 <?= e(t('blogpack_toc_4')) ?></a></li>
                        <li><a href="#documents">🛂 <?= e(t('blogpack_toc_5')) ?></a></li>
                        <li><a href="#leave-behind">🚫 <?= e(t('blogpack_toc_6')) ?></a></li>
                        <li><a href="#faq">❓ <?= e(t('blogpack_toc_7')) ?></a></li>
                    </ul>
                </nav>

                <!-- The one rule -->
                <section id="principle" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('layer-group') ?> <?= e(t('blogpack_s1_badge')) ?></span>
                    <h2><?= e(t('blogpack_s1_title')) ?></h2>
                    <p><?= t('blogpack_s1_p1') ?></p>
                    <p><?= t('blogpack_s1_p2') ?></p>
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

                <!-- Clothing -->
                <section id="clothing" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('shirt') ?> <?= e(t('blogpack_s2_badge')) ?></span>
                    <h2><?= e(t('blogpack_s2_title')) ?></h2>
                    <ul class="included-icon-list yes">
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogpack_s2_i1_t')) ?></strong> — <?= e(t('blogpack_s2_i1_d')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogpack_s2_i2_t')) ?></strong> — <?= e(t('blogpack_s2_i2_d')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogpack_s2_i3_t')) ?></strong> — <?= e(t('blogpack_s2_i3_d')) ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogpack_s2_i4')) ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogpack_s2_i5')) ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogpack_s2_i6')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogpack_s2_i7_t')) ?></strong>; <?= e(t('blogpack_s2_i7_d')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogpack_s2_i8_t')) ?></strong> — <?= e(t('blogpack_s2_i8_d')) ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogpack_s2_i9')) ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogpack_s2_i10')) ?></li>
                    </ul>

                    <h3><?= e(t('blogpack_s2_sub1')) ?></h3>
                    <p><?= t('blogpack_s2_p1') ?></p>
                    <ul class="included-icon-list no">
                        <li><?= icon('times-circle') ?> <strong><?= e(t('blogpack_s2_n1_t')) ?></strong> <?= e(t('blogpack_s2_n1_d')) ?></li>
                        <li><?= icon('times-circle') ?> <strong><?= e(t('blogpack_s2_n2_t')) ?></strong> <?= e(t('blogpack_s2_n2_d')) ?></li>
                        <li><?= icon('times-circle') ?> <strong><?= e(t('blogpack_s2_n3_t')) ?></strong> <?= e(t('blogpack_s2_n3_d')) ?></li>
                    </ul>
                </section>

                <!-- Medical kit -->
                <section id="health-kit" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('kit-medical') ?> <?= e(t('blogpack_s3_badge')) ?></span>
                    <h2><?= e(t('blogpack_s3_title')) ?></h2>
                    <ul class="included-icon-list yes">
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogpack_s3_i1_t')) ?></strong>, <?= e(t('blogpack_s3_i1_d')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogpack_s3_i2_t')) ?></strong> — <?= e(t('blogpack_s3_i2_d')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogpack_s3_i3_t')) ?></strong> <?= e(t('blogpack_s3_i3_d')) ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogpack_s3_i4')) ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogpack_s3_i5')) ?></li>
                        <li><?= icon('check-circle') ?> <?= t('blogpack_s3_i6') ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogpack_s3_i7')) ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogpack_s3_i8')) ?></li>
                    </ul>
                    <p><a href="<?= url('contact.php') ?>"><?= e(t('blogpack_s3_link')) ?> →</a></p>
                </section>

                <!-- Photography -->
                <section id="photography" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('camera') ?> <?= e(t('blogpack_s4_badge')) ?></span>
                    <h2><?= e(t('blogpack_s4_title')) ?></h2>
                    <div class="tag-cloud">
                        <span><?= icon('binoculars') ?> <?= e(t('blogpack_tag_binoculars')) ?></span>
                        <span><?= icon('camera-retro') ?> <?= e(t('blogpack_tag_lens')) ?></span>
                        <span><?= icon('mountain-sun') ?> <?= e(t('blogpack_tag_wide')) ?></span>
                        <span><?= icon('battery-full') ?> <?= e(t('blogpack_tag_battery')) ?></span>
                        <span><?= icon('sd-card') ?> <?= e(t('blogpack_tag_memory')) ?></span>
                        <span><?= icon('shield-halved') ?> <?= e(t('blogpack_tag_dustbag')) ?></span>
                        <span><?= icon('cube') ?> <?= e(t('blogpack_tag_beanbag')) ?></span>
                    </div>
                    <p style="margin-top:1.2rem;"><?= t('blogpack_s4_p1') ?></p>
                </section>

                <!-- Documents & money -->
                <section id="documents" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('passport') ?> <?= e(t('blogpack_s5_badge')) ?></span>
                    <h2><?= e(t('blogpack_s5_title')) ?></h2>
                    <ul class="included-icon-list yes">
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogpack_s5_i1_t')) ?></strong>, <?= e(t('blogpack_s5_i1_d')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogpack_s5_i2_t')) ?></strong> <?= e(t('blogpack_s5_i2_d')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogpack_s5_i3_t')) ?></strong>, <?= e(t('blogpack_s5_i3_d')) ?></li>
                        <li><?= icon('check-circle') ?> <?= t('blogpack_s5_i4') ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogpack_s5_i5')) ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogpack_s5_i6')) ?></li>
                        <li><?= icon('check-circle') ?> <strong><?= e(t('blogpack_s5_i7_t')) ?></strong> — <?= e(t('blogpack_s5_i7_d')) ?></li>
                        <li><?= icon('check-circle') ?> <?= e(t('blogpack_s5_i8')) ?></li>
                    </ul>
                </section>

                <!-- What to leave at home -->
                <section id="leave-behind" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('ban') ?> <?= e(t('blogpack_s6_badge')) ?></span>
                    <h2><?= e(t('blogpack_s6_title')) ?></h2>
                    <ul class="included-icon-list no">
                        <li><?= icon('times-circle') ?> <strong><?= e(t('blogpack_s6_i1_t')) ?></strong>, <?= e(t('blogpack_s6_i1_d')) ?></li>
                        <li><?= icon('times-circle') ?> <strong><?= e(t('blogpack_s6_i2_t')) ?></strong> — <?= e(t('blogpack_s6_i2_d')) ?></li>
                        <li><?= icon('times-circle') ?> <strong><?= e(t('blogpack_s6_i3_t')) ?></strong> — <?= e(t('blogpack_s6_i3_d')) ?></li>
                        <li><?= icon('times-circle') ?> <strong><?= e(t('blogpack_s6_i4_t')) ?></strong> — <?= e(t('blogpack_s6_i4_d')) ?></li>
                        <li><?= icon('times-circle') ?> <strong><?= e(t('blogpack_s6_i5_t')) ?></strong> — <?= e(t('blogpack_s6_i5_d')) ?></li>
                        <li><?= icon('times-circle') ?> <strong><?= e(t('blogpack_s6_i6_t')) ?></strong> — <?= e(t('blogpack_s6_i6_d')) ?></li>
                        <li><?= icon('times-circle') ?> <strong><?= e(t('blogpack_s6_i7_t')) ?></strong> — <?= e(t('blogpack_s6_i7_d')) ?></li>
                    </ul>
                    <div class="migration-badge" style="margin-top:1.4rem;">
                        <?= icon('lightbulb') ?>
                        <span><strong><?= e(t('blogpack_tip_t')) ?></strong> <?= e(t('blogpack_tip_d')) ?></span>
                    </div>
                </section>

                <!-- FAQ -->
                <section id="faq" style="margin-bottom:2.2rem;">
                    <span class="section-badge"><?= icon('question-circle') ?> <?= e(t('blogpack_faq_badge')) ?></span>
                    <h2><?= e(t('blogpack_faq_title')) ?></h2>
                    <div class="faq-grid-2col">
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogpack_faq_q1')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogpack_faq_a1')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogpack_faq_q2')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogpack_faq_a2')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogpack_faq_q3')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogpack_faq_a3')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogpack_faq_q4')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogpack_faq_a4')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogpack_faq_q5')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogpack_faq_a5')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogpack_faq_q6')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogpack_faq_a6')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogpack_faq_q7')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogpack_faq_a7')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogpack_faq_q8')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogpack_faq_a8')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogpack_faq_q9')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogpack_faq_a9')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogpack_faq_q10')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogpack_faq_a10')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogpack_faq_q11')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogpack_faq_a11')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogpack_faq_q12')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogpack_faq_a12')) ?></p></div></div>
                        <div class="faq-item-acc"><div class="faq-question-acc"><?= e(t('blogpack_faq_q13')) ?> <span><?= icon('chevron-down') ?></span></div><div class="faq-answer-acc"><p><?= e(t('blogpack_faq_a13')) ?></p></div></div>
                    </div>
                </section>

                <!-- Related articles -->
                <section style="margin-bottom:1rem;">
                    <span class="section-badge"><?= icon('link') ?> <?= e(t('blogpack_related_badge')) ?></span>
                    <h2><?= e(t('blogpack_related_title')) ?></h2>
                    <div class="related-grid">
                        <a href="<?= url('blog/how-much-does-a-safari-cost.php') ?>" class="related-link"><?= icon('coins') ?> <?= e(t('blog_art_cost_title')) ?></a>
                        <a href="<?= url('blog/great-migration-month-by-month.php') ?>" class="related-link"><i class="fas fa-paw"></i> <?= e(t('blog_art_migration_title')) ?></a>
                        <a href="<?= url('blog/') ?>" class="related-link"><?= icon('book') ?> <?= e(t('blog_hero_title')) ?></a>
                        <a href="<?= url('safari/') ?>" class="related-link"><?= icon('binoculars') ?> <?= e(t('blogcost_related_itineraries')) ?></a>
                        <a href="<?= url('trekking/') ?>" class="related-link"><?= icon('mountain-sun') ?> <?= e(t('blogpack_related_trekking')) ?></a>
                    </div>
                </section>

            </div>
        </article>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('blogpack_final_title')) ?></h2>
            <p><?= e(t('blogpack_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('blogpack_final_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('blogpack_final_contact')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
