@extends('layouts.app')

@section('content')
<h2>Edit FAQ</h2>

<form action="{{ route('admin.faq.update', $faq) }}" method="POST">
    @csrf
    @method('PUT')

    <div class="form-group">
        <label>Question *</label>
        <input type="text" name="question" class="form-control"
               value="{{ old('question', $faq->question) }}" required>
    </div>

    <div class="form-group">
        <label>Answer *</label>
        <textarea name="answer" class="form-control" required>{{ old('answer', $faq->answer) }}</textarea>
    </div>

    <div class="form-group">
        <label>Category</label>
        <input type="text" name="category" class="form-control"
               value="{{ old('category', $faq->category) }}">
    </div>

    <div class="form-group">
        <label>Display order</label>
        <input type="number" name="display_order" class="form-control"
               value="{{ old('display_order', $faq->display_order) }}">
    </div>

    <div class="form-group">
        <label>Active</label>
        <select name="is_active" class="form-control">
            <option value="1" {{ old('is_active', $faq->is_active) ? 'selected' : '' }}>Yes</option>
            <option value="0" {{ old('is_active', $faq->is_active) ? '' : 'selected' }}>No</option>
        </select>
    </div>

    <button class="btn btn-success">Update</button>
    <a href="{{ route('admin.faq.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
