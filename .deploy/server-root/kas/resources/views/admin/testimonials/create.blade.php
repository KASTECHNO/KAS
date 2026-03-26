@extends('layouts.adminlte')

@section('content')
<h2>Add Testimonial</h2>

<form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="form-group">
        <label>Client name *</label>
        <input type="text" name="client_name" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Client role</label>
        <input type="text" name="client_role" class="form-control">
    </div>

    <div class="form-group">
        <label>Company</label>
        <input type="text" name="company" class="form-control">
    </div>

    <div class="form-group">
        <label>Message *</label>
        <textarea name="message" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label>Avatar URL</label>
        <input type="text" name="avatar_url" class="form-control">
    </div>

    <div class="form-group">
        <label>Avatar Path (storage)</label>
        <input type="text" name="avatar_path" class="form-control" placeholder="testimonials/filename.png">
    </div>

    <div class="form-group">
        <label>Avatar File</label>
        <input type="file" name="avatar_file" class="form-control" accept="image/*">
    </div>

    <div class="form-group">
        <label>Display order</label>
        <input type="number" name="display_order" class="form-control" value="0">
    </div>

    <div class="form-group">
        <label>Active</label>
        <select name="is_active" class="form-control">
            <option value="1">Yes</option>
            <option value="0">No</option>
        </select>
    </div>

    <button type="submit" class="btn btn-success">Save</button>
    <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection

