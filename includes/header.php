<!DOCTYPE html>
<html lang="<?= e($lang) ?>">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title><?= e(t($pageMetaTitle ?? 'meta_title')) ?></title>
    <meta name="description" content="<?= e(t($pageMetaDescription ?? 'meta_description')) ?>" />
    <link rel="canonical" href="<?= SITE_URL . base_url() . '/' . $lang . '/' . ($altPath ?? '') ?>" />

    <link rel="alternate" hreflang="it" href="<?= SITE_URL . base_url() ?>/it/<?= e($altPath ?? '') ?>" />
    <link rel="alternate" hreflang="en" href="<?= SITE_URL . base_url() ?>/en/<?= e($altPath ?? '') ?>" />
    <link rel="alternate" hreflang="x-default" href="<?= SITE_URL . base_url() ?>/en/<?= e($altPath ?? '') ?>" />

    <meta property="og:title" content="<?= e(t($pageMetaTitle ?? 'meta_title')) ?>" />
    <meta property="og:description" content="<?= e(t($pageMetaDescription ?? 'meta_description')) ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="<?= SITE_URL . base_url() . '/' . $lang . '/' . ($altPath ?? '') ?>" />
    <meta property="og:image" content="<?= SITE_URL . asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" />
    <meta property="og:locale" content="<?= $lang === 'it' ? 'it_IT' : 'en_GB' ?>" />
    <meta name="twitter:card" content="summary_large_image" />

    <script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "TravelAgency",
        "name": "Serengeti Budget Safari",
        "url": "<?= SITE_URL . url('') ?>",
        "logo": "<?= SITE_URL . asset('images/logo.svg') ?>",
        "image": "<?= SITE_URL . asset('images/hero/ngorongoro-crater-panorama.jpg') ?>",
        "description": "<?= e(t('meta_description')) ?>",
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "Arusha",
            "addressRegion": "Arusha Region",
            "addressCountry": "TZ"
        },
        "telephone": "+255697612865",
        "email": "serengetibudgetsafari@gmail.com",
        "priceRange": "$$",
        "areaServed": "Tanzania",
        "openingHours": "Mo-Su 07:00-21:00",
        "sameAs": [
            "https://www.facebook.com/serengetibudgetsafari",
            "https://www.instagram.com/serengetibudgetsafari",
            "https://www.youtube.com/@serengetibudgetsafari"
        ]
    }
    </script>

    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Caveat:wght@500;600;700&family=Inter:wght@300;400;500;600;700;800;900&family=Playfair+Display:wght@600;700;800;900&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <link rel="stylesheet" href="<?= asset('css/main.css') ?>">
<?php foreach ($extraStyles ?? [] as $href): ?>
    <link rel="stylesheet" href="<?= asset($href) ?>">
<?php endforeach; ?>
    <link rel="icon" href="<?= asset('images/logo.svg') ?>" type="image/svg+xml" />
</head>

