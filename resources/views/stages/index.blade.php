<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Offres de stage — {{ $company->name ?? 'KAS Technology' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/image.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
    :root {
        --bg:          #F8F8F8;
        --bg2:         #EFEFEF;
        --surface:     #FFFFFF;
        --border:      #E6E6E6;
        --border2:     #CBCBCB;
        --ink:         #101114;
        --ink2:        #1E2026;
        --muted:       #555964;
        --dim:         #9A9A97;
        --navy:        #121A2F;
        --blue:        #2251C7;
        --blue-light:  #EAF0FF;
        --blue-mid:    #466ED6;
        --teal:        #079B95;
        --teal-light:  #DBF4F2;
        --coral:       #FF5A3D;
        --coral-light: #FFE5DF;
        --gold:        #E07A16;
        --gold-light:  #FEEED7;
        --radius:      16px;
        --radius-sm:   10px;
        --radius-xs:   7px;
        --shadow:      0 2px 12px rgba(0,0,0,.07), 0 8px 32px rgba(0,0,0,.05);
        --shadow-lg:   0 8px 40px rgba(15,42,92,.12);
        --transition:  .22s cubic-bezier(.4,0,.2,1);
    }
    *, *::before, *::after { box-sizing: border-box; }
    html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; }
    body {
        margin: 0;
        font-family: 'DM Sans', sans-serif;
        color: var(--ink);
        background-color: var(--bg);
        overflow-x: hidden;
        font-size: 15.5px;
        line-height: 1.6;
    }
    ::selection { background: rgba(30,83,208,.18); color: var(--navy); }
    .wrap { width: min(1220px, 94vw); margin: 0 auto; }

    /* ── SCROLLBAR ──────────────────────────────────────────────────── */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: var(--bg2); }
    ::-webkit-scrollbar-thumb { background: var(--blue-mid); border-radius: 99px; }

    /* ── NAV ────────────────────────────────────────────────────────── */
    .topbar {
        position: sticky; top: 0; z-index: 100;
        background: rgba(247,247,244,.92);
        backdrop-filter: blur(16px) saturate(180%);
        border-bottom: 1px solid var(--border);
    }
    .topbar-inner {
        display: flex; align-items: center; justify-content: space-between;
        gap: 16px; padding: 14px 0;
    }
    .brand { display: flex; align-items: center; gap: 12px; text-decoration: none; }
    .brand-mark {
        width: 44px; height: 44px; border-radius: 12px;
        overflow: hidden; flex: 0 0 auto;
        background: #fff;
        border: 1.5px solid var(--border);
        box-shadow: 0 4px 16px rgba(16,17,20,.08);
        display: grid; place-items: center;
    }
    .brand-mark img { width: 100%; height: 100%; object-fit: contain; padding: 6px; filter: none; }
    .brand-mark span { font-size: .85rem; font-weight: 800; color: var(--navy); font-family: 'Syne', sans-serif; }
    .brand-copy { display: flex; flex-direction: column; gap: 1px; }
    .brand-copy h1 { margin: 0; font-size: 1rem; font-weight: 800; font-family: 'Syne', sans-serif; color: var(--navy); letter-spacing: -.02em; }
    .brand-copy span { font-size: .72rem; color: var(--muted); font-weight: 500; }
    .menu-toggle {
        display: none; border: 1.5px solid var(--border2); background: var(--surface);
        color: var(--ink); border-radius: var(--radius-sm);
        width: 40px; height: 40px; align-items: center; justify-content: center;
        font-size: .9rem; cursor: pointer; flex: 0 0 auto;
    }
    .top-nav { display: flex; align-items: center; gap: 2px; }
    .top-nav a {
        text-decoration: none; color: var(--muted); font-weight: 600; font-size: .84rem;
        border-radius: var(--radius-xs); padding: 7px 12px; white-space: nowrap;
        transition: color var(--transition), background var(--transition);
    }
    .top-nav a:hover { color: var(--navy); background: var(--blue-light); }
    .top-nav a.cta {
        background: var(--navy); color: #fff !important; margin-left: 8px;
        border-radius: var(--radius-sm); padding: 9px 18px;
        transition: background var(--transition), transform var(--transition);
    }
    .top-nav a.cta:hover { background: var(--blue); transform: translateY(-1px); }

    /* ── PAGE HERO ──────────────────────────────────────────────────── */
    .page-hero {
        padding: 72px 0 56px;
        text-align: center;
    }
    .page-hero .section-eyebrow {
        display: inline-flex; align-items: center; gap: 7px;
        font-size: .7rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
        color: var(--blue); background: var(--blue-light);
        border: 1px solid rgba(30,83,208,.15);
        border-radius: 999px; padding: 5px 14px 5px 10px; margin-bottom: 18px;
    }
    .page-hero .section-eyebrow .dot {
        width: 6px; height: 6px; border-radius: 999px; background: var(--teal);
        animation: pulse 2s ease infinite;
    }
    .page-hero h2 {
        font-family: 'Syne', sans-serif;
        font-size: clamp(2rem, 4.5vw, 3.2rem);
        font-weight: 800; line-height: 1.08; letter-spacing: -.03em;
        color: var(--ink); margin: 0 0 16px;
    }
    .page-hero h2 .accent { color: var(--blue); }
    .page-hero p {
        color: var(--muted); font-size: 1rem; line-height: 1.75;
        max-width: 580px; margin: 0 auto 32px;
    }
    .page-hero-actions { display: flex; gap: 12px; justify-content: center; flex-wrap: wrap; }

    /* ── BUTTONS ────────────────────────────────────────────────────── */
    .btn-primary {
        display: inline-flex; align-items: center; gap: 9px;
        background: var(--navy); color: #fff; text-decoration: none;
        border-radius: 999px; padding: 13px 26px;
        font-size: .9rem; font-weight: 700; border: 0; cursor: pointer;
        transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
        box-shadow: 0 6px 20px rgba(15,42,92,.28);
    }
    .btn-primary:hover { background: var(--blue); transform: translateY(-2px); color: #fff; }
    .btn-outline {
        display: inline-flex; align-items: center; gap: 9px;
        background: transparent; color: var(--ink); text-decoration: none;
        border-radius: 999px; padding: 12px 26px;
        font-size: .9rem; font-weight: 600;
        border: 1.5px solid var(--border2); cursor: pointer;
        transition: color var(--transition), border-color var(--transition), transform var(--transition);
    }
    .btn-outline:hover { color: var(--navy); border-color: var(--navy); transform: translateY(-2px); }

    /* ── CARD BASE ──────────────────────────────────────────────────── */
    .card {
        background: var(--surface); border: 1.5px solid var(--border);
        border-radius: var(--radius); box-shadow: var(--shadow);
        transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
    }
    .card:hover { transform: translateY(-4px); box-shadow: var(--shadow-lg); border-color: var(--border2); }

    /* ── STAGES GRID ────────────────────────────────────────────────── */
    .stages-section { padding: 0 0 80px; }
    .stages-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
    .stage-card { padding: 24px; display: flex; flex-direction: column; }
    .stage-chips { display: flex; gap: 6px; margin-bottom: 14px; flex-wrap: wrap; }
    .chip {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: .68rem; font-weight: 700; letter-spacing: .04em;
        border-radius: 999px; padding: 4px 10px;
    }
    .chip-teal  { color: var(--teal); background: var(--teal-light); border: 1px solid rgba(12,168,160,.2); }
    .chip-blue  { color: var(--blue); background: var(--blue-light); border: 1px solid rgba(30,83,208,.2); }
    .chip-gold  { color: var(--gold); background: var(--gold-light); border: 1px solid rgba(217,119,6,.2); }
    .stage-card h4 { margin: 0 0 8px; font-size: .97rem; font-weight: 700; color: var(--ink2); line-height: 1.3; }
    .stage-card > p { flex: 1; color: var(--muted); font-size: .88rem; line-height: 1.65; margin: 0 0 12px; }
    .stage-meta { font-size: .78rem; color: var(--dim); margin-bottom: 6px; display: flex; align-items: center; gap: 6px; }
    .stage-meta i { color: var(--blue); }
    .link-arrow {
        display: inline-flex; align-items: center; gap: 7px; margin-top: auto;
        text-decoration: none; color: var(--blue); font-size: .84rem; font-weight: 700;
        transition: gap var(--transition), color var(--transition);
    }
    .link-arrow:hover { color: var(--navy); gap: 10px; }

    /* ── EMPTY STATE ────────────────────────────────────────────────── */
    .empty-state {
        text-align: center; padding: 72px 20px; color: var(--muted);
    }
    .empty-icon {
        width: 72px; height: 72px; border-radius: 50%;
        background: var(--blue-light); color: var(--blue);
        font-size: 1.8rem; display: grid; place-items: center;
        margin: 0 auto 20px;
    }
    .empty-state h3 { font-family: 'Syne', sans-serif; font-size: 1.3rem; font-weight: 800; color: var(--ink); margin: 0 0 8px; }
    .empty-state p { font-size: .95rem; max-width: 400px; margin: 0 auto 24px; }

    /* ── CTA BANNER ─────────────────────────────────────────────────── */
    .cta-wrap { padding: 0 0 80px; }
    .cta-banner {
        background: var(--navy); border-radius: 24px; padding: 56px 48px;
        display: flex; align-items: center; justify-content: space-between;
        gap: 32px; flex-wrap: wrap; position: relative; overflow: hidden;
    }
    .cta-banner::before {
        content: ''; position: absolute; right: -80px; top: -80px;
        width: 320px; height: 320px; border-radius: 999px;
        background: radial-gradient(circle, rgba(79,120,224,.3), transparent 65%);
        pointer-events: none;
    }
    .cta-banner-text { position: relative; z-index: 1; }
    .cta-banner-text h3 {
        font-family: 'Syne', sans-serif; font-size: clamp(1.4rem, 2.8vw, 1.9rem);
        font-weight: 800; color: #fff; letter-spacing: -.025em;
        margin: 0 0 10px; line-height: 1.15;
    }
    .cta-banner-text p { color: rgba(255,255,255,.7); font-size: .96rem; margin: 0; }
    .cta-banner-actions { display: flex; gap: 12px; flex-wrap: wrap; position: relative; z-index: 1; }
    .btn-white {
        display: inline-flex; align-items: center; gap: 9px;
        background: #fff; color: var(--navy); border-radius: 999px;
        padding: 13px 26px; font-size: .9rem; font-weight: 700; text-decoration: none;
        transition: transform var(--transition), box-shadow var(--transition);
    }
    .btn-white:hover { transform: translateY(-2px); box-shadow: 0 8px 28px rgba(0,0,0,.16); }
    .btn-white-outline {
        display: inline-flex; align-items: center; gap: 9px;
        background: transparent; color: rgba(255,255,255,.85);
        border: 1.5px solid rgba(255,255,255,.3); border-radius: 999px;
        padding: 12px 24px; font-size: .9rem; font-weight: 600; text-decoration: none;
        transition: background var(--transition), border-color var(--transition), transform var(--transition);
    }
    .btn-white-outline:hover { background: rgba(255,255,255,.1); border-color: rgba(255,255,255,.7); transform: translateY(-1px); }

    /* ── FOOTER ─────────────────────────────────────────────────────── */
    .site-footer {
        border-top: 1px solid var(--border);
        padding: 20px 0; display: flex; align-items: center;
        justify-content: space-between; flex-wrap: wrap; gap: 12px;
        font-size: .84rem; color: var(--dim);
    }
    .footer-links { display: flex; gap: 20px; flex-wrap: wrap; }
    .footer-links a { text-decoration: none; color: var(--dim); font-weight: 600; font-size: .82rem; transition: color var(--transition); }
    .footer-links a:hover { color: var(--navy); }

    /* ── ANIMATIONS ─────────────────────────────────────────────────── */
    @keyframes fadeUp { from { opacity:0; transform: translateY(18px); } to { opacity:1; transform: translateY(0); } }
    @keyframes pulse  { 0%,100% { opacity:1; } 50% { opacity:.4; } }
    .reveal { opacity: 0; transform: translateY(16px); transition: opacity .6s ease, transform .6s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }

    /* ── RESPONSIVE ─────────────────────────────────────────────────── */
    @media (max-width: 960px) {
        .stages-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 680px) {
        .stages-grid { grid-template-columns: 1fr; }
        .topbar-inner { flex-wrap: wrap; row-gap: 8px; }
        .menu-toggle { display: inline-flex; }
        .top-nav {
            display: none; width: 100%; justify-content: flex-start;
            gap: 4px; padding-top: 6px; border-top: 1px solid var(--border);
        }
        .top-nav.open { display: flex; flex-wrap: wrap; }
        .cta-banner { padding: 36px 24px; }
        .page-hero { padding: 48px 0 36px; }
    }
    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after { animation: none !important; transition: none !important; }
    }
    </style>
