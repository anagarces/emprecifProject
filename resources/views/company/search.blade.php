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
        <form action="{{ auth()->check() ? route('company.search') : route('search') }}" method="GET" class="search-box" style="margin-bottom: 4rem;">
            @csrf
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
            
            @forelse($results ?? [] as $empresa)
                <div style="background: white; padding: 2.5rem; border-radius: 15px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06); border-left: 4px solid var(--primary); margin-bottom: 2rem;">
                    <div style="display: flex; justify-content: space-between; align-items: start; margin-bottom: 1rem;">
                        <div>
                            <h3 style="font-size: 1.75rem; font-weight: 800; margin-bottom: 0.5rem;">
                                <a href="{{ route('company.show', $empresa['id'] ?? 1) }}" style="color: var(--primary); text-decoration: none;">
                                    {{ $empresa['nombre'] }}
                                </a>
                            </h3>
                            <p style="color: var(--gray);">
                                NIF: {{ $empresa['nif'] }} • {{ $empresa['localidad'] }}, {{ $empresa['provincia'] }}
                            </p>
                        </div>
                        <span style="padding: 0.5rem 1.5rem; background: #D1FAE5; color: #065F46; border-radius: 50px; font-weight: 700; font-size: 0.875rem;">
                            {{ $empresa['estado'] ?? 'ACTIVA' }}
                        </span>
                    </div>

                    {{-- 🔹 Mostrar más o menos datos según el tipo de usuario --}}
                    @if(auth()->check())
                        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 2rem; margin-top: 2rem;">
                            <div>
                                <p style="font-size: 0.875rem; color: var(--gray); margin-bottom: 0.25rem;">Facturación {{ date('Y') - 1 }}</p>
                                <p style="font-size: 1.5rem; font-weight: 900; color: var(--dark);">
                                    {{ number_format($empresa['facturacion'] ?? 0, 0, ',', '.') }} €
                                </p>
                            </div>
                            <div>
                                <p style="font-size: 0.875rem; color: var(--gray); margin-bottom: 0.25rem;">Resultado Neto</p>
                                @php
                                    $resultado = $empresa['resultado_neto'] ?? 0;
                                    $color = $resultado >= 0 ? '#065F46' : '#B91C1C';
                                    $signo = $resultado >= 0 ? '+' : '';
                                @endphp
                                <p style="font-size: 1.5rem; font-weight: 900; color: {{ $color }};">
                                    {{ $signo }}{{ number_format($resultado, 0, ',', '.') }} €
                                </p>
                            </div>
                            <div>
                                <p style="font-size: 0.875rem; color: var(--gray); margin-bottom: 0.25rem;">Empleados</p>
                                <p style="font-size: 1.5rem; font-weight: 900; color: var(--dark);">
                                    {{ $empresa['empleados'] ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                    @else
                        <p style="color: #6B7280; margin-top: 1rem;">
                            🔒 Inicia sesión o crea una cuenta para ver datos financieros y de empleados.
                        </p>
                    @endif

                    <a href="{{ route('company.show', $empresa['id'] ?? 1) }}" class="btn btn-primary" style="margin-top: 1.5rem;">
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
