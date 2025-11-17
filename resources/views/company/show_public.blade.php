@extends('layouts.app')

@section('title', $company->name . ' | Información Empresarial')

@section('content')

{{-- ======================================================
     ENCABEZADO
====================================================== --}}
<div style="border-bottom:2px solid #E2E8F0;padding-bottom:2rem;margin-bottom:3rem;">
    <h1 style="font-family:'Space Grotesk';font-weight:900;font-size:3rem;">
        {{ $company->name }}
    </h1>

    <p style="font-size:1.15rem;color:var(--gray);margin-top:0.5rem;">
        NIF: {{ $company->cif }} • {{ $company->city }}, {{ $company->province }}
    </p>
</div>


{{-- ======================================================
     BLOQUE DATOS BÁSICOS
====================================================== --}}
@include('company.partials.basic_data')


{{-- ======================================================
     BLOQUE DATOS PÚBLICOS
====================================================== --}}
@include('company.partials.public_data')


{{-- ======================================================
     BLOQUE BORME
====================================================== --}}
@include('company.partials.borme')


{{-- ======================================================
     CTA: INVITACIÓN A REGISTRARSE
====================================================== --}}
<div style="margin-top:3rem;text-align:center;">
    <a href="{{ route('register') }}"
       style="display:inline-block;padding:1rem 2rem;background:#111;color:white;
              border-radius:10px;font-weight:700;text-decoration:none;">
        Crear una cuenta para ver información ampliada →
    </a>
</div>

@endsection
