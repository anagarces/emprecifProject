@extends('layouts.dashboard')

@section('title', 'Mi Cuenta - ' . config('app.name'))

@push('styles')
<style>
  /* Base styles for the dashboard app */
  .dash-app {
    --primary: #4F46E5;
    --primary-light: #818CF8;
    --secondary: #9333EA;
    --accent: #EC4899;
    --gray: #64748B;
    --gray-light: #E2E8F0;
    --light: #F8FAFC;
    --success: #10B981;
    --warning: #F59E0B;
    --danger: #EF4444;
    --white: #FFFFFF;
    
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
    color: #1E293B;
    line-height: 1.5;
    -webkit-font-smoothing: antialiased;
  }
  
  /* Reset and base styles */
  .dash-app * {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
  }
  
  .dash-app a {
    text-decoration: none;
    color: inherit;
  }
  
  .dash-app ul {
    list-style: none;
  }
  
  /* Layout */
  .dash-layout {
    display: grid;
    grid-template-columns: 280px 1fr;
    min-height: 100vh;
    background-color: var(--light);
  }
  
  /* Sidebar */
  .dash-sidebar {
    background: var(--white);
    border-right: 1px solid var(--gray-light);
    padding: 2rem 1.5rem;
    position: sticky;
    top: 0;
    height: 100vh;
    overflow-y: auto;
  }
  
  .dash-logo {
    display: block;
    margin-bottom: 2.5rem;
  }
  
  .dash-logo img {
    height: 2.5rem;
  }
  
  .dash-user {
    display: flex;
    align-items: center;
    margin-bottom: 2rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid var(--gray-light);
  }
  
  .dash-avatar {
    width: 3rem;
    height: 3rem;
    border-radius: 0.75rem;
    background: var(--primary);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-weight: 600;
    margin-right: 1rem;
    flex-shrink: 0;
  }
  
  .dash-user-info h3 {
    font-weight: 600;
    margin-bottom: 0.25rem;
  }
  
  .dash-user-info p {
    font-size: 0.875rem;
    color: var(--gray);
  }
  
  .dash-plan-badge {
    display: inline-block;
    background: #EEF2FF;
    color: var(--primary);
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    margin-top: 0.5rem;
  }
  
  /* Navigation */
  .dash-nav {
    margin-bottom: 2rem;
  }
  
  .dash-nav-title {
    font-size: 0.75rem;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.05em;
    color: var(--gray);
    padding: 0 1rem;
    margin-bottom: 1rem;
  }
  
  .dash-link {
    display: flex;
    align-items: center;
    padding: 0.75rem 1rem;
    border-radius: 0.75rem;
    color: var(--gray);
    font-weight: 500;
    transition: all 0.2s;
    margin-bottom: 0.25rem;
  }
  
  .dash-link:hover,
  .dash-link.active {
    background: #EEF2FF;
    color: var(--primary);
  }
  
  .dash-link svg {
    width: 1.25rem;
    height: 1.25rem;
    margin-right: 0.75rem;
    flex-shrink: 0;
  }
  
  /* Main Content */
  .dash-main {
    padding: 2rem;
    max-width: 100%;
    overflow-x: hidden;
  }
  
  .dash-header {
    margin-bottom: 2rem;
  }
  
  .dash-title {
    font-size: 1.875rem;
    font-weight: 800;
    color: #0F172A;
    margin-bottom: 0.5rem;
    font-family: 'Space Grotesk', sans-serif;
  }
  
  .dash-subtitle {
    font-size: 1.125rem;
    color: var(--gray);
  }
  
  /* Plan Card */
  .dash-plan {
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    color: white;
    border-radius: 1rem;
    padding: 2rem;
    margin-bottom: 2rem;
    position: relative;
    overflow: hidden;
  }
  
  .dash-plan-badge {
    display: inline-block;
    background: rgba(255, 255, 255, 0.2);
    color: white;
    font-size: 0.75rem;
    font-weight: 600;
    padding: 0.25rem 0.75rem;
    border-radius: 9999px;
    margin-bottom: 1rem;
  }
  
  .dash-plan-title {
    font-size: 1.5rem;
    font-weight: 700;
    margin-bottom: 0.5rem;
  }
  
  .dash-plan-desc {
    opacity: 0.9;
    margin-bottom: 1.5rem;
  }
  
  .dash-plan-price {
    font-size: 2.25rem;
    font-weight: 800;
    font-family: 'Space Grotesk', sans-serif;
    margin-bottom: 1.5rem;
  }
  
  .dash-plan-price span {
    font-size: 1.125rem;
    font-weight: 500;
    opacity: 0.9;
  }
  
  .dash-btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 0.625rem 1.25rem;
    border-radius: 0.5rem;
    font-weight: 600;
    transition: all 0.2s;
    cursor: pointer;
    border: none;
  }
  
  .dash-btn-primary {
    background: white;
    color: var(--primary);
  }
  
  .dash-btn-outline {
    background: rgba(255, 255, 255, 0.1);
    color: white;
    border: 1px solid rgba(255, 255, 255, 0.2);
  }
  
  .dash-btn:hover {
    transform: translateY(-1px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  }
  
  /* Quick Actions */
  .dash-section-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0F172A;
    margin-bottom: 1.5rem;
  }
  
  .dash-actions {
    display: grid;
    grid-template-columns: repeat(1, 1fr);
    gap: 1.25rem;
    margin-bottom: 2.5rem;
  }
  
  @media (min-width: 768px) {
    .dash-actions {
      grid-template-columns: repeat(2, 1fr);
    }
  }
  
  @media (min-width: 1024px) {
    .dash-actions {
      grid-template-columns: repeat(3, 1fr);
    }
  }
  
  .dash-action {
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    transition: all 0.2s;
    border: 1px solid var(--gray-light);
  }
  
  .dash-action:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
  }
  
  .dash-action-icon {
    width: 3rem;
    height: 3rem;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 1rem;
  }
  
  .dash-action-icon svg {
    width: 1.5rem;
    height: 1.5rem;
  }
  
  .dash-action-title {
    font-weight: 600;
    font-size: 1.125rem;
    color: #0F172A;
    margin-bottom: 0.5rem;
  }
  
  .dash-action-desc {
    font-size: 0.875rem;
    color: var(--gray);
    line-height: 1.5;
  }
  
  /* Activity Feed */
  .dash-activity {
    background: white;
    border-radius: 1rem;
    padding: 1.5rem;
    border: 1px solid var(--gray-light);
  }
  
  .dash-activity-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 1.5rem;
  }
  
  .dash-activity-title {
    font-size: 1.25rem;
    font-weight: 700;
    color: #0F172A;
  }
  
  .dash-activity-link {
    font-size: 0.875rem;
    font-weight: 600;
    color: var(--primary);
  }
  
  .dash-activity-item {
    display: flex;
    padding: 1rem 0;
    border-bottom: 1px solid var(--gray-light);
  }
  
  .dash-activity-item:last-child {
    border-bottom: none;
  }
  
  .dash-activity-icon {
    width: 2.5rem;
    height: 2.5rem;
    border-radius: 0.75rem;
    display: flex;
    align-items: center;
    justify-content: center;
    margin-right: 1rem;
    flex-shrink: 0;
  }
  
  .dash-activity-icon.search {
    background: #E0E7FF;
    color: var(--primary);
  }
  
  .dash-activity-icon.favorite {
    background: #F3E8FF;
    color: var(--secondary);
  }
  
  .dash-activity-icon.report {
    background: #D1FAE5;
    color: var(--success);
  }
  
  .dash-activity-content h4 {
    font-weight: 600;
    margin-bottom: 0.25rem;
  }
  
  .dash-activity-content p {
    font-size: 0.875rem;
    color: var(--gray);
    margin-bottom: 0.25rem;
  }
  
  .dash-activity-time {
    font-size: 0.75rem;
    color: var(--gray);
  }
  
  /* Empty State */
  .dash-empty {
    text-align: center;
    padding: 3rem 1rem;
  }
  
  .dash-empty-icon {
    width: 4rem;
    height: 4rem;
    margin: 0 auto 1.5rem;
    color: var(--gray-light);
  }
  
  .dash-empty-title {
    font-weight: 600;
    margin-bottom: 0.5rem;
    color: #0F172A;
  }
  
  .dash-empty-desc {
    color: var(--gray);
    margin-bottom: 1.5rem;
    max-width: 24rem;
    margin-left: auto;
    margin-right: auto;
  }
  
  /* Responsive */
  @media (max-width: 768px) {
    .dash-layout {
      grid-template-columns: 1fr;
    }
    
    .dash-sidebar {
      position: fixed;
      left: -280px;
      top: 0;
      z-index: 50;
      transition: transform 0.3s ease-in-out;
      width: 280px;
    }
    
    .dash-sidebar.mobile-open {
      transform: translateX(280px);
    }
    
    .dash-main {
      padding: 1.5rem;
    }
    
    .dash-title {
      font-size: 1.5rem;
    }
    
    .dash-subtitle {
      font-size: 1rem;
    }
  }
  
  /* Mobile Menu Button */
  .dash-mobile-menu {
    display: none;
    align-items: center;
    background: white;
    border: 1px solid var(--gray-light);
    border-radius: 0.5rem;
    padding: 0.5rem 1rem;
    margin-bottom: 1.5rem;
    cursor: pointer;
  }
  
  .dash-mobile-menu svg {
    width: 1.25rem;
    height: 1.25rem;
    margin-right: 0.5rem;
  }
  
  @media (max-width: 768px) {
    .dash-mobile-menu {
      display: flex;
    }
  }
