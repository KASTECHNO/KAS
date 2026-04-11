@extends('layouts.adminlte')

@section('title', 'Modifier Opportunite')
@section('page_title', 'Modifier Opportunite CRM')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-body">
        <form action="{{ route('admin.opportunities.update', $opportunity) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.crm.opportunities._form')
            <button class="btn btn-success">Sauvegarder</button>
            <a href="{{ route('admin.opportunities.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
