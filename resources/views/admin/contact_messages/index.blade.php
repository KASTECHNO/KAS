@extends('layouts.adminlte')

@section('content')
<div class="container">
    <h1>Contact Messages</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Full Name</th>
                <th>Phone</th>
                <th>Email</th>
                <th>Message</th>
               
            </tr>
        </thead>
        <tbody>
            @foreach($messages as $msg)
                <tr>
                    <td>{{ $msg->fullname }}</td>
                    <td>{{ $msg->phone }}</td>
                    <td>{{ $msg->email }}</td>
                    <td>{{ $msg->message }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $messages->links() }}
</div>
@endsection

