@extends('layouts.app')

@section('content')
<h2>Add Client</h2>

<form action="{{ route('admin.clients.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Name *</label>
        <input type="text" name="name" class="form-control" required>
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
        <label>Logo URL</label>
        <input type="text" name="logo_url" class="form-control">
    </div>

    <div class="form-group">
        <label>Website URL</label>
        <input type="text" name="website_url" class="form-control">
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <button class="btn btn-success">Save</button>
    <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
