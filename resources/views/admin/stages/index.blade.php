@extends('layouts.adminlte')
@section('title', 'Offres de stage')
@section('page_title', 'Offres de stage')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2 class="m-0">Offres de stage</h2>
    <a href="{{ route('admin.stages.create') }}" class="btn btn-primary"><i class="fas fa-plus mr-1"></i> Nouvelle offre</a>
</div>

<table class="table table-bordered table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Titre</th>
            <th>Domaine</th>
            <th>Type</th>
            <th>Niveau requis</th>
            <th>Date limite</th>
            <th>Candidatures</th>
            <th>Actif</th>
            <th width="140">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($stages as $stage)
        <tr>
            <td>{{ $stage->id }}</td>
            <td><strong>{{ $stage->titre }}</strong></td>
            <td>{{ $stage->domaine }}</td>
            <td><span class="badge badge-info">{{ $stage->type_stage }}</span></td>
            <td>{{ $stage->niveau_requis ?? '—' }}</td>
            <td>{{ $stage->date_limite ? $stage->date_limite->format('d/m/Y') : '—' }}</td>
            <td>
                <a href="{{ route('admin.candidatures.index', ['stage_id' => $stage->id]) }}" class="badge badge-primary">
                    {{ $stage->candidatures()->count() }}
                </a>
            </td>
            <td>
                <span class="badge badge-{{ $stage->is_active ? 'success' : 'secondary' }}">
                    {{ $stage->is_active ? 'Oui' : 'Non' }}
                </span>
            </td>
            <td>
                <a href="{{ route('admin.stages.edit', $stage) }}" class="btn btn-warning btn-sm"><i class="fas fa-edit"></i></a>
                <form action="{{ route('admin.stages.destroy', $stage) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette offre ?')"><i class="fas fa-trash"></i></button>
                </form>
            </td>
        </tr>
        @empty
        <tr><td colspan="9" class="text-center text-muted">Aucune offre de stage.</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
