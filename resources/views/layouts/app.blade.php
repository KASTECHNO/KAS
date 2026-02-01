<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - KAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="{{ url('/') }}">KAS Admin</a>
    <div class="navbar-nav">
        <a class="nav-item nav-link" href="{{ route('admin.services.index') }}">Services</a>
        <a class="nav-item nav-link" href="{{ route('admin.projects.index') }}">Projects</a>
        <a class="nav-item nav-link" href="{{ route('admin.clients.index') }}">Clients</a>
        <a class="nav-item nav-link" href="{{ route('admin.sectors.index') }}">Sectors</a>
        <a class="nav-item nav-link" href="{{ route('admin.quotes.index') }}">Quote</a>
        <a class="nav-item nav-link" href="{{ route('admin.testimonials.index') }}">Testimonials</a>
        <a class="nav-item nav-link" href="{{ route('admin.products.index') }}">Products</a>
        <a class="nav-item nav-link" href="{{ route('admin.contact-messages.index') }}">Messages</a>
 
    </div>
</nav>
       <form method="POST" action="{{ route('logout') }}">
    @csrf
    <button type="submit" class="btn btn-danger">
        Logout
    </button>
<div class="container">
    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>
</body>
</html>
