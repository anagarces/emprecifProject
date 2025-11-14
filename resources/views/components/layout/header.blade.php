<!-- Top Bar with Live Ticker -->
<div class="top-bar">
    <div class="ticker">
        <div class="ticker-item">🔴 <strong>LIVE:</strong> 3.247.891 empresas activas</div>
        <div class="ticker-item">📊 <strong>ACTUALIZADO:</strong> Hoy {{ now()->format('H:i') }}</div>
        <div class="ticker-item">🔥 <strong>+2.847</strong> actos BORME hoy</div>
        <div class="ticker-item">💰 <strong>1.2M</strong> cuentas anuales disponibles</div>
        <div class="ticker-item">⚡ <strong>847.392</strong> actos registrales</div>
        <div class="ticker-item">✅ <strong>DATOS OFICIALES</strong> del Registro Mercantil</div>
        <!-- Duplicate for seamless loop -->
        <div class="ticker-item">🔴 <strong>LIVE:</strong> 3.247.891 empresas activas</div>
        <div class="ticker-item">📊 <strong>ACTUALIZADO:</strong> Hoy {{ now()->format('H:i') }}</div>
        <div class="ticker-item">🔥 <strong>+2.847</strong> actos BORME hoy</div>
        <div class="ticker-item">💰 <strong>1.2M</strong> cuentas anuales disponibles</div>
        <div class="ticker-item">⚡ <strong>847.392</strong> actos registrales</div>
        <div class="ticker-item">✅ <strong>DATOS OFICIALES</strong> del Registro Mercantil</div>
    </div>
</div>

<!-- Header -->
<header>
    <nav>
        <a href="{{ route('home') }}" class="logo">
            <img src="{{ asset('images/logo_emprecif_wordmark.png') }}" alt="EmpreciF - Información Empresarial">
        </a>
        <ul class="nav-menu">
            <li><a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'active' : '' }}">Inicio</a></li>
            <li><a href="{{ route('company.search') }}" class="{{ request()->routeIs('company.search') ? 'active' : '' }}">Buscar Empresas</a></li>
            <li><a href="{{ route('pricing') }}" class="{{ request()->routeIs('pricing') ? 'active' : '' }}">Precios</a></li>
            <li><a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'active' : '' }}">Nosotros</a></li>
            <li><a href="{{ route('blog.index') }}" class="{{ request()->routeIs('blog*') ? 'active' : '' }}">Blog</a></li>
            <li><a href="{{ route('contact') }}" class="{{ request()->routeIs('contact') ? 'active' : '' }}">Contacto</a></li>
        </ul>
        <div class="auth-buttons">
            @guest
                <a href="{{ route('login') }}" class="btn btn-outline">Acceder</a>
                <a href="{{ route('register') }}" class="btn btn-primary">Prueba Gratis 14 Días</a>
            @else
                <div class="dropdown">
                    <button class="btn btn-outline dropdown-toggle" type="button" id="userMenu" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ Auth::user()->name }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="userMenu">
                        <li><a class="dropdown-item" href="{{ route('dashboard') }}">Panel de Control</a></li>
                        <li><a class="dropdown-item" href="{{ route('profile.edit') }}">Mi Perfil</a></li>
                        <li><a class="dropdown-item" href="{{ route('subscription.plans') }}">Mi Suscripción</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item">Cerrar Sesión</button>
                            </form>
                        </li>
                    </ul>
                </div>
            @endguest
        </div>
    </nav>
</header>
