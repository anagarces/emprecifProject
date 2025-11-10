@extends('layouts.auth')

@section('auth_title', 'Restablecer Contraseña')

@section('auth_content')
    <div class="text-center mb-6">
        <h2 class="text-2xl font-bold text-gray-900">
            {{ __('Establece una nueva contraseña') }}
        </h2>
        <p class="mt-2 text-sm text-gray-600">
            {{ __('Crea una nueva contraseña segura para tu cuenta.') }}
        </p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-6">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700">
                {{ __('Correo electrónico') }}
            </label>
            <div class="mt-1">
                <input id="email" name="email" type="email" autocomplete="email" required
                       value="{{ old('email', $request->email) }}" autofocus
                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                @error('email')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Password -->
        <div>
            <label for="password" class="block text-sm font-medium text-gray-700">
                {{ __('Nueva contraseña') }}
            </label>
            <div class="mt-1">
                <input id="password" name="password" type="password" autocomplete="new-password" required
                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
                @error('password')
                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>
            <p class="mt-1 text-xs text-gray-500">
                {{ __('Mínimo 8 caracteres, con mayúsculas, minúsculas y números.') }}
            </p>
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                {{ __('Confirmar nueva contraseña') }}
            </label>
            <div class="mt-1">
                <input id="password_confirmation" name="password_confirmation" type="password" 
                       autocomplete="new-password" required
                       class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-primary-500 focus:border-primary-500 sm:text-sm">
            </div>
        </div>

        <div>
            <button type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-primary-600 hover:bg-primary-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary-500">
                {{ __('Restablecer contraseña') }}
            </button>
        </div>

        <div class="text-center text-sm">
            <a href="{{ route('login') }}" class="font-medium text-primary-600 hover:text-primary-500">
                {{ __('Volver al inicio de sesión') }}
            </a>
        </div>
    </form>
@endsection
