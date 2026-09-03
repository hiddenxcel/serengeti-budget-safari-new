<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'blog';
$altPath = 'blog/';
$pageMetaTitle = 'blog_meta_title';
$pageMetaDescription = 'blog_meta_description';

$articles = [
    [
        'slug' => 'how-much-does-a-safari-cost.php',
        'img' => 'wildlife/lion-pride-zebra-kill.jpg',
        'category' => t('blog_cat_budget'),
        'title' => t('blog_art_cost_title'),
        'excerpt' => t('blog_art_cost_excerpt'),
        'time' => 8,
    ],
    [
        'slug' => 'best-time-to-visit-tanzania.php',
        'img' => 'hero/ngorongoro-crater-panorama.jpg',
        'category' => t('blog_cat_guides'),
        'title' => t('blog_art_besttime_title'),
        'excerpt' => t('blog_art_besttime_excerpt'),
        'time' => 7,
    ],
    [
        'slug' => 'great-migration-month-by-month.php',
        'img' => 'wildlife/zebra-herd-grazing-savanna.jpg',
        'category' => t('blog_cat_wildlife'),
        'title' => t('blog_art_migration_title'),
        'excerpt' => t('blog_art_migration_excerpt'),
        'time' => 9,
    ],
    [
        'slug' => 'serengeti-vs-ngorongoro.php',
        'img' => 'hero/elephant-under-acacia-tree.jpg',
        'category' => t('blog_cat_destinations'),
        'title' => t('blog_art_serengetivs_title'),
        'excerpt' => t('blog_art_serengetivs_excerpt'),
        'time' => 6,
    ],
    [
        'slug' => 'where-to-stay-on-safari.php',
        'img' => 'team/guide-client-ngorongoro-viewpoint.jpg',
        'category' => t('blog_cat_guides'),
        'title' => t('blog_art_stay_title'),
        'excerpt' => t('blog_art_stay_excerpt'),
        'time' => 7,
    ],
    [
        'slug' => 'big-five-tanzania.php',
        'img' => 'wildlife/white-rhino-grazing.jpg',
        'category' => t('blog_cat_wildlife'),
        'title' => t('blog_art_bigfive_title'),
        'excerpt' => t('blog_art_bigfive_excerpt'),
        'time' => 6,
    ],
    [
        'slug' => 'what-to-pack-for-safari.php',
        'img' => 'gallery/savanna-sunrise-acacia-trees.jpg',
        'category' => t('blog_cat_tips'),
        'title' => t('blog_art_pack_title'),
        'excerpt' => t('blog_art_pack_excerpt'),
        'time' => 5,
    ],
    [
        'slug' => 'tanzania-visa-and-entry.php',
        'img' => 'team/clients-serengeti-park-gate-1.jpg',
        'category' => t('blog_cat_tips'),
        'title' => t('blog_art_visa_title'),
        'excerpt' => t('blog_art_visa_excerpt'),
        'time' => 5,
    ],
    [
        'slug' => 'tipping-on-safari.php',
        'img' => 'team/ranger-clients-company-vehicle-1.jpg',
        'category' => t('blog_cat_tips'),
        'title' => t('blog_art_tipping_title'),
        'excerpt' => t('blog_art_tipping_excerpt'),
        'time' => 4,
    ],
    [
        'slug' => 'kenya-vs-tanzania-safari.php',
        'img' => 'wildlife/cheetah-alert-grassland.jpg',
        'category' => t('blog_cat_destinations'),
        'title' => t('blog_art_kenyavs_title'),
        'excerpt' => t('blog_art_kenyavs_excerpt'),
        'time' => 6,
    ],
    [
        'slug' => 'vaccinations-and-health.php',
        'img' => 'hero/elephant-under-acacia-tree.jpg',
        'category' => t('blog_cat_tips'),
        'title' => t('blog_art_vax_title'),
        'excerpt' => t('blog_art_vax_excerpt'),
        'time' => 7,
    ],
];

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-badge"><?= icon('book') ?> <?= e(t('blog_hero_badge')) ?></span>
                <h1><?= e(t('blog_hero_title')) ?></h1>
                <p class="hero-sub"><?= e(t('blog_hero_sub')) ?></p>
            </div>
        </div>
    </section>

    <main>
        <!-- Featured article -->
        <section class="detail-section">
            <div class="container">
                <a href="<?= url('blog/how-much-does-a-safari-cost.php') ?>" class="featured-article-card">
                    <div class="featured-article-img">
                        <span class="featured-article-tag"><?= e(t('blog_featured_tag')) ?></span>
                        <img src="<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>" alt="<?= e(t('blog_art_cost_title')) ?>" loading="lazy" />
                    </div>
                    <div class="featured-article-body">
                        <div class="blog-card-meta"><?= e(t('blog_cat_budget')) ?> <span class="dot">·</span> 8 <?= e(t('blog_min_read')) ?></div>
                        <h2><?= e(t('blog_art_cost_title')) ?></h2>
                        <p><?= e(t('blog_art_cost_excerpt')) ?></p>
                        <span class="blog-card-read"><?= e(t('blog_read_guide')) ?> <?= icon('arrow-right') ?></span>
                    </div>
                </a>
            </div>
        </section>

        <!-- Categories -->
        <section style="padding:0 0 1rem;">
            <div class="container">
                <div class="blog-categories">
                    <span class="blog-category-pill active"><?= e(t('blog_cat_all')) ?></span>
                    <span class="blog-category-pill"><?= e(t('blog_cat_guides')) ?></span>
                    <span class="blog-category-pill"><?= e(t('blog_cat_destinations')) ?></span>
                    <span class="blog-category-pill"><?= e(t('blog_cat_wildlife')) ?></span>
                    <span class="blog-category-pill"><?= e(t('blog_cat_tips')) ?></span>
                    <span class="blog-category-pill"><?= e(t('blog_cat_budget')) ?></span>
                </div>
            </div>
        </section>

        <!-- Latest articles -->
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('newspaper') ?> <?= e(t('blog_latest_badge')) ?></span>
                    <h2><?= e(t('blog_latest_title')) ?></h2>
                </div>
                <div class="grid-3">
                    <?php foreach ($articles as $article): ?>
                    <?php $articleUrl = $article['slug'] ? url('blog/' . $article['slug']) : url('contact.php'); ?>
                    <a href="<?= $articleUrl ?>" class="blog-card">
                        <div class="blog-card-img">
                            <img src="<?= asset('images/' . $article['img']) ?>" alt="<?= e($article['title']) ?>" loading="lazy" />
                        </div>
                        <div class="blog-card-body">
                            <div class="blog-card-meta"><?= e($article['category']) ?> <span class="dot">·</span> <?= $article['time'] ?> <?= e(t('blog_min_read')) ?></div>
                            <h3><?= e($article['title']) ?></h3>
                            <p><?= e($article['excerpt']) ?></p>
                            <span class="blog-card-read"><?= e(t('blog_read_article')) ?> <?= icon('arrow-right') ?></span>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <!-- Plan your safari CTA -->
        <section class="detail-section bg-light">
            <div class="container" style="text-align:center;max-width:640px;">
                <span class="section-badge"><?= icon('compass') ?> <?= e(t('blog_plan_badge')) ?></span>
                <h2><?= e(t('blog_plan_title')) ?></h2>
                <p><?= e(t('blog_plan_intro')) ?></p>
                <a href="<?= url('safari/') ?>" class="btn btn-primary btn-lg" style="margin-top:0.8rem;"><?= e(t('blog_plan_cta')) ?></a>
            </div>
        </section>

        <!-- Popular guides -->
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('fire') ?> <?= e(t('blog_popular_badge')) ?></span>
                    <h2><?= e(t('blog_popular_title')) ?></h2>
                </div>
                <div class="popular-guides-list">
                    <a href="<?= url('contact.php') ?>" class="popular-guide-link"><?= e(t('blog_art_besttime_title')) ?> <?= icon('arrow-right') ?></a>
                    <a href="<?= url('safari/') ?>" class="popular-guide-link"><?= e(t('blog_popular_days')) ?> <?= icon('arrow-right') ?></a>
                    <a href="<?= url('contact.php') ?>" class="popular-guide-link"><?= e(t('blog_art_pack_title')) ?> <?= icon('arrow-right') ?></a>
                    <a href="<?= url('contact.php') ?>" class="popular-guide-link"><?= e(t('blog_popular_safe')) ?> <?= icon('arrow-right') ?></a>
                    <a href="<?= url('blog/how-much-does-a-safari-cost.php') ?>" class="popular-guide-link"><?= e(t('blog_art_cost_title')) ?> <?= icon('arrow-right') ?></a>
                    <a href="<?= url('contact.php') ?>" class="popular-guide-link"><?= e(t('blog_art_visa_title')) ?> <?= icon('arrow-right') ?></a>
                </div>
            </div>
        </section>

        <!-- Explore Tanzania (destination guides) -->
        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('map-location-dot') ?> <?= e(t('blog_explore_badge')) ?></span>
                    <h2><?= e(t('blog_explore_title')) ?></h2>
                </div>
                <div class="about-destinations-grid">
                    <a href="<?= url('parks/serengeti-national-park.php') ?>" class="about-destination-pill">
                        <img src="<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>" alt="Serengeti" loading="lazy" />
                        <span class="about-destination-pill-label"><strong><?= e(t('about_dest_serengeti')) ?></strong><small><?= e(t('about_dest_serengeti_sub')) ?></small></span>
                    </a>
                    <a href="<?= url('parks/ngorongoro-conservation-area.php') ?>" class="about-destination-pill">
                        <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="Ngorongoro" loading="lazy" />
                        <span class="about-destination-pill-label"><strong><?= e(t('about_dest_ngorongoro')) ?></strong><small><?= e(t('about_dest_ngorongoro_sub')) ?></small></span>
                    </a>
                    <a href="<?= url('parks/tarangire-national-park.php') ?>" class="about-destination-pill">
                        <img src="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>" alt="Tarangire" loading="lazy" />
                        <span class="about-destination-pill-label"><strong><?= e(t('about_dest_tarangire')) ?></strong><small><?= e(t('about_dest_tarangire_sub')) ?></small></span>
                    </a>
                    <a href="<?= url('trekking/') ?>" class="about-destination-pill">
                        <img src="<?= asset('images/hero/elephant-close-up-portrait.jpg') ?>" alt="Kilimanjaro" loading="lazy" />
                        <span class="about-destination-pill-label"><strong><?= e(t('about_dest_kili')) ?></strong><small><?= e(t('about_dest_kili_sub')) ?></small></span>
                    </a>
                    <a href="<?= url('zanzibar/') ?>" class="about-destination-pill">
                        <img src="<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>" alt="Zanzibar" loading="lazy" />
                        <span class="about-destination-pill-label"><strong><?= e(t('about_dest_zanzibar')) ?></strong><small><?= e(t('about_dest_zanzibar_sub')) ?></small></span>
                    </a>
                </div>
            </div>
        </section>

        <!-- Before you go -->
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('list-check') ?> <?= e(t('blog_before_badge')) ?></span>
                    <h2><?= e(t('blog_before_title')) ?></h2>
                </div>
                <div class="tip-links-grid">
                    <a href="<?= url('contact.php') ?>" class="tip-link-card"><?= icon('suitcase') ?> <span><?= e(t('blog_tip_pack')) ?></span></a>
                    <a href="<?= url('blog/how-much-does-a-safari-cost.php') ?>" class="tip-link-card"><?= icon('money-bill-wave') ?> <span><?= e(t('blog_tip_cost')) ?></span></a>
                    <a href="<?= url('contact.php') ?>" class="tip-link-card"><?= icon('calendar-days') ?> <span><?= e(t('blog_tip_besttime')) ?></span></a>
                    <a href="<?= url('contact.php') ?>" class="tip-link-card"><?= icon('passport') ?> <span><?= e(t('blog_tip_visa')) ?></span></a>
                    <a href="<?= url('contact.php') ?>" class="tip-link-card"><?= icon('syringe') ?> <span><?= e(t('blog_tip_health')) ?></span></a>
                    <a href="<?= url('contact.php') ?>" class="tip-link-card"><?= icon('camera') ?> <span><?= e(t('blog_tip_photo')) ?></span></a>
                </div>
            </div>
        </section>

        <!-- Newsletter (UI only — no email backend yet) -->
        <section class="detail-section bg-light">
            <div class="container">
                <div class="newsletter-card">
                    <span class="section-badge"><?= icon('envelope-open-text') ?> <?= e(t('blog_newsletter_badge')) ?></span>
                    <h2><?= e(t('blog_newsletter_title')) ?></h2>
                    <p><?= e(t('blog_newsletter_intro')) ?></p>
                    <form class="newsletter-form" onsubmit="return false;">
                        <input type="email" placeholder="<?= e(t('blog_newsletter_placeholder')) ?>" required />
                        <button type="submit" class="btn btn-primary"><?= e(t('blog_newsletter_submit')) ?></button>
                    </form>
                    <p class="newsletter-note"><?= e(t('blog_newsletter_note')) ?></p>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('blog_final_title')) ?></h2>
            <p><?= e(t('blog_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="<?= url('safari/') ?>" class="btn btn-primary btn-lg"><?= e(t('blog_final_safaris')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('blog_final_contact')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
