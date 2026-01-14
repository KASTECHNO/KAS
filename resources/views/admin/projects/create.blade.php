@extends('layouts.app')

@section('content')
<h2>Add Project</h2>

<form action="{{ route('projects.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Icon (FontAwesome class)</label>
        <input type="text" name="icon" class="form-control" placeholder="fa fa-hotel" value="{{ old('icon') }}">
    </div>

    <div class="form-group">
        <label>Title *</label>
        <input type="text" name="title" class="form-control" required value="{{ old('title') }}">
        @error('title') <small class="text-danger">{{ $message }}</small> @enderror
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ old('description') }}</textarea>
    </div>

    <button class="btn btn-success">Save</button>
    <a href="{{ route('projects.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
