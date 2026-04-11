@extends('layouts.adminlte')
@section('title', 'Nouvelle offre tarifaire')
@section('page_title', 'Nouvelle offre tarifaire')

@section('content')

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{ route('admin.pricing.store') }}">
            @csrf
            @include('admin.pricing._form', ['plan' => null, 'availableTypes' => $availableTypes])
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Enregistrer</button>
            <a href="{{ route('admin.pricing.index') }}" class="btn btn-secondary ml-2">Annuler</a>
        </form>
    </div>
</div>
@endsection
