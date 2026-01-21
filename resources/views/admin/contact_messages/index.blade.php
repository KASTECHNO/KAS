@extends('layouts.app')

@section('content')
<h2>Contact Messages</h2>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>Fullname</th>
            <th>Email</th>
            <th>Status</th>
            <th width="180">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach($messages as $msg)
        <tr>
            <td>{{ $msg->fullname }}</td>
            <td>{{ $msg->email }}</td>
            <td>{{ $msg->status }}</td>
            <td>
                <a href="{{ route('admin.contact-messages.show', $msg) }}" class="btn btn-info btn-sm">View</a>
                <form action="{{ route('admin.contact-messages.destroy', $msg) }}" method="POST" style="display:inline-block;">
                    @csrf @method('DELETE')
                    <button class="btn btn-danger btn-sm">Del</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
