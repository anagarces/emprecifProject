@extends('layouts.auth')

@section('auth_title', 'Verifica tu correo electrónico')

@section('auth_content')
    <div class="text-center mb-6">
        <div class="mx-auto flex items-center justify-center h-12 w-12 rounded-full bg-green-100">
            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
            </svg>
        </div>
        <h2 class="mt-3 text-2xl font-bold text-gray-900">
            {{ __('Verifica tu correo electrónico') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            {{ __('¡Gracias por registrarte! Antes de comenzar, por favor verifica tu dirección de correo electrónico haciendo clic en el enlace que te hemos enviado.') }}
        </p>
        <p class="mt-2 text-sm text-gray-600">
            {{ __('Si no has recibido el correo, estaremos encantados de enviarte otro.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 p-3 bg-green-50 text-green-700 text-sm rounded-md">
            {{ __('Se ha enviado un nuevo enlace de verificación a la dirección de correo electrónico que proporcionaste durante el registro.') }}
        </div>
    @endif

    <div class="space-y-4">
        <form method="POST" action="{{ route('verification.send') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                {{ __('Reenviar correo de verificación') }}
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="w-full">
            @csrf
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 bg-white hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                {{ __('Cerrar sesión') }}
            </button>
        </form>
    </div>

    @if (Route::has('verification.resend'))
        <div class="mt-4 text-center text-sm text-gray-600">
            <p>{{ __('¿No recibiste el correo?') }} <a href="{{ route('verification.resend') }}" class="font-medium text-primary-600 hover:text-primary-500">{{ __('Haz clic aquí para solicitar otro') }}</a></p>
        </div>
    @endif
@endsection
