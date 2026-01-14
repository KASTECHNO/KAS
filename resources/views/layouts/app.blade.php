<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - KAS</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <a class="navbar-brand" href="#">Admin</a>
    <div class="navbar-nav">
        <a class="nav-item nav-link" href="{{ route('projects.index') }}">Projects</a>
        <!-- plus tard : Services, Team, FAQ, etc. -->
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @yield('content')
</div>

</body>
</html>
