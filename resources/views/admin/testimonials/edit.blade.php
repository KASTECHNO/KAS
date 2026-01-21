@extends('layouts.app')

@section('content')
<h2>Edit Testimonial</h2>

<form action="{{ route('admin.testimonials.update', $testimonial) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Client name *</label>
        <input type="text" name="client_name" class="form-control"
               value="{{ old('client_name', $testimonial->client_name) }}" required>
    </div>

    <div class="form-group">
        <label>Client role</label>
        <input type="text" name="client_role" class="form-control"
               value="{{ old('client_role', $testimonial->client_role) }}">
    </div>

    <div class="form-group">
        <label>Company</label>
        <input type="text" name="company" class="form-control"
               value="{{ old('company', $testimonial->company) }}">
    </div>

    <div class="form-group">
        <label>Message *</label>
        <textarea name="message" class="form-control" required>{{ old('message', $testimonial->message) }}</textarea>
    </div>

    <div class="form-group">
        <label>Avatar URL</label>
        <input type="text" name="avatar_url" class="form-control"
               value="{{ old('avatar_url', $testimonial->avatar_url) }}">
    </div>

    <div class="form-group">
        <label>Display order</label>
        <input type="number" name="display_order" class="form-control"
               value="{{ old('display_order', $testimonial->display_order) }}">
    </div>

    <div class="form-group">
        <label>Active</label>
        <select name="is_active" class="form-control">
            <option value="1" {{ old('is_active', $testimonial->is_active) ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('is_active', $testimonial->is_active) ? '' : 'selected' }}>No</option>
        </select>
    </div>

    <button class="btn btn-success">Update</button>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
