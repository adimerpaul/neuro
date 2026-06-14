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
            --sidebar-width: 240px;
            --crimson: #c0392b;
            --crimson-dk: #9b0000;
            --bg: #f5f8fc;
            --white: #fff;
            --line: #e8e0e2;
            --ink: #1e0a0d;
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
            z-index: 200;
            transition: transform .25s;
        }
        .sb-header {
            display: flex;
            align-items: center;
            gap: .75rem;
            padding: 1.25rem 1rem;
            border-bottom: 1px solid rgba(255,255,255,.08);
        }
        .sb-logo-icon { font-size: 1.8rem; line-height: 1; }
        .sb-logo-name {
            font-family: 'Sora', sans-serif; font-size: 1.05rem; font-weight: 800;
            color: #fff; line-height: 1.2;
        }
        .sb-logo-sub { font-size: .68rem; color: rgba(255,255,255,.45); }
        .sb-nav { flex: 1; padding: 0.75rem 0; overflow-y: auto; }
        .sb-label {
            display: block;
            padding: .4rem 1rem .2rem;
            font-size: .62rem;
            font-weight: 700;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: rgba(255,255,255,.3);
        }
        .sb-item {
            display: flex; align-items: center; gap: 0.65rem;
            padding: 0.6rem 1rem;
            color: rgba(255,255,255,.68);
            text-decoration: none;
            font-size: .875rem; font-weight: 500;
            transition: background 0.15s, color 0.15s;
            border-left: 3px solid transparent;
            position: relative;
        }
        .sb-item:hover { background: rgba(255,255,255,.07); color: #fff; }
        .sb-item.active { background: rgba(192,57,43,.22); color: #fff; border-left-color: var(--crimson); }
        .sb-item .si-icon { font-size: 1rem; width: 20px; text-align: center; flex-shrink: 0; }
        .sb-badge {
            margin-left: auto;
            background: var(--crimson);
            color: #fff;
            border-radius: 2rem;
            padding: 0.1rem 0.45rem;
            font-size: 0.65rem;
            font-weight: 700;
        }
        .sb-divider { border: none; border-top: 1px solid rgba(255,255,255,.08); margin: 0.5rem 0; }
        .sb-footer {
            padding: .75rem 1rem;
            border-top: 1px solid rgba(255,255,255,.08);
            display: flex;
            flex-direction: column;
            gap: .5rem;
        }
        .sb-user { display: flex; align-items: center; gap: .6rem; }
        .sb-avatar {
            width: 34px; height: 34px; border-radius: 50%;
            background: var(--crimson); color: #fff; font-family: 'Sora', sans-serif;
            font-weight: 700; font-size: .8rem; display: grid; place-items: center; flex-shrink: 0;
        }
        .sb-user-name { font-size: .82rem; font-weight: 600; color: #fff; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
        .sb-user-nick { font-size: .7rem; color: rgba(255,255,255,.45); }
        .sb-logout {
            width: 100%;
            background: none;
            border: 1px solid rgba(255,255,255,.15);
            border-radius: 8px;
            color: rgba(255,255,255,0.6);
            padding: .45em .75em;
            font-family: 'Mulish', sans-serif;
            font-size: .82rem;
            cursor: pointer;
            transition: background 0.15s;
            display: flex;
            align-items: center;
            gap: .5rem;
        }
        .sb-logout:hover { background: rgba(255,255,255,.08); color: #fff; }

        /* MAIN */
        .admin-main { margin-left: var(--sidebar-width); flex: 1; display: flex; flex-direction: column; min-height: 100vh; }
        .admin-topbar {
            background: var(--white);
            border-bottom: 1px solid var(--line);
            padding: .85rem 1.5rem;
            display: flex; align-items: center; justify-content: space-between;
            position: sticky; top: 0; z-index: 100;
            box-shadow: 0 1px 4px rgba(0,0,0,.06);
        }
        .topbar-left { display: flex; align-items: center; gap: 0.75rem; }
        .topbar-title { font-family: 'Sora', sans-serif; font-size: 1.15rem; font-weight: 700; color: var(--ink); }
        .topbar-right { display: flex; align-items: center; gap: 0.75rem; }
        .admin-avatar {
            width: 32px; height: 32px; border-radius: 50%;
            background: var(--crimson);
            display: flex; align-items: center; justify-content: center;
            font-size: 0.8rem; font-weight: 700; color: #fff;
        }
        .admin-name { font-size: 0.83rem; font-weight: 600; color: #374151; }
        .admin-role { font-size: 0.7rem; color: #9ca3af; }
        .admin-content { padding: 2rem 2rem 3rem; flex: 1; }
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
            <div>
                <div class="sb-logo-name">NeuroOruro</div>
                <div class="sb-logo-sub">2026</div>
            </div>
        </div>

        <nav class="sb-nav">
            <span class="sb-label">Menú</span>
            <a href="{{ route('portal.dashboard') }}" class="sb-item">
                <span class="si-icon">📊</span> Mi panel
            </a>
            <a href="{{ url('/portal/cronograma') }}" class="sb-item">
                <span class="si-icon">📅</span> Cronograma
            </a>
            <a href="{{ url('/portal/recursos') }}" class="sb-item">
                <span class="si-icon">📚</span> Recursos
            </a>

            <span class="sb-label" style="margin-top:1rem">Mi cuenta</span>
            <a href="{{ url('/portal/mis-datos') }}" class="sb-item">
                <span class="si-icon">👤</span> Mis Datos
            </a>
            <a href="{{ url('/portal/cambiar-password') }}" class="sb-item">
                <span class="si-icon">🔑</span> Cambiar Contraseña
            </a>

            <span class="sb-label" style="margin-top:1rem">Administración</span>
            <a href="{{ route('admin.participantes.index') }}" class="sb-item {{ request()->routeIs('admin.participantes.*') ? 'active' : '' }}">
                <span class="si-icon">👥</span> Participantes
                <span class="sb-badge" id="sb-count">...</span>
            </a>
            <a href="{{ route('admin.cronograma.index') }}" class="sb-item {{ request()->routeIs('admin.cronograma.*') ? 'active' : '' }}">
                <span class="si-icon">📅</span> Gestionar cronograma
            </a>
            <a href="{{ route('admin.precios.index') }}" class="sb-item {{ request()->routeIs('admin.precios.*') ? 'active' : '' }}">
                <span class="si-icon">💰</span> Precios
            </a>
            <a href="{{ route('admin.recursos.index') }}" class="sb-item {{ request()->routeIs('admin.recursos.*') ? 'active' : '' }}">
                <span class="si-icon">📚</span> Gestionar recursos
            </a>
            <a href="{{ route('admin.usuarios.index') }}" class="sb-item {{ request()->routeIs('admin.usuarios.*') ? 'active' : '' }}">
                <span class="si-icon">🔐</span> Usuarios
            </a>
            <hr class="sb-divider">
            <a href="{{ route('home') }}" class="sb-item">
                <span class="si-icon">🌐</span> Ver sitio
            </a>
        </nav>

        <div class="sb-footer">
            <div class="sb-user">
                <div class="sb-avatar">{{ strtoupper(substr(auth()->user()->name, 0, 1)) }}</div>
                <div>
                    <div class="sb-user-name">{{ auth()->user()->name }}</div>
                    <div class="sb-user-nick">{{ auth()->user()->nickname }}</div>
                </div>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="sb-logout"><span>↩</span> Salir</button>
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
