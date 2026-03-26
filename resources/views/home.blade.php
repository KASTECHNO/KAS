<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $company->name ?? 'KAS Technology' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --bg: #eef2ff; --surface: #fff; --ink: #0b1324;
            --muted: #4f5d75; --line: #d8e0f2;
            --primary: #0a66c2; --secondary: #0f766e;
            --radius: 16px; --shadow: 0 16px 40px rgba(11,19,36,.08);
        }
        *, *::before, *::after { box-sizing: border-box; }
        body {
            margin: 0; font-family: 'Manrope', sans-serif; color: var(--ink);
            background: radial-gradient(circle at 0% 0%, #dbeafe 0, transparent 30%),
                        radial-gradient(circle at 100% 0%, #ccfbf1 0, transparent 26%), var(--bg);
        }
        .wrap { width: min(1200px, 94vw); margin: 0 auto; }
        .topbar {
            position: sticky; top: 0; z-index: 20;
            border-bottom: 1px solid var(--line);
            backdrop-filter: blur(10px);
            background: rgba(238,242,255,.85);
        }
        .topbar-inner { display: flex; justify-content: space-between; align-items: center; padding: 13px 0; }
        .brand h1 { margin: 0; font-size: 1.15rem; }
        .brand p  { margin: 2px 0 0; color: var(--muted); font-size: .88rem; }
        .hero {
            display: grid; grid-template-columns: 1.2fr .8fr;
            gap: 20px; align-items: stretch;
            padding: 60px 0 28px; animation: fadeUp .7s ease both;
        }
        .panel { background: var(--surface); border: 1px solid var(--line); border-radius: var(--radius); box-shadow: var(--shadow); padding: 22px; }
        .pill { display: inline-flex; align-items: center; gap: 8px; background: #dbeafe; color: #1d4ed8; border-radius: 999px; padding: 7px 12px; font-size: .84rem; margin-bottom: 10px; }
        .hero h2 { font-size: clamp(1.7rem, 3.8vw, 3rem); margin: 0; line-height: 1.12; }
        .hero p  { color: var(--muted); font-size: .98rem; line-height: 1.65; }
        .stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: 10px; }
        .stat { border: 1px solid var(--line); border-radius: 12px; background: #f8fbff; padding: 12px; }
        .stat strong { display: block; font-size: 1.2rem; }
        .stat span   { color: var(--muted); font-size: .86rem; }
        section { padding: 18px 0; }
        .head { display: flex; justify-content: space-between; align-items: flex-end; margin-bottom: 12px; }
        .head h3 { margin: 0; font-size: 1.4rem; }
        .head h3 i { margin-right: 8px; color: var(--primary); }
        .head p  { margin: 0; color: var(--muted); font-size: .9rem; }
        .grid { display: grid; gap: 12px; }
        .cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .card { background: var(--surface); border: 1px solid var(--line); border-radius: 14px; padding: 14px; box-shadow: var(--shadow); transition: transform .26s ease, box-shadow .26s ease; }
        .card:hover { transform: translateY(-4px); box-shadow: 0 24px 38px rgba(11,19,36,.12); }
        .card > i { width: 36px; height: 36px; border-radius: 10px; display: grid; place-items: center; background: #e2e8f0; color: var(--primary); margin-bottom: 8px; }
        .card h4 { margin: 0 0 6px; font-size: 1rem; }
        .card p  { margin: 0; color: var(--muted); line-height: 1.5; font-size: .9rem; }
        .service-card { position: relative; overflow: hidden; }
        .service-card::after { content: ''; position: absolute; inset: auto -30px -30px auto; width: 110px; height: 110px; border-radius: 999px; background: radial-gradient(circle, rgba(10,102,194,.08), transparent 68%); }
        .service-head { display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 10px; }
        .service-head > i { width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; background: linear-gradient(135deg, #dbeafe, #ccfbf1); color: var(--primary); margin: 0; position: relative; z-index: 1; }
        .service-tag { display: inline-flex; align-items: center; gap: 6px; font-size: .74rem; color: #1e3a8a; background: #eef2ff; border: 1px solid #c7d2fe; border-radius: 999px; padding: 4px 9px; position: relative; z-index: 1; }
        .service-card h4 { position: relative; z-index: 1; margin-bottom: 8px; }
        .service-card p { position: relative; z-index: 1; margin-bottom: 10px; }
        .service-note { position: relative; z-index: 1; display: inline-flex; align-items: center; gap: 6px; font-size: .8rem; color: #0f766e; font-weight: 600; }
        .project-badge { display: inline-flex; align-items: center; gap: 6px; font-size: .76rem; color: #334155; background: #eef2ff; border: 1px solid #dbeafe; border-radius: 999px; padding: 5px 10px; white-space: nowrap; }
        .proj-card { position: relative; display: flex; flex-direction: column; min-height: 230px; padding: 18px; overflow: hidden; }
        .proj-card::after { content: ''; position: absolute; top: -36px; right: -26px; width: 110px; height: 110px; border-radius: 999px; background: radial-gradient(circle, rgba(15,118,110,.10), transparent 68%); }
        .proj-top { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; gap: 10px; margin-bottom: 14px; flex-wrap: nowrap; }
        .proj-kicker { display: inline-flex; align-items: center; gap: 6px; font-size: .72rem; letter-spacing: .06em; text-transform: uppercase; color: #0f766e; font-weight: 700; white-space: nowrap; }
        .proj-card h4 { position: relative; z-index: 1; margin: 0 0 10px; font-size: 1.05rem; line-height: 1.35; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .proj-card > p { position: relative; z-index: 1; display: -webkit-box; -webkit-line-clamp: 4; -webkit-box-orient: vertical; overflow: hidden; flex: 1; margin: 0 0 14px; color: var(--muted); line-height: 1.6; font-size: .91rem; }
        .proj-note { position: relative; z-index: 1; display: inline-flex; align-items: center; gap: 7px; font-size: .82rem; font-weight: 600; color: #1d4ed8; }
        .client-slider { position: relative; overflow: hidden; padding: 6px 0; }
        .client-slider::before, .client-slider::after { content: ''; position: absolute; top: 0; bottom: 0; width: 56px; z-index: 2; pointer-events: none; }
        .client-slider::before { left: 0; background: linear-gradient(90deg, var(--bg), rgba(238,242,255,0)); }
        .client-slider::after { right: 0; background: linear-gradient(270deg, var(--bg), rgba(238,242,255,0)); }
        .client-track { display: flex; align-items: stretch; gap: 14px; width: max-content; animation: clientMarquee 56s linear infinite; }
        .client-slider:hover .client-track { animation-play-state: paused; }
        .client-card { position: relative; flex: 0 0 auto; width: 250px; background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%); border: 1px solid var(--line); border-radius: 16px; min-height: 96px; padding: 16px; display: flex; flex-direction: column; justify-content: center; align-items: center; overflow: hidden; transition: transform .24s ease, border-color .24s ease, box-shadow .24s ease; }
        .client-card::before { content: ''; position: absolute; inset: 0 auto auto 0; width: 100%; height: 4px; background: linear-gradient(90deg, #0a66c2, #0f766e); }
        .client-card::after { content: ''; position: absolute; right: -18px; bottom: -18px; width: 92px; height: 92px; border-radius: 999px; background: radial-gradient(circle, rgba(10,102,194,.07), transparent 68%); }
        .client-card:hover { transform: translateY(-4px); border-color: #b6c7ee; box-shadow: 0 18px 34px rgba(11,19,36,.10); }
        .client-top { position: relative; z-index: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 10px; text-align: center; }
        .client-mark { width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; background: linear-gradient(135deg, #dbeafe, #ccfbf1); color: #0a66c2; font-size: .82rem; font-weight: 800; letter-spacing: .04em; flex: 0 0 auto; }
        .client-meta { display: flex; flex-direction: column; gap: 3px; min-width: 0; align-items: center; }
        .client-name { margin: 0; font-size: .98rem; line-height: 1.35; font-weight: 800; color: var(--ink); }
        .client-note { display: none; }
        .tech-slider { position: relative; overflow: hidden; padding: 6px 0; }
        .tech-slider::before, .tech-slider::after { content: ''; position: absolute; top: 0; bottom: 0; width: 56px; z-index: 2; pointer-events: none; }
        .tech-slider::before { left: 0; background: linear-gradient(90deg, var(--bg), rgba(238,242,255,0)); }
        .tech-slider::after { right: 0; background: linear-gradient(270deg, var(--bg), rgba(238,242,255,0)); }
        .tech-track { display: flex; align-items: stretch; gap: 12px; width: max-content; animation: techMarquee 52s linear infinite; }
        .tech-slider:hover .tech-track { animation-play-state: paused; }
        .tech-item { flex: 0 0 auto; min-width: 156px; background: #fff; border: 1px solid var(--line); border-radius: 12px; min-height: 86px; padding: 14px 16px; display: inline-flex; align-items: center; gap: 12px; text-align: left; transition: transform .24s ease, box-shadow .24s ease; animation: floatIn .6s ease both; }
        .tech-item:hover { transform: translateY(-4px); box-shadow: 0 14px 28px rgba(10,102,194,.16); }
        .tech-item img  { width: 38px; height: 38px; object-fit: contain; flex: 0 0 auto; }
        .tech-item span { display: block; font-size: .8rem; color: var(--muted); margin-top: 0; font-weight: 700; line-height: 1.35; }
        .testimonials-grid { display: grid; gap: 12px; grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .testimonial-card { position: relative; border: 1px solid var(--line); border-radius: 14px; background: linear-gradient(180deg, #ffffff 0%, #f8fbff 100%); box-shadow: var(--shadow); padding: 16px; overflow: hidden; }
        .testimonial-card::after { content: ''; position: absolute; right: -20px; bottom: -22px; width: 96px; height: 96px; border-radius: 999px; background: radial-gradient(circle, rgba(15,118,110,.10), transparent 70%); }
        .testimonial-top { position: relative; z-index: 1; display: flex; align-items: center; gap: 10px; margin-bottom: 10px; }
        .testimonial-avatar { width: 42px; height: 42px; border-radius: 12px; object-fit: cover; border: 1px solid #c8d6f3; background: #fff; }
        .testimonial-avatar-fallback { width: 42px; height: 42px; border-radius: 12px; display: grid; place-items: center; font-size: .78rem; font-weight: 800; letter-spacing: .04em; color: #0a66c2; background: linear-gradient(135deg, #dbeafe, #ccfbf1); }
        .testimonial-name { margin: 0; font-size: .92rem; font-weight: 800; color: var(--ink); line-height: 1.3; }
        .testimonial-role { margin: 1px 0 0; font-size: .78rem; color: var(--muted); }
        .testimonial-message { position: relative; z-index: 1; margin: 0; font-size: .9rem; color: #334155; line-height: 1.6; font-style: italic; }
        .contact { display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 28px; }
        .form input, .form textarea { width: 100%; border: 1px solid #cbd5e1; border-radius: 10px; padding: 10px 12px; font: inherit; margin-bottom: 9px; }
        .form .field { position: relative; }
        .form .field i { position: absolute; left: 11px; top: 12px; color: #64748b; font-size: .88rem; }
        .form .field input, .form .field textarea { padding-left: 34px; }
        .form button { border: 0; border-radius: 10px; padding: 10px 14px; font: inherit; background: var(--secondary); color: #fff; font-weight: 700; cursor: pointer; width: 100%; }
        .form-note { margin: 0 0 10px; font-size: .82rem; color: var(--muted); background: #f8fbff; border: 1px solid var(--line); border-radius: 10px; padding: 8px 10px; }
        .more-items { display: none; }
        .more-items.open { display: contents; }
        .toggle-wrap { text-align: center; margin-top: 14px; }
        .toggle-btn { display: inline-flex; align-items: center; gap: 8px; background: #eef2ff; color: #1d4ed8; border: 1px solid #bfdbfe; border-radius: 999px; padding: 8px 22px; font: 600 .9rem 'Manrope', sans-serif; cursor: pointer; transition: background .2s ease, transform .2s ease; }
        .toggle-btn:hover { background: #dbeafe; transform: translateY(-1px); }
        footer { color: var(--muted); font-size: .88rem; padding: 0 0 28px; }
        @keyframes fadeUp  { from {opacity:0;transform:translateY(16px)} to {opacity:1;transform:translateY(0)} }
        @keyframes floatIn { from {opacity:0;transform:translateY(10px) scale(.98)} to {opacity:1;transform:translateY(0) scale(1)} }
        @keyframes techMarquee { from { transform: translateX(0); } to { transform: translateX(calc(-50% - 6px)); } }
        @keyframes clientMarquee { from { transform: translateX(0); } to { transform: translateX(calc(-50% - 7px)); } }
        @media (max-width: 860px) {
            .hero   { grid-template-columns: 1fr; padding: 36px 0 20px; }
            .cols-3 { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .testimonials-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .client-card { width: 220px; min-height: 92px; }
            .tech-item { min-width: 144px; min-height: 78px; padding: 12px 14px; }
            .contact { grid-template-columns: 1fr; }
        }
        @media (max-width: 560px) {
            .brand h1 { font-size: 1rem; }
            .hero h2  { font-size: 1.55rem; }
            .head h3  { font-size: 1.15rem; }
            .cols-3   { grid-template-columns: 1fr; }
            .testimonials-grid { grid-template-columns: 1fr; }
            .client-slider::before, .client-slider::after { width: 28px; }
            .client-track { gap: 10px; animation-duration: 44s; }
            .client-card { width: 190px; min-height: 84px; padding: 14px; }
            .client-mark { width: 36px; height: 36px; border-radius: 10px; font-size: .76rem; }
            .client-name { font-size: .88rem; }
            .tech-slider::before, .tech-slider::after { width: 28px; }
            .tech-track { gap: 10px; animation-duration: 40s; }
            .tech-item { min-width: 132px; min-height: 68px; padding: 10px 12px; gap: 10px; }
            .tech-item img { width: 30px; height: 30px; }
            .tech-item span { font-size: .74rem; }
            .toggle-btn { width: 100%; justify-content: center; border-radius: 10px; }
        }
        @media (prefers-reduced-motion: reduce) { * { animation: none !important; transition: none !important; } .tech-track, .client-track { transform: none !important; } }
    </style>
</head>
<body>
<header class="topbar">
    <div class="wrap topbar-inner">
        <div class="brand">
            <h1>{{ $company->name ?? 'KAS Technology' }}</h1>
            <p>{{ $company->slogan ?? 'Votre vision, notre code...' }}</p>
        </div>
    </div>
</header>
<main class="wrap">
    <section class="hero">
        <article class="panel">
            <span class="pill"><i class="fa-solid fa-bolt"></i> Expertise digitale</span>
            <h2>Livraison digitale professionnelle pour les entreprises ambitieuses</h2>
            <p>{{ $company->description ?? 'Nous creons des solutions de haute qualite sur le web, le mobile et la croissance digitale.' }}</p>
        </article>
        <aside class="panel stats">
            @foreach(($kpis ?? []) as $kpi)
                <div class="stat">
                    <strong>{{ number_format((int) ($kpi->value ?? 0), 0, ',', ' ') }}{{ !empty($kpi->unit) ? ' '.$kpi->unit : '' }}</strong>
                    <span>{{ $kpi->title ?? '' }}</span>
                </div>
            @endforeach
        </aside>
    </section>
    <section>
        <div class="head"><h3><i class="fa-solid fa-screwdriver-wrench"></i>Services</h3><p>Des offres structurees pour concevoir, moderniser et faire evoluer vos produits digitaux.</p></div>
        <div class="grid cols-3">
            @foreach($services as $i => $service)
                @php
                    $serviceTag = match($service->slug) {
                        'architecture-technique-et-modernisation' => 'Conseil & architecture',
                        'web-app-development' => 'Build',
                        'devops-cicd-cloud' => 'Delivery & plateforme',
                        'mobile-app-development' => 'Mobile',
                        'migration-angular-et-front-enterprise' => 'Front-end enterprise',
                        'back-end-enterprise-et-migration-java' => 'Back-end enterprise',
                        'securite-iam-et-conformite' => 'Securite',
                        'workflow-bpm-et-integration-camunda' => 'Automatisation',
                        'plateformes-rh-et-paie' => 'Solutions metier',
                        'logistique-et-gestion-des-flux' => 'Operations',
                        'ia-recrutement-et-ocr' => 'IA appliquee',
                        'audit-performance-et-fiabilite' => 'Audit & remediation',
                        default => 'Expertise digitale',
                    };
                @endphp
                @if($i < 3)
                    <article class="card service-card">
                        <div class="service-head">
                            <i class="{{ $service->icon_class ?: 'fa-solid fa-code' }}"></i>
                            <span class="service-tag">{{ $serviceTag }}</span>
                        </div>
                        <h4>{{ $service->title }}</h4>
                        <p>{{ $service->description ?: $service->short_desc }}</p>
                        <span class="service-note"><i class="fa-solid fa-arrow-right"></i> Approche sur mesure, orientee resultat</span>
                    </article>
                @endif
            @endforeach
            <div class="more-items" id="services-more">
                @foreach($services as $i => $service)
                    @php
                        $serviceTag = match($service->slug) {
                            'architecture-technique-et-modernisation' => 'Conseil & architecture',
                            'web-app-development' => 'Build',
                            'devops-cicd-cloud' => 'Delivery & plateforme',
                            'mobile-app-development' => 'Mobile',
                            'migration-angular-et-front-enterprise' => 'Front-end enterprise',
                            'back-end-enterprise-et-migration-java' => 'Back-end enterprise',
                            'securite-iam-et-conformite' => 'Securite',
                            'workflow-bpm-et-integration-camunda' => 'Automatisation',
                            'plateformes-rh-et-paie' => 'Solutions metier',
                            'logistique-et-gestion-des-flux' => 'Operations',
                            'ia-recrutement-et-ocr' => 'IA appliquee',
                            'audit-performance-et-fiabilite' => 'Audit & remediation',
                            default => 'Expertise digitale',
                        };
                    @endphp
                    @if($i >= 3)
                        <article class="card service-card">
                            <div class="service-head">
                                <i class="{{ $service->icon_class ?: 'fa-solid fa-code' }}"></i>
                                <span class="service-tag">{{ $serviceTag }}</span>
                            </div>
                            <h4>{{ $service->title }}</h4>
                            <p>{{ $service->description ?: $service->short_desc }}</p>
                            <span class="service-note"><i class="fa-solid fa-arrow-right"></i> Approche sur mesure, orientee resultat</span>
                        </article>
                    @endif
                @endforeach
            </div>
        </div>
        @if($services->count() > 3)
        <div class="toggle-wrap"><button class="toggle-btn" onclick="toggleList('services-more', this)"><i class="fa-solid fa-chevron-down"></i> Afficher plus</button></div>
        @endif
    </section>
    <section>
        <div class="head"><h3><i class="fa-solid fa-diagram-project"></i>Projets a la une</h3><p>Une selection de realisations concues pour des environnements metier exigeants.</p></div>
        <div class="grid cols-3">
            @foreach($projects as $i => $project)
                @php
                    $sectorName = $project->sector->name ?? 'Secteur non defini';
                    $sectorDisplayName = match($sectorName) {
                        'Gestion hoteliere et reservation' => 'Hotellerie',
                        'Construction' => 'Construction',
                        'E-learning' => 'Formation digitale',
                        'Genie industriel de l air et ventilation' => 'Industrie & ventilation',
                        'Finance et conformite' => 'Finance & conformite',
                        'Secteur public et institutionnel' => 'Secteur public',
                        'Ressources humaines et paie' => 'RH & paie',
                        'Logistique et transport' => 'Logistique & transport',
                        'Workflow et BPM' => 'Workflow & BPM',
                        'Performance industrielle et TQM' => 'Performance industrielle',
                        'Aeronautique et securite aeroportuaire' => 'Aeronautique',
                        'Gestion commerciale et stock' => 'Gestion commerciale',
                        'Recrutement et IA' => 'Recrutement & IA',
                        default => $sectorName,
                    };
                    $t = \Illuminate\Support\Str::lower($sectorName);
                    $companyMentions = [
                        'La Banque Postale', 'Banque Postale', 'LBP',
                        'Banque de France - BCE', 'Banque de France', 'BDF-BCE', 'BDF', 'BCE',
                        'Symolia Technologies', 'Symolia',
                        'MAS GROUP',
                        'OUIMIND',
                        'Tunivisions Foundation', 'Tunivisions',
                        'KARRAY GROUP',
                        'BFI GROUP',
                        'InnovATM',
                        'AbrarCom',
                        'GLOBAL PAYMENT GATEWAY',
                        'InfoSquare',
                        'Centre Coaching RH',
                        'Air Filters Engineering',
                    ];
                    $displayTitle = trim((string) preg_replace('/\s+/', ' ', str_ireplace($companyMentions, '', $project->title)));
                    $displayDescription = trim((string) preg_replace('/\s+/', ' ', str_ireplace($companyMentions, '', $project->description ?: $project->short_desc)));
                    $displayTitle = trim($displayTitle, " -,:;");
                    $displayDescription = trim($displayDescription, " -,:;");
                    $icon = match(true) {
                        str_contains($t,'hotel')||str_contains($t,'reservation') => 'fa-solid fa-hotel',
                        str_contains($t,'construction')||str_contains($t,'chantier') => 'fa-solid fa-building',
                        str_contains($t,'learning')||str_contains($t,'formation') => 'fa-solid fa-graduation-cap',
                        str_contains($t,'finance')||str_contains($t,'credit')||str_contains($t,'bancaire') => 'fa-solid fa-chart-line',
                        str_contains($t,'public')||str_contains($t,'institutionnel') => 'fa-solid fa-landmark',
                        str_contains($t,'logistique')||str_contains($t,'transport') => 'fa-solid fa-truck-fast',
                        str_contains($t,'rh')||str_contains($t,'ressources') => 'fa-solid fa-users-gear',
                        str_contains($t,'recrutement')||str_contains($t,'ia') => 'fa-solid fa-brain',
                        str_contains($t,'workflow')||str_contains($t,'bpm') => 'fa-solid fa-diagram-project',
                        str_contains($t,'aeronautique')||str_contains($t,'aeroport') => 'fa-solid fa-plane',
                        str_contains($t,'performance')||str_contains($t,'tqm') => 'fa-solid fa-chart-bar',
                        str_contains($t,'stock')||str_contains($t,'commerciale') => 'fa-solid fa-boxes-stacked',
                        default => 'fa-solid fa-diagram-project',
                    };
                @endphp
                @if($i < 3)
                    <article class="card proj-card">
                        <div class="proj-top">
                            <span class="proj-kicker"><i class="fa-solid fa-briefcase"></i> Secteur d activite</span>
                            <span class="project-badge"><i class="{{ $icon }}"></i> {{ $sectorDisplayName }}</span>
                        </div>
                        <h4>{{ $displayTitle ?: $project->title }}</h4>
                        <p>{{ $displayDescription ?: ($project->description ?: $project->short_desc) }}</p>
                        <span class="proj-note"><i class="fa-solid fa-arrow-trend-up"></i> Solution concue pour la performance et la fiabilite</span>
                    </article>
                @endif
            @endforeach
            <div class="more-items" id="projects-more">
                @foreach($projects as $i => $project)
                    @php
                        $sectorName = $project->sector->name ?? 'Secteur non defini';
                        $sectorDisplayName = match($sectorName) {
                            'Gestion hoteliere et reservation' => 'Hotellerie',
                            'Construction' => 'Construction',
                            'E-learning' => 'Formation digitale',
                            'Genie industriel de l air et ventilation' => 'Industrie & ventilation',
                            'Finance et conformite' => 'Finance & conformite',
                            'Secteur public et institutionnel' => 'Secteur public',
                            'Ressources humaines et paie' => 'RH & paie',
                            'Logistique et transport' => 'Logistique & transport',
                            'Workflow et BPM' => 'Workflow & BPM',
                            'Performance industrielle et TQM' => 'Performance industrielle',
                            'Aeronautique et securite aeroportuaire' => 'Aeronautique',
                            'Gestion commerciale et stock' => 'Gestion commerciale',
                            'Recrutement et IA' => 'Recrutement & IA',
                            default => $sectorName,
                        };
                        $t = \Illuminate\Support\Str::lower($sectorName);
                        $companyMentions = [
                            'La Banque Postale', 'Banque Postale', 'LBP',
                            'Banque de France - BCE', 'Banque de France', 'BDF-BCE', 'BDF', 'BCE',
                            'Symolia Technologies', 'Symolia',
                            'MAS GROUP',
                            'OUIMIND',
                            'Tunivisions Foundation', 'Tunivisions',
                            'KARRAY GROUP',
                            'BFI GROUP',
                            'InnovATM',
                            'AbrarCom',
                            'GLOBAL PAYMENT GATEWAY',
                            'InfoSquare',
                            'Centre Coaching RH',
                            'Air Filters Engineering',
                        ];
                        $displayTitle = trim((string) preg_replace('/\s+/', ' ', str_ireplace($companyMentions, '', $project->title)));
                        $displayDescription = trim((string) preg_replace('/\s+/', ' ', str_ireplace($companyMentions, '', $project->description ?: $project->short_desc)));
                        $displayTitle = trim($displayTitle, " -,:;");
                        $displayDescription = trim($displayDescription, " -,:;");
                        $icon = match(true) {
                            str_contains($t,'hotel')||str_contains($t,'reservation') => 'fa-solid fa-hotel',
                            str_contains($t,'construction')||str_contains($t,'chantier') => 'fa-solid fa-building',
                            str_contains($t,'learning')||str_contains($t,'formation') => 'fa-solid fa-graduation-cap',
                            str_contains($t,'finance')||str_contains($t,'credit')||str_contains($t,'bancaire') => 'fa-solid fa-chart-line',
                            str_contains($t,'public')||str_contains($t,'institutionnel') => 'fa-solid fa-landmark',
                            str_contains($t,'logistique')||str_contains($t,'transport') => 'fa-solid fa-truck-fast',
                            str_contains($t,'rh')||str_contains($t,'ressources') => 'fa-solid fa-users-gear',
                            str_contains($t,'recrutement')||str_contains($t,'ia') => 'fa-solid fa-brain',
                            str_contains($t,'workflow')||str_contains($t,'bpm') => 'fa-solid fa-diagram-project',
                            str_contains($t,'aeronautique')||str_contains($t,'aeroport') => 'fa-solid fa-plane',
                            str_contains($t,'performance')||str_contains($t,'tqm') => 'fa-solid fa-chart-bar',
                            str_contains($t,'stock')||str_contains($t,'commerciale') => 'fa-solid fa-boxes-stacked',
                            default => 'fa-solid fa-diagram-project',
                        };
                    @endphp
                    @if($i >= 3)
                        <article class="card proj-card">
                            <div class="proj-top">
                                <span class="proj-kicker"><i class="fa-solid fa-briefcase"></i> Secteur d activite</span>
                                <span class="project-badge"><i class="{{ $icon }}"></i> {{ $sectorDisplayName }}</span>
                            </div>
                            <h4>{{ $displayTitle ?: $project->title }}</h4>
                            <p>{{ $displayDescription ?: ($project->description ?: $project->short_desc) }}</p>
                            <span class="proj-note"><i class="fa-solid fa-arrow-trend-up"></i> Solution concue pour la performance et la fiabilite</span>
                        </article>
                    @endif
                @endforeach
            </div>
        </div>
        @if($projects->count() > 3)
        <div class="toggle-wrap"><button class="toggle-btn" onclick="toggleList('projects-more', this)"><i class="fa-solid fa-chevron-down"></i> Afficher plus</button></div>
        @endif
    </section>
    <section>
        <div class="head"><h3><i class="fa-solid fa-microchip"></i>Technologies maitrisees</h3><p>Un socle technologique maitrise pour concevoir, integrer et industrialiser vos produits digitaux.</p></div>
        @php
            $technologies = [
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original.svg', 'alt' => 'Java', 'label' => 'Java / JEE'],
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/spring/spring-original.svg', 'alt' => 'Spring Boot', 'label' => 'Spring Boot'],
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/angularjs/angularjs-original.svg', 'alt' => 'Angular', 'label' => 'Angular'],
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg', 'alt' => 'Docker', 'label' => 'Docker'],
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/kubernetes/kubernetes-plain.svg', 'alt' => 'Kubernetes', 'label' => 'Kubernetes'],
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/jenkins/jenkins-original.svg', 'alt' => 'Jenkins', 'label' => 'Jenkins'],
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/gitlab/gitlab-original.svg', 'alt' => 'GitLab', 'label' => 'GitLab'],
                ['icon' => 'https://cdn.simpleicons.org/keycloak/0078D4', 'alt' => 'Keycloak', 'label' => 'Keycloak'],
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg', 'alt' => 'PostgreSQL', 'label' => 'PostgreSQL'],
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg', 'alt' => 'MySQL', 'label' => 'MySQL'],
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg', 'alt' => 'Laravel', 'label' => 'Laravel'],
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg', 'alt' => 'PHP', 'label' => 'PHP'],
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/python/python-original.svg', 'alt' => 'Python', 'label' => 'Python / IA'],
                ['icon' => 'https://cdn.simpleicons.org/camunda/FC5D0D', 'alt' => 'Camunda', 'label' => 'Camunda'],
                ['icon' => 'https://cdn.simpleicons.org/apachetomcat', 'alt' => 'Tomcat', 'label' => 'Tomcat'],
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nginx/nginx-original.svg', 'alt' => 'NGINX', 'label' => 'NGINX'],
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg', 'alt' => 'Git', 'label' => 'Git / Gitflow'],
                ['icon' => 'https://cdn.jsdelivr.net/gh/devicons/devicon/icons/java/java-original.svg', 'alt' => 'JavaFX', 'label' => 'JavaFX'],
            ];
        @endphp
        <div class="tech-slider" aria-label="Technologies maitrisees">
            <div class="tech-track">
                @foreach([0, 1] as $loopIndex)
                    @foreach($technologies as $technology)
                        <div class="tech-item" @if($loopIndex === 1) aria-hidden="true" @endif>
                            <img src="{{ $technology['icon'] }}" alt="{{ $technology['alt'] }}">
                            <span>{{ $technology['label'] }}</span>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>
    <section>
        <div class="head"><h3><i class="fa-solid fa-handshake"></i>Clients</h3><p>Des references accompagnees sur des sujets de transformation, modernisation applicative et delivery logiciel.</p></div>
        @php
            $displayClients = $clients->reject(fn ($client) => in_array($client->name, ['Symolia Technologies', 'OUIMIND', 'InfoSquare']))->values();
        @endphp
        <div class="client-slider" aria-label="Clients">
            <div class="client-track">
                @foreach([0, 1] as $loopIndex)
                    @foreach($displayClients as $client)
                        @php
                            $parts = preg_split('/\s+/', trim($client->name));
                            $initials = collect($parts)->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
                        @endphp
                        <article class="client-card" @if($loopIndex === 1) aria-hidden="true" @endif>
                            <div class="client-top">
                                <span class="client-mark">{{ $initials }}</span>
                                <div class="client-meta">
                                    <p class="client-name">{{ $client->name }}</p>
                                </div>
                            </div>
                        </article>
                    @endforeach
                @endforeach
            </div>
        </div>
    </section>

    @if($testimonials->count())
    <section>
        <div class="head"><h3><i class="fa-solid fa-star"></i>Ils nous font confiance</h3><p>Ce que nos clients disent de nous: des resultats concrets, une execution fiable et un impact business mesurable.</p></div>
        <div class="testimonials-grid">
            @foreach($testimonials->take(3) as $testimonial)
                @php
                    $parts = preg_split('/\s+/', trim($testimonial->client_name ?? 'Client'));
                    $initials = collect($parts)->filter()->take(2)->map(fn ($part) => strtoupper(substr($part, 0, 1)))->implode('');
                    $avatar = $testimonial->avatar_url;
                    $roleLine = trim(collect([$testimonial->client_role, $testimonial->company])->filter()->implode(' - '));
                @endphp
                <article class="testimonial-card">
                    <div class="testimonial-top">
                        @if(!empty($avatar))
                            <img class="testimonial-avatar" src="{{ $avatar }}" alt="Avatar {{ $testimonial->client_name }}">
                        @else
                            <span class="testimonial-avatar-fallback">{{ $initials ?: 'CL' }}</span>
                        @endif
                        <div>
                            <p class="testimonial-name">{{ $testimonial->client_name }}</p>
                            @if($roleLine !== '')
                                <p class="testimonial-role">{{ $roleLine }}</p>
                            @endif
                        </div>
                    </div>
                    <p class="testimonial-message">&ldquo;{{ $testimonial->message }}&rdquo;</p>
                </article>
            @endforeach
        </div>
    </section>
    @endif

    <section class="contact">
        <article class="panel">
            <h3 style="margin-top:0;"><i class="fa-solid fa-comment-dots"></i> Votre temoignage compte</h3>
            <p>Votre experience avec KAS inspire de futurs projets. Partagez votre succes pour renforcer la confiance de nos prochains partenaires.</p>
            <p style="color:var(--muted);font-size:.88rem;line-height:1.6;">Chaque temoignage met en lumiere l impact concret de nos solutions sur la performance metier.</p>
        </article>
        <form class="panel form" method="POST" action="{{ route('testimonial.store') }}">
            @csrf
            @if(session('testimonial_success'))
                <div style="background:#d1fae5;border-radius:8px;padding:10px 12px;margin-bottom:10px;color:#065f46;font-size:.88rem;"><i class="fa-solid fa-circle-check"></i> {{ session('testimonial_success') }}</div>
            @endif
            <div class="field"><i class="fa-solid fa-user"></i><input type="text" name="client_name" placeholder="Nom complet" required></div>
            <div class="field"><i class="fa-solid fa-briefcase"></i><input type="text" name="client_role" placeholder="Poste / fonction"></div>
            <div class="field"><i class="fa-solid fa-building"></i><input type="text" name="company" placeholder="Entreprise"></div>
            <div class="field"><i class="fa-solid fa-quote-left"></i><textarea rows="4" name="message" placeholder="Votre temoignage" required></textarea></div>
            <button type="submit"><i class="fa-solid fa-star"></i> Soumettre le temoignage</button>
        </form>
    </section>

    <section class="contact">
        <article class="panel">
            <h3 style="margin-top:0;"><i class="fa-solid fa-address-book"></i> Contact</h3>
            <p><i class="fa-solid fa-location-dot"></i> {{ $company->address ?? '-' }}</p>
            <p><i class="fa-solid fa-envelope"></i> {{ $company->email ?? '-' }}</p>
            <p><i class="fa-solid fa-phone"></i> {{ $company->phone ?? '-' }}</p>
        </article>
        <form class="panel form" method="POST" action="{{ route('contact.store') }}">
            @csrf
            @if(session('success'))
                <div style="background:#d1fae5;border-radius:8px;padding:10px 12px;margin-bottom:10px;color:#065f46;font-size:.88rem;"><i class="fa-solid fa-circle-check"></i> {{ session('success') }}</div>
            @endif
            <div class="field"><i class="fa-solid fa-user"></i><input type="text" name="fullname" placeholder="Nom complet" required></div>
            <div class="field"><i class="fa-solid fa-phone"></i><input type="tel" name="phone" placeholder="Telephone" required></div>
            <div class="field"><i class="fa-solid fa-envelope"></i><input type="email" name="email" placeholder="Email" required></div>
            <div class="field"><i class="fa-solid fa-comment-dots"></i><textarea rows="4" name="message" placeholder="Message" required></textarea></div>
            <button type="submit"><i class="fa-solid fa-paper-plane"></i> Envoyer le message</button>
        </form>
    </section>
</main>
<footer class="wrap">{{ date('Y') }} &copy; {{ $company->name ?? 'KAS Technology' }} &mdash; Tous droits reserves.</footer>
<script>
function toggleList(id, btn) {
    var el = document.getElementById(id);
    var expanded = el.classList.toggle('open');
    btn.innerHTML = expanded ? '<i class="fa-solid fa-chevron-up"></i> Reduire' : '<i class="fa-solid fa-chevron-down"></i> Afficher plus';
    if (!expanded) { btn.closest('section').scrollIntoView({ behavior: 'smooth', block: 'start' }); }
}
</script>
</body>
</html>

