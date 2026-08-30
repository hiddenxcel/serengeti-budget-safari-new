<?php
declare(strict_types=1);

require dirname(__DIR__) . '/config/config.php';
require dirname(__DIR__) . '/includes/functions.php';

$lang = current_lang();
$strings = load_lang($lang);
$page = 'booking';
$altPath = 'booking/';
$pageMetaTitle = 'booking_meta_title';
$pageMetaDescription = 'booking_meta_description';

$slug = trim((string) ($_GET['safari'] ?? ''));
$safari = null;

if ($slug !== '') {
    $stmt = db()->prepare("SELECT * FROM safaris WHERE slug = ? AND status = 'published' LIMIT 1");
    $stmt->execute([$slug]);
    $safari = $stmt->fetch() ?: null;
}

// Legacy hardcoded packages (not yet migrated into the safaris table) are
// still bookable — carry their title/price/link through as plain query
// params from the calling page instead of a DB lookup.
$fallbackTitle = trim((string) ($_GET['title'] ?? ''));
$fallbackPricePerPerson = isset($_GET['pp']) ? (float) $_GET['pp'] : null;
$fallbackCurrency = trim((string) ($_GET['currency'] ?? 'USD')) ?: 'USD';

if (!$safari && $fallbackTitle === '') {
    header('Location: ' . url('safari/'));
    exit;
}

$safariTitleKey = $lang === 'it' ? 'title_it' : 'title_en';
$displayTitle = $safari ? $safari[$safariTitleKey] : $fallbackTitle;

$tiers = [];
if ($safari) {
    $tiersStmt = db()->prepare('SELECT up_to_travelers, price_per_person, currency FROM pricing_tiers WHERE safari_id = ? ORDER BY up_to_travelers');
    $tiersStmt->execute([$safari['id']]);
    $tiers = $tiersStmt->fetchAll();
}

$prefillDate = trim((string) ($_GET['date'] ?? ''));
$prefillAdults = max(1, (int) ($_GET['adults'] ?? 2));

