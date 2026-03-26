@extends('layouts.adminlte')

@section('title', 'Nouveau Lead')
@section('page_title', 'Nouveau Lead CRM')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-body">
        <form action="{{ route('admin.leads.store') }}" method="POST">
            @csrf
            @include('admin.crm.leads._form')
            <button class="btn btn-success">Creer</button>
            <a href="{{ route('admin.leads.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
