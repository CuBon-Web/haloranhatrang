(function () {
    'use strict';

    var SKIP_IMG_PARENT = '.main-slider, .main-header, .preloader';
    var EAGER_IMG_SELECTOR = '.main-header .logo img';

    function initLazyImages() {
        document.querySelectorAll('img:not([loading])').forEach(function (img) {
            if (img.closest(SKIP_IMG_PARENT)) {
                return;
            }
            img.loading = 'lazy';
            img.decoding = 'async';
        });

        document.querySelectorAll(EAGER_IMG_SELECTOR).forEach(function (img) {
            img.loading = 'eager';
            img.setAttribute('fetchpriority', 'high');
        });
    }

    function applyLazyBackground(el) {
        var url = el.getAttribute('data-bg-lazy');
        if (!url) {
            return;
        }
        el.style.backgroundImage = 'url(' + JSON.stringify(url) + ')';
        el.removeAttribute('data-bg-lazy');
        el.classList.add('bg-lazy-loaded');
    }

    function initLazyBackgrounds() {
        var elements = document.querySelectorAll('[data-bg-lazy]');
        if (!elements.length) {
            return;
        }

        if (!('IntersectionObserver' in window)) {
            elements.forEach(applyLazyBackground);
            return;
        }

        var observer = new IntersectionObserver(function (entries, obs) {
            entries.forEach(function (entry) {
                if (!entry.isIntersecting) {
                    return;
                }
                applyLazyBackground(entry.target);
                obs.unobserve(entry.target);
            });
        }, { rootMargin: '150px 0px' });

        elements.forEach(function (el) {
            observer.observe(el);
        });
    }

    function init() {
        initLazyImages();
        initLazyBackgrounds();
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
