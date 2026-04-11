@extends('layouts.adminlte')

@section('content')
<h2>Add Sector</h2>

<form action="{{ route('admin.sectors.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Name *</label>
        <input type="text" name="name" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Description</label>
        <textarea name="description" class="form-control"></textarea>
    </div>

    <div class="form-group">
        <label>Icon class</label>
        <input type="text" name="icon_class" class="form-control">
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
    <a href="{{ route('admin.sectors.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection

