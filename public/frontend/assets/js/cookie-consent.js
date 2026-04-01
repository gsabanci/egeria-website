document.addEventListener('DOMContentLoaded', function () {
    const COOKIE_NAME = 'egeria_cookie_preferences';
    const COOKIE_DAYS = 180;

    const banner = document.getElementById('cookieBanner');
    const functionalToggle = document.getElementById('cookieFunctionalToggle');
    const analyticsToggle = document.getElementById('cookieAnalyticsToggle');
    const marketingToggle = document.getElementById('cookieMarketingToggle');

    if (!banner) return;

    function setCookie(name, value, days) {
        const expires = new Date(Date.now() + days * 24 * 60 * 60 * 1000).toUTCString();
        document.cookie = `${name}=${encodeURIComponent(value)}; expires=${expires}; path=/; SameSite=Lax`;
    }

    function getCookie(name) {
        const value = `; ${document.cookie}`;
        const parts = value.split(`; ${name}=`);
        if (parts.length === 2) {
            return decodeURIComponent(parts.pop().split(';').shift());
        }
        return null;
    }

    function savePreferences(preferences) {
        setCookie(COOKIE_NAME, JSON.stringify(preferences), COOKIE_DAYS);
    }

    function readPreferences() {
        const raw = getCookie(COOKIE_NAME);
        if (!raw) return null;

        try {
            return JSON.parse(raw);
        } catch (e) {
            return null;
        }
    }

    function applyPreferencesToUI(preferences) {
        if (functionalToggle) functionalToggle.checked = !!preferences.functional;
        if (analyticsToggle) analyticsToggle.checked = !!preferences.analytics;
        if (marketingToggle) marketingToggle.checked = !!preferences.marketing;
    }

    function openModal() {
        $('#cookiePreferencesModal').modal('show');
    }

    function closeModal() {
        $('#cookiePreferencesModal').modal('hide');
    }

    function showBanner() {
        banner.hidden = false;

        requestAnimationFrame(() => {
            banner.classList.add('is-visible');
        });
    }

    function hideBanner() {
        banner.hidden = true;
    }

    function getCurrentPreferencesFromUI() {
        return {
            necessary: true,
            functional: !!functionalToggle?.checked,
            analytics: !!analyticsToggle?.checked,
            marketing: !!marketingToggle?.checked,
            consent_given: true,
            updated_at: new Date().toISOString(),
            version: '1.0'
        };
    }

    function applyConsents(preferences) {
        if (preferences.analytics) {
            loadGoogleAnalytics();
        }
    }

    function loadGoogleAnalytics() {
        if (window.__gaLoaded) return;
        window.__gaLoaded = true;

        const gaId = window.cookieConsentConfig?.gaMeasurementId;
        if (!gaId) return;

        const script1 = document.createElement('script');
        script1.async = true;
        script1.src = `https://www.googletagmanager.com/gtag/js?id=${gaId}`;
        document.head.appendChild(script1);

        const script2 = document.createElement('script');
        script2.innerHTML = `
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            window.gtag = gtag;
            gtag('js', new Date());
            gtag('config', '${gaId}', { anonymize_ip: true });
        `;
        document.head.appendChild(script2);
    }

    function acceptAll() {
        const preferences = {
            necessary: true,
            functional: true,
            analytics: true,
            marketing: true,
            consent_given: true,
            updated_at: new Date().toISOString(),
            version: '1.0'
        };

        savePreferences(preferences);
        applyPreferencesToUI(preferences);
        hideBanner();
        closeModal();
        applyConsents(preferences);
    }

    function rejectAll() {
        const preferences = {
            necessary: true,
            functional: false,
            analytics: false,
            marketing: false,
            consent_given: true,
            updated_at: new Date().toISOString(),
            version: '1.0'
        };

        savePreferences(preferences);
        applyPreferencesToUI(preferences);
        hideBanner();
        closeModal();
    }

    function saveCurrentPreferences() {
        const preferences = getCurrentPreferencesFromUI();
        savePreferences(preferences);
        hideBanner();
        closeModal();
        applyConsents(preferences);
    }

    function initAccordions() {
        const items = document.querySelectorAll('.cookie-consent__accordion-item');

        items.forEach(function (item) {
            const trigger = item.querySelector('[data-cookie-accordion-trigger]');
            if (!trigger) return;

            trigger.addEventListener('click', function (event) {
                if (event.target.closest('.cookie-consent__switch-wrap')) return;
                item.classList.toggle('is-open');
            });
        });
    }

    function initActions() {
        document.querySelectorAll('[data-cookie-action]').forEach(function (element) {
            element.addEventListener('click', function () {
                const action = this.dataset.cookieAction;

                if (action === 'open-modal') openModal();
                if (action === 'accept-all') acceptAll();
                if (action === 'reject-all') rejectAll();
                if (action === 'save-preferences') saveCurrentPreferences();
                if (action === 'close-modal') closeModal();
            });
        });
    }

    function allowBodyScrollWhileModalOpen() {
        $('#cookiePreferencesModal').on('shown.bs.modal', function () {
            $('body').css({
                overflow: 'auto',
                paddingRight: '0'
            });
        });

        $('#cookiePreferencesModal').on('hidden.bs.modal', function () {
            $('body').css({
                overflow: '',
                paddingRight: ''
            });
        });
    }

    function init() {
        const saved = readPreferences();

        initAccordions();
        initActions();
        allowBodyScrollWhileModalOpen();

        if (saved && saved.consent_given) {
            applyPreferencesToUI(saved);
            hideBanner();
            applyConsents(saved);
        } else {
            showBanner();
        }
    }

    init();
});