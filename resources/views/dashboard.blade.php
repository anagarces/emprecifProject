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
                    <a href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 12.79A9 9 0 1 1 11.21 3 7 7 0 0 0 21 12.79z"></path>
                        </svg>
                        Configuración
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
                <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                    <div style="display: flex; align-items: center; justify-content: space-between; margin-bottom: 1rem;">
                        <h3 style="font-weight: 600; color: #64748B;">Plan Actual</h3>
                        <div style="background: #E0F2FE; color: #0369A1; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.875rem; font-weight: 600;">
                            {{ Auth::user()->subscription?->plan->name ?? 'Gratis' }}
                        </div>
                    </div>
                    <div style="font-size: 1.5rem; font-weight: 700;">
                        {{ Auth::user()->subscription ? '€' . number_format(Auth::user()->subscription->plan->price, 2) . '/mes' : 'Gratis' }}
                    </div>
                </div>

                <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                    <div style="margin-bottom: 1rem;">
                        <h3 style="font-weight: 600; color: #64748B;">Próximo pago</h3>
                    </div>
                    <div style="font-size: 1.5rem; font-weight: 700;">
                        @if(Auth::user()->subscription)
                            {{ Auth::user()->subscription->ends_at ? 'Finaliza el ' . Auth::user()->subscription->ends_at->format('d/m/Y') : 'Activo' }}
                        @else
                            No activo
                        @endif
                    </div>
                </div>

                <div style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                    <div style="margin-bottom: 1rem;">
                        <h3 style="font-weight: 600; color: #64748B;">Consultas este mes</h3>
                    </div>
                    <div style="display: flex; align-items: center; justify-content: space-between;">
                        <div style="font-size: 1.5rem; font-weight: 700;">
                            {{ Auth::user()->search_queries_this_month }} / {{ Auth::user()->subscription?->plan->max_searches ?? '∞' }}
                        </div>
                        <div style="width: 60px; height: 4px; background: #E2E8F0; border-radius: 2px; overflow: hidden;">
                            <div style="width: {{ min(100, (Auth::user()->search_queries_this_month / (Auth::user()->subscription?->plan->max_searches ?? 1)) * 100) }}%; height: 100%; background: #3B82F6;"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Acciones rápidas -->
            <div style="margin-bottom: 3rem;">
                <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin-bottom: 1.5rem;">Acciones rápidas</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 1rem;">
                    <a href="{{ route('search') }}" style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); text-decoration: none; color: inherit; transition: transform 0.2s;">
                        <div style="width: 48px; height: 48px; background: #E0F2FE; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0369A1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </div>
                        <h3 style="font-weight: 600; margin-bottom: 0.25rem;">Buscar empresa</h3>
                        <p style="color: #64748B; font-size: 0.875rem;">Realiza una búsqueda avanzada</p>
                    </a>

                    <a href="{{ route('subscription.plans') }}" style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); text-decoration: none; color: inherit; transition: transform 0.2s;">
                        <div style="width: 48px; height: 48px; background: #FEE2E2; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#DC2626" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 1a3 3 0 0 0-3 3v8a3 3 0 0 0 6 0V4a3 3 0 0 0-3-3z"></path>
                                <path d="M19 10v2a7 7 0 0 1-14 0v-2"></path>
                                <line x1="12" y1="19" x2="12" y2="23"></line>
                                <line x1="8" y1="23" x2="16" y2="23"></line>
                            </svg>
                        </div>
                        <h3 style="font-weight: 600; margin-bottom: 0.25rem;">Actualizar plan</h3>
                        <p style="color: #64748B; font-size: 0.875rem;">Mejora tu suscripción</p>
                    </a>

                    <a href="{{ route('profile.edit') }}" style="background: white; padding: 1.5rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05); text-decoration: none; color: inherit; transition: transform 0.2s;">
                        <div style="width: 48px; height: 48px; background: #E0F2FE; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 1rem;">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="#0369A1" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </div>
                        <h3 style="font-weight: 600; margin-bottom: 0.25rem;">Mi perfil</h3>
                        <p style="color: #64748B; font-size: 0.875rem;">Actualiza tu información</p>
                    </a>
                </div>
            </div>

            <!-- Historial reciente -->
            <div style="background: white; padding: 2rem; border-radius: 12px; box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);">
                <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                    <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800;">Búsquedas recientes</h2>
                    <a href="#" style="color: #3B82F6; font-weight: 500; text-decoration: none;">Ver todo</a>
                </div>
                
                @if(count($recentSearches) > 0)
                    <div style="overflow-x: auto;">
                        <table style="width: 100%; border-collapse: collapse;">
                            <thead>
                                <tr style="text-align: left; border-bottom: 1px solid #E2E8F0;">
                                    <th style="padding: 0.75rem 0; color: #64748B; font-weight: 600;">Empresa</th>
                                    <th style="padding: 0.75rem 0; color: #64748B; font-weight: 600;">Fecha</th>
                                    <th style="padding: 0.75rem 0; color: #64748B; font-weight: 600; text-align: right;">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentSearches as $search)
                                    <tr style="border-bottom: 1px solid #F1F5F9;">
                                        <td style="padding: 1rem 0;">
                                            <div style="font-weight: 600;">{{ $search->company_name }}</div>
                                            <div style="color: #64748B; font-size: 0.875rem;">{{ $search->cif }}</div>
                                        </td>
                                        <td style="padding: 1rem 0; color: #64748B;">
                                            {{ $search->created_at->format('d/m/Y H:i') }}
                                        </td>
                                        <td style="padding: 1rem 0; text-align: right;">
                                            <a href="{{ route('company.show', $search->company_id) }}" style="color: #3B82F6; text-decoration: none; font-weight: 500; margin-left: 1rem;">Ver</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div style="text-align: center; padding: 3rem 0; color: #64748B;">
                        <p>No hay búsquedas recientes</p>
                        <a href="{{ route('search') }}" style="display: inline-block; margin-top: 1rem; color: #3B82F6; text-decoration: none; font-weight: 500;">
                            Realizar una búsqueda
                        </a>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>

