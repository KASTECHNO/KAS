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

    .crm-grid {
        display: grid;
        gap: 12px;
        grid-template-columns: repeat(auto-fit, minmax(210px, 1fr));
        margin-bottom: 18px;
    }

    .crm-card {
        border: 1px solid #d8e0f2;
        border-radius: 14px;
        background: linear-gradient(145deg, #ffffff 0%, #f8fbff 100%);
        box-shadow: 0 12px 28px rgba(11, 19, 36, 0.08);
        padding: 16px;
    }

    .crm-card h3 {
        margin: 0 0 6px;
        font-size: .82rem;
        color: #4f5d75;
        text-transform: uppercase;
        letter-spacing: .05em;
        font-weight: 800;
    }

    .crm-card strong {
        display: block;
        color: #0b1324;
        font-size: clamp(1.4rem, 2vw, 2rem);
        line-height: 1.1;
        margin-bottom: 6px;
    }

    .crm-card span {
        color: #4f5d75;
        font-size: .88rem;
    }

    .crm-split {
        display: grid;
        grid-template-columns: 1.15fr .85fr;
        gap: 14px;
        margin: 0 0 16px;
    }

    .stage-list {
        display: grid;
        gap: 10px;
    }

    .stage-item {
        border: 1px solid #d8e0f2;
        border-radius: 12px;
        background: #f8fbff;
        padding: 12px;
    }

    .stage-head {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 12px;
        margin-bottom: 8px;
        color: #0b1324;
        font-weight: 800;
    }

    .stage-meta {
        display: flex;
        justify-content: space-between;
        gap: 12px;
        color: #4f5d75;
        font-size: .86rem;
    }

    .focus-list {
        display: grid;
        gap: 10px;
    }

    .focus-item {
        border: 1px solid #d8e0f2;
        border-radius: 12px;
        background: #f8fbff;
        padding: 12px;
    }

    .focus-item strong {
        display: block;
        color: #0b1324;
        margin-bottom: 4px;
    }

    .focus-item span {
        display: block;
        color: #4f5d75;
        font-size: .86rem;
    }

    @media (max-width: 992px) {
        .split {
            grid-template-columns: 1fr;
        }

        .crm-split {
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
            <a class="btn btn-primary" href="{{ route('admin.leads.index') }}"><i class="fas fa-user-plus mr-1"></i> Leads</a>
            <a class="btn btn-primary" href="{{ route('admin.opportunities.index') }}"><i class="fas fa-handshake mr-1"></i> Opportunites</a>
            <a class="btn btn-primary" href="{{ route('admin.crm-activities.index') }}"><i class="fas fa-list-check mr-1"></i> Activites CRM</a>
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

<div class="admin-hero" style="margin-top:4px;">
    <h1>Dashboard CRM commercial</h1>
    <p>Lecture immediate du pipeline, des conversions et des activites a traiter.</p>
</div>

<div class="crm-grid">
    <article class="crm-card">
        <h3>Leads Total</h3>
        <strong>{{ number_format($crmKpis['leads_total'], 0, ',', ' ') }}</strong>
        <span>Base de prospection disponible dans le CRM.</span>
    </article>
    <article class="crm-card">
        <h3>Taux Conversion</h3>
        <strong>{{ number_format($crmKpis['conversion_rate'], 1, ',', ' ') }} %</strong>
        <span>Part des leads passes au statut converti.</span>
    </article>
    <article class="crm-card">
        <h3>Pipeline Ouvert</h3>
        <strong>{{ number_format($crmKpis['pipeline_open'], 0, ',', ' ') }} EUR</strong>
        <span>Montant brut des opportunites encore ouvertes.</span>
    </article>
    <article class="crm-card">
        <h3>Pipeline Pondere</h3>
        <strong>{{ number_format($crmKpis['pipeline_weighted'], 0, ',', ' ') }} EUR</strong>
        <span>Projection ajustee par probabilite de signature.</span>
    </article>
    <article class="crm-card">
        <h3>Won Ce Mois</h3>
        <strong>{{ number_format($crmKpis['won_this_month'], 0, ',', ' ') }} EUR</strong>
        <span>CA gagne sur le mois courant selon closing prevu.</span>
    </article>
    <article class="crm-card">
        <h3>Activites En Retard</h3>
        <strong>{{ number_format($crmKpis['overdue_activities'], 0, ',', ' ') }}</strong>
        <span>Taches et relances a reprendre immediatement.</span>
    </article>
</div>

<div class="crm-split">
    <section class="panel">
        <h2>Pipeline par etape</h2>
        <p>Photo rapide de la repartition commerciale par stade d avancement.</p>
        <div class="stage-list">
            @foreach($pipelineStages as $stage)
                <div class="stage-item">
                    <div class="stage-head">
                        <span>{{ $stage['stage'] }}</span>
                        <span>{{ number_format($stage['amount'], 0, ',', ' ') }} EUR</span>
                    </div>
                    <div class="stage-meta">
                        <span>{{ $stage['count'] }} opportunite(s)</span>
                        <span>{{ $stage['count'] > 0 ? 'active' : 'vide' }}</span>
                    </div>
                </div>
            @endforeach
        </div>
    </section>

    <section class="panel">
        <h2>Focus commercial</h2>
        <p>Activites prioritaires et signatures recentes a garder visibles.</p>
        <div class="ops-list" style="margin-bottom:12px;">
            <div class="ops-item"><span>Actions a traiter aujourd hui</span><strong>{{ $activityFocus['pending_today'] }}</strong></div>
        </div>
        <div class="focus-list">
            @forelse($activityFocus['upcoming'] as $activity)
                <div class="focus-item">
                    <strong>{{ $activity->subject }}</strong>
                    <span>{{ optional($activity->lead)->fullname ?: 'Lead non renseigne' }}{{ $activity->opportunity ? ' | '.$activity->opportunity->name : '' }}</span>
                    <span>Echeance: {{ optional($activity->due_at)->format('d/m/Y H:i') ?: '-' }}</span>
                </div>
            @empty
                <div class="focus-item">
                    <strong>Aucune activite planifiee</strong>
                    <span>Le flux CRM est vide ou tout est traite.</span>
                </div>
            @endforelse
        </div>
        <h2 style="margin-top:16px;">Derniers gains</h2>
        <div class="focus-list">
            @forelse($activityFocus['recent_wins'] as $opportunity)
                <div class="focus-item">
                    <strong>{{ $opportunity->name }}</strong>
                    <span>{{ optional($opportunity->client)->name ?: optional($opportunity->lead)->fullname ?: 'Compte non rattache' }}</span>
                    <span>{{ number_format((float) $opportunity->amount, 0, ',', ' ') }} {{ $opportunity->currency }}</span>
                </div>
            @empty
                <div class="focus-item">
                    <strong>Aucun gain recent</strong>
                    <span>Les opportunites gagnees apparaitront ici.</span>
                </div>
            @endforelse
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
