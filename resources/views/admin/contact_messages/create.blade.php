@extends('layouts.adminlte')

@section('content')
<h2>Message Details</h2>

<div class="card p-3">
    <p><strong>Name:</strong> {{ $contact_message->fullname }}</p>
    <p><strong>Email:</strong> {{ $contact_message->email }}</p>
    <p><strong>Phone:</strong> {{ $contact_message->phone }}</p>
    <p><strong>Subject:</strong> {{ $contact_message->subject }}</p>
    <p><strong>Message:</strong><br>{{ $contact_message->message }}</p>
    <p><strong>Status:</strong> {{ $contact_message->status }}</p>
</div>

<a href="{{ route('admin.contact-messages.index') }}" class="btn btn-secondary mt-3">Back</a>
@endsection

