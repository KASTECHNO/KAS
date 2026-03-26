@extends('layouts.adminlte')

@section('title', 'Modifier Activite CRM')
@section('page_title', 'Modifier Activite CRM')

@section('content')
<div class="card card-outline card-primary">
    <div class="card-body">
        <form action="{{ route('admin.crm-activities.update', $activity) }}" method="POST">
            @csrf
            @method('PUT')
            @include('admin.crm.activities._form')
            <button class="btn btn-success">Sauvegarder</button>
            <a href="{{ route('admin.crm-activities.index') }}" class="btn btn-secondary">Annuler</a>
        </form>
    </div>
</div>
@endsection