@push('styles')
<style>
    :root {
        --primary: #3B82F6;
        --secondary: #EC4899;
        --accent: #14B8A6;
        --dark: #0F172A;
        --light: #F8FAFC;
        --gray: #64748B;
    }
    
    body {
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        margin: 0;
        padding: 0;
        background: #F8FAFC;
        color: #1E293B;
    }
    
    .app-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        min-height: 100vh;
    }
    
    .sidebar {
        background: white;
        padding: 2rem;
        border-right: 1px solid #E2E8F0;
        position: fixed;
        width: 280px;
        height: 100vh;
        overflow-y: auto;
    }
    
    .sidebar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sidebar-nav li {
        margin-bottom: 0.5rem;
    }
    
    .sidebar-nav a {
        display: flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.75rem 1rem;
        border-radius: 8px;
        text-decoration: none;
        color: #475569;
        font-weight: 500;
        transition: all 0.2s;
    }
    
    .sidebar-nav a:hover, .sidebar-nav a.active {
        background: #F1F5F9;
        color: #1E40AF;
    }
    
    .sidebar-nav svg {
        width: 20px;
        height: 20px;
    }
    
    .main-content {
        grid-column: 2;
        padding: 2rem;
        margin-left: 280px;
        width: calc(100% - 280px);
    }
    
    @media (max-width: 1024px) {
        .app-layout {
            grid-template-columns: 1fr;
        }
        
        .sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease-in-out;
            z-index: 50;
        }
        
        .sidebar.open {
            transform: translateX(0);
        }
        
        .main-content {
            margin-left: 0;
            width: 100%;
            padding: 1rem;
        }
    }
    
    /* Estilos para la tabla responsiva */
    @media (max-width: 768px) {
        table {
            display: block;
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
        
        th, td {
            white-space: nowrap;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Menú móvil
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
