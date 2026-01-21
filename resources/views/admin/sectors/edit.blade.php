@extends('layouts.app')

@section('content')
<h2>Edit Sector</h2>

<form action="{{ route('admin.sectors.update', $sector) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Name *</label>
        <input type="text" name="name" class="form-control"
               value="{{ old('name', $sector->name) }}" required>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ old('description', $sector->description) }}</textarea>
    </div>

    <div class="form-group">
        <label>Icon class</label>
        <input type="text" name="icon_class" class="form-control"
               value="{{ old('icon_class', $sector->icon_class) }}">
    </div>

    <div class="form-group">
        <label>Display order</label>
        <input type="number" name="display_order" class="form-control"
               value="{{ old('display_order', $sector->display_order) }}">
    </div>

    <div class="form-group">
        <label>Active</label>
        <select name="is_active" class="form-control">
            <option value="1" {{ old('is_active', $sector->is_active) ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('is_active', $sector->is_active) ? '' : 'selected' }}>No</option>
        </select>
    </div>

    <button class="btn btn-success">Update</button>
    <a href="{{ route('admin.sectors.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
