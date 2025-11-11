@extends('layouts.app')

@section('title', 'Perfil de ' . $company->name . ' | Emprecif')

@section('content')
<div class="container py-5">

    {{-- Avisos de acceso --}}
    @auth
        @if(auth()->user()->isOnTrial())
            <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-yellow-700">
                            Estás en período de prueba. Solo tienes acceso a datos públicos de la empresa.
                            @if(auth()->user()->trialDaysRemaining() <= 3)
                                <a href="{{ route('subscription.plans') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">
                                    Actualiza ahora
                                </a>
                            @endif
                        </p>
                    </div>
                </div>
            </div>
        @endif
    @else
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6 rounded">
            <p class="text-sm text-blue-700">
                <a href="{{ route('login') }}" class="font-medium underline text-blue-700 hover:text-blue-600">Inicia sesión</a> o 
                <a href="{{ route('register') }}" class="font-medium underline text-blue-700 hover:text-blue-600">regístrate</a> 
                para ver más información sobre esta empresa.
            </p>
        </div>
    @endauth

    {{-- Cabecera --}}
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900">{{ $company->name }}</h1>
        <p class="text-gray-600">{{ $company->sector ?? 'Sector no especificado' }}</p>
    </div>

    {{-- Información pública --}}
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
        <div class="bg-white shadow rounded-lg p-5">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Información Básica</h3>
            <p><strong>CIF:</strong> {{ $company->cif }}</p>
            <p><strong>Dirección:</strong> {{ $company->address ?? 'No disponible' }}</p>
            <p><strong>Ciudad:</strong> {{ $company->city ?? 'No disponible' }}</p>
            <p><strong>Provincia:</strong> {{ $company->province ?? 'No disponible' }}</p>
            <p><strong>Código Postal:</strong> {{ $company->postal_code ?? 'No disponible' }}</p>
        </div>

        <div class="bg-white shadow rounded-lg p-5">
            <h3 class="text-lg font-semibold text-gray-800 mb-3">Información General</h3>
            <p><strong>Teléfono:</strong> {{ $company->phone ?? 'No disponible' }}</p>
            <p><strong>Email:</strong> {{ $company->email ?? 'No disponible' }}</p>
            <p><strong>Sitio Web:</strong> 
                @if($company->website)
                    <a href="{{ $company->website }}" target="_blank" class="text-blue-600 hover:text-blue-800">
                        {{ $company->website }}
                    </a>
                @else
                    No disponible
                @endif
            </p>
            <p><strong>Fecha de Constitución:</strong> {{ $company->founded_at ? $company->founded_at->format('d/m/Y') : 'No disponible' }}</p>
        </div>
    </div>

    {{-- Datos premium solo para admin/premium --}}
    @auth
        @if(auth()->user()->canDownloadReports())
            <div class="bg-white shadow rounded-lg p-5 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Datos Económicos</h3>
                <p><strong>Facturación Anual:</strong> {{ $company->annual_turnover ?? 'No disponible' }} €</p>
                <p><strong>Resultado Neto:</strong> {{ $company->net_profit ?? 'No disponible' }} €</p>
                <p><strong>Empleados:</strong> {{ $company->employees ?? 'No disponible' }}</p>
            </div>

            <div class="bg-white shadow rounded-lg p-5 mb-8">
                <h3 class="text-lg font-semibold text-gray-800 mb-3">Análisis de Riesgo</h3>
                <div class="progress mb-3" style="height: 25px;">
                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">
                        75% Bajo Riesgo
                    </div>
                </div>
                <p class="text-gray-700">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    La empresa presenta un perfil financiero estable y bajo riesgo de impago.
                </p>
            </div>
        @else
            <div class="bg-gray-50 border-l-4 border-gray-300 p-4 rounded mb-8">
                <p class="text-sm text-gray-600">
                    🔒 Algunos datos han sido ocultados. 
                    <a href="{{ route('subscription.plans') }}" class="font-medium text-blue-600 hover:text-blue-800">
                        Actualiza a Premium
                    </a> para ver la información completa y los indicadores financieros.
                </p>
            </div>
        @endif
    @endauth

    {{-- CTA final --}}
    @guest
        <div class="text-center mt-8">
            <a href="{{ route('register') }}" class="inline-flex items-center px-4 py-2 bg-primary-600 border border-transparent rounded-md font-semibold text-white hover:bg-primary-700 focus:ring-2 focus:ring-primary-500 focus:ring-offset-2 transition ease-in-out duration-150">
                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Crear cuenta para ver más
            </a>
        </div>
    @endguest

</div>
@endsection
