@extends('layouts.app')

@section('title', $company->name . ' - Información Premium | EmpreciF')

@section('content')
<div class="container mx-auto px-4 py-8">
    <!-- Company Header -->
    <div class="bg-white rounded-lg shadow-md p-6 mb-6">
        <div class="flex flex-col md:flex-row justify-between items-start md:items-center mb-6">
            <div>
                <h1 class="text-3xl font-bold text-gray-900">{{ $company->name }}
                    <span class="ml-2 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                        <svg class="-ml-0.5 mr-1.5 h-2 w-2 text-yellow-400" fill="currentColor" viewBox="0 0 8 8">
                            <circle cx="4" cy="4" r="3" />
                        </svg>
                        Premium
                    </span>
                </h1>
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
        </div>

        <!-- Basic Info -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
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
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-sm font-medium text-gray-500">Teléfono</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $company->phone ?? 'No disponible' }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-sm font-medium text-gray-500">Email</h3>
                <p class="mt-1 text-sm text-gray-900">{{ $company->email ?? 'No disponible' }}</p>
            </div>
            <div class="bg-gray-50 p-4 rounded-lg">
                <h3 class="text-sm font-medium text-gray-500">Sitio web</h3>
                <p class="mt-1 text-sm text-gray-900">
                    @if($company->website)
                        <a href="{{ $company->website }}" target="_blank" class="text-primary-600 hover:text-primary-500">
                            {{ parse_url($company->website, PHP_URL_HOST) }}
                        </a>
                    @else
                        No disponible
                    @endif
                </p>
            </div>
        </div>

        <!-- Tabs -->
        <div class="border-b border-gray-200">
            <nav class="-mb-px flex space-x-8" aria-label="Tabs">
                <a href="#overview" class="tab-link border-primary-500 text-primary-600 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm" aria-current="page">
                    Resumen
                </a>
                <a href="#financials" class="tab-link border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Datos Financieros
                </a>
                <a href="#directors" class="tab-link border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Directivos
                </a>
                <a href="#shareholders" class="tab-link border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300 whitespace-nowrap py-4 px-1 border-b-2 font-medium text-sm">
                    Accionistas
                </a>
            </nav>
        </div>

        <!-- Tab Content -->
        <div class="py-6">
            <!-- Overview Tab -->
            <div id="overview" class="tab-content">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Resumen</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Descripción</h3>
                        <p class="mt-1 text-sm text-gray-900">{{ $company->description ?? 'No disponible' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Empleados</h3>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $company->employees ? number_format($company->employees, 0, ',', '.') : 'N/A' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Ingresos Anuales</h3>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $company->formatted_revenue }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg">
                        <h3 class="text-sm font-medium text-gray-500">Beneficios</h3>
                        <p class="mt-1 text-2xl font-semibold text-gray-900">{{ $company->formatted_profit }}</p>
                    </div>
                </div>
            </div>

            <!-- Financials Tab -->
            <div id="financials" class="tab-content hidden">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Datos Financieros</h2>
                @if(!empty($company->financials))
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Concepto</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Último Año</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Año Anterior</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Variación</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($company->financials as $item)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">{{ $item['concept'] }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">{{ number_format($item['current_year'], 2, ',', '.') }} €</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">{{ number_format($item['previous_year'], 2, ',', '.') }} €</td>
                                        @php
                                            $variation = (($item['current_year'] - $item['previous_year']) / $item['previous_year']) * 100;
                                            $textColor = $variation >= 0 ? 'text-green-600' : 'text-red-600';
                                            $icon = $variation >= 0 ? '▲' : '▼';
                                        @endphp
                                        <td class="px-6 py-4 whitespace-nowrap text-sm {{ $textColor }} text-right">
                                            {{ $icon }} {{ number_format(abs($variation), 2, ',', '.') }}%
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    No hay datos financieros disponibles para esta empresa.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Directors Tab -->
            <div id="directors" class="tab-content hidden">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Directivos</h2>
                @if(!empty($company->directors))
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                        @foreach($company->directors as $director)
                            <div class="bg-white overflow-hidden shadow rounded-lg">
                                <div class="px-4 py-5 sm:p-6">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 bg-indigo-500 rounded-md p-3">
                                            <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                                            </svg>
                                        </div>
                                        <div class="ml-4">
                                            <h3 class="text-lg font-medium text-gray-900">{{ $director['name'] }}</h3>
                                            <p class="text-sm text-gray-500">{{ $director['position'] }}</p>
                                            @if(!empty($director['appointment_date']))
                                                <p class="text-xs text-gray-400 mt-1">Desde {{ $director['appointment_date'] }}</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    No hay información de directivos disponible para esta empresa.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Shareholders Tab -->
            <div id="shareholders" class="tab-content hidden">
                <h2 class="text-xl font-semibold text-gray-900 mb-4">Accionistas</h2>
                @if(!empty($company->shareholders))
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Accionista</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Participación</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Acciones</th>
                                    <th scope="col" class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">Tipo</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($company->shareholders as $shareholder)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                                            {{ $shareholder['name'] }}
                                            @if($shareholder['is_company'])
                                                <span class="ml-2 inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-blue-100 text-blue-800">Empresa</span>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                            {{ number_format($shareholder['percentage'], 2, ',', '.') }}%
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                            {{ number_format($shareholder['shares'], 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-right">
                                            {{ $shareholder['type'] ?? 'Ordinaria' }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="bg-yellow-50 border-l-4 border-yellow-400 p-4">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-yellow-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="ml-3">
                                <p class="text-sm text-yellow-700">
                                    No hay información de accionistas disponible para esta empresa.
                                </p>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Back to public view -->
    <div class="mt-6 text-center">
        <a href="{{ route('company.show', $company) }}" class="inline-flex items-center text-sm font-medium text-primary-600 hover:text-primary-500">
            <svg class="h-5 w-5 mr-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Volver a la vista pública
        </a>
    </div>
</div>

@push('styles')
<style>
    .tab-link {
        transition: all 0.2s ease-in-out;
    }
    .tab-link:hover {
        border-color: #9CA3AF;
    }
    .tab-content {
        display: none;
    }
    .tab-content.active {
        display: block;
        animation: fadeIn 0.3s ease-in-out;
    }
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Tab functionality
    const tabLinks = document.querySelectorAll('.tab-link');
    const tabContents = document.querySelectorAll('.tab-content');
    
    // Show first tab by default
    if (tabContents.length > 0) {
        tabContents[0].classList.add('active');
    }
    
    tabLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const targetId = this.getAttribute('href').substring(1);
            
            // Update active tab
            tabLinks.forEach(tab => tab.classList.remove('border-primary-500', 'text-primary-600'));
            tabLinks.forEach(tab => tab.classList.add('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300'));
            
            this.classList.remove('border-transparent', 'text-gray-500', 'hover:text-gray-700', 'hover:border-gray-300');
            this.classList.add('border-primary-500', 'text-primary-600');
            
            // Show target content
            tabContents.forEach(content => {
                content.classList.remove('active');
                content.classList.add('hidden');
            });
            
            const targetContent = document.getElementById(targetId);
            if (targetContent) {
                targetContent.classList.remove('hidden');
                targetContent.classList.add('active');
            }
        });
    });
    
    // Favorite functionality
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
