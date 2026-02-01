@extends('layouts.app')

@section('content')
<h2>Edit Project</h2>

<form action="{{ route('admin.projects.update', $project) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Title *</label>
        <input type="text" name="title" class="form-control"
               value="{{ old('title', $project->title) }}" required>
    </div>

    <div class="form-group">
        <label>Slug *</label>
        <input type="text" name="slug" class="form-control"
               value="{{ old('slug', $project->slug) }}" required>
    </div>

    <div class="form-group">
        <label>Short description</label>
        <input type="text" name="short_desc" class="form-control"
               value="{{ old('short_desc', $project->short_desc) }}">
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ old('description', $project->description) }}</textarea>
    </div>

    <div class="form-group">
        <label>Sector</label>
        <select name="sector_id" class="form-control">
            <option value="">-- None --</option>
            @foreach($sectors as $sector)
                <option value="{{ $sector->id }}"
                    {{ old('sector_id', $project->sector_id) == $sector->id ? 'selected' : '' }}>
                    {{ $sector->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Client</label>
        <select name="client_id" class="form-control">
            <option value="">-- None --</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}"
                    {{ old('client_id', $project->client_id) == $client->id ? 'selected' : '' }}>
                    {{ $client->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Main image URL</label>
        <input type="text" name="main_image_url" class="form-control"
               value="{{ old('main_image_url', $project->main_image_url) }}">
    </div>

    <div class="form-group">
        <label>Start date</label>
        <input type="date" name="start_date" class="form-control"
               value="{{ old('start_date', $project->start_date) }}">
    </div>

    <div class="form-group">
        <label>End date</label>
        <input type="date" name="end_date" class="form-control"
               value="{{ old('end_date', $project->end_date) }}">
    </div>

    <div class="form-group">
        <label>Featured</label>
        <select name="is_featured" class="form-control">
            <option value="1" {{ old('is_featured', $project->is_featured) ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('is_featured', $project->is_featured) ? '' : 'selected' }}>No</option>
        </select>
    </div>

   <a href="{{ route('admin.projects.index') }}" class="btn btn-primary">Update</a>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
