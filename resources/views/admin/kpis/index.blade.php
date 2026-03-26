@extends('layouts.adminlte')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h2>KPI</h2>
    <form method="POST" action="{{ route('admin.kpis.recalculate') }}">
        @csrf
        <button class="btn btn-primary">Recalculer KPI</button>
    </form>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Ordre</th>
            <th>Titre</th>
            <th>Valeur</th>
            <th>Cle</th>
            <th>Regle de calcul</th>
            <th>Dernier calcul</th>
            <th>Actif</th>
            <th width="120">Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($kpis as $kpi)
            <tr>
                <td>{{ $kpi->display_order }}</td>
                <td>{{ $kpi->title }}</td>
                <td><strong>{{ number_format((int) $kpi->value, 0, ',', ' ') }}</strong>{{ $kpi->unit ? ' '.$kpi->unit : '' }}</td>
                <td><code>{{ $kpi->key }}</code></td>
                <td>{{ $kpi->formula_rule }}</td>
                <td>{{ optional($kpi->last_calculated_at)->format('d/m/Y H:i') ?? '-' }}</td>
                <td>{{ $kpi->is_active ? 'Oui' : 'Non' }}</td>
                <td>
                    <a href="{{ route('admin.kpis.edit', $kpi) }}" class="btn btn-warning btn-sm">Edit</a>
                </td>
            </tr>
        @empty
            <tr><td colspan="8" class="text-center">Aucun KPI</td></tr>
        @endforelse
    </tbody>
</table>
@endsection
