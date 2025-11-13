@extends('layouts.dashboard')

@section('title', 'Dashboard - '.config('app.name'))

@section('content')

@php
    $user = Auth::user();
@endphp

{{-- Banner Trial --}}
@if(Auth::user()->isOnTrial())
<div style="background:#FEF3C7;border:1px solid #FCD34D;padding:1.25rem;border-radius:12px;margin-bottom:2rem;display:flex;justify-content:space-between;align-items:center;">
    <div style="font-size:1rem;font-weight:600;color:#92400E;">
        🎉 Estás en tu prueba gratuita
    </div>
    <div style="font-size:0.95rem;color:#92400E;">
        Tu prueba finaliza en <strong>{{ Auth::user()->trialDaysRemaining() }}</strong> días. 
        <a href="{{ route('subscription.plans') }}" style="color:#B45309;font-weight:700;text-decoration:none;">
            Actualizar a Premium →
        </a>
    </div>
</div>
@endif


{{-- ===============================
    TÍTULO PRINCIPAL
================================== --}}
<h1 style="font-size:2.5rem;font-weight:900;font-family:'Space Grotesk';margin-bottom:0.5rem;">
    Mi Cuenta
</h1>
<p style="font-size:1.125rem;color:var(--gray);margin-bottom:2rem;">
    Gestiona tu perfil y preferencias
</p>



{{-- ===============================
    QUICK ACTIONS
================================== --}}
<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.5rem;margin-bottom:3rem;">

    {{-- Buscar Empresas --}}
    <a href="{{ route('company.search') }}" style="
        background:white;padding:1.5rem;border-radius:16px;text-decoration:none;border:1px solid #E2E8F0;">
        <h3 style="font-size:1.125rem;font-weight:700;">🔍 Buscar Empresas</h3>
        <p style="color:var(--gray);font-size:0.875rem;">Encuentra empresas y visualiza información</p>
    </a>

    {{-- Favoritos --}}
    <a href="{{ route('favorites.index') }}" style="
        background:white;padding:1.5rem;border-radius:16px;text-decoration:none;border:1px solid #E2E8F0;">
        ⭐ <h3 style="font-size:1.125rem;font-weight:700;display:inline;">Favoritos</h3>
        <p style="color:var(--gray);font-size:0.875rem;">Accede a tus empresas guardadas</p>
    </a>

  {{-- Solo Premium puede ver Generar Informe --}}
@if(Auth::user()->isPremium())
    <a href="{{ route('reports.index') }}" style="
        background:white;padding:1.5rem;border-radius:16px;text-decoration:none;border:1px solid #E2E8F0;">
        <h3 style="font-size:1.125rem;font-weight:700;">📄 Generar Informe</h3>
        <p style="color:var(--gray);font-size:0.875rem;">Crear informes detallados</p>
    </a>
@endif


</div>



{{-- ===============================
    BLOQUE PLAN ACTUAL
================================== --}}

{{-- PLAN --}}
<div style="
    background: linear-gradient(135deg, var(--primary), var(--secondary));
    padding: 3rem;border-radius:20px;color:white;margin-bottom:3rem;">

    {{-- Etiqueta del plan --}}
    <span style="background:rgba(255,255,255,0.2);padding:0.5rem 1rem;border-radius:50px;font-weight:700;">
        @if(Auth::user()->isPremium())
            PLAN PREMIUM
        @elseif(Auth::user()->isOnTrial())
            PRUEBA GRATUITA
        @else
            PLAN GRATIS
        @endif
    </span>

    {{-- Nombre del plan --}}
    <h2 style="font-family:'Space Grotesk';font-size:2rem;margin-top:1rem;">
        @if(Auth::user()->isPremium())
            Premium
        @elseif(Auth::user()->isOnTrial())
            Prueba Gratuita (15 días)
        @else
            Plan Gratis
        @endif
    </h2>

    {{-- Descripción --}}
    <p style="opacity:0.95;">
        @if(Auth::user()->isPremium())
            Acceso completo a todas las funcionalidades
        @elseif(Auth::user()->isOnTrial())
            Acceso limitado durante tu prueba gratuita
        @else
            Funcionalidad básica disponible
        @endif
    </p>

    {{-- Precio --}}
    <div style="font-size:3rem;font-weight:900;margin-top:1rem;">
        @if(Auth::user()->isPremium())
            49€
        @else
            0€
        @endif
        <span style="font-size:1.25rem;">/mes</span>
    </div>

    {{-- CTA --}}
    @if(Auth::user()->isPremium())
        <a href="{{ route('subscription.plans') }}" style="
            margin-top:1.5rem;display:inline-block;padding:1rem 2rem;background:white;color:var(--primary);
            border-radius:12px;font-weight:800;text-decoration:none;">
            Gestionar suscripción
        </a>
    @elseif(Auth::user()->isOnTrial())
        <a href="{{ route('subscription.plans') }}" style="
            margin-top:1.5rem;display:inline-block;padding:1rem 2rem;background:white;color:var(--secondary);
            border-radius:12px;font-weight:800;text-decoration:none;">
            Actualizar a Premium
        </a>
    @else
        <a href="{{ route('subscription.plans') }}" style="
            margin-top:1.5rem;display:inline-block;padding:1rem 2rem;background:white;color:var(--primary);
            border-radius:12px;font-weight:800;text-decoration:none;">
            Actualizar a Premium
        </a>
    @endif

</div>




{{-- ===============================
    BLOQUES DETALLADOS: PAGO, USO, FACTURAS
================================== --}}

<div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(280px,1fr));gap:1.5rem;margin-bottom:3rem;">


    {{-- MÉTODO DE PAGO --}}
    <div style="background:white;padding:2rem;border-radius:20px;border:1px solid #E2E8F0;">
        <h3 style="font-weight:800;font-size:1.125rem;margin-bottom:1rem;">Método de Pago</h3>

        @if($user->isPremium() && $user->pm_last_four)
            <p>Tarjeta terminada en <strong>{{ $user->pm_last_four }}</strong></p>
            <a href="{{ route('subscription.portal') }}" style="color:var(--primary);font-weight:700;">
                Gestionar método de pago →
            </a>
        @else
            <p style="color:var(--gray);">No tienes un método de pago registrado.</p>
        @endif
    </div>


    {{-- USO DEL MES --}}
    <div style="background:white;padding:2rem;border-radius:20px;border:1px solid #E2E8F0;">
        <h3 style="font-weight:800;font-size:1.125rem;margin-bottom:1rem;">Uso de este Mes</h3>

        @if($user->isPremium())
            <p>🔓 Búsquedas ilimitadas</p>
        @elseif($user->isOnTrial())
            <p>Has visto <strong>{{ $user->companies_viewed }}</strong> de <strong>2</strong> empresas permitidas</p>
        @else
            <p>Tu plan permite búsquedas básicas sin datos premium.</p>
        @endif
    </div>


    {{-- HISTORIAL DE FACTURAS --}}
    <div style="background:white;padding:2rem;border-radius:20px;border:1px solid #E2E8F0;">
        <h3 style="font-weight:800;font-size:1.125rem;margin-bottom:1rem;">Historial de Facturas</h3>

        @if($user->isPremium())
            <p style="color:var(--gray);">Tu historial estará disponible próximamente.</p>
        @else
            <p style="color:var(--gray);">Aún no tienes facturas.</p>
        @endif
    </div>

</div>



{{-- ===============================
    ACTIVIDAD RECIENTE (tal como estaba)
================================== --}}

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
