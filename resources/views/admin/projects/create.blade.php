@extends('layouts.app')

@section('content')
<h2>Add Project</h2>

<form action="{{ route('admin.projects.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Title *</label>
        <input type="text" name="title" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Slug *</label>
        <input type="text" name="slug" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Short description</label>
        <input type="text" name="short_desc" class="form-control">
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label>Sector</label>
        <select name="sector_id" class="form-control">
            <option value="">-- None --</option>
            @foreach($sectors as $sector)
                <option value="{{ $sector->id }}">{{ $sector->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Client</label>
        <select name="client_id" class="form-control">
            <option value="">-- None --</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Main image URL</label>
        <input type="text" name="main_image_url" class="form-control">
    </div>

    <div class="form-group">
        <label>Start date</label>
        <input type="date" name="start_date" class="form-control">
    </div>

    <div class="form-group">
        <label>End date</label>
        <input type="date" name="end_date" class="form-control">
    </div>

    <div class="form-group">
        <label>Featured</label>
        <select name="is_featured" class="form-control">
            <option value="0">No</option>
            <option value="1">Yes</option>
        </select>
    </div>

    <button class="btn btn-success">Save</button>
    <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
