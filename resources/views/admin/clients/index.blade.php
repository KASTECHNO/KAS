@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Clients</h2>
    <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">Add Client</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Sector</th>
            <th>Website</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{ $client->name }}</td>
            <td>{{ $client->sector->name ?? '-' }}</td>
            <td>{{ $client->website_url }}</td>
            <td>
                <a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.clients.destroy', $client) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Del</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
