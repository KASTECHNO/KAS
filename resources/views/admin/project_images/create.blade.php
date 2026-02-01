@extends('layouts.app')

@section('content')
<h2>Add Project Image</h2>

<form action="{{ route('admin.project-images.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Project *</label>
        <select name="project_id" class="form-control" required>
            @foreach($projects as $project)
                <option value="{{ $project->id }}">{{ $project->title }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Image URL *</label>
        <input type="text" name="image_url" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Caption</label>
        <input type="text" name="caption" class="form-control">
    </div>

    <div class="form-group">
        <label>Display order</label>
        <input type="number" name="display_order" class="form-control" value="0">
    </div>

    <a href="{{ route('admin.project_images.index') }}" class="btn btn-success">Save</a>
    <a href="{{ route('admin.project-images.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
