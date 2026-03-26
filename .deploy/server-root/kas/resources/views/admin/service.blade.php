@extends('layouts.adminlte')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Services</h2>
    <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Add Service</a>
</div>

</form>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Slug</th>
            <th>Active</th>
            <th>Order</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($services as $service)
        <tr>
            <td>{{ $service->title }}</td>
            <td>{{ $service->slug }}</td>
            <td>{{ $service->is_active ? 'Yes' : 'No' }}</td>
            <td>{{ $service->display_order }}</td>
            <td>
                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.services.delete', $service) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm" onclick="return confirm('Delete?')">Del</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection

