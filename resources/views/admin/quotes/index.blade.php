@extends('layouts.adminlte')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Quotes</h2>
    <a href="{{ route('admin.quotes.create') }}" class="btn btn-primary">Add Quote</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Full Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Service</th>
            <th>Project</th>
            <th>Status</th>
            <th width="220">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($quotes as $quote)
        <tr>
            <td>{{ $quote->id }}</td>
            <td>{{ $quote->fullname }}</td>
            <td>{{ $quote->email }}</td>
            <td>{{ $quote->phone }}</td>
            <td>{{ $quote->service->title ?? '-' }}</td>
            <td>{{ $quote->project->title ?? '-' }}</td>
            <td>{{ $quote->status }}</td>
            <td>
                <a href="{{ route('admin.quotes.show', $quote) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('admin.quotes.edit', $quote) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.quotes.delete', $quote) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger btn-sm">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

