(function () {
    'use strict';

    var overlay = document.getElementById('promoOverlay');
    if (!overlay) return;

    var STORAGE_KEY = 'promoExtrasShown';
    var closeBtn = overlay.querySelector('[data-promo-close]');
    var primaryBtn = overlay.querySelector('[data-promo-primary]');
    var shown = false;
    var enabled = true;

    try {
        if (sessionStorage.getItem(STORAGE_KEY) === '1') {
            enabled = false;
        }
    } catch (e) {
        /* storage unavailable, fall back to in-memory guard only */
    }

    function markShown() {
        shown = true;
        enabled = false;
        try {
            sessionStorage.setItem(STORAGE_KEY, '1');
        } catch (e) {
            /* ignore */
        }
    }

    function openPromo() {
        if (shown) return;
        markShown();
        overlay.hidden = false;
        requestAnimationFrame(function () {
            overlay.classList.add('is-visible');
        });
        document.body.style.overflow = 'hidden';
    }

    function closePromo() {
        overlay.classList.remove('is-visible');
        document.body.style.overflow = '';
        window.setTimeout(function () {
            overlay.hidden = true;
        }, 450);
    }

    if (closeBtn) closeBtn.addEventListener('click', closePromo);
    if (primaryBtn) primaryBtn.addEventListener('click', closePromo);

    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) closePromo();
    });

    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape' && !overlay.hidden) closePromo();
    });

    /* Manual preview trigger: append ?promo=1 to force it open immediately,
       useful for design QA. */
    var forcedOpen = false;
    try {
        if (new URLSearchParams(window.location.search).get('promo') === '1') {
            forcedOpen = true;
            shown = false;
            enabled = true;
            openPromo();
        }
    } catch (e) {
        /* ignore */
    }

    if (forcedOpen || !enabled) return;

    /* Shows automatically shortly after the page loads, once per session. */
    window.setTimeout(function () {
        openPromo();
    }, 2500);
})();
