@extends('layouts.app')

@section('content')
<h2>Edit Product</h2>

<form action="{{ route('admin.products.update', $product) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Name *</label>
        <input type="text" name="name" class="form-control"
               value="{{ old('name', $product->name) }}" required>
    </div>

    <div class="form-group">
        <label>Slug *</label>
        <input type="text" name="slug" class="form-control"
               value="{{ old('slug', $product->slug) }}" required>
    </div>

    <div class="form-group">
        <label>Sector *</label>
        <select name="sector_id" class="form-control" required>
            @foreach($sectors as $sector)
                <option value="{{ $sector->id }}"
                    {{ old('sector_id', $product->sector_id) == $sector->id ? 'selected' : '' }}>
                    {{ $sector->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ old('description', $product->description) }}</textarea>
    </div>

    <div class="form-group">
        <label>Price</label>
        <input type="number" step="0.01" name="price" class="form-control"
               value="{{ old('price', $product->price) }}">
    </div>

    <div class="form-group">
        <label>Image URL</label>
        <input type="text" name="image_url" class="form-control"
               value="{{ old('image_url', $product->image_url) }}">
    </div>

    <div class="form-group">
        <label>Active</label>
        <select name="is_active" class="form-control">
            <option value="1" {{ old('is_active', $product->is_active) ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('is_active', $product->is_active) ? '' : 'selected' }}>No</option>
        </select>
    </div>

    <a href="{{ route('admin.products.index') }}" class="btn btn-primary">Update</a>
    <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
