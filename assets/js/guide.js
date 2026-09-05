/* ============================================================
   Complete Guide pages (Budget / Luxury / Migration / Day Trips)
   FAQ accordion is already handled globally by main.js (.faq-item-acc).
   ============================================================ */
(function () {
    'use strict';

    var page = document.querySelector('.guide-page');
    if (!page) return;

    // ===== TOC: collapsed by default on mobile, open on desktop =====
    var tocDetails = document.querySelector('.guide-toc');
    if (tocDetails && window.matchMedia('(max-width: 1024px)').matches) {
        tocDetails.removeAttribute('open');
    }

    // ===== PROGRESS BAR =====
    var progressBar = document.getElementById('guide-progress-bar');
    if (progressBar) {
        window.addEventListener('scroll', function () {
            var scrollTop = window.scrollY;
            var docHeight = document.documentElement.scrollHeight - window.innerHeight;
            var progress = docHeight > 0 ? (scrollTop / docHeight) * 100 : 0;
            progressBar.style.width = progress + '%';
        });
    }

    // ===== BACK TO TOP =====
    var backTop = document.getElementById('guide-back-top');
    if (backTop) {
        window.addEventListener('scroll', function () {
            backTop.style.display = window.scrollY > 400 ? 'flex' : 'none';
        });
        backTop.addEventListener('click', function () {
            window.scrollTo({ top: 0, behavior: 'smooth' });
        });
    }

    // ===== FLOATING CTA =====
    var floatingCta = document.getElementById('guide-floating-cta');
    if (floatingCta) {
        window.addEventListener('scroll', function () {
            if (window.scrollY > 300) {
                floatingCta.classList.add('show');
            } else {
                floatingCta.classList.remove('show');
            }
        });
        floatingCta.addEventListener('click', function () {
            var target = document.getElementById('book');
            if (target) target.scrollIntoView({ behavior: 'smooth' });
        });
    }

    // ===== TOC SCROLL-SPY =====
    var tocLinks = document.querySelectorAll('.guide-toc a[href^="#"]');
    var sections = [];
    tocLinks.forEach(function (link) {
        var id = link.getAttribute('href').slice(1);
        var section = document.getElementById(id);
        if (section) sections.push({ link: link, el: section });
    });

    if (sections.length) {
        window.addEventListener('scroll', function () {
            var scrollPos = window.scrollY + 120;
            var current = sections[0];
            sections.forEach(function (s) {
                if (s.el.offsetTop <= scrollPos) current = s;
            });
            tocLinks.forEach(function (l) { l.classList.remove('active'); });
            current.link.classList.add('active');
        });
    }

    // ===== SMOOTH SCROLL FOR IN-PAGE ANCHORS =====
    document.querySelectorAll('a[href^="#"]').forEach(function (anchor) {
        anchor.addEventListener('click', function (e) {
            var href = this.getAttribute('href');
            if (href === '#') return;
            var target = document.querySelector(href);
            if (target) {
                e.preventDefault();
                var offsetTop = target.getBoundingClientRect().top + window.scrollY - 90;
                window.scrollTo({ top: offsetTop, behavior: 'smooth' });
            }
        });
    });

    // ===== TOAST =====
    function showToast(message) {
        var toast = document.getElementById('guide-toast');
        if (!toast) return;
        toast.textContent = message;
        toast.classList.add('show');
        setTimeout(function () { toast.classList.remove('show'); }, 3500);
    }

    // ===== BOOKING MODAL =====
    var modal = document.getElementById('guideBookingModal');
    if (modal) {
        var closeModal = document.getElementById('guideCloseModal');
        var modalPackageName = document.getElementById('guideModalPackageName');
        var modalPackagePrice = document.getElementById('guideModalPackagePrice');
        var modalTitle = document.getElementById('guideModalTitle');
        var modalForm = document.getElementById('guideBookingFormModal');
        var modalSuccess = document.getElementById('guideModalSuccess');

        document.querySelectorAll('.guide-package-card .btn[data-package]').forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                var pkg = this.getAttribute('data-package');
                var price = this.getAttribute('data-price');
                if (modalPackageName) modalPackageName.textContent = pkg;
                if (modalPackagePrice) modalPackagePrice.textContent = price + ' per person';
                if (modalTitle) modalTitle.textContent = 'Book ' + pkg;
                modal.classList.add('active');
                document.body.style.overflow = 'hidden';
            });
        });

        function closeGuideModal() {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }

        if (closeModal) closeModal.addEventListener('click', closeGuideModal);
        modal.addEventListener('click', function (e) {
            if (e.target === modal) closeGuideModal();
        });
        document.addEventListener('keydown', function (e) {
            if (e.key === 'Escape' && modal.classList.contains('active')) closeGuideModal();
        });

        if (modalForm) {
            modalForm.addEventListener('submit', function (e) {
                e.preventDefault();
                modalForm.style.display = 'none';
                if (modalSuccess) modalSuccess.style.display = 'block';
                showToast('Enquiry sent! We will reply within 24 hours.');
                setTimeout(function () {
                    closeGuideModal();
                    setTimeout(function () {
                        modalForm.style.display = 'block';
                        if (modalSuccess) modalSuccess.style.display = 'none';
                        modalForm.reset();
                    }, 400);
                }, 2200);
            });
        }

        var dateInput = document.getElementById('guideModalDate');
        if (dateInput) {
            var tomorrow = new Date();
            tomorrow.setDate(tomorrow.getDate() + 1);
            dateInput.value = tomorrow.toISOString().split('T')[0];
        }
    }

    // ===== PRINT BUTTON =====
    document.querySelectorAll('.guide-print-btn').forEach(function (btn) {
        btn.addEventListener('click', function () { window.print(); });
    });
})();
