/**
 * VI / EN / RU — HTML gốc từ server là tiếng Việt.
 * VI = không dùng widget. EN / RU = Google Translate (vi → en / ru).
 */
(function (global) {
    'use strict';

    var PAGE_LANG = 'vi';
    var DEFAULT_LANG = 'vi';
    var SUPPORTED_LANGS = ['vi', 'en', 'ru'];
    var STORAGE_KEY = 'gt_site_lang';
    var COOKIE_NAME = 'googtrans';

    function readCookie() {
        var match = document.cookie.match(/(?:^|;\s*)googtrans=([^;]*)/);
        return match ? decodeURIComponent(match[1]) : '';
    }

    function purgeGoogTransCookies() {
        var expired = COOKIE_NAME + '=;path=/;expires=Thu, 01 Jan 1970 00:00:00 GMT';
        var host = global.location.hostname;
        var domains = [null];

        if (host && host.indexOf('.') !== -1 && host !== 'localhost') {
            var root = host.replace(/^www\./, '');
            domains.push('.' + root, root);
            if (host.indexOf('www.') === 0) {
                domains.push(host);
            }
        }

        domains.forEach(function (domain) {
            document.cookie = domain ? expired + ';domain=' + domain : expired;
        });
    }

    function setTranslateCookie(targetLang) {
        var secure = global.location.protocol === 'https:' ? ';Secure' : '';
        purgeGoogTransCookies();

        if (targetLang === PAGE_LANG) {
            return;
        }

        document.cookie =
            COOKIE_NAME +
            '=' +
            encodeURIComponent('/' + PAGE_LANG + '/' + targetLang) +
            ';path=/;max-age=31536000;SameSite=Lax' +
            secure;
    }

    function parseLangFromCookie(cookie) {
        if (!cookie) {
            return DEFAULT_LANG;
        }

        var parts = cookie.split('/').filter(Boolean);
        if (parts.length >= 2) {
            var target = parts[parts.length - 1].toLowerCase();
            if (SUPPORTED_LANGS.indexOf(target) !== -1) {
                return target;
            }
        }

        return DEFAULT_LANG;
    }

    function stripTranslateArtifacts() {
        var html = document.documentElement;
        if (html) {
            html.classList.remove('translated-ltr', 'translated-rtl');
            html.setAttribute('lang', PAGE_LANG);
        }

        document.querySelectorAll('font[style*="vertical-align"]').forEach(function (node) {
            var parent = node.parentNode;
            if (!parent) {
                return;
            }
            while (node.firstChild) {
                parent.insertBefore(node.firstChild, node);
            }
            parent.removeChild(node);
        });
    }

    function getSavedLang() {
        try {
            if (!global.localStorage.getItem('gt_site_lang_v2')) {
                var legacy = global.localStorage.getItem(STORAGE_KEY);
                if (legacy === 'en') {
                    global.localStorage.setItem(STORAGE_KEY, 'vi');
                }
                global.localStorage.setItem('gt_site_lang_v2', '1');
            }

            var stored = global.localStorage.getItem(STORAGE_KEY);
            if (stored && SUPPORTED_LANGS.indexOf(stored) !== -1) {
                return stored;
            }
        } catch (e) {}

        return parseLangFromCookie(readCookie());
    }

    function shouldUseTranslate() {
        return getSavedLang() !== PAGE_LANG;
    }

    function updateSelects() {
        var active = getSavedLang();
        document.querySelectorAll('[data-gt-select]').forEach(function (select) {
            if (select.value !== active) {
                select.value = active;
            }
        });
    }

    function switchLanguage(lang) {
        if (SUPPORTED_LANGS.indexOf(lang) === -1) {
            return;
        }
        if (lang === getSavedLang()) {
            return;
        }

        document.querySelectorAll('.gt-lang').forEach(function (el) {
            el.classList.add('is-loading');
        });

        try {
            global.localStorage.setItem(STORAGE_KEY, lang);
        } catch (e) {}

        if (lang === PAGE_LANG) {
            purgeGoogTransCookies();
        } else {
            setTranslateCookie(lang);
        }

        global.location.reload();
    }

    function applyTranslateCombo(targetLang) {
        var combo = document.querySelector('select.goog-te-combo');
        if (!combo || !targetLang || targetLang === PAGE_LANG) {
            return;
        }

        if (combo.value !== targetLang) {
            combo.value = targetLang;
            combo.dispatchEvent(new Event('change'));
        }
    }

    function loadGoogleTranslate() {
        var targetLang = getSavedLang();

        if (!shouldUseTranslate()) {
            purgeGoogTransCookies();
            stripTranslateArtifacts();
            updateSelects();
            return;
        }

        if (document.getElementById('google-translate-script')) {
            return;
        }

        setTranslateCookie(targetLang);

        global.googleTranslateElementInit = function () {
            if (!global.google || !global.google.translate) {
                updateSelects();
                return;
            }

            new global.google.translate.TranslateElement(
                {
                    pageLanguage: PAGE_LANG,
                    includedLanguages: SUPPORTED_LANGS.join(','),
                    autoDisplay: false,
                },
                'google_translate_element'
            );

            updateSelects();

            global.setTimeout(function () {
                applyTranslateCombo(targetLang);
            }, 300);

            global.setTimeout(function () {
                applyTranslateCombo(targetLang);
            }, 1000);
        };

        var script = document.createElement('script');
        script.id = 'google-translate-script';
        script.src = 'https://translate.google.com/translate_a/element.js?cb=googleTranslateElementInit';
        script.async = true;
        document.body.appendChild(script);
    }

    function bindSwitchers() {
        document.querySelectorAll('[data-gt-select]').forEach(function (select) {
            if (select.getAttribute('data-gt-inited') === '1') {
                return;
            }

            select.addEventListener('change', function () {
                var lang = select.value;
                if (lang !== getSavedLang()) {
                    switchLanguage(lang);
                }
            });

            select.setAttribute('data-gt-inited', '1');
        });

        updateSelects();
    }

    function init() {
        bindSwitchers();
        loadGoogleTranslate();
    }

    global.GTLang = {
        init: init,
        getSavedLang: getSavedLang,
        switchLanguage: switchLanguage,
    };

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})(window);
