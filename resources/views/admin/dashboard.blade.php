@extends('layouts.adminlte')

@section('title', 'Dashboard Admin')
@section('page_title', 'Performance Dashboard')

@section('content')
<style>
    .admin-hero {
        border: 1px solid #d8e0f2;
        border-radius: 16px;
        background: linear-gradient(120deg, #ffffff 0%, #f5f8ff 56%, #eefcf8 100%);
        box-shadow: 0 16px 36px rgba(11, 19, 36, 0.08);
        padding: 24px;
        margin-bottom: 18px;
    }

    .admin-hero h1 {
        font-size: clamp(1.5rem, 2vw, 2rem);
        margin-bottom: 8px;
        font-weight: 800;
        color: #0b1324;
    }

    .admin-hero p {
        margin: 0;
        color: #4f5d75;
    }

    .kpi-grid {
        display: grid;
        gap: 12px;
        grid-template-columns: repeat(auto-fit, minmax(230px, 1fr));
        margin-bottom: 18px;
    }

    .kpi-card {
        border: 1px solid #d8e0f2;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 12px 28px rgba(11, 19, 36, 0.08);
        padding: 16px;
        min-height: 132px;
    }

    .kpi-label {
        color: #4f5d75;
        font-size: .82rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: .05em;
        margin: 0 0 8px;
    }

    .kpi-value {
        font-size: clamp(1.35rem, 2vw, 2rem);
        font-weight: 800;
        line-height: 1.1;
        color: #0b1324;
        margin: 0;
    }

    .kpi-desc {
        margin: 8px 0 0;
        color: #4f5d75;
        font-size: .86rem;
        line-height: 1.45;
    }

    .split {
        display: grid;
        grid-template-columns: 1.5fr 1fr;
        gap: 14px;
        margin-bottom: 16px;
    }

    .panel {
        border: 1px solid #d8e0f2;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 12px 28px rgba(11, 19, 36, 0.08);
        padding: 16px;
    }

    .panel h2 {
        margin: 0 0 6px;
        font-size: 1.05rem;
        font-weight: 800;
        color: #0b1324;
    }

    .panel p {
        margin: 0 0 12px;
        color: #4f5d75;
        font-size: .9rem;
    }

    .ops-list {
        display: grid;
        gap: 10px;
    }

    .ops-item {
        border: 1px solid #d8e0f2;
        border-radius: 12px;
        background: #f8fbff;
        padding: 10px 12px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
    }

    .ops-item span {
        color: #1e3a8a;
        font-weight: 700;
        font-size: .86rem;
    }

    .ops-item strong {
        color: #0b1324;
        font-size: 1.05rem;
        font-weight: 800;
    }

    .actions-row {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 8px;
    }

    .chart-wrap {
        border: 1px solid #d8e0f2;
        border-radius: 14px;
        background: #fff;
        box-shadow: 0 12px 28px rgba(11, 19, 36, 0.08);
        padding: 14px;
    }

    @media (max-width: 992px) {
        .split {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="admin-hero">
    <h1>Dashboard KPI et pilotage</h1>
    <p>Vue temps reel des indicateurs metier du site, activite recente et performance de contenu.</p>
</div>

<div class="kpi-grid">
    @forelse($businessKpis as $kpi)
        <article class="kpi-card">
            <p class="kpi-label">{{ $kpi->title }}</p>
            <p class="kpi-value">{{ number_format((float) $kpi->value, 0, ',', ' ') }} {{ $kpi->unit }}</p>
            <p class="kpi-desc">{{ $kpi->description }}</p>
        </article>
    @empty
        <article class="kpi-card">
            <p class="kpi-label">Aucun KPI</p>
            <p class="kpi-value">0</p>
            <p class="kpi-desc">Configurez vos KPI depuis le module dedie.</p>
        </article>
    @endforelse
</div>

<div class="split">
    <section class="panel">
        <h2>Indicateurs operationnels</h2>
        <p>Mesures instantanees de volumetrie et d activite sur l espace public.</p>
        <div class="ops-list">
            <div class="ops-item"><span>Services actifs</span><strong>{{ $operational['services_active'] }}</strong></div>
            <div class="ops-item"><span>Secteurs actifs</span><strong>{{ $operational['sectors_active'] }}</strong></div>
            <div class="ops-item"><span>Clients references</span><strong>{{ $operational['clients_total'] }}</strong></div>
            <div class="ops-item"><span>Projets featured</span><strong>{{ $operational['projects_featured'] }}</strong></div>
            <div class="ops-item"><span>Temoignages actifs</span><strong>{{ $operational['testimonials_active'] }}</strong></div>
            <div class="ops-item"><span>Messages contact (30j)</span><strong>{{ $operational['contact_messages_30d'] }}</strong></div>
            <div class="ops-item"><span>Total messages contact</span><strong>{{ $operational['contact_messages_total'] }}</strong></div>
        </div>
    </section>

    <section class="panel">
        <h2>Actions rapides</h2>
        <p>Raccourcis de pilotage et synchronisation des donnees web.</p>
        <div class="actions-row">
            <a class="btn btn-primary" href="{{ route('admin.kpis.index') }}"><i class="fas fa-chart-line mr-1"></i> Gerer KPI</a>
            <a class="btn btn-primary" href="{{ route('admin.projects.index') }}"><i class="fas fa-diagram-project mr-1"></i> Projets</a>
            <a class="btn btn-primary" href="{{ route('admin.clients.index') }}"><i class="fas fa-users mr-1"></i> Clients</a>
            <a class="btn btn-primary" href="{{ route('admin.services.index') }}"><i class="fas fa-screwdriver-wrench mr-1"></i> Services</a>
            <a class="btn btn-primary" href="{{ route('admin.contact-messages.index') }}"><i class="fas fa-envelope mr-1"></i> Messages</a>
        </div>
        <div class="actions-row">
            <form action="{{ route('admin.kpis.recalculate') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success"><i class="fas fa-rotate mr-1"></i> Recalcul KPI</button>
            </form>
            <form action="{{ route('admin.data-sync.website-static') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-success"><i class="fas fa-download mr-1"></i> Sync donnees + images</button>
            </form>
        </div>
    </section>
</div>

<section class="chart-wrap">
    <h2 style="margin:0 0 6px;font-size:1.05rem;font-weight:800;color:#0b1324;">Tendance 6 derniers mois</h2>
    <p style="margin:0 0 12px;color:#4f5d75;font-size:.9rem;">Evolution des contacts entrants, clients ajoutes et projets crees.</p>
    <canvas id="kpiTrendChart" height="100"></canvas>
</section>

<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.3/dist/chart.umd.min.js"></script>
<script>
    (function () {
        const ctx = document.getElementById('kpiTrendChart');
        if (!ctx) {
            return;
        }

        const trendData = @json($trendData);

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: trendData.labels,
                datasets: [
                    {
                        label: 'Contacts',
                        data: trendData.contacts,
                        borderColor: '#0a66c2',
                        backgroundColor: 'rgba(10, 102, 194, .14)',
                        fill: true,
                        tension: .35,
                        pointRadius: 3
                    },
                    {
                        label: 'Clients',
                        data: trendData.clients,
                        borderColor: '#0f766e',
                        backgroundColor: 'rgba(15, 118, 110, .12)',
                        fill: true,
                        tension: .35,
                        pointRadius: 3
                    },
                    {
                        label: 'Projets',
                        data: trendData.projects,
                        borderColor: '#1e3a8a',
                        backgroundColor: 'rgba(30, 58, 138, .10)',
                        fill: true,
                        tension: .35,
                        pointRadius: 3
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: true,
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            precision: 0
                        }
                    }
                },
                plugins: {
                    legend: {
                        position: 'top'
                    }
                }
            }
        });
    })();
</script>
@endsection
