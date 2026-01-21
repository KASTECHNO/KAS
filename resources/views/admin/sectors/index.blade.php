@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Sectors</h2>
    <a href="{{ route('admin.sectors.create') }}" class="btn btn-primary">Add Sector</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Order</th>
            <th>Active</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($sectors as $sector)
        <tr>
            <td>{{ $sector->name }}</td>
            <td>{{ $sector->display_order }}</td>
            <td>{{ $sector->is_active ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.sectors.edit', $sector) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.sectors.destroy', $sector) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Del</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
