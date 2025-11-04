@extends('layouts.app')

@section('title', 'Página no encontrada - ' . config('app.name'))

@section('content')
<div class="min-h-screen flex flex-col items-center justify-center bg-gray-50 py-12 px-4 sm:px-6 lg:px-8">
    <div class="max-w-md w-full space-y-8 text-center">
        <div>
            <h1 class="text-6xl font-bold text-blue-600">404</h1>
            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">Página no encontrada</h2>
            <p class="mt-2 text-sm text-gray-600">Lo sentimos, no pudimos encontrar la página que estás buscando.</p>
        </div>
        
        <div class="mt-8">
            <a href="{{ url('/') }}" class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-150 ease-in-out">
                <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                    <svg class="h-5 w-5 text-blue-500 group-hover:text-blue-400 transition ease-in-out duration-150" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M9.707 14.707a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 1.414L7.414 9H15a1 1 0 110 2H7.414l2.293 2.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                    </svg>
                </span>
                Volver al inicio
            </a>
        </div>
        
        <div class="mt-8 border-t border-gray-200 pt-8">
            <p class="text-sm text-gray-500">
                ¿Necesitas ayuda? <a href="{{ route('contact') }}" class="font-medium text-blue-600 hover:text-blue-500 transition duration-150 ease-in-out">Contáctanos</a>
            </p>
        </div>
    </div>
    
    <div class="mt-12">
        <div class="text-center">
            <p class="text-sm text-gray-500">
                &copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.
            </p>
        </div>
    </div>
</div>
@endsection
