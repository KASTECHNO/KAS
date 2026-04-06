@extends('layouts.adminlte')
@section('title', 'Candidatures de stage')
@section('page_title', 'Candidatures de stage')

@section('content')
{{-- Filtres --}}
<form method="GET" class="mb-3 d-flex gap-2 flex-wrap">
    <select name="stage_id" class="form-control" style="width:auto;">
        <option value="">— Toutes les offres —</option>
        @foreach($stages as $s)
            <option value="{{ $s->id }}" {{ request('stage_id') == $s->id ? 'selected' : '' }}>{{ $s->titre }}</option>
        @endforeach
    </select>
    <select name="statut" class="form-control" style="width:auto;">
        <option value="">— Tous les statuts —</option>
        @foreach(\App\Models\StageCandidature::statutLabels() as $key => $label)
            <option value="{{ $key }}" {{ request('statut') === $key ? 'selected' : '' }}>{{ $label }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-secondary"><i class="fas fa-filter mr-1"></i> Filtrer</button>
    <a href="{{ route('admin.candidatures.index') }}" class="btn btn-outline-secondary">Réinitialiser</a>
</form>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Candidat</th>
            <th>Email</th>
            <th>Offre</th>
            <th>Niveau</th>
            <th>Établissement</th>
            <th>Statut</th>
            <th>Date</th>
            <th width="110">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($candidatures as $c)
        <tr>
            <td>{{ $c->id }}</td>
            <td><strong>{{ $c->nom }}</strong></td>
            <td>{{ $c->email }}</td>
            <td>{{ $c->stage->titre ?? '?' }}</td>
            <td>{{ $c->niveau_etudes ?? '—' }}</td>
            <td>{{ $c->etablissement ?? '—' }}</td>
            <td>
                @php
                    $badgeColors = ['RECU'=>'secondary','EN_COURS'=>'info','ACCEPTE'=>'success','REFUSE'=>'danger'];
                @endphp
                <span class="badge badge-{{ $badgeColors[$c->statut] ?? 'light' }}">{{ $c->statutLabel() }}</span>
            </td>
            <td>{{ $c->created_at->format('d/m/Y') }}</td>
            <td>
                <a href="{{ route('admin.candidatures.show', $c) }}" class="btn btn-info btn-sm"><i class="fas fa-eye"></i></a>
                <form action="{{ route('admin.candidatures.destroy', $c) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer ?')"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="9" class="text-center text-muted">Aucune candidature.</td></tr>
        @endforelse
    </tbody>
</table>
{{ $candidatures->withQueryString()->links() }}
@endsection