</style>
<style>
    :root {
        --dash-primary: #4F46E5;
        --dash-secondary: #9333EA;
        --dash-accent: #EC4899;
        --dash-gray: #64748B;
        --dash-light: #F8FAFC;
        --dash-success: #10B981;
        --dash-warning: #F59E0B;
        --dash-danger: #EF4444;
    }

    /* Base Layout */
    .dash-layout {
        display: grid;
        grid-template-columns: 280px 1fr;
        min-height: 100vh;
        background-color: #F8FAFC;
        font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        color: #1E293B;
    }

    /* Sidebar */
    .dash-sidebar {
        background: white;
        border-right: 1px solid #E2E8F0;
        padding: 1.5rem;
        position: relative;
        z-index: 10;
        height: 100vh;
        overflow-y: auto;
    }

    .sidebar-header {
        margin-bottom: 2rem;
        padding-bottom: 2rem;
        border-bottom: 2px solid #E2E8F0;
    }

    .user-avatar {
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-weight: 700;
        font-size: 1.5rem;
        margin-bottom: 1rem;
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
        padding: 0.75rem 1rem;
        border-radius: 12px;
        color: var(--gray);
        text-decoration: none;
        font-weight: 600;
        transition: all 0.2s;
    }

    .sidebar-nav a:hover,
    .sidebar-nav a.active {
        background: #F1F5F9;
        color: var(--primary);
    }

    .sidebar-nav a svg {
        margin-right: 0.75rem;
        width: 20px;
        height: 20px;
    }

    /* Main Content */
    .dash-main {
        padding: 2rem;
        overflow-y: auto;
        max-height: 100vh;
    }

    /* Cards */
    .card {
        background: white;
        border-radius: 16px;
        padding: 2rem;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        margin-bottom: 2rem;
    }

    /* Buttons */
    .btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: 0.75rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        transition: all 0.2s;
        text-decoration: none;
        font-size: 0.9375rem;
    }

    .btn-primary {
        background: linear-gradient(90deg, var(--primary), var(--secondary));
        color: white;
        border: none;
    }

    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(79, 70, 229, 0.3);
    }

    .btn-outline {
        border: 1px solid #E2E8F0;
        color: var(--gray);
        background: white;
    }

    .btn-outline:hover {
        background: #F8FAFC;
        border-color: #CBD5E1;
    }

    /* Typography */
    h1, h2, h3, h4, h5, h6 {
        margin: 0 0 1rem 0;
        font-weight: 700;
        line-height: 1.2;
    }

    h1 {
        font-size: 2.5rem;
        font-weight: 900;
    }

    h2 {
        font-size: 1.875rem;
    }

    h3 {
        font-size: 1.5rem;
    }

    .text-muted {
        color: var(--gray);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    @media (min-width: 768px) {
        .stats-grid {
            grid-template-columns: repeat(2, 1fr);
        }
    }

    @media (min-width: 1024px) {
        .stats-grid {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Plan Card */
    .dash-plan {
        background: linear-gradient(135deg, var(--dash-primary), var(--dash-secondary));
        color: white;
        border-radius: 16px;
        padding: 2rem;
        margin-bottom: 2rem;
        width: 100%;
    }

    .plan-badge {
        display: inline-block;
        background: rgba(255, 255, 255, 0.2);
        color: white;
        font-size: 0.75rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        padding: 0.25rem 0.75rem;
        border-radius: 50px;
        margin-bottom: 1rem;
    }

    /* Quick Actions */
    .dash-actions {
        display: grid;
        grid-template-columns: repeat(1, 1fr);
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    @media (min-width: 1024px) {
        .dash-actions {
            grid-template-columns: repeat(3, 1fr);
        }
    }

    /* Action Cards */
    .dash-action {
        background: white;
        border-radius: 16px;
        padding: 1.5rem;
        text-decoration: none;
        transition: all 0.2s;
        border: 1px solid #E2E8F0;
    }

    .dash-action:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
    }

    .action-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 1rem;
    }

    /* Activity Feed */
    .activity-item {
        display: flex;
        padding: 1rem 0;
        border-bottom: 1px solid #E2E8F0;
    }

    .activity-item:last-child {
        border-bottom: none;
    }

    .activity-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        margin-right: 1rem;
        flex-shrink: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .app-layout {
            grid-template-columns: 1fr;
        }

        .dash-sidebar {
            position: fixed;
            left: -280px;
            top: 0;
            z-index: 50;
            transition: transform 0.3s ease-in-out;
        }

        .dash-sidebar.mobile-open {
            transform: translateX(0);
        }

        .dash-main {
            padding: 1.5rem;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<div class="dash-layout">
    <!-- Mobile Menu Button -->
    <button class="dash-mobile-menu" id="mobileMenuButton">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
        </svg>
        Menú
    </button>
    
    <!-- Sidebar -->
    <aside class="dash-sidebar" id="sidebar">
        <!-- Logo -->
        <a href="{{ route('home') }}" class="dash-logo">
            <img src="{{ asset('images/logo_emprecif_wordmark.png') }}" alt="EmpreciF">
        </a>
        
        <!-- User Info -->
        <div class="dash-user">
            <div class="dash-avatar">
                {{ strtoupper(substr(Auth::user()->name, 0, 2)) }}
            </div>
            <div class="dash-user-info">
                <h3>{{ Auth::user()->name }}</h3>
                <p>{{ Auth::user()->email }}</p>
                <div class="dash-plan-badge">
                    {{ Auth::user()->hasRole('premium') ? 'Premium' : 'Plan Gratis' }}
                </div>
            </div>
        </div>
        
        <!-- Navigation -->
        <nav>
            <ul class="dash-nav">
                <li>
                    <a href="{{ route('dashboard') }}" class="dash-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                        </svg>
                        Dashboard
                    </a>
                </li>
                <li>
                    <a href="{{ route('company.search') }}" class="dash-link {{ request()->routeIs('company.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                        </svg>
                        Buscar Empresas
                    </a>
                </li>
                <li>
                    <a href="{{ route('favorites.index') }}" class="dash-link {{ request()->routeIs('favorites.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                        Favoritos
                    </a>
                </li>
                <li>
                    <a href="{{ route('profile.edit') }}" class="dash-link {{ request()->routeIs('profile.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                        Mi Cuenta
                    </a>
                </li>
                <li>
                    <a href="{{ route('subscription.plans') }}" class="dash-link {{ request()->routeIs('subscription.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z"></path>
                        </svg>
                        Suscripción
                    </a>
                </li>
                <li>
                    <a href="{{ route('reports.index') }}" class="dash-link {{ request()->routeIs('reports.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Informes
                    </a>
                </li>
                <li>
                    <a href="{{ route('alerts.index') }}" class="dash-link {{ request()->routeIs('alerts.*') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path>
                        </svg>
                        Alertas
                    </a>
                </li>
                <li>
                    <a href="{{ route('settings') }}" class="dash-link {{ request()->routeIs('settings') ? 'active' : '' }}">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                        Configuración
                    </a>
                </li>
            </ul>
            
            <!-- Footer Links -->
            <div class="pt-6 mt-6 border-t border-gray-200">
                <a href="{{ route('home') }}" class="dash-link">
                    <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
                    </svg>
                    Volver al inicio
                </a>
                <form method="POST" action="{{ route('logout') }}" class="mt-1">
                    @csrf
                    <button type="submit" class="dash-link w-full text-left">
                        <svg fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path>
                        </svg>
                        <span style="color: var(--danger)">Cerrar sesión</span>
                    </button>
                </form>
            </div>
        </nav>
    </aside>

    <!-- Main Content -->
    <main class="dash-main">
        <!-- Dashboard Header -->
        <div class="dash-header">
            <h1 class="dash-title">Mi Cuenta</h1>
            <p class="dash-subtitle">Gestiona tu perfil y preferencias de cuenta</p>
        </div>

        <!-- Quick Actions -->
        <div style="margin-bottom: 2rem;">
            <h2 class="dash-section-title">Acciones rápidas</h2>
            <div class="dash-actions">
                <!-- Buscar Empresas -->
                <a href="{{ route('company.search') }}" class="dash-action">
                    <div class="dash-action-icon" style="background: #E0E7FF;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="var(--primary)">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                    </div>
                    <h3 class="dash-action-title">Buscar Empresas</h3>
                    <p class="dash-action-desc">Encuentra empresas y visualiza sus informes</p>
                </a>
                
                <!-- Favoritos -->
                <a href="{{ route('favorites.index') }}" class="dash-action">
                    <div class="dash-action-icon" style="background: #F3E8FF;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="var(--secondary)">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                        </svg>
                    </div>
                    <h3 class="dash-action-title">Favoritos</h3>
                    <p class="dash-action-desc">Visualiza tus empresas favoritas</p>
                </a>
                <!-- Generar Informe -->
                <a href="{{ route('reports.index') }}" class="dash-action">
                    <div class="dash-action-icon" style="background: #D1FAE5;">
                        <svg fill="none" viewBox="0 0 24 24" stroke="var(--success)">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="dash-action-title">Generar Informe</h3>
                    <p class="dash-action-desc">Crea informes detallados</p>
                </a>
            </div>
        </div>

        <!-- Plan Actual -->
        <div class="dash-plan">
                    <span class="dash-plan-badge">
                        {{ Auth::user()->hasRole('premium') ? 'Plan Actual' : 'Plan Gratis' }}
                    </span>
                    
                    <div class="dash-plan-content">
                        <h3 class="dash-plan-title">
                            {{ Auth::user()->hasRole('premium') ? 'Plan Premium' : 'Plan Gratis' }}
                        </h3>
                        <p class="dash-plan-desc">
                            {{ Auth::user()->hasRole('premium') 
                                ? 'Acceso completo a todas las funcionalidades' 
                                : 'Funcionalidad básica con opción a más' }}
                        </p>
                        
                        <div class="dash-plan-price">
                            {{ Auth::user()->hasRole('premium') ? '49' : '0' }}<span>€/mes</span>
                        </div>
                        
                        @if(Auth::user()->hasRole('premium'))
                            <a href="{{ route('subscription.plans') }}" class="dash-btn dash-btn-outline">
                                Gestionar suscripción
                            </a>
                        @else
                            <a href="{{ route('subscription.plans') }}" class="dash-btn dash-btn-primary">
                                Actualizar a Premium
                            </a>
                        @endif
                    </div>
                    
                    <div class="dash-plan-graphic">
                        <svg width="160" height="160" viewBox="0 0 200 200" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="100" cy="100" r="80" fill="url(#paint0_linear)" fill-opacity="0.1"/>
                            <path d="M100 40L118.3 60H81.7L100 40Z" fill="white"/>
                            <path d="M60 81.7L80 100L60 118.3V81.7Z" fill="white"/>
                            <path d="M100 140L81.7 120H118.3L100 140Z" fill="white"/>
                            <path d="M140 118.3L120 100L140 81.7V118.3Z" fill="white"/>
                            <path d="M100 60L118.3 80H81.7L100 60Z" fill="white"/>
                            <path d="M80 100L100 118.3V81.7L80 100Z" fill="white"/>
                            <path d="M100 140L81.7 120H118.3L100 140Z" fill="white"/>
                            <path d="M120 100L100 81.7V118.3L120 100Z" fill="white"/>
                            <defs>
                                <linearGradient id="paint0_linear" x1="100" y1="20" x2="100" y2="180" gradientUnits="userSpaceOnUse">
                                    <stop stop-color="white"/>
                                    <stop offset="1" stop-color="white" stop-opacity="0"/>
                                </linearGradient>
                            </defs>
                        </svg>
                    </div>
                </div>
                </div>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="dash-activity">
            <div class="dash-activity-header">
                <h3 class="dash-activity-title">Actividad Reciente</h3>
                <a href="#" class="dash-activity-link">Ver todo</a>
            </div>
            
            @if(isset($recentActivities) && count($recentActivities) > 0)
                <div class="dash-activity-list">
                    @foreach($recentActivities as $activity)
                        <div class="dash-activity-item">
                            <div class="dash-activity-icon {{ isset($activity->type) ? $activity->type : 'default' }}">
                                @if(isset($activity->type) && $activity->type === 'search')
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                                    </svg>
                                @elseif(isset($activity->type) && $activity->type === 'favorite')
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path>
                                    </svg>
                                @elseif(isset($activity->type) && $activity->type === 'report')
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                    </svg>
                                @else
                                    <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 5l7 7-7 7M5 5l7 7-7 7" />
                                    </svg>
                                @endif
                            </div>
                            <div class="dash-activity-content">
                                <h4>{{ $activity->title ?? 'Actividad reciente' }}</h4>
                                <p>{{ $activity->description ?? 'Descripción de la actividad' }}</p>
                                <span class="dash-activity-time">{{ isset($activity->created_at) ? $activity->created_at->diffForHumans() : 'Hace unos momentos' }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="dash-empty">
                    <div class="dash-empty-icon">
                        <svg fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                    <h3 class="dash-empty-title">Sin actividad reciente</h3>
                    <p class="dash-empty-desc">Tus actividades recientes aparecerán aquí.</p>
                    <a href="{{ route('company.search') }}" class="dash-btn dash-btn-primary">
                        <svg xmlns="http://www.w3.org/2000/svg" class="-ml-1 mr-2 h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" />
                        </svg>
                        Buscar empresas
                    </a>
                </div>
            @endif
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
            // Toggle sidebar on menu button click
            mobileMenuButton.addEventListener('click', function(e) {
                e.stopPropagation();
                sidebar.classList.toggle('mobile-open');
            });
            
            // Close sidebar when clicking outside
            document.addEventListener('click', function(event) {
                if (!sidebar.contains(event.target) && !mobileMenuButton.contains(event.target)) {
                    sidebar.classList.remove('mobile-open');
                }
            });
            
            // Close menu when a nav link is clicked (for mobile)
            const navLinks = document.querySelectorAll('.dash-link');
            navLinks.forEach(link => {
                link.addEventListener('click', function() {
                    if (window.innerWidth < 768) {
                        sidebar.classList.remove('mobile-open');
                    }
                });
            });
            
            // Handle window resize
            function handleResize() {
                if (window.innerWidth >= 768) {
                    sidebar.classList.remove('mobile-open');
                }
            }
            
            // Add resize event listener
            window.addEventListener('resize', handleResize);
            
            // Cleanup event listener when component unmounts
            return () => {
                window.removeEventListener('resize', handleResize);
                document.removeEventListener('click', handleClickOutside);
            };
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

