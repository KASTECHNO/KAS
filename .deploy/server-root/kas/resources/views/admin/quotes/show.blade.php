@extends('layouts.adminlte')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Details du devis #{{ $quote->id }}</h2>

    <table class="table table-bordered">
        <tr><th>Nom complet</th><td>{{ $quote->fullname }}</td></tr>
        <tr><th>Email</th><td>{{ $quote->email }}</td></tr>
        <tr><th>Telephone</th><td>{{ $quote->phone }}</td></tr>
        <tr><th>Service</th><td>{{ $quote->service->title ?? '-' }}</td></tr>
        <tr><th>Projet</th><td>{{ $quote->project->title ?? '-' }}</td></tr>
        <tr><th>Status</th><td>{{ $quote->status }}</td></tr>
        <tr><th>Message</th><td>{{ $quote->message }}</td></tr>
    </table>

    <a href="{{ route('admin.quotes.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection

