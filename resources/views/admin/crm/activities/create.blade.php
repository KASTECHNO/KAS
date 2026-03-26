@extends('layouts.adminlte')

@section('title', 'Nouvelle Activite CRM')
@section('page_title', 'Nouvelle Activite CRM')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-body">
        <form action="{{ route('admin.crm-activities.store') }}" method="POST">
            @csrf
            @include('admin.crm.activities._form')
            <button class="btn btn-success">Creer</button>
            <a href="{{ route('admin.crm-activities.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
