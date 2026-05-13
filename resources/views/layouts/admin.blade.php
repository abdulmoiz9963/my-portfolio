<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard | Abdul Moiz Portfolio</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700&family=Space+Mono:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    @stack('styles')
</head>
<body class="admin-body">

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="sidebar-logo">
                <span class="logo-bracket">&lt;</span>AM<span class="logo-bracket">/&gt;</span>
            </div>
            <p class="sidebar-subtitle">Admin Panel</p>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                </li>
                <li class="{{ request()->routeIs('admin.profile*') ? 'active' : '' }}">
                    <a href="{{ route('admin.profile.edit') }}"><i class="fas fa-user"></i> Profile / About</a>
                </li>
                <li class="{{ request()->routeIs('admin.skills*') ? 'active' : '' }}">
                    <a href="{{ route('admin.skills.index') }}"><i class="fas fa-code"></i> Skills</a>
                </li>
                <li class="{{ request()->routeIs('admin.experience*') ? 'active' : '' }}">
                    <a href="{{ route('admin.experience.index') }}"><i class="fas fa-briefcase"></i> Experience</a>
                </li>
                <li class="{{ request()->routeIs('admin.projects*') ? 'active' : '' }}">
                    <a href="{{ route('admin.projects.index') }}"><i class="fas fa-folder-open"></i> Projects</a>
                </li>
                <li class="{{ request()->routeIs('admin.cv*') ? 'active' : '' }}">
                    <a href="{{ route('admin.cv.upload') }}"><i class="fas fa-file-pdf"></i> Upload CV</a>
                </li>
            </ul>
        </nav>
        <div class="sidebar-footer">
            <form action="{{ route('admin.logout') }}" method="POST">
                @csrf
                <button type="submit" class="logout-btn"><i class="fas fa-sign-out-alt"></i> Logout</button>
            </form>
            <a href="{{ route('portfolio') }}" class="view-site-btn" target="_blank"><i class="fas fa-external-link-alt"></i> View Site</a>
        </div>
    </aside>

    <!-- Main content -->
    <main class="admin-main">
        <div class="admin-topbar">
            <button class="sidebar-toggle" id="sidebarToggle"><i class="fas fa-bars"></i></button>
            <h1 class="page-title">@yield('page-title', 'Dashboard')</h1>
            <div class="topbar-right">
                <span class="admin-badge"><i class="fas fa-shield-alt"></i> Admin</span>
            </div>
        </div>

        @if(session('success'))
        <div class="alert alert-success">
            <i class="fas fa-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        @if(session('error'))
        <div class="alert alert-error">
            <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
        </div>
        @endif

        <div class="admin-content">
            @yield('content')
        </div>
    </main>

    <script src="{{ asset('js/admin.js') }}"></script>
    @stack('scripts')
</body>
</html>
