@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>FAQ</h2>
    <a href="{{ route('admin.faq.create') }}" class="btn btn-primary">Add Question</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Question</th>
            <th>Category</th>
            <th>Active</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($faq as $item)
        <tr>
            <td>{{ $item->question }}</td>
            <td>{{ $item->category }}</td>
            <td>{{ $item->is_active ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.faq.edit', $item) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.faq.destroy', $item) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Del</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
