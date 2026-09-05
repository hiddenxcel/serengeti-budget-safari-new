<?php
declare(strict_types=1);

require __DIR__ . '/config/config.php';
require __DIR__ . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'saved';
$altPath = 'saved.php';
$pageMetaTitle = 'saved_meta_title';
$pageMetaDescription = 'saved_meta_description';

require __DIR__ . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/wildlife/lion-pride-stalking-zebra.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-tagline"><?= e(badge_tagline('saved_hero_badge')) ?></span>
                <h1><?= e(t('saved_hero_title')) ?></h1>
                <p class="hero-sub"><?= e(t('saved_hero_sub')) ?></p>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div id="savedSafarisGrid" class="saved-safaris-grid"></div>

                <div id="savedSafarisEmpty" class="saved-empty-state" style="display:none;">
                    <?= icon('heart') ?>
                    <h2><?= e(t('saved_empty_title')) ?></h2>
                    <p><?= e(t('saved_empty_desc')) ?></p>
                    <a href="<?= url('safari/') ?>" class="btn btn-primary"><?= e(t('saved_empty_cta')) ?></a>
                </div>
            </div>
        </section>
    </main>

    <script>
        window.SAVED_STRINGS = {
            view: <?= json_encode(t('saved_view')) ?>,
            remove: <?= json_encode(t('saved_remove')) ?>
        };
    </script>

<?php
$extraScripts = ['js/saved-safaris-page.js'];
require __DIR__ . '/includes/footer.php';
?>
