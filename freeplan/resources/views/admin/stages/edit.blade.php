@extends('layouts.adminlte')
@section('title', 'Modifier l\'offre de stage')
@section('page_title', 'Modifier — ' . $stage->titre)

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.stages.update', $stage) }}">
            @csrf @method('PUT')
            @include('admin.stages._form', ['stage' => $stage])
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Mettre à jour</button>
            <a href="{{ route('admin.stages.index') }}" class="btn btn-secondary ml-2">Annuler</a>
        </form>
    </div>
</div>
@endsection
