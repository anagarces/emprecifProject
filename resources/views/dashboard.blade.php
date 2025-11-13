@extends('layouts.dashboard')

@section('title', 'Dashboard - '.config('app.name'))

@section('content')

<h1 style="font-size:2.5rem;font-weight:900;font-family:'Space Grotesk';margin-bottom:0.5rem;">
    Mi Cuenta
</h1>
<p style="font-size:1.125rem;color:var(--gray);margin-bottom:2rem;">
    Gestiona tu perfil y preferencias
</p>

{{-- Quick Actions --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.5rem;margin-bottom:3rem;">

    <a href="{{ route('company.search') }}" style="
        background:white;padding:1.5rem;border-radius:16px;text-decoration:none;border:1px solid #E2E8F0;
        transition:0.2s;">
        <h3 style="font-size:1.125rem;font-weight:700;">🔍 Buscar Empresas</h3>
        <p style="color:var(--gray);font-size:0.875rem;">Encuentra empresas y visualiza informes</p>
    </a>

    <a href="{{ route('favorites.index') }}" style="
        background:white;padding:1.5rem;border-radius:16px;text-decoration:none;border:1px solid #E2E8F0;">
        <h3 style="font-size:1.125rem;font-weight:700;">⭐ Favoritos</h3>
        <p style="color:var(--gray);font-size:0.875rem;">Visualiza tus empresas favoritas</p>
    </a>

    <a href="{{ route('reports.index') }}" style="
        background:white;padding:1.5rem;border-radius:16px;text-decoration:none;border:1px solid #E2E8F0;">
        <h3 style="font-size:1.125rem;font-weight:700;">📄 Generar Informe</h3>
        <p style="color:var(--gray);font-size:0.875rem;">Crear informes detallados</p>
    </a>

</div>

{{-- Plan --}}
<div style="
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    padding: 3rem;border-radius:20px;color:white;margin-bottom:3rem;">

    <span style="background:rgba(255,255,255,0.2);padding:0.5rem 1rem;border-radius:50px;font-weight:700;">
        {{ Auth::user()->hasRole('premium') ? 'PLAN ACTIVO' : 'PLAN GRATIS' }}
    </span>

    <h2 style="font-family:'Space Grotesk';font-size:2rem;margin-top:1rem;">
        {{ Auth::user()->hasRole('premium') ? 'Premium' : 'Plan Gratis' }}
    </h2>

    <p style="opacity:0.95;">
        {{ Auth::user()->hasRole('premium')
            ? 'Acceso completo a todas las funcionalidades'
            : 'Funcionalidad básica disponible' }}
    </p>

    <div style="font-size:3rem;font-weight:900;margin-top:1rem;">
        {{ Auth::user()->hasRole('premium') ? '49€' : '0€' }} <span style="font-size:1.25rem;">/mes</span>
    </div>

    <a href="{{ route('subscription.plans') }}" style="
        margin-top:1.5rem;display:inline-block;padding:1rem 2rem;background:white;color:var(--primary);
        border-radius:12px;font-weight:800;text-decoration:none;">
        {{ Auth::user()->hasRole('premium') ? 'Gestionar suscripción' : 'Actualizar a Premium' }}
    </a>

</div>


{{-- Activity --}}
<div style="background:white;padding:2rem;border-radius:20px;border:1px solid #E2E8F0;">

    <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:1rem;">
        <h3 style="font-size:1.25rem;font-weight:800;">Actividad Reciente</h3>
        <a href="#" style="color:var(--primary);font-weight:700;">Ver todo</a>
    </div>

    @if(isset($recentActivities) && count($recentActivities) > 0)
        @foreach($recentActivities as $activity)
            <div style="padding:1rem 0;border-bottom:1px solid #E2E8F0;">
                <strong>{{ $activity->title }}</strong><br>
                <span style="color:var(--gray);font-size:0.875rem;">
                    {{ $activity->description }}
                </span><br>
                <span style="color:var(--gray);font-size:0.75rem;">
                    {{ $activity->created_at->diffForHumans() }}
                </span>
            </div>
        @endforeach
    @else

        <div style="text-align:center;padding:3rem;">
            <div style="font-size:3rem;color:#E5E7EB;">📄</div>
            <h4 style="font-size:1.25rem;font-weight:700;margin-top:1rem;">Sin actividad reciente</h4>
            <p style="color:var(--gray);font-size:0.875rem;">
                Tus actividades recientes aparecerán aquí.
            </p>

            <a href="{{ route('company.search') }}" style="
                padding:1rem 2rem;background:var(--primary);color:white;border-radius:12px;text-decoration:none;
                font-weight:700;display:inline-block;margin-top:1rem;">
                Buscar empresas
            </a>
        </div>

    @endif
</div>

@endsection

