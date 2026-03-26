<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $company->name ?? 'KAS Technology' }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --bg: #f8fafc;
            --surface: #fff;
            --ink: #0f172a;
            --muted: #475569;
            --line: #e2e8f0;
            --primary: #2563eb;
            --radius: 14px;
        }
        * { box-sizing: border-box; }
        body { margin: 0; font-family: 'Space Grotesk', sans-serif; background: var(--bg); color: var(--ink); }
        .wrap { width: min(96vw, 560px); margin: 0 auto; padding: 12px 0 24px; }
        .top {
            position: sticky; top: 0; z-index: 10;
            background: rgba(248,250,252,.95); backdrop-filter: blur(8px);
            border-bottom: 1px solid var(--line);
        }
        .top-in { width: min(96vw, 560px); margin: 0 auto; display: flex; justify-content: space-between; align-items: center; padding: 10px 0; }
        .brand { font-weight: 700; font-size: .95rem; }
        .brand small { display:block; color: var(--muted); font-weight: 500; font-size: .78rem; }
        .login { text-decoration: none; background: var(--primary); color:#fff; border-radius: 10px; padding: 8px 10px; font-size: .82rem; }
        .hero {
            background: linear-gradient(140deg, #1d4ed8, #1e3a8a);
            border-radius: var(--radius);
            color: #fff;
            padding: 16px;
            margin-top: 12px;
            animation: fadeInUp .6s ease both;
        }
        .hero h1 { font-size: 1.35rem; line-height: 1.2; margin: 0 0 8px; }
        .hero p { margin: 0; font-size: .93rem; opacity: .95; }
        .stats { display: grid; grid-template-columns: repeat(2, 1fr); gap: 8px; margin-top: 10px; }
        .stat { background: rgba(255,255,255,.14); border: 1px solid rgba(255,255,255,.25); border-radius: 10px; padding: 8px; }
        .stat strong { display:block; font-size: 1rem; }
        .stat span { font-size: .75rem; opacity: .9; }
        section { margin-top: 14px; }
        .head { display:flex; justify-content: space-between; align-items: end; margin-bottom: 8px; }
        .head h2 { font-size: 1.05rem; margin: 0; }
        .head p { margin: 0; color: var(--muted); font-size: .82rem; }
        .head h2 i { margin-right: 6px; color: var(--primary); }
        .list { display: grid; gap: 8px; }
        .card {
            background: var(--surface);
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 11px;
            transition: transform .22s ease, box-shadow .22s ease;
        }
        .card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 18px rgba(15, 23, 42, .1);
        }
        .card h3 { margin: 0 0 5px; font-size: .95rem; }
        .card p { margin: 0; font-size: .85rem; line-height: 1.45; color: var(--muted); }
        .card h3 i { margin-right: 6px; color: #1d4ed8; }
        .project-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: .74rem;
            color: #334155;
            background: #eef2ff;
            border: 1px solid #dbeafe;
            border-radius: 999px;
            padding: 3px 8px;
            margin-bottom: 6px;
        }
        .logos { display: grid; grid-template-columns: repeat(3, 1fr); gap: 8px; }
        .logo { min-height: 64px; display:grid; place-items:center; background:#fff; border:1px solid var(--line); border-radius: 10px; }
        .logo img { max-width: 82%; max-height: 50px; object-fit: contain; }
        .tech {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 8px;
        }
        .tech .item {
            min-height: 66px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 10px;
            display: grid;
            place-items: center;
            animation: fadeInUp .55s ease both;
        }
        .tech .item img {
            max-width: 30px;
            max-height: 30px;
            object-fit: contain;
        }
        .form input, .form textarea {
            width: 100%; border: 1px solid #cbd5e1; border-radius: 10px; padding: 10px; margin-bottom: 8px; font: inherit;
        }
        .form .field { position: relative; }
        .form .field i {
            position: absolute;
            left: 10px;
            top: 11px;
            color: #64748b;
            font-size: .86rem;
        }
        .form .field input,
        .form .field textarea { padding-left: 30px; }
        .form button { border: 0; border-radius: 10px; width: 100%; padding: 10px; background: var(--primary); color: #fff; font-weight: 700; }
        footer { margin-top: 16px; color: var(--muted); text-align: center; font-size: .78rem; }
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        @media (prefers-reduced-motion: reduce) {
            * { animation: none !important; transition: none !important; }
        }
        .more-items { display: none; }
        .more-items.open { display: contents; }
        .toggle-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            width: 100%;
            margin-top: 10px;
            background: #eef2ff;
            color: #1d4ed8;
            border: 1px solid #bfdbfe;
            border-radius: 10px;
            padding: 9px 0;
            font: 600 .88rem 'Space Grotesk', sans-serif;
            cursor: pointer;
        }
    </style>
</head>
<body>
<header class="top">
    <div class="top-in">
        <div class="brand">{{ $company->name ?? 'KAS Technology' }}<small>Experience mobile</small></div>
    </div>
</header>

<main class="wrap">
    <section class="hero">
        <h1>{{ $company->slogan ?? 'Votre vision, notre code...' }}</h1>
        <p>{{ $company->description ?? 'Solutions digitales pour le web, le mobile et la croissance.' }}</p>
        <div class="stats">
            <div class="stat"><strong>720+</strong><span>Projets</span></div>
            <div class="stat"><strong>480+</strong><span>Clients</span></div>
            <div class="stat"><strong>13500</strong><span>Heures</span></div>
            <div class="stat"><strong>120</strong><span>Recompenses</span></div>
        </div>
    </section>

    <section>
        <div class="head"><h2><i class="fa-solid fa-screwdriver-wrench"></i>Services</h2><p>Expertise principale</p></div>
        <div class="list">
            @foreach($services as $i => $service)
                @if($i < 3)
                    <article class="card"><h3><i class="{{ $service->icon_class ?: 'fa-solid fa-code' }}"></i>{{ $service->title }}</h3><p>{{ $service->short_desc ?: $service->description }}</p></article>
                @endif
            @endforeach
            <div class="more-items" id="mob-services-more">
                @foreach($services as $i => $service)
                    @if($i >= 3)
                        <article class="card"><h3><i class="{{ $service->icon_class ?: 'fa-solid fa-code' }}"></i>{{ $service->title }}</h3><p>{{ $service->short_desc ?: $service->description }}</p></article>
                    @endif
                @endforeach
            </div>
        </div>
        @if($services->count() > 3)
        <button class="toggle-btn" onclick="toggleList('mob-services-more', this)">
            <i class="fa-solid fa-chevron-down"></i> Afficher plus
        </button>
        @endif
    </section>

    <section>
        <div class="head"><h2><i class="fa-solid fa-diagram-project"></i>Projets</h2><p>Realisations a la une</p></div>
        <div class="list">
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
                        <span class="project-badge"><i class="{{ $projectIcon }}"></i>{{ $sectorName }}</span>
                        <h3>{{ $project->title }}</h3>
                        <p>{{ $project->short_desc ?: $project->description }}</p>
                    </article>
                @endif
            @endforeach
            <div class="more-items" id="mob-projects-more">
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
                            <span class="project-badge"><i class="{{ $projectIcon }}"></i>{{ $sectorName }}</span>
                            <h3>{{ $project->title }}</h3>
                            <p>{{ $project->short_desc ?: $project->description }}</p>
                        </article>
                    @endif
                @endforeach
            </div>
        </div>
        @if($projects->count() > 3)
        <button class="toggle-btn" onclick="toggleList('mob-projects-more', this)">
            <i class="fa-solid fa-chevron-down"></i> Afficher plus
        </button>
        @endif
    </section>

    <section>
        <div class="head"><h2><i class="fa-solid fa-handshake"></i>Clients</h2><p>Ils nous font confiance</p></div>
        <div class="logos">
            @foreach($clients as $client)
                <div class="logo">
                    @if($client->logo_url)
                        <img src="{{ $client->logo_url }}" alt="{{ $client->name }}">
                    @else
                        <strong style="font-size:.75rem;">{{ $client->name }}</strong>
                    @endif
                </div>
            @endforeach
        </div>
    </section>

    <section>
        <div class="head"><h2><i class="fa-solid fa-microchip"></i>Technos</h2><p>Stack moderne</p></div>
        <div class="tech">
            <div class="item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/laravel/laravel-original.svg" alt="Laravel"></div>
            <div class="item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/php/php-original.svg" alt="PHP"></div>
            <div class="item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/javascript/javascript-original.svg" alt="JavaScript"></div>
            <div class="item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/react/react-original.svg" alt="React"></div>
            <div class="item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/vuejs/vuejs-original.svg" alt="Vue"></div>
            <div class="item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/nodejs/nodejs-original.svg" alt="Node"></div>
            <div class="item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/mysql/mysql-original.svg" alt="MySQL"></div>
            <div class="item"><img src="https://cdn.jsdelivr.net/gh/devicons/devicon/icons/docker/docker-original.svg" alt="Docker"></div>
        </div>
    </section>

    <section>
        <div class="head"><h2><i class="fa-solid fa-address-book"></i>Contact</h2><p>Parlez-nous de votre besoin</p></div>
        <form class="card form" method="POST" action="{{ route('contact.store') }}">
            @csrf
            <div class="field"><i class="fa-solid fa-user"></i><input type="text" name="fullname" placeholder="Nom complet" required></div>
            <div class="field"><i class="fa-solid fa-phone"></i><input type="tel" name="phone" placeholder="Telephone" required></div>
            <div class="field"><i class="fa-solid fa-envelope"></i><input type="email" name="email" placeholder="Email" required></div>
            <div class="field"><i class="fa-solid fa-comment-dots"></i><textarea rows="4" name="message" placeholder="Message" required></textarea></div>
            <button type="submit">Envoyer le message</button>
        </form>
    </section>
</main>

<footer>{{ date('Y') }} {{ $company->name ?? 'KAS Technology' }}</footer>
<script>
function toggleList(id, btn) {
    var el = document.getElementById(id);
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