</head>
<body>

{{-- ═══ TOPBAR ══════════════════════════════════════════════════════════════ --}}
<header class="topbar">
    <div class="wrap topbar-inner">
        <a href="{{ route('home') }}" class="brand">
            <div class="brand-mark">
                <img src="{{ asset('images/image.png') }}" alt="{{ $company->name ?? 'KAS' }}">
            </div>
            <div class="brand-copy">
                <h1>{{ $company->name ?? 'KAS Technology' }}</h1>
                <span>{{ $company->slogan ?? 'Votre vision, notre code...' }}</span>
            </div>
        </a>
        <button class="menu-toggle" id="menuToggle" type="button" aria-label="Menu" aria-expanded="false" aria-controls="topNav">
            <i class="fa-solid fa-bars"></i>
        </button>
        <nav class="top-nav" id="topNav">
            <a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Accueil</a>
            <a href="{{ route('home') }}#services">Services</a>
            <a href="{{ route('home') }}#projects">Projets</a>
            <a href="{{ route('home') }}#contact" class="cta"><i class="fa-solid fa-paper-plane"></i> Contact</a>
        </nav>
    </div>
</header>

{{-- ═══ HERO ════════════════════════════════════════════════════════════════ --}}
<div class="wrap">
    <section class="page-hero">
        <div class="section-eyebrow">
            <span class="dot"></span>
            Opportunités professionnelles
        </div>
        <h2>Offres de <span class="accent">stage</span></h2>
        <p>Intégrez une équipe experte sur des projets concrets à fort impact. Tous nos stages sont encadrés par des ingénieurs seniors et orientés vers une montée en compétences réelle.</p>
        <div class="page-hero-actions">
            <a href="#offres" class="btn-primary"><i class="fa-solid fa-graduation-cap"></i> Voir les offres</a>
            <a href="{{ route('home') }}#contact" class="btn-outline">Nous contacter <i class="fa-solid fa-arrow-right"></i></a>
        </div>
    </section>
