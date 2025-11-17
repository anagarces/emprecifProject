@extends('layouts.dashboard')

@section('title', $company->name . ' | Información Empresarial')

@section('content')

{{-- ================================
    ENCABEZADO DE EMPRESA
================================= --}}
<div style="border-bottom:2px solid #E2E8F0;padding-bottom:2rem;margin-bottom:3rem;">
    <div style="display:flex;justify-content:space-between;align-items:center;">
        <div>
            <h1 style="font-family:'Space Grotesk';font-weight:900;font-size:3rem;">
                {{ $company->name }}
            </h1>

            {{-- BOTÓN FAVORITOS (lo dejamos operativo más adelante) --}}
            @if(auth()->check())
                <form action="#" method="POST" style="margin-top:0.75rem;">
                    @csrf
                    <button type="button"
                        style="background:none;border:none;cursor:default;font-size:1rem;padding:0;color:#9CA3AF;">
                        @if($isFavorite)
                            ❤️ Marcada como favorita
                        @else
                            🤍 Favoritos (pendiente)
                        @endif
                    </button>
                </form>
            @endif

            <p style="font-size:1.15rem;color:var(--gray);margin-top:0.5rem;">
                NIF: {{ $company->cif }} • {{ $company->city }}, {{ $company->province }}
            </p>
        </div>

        <span style="
            padding:1rem 2rem;
            background:#D1FAE5;
            color:#065F46;
            border-radius:50px;
            font-weight:800;
            font-size:1.125rem;">
            {{ $company->is_active ? '✓ ACTIVA' : 'INACTIVA' }}
        </span>
    </div>
</div>

{{-- ================================
    SECCIÓN: DATOS MERCANTILES (BÁSICOS)
================================= --}}
@include('company.partials.basic_data')

{{-- ================================
    SECCIÓN: DATOS PÚBLICOS (free / trial / premium)
================================= --}}
@if($canSeePublic)
    @include('company.partials.public_data')
@endif

{{-- ================================
    SECCIÓN PREMIUM (solo premium/admin)
================================= --}}
@if($canSeePremium)
    @include('company.partials.premium_data')
@else
    @include('company.partials.premium-locked')
@endif

{{-- ================================
    SECCIÓN BORME (todos los planes)
================================= --}}
@include('company.partials.borme')

@endsection
