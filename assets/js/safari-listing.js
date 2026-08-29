(function () {
    'use strict';

    var grid = document.getElementById('safariGrid');
    if (!grid) return;

    var cards = Array.prototype.slice.call(grid.querySelectorAll('.package-card-home'));
    var count = document.getElementById('listingCount');
    var resultsSub = document.getElementById('listingResultsSub');
    var empty = document.getElementById('listingEmpty');

    var quickFilters = document.getElementById('quickFilters');
    var quickChips = quickFilters ? Array.prototype.slice.call(quickFilters.querySelectorAll('.quick-filter-chip')) : [];
    var activeQuickType = '';

    var selects = {
        experience: document.getElementById('filterExperience'),
        accommodation: document.getElementById('filterAccommodation'),
        location: document.getElementById('filterLocation'),
        duration: document.getElementById('filterDuration')
    };

    var sortBtn = document.getElementById('sortToggle');
    var sortAsc = true;

    var moreToggle = document.getElementById('moreFiltersToggle');
    var morePanel = document.getElementById('moreFiltersPanel');

    if (moreToggle && morePanel) {
        moreToggle.addEventListener('click', function () {
            var isOpen = morePanel.classList.toggle('open');
            moreToggle.classList.toggle('open', isOpen);
        });
    }

    quickChips.forEach(function (chip) {
        chip.addEventListener('click', function () {
            quickChips.forEach(function (c) { c.classList.remove('active'); });
            chip.classList.add('active');
            activeQuickType = chip.getAttribute('data-quick-type') || '';
            applyFilters();
        });
    });

    function matchesDuration(days, range) {
        if (!range) return true;
        var parts = range.split('-').map(Number);
        return days >= parts[0] && days <= parts[1];
    }

    function applyFilters() {
        var expVal = selects.experience ? selects.experience.value : '';
        var accVal = selects.accommodation ? selects.accommodation.value : '';
        var locVal = selects.location ? selects.location.value : '';
        var durVal = selects.duration ? selects.duration.value : '';
        var visible = 0;

        cards.forEach(function (card) {
            var days = Number(card.getAttribute('data-days'));
            var matches =
                (!activeQuickType || card.getAttribute('data-type') === activeQuickType) &&
                (!expVal || card.getAttribute('data-experience').indexOf(expVal) !== -1) &&
                (!accVal || card.getAttribute('data-accommodation') === accVal) &&
                (!locVal || card.getAttribute('data-location') === locVal) &&
                matchesDuration(days, durVal);

            card.classList.toggle('pkg-card-hidden', !matches);
            if (matches) visible++;
        });

        if (count) count.textContent = String(visible);
        if (resultsSub) resultsSub.textContent = visible + ' ' + (resultsSub.dataset.suffix || '');
        if (empty) empty.classList.toggle('active', visible === 0);
    }

    Object.keys(selects).forEach(function (key) {
        if (selects[key]) selects[key].addEventListener('change', applyFilters);
    });

    if (sortBtn) {
        sortBtn.addEventListener('click', function () {
            sortAsc = !sortAsc;
            var sorted = cards.slice().sort(function (a, b) {
                var pa = Number(a.getAttribute('data-price'));
                var pb = Number(b.getAttribute('data-price'));
                return sortAsc ? pa - pb : pb - pa;
            });
            sorted.forEach(function (card) { grid.appendChild(card); });
        });
    }

    applyFilters();
})();
