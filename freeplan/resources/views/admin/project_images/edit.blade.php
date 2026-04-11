@extends('layouts.adminlte')

@section('content')
<h2>Edit Project Image</h2>

<form action="{{ route('admin.project-images.update', $image) }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Project *</label>
        <select name="project_id" class="form-control" required>
            @foreach($projects as $project)
                <option value="{{ $project->id }}" {{ (int) old('project_id', $image->project_id) === (int) $project->id ? 'selected' : '' }}>
                    {{ $project->title }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Image URL</label>
        <input type="text" name="image_url" class="form-control" value="{{ old('image_url', $image->image_url) }}">
    </div>

    <div class="form-group">
        <label>Image File</label>
        <input type="file" name="image_file" class="form-control" accept="image/*">
    </div>

    <div class="form-group">
        <label>Caption</label>
        <input type="text" name="caption" class="form-control" value="{{ old('caption', $image->caption) }}">
    </div>

    <div class="form-group">
        <label>Display order</label>
        <input type="number" name="display_order" class="form-control" value="{{ old('display_order', $image->display_order) }}">
    </div>

    <button type="submit" class="btn btn-primary">Update</button>
    <a href="{{ route('admin.project-images.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
