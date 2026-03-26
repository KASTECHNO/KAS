@extends('layouts.adminlte')

@section('title', 'Modifier Lead')
@section('page_title', 'Modifier Lead CRM')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-body">
        <form action="{{ route('admin.leads.update', $lead) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.crm.leads._form')
            <button class="btn btn-success">Sauvegarder</button>
            <a href="{{ route('admin.leads.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