</div>

{{-- ═══ STAGES GRID ═════════════════════════════════════════════════════════ --}}
<main id="offres" class="wrap stages-section reveal">
    @if($stages->count())
    <div class="stages-grid">
        @foreach($stages as $stage)
        <div class="card stage-card">
            <div class="stage-chips">
                <span class="chip chip-teal"><i class="fa-solid fa-tag"></i> {{ $stage->domaine }}</span>
                <span class="chip chip-blue">{{ $stage->type_stage }}</span>
            </div>
            <h4>{{ $stage->titre }}</h4>
            <p>{{ Str::limit($stage->description, 140) }}</p>
            @if($stage->niveau_requis)
            <div class="stage-meta"><i class="fa-solid fa-user-graduate"></i> {{ $stage->niveau_requis }}</div>
            @endif
            @if($stage->technologies)
            <div class="stage-meta"><i class="fa-solid fa-code"></i> {{ $stage->technologies }}</div>
            @endif
            @if($stage->date_limite)
            <div class="stage-meta"><i class="fa-solid fa-calendar-day"></i> Candidature avant le {{ $stage->date_limite->format('d/m/Y') }}</div>
            @endif
            <a href="{{ route('stages.show', $stage->slug) }}" class="link-arrow">
                Voir l'offre <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
        @endforeach
    </div>
    @else
    <div class="empty-state">
        <div class="empty-icon"><i class="fa-solid fa-inbox"></i></div>
        <h3>Aucune offre disponible</h3>
        <p>Nos offres de stage se renouvellent régulièrement. Revenez prochainement ou contactez-nous directement.</p>
        <a href="{{ route('home') }}#contact" class="btn-primary"><i class="fa-solid fa-envelope"></i> Candidature spontanée</a>
    </div>
    @endif
