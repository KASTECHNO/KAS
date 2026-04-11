@extends('layouts.adminlte')

@section('title', 'Nouvelle Opportunite')
@section('page_title', 'Nouvelle Opportunite CRM')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-body">
        <form action="{{ route('admin.opportunities.store') }}" method="POST">
            @csrf
            @include('admin.crm.opportunities._form')
            <button class="btn btn-success">Creer</button>
            <a href="{{ route('admin.opportunities.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
