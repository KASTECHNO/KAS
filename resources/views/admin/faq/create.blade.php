@extends('layouts.app')

@section('content')
<h2>Add FAQ</h2>

<form action="{{ route('admin.faq.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label>Question *</label>
        <input type="text" name="question" class="form-control" required>
    </div>

    <div class="form-group">
        <label>Answer *</label>
        <textarea name="answer" class="form-control" required></textarea>
    </div>

    <div class="form-group">
        <label>Category</label>
        <input type="text" name="category" class="form-control">
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

    <button class="btn btn-success">Save</button>
    <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
