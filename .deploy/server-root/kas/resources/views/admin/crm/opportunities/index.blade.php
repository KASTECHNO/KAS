@extends('layouts.adminlte')

@section('title', 'Opportunites CRM')
@section('page_title', 'Opportunites CRM')

@section('content')
<style>
    .kanban-board {
        display: grid;
        grid-template-columns: repeat(6, minmax(240px, 1fr));
        gap: 12px;
        overflow-x: auto;
        padding-bottom: 8px;
        margin-bottom: 18px;
    }

    .kanban-column {
        min-width: 240px;
        border: 1px solid #d8e0f2;
        border-radius: 14px;
        background: linear-gradient(180deg, #f8fbff 0%, #ffffff 100%);
        box-shadow: 0 12px 28px rgba(11, 19, 36, 0.06);
        padding: 12px;
    }

    .kanban-head {
        margin-bottom: 12px;
        padding-bottom: 10px;
        border-bottom: 1px solid #d8e0f2;
    }

    .kanban-head strong {
        display: block;
        color: #0b1324;
        font-size: .95rem;
    }

    .kanban-head span {
        color: #4f5d75;
        font-size: .82rem;
    }

    .kanban-stack {
        display: grid;
        gap: 10px;
    }

    .kanban-card {
        border: 1px solid #d8e0f2;
        border-radius: 12px;
        background: #fff;
        padding: 12px;
        box-shadow: 0 10px 20px rgba(11, 19, 36, 0.05);
    }

    .kanban-card h3 {
        font-size: .95rem;
        line-height: 1.3;
        margin: 0 0 6px;
        color: #0b1324;
    }

    .kanban-card p {
        margin: 0 0 6px;
        color: #4f5d75;
        font-size: .82rem;
    }

    .kanban-meta {
        display: flex;
        justify-content: space-between;
        gap: 8px;
        margin: 8px 0;
        font-size: .8rem;
        color: #4f5d75;
    }

    .kanban-actions {
        display: grid;
        gap: 8px;
        margin-top: 10px;
    }

    .kanban-empty {
        border: 1px dashed #d8e0f2;
        border-radius: 12px;
        padding: 14px;
        text-align: center;
        color: #7a869a;
        font-size: .82rem;
        background: rgba(248, 251, 255, .8);
    }
</style>

<div class="card card-outline card-primary mb-3">
    <div class="card-body">
        <form method="GET" class="form-row align-items-end">
            <div class="col-md-3 mb-2">
                <label for="q">Recherche</label>
                <input id="q" type="text" name="q" value="{{ $filters['q'] }}" class="form-control" placeholder="Nom opportunite">
            </div>
            <div class="col-md-3 mb-2">
                <label for="stage">Etape</label>
                <select id="stage" name="stage" class="form-control">
                    <option value="">Toutes</option>
                    @foreach($stages as $stage)
                        <option value="{{ $stage }}" {{ $filters['stage'] === $stage ? 'selected' : '' }}>{{ $stage }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-2 mb-2">
                <label for="status">Statut</label>
                <select id="status" name="status" class="form-control">
                    <option value="">Tous</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ $filters['status'] === $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-4 mb-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary mr-2">Filtrer</button>
                <a href="{{ route('admin.opportunities.index') }}" class="btn btn-light border mr-2">Reset</a>
                <a href="{{ route('admin.opportunities.create') }}" class="btn btn-success">Nouvelle opportunite</a>
            </div>
        </form>
    </div>
</div>

<div class="card card-outline card-primary mb-3">
    <div class="card-header">
        <h3 class="card-title font-weight-bold">Pipeline Kanban</h3>
    </div>
    <div class="card-body">
        <div class="kanban-board">
            @foreach($kanbanColumns as $column)
                <section class="kanban-column">
                    <div class="kanban-head">
                        <strong>{{ $column['stage'] }}</strong>
                        <span>{{ $column['count'] }} opportunite(s) | {{ number_format($column['amount'], 0, ',', ' ') }} EUR</span>
                    </div>

                    <div class="kanban-stack">
                        @forelse($column['items'] as $opportunity)
                            <article class="kanban-card">
                                <h3>{{ $opportunity->name }}</h3>
                                <p>{{ $opportunity->lead->fullname ?? '-' }} / {{ $opportunity->client->name ?? '-' }}</p>
                                <div class="kanban-meta">
                                    <span>{{ number_format((float) $opportunity->amount, 0, ',', ' ') }} {{ $opportunity->currency }}</span>
                                    <span>{{ $opportunity->probability }} %</span>
                                </div>
                                <p>Owner: {{ $opportunity->owner->name ?? '-' }}</p>
                                <p>Close: {{ optional($opportunity->expected_close_date)->format('d/m/Y') ?: '-' }}</p>

                                <div class="kanban-actions">
                                    <form action="{{ route('admin.opportunities.update-stage', $opportunity) }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <div class="input-group input-group-sm">
                                            <select name="stage" class="form-control">
                                                @foreach($stages as $stage)
                                                    <option value="{{ $stage }}" {{ $opportunity->stage === $stage ? 'selected' : '' }}>{{ $stage }}</option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary" type="submit">Move</button>
                                            </div>
                                        </div>
                                    </form>
                                    <a href="{{ route('admin.opportunities.edit', $opportunity) }}" class="btn btn-warning btn-sm">Edit</a>
                                </div>
                            </article>
                        @empty
                            <div class="kanban-empty">Aucune opportunite dans cette etape.</div>
                        @endforelse
                    </div>
                </section>
            @endforeach
        </div>
    </div>
</div>

<div class="card card-outline card-secondary">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Lead / Client</th>
                        <th>Montant</th>
                        <th>Etape</th>
                        <th>Statut</th>
                        <th>Owner</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($opportunities as $opportunity)
                        <tr>
                            <td>
                                <strong>{{ $opportunity->name }}</strong><br>
                                <small>Close: {{ optional($opportunity->expected_close_date)->format('d/m/Y') ?: '-' }}</small>
                            </td>
                            <td>{{ $opportunity->lead->fullname ?? '-' }} / {{ $opportunity->client->name ?? '-' }}</td>
                            <td>{{ number_format((float) $opportunity->amount, 2, ',', ' ') }} {{ $opportunity->currency }}</td>
                            <td><span class="badge badge-info">{{ $opportunity->stage }}</span></td>
                            <td><span class="badge badge-secondary">{{ $opportunity->status }}</span></td>
                            <td>{{ $opportunity->owner->name ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.opportunities.edit', $opportunity) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.opportunities.destroy', $opportunity) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette opportunite ?')">Del</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Aucune opportunite trouvee.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($opportunities->hasPages())
        <div class="card-footer">{{ $opportunities->links() }}</div>
    @endif
</div>
@endsection
