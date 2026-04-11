@extends('layouts.adminlte')

@section('title', 'Activites CRM')
@section('page_title', 'Activites CRM')

@section('content')
<div class="card card-outline card-primary mb-3">
    <div class="card-body">
        <form method="GET" class="form-row align-items-end">
            <div class="col-md-3 mb-2">
                <label for="q">Recherche</label>
                <input id="q" type="text" name="q" value="{{ $filters['q'] }}" class="form-control" placeholder="Sujet">
            </div>
            <div class="col-md-3 mb-2">
                <label for="type">Type</label>
                <select id="type" name="type" class="form-control">
                    <option value="">Tous</option>
                    @foreach($types as $type)
                        <option value="{{ $type }}" {{ $filters['type'] === $type ? 'selected' : '' }}>{{ $type }}</option>
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
                <a href="{{ route('admin.crm-activities.index') }}" class="btn btn-light border mr-2">Reset</a>
                <a href="{{ route('admin.crm-activities.create') }}" class="btn btn-success">Nouvelle activite</a>
            </div>
        </form>
    </div>
</div>

<div class="card card-outline card-secondary">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-striped table-hover mb-0">
                <thead>
                    <tr>
                        <th>Sujet</th>
                        <th>Type</th>
                        <th>Lead / Client / Opp.</th>
                        <th>Echeance</th>
                        <th>Statut</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($activities as $activity)
                        <tr>
                            <td>
                                <strong>{{ $activity->subject }}</strong><br>
                                <small>{{ $activity->owner->name ?? '-' }}</small>
                            </td>
                            <td><span class="badge badge-info">{{ $activity->type }}</span></td>
                            <td>{{ $activity->lead->fullname ?? '-' }} / {{ $activity->client->name ?? '-' }} / {{ $activity->opportunity->name ?? '-' }}</td>
                            <td>{{ optional($activity->due_at)->format('d/m/Y H:i') ?: '-' }}</td>
                            <td><span class="badge badge-secondary">{{ $activity->status }}</span></td>
                            <td>
                                <a href="{{ route('admin.crm-activities.edit', $activity) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.crm-activities.destroy', $activity) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette activite ?')">Del</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center text-muted py-4">Aucune activite CRM trouvee.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($activities->hasPages())
        <div class="card-footer">{{ $activities->links() }}</div>
    @endif
</div>
@endsection
