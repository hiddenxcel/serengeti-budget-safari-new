    </main>
</div>
<script>
(function () {
    var toggle = document.getElementById('adminMenuToggle');
    var sidebar = document.getElementById('adminSidebar');
    var overlay = document.getElementById('adminSidebarOverlay');
    if (!toggle || !sidebar || !overlay) return;

    function closeMenu() {
        sidebar.classList.remove('open');
        overlay.classList.remove('open');
        toggle.setAttribute('aria-expanded', 'false');
    }

    toggle.addEventListener('click', function () {
        var isOpen = sidebar.classList.toggle('open');
        overlay.classList.toggle('open', isOpen);
        toggle.setAttribute('aria-expanded', isOpen ? 'true' : 'false');
    });

    overlay.addEventListener('click', closeMenu);
})();
</script>
</body>
</html>
