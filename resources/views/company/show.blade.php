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

            <p style="font-size:1.15rem;color:var(--gray);">
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
            ✓ ACTIVA
        </span>
    </div>
</div>



{{-- ================================
    SECCIÓN: DATOS MERCANTILES (BÁSICOS)
================================= --}}
@include('company.partials.basic-data')



{{-- ================================
    SECCIÓN: DATOS PÚBLICOS (solo free/trial/premium)
================================= --}}
@if($canSeePublic)
    @include('company.partials.public-data')
@endif



{{-- ================================
    SECCIÓN PREMIUM (solo premium/admin)
================================= --}}
@if($canSeePremium)
    @include('company.partials.premium-data')
@else
    {{-- OVERLAY PREMIUM — versión bloqueada --}}
    @include('company.partials.premium-locked')
@endif



{{-- ================================
    SECCIÓN BORME (todos pueden ver la parte pública)
================================= --}}
@include('company.partials.borme')

@endsection
