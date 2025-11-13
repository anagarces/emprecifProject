<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name'))</title>

    {{-- Tipografías --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@700;800;900&display=swap" rel="stylesheet">

    {{-- Tailwind (solo utilidades necesarias) --}}
    @vite(['resources/css/app.css','resources/js/app.js'])

    {{-- Estilos del dashboard --}}
    <style>
        :root {
            --primary: #4F46E5;
            --secondary: #9333EA;
            --accent: #EC4899;
            --gray: #64748B;
            --light: #F8FAFC;
            --white: #FFFFFF;
            --danger: #EF4444;
        }

        body {
            margin: 0;
            padding: 0;
            background: #F8FAFC;
            font-family: 'Inter', sans-serif;
            color: #1E293B;
        }

        .app-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            min-height: 100vh;
        }

        /* Sidebar */
        .sidebar {
            background: white;
            padding: 2rem;
            border-right: 1px solid #E2E8F0;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar-nav {
            list-style: none;
            padding: 0;
        }

        .sidebar-nav li {
            margin-bottom: 0.5rem;
        }

        .sidebar-nav a {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.9rem 1rem;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            color: var(--gray);
            transition: 0.2s;
        }

        .sidebar-nav a:hover,
        .sidebar-nav a.active {
            background: var(--light);
            color: var(--primary);
        }

        /* Enlaces del footer del sidebar (Volver / Cerrar sesión) */
        .sidebar-footer-link {
            display: block;
            padding: 0.75rem 1rem;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 600;
            color: var(--gray);
            text-decoration: none;
            transition: background 0.3s, color 0.3s;
        }

        .sidebar-footer-link:hover {
            background: var(--light);
            color: var(--primary);
        }

        .sidebar-footer-link.danger {
            color: var(--danger);
        }

        /* Main Content */
        .main-content {
            padding: 3rem;
            overflow-y: auto;
        }
    </style>

    @stack('styles')
</head>

<body>
    <div class="app-layout">

        {{-- SIDEBAR GLOBAL DEL DASHBOARD --}}
        <aside class="sidebar">
            <div style="margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 2px solid #E2E8F0;">
                <a href="{{ route('home') }}" style="display: block; margin-bottom: 2rem;">
                    <img src="{{ asset('images/logo_emprecif_wordmark.png') }}" alt="EmpreciF" style="height: 35px;">
                </a>

                {{-- Avatar --}}
                <div style="
                    width: 60px; height: 60px; 
                    background: linear-gradient(135deg, var(--primary), var(--secondary));
                    border-radius: 50%;
                    display: flex; align-items: center; justify-content: center;
                    color: white; font-size: 1.5rem; font-weight: 900;
                    margin-bottom: 1rem;">
                    {{ strtoupper(substr(Auth::user()->name,0,2)) }}
                </div>

                <h3 style="font-weight: 800; font-size: 1.125rem; margin: 0 0 0.25rem;">
                    {{ Auth::user()->name }}
                </h3>
                <p style="font-size: 0.875rem; color: var(--gray); margin:0;">
    @if(Auth::user()->hasRole('admin'))
        Administrador
    @elseif(Auth::user()->hasRole('premium'))
        Plan Premium
    @else
        Plan Gratis
    @endif
</p>

            </div>

            {{-- Navigation --}}
            <ul class="sidebar-nav">
                <li><a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active':'' }}">📊 Dashboard</a></li>
                <li><a href="{{ route('company.search') }}" class="{{ request()->routeIs('company.*') ? 'active':'' }}">🔍 Buscar Empresas</a></li>
                <li><a href="{{ route('favorites.index') }}" class="{{ request()->routeIs('favorites.*') ? 'active':'' }}">⭐ Favoritos</a></li>
                <li><a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'active':'' }}">👤 Mi Cuenta</a></li>
                <li><a href="{{ route('subscription.plans') }}" class="{{ request()->routeIs('subscription.*') ? 'active':'' }}">💳 Suscripción</a></li>
                <li><a href="{{ route('reports.index') }}" class="{{ request()->routeIs('reports.*') ? 'active':'' }}">📄 Informes</a></li>
                <li><a href="{{ route('alerts.index') }}" class="{{ request()->routeIs('alerts.*') ? 'active':'' }}">🔔 Alertas</a></li>
                <li><a href="{{ route('settings') }}" class="{{ request()->routeIs('settings') ? 'active':'' }}">⚙️ Configuración</a></li>
            </ul>

            {{-- Footer --}}
            <div style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #E2E8F0;">
                <a href="{{ route('home') }}" class="sidebar-footer-link">← Volver al Inicio</a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                        class="sidebar-footer-link danger"
                        style="background:none;border:none;padding:0;margin-top:0.25rem;text-align:left;cursor:pointer;">
                        🚪 Cerrar sesión
                    </button>
                </form>
            </div>
        </aside>

        {{-- CONTENIDO DEL PANEL --}}
        <main class="main-content">
            @yield('content')
        </main>

    </div>

    @stack('scripts')
</body>
</html>

