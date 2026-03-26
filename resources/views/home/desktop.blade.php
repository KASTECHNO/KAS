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
            --bg: #eef2ff;
            --surface: #ffffff;
            --ink: #0b1324;
            --muted: #4f5d75;
            --line: #d8e0f2;
            --primary: #0a66c2;
            --secondary: #0f766e;
            --radius: 18px;
            --shadow: 0 20px 45px rgba(11, 19, 36, .08);
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Manrope', sans-serif;
            color: var(--ink);
            background: radial-gradient(circle at 0% 0%, #dbeafe 0, transparent 30%), radial-gradient(circle at 100% 0%, #ccfbf1 0, transparent 26%), var(--bg);
        }
        .container { width: min(1200px, 92vw); margin: 0 auto; }
        .topbar {
            position: sticky;
            top: 0;
            z-index: 20;
            border-bottom: 1px solid var(--line);
            backdrop-filter: blur(8px);
            background: rgba(238, 242, 255, .82);
        }
        .topbar-inner {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 14px 0;
        }
        .brand h1 { margin: 0; font-size: 1.2rem; }
        .brand p { margin: 2px 0 0; color: var(--muted); font-size: .92rem; }
        .btn-link {
            display: inline-block;
            text-decoration: none;
            color: #fff;
            background: var(--primary);
            padding: 10px 16px;
            border-radius: 10px;
            font-weight: 600;
        }
        .hero {
            display: grid;
            grid-template-columns: 1.2fr .8fr;
            gap: 22px;
            align-items: stretch;
            padding: 68px 0 30px;
            animation: fadeUp .7s ease both;
        }
        .panel {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: var(--radius);
            box-shadow: var(--shadow);
            padding: 24px;
        }
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #dbeafe;
            color: #1d4ed8;
            border-radius: 999px;
            padding: 8px 12px;
            font-size: .86rem;
            margin-bottom: 10px;
        }
        .hero h2 { font-size: clamp(2rem, 4vw, 3.1rem); margin: 0; line-height: 1.1; }
        .hero p { color: var(--muted); font-size: 1rem; line-height: 1.65; }
        .stats {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px;
        }
        .stat {
            border: 1px solid var(--line);
            border-radius: 12px;
            background: #f8fbff;
            padding: 12px;
        }
        .stat strong { display: block; font-size: 1.25rem; }
        .stat span { color: var(--muted); font-size: .88rem; }
        section { padding: 20px 0; }
        .head { display: flex; justify-content: space-between; align-items: end; margin-bottom: 12px; }
        .head h3 { margin: 0; font-size: 1.5rem; }
        .head p { margin: 0; color: var(--muted); }
        .head h3 i { margin-right: 8px; color: var(--primary); }
        .grid { display: grid; gap: 12px; }
        .grid.cols-3 { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 14px;
            box-shadow: var(--shadow);
            transition: transform .28s ease, box-shadow .28s ease;
        }
        .card:hover {
            transform: translateY(-4px);
            box-shadow: 0 26px 40px rgba(11, 19, 36, .12);
        }
        .card i {
            width: 36px; height: 36px; border-radius: 10px;
            display: grid; place-items: center;
            background: #e2e8f0; color: #0a66c2;
            margin-bottom: 8px;
        }
        .card h4 { margin: 0 0 6px; }
        .card p { margin: 0; color: var(--muted); line-height: 1.5; }
        .project-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: .8rem;
            color: #334155;
            background: #eef2ff;
            border: 1px solid #dbeafe;
            border-radius: 999px;
            padding: 4px 9px;
            margin-bottom: 8px;
        }
        .logos { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 12px; }
        .logo {
            background: #fff; border: 1px solid var(--line); border-radius: 12px;
            min-height: 82px; display: grid; place-items: center;
            transition: transform .25s ease, border-color .25s ease;
        }
        .logo:hover {
            transform: translateY(-3px);
            border-color: #b6c7ee;
        }
        .logo img { max-width: 78%; max-height: 60px; object-fit: contain; }
        .tech-grid {
            display: grid;
            grid-template-columns: repeat(6, minmax(0, 1fr));
            gap: 12px;
        }
        .tech-item {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 12px;
            min-height: 88px;
            display: grid;
            place-items: center;
            transition: transform .24s ease, box-shadow .24s ease;
            animation: floatIn .6s ease both;
        }
        .tech-item:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 14px 28px rgba(10, 102, 194, .16);
        }
        .tech-item img {
            max-width: 52px;
            max-height: 52px;
            object-fit: contain;
        }
        .tech-item span {
            display: block;
            font-size: .8rem;
            color: var(--muted);
            margin-top: 4px;
        }
        .contact {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            margin-bottom: 30px;
        }
        .form input, .form textarea {
            width: 100%; border: 1px solid #cbd5e1; border-radius: 10px; padding: 10px 12px; font: inherit; margin-bottom: 9px;
        }
        .form .field {
            position: relative;
        }
        .form .field i {
            position: absolute;
            left: 11px;
            top: 12px;
            color: #64748b;
            font-size: .9rem;
        }
        .form .field input,
        .form .field textarea {
            padding-left: 34px;
        }
        .form button {
            border: 0; border-radius: 10px; padding: 10px 12px; font: inherit; background: var(--secondary); color: #fff; font-weight: 700; cursor: pointer;
        }
        footer { color: var(--muted); font-size: .9rem; padding: 0 0 30px; }
        @keyframes fadeUp {
            from { opacity: 0; transform: translateY(16px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @keyframes floatIn {
            from { opacity: 0; transform: translateY(10px) scale(.98); }
            to { opacity: 1; transform: translateY(0) scale(1); }
        }
        @media (prefers-reduced-motion: reduce) {
            * { animation: none !important; transition: none !important; }
        }
        @media (max-width: 1080px) {
            .tech-grid { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        }
        @media (max-width: 760px) {
            .tech-grid { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        }
        .more-items { display: none; }
        .more-items.open { display: contents; }
        .toggle-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 14px;
            background: #eef2ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
            border-radius: 999px;
            padding: 8px 20px;
            font: 600 .9rem 'Manrope', sans-serif;
            cursor: pointer;
            transition: background .2s ease, transform .2s ease;
        }
        .toggle-btn:hover { background: #dbeafe; transform: translateY(-1px); }
        .toggle-wrap { text-align: center; }
    </style>
</head>
<body>
<header class="topbar">
    <div class="container topbar-inner">
        <div class="brand">
            <h1>{{ $company->name ?? 'KAS Technology' }}</h1>
            <p>{{ $company->slogan ?? 'Votre vision, notre code...' }}</p>
        </div>
    </div>
</header>

<main class="container">
    <section class="hero">
        <article class="panel">
            <span class="pill"><i class="fa-solid fa-bolt"></i> Experience bureau</span>
            <h2>Livraison digitale professionnelle pour les entreprises ambitieuses</h2>
            <p>{{ $company->description ?? 'Nous creons des solutions de haute qualite sur le web, le mobile et la croissance digitale.' }}</p>
        </article>
        <aside class="panel stats">
            <div class="stat"><strong>13500</strong><span>Heures de travail</span></div>
            <div class="stat"><strong>720</strong><span>Projets realises</span></div>
            <div class="stat"><strong>480</strong><span>Clients satisfaits</span></div>
            <div class="stat"><strong>120</strong><span>Recompenses recues</span></div>
        </aside>
    </section>

    <section>
        <div class="head"><h3><i class="fa-solid fa-screwdriver-wrench"></i>Services</h3><p>Ce que nous realisons le mieux.</p></div>
        <div class="grid cols-3" id="services-grid">
            @foreach($services as $i => $service)
                @if($i < 3)
                    <article class="card"><i class="{{ $service->icon_class ?: 'fa-solid fa-code' }}"></i><h4>{{ $service->title }}</h4><p>{{ $service->short_desc ?: $service->description }}</p></article>
                @endif
            @endforeach
            <div class="more-items" id="services-more">
                @foreach($services as $i => $service)
                    @if($i >= 3)
                        <article class="card"><i class="{{ $service->icon_class ?: 'fa-solid fa-code' }}"></i><h4>{{ $service->title }}</h4><p>{{ $service->short_desc ?: $service->description }}</p></article>
                    @endif
                @endforeach
            </div>
        </div>
        @if($services->count() > 3)
        <div class="toggle-wrap">
            <button class="toggle-btn" onclick="toggleList('services-more', this)">
                <i class="fa-solid fa-chevron-down"></i> Afficher plus
            </button>
        </div>
        @endif
    </section>

    <section>
        <div class="head"><h3><i class="fa-solid fa-diagram-project"></i>Projets a la une</h3><p>Dernieres realisations a impact.</p></div>
        <div class="grid cols-3" id="projects-grid">
            @foreach($projects as $i => $project)
                @php
                    $sectorName = $project->sector->name ?? 'Secteur non defini';
                    $sectorText = \Illuminate\Support\Str::lower($sectorName);
                    $projectIcon = 'fa-solid fa-diagram-project';
                    if (\Illuminate\Support\Str::contains($sectorText, ['hotel', 'hoteliere', 'reservation'])) {
                        $projectIcon = 'fa-solid fa-hotel';
                    } elseif (\Illuminate\Support\Str::contains($sectorText, ['construction', 'chantier'])) {
                        $projectIcon = 'fa-solid fa-building';
                    } elseif (\Illuminate\Support\Str::contains($sectorText, ['learning', 'e-learning', 'formation'])) {
                        $projectIcon = 'fa-solid fa-graduation-cap';
                    } elseif (\Illuminate\Support\Str::contains($sectorText, ['finance', 'credit'])) {
                        $projectIcon = 'fa-solid fa-chart-line';
                    } elseif (\Illuminate\Support\Str::contains($sectorText, ['crm'])) {
                        $projectIcon = 'fa-solid fa-users-gear';
                    } elseif (\Illuminate\Support\Str::contains($sectorText, ['stock', 'inventaire', 'commerciale', 'logistique'])) {
                        $projectIcon = 'fa-solid fa-boxes-stacked';
                    }
                @endphp
                @if($i < 3)
                    <article class="card">
                        <span class="project-badge"><i class="{{ $projectIcon }}"></i> {{ $sectorName }}</span>
                        <h4>{{ $project->title }}</h4>
                        <p>{{ $project->short_desc ?: $project->description }}</p>
                    </article>
                @endif
            @endforeach
            <div class="more-items" id="projects-more">
                @foreach($projects as $i => $project)
                    @php
                        $sectorName = $project->sector->name ?? 'Secteur non defini';
                        $sectorText = \Illuminate\Support\Str::lower($sectorName);
                        $projectIcon = 'fa-solid fa-diagram-project';
                        if (\Illuminate\Support\Str::contains($sectorText, ['hotel', 'hoteliere', 'reservation'])) {
                            $projectIcon = 'fa-solid fa-hotel';
                        } elseif (\Illuminate\Support\Str::contains($sectorText, ['construction', 'chantier'])) {
                            $projectIcon = 'fa-solid fa-building';
                        } elseif (\Illuminate\Support\Str::contains($sectorText, ['learning', 'e-learning', 'formation'])) {
                            $projectIcon = 'fa-solid fa-graduation-cap';
                        } elseif (\Illuminate\Support\Str::contains($sectorText, ['finance', 'credit'])) {
                            $projectIcon = 'fa-solid fa-chart-line';
                        } elseif (\Illuminate\Support\Str::contains($sectorText, ['crm'])) {
                            $projectIcon = 'fa-solid fa-users-gear';
                        } elseif (\Illuminate\Support\Str::contains($sectorText, ['stock', 'inventaire', 'commerciale', 'logistique'])) {
                            $projectIcon = 'fa-solid fa-boxes-stacked';
                        }
                    @endphp
                    @if($i >= 3)
                        <article class="card">
                            <span class="project-badge"><i class="{{ $projectIcon }}"></i> {{ $sectorName }}</span>
                            <h4>{{ $project->title }}</h4>
                            <p>{{ $project->short_desc ?: $project->description }}</p>
                        </article>
                    @endif
                @endforeach
            </div>
        </div>
        @if($projects->count() > 3)
        <div class="toggle-wrap">
            <button class="toggle-btn" onclick="toggleList('projects-more', this)">
                <i class="fa-solid fa-chevron-down"></i> Afficher plus
            </button>
        </div>
        @endif
    </section>

    <section>
        <div class="head"><h3><i class="fa-solid fa-handshake"></i>Clients</h3><p>La confiance d entreprises en croissance.</p></div>
        <div class="logos">
            @foreach($clients as $client)
                <div class="logo">
                    @if($client->logo_url)
                        <img src="{{ $client->logo_url }}" alt="{{ $client->name }}">
                    @else
                        <strong>{{ $client->name }}</strong>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    <section>
        <div class="head"><h3><i class="fa-solid fa-microchip"></i>Technologies maitrisees</h3><p>Nos stacks de developpement quotidiennes.</p></div>
        <div class="tech-grid">
            <div class="tech-item"><div><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" alt="Laravel"><span>Laravel</span></div></div>
            <div class="tech-item"><div><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP"><span>PHP</span></div></div>
            <div class="tech-item"><div><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="JavaScript"><span>JavaScript</span></div></div>
            <div class="tech-item"><div><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/typescript/typescript-original.svg" alt="TypeScript"><span>TypeScript</span></div></div>
            <div class="tech-item"><div><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" alt="React"><span>React</span></div></div>
            <div class="tech-item"><div><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg" alt="Vue"><span>Vue</span></div></div>
            <div class="tech-item"><div><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg" alt="Node.js"><span>Node.js</span></div></div>
            <div class="tech-item"><div><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" alt="MySQL"><span>MySQL</span></div></div>
            <div class="tech-item"><div><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/postgresql/postgresql-original.svg" alt="PostgreSQL"><span>PostgreSQL</span></div></div>
            <div class="tech-item"><div><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg" alt="Docker"><span>Docker</span></div></div>
            <div class="tech-item"><div><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/git/git-original.svg" alt="Git"><span>Git</span></div></div>
            <div class="tech-item"><div><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/amazonwebservices/amazonwebservices-original-wordmark.svg" alt="AWS"><span>AWS</span></div></div>
        </div>
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
            <div class="field"><i class="fa-solid fa-user"></i><input type="text" name="fullname" placeholder="Nom complet" required></div>
            <div class="field"><i class="fa-solid fa-phone"></i><input type="tel" name="phone" placeholder="Telephone" required></div>
            <div class="field"><i class="fa-solid fa-envelope"></i><input type="email" name="email" placeholder="Email" required></div>
            <div class="field"><i class="fa-solid fa-comment-dots"></i><textarea rows="4" name="message" placeholder="Message" required></textarea></div>
            <button type="submit">Envoyer le message</button>
        </form>
    </section>
</main>

<footer class="container">{{ date('Y') }} {{ $company->name ?? 'KAS Technology' }} - Tous droits reserves.</footer>
<script>
function toggleList(id, btn) {
    var el = document.getElementById(id);
    var icon = btn.querySelector('i');
    var expanded = el.classList.toggle('open');
    if (expanded) {
        btn.innerHTML = '<i class="fa-solid fa-chevron-up"></i> Reduire';
    } else {
        btn.innerHTML = '<i class="fa-solid fa-chevron-down"></i> Afficher plus';
        var section = btn.closest('section');
        if (section) { section.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
    }
}
</script>
</body>
</html>
