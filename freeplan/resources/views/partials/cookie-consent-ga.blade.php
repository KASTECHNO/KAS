@php
    $gaId = trim((string) config('services.google_analytics_id'));
@endphp

<div id="cookieConsentBanner" class="cookie-consent" role="dialog" aria-live="polite" aria-label="Consentement cookies">
    <p>
        Nous utilisons des cookies de mesure d'audience pour ameliorer le site.
        Vous pouvez accepter ou refuser Google Analytics.
    </p>
    <div class="cookie-consent-actions">
        <button type="button" id="cookieRejectBtn" class="cookie-btn cookie-btn-secondary">Refuser</button>
        <button type="button" id="cookieAcceptBtn" class="cookie-btn cookie-btn-primary">Accepter</button>
    </div>
</div>

<style>
.cookie-consent {
    position: fixed;
    left: 16px;
    right: 16px;
    bottom: 16px;
    z-index: 9999;
    display: none;
    align-items: center;
    justify-content: space-between;
    gap: 14px;
    padding: 14px 16px;
    border-radius: 12px;
    background: rgba(18, 26, 47, .95);
    color: #fff;
    box-shadow: 0 12px 36px rgba(0, 0, 0, .28);
}
.cookie-consent p {
    margin: 0;
    font-size: .86rem;
    line-height: 1.5;
}
.cookie-consent-actions {
    display: inline-flex;
    gap: 8px;
    flex-wrap: wrap;
}
.cookie-btn {
    border: 0;
    border-radius: 999px;
    padding: 8px 14px;
    font-size: .82rem;
    font-weight: 700;
    cursor: pointer;
}
.cookie-btn-primary {
    background: #ff5a3d;
    color: #fff;
}
.cookie-btn-secondary {
    background: #e5e7eb;
    color: #111827;
}
@media (max-width: 700px) {
    .cookie-consent {
        flex-direction: column;
        align-items: stretch;
    }
    .cookie-consent-actions {
        justify-content: flex-end;
    }
}
</style>

<script>
(function () {
    var STORAGE_KEY = 'kas_cookie_consent_v1';
    var consentValue = null;

    try {
        consentValue = localStorage.getItem(STORAGE_KEY);
    } catch (e) {
        consentValue = null;
    }

    var banner = document.getElementById('cookieConsentBanner');
    var acceptBtn = document.getElementById('cookieAcceptBtn');
    var rejectBtn = document.getElementById('cookieRejectBtn');

    function hideBanner() {
        if (banner) {
            banner.style.display = 'none';
        }
    }

    function showBanner() {
        if (banner) {
            banner.style.display = 'flex';
        }
    }

    function setConsent(value) {
        try {
            localStorage.setItem(STORAGE_KEY, value);
        } catch (e) {
            // Ignore storage failures.
        }
    }

    function loadGoogleAnalytics() {
        var gaId = @json($gaId);
        if (!gaId) {
            return;
        }

        if (window.__gaLoaded) {
            return;
        }

        window.__gaLoaded = true;
        window.dataLayer = window.dataLayer || [];
        window.gtag = function(){ dataLayer.push(arguments); };
        window.gtag('js', new Date());
        window.gtag('config', gaId, { anonymize_ip: true });

        var script = document.createElement('script');
        script.async = true;
        script.src = 'https://www.googletagmanager.com/gtag/js?id=' + encodeURIComponent(gaId);
        document.head.appendChild(script);
    }

    if (consentValue === 'accepted') {
        loadGoogleAnalytics();
        hideBanner();
    } else if (consentValue === 'rejected') {
        hideBanner();
    } else {
        showBanner();
    }

    if (acceptBtn) {
        acceptBtn.addEventListener('click', function () {
            setConsent('accepted');
            loadGoogleAnalytics();
            hideBanner();
        });
    }

    if (rejectBtn) {
        rejectBtn.addEventListener('click', function () {
            setConsent('rejected');
            hideBanner();
        });
    }
})();
</script>
