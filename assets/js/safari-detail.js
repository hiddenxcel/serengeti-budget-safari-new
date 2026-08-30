(function () {
    'use strict';

    // ===== ITINERARY ACCORDION =====
    document.querySelectorAll('.itinerary-day-toggle').forEach(function (toggle) {
        toggle.addEventListener('click', function () {
            var day = toggle.closest('.itinerary-day');
            day.classList.toggle('open');
        });
    });

    var firstDay = document.querySelector('.itinerary-day');
    if (firstDay) firstDay.classList.add('open');

    // ===== GALLERY LIGHTBOX-LITE (just opens the image in a new tab for now) =====
    // Kept intentionally simple — no lightbox library dependency.

    // ===== BOOKING CARD (sticky, desktop) + MOBILE BAR =====
    document.querySelectorAll('.booking-card, .mobile-booking-bar').forEach(function (card) {
        var tiersAttr = card.getAttribute('data-tiers');
        if (!tiersAttr) return;

        var tiers = JSON.parse(tiersAttr);
        var currency = card.getAttribute('data-currency') || '€';
        var waTemplate = card.getAttribute('data-wa-template') || '';

        var input = card.querySelector('.booking-people-input');
        var minusBtn = card.querySelector('.booking-people-minus');
        var plusBtn = card.querySelector('.booking-people-plus');
        var dateInput = card.querySelector('.booking-date-input');
        var accommodationSelect = card.querySelector('.booking-accommodation-select');
        var priceOut = card.querySelector('.booking-price-per-person');
        var totalOut = card.querySelector('.booking-total-price');
        var waLink = card.querySelector('.booking-whatsapp-link');
        var bookLink = card.querySelector('.booking-card-book-link');

        if (!input) return;

        function priceFor(people) {
            var tier = tiers[tiers.length - 1];
            for (var i = 0; i < tiers.length; i++) {
                if (people <= tiers[i].upTo) {
                    tier = tiers[i];
                    break;
                }
            }
            return tier.pp;
        }

        function render() {
            var people = Math.max(1, Math.min(20, parseInt(input.value, 10) || 1));
            input.value = people;
            var pp = priceFor(people);
            var total = pp * people;

            if (priceOut) priceOut.textContent = currency + pp.toLocaleString();
            if (totalOut) totalOut.textContent = currency + total.toLocaleString();

            if (waLink) {
                var date = dateInput && dateInput.value ? dateInput.value : '—';
                var accommodation = accommodationSelect ? accommodationSelect.options[accommodationSelect.selectedIndex].text : '';
                var text = waTemplate
                    .replace('{people}', String(people))
                    .replace('{pp}', currency + pp.toLocaleString())
                    .replace('{total}', currency + total.toLocaleString())
                    .replace('{date}', date)
                    .replace('{accommodation}', accommodation);
                waLink.href = 'https://wa.me/255697612865?text=' + encodeURIComponent(text);
            }

            if (bookLink) {
                try {
                    var url = new URL(bookLink.href, window.location.origin);
                    url.searchParams.set('adults', String(people));
                    if (dateInput && dateInput.value) {
                        url.searchParams.set('date', dateInput.value);
                    }
                    bookLink.href = url.pathname + url.search;
                } catch (err) {
                    // Older browsers without URL() support simply keep the static link.
                }
            }
        }

        if (minusBtn) minusBtn.addEventListener('click', function () {
            input.value = Math.max(1, (parseInt(input.value, 10) || 1) - 1);
            render();
        });
        if (plusBtn) plusBtn.addEventListener('click', function () {
            input.value = Math.min(20, (parseInt(input.value, 10) || 1) + 1);
            render();
        });
        input.addEventListener('input', render);
        input.addEventListener('change', render);
        if (dateInput) dateInput.addEventListener('change', render);
        if (accommodationSelect) accommodationSelect.addEventListener('change', render);

        render();
    });
})();
