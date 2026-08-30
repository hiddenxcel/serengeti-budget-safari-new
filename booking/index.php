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

                            <ol class="booking-steps" id="bookingSteps">
                                <li class="booking-step active" data-step="1"><span class="booking-step-num">1</span><span class="booking-step-label"><?= e(t('booking_step1_label')) ?></span></li>
                                <li class="booking-step" data-step="2"><span class="booking-step-num">2</span><span class="booking-step-label"><?= e(t('booking_step2_label')) ?></span></li>
                                <li class="booking-step" data-step="3"><span class="booking-step-num">3</span><span class="booking-step-label"><?= e(t('booking_step3_label')) ?></span></li>
                                <li class="booking-step" data-step="4"><span class="booking-step-num">4</span><span class="booking-step-label"><?= e(t('booking_step4_label')) ?></span></li>
                            </ol>

                            <div class="contact-form-error" id="bookingFormError"><?= e(t('booking_form_required')) ?></div>

                            <input type="hidden" name="csrf_token" value="<?= e(csrf_token()) ?>" />
                            <input type="hidden" name="safari_id" value="<?= $safari ? (int) $safari['id'] : '' ?>" />
                            <input type="hidden" name="safari_title" value="<?= e($displayTitle) ?>" />
                            <input type="hidden" name="fallback_pp" value="<?= $fallbackPricePerPerson !== null ? e((string) $fallbackPricePerPerson) : '' ?>" />
                            <input type="hidden" name="fallback_currency" value="<?= e($fallbackCurrency) ?>" />
                            <input type="hidden" name="lang" value="<?= e($lang) ?>" />

                            <!-- STEP 1: Your Trip -->
                            <div class="booking-panel active" data-panel="1">
                                <h2><?= e(t('booking_step1_title')) ?></h2>
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
                                <div id="bookingEstimate" class="admin-success-msg" style="display:none;margin-top:1rem;"></div>
                                <div class="booking-step-actions">
                                    <span></span>
                                    <button type="button" class="btn btn-primary booking-next" data-next="2"><?= e(t('booking_next')) ?></button>
                                </div>
                            </div>

                            <!-- STEP 2: Your Details -->
                            <div class="booking-panel" data-panel="2">
                                <h2><?= e(t('booking_step2_title')) ?></h2>
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
                                <div class="booking-step-actions">
                                    <button type="button" class="btn btn-light booking-back" data-back="1"><?= e(t('booking_back')) ?></button>
                                    <button type="button" class="btn btn-primary booking-next" data-next="3"><?= e(t('booking_next')) ?></button>
                                </div>
                            </div>

                            <!-- STEP 3: Preferences -->
                            <div class="booking-panel" data-panel="3">
                                <h2><?= e(t('booking_step3_title')) ?></h2>
                                <div class="contact-field">
                                    <label for="bf-message"><?= e(t('booking_form_message')) ?></label>
                                    <textarea id="bf-message" name="special_requests" rows="4" placeholder="<?= e(t('booking_form_message_placeholder')) ?>"></textarea>
                                </div>
                                <div class="booking-step-actions">
                                    <button type="button" class="btn btn-light booking-back" data-back="2"><?= e(t('booking_back')) ?></button>
                                    <button type="button" class="btn btn-primary booking-next" data-next="4"><?= e(t('booking_next')) ?></button>
                                </div>
                            </div>

                            <!-- STEP 4: Review -->
                            <div class="booking-panel" data-panel="4">
                                <h2><?= e(t('booking_step4_title')) ?></h2>
                                <div class="booking-review-card" id="bookingReview"></div>
                                <div id="bookingEstimateReview" class="booking-review-total"></div>
                                <p style="text-align:center;color:#777;font-size:0.85rem;"><?= e(t('booking_form_payment_note')) ?></p>
                                <div class="booking-step-actions">
                                    <button type="button" class="btn btn-light booking-back" data-back="3"><?= e(t('booking_back')) ?></button>
                                    <button type="submit" class="btn btn-primary btn-lg"><?= e(t('booking_form_submit')) ?></button>
                                </div>
                            </div>
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
        var safariName = <?= json_encode($displayTitle) ?>;
        var form = document.getElementById('bookingForm');
        var adultsInput = document.getElementById('bf-adults');
        var childrenInput = document.getElementById('bf-children');
        var dateInput = document.getElementById('bf-date');
        var estimateBox = document.getElementById('bookingEstimate');
        var reviewBox = document.getElementById('bookingReview');
        var reviewTotalBox = document.getElementById('bookingEstimateReview');
        var errorBox = document.getElementById('bookingFormError');

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

        function currentEstimate() {
            var adults = Math.max(1, parseInt(adultsInput.value, 10) || 1);
            var children = Math.max(0, parseInt(childrenInput.value, 10) || 0);
            var pp = priceForPeople(adults + children);
            var total = pp * (adults + children);
            return { adults: adults, children: children, pp: pp, total: total };
        }

        function renderEstimate() {
            var est = currentEstimate();
            if (est.pp > 0) {
                estimateBox.style.display = 'block';
                estimateBox.textContent = 'Estimated total: ' + currency + ' ' + est.total.toLocaleString() + ' (' + currency + ' ' + est.pp.toLocaleString() + ' per person)';
            }
        }

        if (adultsInput && childrenInput) {
            adultsInput.addEventListener('input', renderEstimate);
            childrenInput.addEventListener('input', renderEstimate);
            renderEstimate();
        }

        // ===== STEP NAVIGATION =====
        var steps = document.querySelectorAll('.booking-step');
        var panels = document.querySelectorAll('.booking-panel');

        function goToStep(n) {
            panels.forEach(function (p) { p.classList.toggle('active', p.getAttribute('data-panel') === String(n)); });
            steps.forEach(function (s) {
                var stepNum = parseInt(s.getAttribute('data-step'), 10);
                s.classList.toggle('active', stepNum === n);
                s.classList.toggle('done', stepNum < n);
            });
            if (n === 4) renderReview();
            var card = document.querySelector('.contact-form-card');
            if (card) card.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }

        function validatePanel(panelEl) {
            var required = panelEl.querySelectorAll('[required]');
            var valid = true;
            required.forEach(function (el) { if (!el.value.trim()) valid = false; });
            return valid;
        }

        document.querySelectorAll('.booking-next').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var panel = btn.closest('.booking-panel');
                errorBox.classList.remove('visible');
                if (!validatePanel(panel)) {
                    errorBox.classList.add('visible');
                    return;
                }
                goToStep(parseInt(btn.getAttribute('data-next'), 10));
            });
        });

        document.querySelectorAll('.booking-back').forEach(function (btn) {
            btn.addEventListener('click', function () {
                goToStep(parseInt(btn.getAttribute('data-back'), 10));
            });
        });

        function renderReview() {
            var est = currentEstimate();
            var date = dateInput && dateInput.value ? dateInput.value : '—';
            var firstName = document.getElementById('bf-first-name').value;
            var lastName = document.getElementById('bf-last-name').value;
            var email = document.getElementById('bf-email').value;

            reviewBox.innerHTML =
                '<div class="booking-review-row"><span>Safari</span><strong>' + safariName + '</strong></div>' +
                '<div class="booking-review-row"><span>Date</span><strong>' + date + '</strong></div>' +
                '<div class="booking-review-row"><span>Travelers</span><strong>' + est.adults + ' adult(s)' + (est.children ? ', ' + est.children + ' child(ren)' : '') + '</strong></div>' +
                '<div class="booking-review-row"><span>Name</span><strong>' + firstName + ' ' + lastName + '</strong></div>' +
                '<div class="booking-review-row"><span>Email</span><strong>' + email + '</strong></div>';

            if (est.pp > 0) {
                reviewTotalBox.innerHTML =
                    '<div class="booking-review-total-row"><span>Estimated Total</span><strong>' + currency + ' ' + est.total.toLocaleString() + '</strong></div>' +
                    '<p class="booking-review-note">' + currency + ' ' + est.pp.toLocaleString() + ' per person &mdash; to be confirmed with you before payment.</p>';
            } else {
                reviewTotalBox.innerHTML = '<p class="booking-review-note">Our team will confirm pricing with you directly.</p>';
            }
        }

        if (form) {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                errorBox.classList.remove('visible');

                var required = form.querySelectorAll('[required]');
                var valid = true;
                required.forEach(function (el) { if (!el.value.trim()) valid = false; });

                if (!valid) {
                    errorBox.classList.add('visible');
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
                            errorBox.textContent = data.error || 'Something went wrong. Please try again or contact us on WhatsApp.';
                            errorBox.classList.add('visible');
                        }
                    })
                    .catch(function () {
                        submitBtn.disabled = false;
                        errorBox.textContent = 'Network error. Please try again or contact us on WhatsApp.';
                        errorBox.classList.add('visible');
                    });
            });
        }
    })();
    </script>

<?php require dirname(__DIR__) . '/includes/footer.php'; ?>