</main>

{{-- ═══ CTA BANNER ══════════════════════════════════════════════════════════ --}}
<div class="wrap cta-wrap reveal">
    <div class="cta-banner">
        <div class="cta-banner-text">
            <h3>Pas de stage correspondant à votre profil ?</h3>
            <p>Envoyez une candidature spontanée — nous étudions tous les profils motivés.</p>
        </div>
        <div class="cta-banner-actions">
            <a href="{{ route('home') }}#contact" class="btn-white">
                <i class="fa-solid fa-paper-plane"></i> Candidature spontanée
            </a>
            <a href="{{ route('home') }}" class="btn-white-outline">
                Retour à l'accueil <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

{{-- ═══ FOOTER ══════════════════════════════════════════════════════════════ --}}
<footer class="wrap site-footer">
    <p>&copy; {{ date('Y') }} {{ $company->name ?? 'KAS Technology' }} &mdash; Tous droits réservés.</p>
    <nav class="footer-links">
        <a href="{{ route('home') }}">Accueil</a>
        <a href="{{ route('home') }}#services">Services</a>
        <a href="{{ route('home') }}#projects">Projets</a>
        <a href="{{ route('home') }}#contact">Contact</a>
    </nav>
</footer>

<a href="{{ route('stages.index') }}#" class="floating-cta" id="floatingCta" aria-label="Voir les stages">
    <i class="fa-solid fa-bolt"></i>
    Postuler maintenant
