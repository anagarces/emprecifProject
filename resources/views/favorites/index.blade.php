@extends('layouts.app')

@section('content')

<div style="max-width:900px; margin:0 auto; padding:2rem;">
    <h1 style="font-size:2.5rem; font-weight:800; margin-bottom:2rem;">
        Mis Empresas Favoritas
    </h1>

    @forelse(auth()->user()->favorites as $company)
        <div style="background:white; padding:1.5rem; border-radius:15px; margin-bottom:1.5rem; box-shadow:0 4px 15px rgba(0,0,0,0.05);">
            
            <h3 style="margin-bottom:1rem;">
                <a href="{{ route('company.show', $company->slug) }}"
                   style="color:var(--primary); font-size:1.5rem; font-weight:700;">
                   {{ $company->name }}
                </a>
            </h3>

            <p style="color:#666;">CIF: {{ $company->cif }} — {{ $company->city }}, {{ $company->province }}</p>

            <form action="{{ route('company.favorite', $company->slug) }}" method="POST" style="margin-top:1rem;">
                @csrf
                <button class="btn btn-danger">Quitar de favoritos</button>
            </form>

        </div>
    @empty
        <p style="color:#777;">No tienes ninguna empresa en favoritos.</p>
    @endforelse
</div>

@endsection
