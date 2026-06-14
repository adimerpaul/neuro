<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>@yield('title', 'Admin') — NeuroOruro 2026</title>
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Sora:wght@400;500;600;700;800&family=Mulish:wght@400;500;600;700&display=swap" rel="stylesheet"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
        :root {
            --sidebar-bg: #1a0006;
            --sidebar-width: 220px;
            --crimson: #c0392b;
            --bg: #f5f8fc;
        }
        body {
            font-family: 'Mulish', sans-serif;
            background: var(--bg);
            display: flex;
            min-height: 100vh;
        }
        /* SIDEBAR */
        .admin-sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            position: fixed; top:0; left:0; bottom:0;
            display: flex; flex-direction: column;
            z-index: 100;
        }
        .sb-header {
            padding: 1.25rem 1rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.07);
        }
        .sb-logo-icon { font-size: 1.5rem; margin-bottom: 0.2rem; }
        .sb-logo-name {
            font-family: 'Sora', sans-serif; font-size: 1rem; font-weight: 700;
            color: #fff; line-height: 1.2;
        }
        .sb-logo-sub { font-size: 0.65rem; color: rgba(255,255,255,0.4); margin-top: 0.1rem; }
        .sb-nav { flex: 1; padding: 0.75rem 0; overflow-y: auto; }
        .sb-item {
            display: flex; align-items: center; gap: 0.65rem;
            padding: 0.6rem 1rem;
            color: rgba(255,255,255,0.65);
            text-decoration: none;
            font-size: 0.83rem; font-weight: 500;
            transition: background 0.15s, color 0.15s;
            border-left: 3px solid transparent;
            position: relative;
        }
        .sb-item:hover { background: rgba(255,255,255,0.06); color: #fff; }
        .sb-item.active { background: rgba(192,57,43,0.2); color: #fff; border-left-color: var(--crimson); }
        .sb-item .si-icon { font-size: 0.95rem; width: 1.1rem; text-align: center; }
        .sb-badge {
            margin-left: auto;
            background: var(--crimson);
            color: #fff;
            border-radius: 2rem;
            padding: 0.1rem 0.45rem;
            font-size: 0.65rem;
            font-weight: 700;
        }
        .sb-divider { border: none; border-top: 1px solid rgba(255,255,255,0.06); margin: 0.4rem 0; }
        .sb-footer {
            padding: 0.875rem 1rem;
            border-top: 1px solid rgba(255,255,255,0.07);
        }
        .sb-version { font-size: 0.65rem; color: rgba(255,255,255,0.3); margin-bottom: 0.5rem; }
        .sb-logout {
            width: 100%;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.1);
            border-radius: 0.4rem;
            color: rgba(255,255,255,0.6);
            padding: 0.4rem;
            font-family: 'Mulish', sans-serif;
            font-size: 0.78rem;
            cursor: pointer;
            transition: background 0.15s;
        }
        .sb-logout:hover { background: rgba(255,255,255,0.12); color: #fff; }

        /* MAIN */
        .admin-main { margin-left: var(--sidebar-width); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid #e5e7eb;
            padding: 0.875rem 2rem;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 50;
        }
        .topbar-left { display: flex; align-items: center; gap: 0.75rem; }
        .topbar-title { font-family: 'Sora', sans-serif; font-size: 1.1rem; font-weight: 700; color: #0d0003; }
        .topbar-right { display: flex; align-items: center; gap: 0.75rem; }
        .admin-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--crimson);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; font-weight: 700; color: #fff;
        }
        .admin-name { font-size: 0.83rem; font-weight: 600; color: #374151; }
        .admin-role { font-size: 0.7rem; color: #9ca3af; }
        .admin-content { padding: 1.75rem 2rem; flex: 1; }
        /* Alerts */
        .alert-success {
            background: #f0fdf4; border: 1px solid #bbf7d0; border-radius: 0.5rem;
            padding: 0.75rem 1rem; color: #166534; font-size: 0.875rem; margin-bottom: 1.25rem;
        }
        .alert-error {
            background: #fef2f2; border: 1px solid #fecaca; border-radius: 0.5rem;
            padding: 0.75rem 1rem; color: #991b1b; font-size: 0.875rem; margin-bottom: 1.25rem;
        }
    </style>
    @stack('styles')
</head>
<body>
    <aside class="admin-sidebar">
        <div class="sb-header">
            <div class="sb-logo-icon">🧠</div>
            <div class="sb-logo-name">NeuroOruro</div>
            <div class="sb-logo-sub">Panel de Administración</div>
        </div>

        <nav class="sb-nav">
            <a href="{{ route('admin.dashboard') }}" class="sb-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <span class="si-icon">📊</span> Dashboard
            </a>
            <a href="{{ route('admin.participantes.index') }}" class="sb-item {{ request()->routeIs('admin.participantes.*') ? 'active' : '' }}">
                <span class="si-icon">👥</span> Participantes
                <span class="sb-badge" id="sb-count">...</span>
            </a>
            <hr class="sb-divider">
            <a href="{{ route('admin.cronograma.index') }}" class="sb-item {{ request()->routeIs('admin.cronograma.*') ? 'active' : '' }}">
                <span class="si-icon">📅</span> Cronograma
            </a>
            <a href="{{ route('admin.precios.index') }}" class="sb-item {{ request()->routeIs('admin.precios.*') ? 'active' : '' }}">
                <span class="si-icon">💰</span> Precios
            </a>
            <a href="{{ route('admin.recursos.index') }}" class="sb-item {{ request()->routeIs('admin.recursos.*') ? 'active' : '' }}">
                <span class="si-icon">📚</span> Recursos
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="sb-item {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
                <span class="si-icon">🔐</span> Usuarios
            </a>
            <hr class="sb-divider">
            <a href="{{ route('home') }}" class="sb-item">
                <span class="si-icon">🌐</span> Ver sitio
            </a>
            <a href="{{ route('portal.dashboard') }}" class="sb-item">
                <span class="si-icon">👤</span> Mi portal
            </a>
        </nav>

        <div class="sb-footer">
            <div class="sb-version">NeuroOruro 2026 v1.0</div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sb-logout">Cerrar sesión</button>
            </form>
        </div>
    </aside>

    <div class="admin-main">
        <div class="admin-topbar">
            <div class="topbar-left">
                <div class="topbar-title">@yield('title', 'Admin')</div>
            </div>
            <div class="topbar-right">
                <div>
                    <div class="admin-name">{{ auth()->user()->name }}</div>
                    <div class="admin-role">Administrador</div>
                </div>
                <div class="admin-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
            </div>
        </div>

        <div class="admin-content">
            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            @yield('admin-content')
        </div>
    </div>

    <script>
    // Fetch badge count
    fetch('{{ route('admin.stats') }}')
        .then(r => r.json())
        .then(d => {
            const el = document.getElementById('sb-count');
            if (el) el.textContent = d.total_registros ?? '0';
        }).catch(() => {});
    </script>
    @stack('scripts')
</body>
</html>
