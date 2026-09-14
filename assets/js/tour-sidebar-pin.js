(function () {
    'use strict';

    var sidebar = document.querySelector('.tour-sidebar');
    var layout = document.querySelector('.tour-detail-layout');
    if (!sidebar || !layout) return;

    var HEADER_GAP = 100;
    var pinnedWidth = 0;
    var pinnedLeft = 0;

    function isDesktop() {
        return window.matchMedia('(min-width: 961px)').matches;
    }

    function update() {
        if (!isDesktop()) {
            sidebar.classList.remove('is-pinned', 'is-bottomed');
            sidebar.style.width = '';
            sidebar.style.left = '';
            return;
        }

        var wasPinned = sidebar.classList.contains('is-pinned');
        var wasBottomed = sidebar.classList.contains('is-bottomed');

        if (!wasPinned && !wasBottomed) {
            var rect = sidebar.getBoundingClientRect();
            pinnedWidth = sidebar.offsetWidth;
            pinnedLeft = rect.left;
        }
        sidebar.style.setProperty('--tour-sidebar-width', pinnedWidth + 'px');
        sidebar.style.left = pinnedLeft + 'px';

        var layoutRect = layout.getBoundingClientRect();
        var layoutTop = layoutRect.top + window.scrollY;
        var layoutBottom = layoutTop + layout.offsetHeight;

        var sidebarHeight = sidebar.offsetHeight;
        var scrollTop = window.scrollY;

        if (scrollTop + HEADER_GAP < layoutTop) {
            sidebar.classList.remove('is-pinned', 'is-bottomed');
            sidebar.style.left = '';
        } else if (scrollTop + HEADER_GAP + sidebarHeight >= layoutBottom) {
            sidebar.classList.remove('is-pinned');
            sidebar.classList.add('is-bottomed');
            sidebar.style.left = '';
        } else {
            sidebar.classList.remove('is-bottomed');
            sidebar.classList.add('is-pinned');
            sidebar.style.left = pinnedLeft + 'px';
        }
    }

    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', function () {
        sidebar.classList.remove('is-pinned', 'is-bottomed');
        update();
    });
    update();
})();
