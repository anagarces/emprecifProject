@extends('layouts.app')

@section('title', 'Buscar Empresas por NIF, CIF o Nombre | EmpreciF')

@section('description', 'Busca cualquier empresa española por NIF, CIF, razón social o administrador. Accede a datos oficiales del BORME en segundos.')

@section('content')
<section>
    <div class="section-header">
        <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 4rem; font-weight: 900;">
            Buscar Empresas Españolas
        </h1>
        <p style="font-size: 1.375rem; color: var(--gray); line-height: 1.7;">
            Encuentra cualquier empresa registrada en España. Más de 3.2 millones de empresas en nuestra base de datos.
        </p>
    </div>

    <div style="max-width: 900px; margin: 0 auto; padding: 0 2rem;">

        {{-- Formulario de búsqueda (siempre hacia la ruta interna de empresas) --}}
        <form action="{{ route('company.search') }}" method="GET" class="search-box" style="margin-bottom: 4rem;">
            <input
                type="text"
                name="q"
                placeholder="Busca por nombre, NIF/CIF o administrador..."
                value="{{ request('q', '') }}"
                required
            >
            <button type="submit">🔍 Buscar</button>
        </form>

        @if(request()->has('q') && !empty(request('q')))
            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.5rem; font-weight: 800; margin-bottom: 2rem;">
                Resultados de búsqueda: "{{ request('q') }}"
            </h2>

            @forelse($results as $company)
                @php
                    // Último ejercicio disponible (si existe)
                    $lastAccount = $company->accounts->sortByDesc('ejercicio')->first();

                    $facturacion = $lastAccount?->facturacion ?? 0;
                    $resultado   = $lastAccount?->resultado_neto ?? 0;
                    $empleados   = $lastAccount?->empleados ?? null;

                    $colorResultado = $resultado >= 0 ? '#065F46' : '#B91C1C';
                    $signoResultado = $resultado >= 0 ? '+' : '';
                @endphp

                <div style="background: white; padding: 2.5rem; border-radius: 15px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06); border-left: 4px solid var(--primary); margin-bottom: 2rem;">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                        <div>
                            <h3 style="font-size: 1.75rem; font-weight: 800; margin-bottom: 0.5rem;">
                                <a href="{{ route('company.show', $company) }}" style="color: var(--primary); text-decoration: none;">
                                    {{ mb_strtoupper($company->name) }}
                                </a>
                            </h3>
                            <p style="color: var(--gray);">
                                NIF: {{ $company->cif }} • {{ $company->city }}, {{ $company->province }}
                            </p>
                        </div>
                        <span style="padding: 0.5rem 1.5rem; background: #D1FAE5; color: #065F46; border-radius: 50px; font-weight: 700; font-size: 0.875rem;">
                            {{ $company->is_active ? 'ACTIVA' : 'INACTIVA' }}
                        </span>
                    </div>

                    {{-- 🔹 Datos financieros / empleados sólo visibles para usuarios logueados --}}
                    @if(auth()->check())
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-top: 2rem;">
                            <div>
                                <p style="font-size: 0.875rem; color: var(--gray); margin-bottom: 0.25rem;">
                                    Facturación {{ $lastAccount?->ejercicio ?? (date('Y') - 1) }}
                                </p>
                                <p style="font-size: 1.5rem; font-weight: 900; color: var(--dark);">
                                    {{ number_format($facturacion, 0, ',', '.') }} €
                                </p>
                            </div>
                            <div>
                                <p style="font-size: 0.875rem; color: var(--gray); margin-bottom: 0.25rem;">Resultado Neto</p>
                                <p style="font-size: 1.5rem; font-weight: 900; color: {{ $colorResultado }};">
                                    {{ $signoResultado }}{{ number_format($resultado, 0, ',', '.') }} €
                                </p>
                            </div>
                            <div>
                                <p style="font-size: 0.875rem; color: var(--gray); margin-bottom: 0.25rem;">Empleados</p>
                                <p style="font-size: 1.5rem; font-weight: 900; color: var(--dark);">
                                    {{ $empleados !== null ? $empleados : 'N/A' }}
                                </p>
                            </div>
                        </div>
                    @else
                        <p style="color: #6B7280; margin-top: 1rem;">
                            🔒 Inicia sesión o crea una cuenta para ver datos financieros y de empleados.
                        </p>
                    @endif

                    <a href="{{ route('company.show', $company) }}" class="btn btn-primary" style="margin-top: 1.5rem;">
                        Ver Perfil Completo →
                    </a>
                </div>
            @empty
                <div style="text-align: center; padding: 4rem 2rem; background: #F9FAFB; border-radius: 15px;">
                    <h3 style="font-size: 1.5rem; margin-bottom: 1rem; color: var(--dark);">No se encontraron resultados</h3>
                    <p style="color: var(--gray);">No hay empresas que coincidan con tu búsqueda. Intenta con otros términos.</p>
                </div>
            @endforelse
        @endif
    </div>
</section>
@endsection

