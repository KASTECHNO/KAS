@extends('layouts.adminlte')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Modifier KPI</h2>

    <form method="POST" action="{{ route('admin.kpis.update', $kpi) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Cle</label>
            <input type="text" class="form-control" value="{{ $kpi->key }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Titre affiche</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $kpi->title) }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Unite</label>
            <input type="text" name="unit" class="form-control" value="{{ old('unit', $kpi->unit) }}" placeholder="%, jours, projets...">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ old('description', $kpi->description) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Ordre d'affichage</label>
            <input type="number" min="1" name="display_order" class="form-control" value="{{ old('display_order', $kpi->display_order) }}">
        </div>

        <div class="form-check mb-3">
            <input type="hidden" name="is_active" value="0">
            <input class="form-check-input" type="checkbox" name="is_active" value="1" id="is_active" {{ old('is_active', $kpi->is_active) ? 'checked' : '' }}>
            <label class="form-check-label" for="is_active">KPI actif sur le site</label>
        </div>

        <div class="mb-3">
            <label class="form-label">Regle de calcul</label>
            <textarea class="form-control" rows="2" disabled>{{ $kpi->formula_rule }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Valeur calculee</label>
            <input type="text" class="form-control" value="{{ $kpi->value }}" disabled>
        </div>

        <div class="mb-3">
            <label class="form-label">Snapshot donnees (JSON)</label>
            <textarea class="form-control" rows="4" disabled>{{ json_encode($kpi->data_snapshot, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Dernier recalcul</label>
            <input type="text" class="form-control" value="{{ optional($kpi->last_calculated_at)->format('Y-m-d H:i:s') }}" disabled>
        </div>

        <button type="submit" class="btn btn-success">Enregistrer</button>
        <a href="{{ route('admin.kpis.index') }}" class="btn btn-secondary">Retour</a>
    </form>
</div>
@endsection
