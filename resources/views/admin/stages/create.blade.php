@extends('layouts.adminlte')
@section('title', 'Nouvelle offre de stage')
@section('page_title', 'Nouvelle offre de stage')

@section('content')
<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.stages.store') }}">
            @csrf
            @include('admin.stages._form', ['stage' => null])
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Enregistrer</button>
            <a href="{{ route('admin.stages.index') }}" class="btn btn-secondary ml-2">Annuler</a>
        </form>
    </div>
</div>
@endsection
