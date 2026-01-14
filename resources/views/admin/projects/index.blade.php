@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Projects</h2>
    <a href="{{ route('projects.create') }}" class="btn btn-primary">Add Project</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Icon</th>
            <th>Title</th>
            <th>Description</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($projects as $project)
        <tr>
            <td><i class="{{ $project->icon }}"></i> {{ $project->icon }}</td>
            <td>{{ $project->title }}</td>
            <td>{{ $project->description }}</td>
            <td>
                <a href="{{ route('projects.edit', $project) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('projects.destroy', $project) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete?')">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