<body class="hero-behind-header <?= e($bodyClass ?? '') ?>">

    <div id="pagePreloader" class="page-preloader" aria-hidden="true">
        <span class="page-preloader-spinner"></span>
    </div>
    <noscript><style>.page-preloader{display:none!important;}</style></noscript>

    <header class="site-header" id="siteHeader">
        <div class="container header-container">
            <a href="<?= url('') ?>" class="logo" aria-label="Serengeti Budget Safari - Home">
                <img src="<?= asset('images/logo.svg') ?>" alt="Serengeti Budget Safari" width="320" height="96">
                <span>Serengeti <span>Budget</span> Safari</span>
            </a>
            <nav id="mainNav" role="navigation" aria-label="Main menu">
                <ul>
                    <li><a href="<?= url('') ?>" class="<?= $page === 'home' ? 'active' : '' ?>"><?= e(t('nav_home')) ?></a></li>

                    <li class="has-mega">
                        <button type="button" class="mega-trigger" aria-expanded="false"><?= e(t('nav_safaris')) ?> <?= icon('chevron-down') ?></button>
                        <div class="mega-panel mega-panel-preview" data-preview-panel>
                            <div class="mega-preview-grid">
                                <ul class="mega-preview-list">
                                    <li>
                                        <button type="button" class="mega-preview-item active"
                                            data-title="<?= e(t('nav_safari_budget')) ?>"
                                            data-desc="<?= e(t('nav_safari_budget_long')) ?>"
                                            data-img="<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>"
                                            data-href="<?= url('safari/budget-safari-guide.php') ?>">
                                            <strong><?= e(t('nav_safari_budget')) ?></strong>
                                            <span><?= e(t('nav_safari_budget_desc')) ?></span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="mega-preview-item"
                                            data-title="<?= e(t('nav_safari_luxury')) ?>"
                                            data-desc="<?= e(t('nav_safari_luxury_long')) ?>"
                                            data-img="<?= asset('images/gallery/savanna-sunrise-acacia-trees.jpg') ?>"
                                            data-href="<?= url('safari/luxury-safari-guide.php') ?>">
                                            <strong><?= e(t('nav_safari_luxury')) ?></strong>
                                            <span><?= e(t('nav_safari_luxury_desc')) ?></span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="mega-preview-item"
                                            data-title="<?= e(t('nav_safari_migration')) ?>"
                                            data-desc="<?= e(t('nav_safari_migration_long')) ?>"
                                            data-img="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>"
                                            data-href="<?= url('safari/great-migration-guide.php') ?>">
                                            <strong><?= e(t('nav_safari_migration')) ?></strong>
                                            <span><?= e(t('nav_safari_migration_desc')) ?></span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="mega-preview-item"
                                            data-title="<?= e(t('nav_safari_family')) ?>"
                                            data-desc="<?= e(t('nav_safari_family_long')) ?>"
                                            data-img="<?= asset('images/team/guide-client-ngorongoro-viewpoint.jpg') ?>"
                                            data-href="<?= url('safari/groups.php') ?>">
                                            <strong><?= e(t('nav_safari_family')) ?></strong>
                                            <span><?= e(t('nav_safari_family_desc')) ?></span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="mega-preview-item"
                                            data-title="<?= e(t('nav_day_trips')) ?>"
                                            data-desc="<?= e(t('nav_day_trips_long')) ?>"
                                            data-img="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>"
                                            data-href="<?= url('safari/day-trips-guide.php') ?>">
                                            <strong><?= e(t('nav_day_trips')) ?></strong>
                                            <span><?= e(t('nav_day_trips_desc')) ?></span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="mega-preview-item"
                                            data-title="<?= e(t('nav_trekking')) ?>"
                                            data-desc="<?= e(t('nav_trekking_long')) ?>"
                                            data-img="<?= asset('images/hero/male-lion-portrait-mane.jpg') ?>"
                                            data-href="<?= url('trekking/') ?>">
                                            <strong><?= e(t('nav_trekking')) ?></strong>
                                            <span><?= e(t('nav_trekking_desc')) ?></span>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="mega-preview-item"
                                            data-title="<?= e(t('nav_zanzibar')) ?>"
                                            data-desc="<?= e(t('nav_zanzibar_long')) ?>"
                                            data-img="<?= asset('images/gallery/elephant-family-sunset-walk.jpg') ?>"
                                            data-href="<?= url('zanzibar/') ?>">
                                            <strong><?= e(t('nav_zanzibar')) ?></strong>
                                            <span><?= e(t('nav_zanzibar_desc')) ?></span>
                                        </button>
                                    </li>
                                </ul>
                                <div class="mega-preview-stage">
                                    <div class="mega-preview-body">
                                        <h4 data-preview-title><?= e(t('nav_safari_budget')) ?></h4>
                                        <p data-preview-desc><?= e(t('nav_safari_budget_long')) ?></p>
                                        <a href="<?= url('safari/budget-safari-guide.php') ?>" class="mega-cta" data-preview-link><?= e(t('nav_preview_explore')) ?> <?= icon('arrow-right') ?></a>
                                    </div>
                                    <div class="mega-preview-photo" data-preview-photo style="background-image:url('<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>');"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li class="has-mega">
                        <button type="button" class="mega-trigger" aria-expanded="false"><?= e(t('nav_parks')) ?> <?= icon('chevron-down') ?></button>
                        <div class="mega-panel mega-panel-preview" data-preview-panel>
                            <div class="mega-preview-grid">
                                <ul class="mega-preview-list">
                                    <li>
                                        <button type="button" class="mega-preview-item active"
                                            data-title="<?= e(t('parks_serengeti_name')) ?>"
                                            data-desc="<?= e(t('parks_serengeti_desc')) ?>"
                                            data-img="<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>"
                                            data-href="<?= url('parks/serengeti-national-park.php') ?>">
                                            <strong><?= e(t('parks_serengeti_name')) ?></strong>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="mega-preview-item"
                                            data-title="<?= e(t('parks_ngorongoro_name')) ?>"
                                            data-desc="<?= e(t('parks_ngorongoro_desc')) ?>"
                                            data-img="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>"
                                            data-href="<?= url('parks/ngorongoro-conservation-area.php') ?>">
                                            <strong><?= e(t('parks_ngorongoro_name')) ?></strong>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="mega-preview-item"
                                            data-title="<?= e(t('parks_tarangire_name')) ?>"
                                            data-desc="<?= e(t('parks_tarangire_desc')) ?>"
                                            data-img="<?= asset('images/hero/elephant-under-acacia-tree.jpg') ?>"
                                            data-href="<?= url('parks/tarangire-national-park.php') ?>">
                                            <strong><?= e(t('parks_tarangire_name')) ?></strong>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="mega-preview-item"
                                            data-title="<?= e(t('parks_manyara_name')) ?>"
                                            data-desc="<?= e(t('parks_manyara_desc')) ?>"
                                            data-img="<?= asset('images/wildlife/spotted-hyena-savanna.jpg') ?>"
                                            data-href="<?= url('parks/lake-manyara-national-park.php') ?>">
                                            <strong><?= e(t('parks_manyara_name')) ?></strong>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="mega-preview-item"
                                            data-title="<?= e(t('parks_arusha_name')) ?>"
                                            data-desc="<?= e(t('parks_arusha_desc')) ?>"
                                            data-img="<?= asset('images/wildlife/cheetahs-resting-shade.jpg') ?>"
                                            data-href="<?= url('parks/arusha-national-park.php') ?>">
                                            <strong><?= e(t('parks_arusha_name')) ?></strong>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="mega-preview-item"
                                            data-title="<?= e(t('parks_kilimanjaro_name')) ?>"
                                            data-desc="<?= e(t('parks_kilimanjaro_desc')) ?>"
                                            data-img="<?= asset('images/hero/male-lion-portrait-mane.jpg') ?>"
                                            data-href="<?= url('parks/kilimanjaro-national-park.php') ?>">
                                            <strong><?= e(t('parks_kilimanjaro_name')) ?></strong>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="mega-preview-item"
                                            data-title="<?= e(t('parks_nyerere_name')) ?>"
                                            data-desc="<?= e(t('parks_nyerere_desc')) ?>"
                                            data-img="<?= asset('images/wildlife/white-rhino-grazing.jpg') ?>"
                                            data-href="<?= url('parks/nyerere-national-park.php') ?>">
                                            <strong><?= e(t('parks_nyerere_name')) ?></strong>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="mega-preview-item"
                                            data-title="<?= e(t('parks_ruaha_name')) ?>"
                                            data-desc="<?= e(t('parks_ruaha_desc')) ?>"
                                            data-img="<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>"
                                            data-href="<?= url('parks/ruaha-national-park.php') ?>">
                                            <strong><?= e(t('parks_ruaha_name')) ?></strong>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="mega-preview-item"
                                            data-title="<?= e(t('parks_mikumi_name')) ?>"
                                            data-desc="<?= e(t('parks_mikumi_desc')) ?>"
                                            data-img="<?= asset('images/wildlife/zebra-herd-grazing-savanna.jpg') ?>"
                                            data-href="<?= url('parks/mikumi-national-park.php') ?>">
                                            <strong><?= e(t('parks_mikumi_name')) ?></strong>
                                        </button>
                                    </li>
                                </ul>
                                <div class="mega-preview-stage">
                                    <div class="mega-preview-body">
                                        <h4 data-preview-title><?= e(t('parks_serengeti_name')) ?></h4>
                                        <p data-preview-desc><?= e(t('parks_serengeti_desc')) ?></p>
                                        <a href="<?= url('parks/serengeti-national-park.php') ?>" class="mega-cta" data-preview-link><?= e(t('nav_preview_explore')) ?> <?= icon('arrow-right') ?></a>
                                    </div>
                                    <div class="mega-preview-photo" data-preview-photo style="background-image:url('<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>');"></div>
                                </div>
                            </div>
                        </div>
                    </li>

                    <li><a href="<?= url('trekking/') ?>"><?= e(t('nav_trekking')) ?></a></li>
                    <li><a href="<?= url('zanzibar/') ?>"><?= e(t('nav_zanzibar')) ?></a></li>
                    <li><a href="<?= url('blog/') ?>"><?= e(t('nav_guides')) ?></a></li>
                    <li><a href="<?= url('about.php') ?>"><?= e(t('nav_about')) ?></a></li>
                    <li><a href="<?= url('contact.php') ?>" class="btn btn-primary btn-nav"><?= e(t('nav_contact')) ?></a></li>
                </ul>
            </nav>
            <div class="header-right">
                <div class="header-phone">
                    <span class="header-phone-icon" aria-hidden="true"><?= icon('phone-alt') ?></span>
                    <span class="header-phone-text">
                        <span class="header-phone-label"><?= e(t('nav_call_anytime')) ?></span>
                        <a href="tel:+255697612865" class="header-phone-number">+255 697 612 865</a>
                    </span>
                </div>
                <div class="lang-switcher">
                    <button class="lang-toggle" id="langToggle" aria-label="Change language">
                        <span class="lang-current-code"><?= strtoupper($lang) ?></span>
                        <svg class="lang-chevron" width="12" height="12" viewBox="0 0 12 12" fill="none">
                            <path d="M2 4L6 8L10 4" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>
                    <ul class="lang-dropdown" id="langDropdown">
                        <li><a href="<?= base_url() ?>/en/<?= e($altPath ?? '') ?>" class="lang-option <?= $lang === 'en' ? 'active' : '' ?>" data-lang="en"><span class="lang-name">English</span><span class="lang-code">EN</span></a></li>
                        <li><a href="<?= base_url() ?>/it/<?= e($altPath ?? '') ?>" class="lang-option <?= $lang === 'it' ? 'active' : '' ?>" data-lang="it"><span class="lang-name">Italiano</span><span class="lang-code">IT</span></a></li>
                    </ul>
                </div>
                <a href="<?= url('contact.php') ?>" class="header-cta" aria-label="<?= e(t('nav_book_safari')) ?>"><?= e(t('nav_book_safari')) ?></a>
                <button class="hamburger" id="hamburger" aria-label="Open menu" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </header>
