<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'day-trips';
$altPath = 'day-trips/';
$pageMetaTitle = 'daytrips_meta_title';
$pageMetaDescription = 'daytrips_meta_description';

require dirname(__DIR__) . '/includes/header.php';

$trips = [
    [
        'slug' => 'tarangire-day-trip.php',
        'img' => 'wildlife/lion-pride-stalking-zebra.jpg',
        'title' => t('daytrip_tarangire_title'),
        'desc' => t('daytrip_tarangire_desc'),
        'price' => '€200',
        'duration' => t('daytrips_1day'),
    ],
    [
        'slug' => 'contact.php',
        'img' => 'hero/ngorongoro-crater-panorama.jpg',
        'title' => t('daytrip_ngorongoro_title'),
        'desc' => t('daytrip_ngorongoro_desc'),
        'price' => '€230',
        'duration' => t('daytrips_1day'),
    ],
    [
        'slug' => 'contact.php',
        'img' => 'gallery/zebras-savanna-plains.jpg',
        'title' => t('daytrip_manyara_title'),
        'desc' => t('daytrip_manyara_desc'),
        'price' => null,
        'duration' => t('daytrips_1day'),
    ],
    [
        'slug' => 'contact.php',
        'img' => 'wildlife/vervet-monkey-family.jpg',
        'title' => t('daytrip_arushanp_title'),
        'desc' => t('daytrip_arushanp_desc'),
        'price' => null,
        'duration' => t('daytrips_halfday'),
    ],
    [
        'slug' => 'contact.php',
        'img' => 'gallery/savanna-sunrise-acacia-trees.jpg',
        'title' => t('daytrip_materuni_title'),
        'desc' => t('daytrip_materuni_desc'),
        'price' => null,
        'duration' => t('daytrips_1day'),
    ],
    [
        'slug' => 'contact.php',
        'img' => 'team/client-with-maasai-village.jpg',
        'title' => t('daytrip_chemka_title'),
        'desc' => t('daytrip_chemka_desc'),
        'price' => null,
        'duration' => t('daytrips_halfday'),
    ],
    [
        'slug' => 'contact.php',
        'img' => 'team/clients-company-vehicle-portrait-1.jpg',
        'title' => t('daytrip_maasai_title'),
        'desc' => t('daytrip_maasai_desc'),
        'price' => null,
        'duration' => t('daytrips_halfday'),
    ],
    [
        'slug' => 'contact.php',
        'img' => 'gallery/tourists-watching-hippos-river.jpg',
        'title' => t('daytrip_duluti_title'),
        'desc' => t('daytrip_duluti_desc'),
        'price' => null,
        'duration' => t('daytrips_halfday'),
    ],
    [
        'slug' => 'contact.php',
        'img' => 'team/ranger-clients-safari-vehicle-logo.jpg',
        'title' => t('daytrip_arushacity_title'),
        'desc' => t('daytrip_arushacity_desc'),
        'price' => null,
        'duration' => t('daytrips_halfday'),
    ],
    [
        'slug' => 'contact.php',
        'img' => 'hero/elephant-under-acacia-tree.jpg',
        'title' => t('daytrip_kiliday_title'),
        'desc' => t('daytrip_kiliday_desc'),
        'price' => null,
        'duration' => t('daytrips_1day'),
    ],
];
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-badge"><?= icon('sun') ?> <?= e(t('daytrips_hero_badge')) ?></span>
                <h1><?= e(t('daytrips_hero_title')) ?></h1>
                <p class="hero-sub"><?= e(t('daytrips_hero_sub')) ?></p>
                <div class="page-hero-actions">
                    <a href="<?= url('contact.php') ?>" class="btn btn-primary"><?= e(t('daytrips_hero_quote')) ?></a>
                    <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('daytrips_hero_whatsapp')) ?></a>
                </div>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('list') ?> <?= e(t('daytrips_grid_badge')) ?></span>
                    <h2><?= e(t('daytrips_grid_title')) ?></h2>
                    <p><?= e(t('daytrips_grid_intro')) ?></p>
                </div>

                <div class="grid-3">
                    <?php foreach ($trips as $trip): ?>
                    <a href="<?= url('day-trips/' . $trip['slug']) ?>" class="day-trip-card">
                        <div class="day-trip-card-img">
                            <img src="<?= asset('images/' . $trip['img']) ?>" alt="<?= e($trip['title']) ?>" loading="lazy" />
                            <span class="day-trip-card-duration"><?= e($trip['duration']) ?></span>
                        </div>
                        <div class="day-trip-card-body">
                            <h3><?= e($trip['title']) ?></h3>
                            <p><?= e($trip['desc']) ?></p>
                            <div class="day-trip-card-footer">
                                <?php if ($trip['price']): ?>
                                <div class="price-tag"><?= e($trip['price']) ?> <small><?= e(t('daytrips_from_pp')) ?></small></div>
                                <?php else: ?>
                                <div class="price-tag"><?= e(t('daytrips_ask_price')) ?></div>
                                <?php endif; ?>
                                <span class="popular-package-arrow"><?= icon('arrow-right') ?></span>
                            </div>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </div>
        </section>

        <section class="detail-section bg-light">
            <div class="container">
                <div class="section-title-left centered">
                    <span class="section-badge"><?= icon('circle-info') ?> <?= e(t('daytrips_know_badge')) ?></span>
                    <h2><?= e(t('daytrips_know_title')) ?></h2>
                </div>
                <div class="grid-2">
                    <div class="info-card">
                        <h3><?= e(t('daytrips_pickup_title')) ?></h3>
                        <p><?= e(t('daytrips_pickup_desc')) ?></p>
                    </div>
                    <div class="info-card">
                        <h3><?= e(t('daytrips_bring_title')) ?></h3>
                        <p><?= e(t('daytrips_bring_desc')) ?></p>
                    </div>
                    <div class="info-card">
                        <h3><?= e(t('daytrips_combine_title')) ?></h3>
                        <p><?= e(t('daytrips_combine_desc')) ?></p>
                    </div>
                    <div class="info-card">
                        <h3><?= e(t('daytrips_booking_title')) ?></h3>
                        <p><?= e(t('daytrips_booking_desc')) ?></p>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <section class="cta-section">
        <div class="container">
            <h2><?= e(t('daytrips_final_title')) ?></h2>
            <p><?= e(t('daytrips_final_intro')) ?></p>
            <div class="btn-group" style="justify-content:center;">
                <a href="https://wa.me/255697612865" class="btn btn-success btn-lg" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> <?= e(t('daytrips_final_whatsapp')) ?></a>
                <a href="<?= url('contact.php') ?>" class="btn btn-light btn-lg"><?= e(t('daytrips_final_contact')) ?></a>
            </div>
        </div>
    </section>

<?php
require dirname(__DIR__) . '/includes/footer.php';
?>
