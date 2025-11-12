@extends('layouts.app')

@section('content')
<div class="flex flex-col items-center justify-center min-h-[60vh] text-center px-4">
    <div class="bg-white p-8 rounded-xl shadow-sm max-w-2xl w-full">
        <div class="text-6xl mb-6">🚧</div>
        <h1 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Página en construcción</h1>
        <p class="text-gray-600 mb-8 text-lg">Estamos trabajando para traerte esta funcionalidad pronto.</p>
        <p class="text-gray-500 mb-6">Mientras tanto, puedes seguir explorando otras secciones del dashboard.</p>
        <a href="{{ route('dashboard') }}" 
           class="inline-flex items-center px-6 py-3 bg-blue-600 text-white font-medium rounded-lg hover:bg-blue-700 transition">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
            </svg>
            Volver al Dashboard
        </a>
    </div>
</div>
@endsection
