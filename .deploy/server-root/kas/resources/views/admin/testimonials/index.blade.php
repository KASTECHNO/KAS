@extends('layouts.adminlte')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Testimonials</h2>
    <a href="{{ route('admin.testimonials.create') }}" class="btn btn-primary">Add Testimonial</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Client</th>
            <th>Company</th>
            <th>Active</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($testimonials as $t)
        <tr>
            <td>{{ $t->client_name }}</td>
            <td>{{ $t->company }}</td>
            <td>{{ $t->is_active ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.testimonials.edit', $t) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.testimonials.delete', $t) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Del</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection

