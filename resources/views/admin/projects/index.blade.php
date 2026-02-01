@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between mb-3">
    <h2>Projects</h2>
    <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">Add Project</a>
</div>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Title</th>
            <th>Client</th>
            <th>Sector</th>
            <th>Featured</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($projects as $project)
        <tr>
            <td>{{ $project->title }}</td>
            <td>{{ $project->client->name ?? '-' }}</td>
            <td>{{ $project->sector->name ?? '-' }}</td>
            <td>{{ $project->is_featured ? 'Yes' : 'No' }}</td>
            <td>
                <a href="{{ route('admin.projects.edit', $project) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('admin.projects.delete', $project) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Del</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
