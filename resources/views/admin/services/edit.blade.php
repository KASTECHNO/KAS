@extends('layouts.app')

@section('content')
<h2>Edit Service</h2>

<form action="{{ route('admin.services.update', $service) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Title *</label>
        <input type="text" name="title" class="form-control"
               value="{{ old('title', $service->title) }}" required>
    </div>

    <div class="form-group">
        <label>Slug *</label>
        <input type="text" name="slug" class="form-control"
               value="{{ old('slug', $service->slug) }}" required>
    </div>

    <div class="form-group">
        <label>Short description</label>
        <input type="text" name="short_desc" class="form-control"
               value="{{ old('short_desc', $service->short_desc) }}">
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ old('description', $service->description) }}</textarea>
    </div>

    <div class="form-group">
        <label>Icon class</label>
        <input type="text" name="icon_class" class="form-control"
               value="{{ old('icon_class', $service->icon_class) }}">
    </div>

    <div class="form-group">
        <label>Display order</label>
        <input type="number" name="display_order" class="form-control"
               value="{{ old('display_order', $service->display_order) }}">
    </div>

    <div class="form-group">
        <label>Active</label>
        <select name="is_active" class="form-control">
            <option value="1" {{ old('is_active', $service->is_active) ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('is_active', $service->is_active) ? '' : 'selected' }}>No</option>
        </select>
    </div>

    <a href="{{ route('admin.services.index') }}" class="btn btn-success">Update</a>
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