require dirname(__DIR__) . '/includes/header.php';
?>

    <section class="page-hero">
        <div class="page-hero-bg" style="background-image:url('<?= asset('images/hero/ngorongoro-crater-panorama.jpg') ?>');"></div>
        <div class="page-hero-overlay"></div>
        <div class="container page-hero-container">
            <div class="page-hero-content">
                <span class="hero-badge"><i class="fas fa-calendar-check"></i> <?= e(t('booking_hero_badge')) ?></span>
                <h1><?= e(t('booking_hero_title')) ?></h1>
                <p class="hero-sub"><?= e($displayTitle) ?></p>
            </div>
        </div>
    </section>

    <main>
        <section class="detail-section">
            <div class="container">
                <div class="contact-layout">
                    <div class="contact-form-card">

                        <div class="contact-success" id="bookingSuccess">
                            <i class="fas fa-circle-check"></i>
                            <h2 id="bookingSuccessTitle"><?= e(t('booking_success_title')) ?></h2>
                            <p id="bookingSuccessRef"></p>
                            <p><?= e(t('booking_success_desc')) ?></p>
                            <a href="https://wa.me/255697612865" class="btn btn-success" target="_blank" rel="noopener"><i class="fab fa-whatsapp"></i> WhatsApp</a>
                        </div>

                        <form id="bookingForm" method="post" action="<?= url('booking/submit.php') ?>">
                            <h2><?= e(t('booking_form_title')) ?></h2>
                            <p class="hero-sub" style="margin-bottom:1.5rem;"><?= e(t('booking_form_intro')) ?></p>

                            <div class="contact-form-error" id="bookingFormError"><?= e(t('booking_form_required')) ?></div>

                            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                            <input type="hidden" name="safari_id" value="<?= $safari ? (int) $safari['id'] : '' ?>" />
                            <input type="hidden" name="safari_title" value="<?= e($displayTitle) ?>" />
                            <input type="hidden" name="fallback_pp" value="<?= $fallbackPricePerPerson !== null ? e((string) $fallbackPricePerPerson) : '' ?>" />
                            <input type="hidden" name="fallback_currency" value="<?= e($fallbackCurrency) ?>" />
                            <input type="hidden" name="lang" value="<?= e($lang) ?>" />

                            <div class="contact-form-row">
                                <div class="contact-field">
                                    <label><?= e(t('booking_form_safari')) ?></label>
                                    <input type="text" value="<?= e($displayTitle) ?>" disabled />
                                </div>
                                <div class="contact-field">
                                    <label for="bf-date"><?= e(t('booking_form_date')) ?></label>
                                    <input type="date" id="bf-date" name="travel_date" min="<?= e(date('Y-m-d', strtotime('+2 days'))) ?>" value="<?= e($prefillDate) ?>" />
                                </div>
                            </div>

                            <div class="contact-form-row">
                                <div class="contact-field">
                                    <label for="bf-adults"><?= e(t('booking_form_adults')) ?> *</label>
                                    <input type="number" id="bf-adults" name="adults" min="1" max="20" value="<?= (int) $prefillAdults ?>" required />
                                </div>
                                <div class="contact-field">
                                    <label for="bf-children"><?= e(t('booking_form_children')) ?></label>
                                    <input type="number" id="bf-children" name="children" min="0" max="20" value="0" />
                                </div>
                            </div>

                            <div class="contact-form-row">
                                <div class="contact-field">
                                    <label for="bf-first-name"><?= e(t('booking_form_first_name')) ?> *</label>
                                    <input type="text" id="bf-first-name" name="first_name" required />
                                </div>
                                <div class="contact-field">
                                    <label for="bf-last-name"><?= e(t('booking_form_last_name')) ?> *</label>
                                    <input type="text" id="bf-last-name" name="last_name" required />
                                </div>
                            </div>

                            <div class="contact-form-row">
                                <div class="contact-field">
                                    <label for="bf-email"><?= e(t('booking_form_email')) ?> *</label>
                                    <input type="email" id="bf-email" name="email" required />
                                </div>
                                <div class="contact-field">
                                    <label for="bf-phone"><?= e(t('booking_form_phone')) ?></label>
                                    <input type="text" id="bf-phone" name="phone" />
                                </div>
                            </div>

                            <div class="contact-form-row">
                                <div class="contact-field">
                                    <label for="bf-country"><?= e(t('booking_form_country')) ?></label>
                                    <input type="text" id="bf-country" name="country" />
                                </div>
                            </div>

                            <div class="contact-field">
                                <label for="bf-message"><?= e(t('booking_form_message')) ?></label>
                                <textarea id="bf-message" name="special_requests" rows="4"></textarea>
                            </div>

                            <div id="bookingEstimate" class="admin-success-msg" style="display:none;margin-top:1rem;"></div>

                            <button type="submit" class="btn btn-primary btn-lg" style="width:100%;margin-top:1.5rem;">
                                <?= e(t('booking_form_submit')) ?>
                            </button>
                            <p style="text-align:center;color:#777;font-size:0.85rem;margin-top:0.75rem;"><?= e(t('booking_form_payment_note')) ?></p>
                        </form>
                    </div>

                    <div class="contact-info-list">
                        <h3><?= e(t('booking_info_title')) ?></h3>
                        <p><?= e(t('booking_info_desc')) ?></p>
                        <a href="https://wa.me/255697612865" target="_blank" rel="noopener" class="btn btn-success" style="width:100%;"><i class="fab fa-whatsapp"></i> <?= e(t('booking_info_whatsapp')) ?></a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <script>
    (function () {
        var tiers = <?= json_encode(array_map(static fn($t) => ['upTo' => (int) $t['up_to_travelers'], 'pp' => (float) $t['price_per_person']], $tiers)) ?>;
        var fallbackPp = <?= $fallbackPricePerPerson !== null ? json_encode($fallbackPricePerPerson) : 'null' ?>;
        var currency = <?= json_encode($tiers ? ($tiers[0]['currency'] ?? 'USD') : $fallbackCurrency) ?>;
        var form = document.getElementById('bookingForm');
        var adultsInput = document.getElementById('bf-adults');
        var childrenInput = document.getElementById('bf-children');
        var estimateBox = document.getElementById('bookingEstimate');

        function priceForPeople(people) {
            if (tiers.length) {
                var tier = tiers[tiers.length - 1];
                for (var i = 0; i < tiers.length; i++) {
                    if (people <= tiers[i].upTo) { tier = tiers[i]; break; }
                }
                return tier.pp;
            }
            return fallbackPp || 0;
        }

        function renderEstimate() {
            var adults = Math.max(1, parseInt(adultsInput.value, 10) || 1);
            var children = Math.max(0, parseInt(childrenInput.value, 10) || 0);
            var pp = priceForPeople(adults + children);
            var total = pp * (adults + children);
            if (pp > 0) {
                estimateBox.style.display = 'block';
                estimateBox.textContent = 'Estimated total: ' + currency + ' ' + total.toLocaleString() + ' (' + currency + ' ' + pp.toLocaleString() + ' per person)';
            }
        }

        if (adultsInput && childrenInput) {
            adultsInput.addEventListener('input', renderEstimate);
            childrenInput.addEventListener('input', renderEstimate);
            renderEstimate();
        }

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                document.getElementById('bookingFormError').classList.remove('visible');

                var required = form.querySelectorAll('[required]');
                var valid = true;
                required.forEach(function (el) { if (!el.value.trim()) valid = false; });

                if (!valid) {
                    document.getElementById('bookingFormError').classList.add('visible');
                    return;
                }

                var submitBtn = form.querySelector('button[type="submit"]');
                submitBtn.disabled = true;

                fetch(form.action, { method: 'POST', body: new FormData(form), headers: { 'X-Requested-With': 'XMLHttpRequest' } })
                    .then(function (res) { return res.json(); })
                    .then(function (data) {
                        if (data.ok) {
                            form.style.display = 'none';
                            var successBox = document.getElementById('bookingSuccess');
                            document.getElementById('bookingSuccessRef').textContent = 'Booking reference: ' + data.reference;
                            successBox.classList.add('visible');
                        } else {
                            submitBtn.disabled = false;
                            var errBox = document.getElementById('bookingFormError');
                            errBox.textContent = data.error || 'Something went wrong. Please try again or contact us on WhatsApp.';
                            errBox.classList.add('visible');
                        }
                    })
                    .catch(function () {
                        submitBtn.disabled = false;
                        var errBox = document.getElementById('bookingFormError');
                        errBox.textContent = 'Network error. Please try again or contact us on WhatsApp.';
                        errBox.classList.add('visible');
                    });
            });
        }
    })();
    </script>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
