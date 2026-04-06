<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Admin Dashboard')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
    <style>
        :root {
            --kas-bg: #eef2ff;
            --kas-surface: #ffffff;
            --kas-ink: #0b1324;
            --kas-muted: #4f5d75;
            --kas-line: #d8e0f2;
            --kas-primary: #0a66c2;
            --kas-secondary: #0f766e;
            --kas-shadow: 0 16px 38px rgba(11, 19, 36, 0.08);
            --kas-radius: 14px;
        }

        body {
            font-family: 'Manrope', sans-serif;
            color: var(--kas-ink);
            background:
                radial-gradient(circle at 0% 0%, #dbeafe 0, transparent 24%),
                radial-gradient(circle at 100% 0%, #ccfbf1 0, transparent 20%),
                var(--kas-bg);
        }

        .content-wrapper {
            background: transparent;
        }

        .main-header.navbar {
            background: rgba(255, 255, 255, 0.9);
            border-bottom: 1px solid var(--kas-line);
            backdrop-filter: blur(8px);
        }

        .main-header .nav-link,
        .main-header .btn-link.nav-link {
            color: var(--kas-ink);
            font-weight: 600;
        }

        .main-header .nav-link:hover,
        .main-header .btn-link.nav-link:hover {
            color: var(--kas-primary);
        }

        .main-sidebar {
            background: linear-gradient(180deg, #0b1324 0%, #10203b 100%) !important;
        }

        .brand-link {
            border-bottom: 1px solid rgba(255, 255, 255, 0.08) !important;
            background: rgba(255, 255, 255, 0.03);
        }

        .brand-text {
            font-weight: 800 !important;
            letter-spacing: 0.02em;
        }

        .sidebar .nav-link {
            border-radius: 10px;
            margin: 2px 8px;
            color: #dbe7ff !important;
            font-weight: 600;
        }

        .sidebar .nav-link.active {
            background: linear-gradient(135deg, var(--kas-primary), var(--kas-secondary)) !important;
            color: #fff !important;
            box-shadow: 0 8px 18px rgba(10, 102, 194, 0.35);
        }

        .sidebar .nav-link:hover {
            background: rgba(255, 255, 255, 0.08);
            color: #fff !important;
        }

        .content-header h1 {
            font-weight: 800;
            letter-spacing: -0.01em;
        }

        .content .container-fluid {
            padding-top: 4px;
        }

        .card,
        .small-box,
        .info-box,
        .table,
        .alert,
        .form-control,
        .custom-select,
        .input-group-text {
            border-radius: var(--kas-radius);
        }

        .table,
        .alert,
        .form-control,
        .custom-select,
        .input-group-text,
        .btn,
        .card {
            border-color: var(--kas-line) !important;
        }

        .table,
        .alert,
        .card,
        .form-control,
        .custom-select {
            background: var(--kas-surface);
            box-shadow: var(--kas-shadow);
        }

        .table thead th {
            border-bottom: 1px solid var(--kas-line);
            background: #f5f8ff;
            color: #1e3a8a;
            font-weight: 700;
            text-transform: uppercase;
            font-size: 0.78rem;
            letter-spacing: 0.04em;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .btn {
            border-radius: 10px;
            font-weight: 700;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--kas-primary), #1c7ed6);
            border: 0 !important;
        }

        .btn-success {
            background: linear-gradient(135deg, var(--kas-secondary), #149c91);
            border: 0 !important;
        }

        .btn-warning,
        .btn-danger,
        .btn-info,
        .btn-secondary {
            border: 0 !important;
        }

        .btn:hover {
            transform: translateY(-1px);
        }

        .form-group label,
        .form-label {
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 6px;
        }

        .main-footer {
            border-top: 1px solid var(--kas-line);
            background: rgba(255, 255, 255, 0.75);
        }

        @media (max-width: 768px) {
            .content-header .col-sm-6 h1 {
                font-size: 1.45rem;
            }
        }
    </style>
</head>
<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
            </li>
        </ul>

        <ul class="navbar-nav ml-auto">
            <li class="nav-item d-none d-sm-inline-block">
                <a href="{{ route('home') }}" class="nav-link">Site public</a>
            </li>
            <li class="nav-item">
                <form method="POST" action="{{ route('logout') }}" class="d-inline">
                    @csrf
                    <button type="submit" class="btn btn-link nav-link" style="border:0;">Deconnexion</button>
                </form>
            </li>
        </ul>
    </nav>

    <aside class="main-sidebar sidebar-dark-primary elevation-4">
        <a href="{{ route('admin.dashboard') }}" class="brand-link">
            <span class="brand-text font-weight-light">KAS Admin</span>
        </a>

        <div class="sidebar">
            <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                <div class="image">
                    <i class="fas fa-user-circle text-light"></i>
                </div>
                <div class="info">
                    <a href="#" class="d-block">{{ auth()->user()->name ?? 'Admin' }}</a>
                </div>
            </div>

            <nav class="mt-2">
                <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="nav-icon fas fa-gauge"></i><p>Dashboard</p>
                        </a>
                    </li>
                    <li class="nav-item"><a href="{{ route('admin.services.index') }}" class="nav-link {{ request()->routeIs('admin.services.*') ? 'active' : '' }}"><i class="nav-icon fas fa-screwdriver-wrench"></i><p>Services</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.sectors.index') }}" class="nav-link {{ request()->routeIs('admin.sectors.*') ? 'active' : '' }}"><i class="nav-icon fas fa-layer-group"></i><p>Secteurs</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.clients.index') }}" class="nav-link {{ request()->routeIs('admin.clients.*') ? 'active' : '' }}"><i class="nav-icon fas fa-users"></i><p>Clients</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.leads.index') }}" class="nav-link {{ request()->routeIs('admin.leads.*') ? 'active' : '' }}"><i class="nav-icon fas fa-user-plus"></i><p>Leads</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.opportunities.index') }}" class="nav-link {{ request()->routeIs('admin.opportunities.*') ? 'active' : '' }}"><i class="nav-icon fas fa-handshake"></i><p>Opportunites</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.crm-activities.index') }}" class="nav-link {{ request()->routeIs('admin.crm-activities.*') ? 'active' : '' }}"><i class="nav-icon fas fa-list-check"></i><p>Activites CRM</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.projects.index') }}" class="nav-link {{ request()->routeIs('admin.projects.*') ? 'active' : '' }}"><i class="nav-icon fas fa-diagram-project"></i><p>Projets</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.testimonials.index') }}" class="nav-link {{ request()->routeIs('admin.testimonials.*') ? 'active' : '' }}"><i class="nav-icon fas fa-comments"></i><p>Temoignages</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.contact-messages.index') }}" class="nav-link {{ request()->routeIs('admin.contact-messages.*') ? 'active' : '' }}"><i class="nav-icon fas fa-envelope"></i><p>Messages</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.company.index') }}" class="nav-link {{ request()->routeIs('admin.company.*') ? 'active' : '' }}"><i class="nav-icon fas fa-building"></i><p>Entreprise</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.stages.index') }}" class="nav-link {{ request()->routeIs('admin.stages.*') ? 'active' : '' }}"><i class="nav-icon fas fa-graduation-cap"></i><p>Stages</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.candidatures.index') }}" class="nav-link {{ request()->routeIs('admin.candidatures.*') ? 'active' : '' }}"><i class="nav-icon fas fa-file-alt"></i><p>Candidatures</p></a></li>
                    <li class="nav-item"><a href="{{ route('admin.pricing.index') }}" class="nav-link {{ request()->routeIs('admin.pricing.*') ? 'active' : '' }}"><i class="nav-icon fas fa-tags"></i><p>Tarifs</p></a></li>
                </ul>
            </nav>
        </div>
    </aside>

    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">@yield('page_title', 'Administration')</h1>
                    </div>
                </div>
            </div>
        </div>

        <section class="content">
            <div class="container-fluid pb-3">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0 pl-3">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @yield('content')
            </div>
        </section>
    </div>

    <footer class="main-footer text-sm">
        <strong>KAS</strong> - Admin console
    </footer>
</div>

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/js/adminlte.min.js"></script>
</body>
</html>
