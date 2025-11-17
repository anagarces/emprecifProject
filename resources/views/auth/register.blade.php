@extends('layouts.auth')

@section('auth_title', 'Crear Cuenta')

@section('auth_content')
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div class="text-center">
            <h2 class="text-2xl font-bold text-gray-900">
                {{ __('Crea tu cuenta') }}
            </h2>
            <p class="mt-2 text-sm text-gray-600">
                {{ __('Comienza a explorar información empresarial de forma gratuita') }}
            </p>
        </div>

        <!-- Name -->
        <div>
            <label for="name" class="block text-sm font-medium text-gray-700">
                {{ __('Nombre completo') }}
            </label>
            <div class="mt-1">
                <input id="name" name="name" type="text" autocomplete="name" required
                       value="{{ old('name') }}" autofocus
                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                @error('name')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                {{ __('Correo electrónico') }}
            </label>
            <div class="mt-1">
                <input id="email" name="email" type="email" autocomplete="email" required
                       value="{{ old('email') }}"
                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
                {{ __('Contraseña') }}
            </label>
            <div class="mt-1">
                <input id="password" name="password" type="password" autocomplete="new-password" required
                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                {{ __('Confirmar Contraseña') }}
            </label>
            <div class="mt-1">
                <input id="password_confirmation" name="password_confirmation" type="password" autocomplete="new-password" required
                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
            </div>
        </div>

        <!-- Terms and Conditions -->
        <div class="flex items-center">
            <input id="terms" name="terms" type="checkbox" required
                   class="h-4 w-4 text-primary-600 focus:ring-primary-500 border-gray-300 rounded">
            <label for="terms" class="ml-2 block text-sm text-gray-700">
                {{ __('Acepto los') }} <a href="{{ route('legal.terms') }}" class="text-primary-600 hover:text-primary-500">
    {{ __('Términos y Condiciones') }}
</a>

                {{ __('y la') }} <a href="{{ route('legal.privacy') }}">
{{ __('Política de Privacidad') }}</a>
            </label>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                {{ __('Crear Cuenta') }}
            </button>
        </div>

        <div class="text-center text-sm">
            <span class="text-gray-600">{{ __('¿Ya tienes una cuenta?') }}</span>
            <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500">
                {{ __('Inicia sesión') }}
            </a>
        </div>
    </form>

    <!-- Social Login Buttons -->
    <div class="mt-6">
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-300"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-2 bg-white text-gray-500">
                    {{ __('O regístrate con') }}
                </span>
            </div>
        </div>

        <div class="mt-6 grid grid-cols-2 gap-3">
            <a href="{{ route('auth.socialite.redirect', 'google') }}" 
               class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                <svg class="w-5 h-5" viewBox="0 0 24 24" fill="currentColor">
                    <path d="M12.545,10.239v3.821h5.445c-0.712,2.315-2.647,3.972-5.445,3.972c-3.332,0-6.033-2.701-6.033-6.032s2.701-6.032,6.033-6.032c1.498,0,2.866,0.549,3.921,1.453l2.814-2.814C17.503,2.988,15.139,2,12.545,2C7.021,2,2.543,6.477,2.543,12s4.478,10,10.002,10c8.396,0,10.249-7.85,9.426-11.748L12.545,10.239z"/>
                </svg>
                <span class="ml-2">Google</span>
            </a>
            
            <a href="{{ route('auth.socialite.redirect', 'linkedin') }}" 
               class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-700 hover:bg-gray-50">
                <svg class="w-5 h-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" style="color: #0A66C2;">
                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                </svg>
                <span class="ml-2">LinkedIn</span>
            </a>
        </div>
    </div>
@endsection
