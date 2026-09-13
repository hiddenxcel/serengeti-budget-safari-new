<div class="promo-overlay" id="promoOverlay" role="dialog" aria-modal="true" aria-labelledby="promoTitle" hidden>
    <div class="promo-card">
        <div class="promo-visual">
            <img src="<?= asset('images/promo/napuru-waterfalls-guests-experience.jpg') ?>" alt="Happy travelers enjoying a Tanzania safari experience" loading="lazy">
            <button type="button" class="promo-close" data-promo-close aria-label="<?= e(t('promo_close_aria')) ?>">
                <i class="fas fa-times"></i>
            </button>
        </div>

        <div class="promo-content">
            <span class="promo-eyebrow"><span class="dot"></span> <?= e(t('promo_eyebrow')) ?></span>

            <h2 class="promo-title" id="promoTitle">
                <?= e(t('promo_title_1')) ?>
                <span class="line-2"><?= e(t('promo_title_2')) ?></span>
            </h2>
            <p class="promo-intro"><?= e(t('promo_intro')) ?></p>

            <ul class="promo-perks">
                <li class="promo-perk">
                    <span class="promo-perk-icon"><i class="fas fa-check"></i></span>
                    <span class="promo-perk-label"><?= e(t('promo_perk_1_title')) ?></span>
                </li>
                <li class="promo-perk">
                    <span class="promo-perk-icon"><i class="fas fa-check"></i></span>
                    <span class="promo-perk-label"><?= e(t('promo_perk_2_title')) ?></span>
                </li>
                <li class="promo-perk">
                    <span class="promo-perk-icon"><i class="fas fa-check"></i></span>
                    <span class="promo-perk-label"><?= e(t('promo_perk_3_title')) ?></span>
                </li>
                <li class="promo-perk">
                    <span class="promo-perk-icon"><i class="fas fa-check"></i></span>
                    <span class="promo-perk-label"><?= e(t('promo_perk_4_title')) ?></span>
                </li>
                <li class="promo-perk">
                    <span class="promo-perk-icon"><i class="fas fa-check"></i></span>
                    <span class="promo-perk-label"><?= e(t('promo_perk_5_title')) ?></span>
                </li>
            </ul>

            <div class="promo-actions">
                <a href="<?= url('booking/') ?>" class="promo-btn-primary" data-promo-primary>
                    <?= e(t('promo_cta_primary')) ?> <i class="fas fa-arrow-right"></i>
                </a>
                <a href="https://wa.me/255697612865?text=<?= urlencode('Hi! I saw your free extras offer and I would like to book a safari.') ?>" class="promo-btn-secondary" target="_blank" rel="noopener">
                    <i class="fab fa-whatsapp"></i> <?= e(t('promo_cta_secondary')) ?>
                </a>
            </div>

            <div class="promo-trust">
                <div class="promo-trust-item">
                    <strong>500+</strong>
                    <span><?= e(t('promo_trust_travelers')) ?></span>
                </div>
                <div class="promo-trust-item">
                    <strong>15+</strong>
                    <span><?= e(t('promo_trust_years')) ?></span>
                </div>
                <div class="promo-trust-item">
                    <strong>24/7</strong>
                    <span><?= e(t('promo_trust_support')) ?></span>
                </div>
            </div>

            <p class="promo-disclaimer"><?= e(t('promo_disclaimer')) ?></p>
        </div>
    </div>
</div>
