@extends('layouts.app')

@section('content')
<h2>Edit Client</h2>

<form action="{{ route('admin.clients.update', $client) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Name *</label>
        <input type="text" name="name" class="form-control"
               value="{{ old('name', $client->name) }}" required>
    </div>

    <div class="form-group">
        <label>Sector</label>
        <select name="sector_id" class="form-control">
            <option value="">-- None --</option>
            @foreach($sectors as $sector)
                <option value="{{ $sector->id }}"
                    {{ old('sector_id', $client->sector_id) == $sector->id ? 'selected' : '' }}>
                    {{ $sector->name }}
                </option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Logo URL</label>
        <input type="text" name="logo_url" class="form-control"
               value="{{ old('logo_url', $client->logo_url) }}">
    </div>

    <div class="form-group">
        <label>Website URL</label>
        <input type="text" name="website_url" class="form-control"
               value="{{ old('website_url', $client->website_url) }}">
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control">{{ old('description', $client->description) }}</textarea>
    </div>

    <button class="btn btn-success">Update</button>
    <a href="{{ route('admin.clients.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
