@extends('layouts.app')

@section('title', 'Mi Cuenta - ' . config('app.name'))

@push('styles')
<style>
    .dashboard-container {
        display: flex;
        min-height: calc(100vh - 120px);
        margin-top: 80px;
    }
    
    .sidebar {
        width: 280px;
        background: white;
        border-right: 1px solid #e2e8f0;
        padding: 2rem 1.5rem;
        position: fixed;
        top: 80px;
        left: 0;
        bottom: 0;
        overflow-y: auto;
    }
    
    .sidebar-header {
        margin-bottom: 2rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px solid #e2e8f0;
    }
    
    .user-avatar {
        width: 48px;
        height: 48px;
        background: #E0F2FE;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #0369A1;
        font-weight: 600;
        font-size: 1.1rem;
    }
    
    .sidebar-nav {
        list-style: none;
        padding: 0;
        margin: 0;
    }
    
    .sidebar-nav li {
        margin-bottom: 0.25rem;
    }
    
    .sidebar-nav a {
        display: flex;
        align-items: center;
        padding: 0.75rem 1rem;
        color: #4a5568;
        text-decoration: none;
        border-radius: 0.5rem;
        transition: all 0.2s;
    }
    
    .sidebar-nav a:hover,
    .sidebar-nav a.active {
        background: #f8fafc;
        color: #1e40af;
    }
    
    .sidebar-nav svg {
        margin-right: 0.75rem;
        width: 20px;
        height: 20px;
    }
    
    .main-content {
        flex: 1;
        margin-left: 280px;
        padding: 2rem;
    }
    
    @media (max-width: 1024px) {
        .sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
            z-index: 40;
            width: 280px;
        }
        
        .sidebar.mobile-open {
            transform: translateX(0);
        }
        
        .main-content {
            margin-left: 0;
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="dashboard-container">
    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <div class="flex items-center space-x-3">
                <div class="user-avatar">
                    {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
                </div>
                <div>
                    <div class="font-semibold text-gray-900">{{ Auth::user()->name }}</div>
                    <div class="text-sm text-gray-500">{{ Auth::user()->email }}</div>
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
        <div class="container mx-auto px-4 py-8">
            <!-- Mobile menu button -->
            <button id="mobileMenuButton" class="md:hidden flex items-center text-gray-600 mb-6">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
                Menú
            </button>

            <!-- Dashboard Header -->
            <div class="mb-8">
                <h1 class="text-3xl md:text-4xl font-bold text-gray-900 mb-2">
                    Mi Cuenta
                </h1>
                <p class="text-lg text-gray-600">
                    Gestiona tu perfil y preferencias de cuenta
                </p>
            </div>

            <!-- Stats Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Welcome Card -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-start">
                        <div class="bg-blue-50 p-3 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-lg font-semibold text-gray-900">Bienvenido, {{ Auth::user()->name }}!</h3>
                            <p class="mt-1 text-gray-600">
                                Gestiona tu cuenta y preferencias
                            </p>
                            <a href="{{ route('profile.edit') }}" class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                Editar perfil
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

{{-- Aviso de prueba o suscripción --}}
@auth
    @if(!auth()->user()->hasActiveSubscription() || auth()->user()->isOnTrial())
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M18 10A8 8 0 11 2 10a8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-800">
                        Estás utilizando tu período de prueba o no tienes una suscripción activa.
                        <a href="{{ route('subscription.plans') }}" class="font-medium text-yellow-900 underline hover:text-yellow-800">
                            Actualiza tu plan aquí
                        </a>.
                    </p>
                </div>
            </div>
        </div>
    @endif
@endauth

                <!-- Subscription Status -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <div class="flex items-start">
                        <div class="bg-green-50 p-3 rounded-lg mr-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <div class="flex-1">
                            <div class="flex justify-between items-start">
                                <div>
                                    <h3 class="text-lg font-semibold text-gray-900">Suscripción</h3>
                                    <p class="mt-1 text-gray-600">
                                        @if(Auth::user()->hasRole('admin'))
                                            <span class="px-2 py-1 bg-blue-100 text-blue-800 text-xs font-medium rounded-full">Administrador</span>
                                        @elseif(Auth::user()->hasRole('premium'))
                                            <span class="px-2 py-1 bg-purple-100 text-purple-800 text-xs font-medium rounded-full">Premium</span>
                                        @else
                                            <span class="px-2 py-1 bg-gray-100 text-gray-800 text-xs font-medium rounded-full">Básico</span>
                                        @endif
                                    </p>
                                </div>
                                @if(Auth::user()->isOnTrial())
                                    <span class="px-2.5 py-0.5 text-xs font-medium bg-green-100 text-green-800 rounded-full">
                                        Prueba activa
                                    </span>
                                @endif
                            </div>

                            @if(Auth::user()->isOnTrial())
                                <div class="mt-4 p-3 bg-green-50 rounded-lg">
                                    <p class="text-sm text-green-700">
                                        <strong>Período de prueba activo</strong><br>
                                        Tu prueba gratuita finaliza el {{ Auth::user()->trial_ends_at->format('d/m/Y') }}
                                    </p>
                                </div>
                            @endif

                            <a href="{{ route('subscription.plans') }}" class="mt-4 inline-flex items-center text-blue-600 hover:text-blue-800 font-medium">
                                {{ Auth::user()->hasRole(['admin', 'premium']) ? 'Gestionar suscripción' : 'Ver planes' }}
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Actions -->
                <div class="bg-white rounded-xl shadow-sm p-6">
                    <h3 class="text-lg font-semibold text-gray-900 mb-4">Acciones rápidas</h3>
                    <div class="space-y-3">
                        <a href="{{ route('company.search') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="bg-blue-100 p-2 rounded-lg mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Buscar empresa</span>
                        </a>
                        <a href="{{ route('reports.index') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="bg-green-100 p-2 rounded-lg mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Ver informes guardados</span>
                        </a>
                        <a href="{{ route('settings') }}" class="flex items-center p-3 rounded-lg hover:bg-gray-50 transition-colors">
                            <div class="bg-purple-100 p-2 rounded-lg mr-3">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-purple-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                            </div>
                            <span class="font-medium text-gray-700">Configuración de la cuenta</span>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="bg-white rounded-xl shadow-sm overflow-hidden">
                <div class="px-6 py-5 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">Actividad reciente</h3>
                        <a href="#" class="text-sm font-medium text-blue-600 hover:text-blue-800">Ver todo</a>
                    </div>
                </div>
                <div class="divide-y divide-gray-200">
                    <!-- Activity Item 1 -->
                    <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start">
                            <div class="bg-blue-100 p-2 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">Informe generado</p>
                                <p class="text-sm text-gray-500">Hace 2 horas</p>
                            </div>
                            <a href="#" class="ml-4 text-sm font-medium text-blue-600 hover:text-blue-800">Ver</a>
                        </div>
                    </div>
                    
                    <!-- Activity Item 2 -->
                    <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start">
                            <div class="bg-green-100 p-2 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">Suscripción activada</p>
                                <p class="text-sm text-gray-500">Ayer</p>
                            </div>
                            <a href="#" class="ml-4 text-sm font-medium text-blue-600 hover:text-blue-800">Ver</a>
                        </div>
                    </div>
                    
                    <!-- Activity Item 3 -->
                    <div class="px-6 py-4 hover:bg-gray-50 transition-colors">
                        <div class="flex items-start">
                            <div class="bg-yellow-100 p-2 rounded-lg mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-yellow-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="text-sm font-medium text-gray-900 truncate">Límite de búsquedas alcanzado</p>
                                <p class="text-sm text-gray-500">Hace 3 días</p>
                            </div>
                            <a href="{{ route('subscription.plans') }}" class="ml-4 text-sm font-medium text-blue-600 hover:text-blue-800">Actualizar</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>

@push('scripts')
<script>
    // Mobile menu toggle
    document.addEventListener('DOMContentLoaded', function() {
        const mobileMenuButton = document.getElementById('mobileMenuButton');
        const sidebar = document.getElementById('sidebar');

        if (mobileMenuButton && sidebar) {
            mobileMenuButton.addEventListener('click', function() {
                sidebar.classList.toggle('mobile-open');
                document.body.classList.toggle('overflow-hidden');
            });
        }

        // Close menu when clicking outside
        document.addEventListener('click', function(event) {
            if (sidebar && !sidebar.contains(event.target) && 
                mobileMenuButton && event.target !== mobileMenuButton && 
                !mobileMenuButton.contains(event.target)) {
                sidebar.classList.remove('mobile-open');
                document.body.classList.remove('overflow-hidden');
            }
        });

        // Close menu on window resize if it becomes desktop view
        function handleResize() {
            if (window.innerWidth >= 1024) {
                if (sidebar) sidebar.classList.remove('mobile-open');
                document.body.classList.remove('overflow-hidden');
            }
        }

        window.addEventListener('resize', handleResize);

        // Cleanup
        return () => {
            window.removeEventListener('resize', handleResize);
            if (mobileMenuButton) {
                const newButton = mobileMenuButton.cloneNode(true);
                mobileMenuButton.parentNode.replaceChild(newButton, mobileMenuButton);
            }
        };
    });
</script>
@endpush
@endsection

