@extends('layouts.app')

@section('content')
<h2>Add Product</h2>

<form action="{{ route('admin.products.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Name *</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Slug *</label>
        <input type="text" name="slug" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Sector *</label>
        <select name="sector_id" class="form-control" required>
            @foreach($sectors as $sector)
                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label>Price</label>
        <input type="number" step="0.01" name="price" class="form-control">
    </div>

    <div class="form-group">
        <label>Image URL</label>
        <input type="text" name="image_url" class="form-control">
    </div>

    <div class="form-group">
        <label>Active</label>
        <select name="is_active" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>

    <a href="{{ route('admin.products.index') }}" class="btn btn-success">Save</a>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
