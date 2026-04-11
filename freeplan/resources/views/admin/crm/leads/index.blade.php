@extends('layouts.adminlte')

@section('title', 'Leads CRM')
@section('page_title', 'Leads CRM')

@section('content')
<div class="card card-outline card-primary mb-3">
    <div class="card-body">
        <form method="GET" class="form-row align-items-end">
            <div class="col-md-4 mb-2">
                <label for="q">Recherche</label>
                <input id="q" type="text" name="q" value="{{ $filters['q'] }}" class="form-control" placeholder="Nom, email, phone, entreprise">
            </div>
            <div class="col-md-3 mb-2">
                <label for="status">Statut</label>
                <select id="status" name="status" class="form-control">
                    <option value="">Tous</option>
                    @foreach($statuses as $status)
                        <option value="{{ $status }}" {{ $filters['status'] === $status ? 'selected' : '' }}>{{ $status }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-5 mb-2 d-flex gap-2">
                <button type="submit" class="btn btn-primary mr-2">Filtrer</button>
                <a href="{{ route('admin.leads.index') }}" class="btn btn-light border mr-2">Reset</a>
                <a href="{{ route('admin.leads.create') }}" class="btn btn-success">Nouveau lead</a>
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
                        <th>Lead</th>
                        <th>Source</th>
                        <th>Statut</th>
                        <th>Score</th>
                        <th>Owner</th>
                        <th>Dernier contact</th>
                        <th width="180">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($leads as $lead)
                        <tr>
                            <td>
                                <strong>{{ $lead->fullname }}</strong><br>
                                <small>{{ $lead->email ?: '-' }} | {{ $lead->phone ?: '-' }}</small>
                            </td>
                            <td>{{ $lead->source }}</td>
                            <td><span class="badge badge-info">{{ $lead->status }}</span></td>
                            <td>{{ $lead->score }}</td>
                            <td>{{ $lead->owner->name ?? '-' }}</td>
                            <td>{{ optional($lead->last_contact_at)->format('d/m/Y H:i') ?: '-' }}</td>
                            <td>
                                <a href="{{ route('admin.leads.edit', $lead) }}" class="btn btn-warning btn-sm">Edit</a>
                                <form action="{{ route('admin.leads.destroy', $lead) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ce lead ?')">Del</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center text-muted py-4">Aucun lead trouve.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($leads->hasPages())
        <div class="card-footer">{{ $leads->links() }}</div>
    @endif
</div>
@endsection
