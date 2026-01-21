@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Products</h2>
    <a href="{{ route('admin.products.create') }}" class="btn btn-primary">Add Product</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Name</th>
            <th>Sector</th>
            <th>Price</th>
            <th>Active</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($products as $p)
        <tr>
            <td>{{ $p->name }}</td>
            <td>{{ $p->sector->name }}</td>
            <td>{{ $p->price }}</td>
            <td>{{ $p->is_active ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.products.edit', $p) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.products.destroy', $p) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Del</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
