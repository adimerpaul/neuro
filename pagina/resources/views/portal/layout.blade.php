<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Portal') — NeuroOruro 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --navy-900: #0d0003;
            --navy-800: #1a0006;
            --crimson: #c0392b;
            --crimson-light: #e74c3c;
            --bg: #f5f8fc;
            --sidebar-width: 240px;
        }
        body {
            font-family: 'Mulish', sans-serif;
            background: var(--bg);
            display: flex;
            min-height: 100vh;
        }
        /* SIDEBAR */
        .sidebar {
            width: var(--sidebar-width);
            background: var(--navy-800);
            display: flex;
            flex-direction: column;
            position: fixed;
            top: 0; left: 0; bottom: 0;
            z-index: 100;
        }
        .sidebar-logo {
            padding: 1.5rem 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }
        .sidebar-logo .logo-icon { font-size: 1.75rem; margin-bottom: 0.25rem; }
        .sidebar-logo .logo-name {
            font-family: 'Sora', sans-serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: #fff;
            line-height: 1.2;
        }
        .sidebar-logo .logo-sub {
            font-size: 0.7rem;
            color: rgba(255,255,255,0.5);
        }
        .sidebar-nav { flex: 1; padding: 1rem 0; overflow-y: auto; }
        .nav-label {
            padding: 0.5rem 1.25rem 0.25rem;
            font-size: 0.65rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: rgba(255,255,255,0.35);
        }
        .nav-item {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.65rem 1.25rem;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-size: 0.875rem;
            font-weight: 500;
            transition: background 0.15s, color 0.15s;
            border-left: 3px solid transparent;
        }
        .nav-item:hover {
            background: rgba(255,255,255,0.06);
            color: #fff;
        }
        .nav-item.active {
            background: rgba(192,57,43,0.2);
            color: #fff;
            border-left-color: var(--crimson);
        }
        .nav-item .icon { font-size: 1rem; width: 1.25rem; text-align: center; }
        .nav-divider { border: none; border-top: 1px solid rgba(255,255,255,0.08); margin: 0.5rem 0; }
        .nav-admin-link {
            margin: 0 0.75rem 0.5rem;
            background: rgba(192,57,43,0.2);
            border: 1px solid rgba(192,57,43,0.4);
            border-radius: 0.5rem;
            padding: 0.5rem 0.75rem;
            color: #ff9090;
            text-decoration: none;
            font-size: 0.8rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .nav-admin-link:hover { background: rgba(192,57,43,0.35); color: #fff; }
        /* Sidebar footer */
        .sidebar-footer {
            padding: 1rem 1.25rem;
            border-top: 1px solid rgba(255,255,255,0.08);
        }
        .user-info {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }
        .user-avatar {
            width: 36px; height: 36px;
            border-radius: 50%;
            background: var(--crimson);
            display: flex; align-items: center; justify-content: center;
            font-weight: 700; color: #fff; font-size: 0.9rem;
            flex-shrink: 0;
        }
        .user-name { font-size: 0.8rem; font-weight: 600; color: #fff; }
        .user-role { font-size: 0.7rem; color: rgba(255,255,255,0.45); }
        .btn-logout {
            width: 100%;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 0.4rem;
            color: rgba(255,255,255,0.6);
            padding: 0.45rem;
            font-family: 'Mulish', sans-serif;
            font-size: 0.8rem;
            cursor: pointer;
            transition: background 0.15s;
        }
        .btn-logout:hover { background: rgba(255,255,255,0.12); color: #fff; }

        /* MAIN CONTENT */
        .main-content {
            margin-left: var(--sidebar-width);
            flex: 1;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0.875rem 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 50;
        }
        .topbar-title {
            font-family: 'Sora', sans-serif;
            font-size: 1.125rem;
            font-weight: 700;
            color: #0d0003;
        }
        .topbar-user {
            font-size: 0.8rem;
            color: #555;
        }
        .page-body {
            padding: 2rem;
            flex: 1;
        }
        /* Alerts */
        .alert-success {
            background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 0.5rem;
            padding: 0.75rem 1rem; color: #166534; font-size: 0.875rem; margin-bottom: 1.25rem;
        }
        .alert-error {
            background: #fef2f2; border: 1px solid #fecaca; border-radius: 0.5rem;
            padding: 0.75rem 1rem; color: #991b1b; font-size: 0.875rem; margin-bottom: 1.25rem;
        }
        @media (max-width: 768px) {
            .sidebar { transform: translateX(-100%); }
            .main-content { margin-left: 0; }
        }
    </style>
    @stack('styles')
</head>
<body>
    <!-- SIDEBAR -->
    <aside class="sidebar">
        <div class="sidebar-logo">
            <div class="logo-icon">🧠</div>
            <div class="logo-name">NeuroOruro</div>
            <div class="logo-sub">Portal del Participante</div>
        </div>

        <nav class="sidebar-nav">
            <div class="nav-label">Mi espacio</div>
            <a href="{{ route('portal.dashboard') }}"
               class="nav-item {{ request()->routeIs('portal.dashboard') ? 'active' : '' }}">
                <span class="icon">📊</span> Dashboard
            </a>
            <a href="{{ route('portal.cronograma') }}"
               class="nav-item {{ request()->routeIs('portal.cronograma') ? 'active' : '' }}">
                <span class="icon">📅</span> Cronograma
            </a>
            <a href="{{ route('portal.recursos') }}"
               class="nav-item {{ request()->routeIs('portal.recursos') ? 'active' : '' }}">
                <span class="icon">📚</span> Recursos
            </a>
            <hr class="nav-divider">
            <div class="nav-label">Mi cuenta</div>
            <a href="{{ route('portal.mis-datos') }}"
               class="nav-item {{ request()->routeIs('portal.mis-datos') ? 'active' : '' }}">
                <span class="icon">👤</span> Mis Datos
            </a>
            <a href="{{ route('portal.cambiar-password') }}"
               class="nav-item {{ request()->routeIs('portal.cambiar-password') ? 'active' : '' }}">
                <span class="icon">🔑</span> Cambiar Contraseña
            </a>

            @if(auth()->user()->hasRole('admin'))
                <hr class="nav-divider">
                <a href="{{ route('admin.dashboard') }}" class="nav-admin-link">
                    <span>⚙</span> Panel Admin
                </a>
            @endif
        </nav>

        <div class="sidebar-footer">
            <div class="user-info">
                <div class="user-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div class="user-name">{{ auth()->user()->name }}</div>
                    <div class="user-role">@{{ auth()->user()->nickname }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn-logout">Cerrar sesión</button>
            </form>
        </div>
    </aside>

    <!-- CONTENIDO PRINCIPAL -->
    <div class="main-content">
        <div class="topbar">
            <div class="topbar-title">@yield('title', 'Portal')</div>
            <div class="topbar-user">{{ auth()->user()->name }}</div>
        </div>

        <div class="page-body">
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            @yield('portal-content')
        </div>
    </div>
</body>
</html>