</a>

<script>
(function () {
    var toggle = document.getElementById('menuToggle');
    var nav    = document.getElementById('topNav');
    if (!toggle || !nav) return;
    toggle.addEventListener('click', function () {
        var isOpen = nav.classList.toggle('open');
        toggle.setAttribute('aria-expanded', isOpen);
        toggle.innerHTML = isOpen
            ? '<i class="fa-solid fa-xmark"></i>'
            : '<i class="fa-solid fa-bars"></i>';
    });
})();
(function () {
    if (!('IntersectionObserver' in window)) {
        document.querySelectorAll('.reveal').forEach(function(el){ el.classList.add('visible'); });
        return;
    }
    var obs = new IntersectionObserver(function(entries) {
        entries.forEach(function(e) {
            if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
        });
    }, { threshold: 0.1 });
    document.querySelectorAll('.reveal').forEach(function(el){ obs.observe(el); });
})();

/* ── FLOATING CTA ───────────────────────────────────────────────────── */
(function () {
    var cta = document.getElementById('floatingCta');
    if (!cta) return;
    var onScroll = function () {
        if (window.scrollY > 260) cta.classList.add('visible');
        else cta.classList.remove('visible');
    };
    onScroll();
    window.addEventListener('scroll', onScroll, { passive: true });
})();
</script>
</body>
</html>
