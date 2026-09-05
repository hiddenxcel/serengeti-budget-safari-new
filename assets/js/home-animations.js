/* ============================================================
   HOMEPAGE ONLY — GSAP + ScrollTrigger
   Fade & slide reveal, staggered card entrances, and a subtle hero
   parallax. Purely additive: everything here starts from CSS-visible
   markup and only hides/animates once GSAP has confirmed it loaded,
   so a slow/broken CDN load never leaves a blank section behind.
   ============================================================ */
(function () {
    'use strict';

    if (typeof gsap === 'undefined' || typeof ScrollTrigger === 'undefined') {
        return;
    }
    if (window.matchMedia('(prefers-reduced-motion: reduce)').matches) {
        return;
    }

    gsap.registerPlugin(ScrollTrigger);

    // ===== FADE + SLIDE REVEAL: section heads =====
    // Every "badge/tagline + H2 + intro paragraph" block on the page,
    // whatever its wrapper class, eases up and in the first time it
    // crosses ~85% of the viewport height.
    var headSelectors = [
        '.section-title-left',
        '.best-packages-intro',
        '.trust-authority-intro',
        '.final-cta-content',
        '.about-us-content > *'
    ];
    gsap.utils.toArray(headSelectors.join(',')).forEach(function (head) {
        gsap.from(head, {
            opacity: 0,
            y: 36,
            duration: 0.8,
            ease: 'power2.out',
            clearProps: 'transform',
            scrollTrigger: {
                trigger: head,
                start: 'top 85%',
                toggleActions: 'play none none none'
            }
        });
    });

    // ===== STAGGERED REVEAL: card grids =====
    // Each grid's own children fade/slide in one after another instead
    // of all at once, timed off the grid's own scroll position.
    var staggerGrids = [
        '.stories-grid',
        '.top-destinations-grid, .destinations-grid',
        '.best-packages-track .package-card',
        '.testimonials-grid',
        '.journey-steps-grid',
        '.trust-authority-panel > *'
    ];
    staggerGrids.forEach(function (selector) {
        var grid = document.querySelector(selector.split(',')[0].trim());
        var items = gsap.utils.toArray(selector);
        if (!items.length) return;

        gsap.from(items, {
            opacity: 0,
            y: 40,
            duration: 0.7,
            ease: 'power2.out',
            stagger: 0.12,
            clearProps: 'transform',
            scrollTrigger: {
                trigger: grid || items[0],
                start: 'top 80%',
                toggleActions: 'play none none none'
            }
        });
    });

    // ===== HERO PARALLAX =====
    // The background photo drifts slower than the page scroll while the
    // hero copy fades out a little faster, giving a sense of depth as
    // the visitor leaves the hero. Scoped to the hero's own height so it
    // never affects layout below it.
    var heroBg = document.querySelector('.hero-video');
    var heroContent = document.querySelector('.hero-content');
    var heroSection = document.querySelector('.hero');

    if (heroBg && heroSection) {
        gsap.set(heroBg, { scale: 1.15 });
        gsap.to(heroBg, {
            yPercent: 18,
            ease: 'none',
            scrollTrigger: {
                trigger: heroSection,
                start: 'top top',
                end: 'bottom top',
                scrub: true
            }
        });
    }

    if (heroContent && heroSection) {
        gsap.to(heroContent, {
            yPercent: -12,
            opacity: 0.2,
            ease: 'none',
            scrollTrigger: {
                trigger: heroSection,
                start: 'top top',
                end: 'bottom top',
                scrub: true
            }
        });
    }
})();
