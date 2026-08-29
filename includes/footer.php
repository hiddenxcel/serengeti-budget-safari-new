    <footer class="mega-footer">
        <div class="container">
            <div class="mega-footer-grid">
                <div class="mega-footer-col">
                    <h3>Serengeti <span>Budget</span> Safari</h3>
                    <p><?= e(t('footer_tagline')) ?></p>
                    <div class="social-links">
                        <a href="https://www.facebook.com/serengetibudgetsafari" target="_blank" rel="noopener" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/serengetibudgetsafari" target="_blank" rel="noopener" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.youtube.com/@serengetibudgetsafari" target="_blank" rel="noopener" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
                        <a href="https://wa.me/255697612865" target="_blank" rel="noopener" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
                    </div>
                </div>
                <div class="mega-footer-col">
                    <h4><?= e(t('footer_travel')) ?></h4>
                    <ul>
                        <li><a href="<?= url('safari/') ?>"><?= e(t('nav_safaris')) ?></a></li>
                        <li><a href="<?= url('trekking/') ?>"><?= e(t('nav_trekking')) ?></a></li>
                        <li><a href="<?= url('zanzibar/') ?>"><?= e(t('nav_zanzibar')) ?></a></li>
                        <li><a href="<?= url('day-trips/') ?>"><?= e(t('nav_day_trips')) ?></a></li>
                    </ul>
                </div>
                <div class="mega-footer-col">
                    <h4><?= e(t('footer_northern_parks')) ?></h4>
                    <ul>
                        <li><a href="<?= url('parks/serengeti-national-park.php') ?>">Serengeti</a></li>
                        <li><a href="<?= url('parks/ngorongoro-conservation-area.php') ?>">Ngorongoro</a></li>
                        <li><a href="<?= url('parks/tarangire-national-park.php') ?>">Tarangire</a></li>
                        <li><a href="<?= url('parks/lake-manyara-national-park.php') ?>">Lake Manyara</a></li>
                        <li><a href="<?= url('parks/arusha-national-park.php') ?>">Arusha NP</a></li>
                        <li><a href="<?= url('parks/kilimanjaro-national-park.php') ?>">Kilimanjaro</a></li>
                    </ul>
                </div>
                <div class="mega-footer-col">
                    <h4><?= e(t('footer_southern_parks')) ?></h4>
                    <ul>
                        <li><a href="<?= url('parks/nyerere-national-park.php') ?>">Nyerere (Selous)</a></li>
                        <li><a href="<?= url('parks/ruaha-national-park.php') ?>">Ruaha</a></li>
                        <li><a href="<?= url('parks/mikumi-national-park.php') ?>">Mikumi</a></li>
                        <li><a href="<?= url('parks/') ?>"><?= e(t('destinations_see_all')) ?></a></li>
                    </ul>
                </div>
                <div class="mega-footer-col">
                    <h4><?= e(t('footer_guides')) ?></h4>
                    <ul>
                        <li><a href="<?= url('blog/great-migration-month-by-month.php') ?>">Great Migration</a></li>
                        <li><a href="<?= url('blog/how-much-does-a-safari-cost.php') ?>"><?= e(t('nav_guides')) ?></a></li>
                        <li><a href="<?= url('blog/') ?>"><?= e(t('destinations_see_all')) ?></a></li>
                    </ul>
                </div>
                <div class="mega-footer-col">
                    <h4><?= e(t('footer_company')) ?></h4>
                    <ul>
                        <li><a href="<?= url('about.php') ?>"><?= e(t('nav_about')) ?></a></li>
                        <li><a href="<?= url('contact.php') ?>"><?= e(t('nav_contact')) ?></a></li>
                        <li><a href="<?= url('privacy-policy.php') ?>"><?= e(t('footer_privacy')) ?></a></li>
                        <li><a href="<?= url('terms-and-conditions.php') ?>"><?= e(t('footer_terms')) ?></a></li>
                    </ul>
                </div>
                <div class="mega-footer-col">
                    <h4><?= e(t('footer_languages')) ?></h4>
                    <ul>
                        <li><a href="<?= base_url() ?>/en/<?= e($altPath ?? '') ?>" hreflang="en">English</a></li>
                        <li><a href="<?= base_url() ?>/it/<?= e($altPath ?? '') ?>" hreflang="it">Italiano</a></li>
                    </ul>
                </div>
                <div class="mega-footer-col">
                    <h4><?= e(t('footer_contact')) ?></h4>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> Arusha, Tanzania</li>
                        <li><i class="fab fa-whatsapp"></i> <a href="https://wa.me/255697612865" target="_blank" rel="noopener">+255 697 612 865</a></li>
                        <li><i class="fas fa-envelope"></i> <a href="mailto:serengetibudgetsafari@gmail.com">serengetibudgetsafari@gmail.com</a></li>
                        <li><i class="fas fa-clock"></i> Mon&ndash;Sun 07:00&ndash;21:00</li>
                    </ul>
                </div>
            </div>
            <div class="mega-footer-bottom">
                <p><?= e(t('footer_rights')) ?></p>
                <div class="mega-footer-legal">
                    <a href="<?= url('privacy-policy.php') ?>"><?= e(t('footer_privacy')) ?></a> |
                    <a href="<?= url('terms-and-conditions.php') ?>"><?= e(t('footer_terms')) ?></a> |
                    <a href="<?= url('cookie-policy.php') ?>"><?= e(t('footer_cookie')) ?></a>
                </div>
            </div>
        </div>
    </footer>

    <script src="<?= asset('js/main.js') ?>"></script>
<?php foreach ($extraScripts ?? [] as $src): ?>
    <script src="<?= asset($src) ?>"></script>
<?php endforeach; ?>
</body>

</html>
