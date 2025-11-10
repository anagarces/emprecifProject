@extends('layouts.app')

@section('title', 'Mi Cuenta - ' . config('app.name'))

@section('content')
<div class="app-layout">
    <!-- Sidebar -->
    <aside class="sidebar">
        <div style="margin-bottom: 2rem; padding-bottom: 2rem; border-bottom: 2px solid #E2E8F0;">
            <a href="{{ route('dashboard') }}" style="display: block; margin-bottom: 2rem;">
                <img src="{{ asset('images/logo_emprecif_wordmark.png') }}" alt="EmpreciF" style="height: 32px;">
            </a>
            <div style="display: flex; align-items: center; gap: 0.75rem;">
                <div style="width: 48px; height: 48px; background: #E0F2FE; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #0369A1; font-weight: 600;">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <div style="font-weight: 600;">{{ Auth::user()->name }}</div>
                    <div style="font-size: 0.875rem; color: #64748B;">{{ Auth::user()->email }}</div>
                </div>
            </div>
        </div>

        <nav>
            <ul class="sidebar-nav">
                <li>
                    <a href="{{ route('dashboard') }}" class="{{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path>
                            <polyline points="9 22 9 12 15 12 15 22"></polyline>
                        </svg>
                        Inicio
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="{{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        Perfil
                    </a>
                </li>
                <li>
                    <a href="{{ route('subscription.plans') }}" class="{{ request()->routeIs('subscription.*') ? 'active' : '' }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 16V7a2 2 0 0 0-2-2H6a2 2 0 0 0-2 2v9m16 0H4m16 0 1.28 2.55a1 1 0 0 1-.9 1.45H3.62a1 1 0 0 1-.9-1.45L4 16"></path>
                        </svg>
                        Suscripción
                    </a>
                </li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" 
                           onclick="event.preventDefault(); this.closest('form').submit();"
                           style="color: #EF4444;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                                <polyline points="16 17 21 12 16 7"></polyline>
                                <line x1="21" y1="12" x2="9" y2="12"></line>
                            </svg>
                            Cerrar sesión
                        </a>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    <!-- Contenido principal -->
    <main class="main-content">
        <div style="max-width: 1200px; margin: 0 auto; padding: 2rem;">
            <div style="margin-bottom: 3rem;">
                <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 3rem; font-weight: 900; margin-bottom: 0.5rem;">
                    Mi Cuenta
                </h1>
                <p style="color: #64748B; font-size: 1.125rem;">
                    Bienvenido de nuevo, {{ Auth::user()->name }}
                </p>
            </div>

            <!-- Resumen de la cuenta -->
            <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1.5rem; margin-bottom: 3rem;">
                
                <!-- PLAN ACTUAL -->
                <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                        <h3 style="font-weight: 600; color: #64748B;">Plan Actual</h3>
                        <div style="background: #E0F2FE; color: #0369A1; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600;">
                            @if(Auth::user()->subscribed('default'))
                                Premium
                            @else
                                Gratis
                            @endif
                        </div>
                    </div>
                    <div style="font-size: 1.5rem; font-weight: 700;">
                        @if(Auth::user()->subscribed('default'))
                            €{{ number_format(Auth::user()->subscription('default')->stripe_price / 100, 2) }}/mes
                        @else
                            Gratis
                        @endif
                    </div>
                </div>

                <!-- PRÓXIMO PAGO -->
                <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                    <div style="margin-bottom: 1rem;">
                        <h3 style="font-weight: 600; color: #64748B;">Próximo pago</h3>
                    </div>
                    <div style="font-size: 1.5rem; font-weight: 700;">
                        @if(Auth::user()->subscribed('default'))
                            @php $subscription = Auth::user()->subscription('default'); @endphp
                            {{ $subscription->ends_at ? 'Finaliza el ' . $subscription->ends_at->format('d/m/Y') : 'Activo' }}
                        @else
                            No activo
                        @endif
                    </div>
                </div>

                <!-- CONSULTAS MENSUALES -->
                <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                    <div style="margin-bottom: 1rem;">
                        <h3 style="font-weight: 600; color: #64748B;">Consultas este mes</h3>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="font-size: 1.5rem; font-weight: 700;">
                            {{ Auth::user()->search_queries_this_month }} / 
                            @if(Auth::user()->subscribed('default'))
                                {{ Auth::user()->subscription('default')->max_searches ?? '∞' }}
                            @else
                                ∞
                            @endif
                        </div>
                        <div style="width: 60px; height: 4px; background: #E2E8F0; border-radius: 2px; overflow: hidden;">
                            @php
                                $limit = Auth::user()->subscribed('default') 
                                    ? (Auth::user()->subscription('default')->max_searches ?? 1)
                                    : 1;
                                $percentage = min(100, (Auth::user()->search_queries_this_month / $limit) * 100);
                            @endphp
                            <div style="width: {{ $percentage }}%; height: 100%; background: #3B82F6;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@push('styles')
<style>
/* Tus estilos originales se mantienen igual */
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuButton = document.getElementById('mobile-menu-button');
    const sidebar = document.querySelector('.sidebar');
    if (menuButton) {
        menuButton.addEventListener('click', function() {
            sidebar.classList.toggle('open');
        });
    }
});
</script>
@endpush
@endsection

