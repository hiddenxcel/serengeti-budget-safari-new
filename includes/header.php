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
    <link rel="icon" href="<?= asset('images/favicon.svg') ?>" type="image/svg+xml" />
</head>

<body class="hero-behind-header <?= e($bodyClass ?? '') ?>">

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
                        <button type="button" class="mega-trigger" aria-expanded="false"><?= e(t('nav_safaris')) ?> <i class="fas fa-chevron-down"></i></button>
                        <div class="mega-panel">
                            <div class="mega-panel-inner">
                                <div class="mega-col">
                                    <span class="mega-col-heading"><?= e(t('nav_safaris_by_style_heading')) ?></span>
                                    <a href="<?= url('safari/') ?>" class="mega-link">
                                        <span class="mega-link-icon"><i class="fas fa-wallet"></i></span>
                                        <span><strong><?= e(t('nav_safari_budget')) ?></strong><small><?= e(t('nav_safari_budget_desc')) ?></small></span>
                                    </a>
                                    <a href="<?= url('safari/') ?>" class="mega-link">
                                        <span class="mega-link-icon"><i class="fas fa-gem"></i></span>
                                        <span><strong><?= e(t('nav_safari_luxury')) ?></strong><small><?= e(t('nav_safari_luxury_desc')) ?></small></span>
                                    </a>
                                    <a href="<?= url('safari/') ?>" class="mega-link">
                                        <span class="mega-link-icon"><i class="fas fa-kiwi-bird"></i></span>
                                        <span><strong><?= e(t('nav_safari_migration')) ?></strong><small><?= e(t('nav_safari_migration_desc')) ?></small></span>
                                    </a>
                                    <a href="<?= url('safari/groups.php') ?>" class="mega-link">
                                        <span class="mega-link-icon"><i class="fas fa-users"></i></span>
                                        <span><strong><?= e(t('nav_safari_family')) ?></strong><small><?= e(t('nav_safari_family_desc')) ?></small></span>
                                    </a>
                                </div>
                                <div class="mega-col">
                                    <span class="mega-col-heading"><?= e(t('nav_safaris_more_heading')) ?></span>
                                    <a href="<?= url('day-trips/') ?>" class="mega-link">
                                        <span class="mega-link-icon"><i class="fas fa-hiking"></i></span>
                                        <span><strong><?= e(t('nav_day_trips')) ?></strong><small><?= e(t('nav_day_trips_desc')) ?></small></span>
                                    </a>
                                    <a href="<?= url('trekking/') ?>" class="mega-link">
                                        <span class="mega-link-icon"><i class="fas fa-mountain"></i></span>
                                        <span><strong><?= e(t('nav_trekking')) ?></strong><small><?= e(t('nav_trekking_desc')) ?></small></span>
                                    </a>
                                    <a href="<?= url('zanzibar/') ?>" class="mega-link">
                                        <span class="mega-link-icon"><i class="fas fa-umbrella-beach"></i></span>
                                        <span><strong><?= e(t('nav_zanzibar')) ?></strong><small><?= e(t('nav_zanzibar_desc')) ?></small></span>
                                    </a>
                                    <a href="<?= url('safari/') ?>" class="mega-cta"><?= e(t('nav_safaris_cta')) ?> <i class="fas fa-arrow-right"></i></a>
                                </div>
                                <a href="<?= url('safari/') ?>" class="mega-feature">
                                    <img src="<?= asset('images/wildlife/lion-pride-zebra-kill.jpg') ?>" alt="<?= e(t('nav_safaris_featured_title')) ?>" loading="lazy" />
                                    <span class="mega-feature-badge"><?= e(t('nav_safaris_featured')) ?></span>
                                    <span class="mega-feature-body">
                                        <strong><?= e(t('nav_safaris_featured_title')) ?></strong>
                                        <small><?= e(t('nav_safaris_featured_desc')) ?></small>
                                        <span class="mega-feature-price"><?= e(t('nav_safaris_featured_price')) ?></span>
                                    </span>
                                </a>
                            </div>
                        </div>
                    </li>

                    <li class="has-mega">
                        <button type="button" class="mega-trigger" aria-expanded="false"><?= e(t('nav_parks')) ?> <i class="fas fa-chevron-down"></i></button>
                        <div class="mega-panel">
                            <div class="mega-panel-inner">
                                <div class="mega-col">
                                    <span class="mega-col-heading"><?= e(t('nav_destinations_north_heading')) ?></span>
                                    <a href="<?= url('parks/serengeti-national-park.php') ?>" class="mega-link-plain">Serengeti</a>
                                    <a href="<?= url('parks/ngorongoro-conservation-area.php') ?>" class="mega-link-plain">Ngorongoro</a>
                                    <a href="<?= url('parks/tarangire-national-park.php') ?>" class="mega-link-plain">Tarangire</a>
                                    <a href="<?= url('parks/lake-manyara-national-park.php') ?>" class="mega-link-plain">Lake Manyara</a>
                                    <a href="<?= url('parks/arusha-national-park.php') ?>" class="mega-link-plain">Arusha NP</a>
                                    <a href="<?= url('parks/kilimanjaro-national-park.php') ?>" class="mega-link-plain">Kilimanjaro</a>
                                </div>
                                <div class="mega-col">
                                    <span class="mega-col-heading"><?= e(t('nav_destinations_south_heading')) ?></span>
                                    <a href="<?= url('parks/nyerere-national-park.php') ?>" class="mega-link-plain">Nyerere (Selous)</a>
                                    <a href="<?= url('parks/ruaha-national-park.php') ?>" class="mega-link-plain">Ruaha</a>
                                    <a href="<?= url('parks/mikumi-national-park.php') ?>" class="mega-link-plain">Mikumi</a>
                                    <a href="<?= url('parks/') ?>" class="mega-cta"><?= e(t('nav_destinations_cta')) ?> <i class="fas fa-arrow-right"></i></a>
                                </div>
                                <a href="<?= url('parks/serengeti-national-park.php') ?>" class="mega-feature">
                                    <img src="<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>" alt="<?= e(t('nav_destinations_featured_title')) ?>" loading="lazy" />
                                    <span class="mega-feature-badge"><?= e(t('nav_destinations_featured')) ?></span>
                                    <span class="mega-feature-body">
                                        <strong><?= e(t('nav_destinations_featured_title')) ?></strong>
                                        <small><?= e(t('nav_destinations_featured_desc')) ?></small>
                                    </span>
                                </a>
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
                    <span class="header-phone-icon" aria-hidden="true"><i class="fas fa-phone-alt"></i></span>
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
                <a href="<?= url('contact.php') ?>" class="header-cta"><?= e(t('nav_book_safari')) ?></a>
                <button class="hamburger" id="hamburger" aria-label="Open menu" aria-expanded="false">
                    <span></span><span></span><span></span>
                </button>
            </div>
        </div>
    </header>
