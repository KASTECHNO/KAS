<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $stage->titre }} — {{ $company->name ?? 'KAS Technology' }}</title>
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

    /* ── PAGE LAYOUT ────────────────────────────────────────────────── */
    .page-main { padding: 36px 0 80px; }
    .btn-back {
        display: inline-flex; align-items: center; gap: 8px;
        text-decoration: none; color: var(--muted); font-size: .86rem; font-weight: 600;
        background: var(--surface); border: 1.5px solid var(--border);
        border-radius: 999px; padding: 8px 18px; margin-bottom: 28px;
        transition: color var(--transition), border-color var(--transition), transform var(--transition);
    }
    .btn-back:hover { color: var(--navy); border-color: var(--navy); transform: translateX(-2px); }

    .detail-layout {
        display: grid; grid-template-columns: 1fr 1fr; gap: 24px; align-items: start;
    }

    /* ── CHIPS / TAGS ───────────────────────────────────────────────── */
    .tag-row { display: flex; gap: 8px; flex-wrap: wrap; margin-bottom: 18px; }
    .chip {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: .68rem; font-weight: 700; letter-spacing: .04em;
        border-radius: 999px; padding: 5px 12px;
    }
    .chip-teal    { color: var(--teal); background: var(--teal-light); border: 1px solid rgba(12,168,160,.2); }
    .chip-blue    { color: var(--blue); background: var(--blue-light); border: 1px solid rgba(30,83,208,.2); }
    .chip-gold    { color: var(--gold); background: var(--gold-light); border: 1px solid rgba(217,119,6,.2); }
    .chip-deadline { color: #9a3412; background: #ffedd5; border: 1px solid rgba(154,52,18,.2); }

    /* ── DETAIL CARD ────────────────────────────────────────────────── */
    .detail-card {
        background: var(--surface); border: 1.5px solid var(--border);
        border-radius: var(--radius); box-shadow: var(--shadow); padding: 32px;
    }
    .detail-card h2 {
        font-family: 'Syne', sans-serif;
        font-size: clamp(1.4rem, 2.6vw, 1.9rem);
        font-weight: 800; letter-spacing: -.025em;
        color: var(--ink); margin: 0 0 18px; line-height: 1.2;
    }
    .info-grid {
        display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 24px;
    }
    .info-item {
        background: var(--bg); border: 1.5px solid var(--border);
        border-radius: var(--radius-sm); padding: 13px 15px;
    }
    .info-item label {
        display: block; font-size: .7rem; font-weight: 700; letter-spacing: .1em;
        text-transform: uppercase; color: var(--blue); margin-bottom: 3px;
    }
    .info-item span { font-size: .9rem; font-weight: 600; color: var(--ink2); }
    .sep { border: 0; border-top: 1.5px solid var(--border); margin: 0 0 20px; }
    .detail-label {
        font-size: .7rem; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
        color: var(--muted); margin-bottom: 10px;
    }
    .detail-desc {
        color: var(--muted); line-height: 1.8; font-size: .95rem;
        white-space: pre-line; margin: 0;
    }

    /* ── FORM PANEL ─────────────────────────────────────────────────── */
    .form-panel {
        background: var(--surface); border: 1.5px solid var(--border);
        border-radius: var(--radius); box-shadow: var(--shadow); padding: 32px;
        position: sticky; top: 88px;
    }
    .form-panel h3 {
        font-family: 'Syne', sans-serif; font-size: 1.1rem; font-weight: 800;
        letter-spacing: -.02em; color: var(--ink); margin: 0 0 20px;
        display: flex; align-items: center; gap: 10px;
    }
    .form-panel h3 i { color: var(--blue); }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px; }
    .form-field { margin-bottom: 10px; }
    .form-field label {
        display: block; font-size: .7rem; font-weight: 700; letter-spacing: .1em;
        text-transform: uppercase; color: var(--muted); margin-bottom: 5px;
    }
    .form-field input,
    .form-field textarea,
    .form-field select {
        width: 100%; background: var(--bg); border: 1.5px solid var(--border);
        border-radius: var(--radius-sm); padding: 11px 14px;
        font: inherit; font-size: .9rem; color: var(--ink);
        transition: border-color var(--transition), background var(--transition);
    }
    .form-field input::placeholder,
    .form-field textarea::placeholder { color: var(--dim); }
    .form-field input:focus,
    .form-field textarea:focus,
    .form-field select:focus { outline: none; border-color: var(--blue); background: #fff; }
    .file-note { font-size: .75rem; color: var(--dim); margin: 4px 0 0; }
    .flash-ok {
        background: var(--teal-light); border: 1px solid rgba(12,168,160,.25);
        border-radius: var(--radius-xs); padding: 10px 14px; margin-bottom: 14px;
        color: var(--teal); font-size: .86rem;
        display: flex; align-items: center; gap: 8px;
    }
    .flash-err {
        background: #fff0f0; border: 1px solid rgba(220,38,38,.2);
        border-radius: var(--radius-xs); padding: 10px 14px; margin-bottom: 14px;
        color: #b91c1c; font-size: .86rem;
    }
    .flash-err ul { margin: 0; padding-left: 18px; }
    .form-panel button[type="submit"] {
        width: 100%; border: 0; border-radius: 999px; padding: 13px;
        background: linear-gradient(135deg, var(--coral), #FF7B41); color: #fff;
        font: 700 .92rem 'DM Sans', sans-serif; cursor: pointer;
        box-shadow: 0 8px 24px rgba(255,90,61,.3);
        transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .form-panel button[type="submit"]:hover { filter: brightness(1.05); transform: translateY(-2px); box-shadow: 0 12px 30px rgba(255,90,61,.34); }

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
    @keyframes fadeDown { from { opacity:0; transform: translateY(-24px); } to { opacity:1; transform: translateY(0); } }
    .reveal { opacity: 0; transform: translateY(16px); transition: opacity .6s ease, transform .6s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }
    .floating-cta {
        position: fixed;
        right: 18px;
        bottom: 18px;
        z-index: 120;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        text-decoration: none;
        color: #fff;
        background: linear-gradient(135deg, var(--coral), #FF7B41);
        border-radius: 999px;
        padding: 12px 18px;
        font-size: .84rem;
        font-weight: 700;
        box-shadow: 0 14px 28px rgba(255,90,61,.35);
        transform: translateY(10px);
        opacity: 0;
        pointer-events: none;
        transition: transform .22s ease, opacity .22s ease;
    }
    .floating-cta.visible {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }
    .floating-cta:hover { filter: brightness(1.04); }

    /* ── RESPONSIVE ─────────────────────────────────────────────────── */
    @media (max-width: 860px) {
        .detail-layout { grid-template-columns: 1fr; }
        .form-panel { position: static; }
    }
    @media (max-width: 680px) {
        .topbar-inner { flex-wrap: wrap; row-gap: 8px; }
        .menu-toggle { display: inline-flex; }
        .top-nav {
            display: none; width: 100%; justify-content: flex-start;
            gap: 4px; padding-top: 6px; border-top: 1px solid var(--border);
        }
        .top-nav.open { display: flex; flex-wrap: wrap; }
        .form-row { grid-template-columns: 1fr; }
        .info-grid { grid-template-columns: 1fr; }
        .floating-cta {
            right: 12px;
            left: 12px;
            bottom: 12px;
            justify-content: center;
        }
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
            <a href="{{ route('stages.index') }}"><i class="fa-solid fa-list"></i> Toutes les offres</a>
            <a href="{{ route('home') }}#contact" class="cta"><i class="fa-solid fa-paper-plane"></i> Contact</a>
        </nav>
    </div>
</header>

{{-- ═══ MAIN ════════════════════════════════════════════════════════════════ --}}
<main class="wrap page-main reveal">

    <a href="{{ route('stages.index') }}" class="btn-back">
        <i class="fa-solid fa-arrow-left"></i> Retour aux offres
    </a>

    <div class="detail-layout">

        {{-- ── Détail de l'offre ── --}}
        <div class="detail-card">
            <div class="tag-row">
                <span class="chip chip-teal"><i class="fa-solid fa-tag"></i> {{ $stage->domaine }}</span>
                <span class="chip chip-blue">{{ $stage->type_stage }}</span>
                @if($stage->date_limite)
                    <span class="chip chip-deadline"><i class="fa-solid fa-calendar-day"></i> Limite : {{ $stage->date_limite->format('d/m/Y') }}</span>
                @endif
            </div>

            <h2>{{ $stage->titre }}</h2>

            @if($stage->niveau_requis || $stage->technologies)
            <div class="info-grid">
                @if($stage->niveau_requis)
                <div class="info-item">
                    <label><i class="fa-solid fa-user-graduate"></i> Niveau requis</label>
                    <span>{{ $stage->niveau_requis }}</span>
                </div>
                @endif
                @if($stage->technologies)
                <div class="info-item">
                    <label><i class="fa-solid fa-code"></i> Technologies</label>
                    <span>{{ $stage->technologies }}</span>
                </div>
                @endif
            </div>
            @endif

            <hr class="sep">
            <p class="detail-label"><i class="fa-solid fa-align-left"></i> Description du sujet</p>
            <p class="detail-desc">{{ $stage->description }}</p>
        </div>

        {{-- ── Formulaire de candidature ── --}}
        <div class="form-panel">
            <h3><i class="fa-solid fa-file-pen"></i> Déposer ma candidature</h3>

            @if(session('success'))
                <div class="flash-ok"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
            @endif

            @if($errors->any())
                <div class="flash-err">
                    <ul>
                        @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
                    </ul>
                </div>
            @endif

            <form method="POST" action="{{ route('candidatures.store', $stage->slug) }}" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="form-field">
                        <label>Nom complet <span style="color:#dc2626">*</span></label>
                        <input type="text" name="nom" value="{{ old('nom') }}" required placeholder="Jean Dupont">
                    </div>
                    <div class="form-field">
                        <label>Adresse e-mail <span style="color:#dc2626">*</span></label>
                        <input type="email" name="email" value="{{ old('email') }}" required placeholder="votre@email.com">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label>Téléphone</label>
                        <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="+216 XX XXX XXX">
                    </div>
                    <div class="form-field">
                        <label>Établissement</label>
                        <input type="text" name="etablissement" value="{{ old('etablissement') }}" placeholder="Université / École">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-field">
                        <label>Niveau d'études</label>
                        <select name="niveau_etudes">
                            <option value="">— Sélectionner —</option>
                            @foreach(['Licence', 'Master', 'Ingénierie', 'Doctorat', 'BTS / DUT', 'Autre'] as $n)
                                <option value="{{ $n }}" {{ old('niveau_etudes') === $n ? 'selected' : '' }}>{{ $n }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-field">
                        <label>Spécialité</label>
                        <input type="text" name="specialite" value="{{ old('specialite') }}" placeholder="ex : Génie logiciel">
                    </div>
                </div>
                <div class="form-field">
                    <label>Lettre de motivation</label>
                    <textarea name="lettre_motivation" rows="5" placeholder="Présentez votre intérêt pour cette offre et ce que vous souhaitez apporter...">{{ old('lettre_motivation') }}</textarea>
                </div>
                <div class="form-field">
                    <label>CV <span style="color:var(--dim);font-weight:400;text-transform:none;letter-spacing:0;">(PDF, DOC, DOCX — max 4 Mo)</span></label>
                    <input type="file" name="cv" accept=".pdf,.doc,.docx">
                    <p class="file-note">Formats acceptés : PDF, Word (.doc / .docx)</p>
                </div>
                <button type="submit"><i class="fa-solid fa-paper-plane"></i> Envoyer ma candidature</button>
            </form>
        </div>

    </div>
</main>

{{-- ═══ FOOTER ══════════════════════════════════════════════════════════════ --}}
<footer class="wrap site-footer">
    <p>&copy; {{ date('Y') }} {{ $company->name ?? 'KAS Technology' }} &mdash; Tous droits réservés.</p>
    <nav class="footer-links">
        <a href="{{ route('home') }}">Accueil</a>
        <a href="{{ route('stages.index') }}">Stages</a>
        <a href="{{ route('home') }}#contact">Contact</a>
    </nav>
</footer>

<a href="#" class="floating-cta" id="floatingCta" aria-label="Réserver un audit">
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
    }, { threshold: 0.08 });
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
