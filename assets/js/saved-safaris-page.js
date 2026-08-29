(function () {
    'use strict';

    var grid = document.getElementById('savedSafarisGrid');
    var empty = document.getElementById('savedSafarisEmpty');
    if (!grid || !empty) return;

    function getSaved() {
        try {
            var raw = localStorage.getItem('savedSafaris');
            return raw ? JSON.parse(raw) : [];
        } catch (e) {
            return [];
        }
    }

    function setSaved(list) {
        try {
            localStorage.setItem('savedSafaris', JSON.stringify(list));
        } catch (e) { /* ignore */ }
    }

    function render() {
        var list = getSaved();

        if (!list.length) {
            grid.style.display = 'none';
            empty.style.display = 'block';
            return;
        }

        grid.style.display = 'grid';
        empty.style.display = 'none';
        grid.innerHTML = '';

        list.forEach(function (item) {
            var card = document.createElement('div');
            card.className = 'saved-safari-card';
            card.innerHTML =
                '<div class="saved-safari-img"><img src="' + item.image + '" alt="' + item.title + '" loading="lazy"></div>' +
                '<div class="saved-safari-body">' +
                    '<h3>' + item.title + '</h3>' +
                    '<div class="saved-safari-price">' + item.price + '</div>' +
                    '<div class="saved-safari-actions">' +
                        '<a href="' + item.url + '" class="btn btn-primary">' + (window.SAVED_STRINGS && window.SAVED_STRINGS.view || 'View') + '</a>' +
                        '<button type="button" class="btn btn-outline saved-remove-btn" data-id="' + item.id + '">' + (window.SAVED_STRINGS && window.SAVED_STRINGS.remove || 'Remove') + '</button>' +
                    '</div>' +
                '</div>';
            grid.appendChild(card);
        });

        grid.querySelectorAll('.saved-remove-btn').forEach(function (btn) {
            btn.addEventListener('click', function () {
                var id = btn.getAttribute('data-id');
                var list = getSaved().filter(function (s) { return s.id !== id; });
                setSaved(list);
                render();
                var pill = document.getElementById('savedSafarisPill');
                if (pill) {
                    var countEl = pill.querySelector('.saved-safaris-count');
                    if (countEl) countEl.textContent = list.length;
                    pill.classList.toggle('visible', list.length > 0);
                }
            });
        });
    }

    render();
})();
