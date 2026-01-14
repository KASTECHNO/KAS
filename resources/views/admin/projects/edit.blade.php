@extends('layouts.app')

@section('content')
<h2>Edit Project</h2>

<form action="{{ route('projects.update', $project) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Icon</label>
        <input type="text" name="icon" class="form-control" value="{{ old('icon', $project->icon) }}">
    </div>

    <div class="form-group">
        <label>Title *</label>
        <input type="text" name="title" class="form-control" required value="{{ old('title', $project->title) }}">
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ old('description', $project->description) }}</textarea>
    </div>

    <button class="btn btn-success">Update</button>
    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
