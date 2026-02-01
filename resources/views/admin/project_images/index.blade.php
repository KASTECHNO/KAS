@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Project Images</h2>
    <a href="{{ route('admin.project-images.create') }}" class="btn btn-primary">Add Image</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Project</th>
            <th>Image</th>
            <th>Caption</th>
            <th>Order</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($images as $img)
        <tr>
            <td>{{ $img->project->title }}</td>
            <td><img src="{{ $img->image_url }}" width="80"></td>
            <td>{{ $img->caption }}</td>
            <td>{{ $img->display_order }}</td>
            <td>
                <a href="{{ route('admin.project-images.edit', $img) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.project-images.delete', $img) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Del</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
