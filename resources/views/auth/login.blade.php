@extends('layouts.guest')

@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <!-- Social Login Buttons -->
    <div class="mb-6">
        <p class="text-center text-sm text-gray-600 mb-4">O inicia sesión con:</p>
        <div class="flex justify-center space-x-4">
            <!-- Google Login Button -->
            <a href="{{ route('auth.socialite.redirect', 'google') }}" 
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" width="24" height="24" xmlns="http://www.w3.org/2000/svg">
                    <g transform="matrix(1, 0, 0, 1, 27.009001, -39.238998)">
                        <path fill="#4285F4" d="M -3.264 51.509 C -3.264 50.719 -3.334 49.969 -3.454 49.239 L -14.754 49.239 L -14.754 53.749 L -8.28426 53.749 C -8.52464 55.229 -9.24466 56.479 -10.4631 57.329 L -10.4631 60.524 L -6.02334 60.524 C -3.76334 58.489 -2.704 55.234 -2.704 51.509 L -3.264 51.509 Z"/>
                        <path fill="#34A853" d="M -14.754 63.239 C -11.514 63.239 -8.8045 62.159 -6.02334 60.524 L -10.4631 57.329 C -11.6658 58.049 -13.172 58.489 -14.754 58.489 C -17.604 58.489 -20.0135 56.569 -20.8505 53.899 L -25.396 53.899 L -25.396 57.189 C -23.241 61.479 -19.254 63.239 -14.754 63.239 Z"/>
                        <path fill="#FBBC05" d="M -20.8505 53.899 C -21.1905 52.919 -21.385 51.859 -21.385 50.759 C -21.385 49.659 -21.1905 48.599 -20.8505 47.619 L -20.8505 44.329 L -25.396 44.329 C -26.5465 46.629 -27.104 49.129 -27.104 51.759 C -27.104 54.389 -26.5465 56.889 -25.396 59.189 L -20.8505 53.899 Z"/>
                        <path fill="#EA4335" d="M -14.754 45.029 C -12.9845 45.029 -11.4038 45.589 -10.0466 46.649 L -6.02334 43.439 C -8.8045 41.769 -11.514 40.279 -14.754 40.279 C -19.254 40.279 -23.241 42.039 -25.396 46.329 L -20.8505 47.619 C -20.0135 44.949 -17.604 43.029 -14.754 43.029 Z"/>
                    </g>
                </svg>
                Google
            </a>
            
            <!-- LinkedIn Login Button -->
            <a href="{{ route('auth.socialite.redirect', 'linkedin') }}" 
               class="inline-flex items-center px-4 py-2 bg-white border border-gray-300 rounded-md font-semibold text-xs text-gray-700 uppercase tracking-widest shadow-sm hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 disabled:opacity-25 transition ease-in-out duration-150">
                <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#0A66C2">
                    <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                </svg>
                LinkedIn
            </a>
        </div>
    </div>

    <div class="relative my-6">
        <div class="absolute inset-0 flex items-center">
            <div class="w-full border-t border-gray-300"></div>
        </div>
        <div class="relative flex justify-center text-sm">
            <span class="px-2 bg-white text-gray-500">O inicia sesión con email</span>
        </div>
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
@endsection
