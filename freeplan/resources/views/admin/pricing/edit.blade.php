@extends('layouts.adminlte')
@section('title', 'Modifier l\'offre tarifaire')
@section('page_title', 'Modifier — ' . $pricing->typeLabel())

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
        <form method="POST" action="{{ route('admin.pricing.update', $pricing) }}">
            @csrf @method('PUT')
            @include('admin.pricing._form', ['plan' => $pricing, 'availableTypes' => [$pricing->type]])
            <button type="submit" class="btn btn-primary"><i class="fas fa-save mr-1"></i> Mettre à jour</button>
            <a href="{{ route('admin.pricing.index') }}" class="btn btn-secondary ml-2">Annuler</a>
        </form>
    </div>
</div>
@endsection
