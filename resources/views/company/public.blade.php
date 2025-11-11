@extends('layouts.app')

@section('title', $company->name . ' - Información Pública | EmpreciF')

@section('content')
<div class="container mx-auto px-4 py-8">
  @auth
    @if(auth()->user()->isOnTrial())
        <!-- Trial User Notice -->
        <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4 mb-6 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <p class="text-sm text-yellow-700">
                        Estás viendo solo los datos públicos de esta empresa. Actualiza tu plan para acceder a información completa.
                        @if(auth()->user()->trialDaysRemaining() <= 3)
                            <a href="{{ route('subscription.plans') }}" class="font-medium underline text-yellow-700 hover:text-yellow-600">
                                Actualizar ahora
                            </a>
                        @endif
                    </p>
                </div>
            </div>
        </div>
    @endif
@endauth

    <!-- Company Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $company->name }}</h1>
                @if($company->legal_name && $company->legal_name !== $company->name)
                    <p class="text-gray-600 text-sm">{{ $company->legal_name }}</p>
                @endif
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <span class="flex items-center">
                        <svg class="h-4 w-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd" />
                        </svg>
                        {{ $company->city }}, {{ $company->province }}
                    </span>
                    <span class="mx-2">•</span>
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                        {{ $company->sector }}
                    </span>
                </div>
            </div>
            @auth
                <div class="mt-4 md:mt-0">
                    <button id="favorite-btn" class="flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500" 
                            data-company-id="{{ $company->id }}" 
                            data-is-favorite="{{ $isFavorite ? 'true' : 'false' }}">
                        <svg id="favorite-icon" class="h-5 w-5 mr-2 {{ $isFavorite ? 'text-yellow-400 fill-current' : 'text-gray-400' }}" 
                             viewBox="0 0 20 20" fill="{{ $isFavorite ? 'currentColor' : 'none' }}" 
                             stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        <span id="favorite-text">
                            {{ $isFavorite ? 'En favoritos' : 'Guardar en favoritos' }}
                        </span>
                    </button>
                </div>
            @else
                <div class="mt-4 md:mt-0">
                    <a href="{{ route('login') }}" class="flex items-center px-4 py-2 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                        <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                        </svg>
                        Inicia sesión para guardar
                    </a>
                </div>
            @endauth
        </div>

        <!-- Basic Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-sm font-medium text-gray-500">CIF</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $company->cif }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-sm font-medium text-gray-500">Dirección</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $company->address }}, {{ $company->postal_code }} {{ $company->city }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-sm font-medium text-gray-500">Sector</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $company->sector }}</p>
            </div>
            @if(auth()->check() && !auth()->user()->isOnTrial() && !auth()->user()->isPremium())
                @if($company->phone)
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Teléfono</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $company->phone }}</p>
                    </div>
                @endif
                @if($company->website)
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Sitio web</h3>
                        <p class="mt-1 text-sm text-gray-900">
                            <a href="{{ $company->website }}" target="_blank" class="text-blue-600 hover:underline">
                                {{ parse_url($company->website, PHP_URL_HOST) }}
                            </a>
                        </p>
                    </div>
                @endif
                @if($company->founded_year)
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Año de fundación</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $company->founded_year }}</p>
                    </div>
                @endif
            @endif
        </div>

        <!-- Description -->
        @if($company->description)
            <div class="mt-6">
                <h2 class="text-lg font-medium text-gray-900 mb-2">Descripción</h2>
                <p class="text-gray-700">{{ $company->description }}</p>
            </div>
        @endif
    </div>

    <!-- Premium CTA -->
    @if(!$hasPremiumAccess)
        <div class="bg-blue-50 border-l-4 border-blue-400 p-4 mb-6 rounded">
            <div class="flex">
                <div class="flex-shrink-0">
                    <svg class="h-5 w-5 text-blue-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" />
                    </svg>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-blue-800">Información Premium Disponible</h3>
                    <div class="mt-2 text-sm text-blue-700">
                        <p>Accede a información detallada financiera, directivos, accionistas y más con una suscripción premium.</p>
                    </div>
                    <div class="mt-4">
                        <a href="{{ route('pricing') }}" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            Ver planes y precios
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Link to premium view -->
        <div class="text-center mb-8">
            <a href="{{ route('company.premium', $company) }}" class="inline-flex items-center px-6 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                Ver información detallada
                <svg class="ml-2 -mr-1 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    @endif

    <!-- Similar Companies -->
    <div class="mt-12">
        <h2 class="text-xl font-semibold text-gray-900 mb-4">Empresas similares</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
            @foreach($similarCompanies ?? [] as $similar)
                <a href="{{ route('company.show', $similar) }}" class="bg-white overflow-hidden shadow rounded-lg hover:shadow-md transition-shadow duration-200">
                    <div class="px-4 py-5 sm:p-6">
                        <h3 class="text-lg font-medium text-gray-900">{{ $similar->name }}</h3>
                        <p class="mt-1 text-sm text-gray-500">{{ $similar->sector }}</p>
                        <p class="mt-2 text-sm text-gray-600">{{ $similar->city }}, {{ $similar->province }}</p>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const favoriteBtn = document.getElementById('favorite-btn');
    
    if (favoriteBtn) {
        favoriteBtn.addEventListener('click', function() {
            const companyId = this.dataset.companyId;
            const isFavorite = this.dataset.isFavorite === 'true';
            const url = isFavorite 
                ? `{{ route('favorites.remove', '') }}/${companyId}`
                : `{{ route('favorites.add', '') }}/${companyId}`;
            
            fetch(url, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                },
                credentials: 'same-origin',
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    const favoriteIcon = document.getElementById('favorite-icon');
                    const favoriteText = document.getElementById('favorite-text');
                    
                    if (isFavorite) {
                        favoriteIcon.classList.remove('text-yellow-400', 'fill-current');
                        favoriteIcon.classList.add('text-gray-400');
                        favoriteIcon.removeAttribute('fill');
                        favoriteText.textContent = 'Guardar en favoritos';
                        favoriteBtn.dataset.isFavorite = 'false';
                    } else {
                        favoriteIcon.classList.remove('text-gray-400');
                        favoriteIcon.classList.add('text-yellow-400', 'fill-current');
                        favoriteIcon.setAttribute('fill', 'currentColor');
                        favoriteText.textContent = 'En favoritos';
                        favoriteBtn.dataset.isFavorite = 'true';
                    }
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    }
});
</script>
@endpush
@endsection
