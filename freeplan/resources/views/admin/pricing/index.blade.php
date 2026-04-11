@extends('layouts.adminlte')
@section('title', 'Offres Tarifaires')
@section('page_title', 'Offres Tarifaires')

@section('content')

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <h2 class="m-0">Offres Tarifaires</h2>
        <small class="text-muted">3 offres fixes : Mensuel · Annuel · Licence perpétuelle</small>
    </div>
    @if($plans->count() < 3)
    <a href="{{ route('admin.pricing.create') }}" class="btn btn-primary">
        <i class="fas fa-plus mr-1"></i> Ajouter une offre
    </a>
    @endif
</div>

<div class="row">
    @forelse($plans as $plan)
    <div class="col-md-4">
        <div class="card card-outline {{ $plan->is_featured ? 'card-primary' : 'card-secondary' }}">
            <div class="card-header">
                <h5 class="card-title m-0">
                    <i class="{{ $plan->icone() }} mr-2"></i>
                    {{ $plan->typeLabel() }}
                    @if($plan->is_featured)
                        <span class="badge badge-warning ml-1">{{ $plan->badge ?? 'Vedette' }}</span>
                    @endif
                </h5>
                <div class="card-tools">
                    <span class="badge badge-{{ $plan->is_active ? 'success' : 'secondary' }}">
                        {{ $plan->is_active ? 'Actif' : 'Inactif' }}
                    </span>
                </div>
            </div>
            <div class="card-body">
                <div class="text-center mb-3">
                    <span style="font-size:2rem;font-weight:800;">{{ number_format($plan->prix, 0, ',', ' ') }} DT</span>
                    <span class="text-muted d-block">{{ $plan->prixPeriode() }}</span>
                </div>
                @if($plan->nom_application)
                    <p class="text-muted small"><strong>Usage interne :</strong> {{ $plan->nom_application }}</p>
                @endif
                @if($plan->description)
                    <p class="small text-muted">{{ Str::limit($plan->description, 120) }}</p>
                @endif
                @php $feats = $plan->fonctionnalitesArray(); @endphp
                @if(count($feats))
                <ul class="small pl-3 mb-0">
                    @foreach(array_slice($feats, 0, 4) as $f)
                        <li>{{ $f }}</li>
                    @endforeach
                    @if(count($feats) > 4)
                        <li class="text-muted">+{{ count($feats) - 4 }} autres...</li>
                    @endif
                </ul>
                @endif
            </div>
            <div class="card-footer d-flex gap-2">
                <a href="{{ route('admin.pricing.edit', $plan) }}" class="btn btn-warning btn-sm">
                    <i class="fas fa-edit mr-1"></i> Modifier
                </a>
                <form action="{{ route('admin.pricing.destroy', $plan) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Supprimer cette offre ?')">
                        <i class="fas fa-trash"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>
    @empty
    <div class="col-12">
        <div class="callout callout-info">
            <h5>Aucune offre tarifaire</h5>
            <p>Cliquez sur <strong>Ajouter une offre</strong> pour créer les 3 offres (Mensuel, Annuel, Licence).</p>
        </div>
    </div>
    @endforelse
</div>
@endsection
