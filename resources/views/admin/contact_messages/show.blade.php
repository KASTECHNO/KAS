@extends('layouts.adminlte')

@section('content')
<div class="container py-4">
    <h2 class="mb-3">Message Contact #{{ $message->id }}</h2>

    <table class="table table-bordered">
        <tr><th>Nom complet</th><td>{{ $message->fullname }}</td></tr>
        <tr><th>Email</th><td>{{ $message->email }}</td></tr>
        <tr><th>Telephone</th><td>{{ $message->phone }}</td></tr>
        <tr><th>Message</th><td>{{ $message->message }}</td></tr>
    </table>

    <a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection

