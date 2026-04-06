<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $company->name ?? 'KAS Technology' }}</title>
    <link rel="icon" type="image/png" href="{{ asset('images/image.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
    /* ═══════════════════════════════════════════════════════════════════
       KAS Technology — Design System inspiré VeryBerry
       Fond clair, typographie Syne très bold, accents indigo/bleu marine
    ═══════════════════════════════════════════════════════════════════ */
    :root {
        --bg:           #F8F8F8;
        --bg2:          #EFEFEF;
        --bg3:          #F5F6F8;
        --surface:      #FFFFFF;
        --border:       #E6E6E6;
        --border2:      #CBCBCB;
        --ink:          #101114;
        --ink2:         #1E2026;
        --muted:        #555964;
        --dim:          #9A9A97;
        --navy:         #121A2F;
        --blue:         #2251C7;
        --blue-light:   #EAF0FF;
        --blue-mid:     #466ED6;
        --teal:         #079B95;
        --teal-light:   #DBF4F2;
        --coral:        #FF5A3D;
        --coral-light:  #FFE5DF;
        --violet:       #5F56D9;
        --violet-light: #ECEAFD;
        --gold:         #E07A16;
        --gold-light:   #FEEED7;
        --radius:       16px;
        --radius-sm:    10px;
        --radius-xs:    7px;
        --shadow:       0 2px 12px rgba(0,0,0,.07), 0 8px 32px rgba(0,0,0,.05);
        --shadow-lg:    0 8px 40px rgba(15,42,92,.12);
        --transition:   .22s cubic-bezier(.4,0,.2,1);
    }

    *, *::before, *::after { box-sizing: border-box; }
    html { scroll-behavior: smooth; -webkit-font-smoothing: antialiased; }
    body {
        margin: 0;
        font-family: 'DM Sans', sans-serif;
        color: var(--ink);
        background:
            radial-gradient(1200px 540px at -10% -20%, rgba(30,83,208,.12), transparent 65%),
            radial-gradient(900px 420px at 110% 5%, rgba(12,168,160,.12), transparent 60%),
            linear-gradient(180deg, var(--bg3) 0%, var(--bg) 35%, var(--bg) 100%);
        overflow-x: hidden;
        font-size: 15.5px;
        line-height: 1.6;
    }
    body::before {
        content: '';
        position: fixed;
        inset: 0;
        pointer-events: none;
        background-image:
            linear-gradient(rgba(15,42,92,.025) 1px, transparent 1px),
            linear-gradient(90deg, rgba(15,42,92,.025) 1px, transparent 1px);
        background-size: 46px 46px;
        mask-image: radial-gradient(circle at center, black 35%, transparent 85%);
        z-index: -1;
    }
    ::selection { background: rgba(30,83,208,.18); color: var(--navy); }
    .wrap { width: min(1220px, 94vw); margin: 0 auto; }

    /* ── SCROLLBAR ────────────────────────────────────────────────────── */
    ::-webkit-scrollbar { width: 5px; }
    ::-webkit-scrollbar-track { background: var(--bg2); }
    ::-webkit-scrollbar-thumb { background: var(--blue-mid); border-radius: 99px; }

    /* ── NAV ─────────────────────────────────────────────────────────── */
    .topbar {
        position: sticky; top: 0; z-index: 100;
        background: rgba(255,255,255,.78);
        backdrop-filter: blur(16px) saturate(180%);
        border-bottom: 1px solid rgba(15,42,92,.08);
        box-shadow: 0 8px 24px rgba(15,42,92,.06);
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
        position: relative;
    }
    .top-nav a::after {
        content: '';
        position: absolute;
        left: 12px;
        right: 12px;
        bottom: 4px;
        height: 2px;
        border-radius: 99px;
        background: linear-gradient(90deg, var(--blue), var(--teal), var(--coral));
        transform: scaleX(0);
        transform-origin: left;
        transition: transform .22s ease;
    }
    .top-nav a:hover { color: var(--navy); background: var(--blue-light); }
    .top-nav a:hover::after { transform: scaleX(1); }
    .top-nav a.cta {
        background: linear-gradient(135deg, var(--coral), #FF7B41); color: #fff !important; margin-left: 8px;
        border-radius: var(--radius-sm); padding: 9px 18px;
        transition: background var(--transition), transform var(--transition);
        box-shadow: 0 10px 24px rgba(255,90,61,.28);
    }
    .top-nav a.cta:hover { filter: brightness(1.04); transform: translateY(-1px); }
    section[id] { scroll-margin-top: 80px; }

    /* ── HERO ────────────────────────────────────────────────────────── */
    .hero {
        display: grid; grid-template-columns: 1fr auto;
        gap: 48px; align-items: center;
        padding: 88px 0 72px;
        position: relative;
        isolation: isolate;
    }
    .hero::before {
        content: '';
        position: absolute;
        left: -80px;
        top: -50px;
        width: 430px;
        height: 430px;
        border-radius: 999px;
        background: radial-gradient(circle, rgba(30,83,208,.18) 0%, rgba(30,83,208,.08) 38%, transparent 72%);
        z-index: -1;
        pointer-events: none;
    }
    .hero::after {
        content: '';
        position: absolute;
        right: 12%;
        bottom: 5px;
        width: 220px;
        height: 220px;
        border-radius: 999px;
        background: radial-gradient(circle, rgba(249,115,102,.18) 0%, transparent 72%);
        z-index: -1;
        pointer-events: none;
    }
    .hero-left {
        background: rgba(255,255,255,.58);
        border: 1px solid rgba(15,42,92,.08);
        border-radius: 24px;
        padding: 30px 30px 28px;
        box-shadow: 0 20px 44px rgba(15,42,92,.07);
        backdrop-filter: blur(8px);
        position: relative;
    }
    .hero-left::after {
        content: '';
        position: absolute;
        right: 18px;
        top: 18px;
        width: 76px;
        height: 8px;
        border-radius: 99px;
        background: linear-gradient(90deg, var(--coral), var(--gold), var(--teal));
        opacity: .75;
    }
    .hero-eyebrow {
        display: inline-flex; align-items: center; gap: 8px;
        font-size: .75rem; font-weight: 700; letter-spacing: .12em;
        text-transform: uppercase; color: var(--blue);
        background: var(--blue-light); border: 1px solid rgba(30,83,208,.15);
        border-radius: 999px; padding: 5px 14px 5px 10px;
        margin-bottom: 20px;
    }
    .hero-eyebrow .dot {
        width: 6px; height: 6px; border-radius: 999px; background: var(--teal);
        animation: pulse 2s ease infinite;
    }
    .hero h2 {
        font-family: 'Syne', sans-serif;
        font-size: clamp(2.4rem, 5.2vw, 4rem);
        font-weight: 800; line-height: 1.06; letter-spacing: -.03em;
        color: var(--ink); margin: 0 0 18px;
        animation: fadeDown .6s ease both;
    }
    .hero h2 .accent-text {
        color: var(--blue);
    }
    .hero h2 .underline-em {
        position: relative; display: inline-block;
    }
    .hero h2 .underline-em::after {
        content: ''; position: absolute; left: 0; bottom: 2px;
        width: 100%; height: 4px; border-radius: 2px;
        background: linear-gradient(90deg, var(--blue), var(--teal));
        opacity: .5;
    }
    .hero-desc {
        color: var(--muted); font-size: 1rem; line-height: 1.75;
        margin: 0 0 32px; max-width: 560px;
        animation: fadeDown .7s .1s ease both;
    }
    .hero-actions {
        display: flex; gap: 12px; flex-wrap: wrap;
        animation: fadeDown .8s .18s ease both;
    }
    .hero-proof {
        margin-top: 18px;
        display: grid;
        grid-template-columns: repeat(4, minmax(100px, 1fr));
        gap: 10px;
        animation: fadeDown .9s .25s ease both;
    }
    .hero-proof-item {
        background: #fff;
        border: 1.5px solid var(--border);
        border-radius: 12px;
        padding: 10px 12px;
        box-shadow: 0 6px 20px rgba(16,17,20,.05);
    }
    .hero-proof-item strong {
        display: block;
        font: 800 .98rem 'Syne', sans-serif;
        color: var(--ink2);
        letter-spacing: -.01em;
        line-height: 1.1;
    }
    .hero-proof-item span {
        display: block;
        margin-top: 3px;
        font-size: .74rem;
        color: var(--muted);
        font-weight: 600;
    }
    .btn-primary {
        display: inline-flex; align-items: center; gap: 9px;
        background: linear-gradient(135deg, var(--coral), #FF7B41); color: #fff; text-decoration: none;
        border-radius: 999px; padding: 13px 26px;
        font-size: .9rem; font-weight: 700; border: 0; cursor: pointer;
        transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
        box-shadow: 0 8px 24px rgba(255,90,61,.3);
    }
    .btn-primary:hover { filter: brightness(1.05); transform: translateY(-2px); box-shadow: 0 12px 30px rgba(255,90,61,.34); color: #fff; }
    .btn-outline {
        display: inline-flex; align-items: center; gap: 9px;
        background: transparent; color: var(--ink); text-decoration: none;
        border-radius: 999px; padding: 12px 26px;
        font-size: .9rem; font-weight: 600;
        border: 1.5px solid var(--border2); cursor: pointer;
        transition: color var(--transition), border-color var(--transition), transform var(--transition);
    }
    .btn-outline:hover { color: var(--navy); border-color: var(--navy); transform: translateY(-2px); }

    /* KPI aside */
    .kpi-cluster {
        display: none; grid-template-columns: 1fr 1fr;
        gap: 10px; width: 240px; flex: 0 0 240px;
        animation: fadeDown .8s .26s ease both;
    }
    .kpi-cell {
        background: var(--surface); border: 1.5px solid var(--border);
        border-radius: var(--radius); padding: 20px 16px;
        text-align: center; box-shadow: var(--shadow);
        position: relative; overflow: hidden;
        transform-origin: center bottom;
        animation: floatY 7s ease-in-out infinite;
    }
    .kpi-cell:nth-child(2) { animation-delay: .35s; }
    .kpi-cell:nth-child(3) { animation-delay: .7s; }
    .kpi-cell:nth-child(4) { animation-delay: 1.05s; }
    .kpi-cell:hover { animation-play-state: paused; }
    .kpi-cell:hover strong { color: var(--blue); }
    .kpi-cell:hover span { color: var(--ink2); }
    .kpi-cell strong,
    .kpi-cell span { transition: color .22s ease; }
    .strip {
        background: linear-gradient(100deg, #131A2D 10%, #1F2844 58%, #FF5A3D 140%);
        padding: 18px 0; margin: 0;
        position: relative;
    }
    .strip::after {
        content: '';
        position: absolute;
        left: 0;
        right: 0;
        bottom: -1px;
        height: 10px;
        background: linear-gradient(90deg, rgba(249,115,102,.35), rgba(255,255,255,0), rgba(12,168,160,.35));
    }
    .kpi-cell::before {
        content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px;
        background: linear-gradient(90deg, var(--blue), var(--teal));
    }
    .kpi-cell strong {
        display: block; font-family: 'Syne', sans-serif;
        font-size: 1.6rem; font-weight: 800; color: var(--navy); line-height: 1.1; margin-bottom: 4px;
    }
    .kpi-cell span { font-size: .72rem; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .06em; }

    /* ── DIVIDER STRIP ───────────────────────────────────────────────── */
    .strip-inner {
        display: flex; align-items: center; gap: 32px; flex-wrap: wrap;
        justify-content: center;
    }
    .strip-stat {
        display: flex; align-items: center; gap: 10px; color: rgba(255,255,255,.8);
        font-size: .82rem; font-weight: 600; letter-spacing: .05em; text-transform: uppercase;
    }
    .strip-stat strong { color: #fff; font-family: 'Syne', sans-serif; font-size: 1.35rem; font-weight: 800; }
    .strip-sep { color: rgba(255,255,255,.25); font-size: 1.4rem; }

    /* ── SECTION WRAPPERS ─────────────────────────────────────────────── */
    .section-block { padding: 80px 0; }
    .section-block + .section-block {
        border-top: 1px solid rgba(15,42,92,.06);
    }
    .section-eyebrow {
        display: inline-flex; align-items: center; gap: 7px;
        font-size: .7rem; font-weight: 700; letter-spacing: .14em; text-transform: uppercase;
        color: var(--ink2); background: linear-gradient(90deg, #FFFFFF, #FFF5F2);
        border-radius: 999px; padding: 4px 12px;
        margin-bottom: 14px;
        border: 1px solid rgba(255,90,61,.24);
        box-shadow: 0 8px 20px rgba(255,90,61,.1);
    }
    .section-eyebrow i { font-size: .6rem; }
    .section-title {
        font-family: 'Syne', sans-serif;
        font-size: clamp(1.7rem, 3.2vw, 2.4rem);
        font-weight: 800; letter-spacing: -.025em;
        color: var(--ink); margin: 0 0 10px; line-height: 1.1;
    }
    .section-title .accent {
        color: transparent;
        background: linear-gradient(130deg, var(--coral) 0%, #FF8A52 45%, var(--gold) 100%);
        -webkit-background-clip: text;
        background-clip: text;
    }
    .section-sub {
        color: var(--muted); font-size: .96rem; line-height: 1.75;
        max-width: 540px; margin: 0 0 40px;
    }
    .section-hdr { margin-bottom: 40px; }
    .section-hdr-row { display: flex; align-items: flex-end; justify-content: space-between; gap: 20px; flex-wrap: wrap; }

    /* ── CARD BASE ────────────────────────────────────────────────────── */
    .card {
        background:
            linear-gradient(180deg, rgba(255,255,255,.94), rgba(255,255,255,.98)),
            var(--surface);
        border: 1.5px solid var(--border);
        border-radius: var(--radius); box-shadow: var(--shadow);
        transition: transform var(--transition), box-shadow var(--transition), border-color var(--transition);
        position: relative;
        overflow: hidden;
    }
    .card::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(30,83,208,.05), transparent 40%, rgba(12,168,160,.04));
        pointer-events: none;
        opacity: .65;
    }
    .card:hover {
        transform: translateY(-6px) rotate(-.35deg);
        box-shadow: var(--shadow-lg);
        border-color: var(--border2);
    }

    /* ── SERVICES ─────────────────────────────────────────────────────── */
    .services-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
    .svc-card { padding: 24px; display: flex; flex-direction: column; gap: 10px; }
    .svc-icon {
        width: 46px; height: 46px; border-radius: 12px;
        display: grid; place-items: center;
        background: var(--blue-light); color: var(--blue);
        font-size: 1.1rem; flex-shrink: 0;
        box-shadow: inset 0 -10px 20px rgba(30,83,208,.08);
    }
    .svc-tag {
        font-size: .68rem; font-weight: 700; letter-spacing: .09em;
        text-transform: uppercase; color: var(--teal);
    }
    .svc-card h4 { margin: 0; font-size: .98rem; font-weight: 700; color: var(--ink2); line-height: 1.3; }
    .svc-card p  { margin: 0; color: var(--muted); font-size: .88rem; line-height: 1.7; }

    /* ── PROJECTS ─────────────────────────────────────────────────────── */
    .projects-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
    .proj-card { padding: 24px; display: flex; flex-direction: column; min-height: 210px; }
    .proj-sector {
        display: flex; align-items: center; gap: 8px; margin-bottom: 10px; flex-wrap: wrap;
    }
    .proj-sector-icon {
        width: 32px; height: 32px; border-radius: 9px;
        display: grid; place-items: center;
        background: var(--blue-light); color: var(--blue);
        font-size: .8rem; flex-shrink: 0;
        box-shadow: inset 0 -8px 14px rgba(30,83,208,.08);
    }
    .proj-badge-pill {
        font-size: .68rem; font-weight: 700; color: var(--muted);
        background: var(--bg2); border-radius: 999px;
        padding: 3px 10px; border: 1px solid var(--border);
    }
    .proj-card h4 {
        margin: 0 0 8px; font-size: .97rem; font-weight: 700;
        color: var(--ink2); line-height: 1.35;
        display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;
    }
    .proj-card > p {
        flex: 1; color: var(--muted); font-size: .88rem; line-height: 1.65; margin: 0 0 14px;
        display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden;
    }
    .proj-link {
        display: inline-flex; align-items: center; gap: 7px; margin-top: auto;
        font-size: .8rem; font-weight: 700; color: var(--blue); text-decoration: none;
    }
    .proj-link:hover { color: var(--navy); gap: 10px; }

    /* ── TECH TICKER ──────────────────────────────────────────────────── */
    .tech-ticker { position: relative; overflow: hidden; padding: 4px 0; }
    .tech-ticker::before, .tech-ticker::after {
        content: ''; position: absolute; top: 0; bottom: 0; width: 90px; z-index: 2; pointer-events: none;
    }
    .tech-ticker::before { left: 0;  background: linear-gradient(90deg,  var(--bg), transparent); }
    .tech-ticker::after  { right: 0; background: linear-gradient(270deg, var(--bg), transparent); }
    .tech-track {
        display: flex; align-items: stretch; gap: 10px;
        width: max-content; animation: tickerRoll 50s linear infinite;
    }
    .tech-ticker:hover .tech-track { animation-play-state: paused; }
    .tech-chip {
        display: inline-flex; align-items: center; gap: 10px; flex: 0 0 auto;
        background: var(--surface); border: 1.5px solid var(--border);
        border-radius: 12px; padding: 11px 15px; min-width: 144px;
        transition: border-color var(--transition), transform var(--transition), box-shadow var(--transition);
        box-shadow: 0 1px 4px rgba(0,0,0,.04);
    }
    .tech-chip:hover { border-color: var(--blue-mid); transform: translateY(-2px); box-shadow: var(--shadow); }
    .tech-chip img  { width: 32px; height: 32px; object-fit: contain; flex: 0 0 auto; }
    .tech-chip span { font-size: .77rem; font-weight: 700; color: var(--muted); }

    /* ── CLIENT TICKER ────────────────────────────────────────────────── */
    .client-ticker { position: relative; overflow: hidden; padding: 4px 0; }
    .client-ticker::before, .client-ticker::after {
        content: ''; position: absolute; top: 0; bottom: 0; width: 90px; z-index: 2; pointer-events: none;
    }
    .client-ticker::before { left: 0;  background: linear-gradient(90deg,  var(--bg), transparent); }
    .client-ticker::after  { right: 0; background: linear-gradient(270deg, var(--bg), transparent); }
    .client-track {
        display: flex; align-items: stretch; gap: 12px;
        width: max-content; animation: tickerRoll 58s linear infinite;
    }
    .client-ticker:hover .client-track { animation-play-state: paused; }
    .client-pill {
        flex: 0 0 auto; width: 224px; min-height: 74px;
        display: flex; align-items: center; gap: 12px;
        background: var(--surface); border: 1.5px solid var(--border);
        border-radius: 14px; padding: 14px 16px;
        box-shadow: 0 1px 4px rgba(0,0,0,.04);
        transition: border-color var(--transition), transform var(--transition), box-shadow var(--transition);
    }
    .client-pill:hover { border-color: var(--blue-mid); transform: translateY(-2px); box-shadow: var(--shadow); }
    .client-avatar {
        width: 38px; height: 38px; flex: 0 0 38px;
        border-radius: 9px; display: grid; place-items: center;
        background: var(--navy); color: #fff;
        font-size: .7rem; font-weight: 800; font-family: 'Syne', sans-serif;
        letter-spacing: .04em;
    }
    .client-name-el { font-size: .88rem; font-weight: 700; color: var(--ink2); line-height: 1.3; }

    /* ── STAGES ───────────────────────────────────────────────────────── */
    .stages-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
    .stage-card { padding: 24px; display: flex; flex-direction: column; }
    .stage-chips { display: flex; gap: 6px; margin-bottom: 14px; flex-wrap: wrap; }
    .chip {
        display: inline-flex; align-items: center; gap: 5px;
        font-size: .68rem; font-weight: 700; letter-spacing: .04em;
        border-radius: 999px; padding: 4px 10px;
    }
    .chip-teal   { color: var(--teal); background: var(--teal-light); border: 1px solid rgba(12,168,160,.2); }
    .chip-blue   { color: var(--blue); background: var(--blue-light); border: 1px solid rgba(30,83,208,.2); }
    .chip-gold   { color: var(--gold); background: var(--gold-light); border: 1px solid rgba(217,119,6,.2); }
    .stage-card h4 { margin: 0 0 8px; font-size: .97rem; font-weight: 700; color: var(--ink2); line-height: 1.3; }
    .stage-card p  { flex: 1; color: var(--muted); font-size: .88rem; line-height: 1.65; margin: 0 0 12px; }
    .stage-meta    { font-size: .78rem; color: var(--dim); margin-bottom: 6px; display: flex; align-items: center; gap: 6px; }
    .stage-meta i  { color: var(--blue); }
    .link-arrow {
        display: inline-flex; align-items: center; gap: 7px; margin-top: auto;
        text-decoration: none; color: var(--blue); font-size: .84rem; font-weight: 700;
        transition: gap var(--transition), color var(--transition);
    }
    .link-arrow:hover { color: var(--navy); gap: 10px; }

    /* ── PRICING ──────────────────────────────────────────────────────── */
    .pricing-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(268px, 1fr)); gap: 18px; }
    .price-card { padding: 28px; display: flex; flex-direction: column; position: relative; overflow: hidden; }
    .price-card::after {
        content: '';
        position: absolute;
        right: -32px;
        top: -32px;
        width: 120px;
        height: 120px;
        border-radius: 999px;
        background: radial-gradient(circle, rgba(30,83,208,.14), transparent 70%);
        pointer-events: none;
    }
    .price-card.featured {
        background: linear-gradient(145deg, #151B2E 0%, #27355B 62%, #FF5A3D 140%) !important;
        border-color: #202944 !important;
        color: #fff;
        box-shadow: 0 18px 46px rgba(15,42,92,.3);
    }
    .price-card.featured .price-desc,
    .price-card.featured .price-tier-unit,
    .price-card.featured .price-features li { color: rgba(255,255,255,.7); }
    .price-card.featured .price-tier { background: rgba(255,255,255,.08); border-color: rgba(255,255,255,.15); }
    .price-card.featured .price-tier-label.monthly { color: #7DD3FC; }
    .price-card.featured .price-tier-label.annual { color: #5EEAD4; }
    .price-card.featured .price-tier-label.once { color: #FCD34D; }
    .price-card.featured .price-tier-amount.monthly { color: #fff; }
    .price-card.featured .price-tier-amount.annual { color: #fff; }
    .price-card.featured .price-tier-amount.once { color: #fff; }
    .price-card.featured .price-app-name { color: #fff; }
    .price-card.featured .price-features li i { color: #5EEAD4; }
    .price-badge-tag {
        position: absolute; top: -1px; right: 22px;
        background: linear-gradient(135deg, var(--coral), var(--gold)); color: #fff;
        font-size: .65rem; font-weight: 800; letter-spacing: .08em; text-transform: uppercase;
        padding: 5px 13px; border-radius: 0 0 10px 10px;
    }
    .price-plan-icon {
        width: 48px; height: 48px; border-radius: 13px;
        display: grid; place-items: center;
        background: var(--blue-light); color: var(--blue);
        font-size: 1.15rem; margin-bottom: 14px; flex-shrink: 0;
    }
    .price-plan-name {
        font-family: 'Syne', sans-serif; font-size: 1.15rem; font-weight: 800;
        color: var(--ink); margin: 0 0 8px; letter-spacing: -.02em;
    }
    .price-card.featured .price-plan-name { color: #fff; }
    .price-desc { color: var(--muted); font-size: .84rem; margin: 0 0 22px; line-height: 1.65; }
    .price-card.featured .price-desc { color: rgba(255,255,255,.7); }
    .price-amount-block {
        display: flex; align-items: baseline; gap: 6px;
        margin-bottom: 22px; padding-bottom: 20px;
        border-bottom: 1.5px solid var(--border);
    }
    .price-card.featured .price-amount-block { border-color: rgba(255,255,255,.15); }
    .price-amount {
        font-family: 'Syne', sans-serif; font-size: 2.4rem; font-weight: 800;
        color: var(--ink); line-height: 1; letter-spacing: -.03em;
    }
    .price-card.featured .price-amount { color: #fff; }
    .price-unit {
        font-size: .88rem; font-weight: 700; color: var(--muted); line-height: 1.3;
    }
    .price-unit .price-period { font-weight: 500; font-size: .8rem; display: block; }
    .price-card.featured .price-unit { color: rgba(255,255,255,.7); }
    .price-features { list-style: none; padding: 0; margin: 0 0 22px; flex: 1; }
    .price-features li {
        display: flex; align-items: flex-start; gap: 9px;
        font-size: .86rem; color: var(--muted); padding: 6px 0;
        border-bottom: 1px solid var(--border); line-height: 1.5;
    }
    .price-features li:last-child { border-bottom: 0; }
    .price-features li i { color: var(--teal); font-size: .78rem; margin-top: 3px; flex-shrink: 0; }
    .price-card.featured .price-features li { color: rgba(255,255,255,.75); border-color: rgba(255,255,255,.1); }
    .price-card.featured .price-features li i { color: #5EEAD4; }
    .price-cta {
        display: flex; align-items: center; justify-content: center; gap: 8px;
        text-decoration: none; border-radius: 999px; padding: 12px 20px;
        font-size: .88rem; font-weight: 700; margin-top: auto;
        transition: transform var(--transition), box-shadow var(--transition), background var(--transition);
    }
    .price-cta.featured-cta { background: #fff; color: var(--navy); }
    .price-cta.featured-cta:hover { background: var(--blue-light); transform: translateY(-1px); }
    .price-cta.ghost-cta { background: var(--navy); color: #fff; }
    .price-cta.ghost-cta:hover {
        background: linear-gradient(135deg, var(--navy), var(--blue), var(--coral));
        transform: translateY(-2px);
        box-shadow: 0 8px 24px rgba(30,83,208,.25);
    }
    .pricing-note {
        margin-top: 28px; text-align: center;
        font-size: .84rem; color: var(--dim);
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .pricing-note i { color: var(--blue); }

    /* ── TESTIMONIALS ─────────────────────────────────────────────────── */
    .testi-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 14px; }
    .testi-card { padding: 24px; position: relative; overflow: hidden; }
    .testi-quote {
        font-family: Georgia, serif; font-size: 3.5rem; line-height: 1;
        color: var(--blue-light); position: absolute; top: 14px; right: 18px;
        pointer-events: none; user-select: none;
    }
    .testi-top { display: flex; align-items: center; gap: 12px; margin-bottom: 14px; }
    .testi-avatar { width: 42px; height: 42px; border-radius: 12px; object-fit: cover; border: 1.5px solid var(--border); flex: 0 0 auto; }
    .testi-avatar-fb {
        width: 42px; height: 42px; border-radius: 12px; flex: 0 0 auto;
        display: grid; place-items: center;
        background: var(--navy); color: #fff;
        font-size: .72rem; font-weight: 800; font-family: 'Syne', sans-serif;
    }
    .testi-name { margin: 0; font-size: .92rem; font-weight: 700; color: var(--ink2); }
    .testi-role { margin: 2px 0 0; font-size: .75rem; color: var(--muted); }
    .testi-stars { color: #F59E0B; font-size: .7rem; margin-bottom: 6px; }
    .testi-msg { margin: 0; font-size: .88rem; color: var(--muted); line-height: 1.75; font-style: italic; position: relative; z-index: 1; }

    /* ── CONTACT / FORMS ──────────────────────────────────────────────── */
    .two-col { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    .info-panel {
        background: var(--navy); border-radius: var(--radius); padding: 36px;
        color: rgba(255,255,255,.85);
    }
    .info-panel h3 {
        font-family: 'Syne', sans-serif;
        font-size: 1.25rem; font-weight: 800; letter-spacing: -.02em;
        color: #fff; margin: 0 0 16px; display: flex; align-items: center; gap: 10px;
    }
    .info-panel h3 i { color: rgba(255,255,255,.6); }
    .info-panel p { font-size: .9rem; line-height: 1.72; margin: 0 0 10px; }
    .info-panel p i { color: rgba(255,255,255,.5); margin-right: 8px; width: 16px; text-align: center; }
    .info-panel .contact-item {
        display: flex; align-items: center; gap: 10px; margin-bottom: 10px;
        font-size: .9rem;
    }
    .info-panel .contact-item i {
        width: 34px; height: 34px; background: rgba(255,255,255,.1);
        border-radius: 8px; display: grid; place-items: center; flex-shrink: 0;
        font-size: .85rem;
    }
    .form-panel {
        background: var(--surface); border: 1.5px solid var(--border);
        border-radius: var(--radius); padding: 32px; box-shadow: var(--shadow);
    }
    .form-panel h3 {
        font-family: 'Syne', sans-serif;
        font-size: 1.1rem; font-weight: 800; letter-spacing: -.02em;
        color: var(--ink); margin: 0 0 20px;
    }
    .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 10px; margin-bottom: 10px; }
    .form-field { margin-bottom: 10px; }
    .form-field label { display: block; font-size: .76rem; font-weight: 700; color: var(--muted); letter-spacing: .06em; text-transform: uppercase; margin-bottom: 5px; }
    .form-field input, .form-field textarea, .form-field select {
        width: 100%; background: var(--bg); border: 1.5px solid var(--border);
        border-radius: var(--radius-sm); padding: 11px 14px;
        font: inherit; font-size: .9rem; color: var(--ink);
        transition: border-color var(--transition), background var(--transition);
    }
    .form-field input::placeholder, .form-field textarea::placeholder { color: var(--dim); }
    .form-field input:focus, .form-field textarea:focus {
        outline: none; border-color: var(--blue); background: #fff;
    }
    .form-panel button[type="submit"] {
        width: 100%; border: 0; border-radius: 999px; padding: 13px;
        background: linear-gradient(135deg, var(--coral), #FF7B41); color: #fff;
        font: 700 .92rem 'DM Sans', sans-serif; cursor: pointer;
        box-shadow: 0 8px 24px rgba(255,90,61,.3);
        transition: background var(--transition), transform var(--transition), box-shadow var(--transition);
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .form-panel button[type="submit"]:hover { filter: brightness(1.05); transform: translateY(-2px); box-shadow: 0 12px 30px rgba(255,90,61,.34); }
    .flash-ok {
        background: var(--teal-light); border: 1px solid rgba(12,168,160,.25);
        border-radius: 9px; padding: 10px 14px; margin-bottom: 14px;
        color: var(--teal); font-size: .86rem;
        display: flex; align-items: center; gap: 8px;
    }

    /* ── TOGGLE / SHOW MORE ───────────────────────────────────────────── */
    .more-items { display: none; }
    .more-items.open { display: contents; }
    .show-more-wrap { text-align: center; margin-top: 24px; }
    .show-more-btn {
        display: inline-flex; align-items: center; gap: 9px;
        background: var(--surface); border: 1.5px solid var(--border2);
        color: var(--muted); border-radius: 999px;
        padding: 10px 28px; font: 600 .88rem 'DM Sans', sans-serif;
        cursor: pointer; text-decoration: none;
        box-shadow: 0 1px 4px rgba(0,0,0,.06);
        transition: color var(--transition), border-color var(--transition), transform var(--transition);
    }
    .show-more-btn:hover {
        color: var(--navy);
        border-color: rgba(30,83,208,.35);
        background: linear-gradient(90deg, #fff, var(--blue-light));
        transform: translateY(-1px);
    }

    /* ── CTA BANNER ───────────────────────────────────────────────────── */
    .cta-banner {
        background: linear-gradient(140deg, #0B224D 0%, #13377A 54%, #0CA8A0 120%);
        border-radius: 24px; padding: 56px 48px;
        display: flex; align-items: center; justify-content: space-between;
        gap: 32px; flex-wrap: wrap; margin: 0 0 80px;
        position: relative; overflow: hidden;
        border: 1px solid rgba(255,255,255,.12);
        box-shadow: 0 18px 46px rgba(15,42,92,.24);
    }
    .cta-banner::before {
        content: ''; position: absolute; right: -80px; top: -80px;
        width: 320px; height: 320px; border-radius: 999px;
        background: radial-gradient(circle, rgba(79,120,224,.3), transparent 65%);
        pointer-events: none;
    }
    .cta-banner-text { position: relative; z-index: 1; }
    .cta-banner-text h3 {
        font-family: 'Syne', sans-serif; font-size: clamp(1.5rem, 3vw, 2rem);
        font-weight: 800; color: #fff; letter-spacing: -.025em;
        margin: 0 0 10px; line-height: 1.15;
    }
    .cta-banner-text p { color: rgba(255,255,255,.7); font-size: .96rem; margin: 0; }
    .cta-banner-actions { display: flex; gap: 12px; flex-wrap: wrap; position: relative; z-index: 1; }
    .btn-white {
        display: inline-flex; align-items: center; gap: 9px;
        background: #fff; color: var(--navy);
        border-radius: 999px; padding: 13px 26px;
        font-size: .9rem; font-weight: 700; text-decoration: none;
        transition: background var(--transition), transform var(--transition);
        border: 0; cursor: pointer;
        box-shadow: 0 12px 30px rgba(11,34,77,.35);
    }
    .btn-white:hover { background: var(--blue-light); transform: translateY(-2px); }
    .btn-white-outline {
        display: inline-flex; align-items: center; gap: 9px;
        background: transparent; color: rgba(255,255,255,.9);
        border-radius: 999px; padding: 12px 26px;
        font-size: .9rem; font-weight: 600; text-decoration: none;
        border: 1.5px solid rgba(255,255,255,.35);
        transition: border-color var(--transition), color var(--transition), transform var(--transition);
    }
    .btn-white-outline:hover { border-color: #fff; color: #fff; transform: translateY(-2px); }

    /* ── FOOTER ───────────────────────────────────────────────────────── */
    .site-footer {
        border-top: 1.5px solid var(--border); padding: 28px 0;
        display: flex; align-items: center; justify-content: space-between;
        flex-wrap: wrap; gap: 14px;
    }
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
        letter-spacing: .01em;
        box-shadow: 0 14px 28px rgba(255,90,61,.35);
        transform: translateY(10px);
        opacity: 0;
        pointer-events: none;
        transition: transform .22s ease, opacity .22s ease, filter .22s ease;
    }
    .floating-cta.visible {
        opacity: 1;
        transform: translateY(0);
        pointer-events: auto;
    }
    .floating-cta:hover { filter: brightness(1.04); }
    .site-footer p { margin: 0; color: var(--dim); font-size: .83rem; }
    .footer-links { display: flex; gap: 22px; }
    .footer-links a {
        text-decoration: none; color: var(--muted); font-size: .82rem; font-weight: 600;
        transition: color var(--transition);
    }
    .footer-links a:hover { color: var(--navy); }

    /* ── ANIMATIONS ───────────────────────────────────────────────────── */
    @keyframes fadeUp    { from { opacity:0; transform: translateY(18px); } to { opacity:1; transform: translateY(0); } }
    @keyframes fadeDown  { from { opacity:0; transform: translateY(-24px); } to { opacity:1; transform: translateY(0); } }
    @keyframes tickerRoll{ from { transform: translateX(0); } to { transform: translateX(calc(-50% - 5px)); } }
    @keyframes pulse     { 0%,100% { opacity:1; } 50% { opacity:.4; } }
    @keyframes floatY    { 0%,100% { transform: translateY(0); } 50% { transform: translateY(-4px); } }

    /* ── SCROLL REVEAL ────────────────────────────────────────────────── */
    .reveal { opacity: 0; transform: translateY(-20px); transition: opacity .6s ease, transform .6s ease; }
    .reveal.visible { opacity: 1; transform: translateY(0); }
    .services-grid .card,
    .projects-grid .card,
    .pricing-grid .card,
    .stages-grid .card,
    .testi-grid .card {
        opacity: 0;
        transform: translateY(-18px);
        animation: fadeDown .65s ease forwards;
    }
    .services-grid .card:nth-child(2), .projects-grid .card:nth-child(2), .pricing-grid .card:nth-child(2), .stages-grid .card:nth-child(2), .testi-grid .card:nth-child(2) { animation-delay: .08s; }
    .services-grid .card:nth-child(3), .projects-grid .card:nth-child(3), .pricing-grid .card:nth-child(3), .stages-grid .card:nth-child(3), .testi-grid .card:nth-child(3) { animation-delay: .16s; }
    .services-grid .card:nth-child(n+4), .projects-grid .card:nth-child(n+4), .pricing-grid .card:nth-child(n+4), .stages-grid .card:nth-child(n+4), .testi-grid .card:nth-child(n+4) { animation-delay: .22s; }

    /* ── RESPONSIVE ───────────────────────────────────────────────────── */
    @media (max-width: 960px) {
        .hero { grid-template-columns: 1fr; padding: 60px 0 40px; }
        .hero-left { padding: 24px 22px 20px; }
        .kpi-cluster { width: 100%; grid-template-columns: repeat(4, 1fr); flex: none; }
        .services-grid, .projects-grid, .stages-grid, .testi-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 680px) {
        .services-grid, .projects-grid, .stages-grid, .testi-grid { grid-template-columns: 1fr; }
        .two-col { grid-template-columns: 1fr; }
        .kpi-cluster { grid-template-columns: repeat(2, 1fr); }
        .form-row { grid-template-columns: 1fr; }
        .topbar-inner { flex-wrap: wrap; row-gap: 8px; }
        .menu-toggle { display: inline-flex; }
        .top-nav {
            display: none; width: 100%; justify-content: flex-start;
            gap: 4px; padding-top: 6px; border-top: 1px solid var(--border);
        }
        .top-nav a::after { left: 8px; right: 8px; }
        .top-nav.open { display: flex; flex-wrap: wrap; }
        .hero h2 { font-size: 2rem; }
        .hero-proof { grid-template-columns: 1fr; }
        .section-title { font-size: 1.55rem; }
        .cta-banner { padding: 36px 24px; }
        .strip-sep { display: none; }
        .strip-inner { gap: 18px; }
        .floating-cta {
            right: 12px;
            left: 12px;
            bottom: 12px;
            justify-content: center;
        }
    }
    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after { animation: none !important; transition: none !important; }
        .tech-track, .client-track { transform: none !important; }
    }
    </style>
</head>
<body>
@php $companyLogo = asset('images/image.png'); @endphp

{{-- ═══ TOPBAR ══════════════════════════════════════════════════════════════ --}}
<header class="topbar">
    <div class="wrap topbar-inner">
        <a href="{{ route('home') }}" class="brand">
            <div class="brand-mark">
                @if($companyLogo)
                    <img src="{{ $companyLogo }}" alt="{{ $company->name ?? 'KAS' }}">
                @else
                    <span>KAS</span>
                @endif
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
            <a href="#services">Services</a>
            <a href="#projects">Projets</a>
            <a href="#technologies">Stack</a>
            <a href="#clients">Clients</a>
            @if(isset($stages) && $stages->count())
                <a href="#stages">Stages</a>
            @endif
            <a href="#pricing">Tarifs</a>
            @if($testimonials->count())
                <a href="#temoignages">Avis</a>
            @endif
            <a href="#contact" class="cta"><i class="fa-solid fa-paper-plane"></i> Contact</a>
        </nav>
    </div>
</header>

{{-- ═══ HERO ════════════════════════════════════════════════════════════════ --}}
<div class="wrap">
    <section class="hero">
        <div class="hero-left">
            <div class="hero-eyebrow">
                <span class="dot"></span>
                Solutions digitales sur mesure
            </div>
            <h2>
                Livraison digitale<br>
                <span class="underline-em">professionnelle</span><br>
                <span class="accent-text">& performante.</span>
            </h2>
            <p class="hero-desc">{{ $company->description ?? 'Nous créons des plateformes web qui accélèrent votre acquisition, améliorent votre taux de conversion et réduisent vos délais opérationnels.' }}</p>
            <div class="hero-actions">
                <a href="#contact" class="btn-primary">
                    <i class="fa-solid fa-rocket"></i> Booster ma croissance
                </a>
                <a href="#projects" class="btn-outline">
                    Voir nos realisations <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            <div class="hero-proof">
                <div class="hero-proof-item">
                    <strong>+50 projets</strong>
                    <span>Livrés avec succès</span>
                </div>
                <div class="hero-proof-item">
                    <strong>100% orienté ROI</strong>
                    <span>Décisions pilotées par la performance</span>
                </div>
                <div class="hero-proof-item">
                    <strong>30 min</strong>
                    <span>Pour cadrer vos priorités business</span>
                </div>
                <div class="hero-proof-item">
                    <strong>11</strong>
                    <span>References secteurs critiques</span>
                </div>
            </div>
        </div>
    </section>
</div>

{{-- ═══ STRIP STATS ══════════════════════════════════════════════════════════ --}}
<div class="strip">
    <div class="wrap strip-inner">
        <div class="strip-stat"><strong>+50</strong> Projets livrés</div>
        <div class="strip-sep">&bull;</div>
        <div class="strip-stat"><strong>10+</strong> Années d'expérience</div>
        <div class="strip-sep">&bull;</div>
        <div class="strip-stat"><strong>15+</strong> Experts mobilisés</div>
        <div class="strip-sep">&bull;</div>
        <div class="strip-stat"><strong>5</strong> Pays clients</div>
        <div class="strip-sep">&bull;</div>
        <div class="strip-stat"><strong>100%</strong> Projets livrés à temps</div>
    </div>
</div>

<main class="wrap">

    {{-- ═══ SERVICES ════════════════════════════════════════════════════════ --}}
    <section id="services" class="section-block reveal">
        <div class="section-hdr">
            <div class="section-eyebrow"><i class="fa-solid fa-circle-dot"></i> Expertise</div>
            <div class="section-hdr-row">
                <div>
                    <h3 class="section-title">Nos <span class="accent">services</span></h3>
                    <p class="section-sub">Des services pensés pour générer plus de leads, améliorer l'expérience client et sécuriser votre passage à l'échelle.</p>
                </div>
                @if($services->count() > 3)
                <button class="show-more-btn" onclick="toggleList('svc-more', this)" style="margin-bottom:40px;">
                    <i class="fa-solid fa-chevron-down"></i> Voir tout
                </button>
                @endif
            </div>
        </div>
        <div class="services-grid">
            @foreach($services as $i => $service)
                @php
                    $svcTag = match($service->slug) {
                        'architecture-technique-et-modernisation'  => 'Architecture & conseil',
                        'web-app-development'                       => 'Build',
                        'devops-cicd-cloud'                         => 'DevOps & Cloud',
                        'mobile-app-development'                    => 'Mobile',
                        'migration-angular-et-front-enterprise'     => 'Front-end enterprise',
                        'back-end-enterprise-et-migration-java'     => 'Back-end enterprise',
                        'securite-iam-et-conformite'                => 'Securite & IAM',
                        'workflow-bpm-et-integration-camunda'       => 'BPM & Automatisation',
                        'plateformes-rh-et-paie'                    => 'Solutions metier',
                        'logistique-et-gestion-des-flux'            => 'Operations',
                        'ia-recrutement-et-ocr'                     => 'IA appliquee',
                        'audit-performance-et-fiabilite'            => 'Audit & remediation',
                        default => 'Expertise digitale',
                    };
                @endphp
                @if($i < 3)
                <article class="card svc-card">
                    <div class="svc-icon"><i class="{{ $service->icon_class ?: 'fa-solid fa-code' }}"></i></div>
                    <div class="svc-tag">{{ $svcTag }}</div>
                    <h4>{{ $service->title }}</h4>
                    <p>{{ $service->description ?: $service->short_desc }}</p>
                </article>
                @endif
            @endforeach
            <div class="more-items" id="svc-more">
                @foreach($services as $i => $service)
                    @php
                        $svcTag = match($service->slug) {
                            'architecture-technique-et-modernisation'  => 'Architecture & conseil',
                            'web-app-development'                       => 'Build',
                            'devops-cicd-cloud'                         => 'DevOps & Cloud',
                            'mobile-app-development'                    => 'Mobile',
                            'migration-angular-et-front-enterprise'     => 'Front-end enterprise',
                            'back-end-enterprise-et-migration-java'     => 'Back-end enterprise',
                            'securite-iam-et-conformite'                => 'Securite & IAM',
                            'workflow-bpm-et-integration-camunda'       => 'BPM & Automatisation',
                            'plateformes-rh-et-paie'                    => 'Solutions metier',
                            'logistique-et-gestion-des-flux'            => 'Operations',
                            'ia-recrutement-et-ocr'                     => 'IA appliquee',
                            'audit-performance-et-fiabilite'            => 'Audit & remediation',
                            default => 'Expertise digitale',
                        };
                    @endphp
                    @if($i >= 3)
                    <article class="card svc-card">
                        <div class="svc-icon"><i class="{{ $service->icon_class ?: 'fa-solid fa-code' }}"></i></div>
                        <div class="svc-tag">{{ $svcTag }}</div>
                        <h4>{{ $service->title }}</h4>
                        <p>{{ $service->description ?: $service->short_desc }}</p>
                    </article>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ PROJECTS ════════════════════════════════════════════════════════ --}}
    <section id="projects" class="section-block reveal">
        <div class="section-hdr">
            <div class="section-eyebrow"><i class="fa-solid fa-circle-dot"></i> Portfolio</div>
            <div class="section-hdr-row">
                <div>
                    <h3 class="section-title">Projets <span class="accent">à la une</span></h3>
                    <p class="section-sub">Des cas concrets orientés impact: productivité renforcée, parcours clients fluidifiés et performance mesurable.</p>
                </div>
                @if($projects->count() > 3)
                <button class="show-more-btn" onclick="toggleList('proj-more', this)" style="margin-bottom:40px;">
                    <i class="fa-solid fa-chevron-down"></i> Voir tout
                </button>
                @endif
            </div>
        </div>
        <div class="projects-grid">
            @foreach($projects as $i => $project)
                @php
                    $sectorName = $project->sector->name ?? 'Secteur non defini';
                    $sectorDisplayName = match($sectorName) {
                        'Gestion hoteliere et reservation'         => 'Hotellerie',
                        'Construction'                              => 'Construction',
                        'E-learning'                                => 'Formation digitale',
                        'Genie industriel de l air et ventilation' => 'Industrie & ventilation',
                        'Finance et conformite'                     => 'Finance & conformite',
                        'Secteur public et institutionnel'          => 'Secteur public',
                        'Ressources humaines et paie'               => 'RH & paie',
                        'Logistique et transport'                   => 'Logistique & transport',
                        'Workflow et BPM'                           => 'Workflow & BPM',
                        'Performance industrielle et TQM'           => 'Performance industrielle',
                        'Aeronautique et securite aeroportuaire'    => 'Aeronautique',
                        'Gestion commerciale et stock'              => 'Gestion commerciale',
                        'Recrutement et IA'                         => 'Recrutement & IA',
                        default => $sectorName,
                    };
                    $t = \Illuminate\Support\Str::lower($sectorName);
                    $companyMentions = [
                        'La Banque Postale','Banque Postale','LBP',
                        'Banque de France - BCE','Banque de France','BDF-BCE','BDF','BCE',
                        'Symolia Technologies','Symolia','MAS GROUP','OUIMIND',
                        'Tunivisions Foundation','Tunivisions','KARRAY GROUP','BFI GROUP',
                        'InnovATM','AbrarCom','GLOBAL PAYMENT GATEWAY','InfoSquare',
                        'Centre Coaching RH','Air Filters Engineering',
                    ];
                    $displayTitle = trim(trim((string) preg_replace('/\s+/', ' ', str_ireplace($companyMentions, '', $project->title))), " -,:;");
                    $displayDesc  = trim(trim((string) preg_replace('/\s+/', ' ', str_ireplace($companyMentions, '', $project->description ?: $project->short_desc))), " -,:;");
                    $icon = match(true) {
                        str_contains($t,'hotel')||str_contains($t,'reservation') => 'fa-solid fa-hotel',
                        str_contains($t,'construction')                           => 'fa-solid fa-building',
                        str_contains($t,'learning')||str_contains($t,'formation') => 'fa-solid fa-graduation-cap',
                        str_contains($t,'finance')||str_contains($t,'bancaire')   => 'fa-solid fa-chart-line',
                        str_contains($t,'public')||str_contains($t,'institutionnel') => 'fa-solid fa-landmark',
                        str_contains($t,'logistique')||str_contains($t,'transport') => 'fa-solid fa-truck-fast',
                        str_contains($t,'rh')||str_contains($t,'ressources')      => 'fa-solid fa-users-gear',
                        str_contains($t,'recrutement')||str_contains($t,'ia')     => 'fa-solid fa-brain',
                        str_contains($t,'workflow')||str_contains($t,'bpm')       => 'fa-solid fa-diagram-project',
                        str_contains($t,'aeronautique')||str_contains($t,'aeroport') => 'fa-solid fa-plane',
                        str_contains($t,'stock')||str_contains($t,'commerciale')  => 'fa-solid fa-boxes-stacked',
                        default => 'fa-solid fa-diagram-project',
                    };
                @endphp
                @if($i < 3)
                <article class="card proj-card">
                    <div class="proj-sector">
                        <div class="proj-sector-icon"><i class="{{ $icon }}"></i></div>
                        <span class="proj-badge-pill">{{ $sectorDisplayName }}</span>
                    </div>
                    <h4>{{ $displayTitle ?: $project->title }}</h4>
                    <p>{{ $displayDesc ?: ($project->description ?: $project->short_desc) }}</p>
                    <span class="proj-link"><i class="fa-solid fa-arrow-trend-up"></i> Solution sur mesure</span>
                </article>
                @endif
            @endforeach
            <div class="more-items" id="proj-more">
                @foreach($projects as $i => $project)
                    @php
                        $sectorName = $project->sector->name ?? 'Secteur non defini';
                        $sectorDisplayName = match($sectorName) {
                            'Gestion hoteliere et reservation'         => 'Hotellerie',
                            'Construction'                              => 'Construction',
                            'E-learning'                                => 'Formation digitale',
                            'Genie industriel de l air et ventilation' => 'Industrie & ventilation',
                            'Finance et conformite'                     => 'Finance & conformite',
                            'Secteur public et institutionnel'          => 'Secteur public',
                            'Ressources humaines et paie'               => 'RH & paie',
                            'Logistique et transport'                   => 'Logistique & transport',
                            'Workflow et BPM'                           => 'Workflow & BPM',
                            'Performance industrielle et TQM'           => 'Performance industrielle',
                            'Aeronautique et securite aeroportuaire'    => 'Aeronautique',
                            'Gestion commerciale et stock'              => 'Gestion commerciale',
                            'Recrutement et IA'                         => 'Recrutement & IA',
                            default => $sectorName,
                        };
                        $t = \Illuminate\Support\Str::lower($sectorName);
                        $companyMentions = [
                            'La Banque Postale','Banque Postale','LBP',
                            'Banque de France - BCE','Banque de France','BDF-BCE','BDF','BCE',
                            'Symolia Technologies','Symolia','MAS GROUP','OUIMIND',
                            'Tunivisions Foundation','Tunivisions','KARRAY GROUP','BFI GROUP',
                            'InnovATM','AbrarCom','GLOBAL PAYMENT GATEWAY','InfoSquare',
                            'Centre Coaching RH','Air Filters Engineering',
                        ];
                        $displayTitle = trim(trim((string) preg_replace('/\s+/', ' ', str_ireplace($companyMentions, '', $project->title))), " -,:;");
                        $displayDesc  = trim(trim((string) preg_replace('/\s+/', ' ', str_ireplace($companyMentions, '', $project->description ?: $project->short_desc))), " -,:;");
                        $icon = match(true) {
                            str_contains($t,'hotel')||str_contains($t,'reservation') => 'fa-solid fa-hotel',
                            str_contains($t,'construction')                           => 'fa-solid fa-building',
                            str_contains($t,'learning')||str_contains($t,'formation') => 'fa-solid fa-graduation-cap',
                            str_contains($t,'finance')||str_contains($t,'bancaire')   => 'fa-solid fa-chart-line',
                            str_contains($t,'public')||str_contains($t,'institutionnel') => 'fa-solid fa-landmark',
                            str_contains($t,'logistique')||str_contains($t,'transport') => 'fa-solid fa-truck-fast',
                            str_contains($t,'rh')||str_contains($t,'ressources')      => 'fa-solid fa-users-gear',
                            str_contains($t,'recrutement')||str_contains($t,'ia')     => 'fa-solid fa-brain',
                            str_contains($t,'workflow')||str_contains($t,'bpm')       => 'fa-solid fa-diagram-project',
                            str_contains($t,'aeronautique')||str_contains($t,'aeroport') => 'fa-solid fa-plane',
                            str_contains($t,'stock')||str_contains($t,'commerciale')  => 'fa-solid fa-boxes-stacked',
                            default => 'fa-solid fa-diagram-project',
                        };
                    @endphp
                    @if($i >= 3)
                    <article class="card proj-card">
                        <div class="proj-sector">
                            <div class="proj-sector-icon"><i class="{{ $icon }}"></i></div>
                            <span class="proj-badge-pill">{{ $sectorDisplayName }}</span>
                        </div>
                        <h4>{{ $displayTitle ?: $project->title }}</h4>
                        <p>{{ $displayDesc ?: ($project->description ?: $project->short_desc) }}</p>
                        <span class="proj-link"><i class="fa-solid fa-arrow-trend-up"></i> Solution sur mesure</span>
                    </article>
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ TECHNOLOGIES ════════════════════════════════════════════════════ --}}
    <section id="technologies" class="section-block reveal">
        <div class="section-hdr">
            <div class="section-eyebrow"><i class="fa-solid fa-circle-dot"></i> Stack technique</div>
            <h3 class="section-title">Technologies <span class="accent">maîtrisées</span></h3>
            <p class="section-sub">Une stack robuste pour livrer plus vite, maintenir la qualité et soutenir vos objectifs de croissance.</p>
        </div>
        @php
            $technologies = [
                ['icon'=>'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original.svg','label'=>'Java / JEE'],
                ['icon'=>'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/spring/spring-original.svg','label'=>'Spring Boot'],
                ['icon'=>'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/angularjs/angularjs-original.svg','label'=>'Angular'],
                ['icon'=>'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg','label'=>'Docker'],
                ['icon'=>'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/kubernetes/kubernetes-plain.svg','label'=>'Kubernetes'],
                ['icon'=>'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/jenkins/jenkins-original.svg','label'=>'Jenkins'],
                ['icon'=>'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/gitlab/gitlab-original.svg','label'=>'GitLab CI/CD'],
                ['icon'=>'https://cdn.simpleicons.org/keycloak/0078D4','label'=>'Keycloak / IAM'],
                ['icon'=>'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg','label'=>'PostgreSQL'],
                ['icon'=>'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg','label'=>'MySQL'],
                ['icon'=>'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg','label'=>'Laravel'],
                ['icon'=>'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg','label'=>'Python / IA'],
                ['icon'=>'https://cdn.simpleicons.org/camunda/FC5D0D','label'=>'Camunda BPM'],
                ['icon'=>'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nginx/nginx-original.svg','label'=>'NGINX'],
                ['icon'=>'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg','label'=>'Git / Gitflow'],
                ['icon'=>'https://cdn.simpleicons.org/apachetomcat','label'=>'Apache Tomcat'],
            ];
        @endphp
        <div class="tech-ticker" aria-label="Technologies">
            <div class="tech-track">
                @foreach([0,1] as $loop)
                    @foreach($technologies as $tech)
                        <div class="tech-chip" @if($loop===1) aria-hidden="true" @endif>
                            <img src="{{ $tech['icon'] }}" alt="{{ $tech['label'] }}" loading="lazy">
                            <span>{{ $tech['label'] }}</span>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ CLIENTS ═════════════════════════════════════════════════════════ --}}
    <section id="clients" class="section-block reveal">
        <div class="section-hdr">
            <div class="section-eyebrow"><i class="fa-solid fa-circle-dot"></i> Références</div>
            <h3 class="section-title">Ils nous font <span class="accent">confiance</span></h3>
            <p class="section-sub">Des marques ambitieuses nous confient leurs objectifs d'acquisition, de performance et de transformation digitale.</p>
        </div>
        @php
            $displayClients = $clients->reject(fn($c) => in_array($c->name, ['Symolia Technologies','OUIMIND','InfoSquare']))->values();
        @endphp
        <div class="client-ticker" aria-label="Clients">
            <div class="client-track">
                @foreach([0,1] as $loop)
                    @foreach($displayClients as $client)
                        @php
                            $pts = preg_split('/\s+/', trim($client->name));
                            $ini = collect($pts)->filter()->take(2)->map(fn($p)=>strtoupper(substr($p,0,1)))->implode('');
                        @endphp
                        <div class="client-pill" @if($loop===1) aria-hidden="true" @endif>
                            <div class="client-avatar">{{ $ini }}</div>
                            <div class="client-name-el">{{ $client->name }}</div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>

    {{-- ═══ STAGES ══════════════════════════════════════════════════════════ --}}
    @if(isset($stages) && $stages->count())
    <section id="stages" class="section-block reveal">
        <div class="section-hdr">
            <div class="section-eyebrow"><i class="fa-solid fa-circle-dot"></i> Opportunités</div>
            <div class="section-hdr-row">
                <div>
                    <h3 class="section-title">Offres de <span class="accent">stage</span></h3>
                    <p class="section-sub">Participez à des projets à fort impact business, encadrés par des experts produit, design et développement.</p>
                </div>
                <a href="{{ route('stages.index') }}" class="show-more-btn" style="margin-bottom:40px;">
                    <i class="fa-solid fa-list"></i> Toutes les offres
                </a>
            </div>
        </div>
        <div class="stages-grid">
            @foreach($stages as $stage)
            <div class="card stage-card">
                <div class="stage-chips">
                    <span class="chip chip-teal"><i class="fa-solid fa-tag"></i> {{ $stage->domaine }}</span>
                    <span class="chip chip-blue">{{ $stage->type_stage }}</span>
                </div>
                <h4>{{ $stage->titre }}</h4>
                <p>{{ Str::limit($stage->description, 130) }}</p>
                @if($stage->niveau_requis)
                <div class="stage-meta"><i class="fa-solid fa-user-graduate"></i> {{ $stage->niveau_requis }}</div>
                @endif
                @if($stage->date_limite)
                <div class="stage-meta"><i class="fa-solid fa-calendar-day"></i> Limite : {{ $stage->date_limite->format('d/m/Y') }}</div>
                @endif
                <a href="{{ route('stages.show', $stage->slug) }}" class="link-arrow">
                    Postuler <i class="fa-solid fa-arrow-right"></i>
                </a>
            </div>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ═══ PRICING ═════════════════════════════════════════════════════════ --}}
    @if(isset($pricingPlans) && $pricingPlans->count())
    <section id="pricing" class="section-block reveal">
        <div class="section-hdr">
            <div class="section-eyebrow"><i class="fa-solid fa-circle-dot"></i> Tarification</div>
            <h3 class="section-title">Nos <span class="accent">formules</span></h3>
            <p class="section-sub">Des formules claires pour maîtriser vos coûts et accélérer votre déploiement. Chaque offre couvre <strong>KAS Déclaration</strong>, <strong>KAS Facturation</strong> et <strong>KAS Médicale</strong>.</p>
        </div>
        <div class="pricing-grid">
            @foreach($pricingPlans as $plan)
            @php
                $iconStyle = match($plan->type) {
                    'annuel'  => 'background:rgba(255,255,255,.15);color:#fff;',
                    'licence' => 'background:var(--gold-light);color:var(--gold);',
                    default   => '',
                };
            @endphp
            <div class="card price-card {{ $plan->is_featured ? 'featured' : '' }}">
                @if($plan->badge)
                    <div class="price-badge-tag">{{ $plan->badge }}</div>
                @endif
                <div class="price-plan-icon" @if($iconStyle) style="{{ $iconStyle }}" @endif>
                    <i class="{{ $plan->icone() }}"></i>
                </div>
                <h4 class="price-plan-name">{{ $plan->typeLabel() }}</h4>
                @if($plan->description)
                    <p class="price-desc">{{ $plan->description }}</p>
                @endif
                <div class="price-amount-block">
                    <span class="price-amount">{{ number_format($plan->prix, 0, ',', ' ') }}</span>
                    <span class="price-unit">DT <span class="price-period">{{ $plan->prixPeriode() }}</span></span>
                </div>
                @php $features = $plan->fonctionnalitesArray(); @endphp
                @if(count($features))
                <ul class="price-features">
                    @foreach($features as $feat)
                    <li><i class="fa-solid fa-circle-check"></i><span>{{ $feat }}</span></li>
                    @endforeach
                </ul>
                @endif
                <a href="#contact" class="price-cta {{ $plan->is_featured ? 'featured-cta' : 'ghost-cta' }}">
                    <i class="fa-solid fa-envelope"></i> Demander un devis
                </a>
            </div>
            @endforeach
        </div>
        {{-- Note applicabilité --}}
        <div class="pricing-note">
            <i class="fa-solid fa-info-circle"></i>
            Ces tarifs s'appliquent à chaque solution. Besoin d'un pack multi-applications ? Nous construisons une offre optimisée pour votre ROI.
        </div>
    </section>
    @endif

    {{-- ═══ TESTIMONIALS ════════════════════════════════════════════════════ --}}
    @if($testimonials->count())
    <section id="temoignages" class="section-block reveal">
        <div class="section-hdr">
            <div class="section-eyebrow"><i class="fa-solid fa-circle-dot"></i> Avis clients</div>
            <h3 class="section-title">Ce que nos clients <span class="accent">disent</span></h3>
            <p class="section-sub">Des résultats tangibles: plus de visibilité, plus d'efficacité et un impact business suivi par des indicateurs clairs.</p>
        </div>
        <div class="testi-grid">
            @foreach($testimonials->take(3) as $testimonial)
                @php
                    $pts2 = preg_split('/\s+/', trim($testimonial->client_name ?? 'Client'));
                    $ini2 = collect($pts2)->filter()->take(2)->map(fn($p)=>strtoupper(substr($p,0,1)))->implode('');
                    $rl   = trim(collect([$testimonial->client_role,$testimonial->company])->filter()->implode(' — '));
                @endphp
                <article class="card testi-card">
                    <div class="testi-quote">&ldquo;</div>
                    <div class="testi-stars">
                        <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                    </div>
                    <div class="testi-top">
                        @if(!empty($testimonial->avatar_url))
                            <img class="testi-avatar" src="{{ $testimonial->avatar_url }}" alt="{{ $testimonial->client_name }}">
                        @else
                            <div class="testi-avatar-fb">{{ $ini2 ?: 'CL' }}</div>
                        @endif
                        <div>
                            <p class="testi-name">{{ $testimonial->client_name }}</p>
                            @if($rl) <p class="testi-role">{{ $rl }}</p> @endif
                        </div>
                    </div>
                    <p class="testi-msg">&ldquo;{{ $testimonial->message }}&rdquo;</p>
                </article>
            @endforeach
        </div>
    </section>
    @endif

    {{-- ═══ CTA BANNER ══════════════════════════════════════════════════════ --}}
    <div class="cta-banner reveal">
        <div class="cta-banner-text">
            <h3>Prêt à transformer<br>votre trafic en clients ?</h3>
            <p>Audit express de 30 minutes pour identifier vos leviers de conversion prioritaires.</p>
        </div>
        <div class="cta-banner-actions">
            <a href="#contact" class="btn-white">
                <i class="fa-solid fa-rocket"></i> Réserver un audit
            </a>
            <a href="#projects" class="btn-white-outline">
                Voir nos réalisations <i class="fa-solid fa-arrow-right"></i>
            </a>
        </div>
    </div>

    {{-- ═══ TESTIMONIAL FORM ════════════════════════════════════════════════ --}}
    <section class="section-block reveal">
        <div class="two-col">
            <div class="info-panel">
                <h3><i class="fa-solid fa-comment-dots"></i> Votre témoignage compte</h3>
                <p>Votre expérience avec KAS inspire de futurs projets. Partagez votre succès pour renforcer la confiance de nos prochains partenaires.</p>
                <p>Chaque témoignage met en lumière l'impact concret de nos solutions sur la performance métier.</p>
            </div>
            <form class="form-panel" method="POST" action="{{ route('testimonial.store') }}">
                @csrf
                <h3>Laissez un avis</h3>
                @if(session('testimonial_success'))
                    <div class="flash-ok"><i class="fa-solid fa-circle-check"></i> {{ session('testimonial_success') }}</div>
                @endif
                <div class="form-row">
                    <div class="form-field">
                        <label>Nom complet</label>
                        <input type="text" name="client_name" placeholder="Jean Dupont" required>
                    </div>
                    <div class="form-field">
                        <label>Poste / Fonction</label>
                        <input type="text" name="client_role" placeholder="Directeur technique">
                    </div>
                </div>
                <div class="form-field">
                    <label>Entreprise</label>
                    <input type="text" name="company" placeholder="Nom de votre entreprise">
                </div>
                <div class="form-field">
                    <label>Votre témoignage</label>
                    <textarea rows="4" name="message" placeholder="Décrivez votre expérience avec KAS..." required></textarea>
                </div>
                <button type="submit"><i class="fa-solid fa-star"></i> Soumettre le témoignage</button>
            </form>
        </div>
    </section>

    {{-- ═══ CONTACT ══════════════════════════════════════════════════════════ --}}
    <section id="contact" class="section-block reveal">
        <div class="two-col">
            <div class="info-panel">
                <h3><i class="fa-solid fa-address-book"></i> Parlons de votre projet</h3>
                <p>Que ce soit pour un nouveau projet, une migration, une sécurisation ou une optimisation — notre équipe est disponible.</p>
                @if($company->address ?? null)
                <div class="contact-item"><i class="fa-solid fa-location-dot"></i> {{ $company->address }}</div>
                @endif
                @if($company->email ?? null)
                <div class="contact-item"><i class="fa-solid fa-envelope"></i> {{ $company->email }}</div>
                @endif
                @if($company->phone ?? null)
                <div class="contact-item"><i class="fa-solid fa-phone"></i> {{ $company->phone }}</div>
                @endif
            </div>
            <form class="form-panel" method="POST" action="{{ route('contact.store') }}">
                @csrf
                <h3>Envoyez-nous un message</h3>
                @if(session('success'))
                    <div class="flash-ok"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
                @endif
                <div class="form-row">
                    <div class="form-field">
                        <label>Nom complet</label>
                        <input type="text" name="fullname" placeholder="Jean Dupont" required>
                    </div>
                    <div class="form-field">
                        <label>Téléphone</label>
                        <input type="tel" name="phone" placeholder="+216 XX XXX XXX" required>
                    </div>
                </div>
                <div class="form-field">
                    <label>Email</label>
                    <input type="email" name="email" placeholder="contact@votreentreprise.com" required>
                </div>
                <div class="form-field">
                    <label>Votre projet</label>
                    <textarea rows="4" name="message" placeholder="Décrivez votre projet ou votre besoin..." required></textarea>
                </div>
                <button type="submit"><i class="fa-solid fa-paper-plane"></i> Envoyer le message</button>
            </form>
        </div>
    </section>

</main>

{{-- ═══ FOOTER ═══════════════════════════════════════════════════════════════ --}}
<footer class="wrap site-footer">
    <p>&copy; {{ date('Y') }} {{ $company->name ?? 'KAS Technology' }} &mdash; Tous droits réservés.</p>
    <nav class="footer-links">
        <a href="#services">Services</a>
        <a href="#projects">Projets</a>
        @if(isset($stages) && $stages->count())<a href="{{ route('stages.index') }}">Stages</a>@endif
        <a href="#pricing">Tarifs</a>
        <a href="#contact">Contact</a>
    </nav>
</footer>

<a href="#contact" class="floating-cta" id="floatingCta" aria-label="Réserver un audit">
    <i class="fa-solid fa-bolt"></i>
    Réserver un audit
</a>

<script>
/* ── TOGGLE ─────────────────────────────────────────────────────────── */
function toggleList(id, btn) {
    var el   = document.getElementById(id);
    var open = el.classList.toggle('open');
    btn.innerHTML = open
        ? '<i class="fa-solid fa-chevron-up"></i> Réduire'
        : '<i class="fa-solid fa-chevron-down"></i> Voir tout';
    if (!open) btn.closest('section').scrollIntoView({ behavior:'smooth', block:'start' });
}

/* ── MOBILE MENU ────────────────────────────────────────────────────── */
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

/* ── SCROLL REVEAL ──────────────────────────────────────────────────── */
(function () {
    if (!('IntersectionObserver' in window)) {
        document.querySelectorAll('.reveal').forEach(function(el){ el.classList.add('visible'); });
        return;
    }
    var obs = new IntersectionObserver(function(entries) {
        entries.forEach(function(e) {
            if (e.isIntersecting) { e.target.classList.add('visible'); obs.unobserve(e.target); }
        });
    }, { threshold: 0.12 });
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
