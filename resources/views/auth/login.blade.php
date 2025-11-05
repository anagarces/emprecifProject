@extends('layouts.guest')

@section('content')
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <section style="min-height: 80vh; display: flex; align-items: center; justify-content: center; padding: 4rem 2rem;">
        <div style="max-width: 500px; width: 100%;">
            <div style="text-align: center; margin-bottom: 3rem;">
                <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 3rem; font-weight: 900; margin-bottom: 1rem;">
                    {{ __('Bienvenido de Nuevo') }}
                </h1>
                <p style="font-size: 1.125rem; color: #6b7280;">
                    {{ __('Accede a tu cuenta para consultar información empresarial') }}
                </p>
            </div>

            <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Email Address -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="email" style="display: block; font-weight: 700; margin-bottom: 0.5rem; color: #1f2937;">
                            {{ __('Email') }}
                        </label>
                        <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username"
                               style="width: 100%; padding: 1rem; border: 2px solid #E2E8F0; border-radius: 12px; font-size: 1rem; transition: all 0.3s;"
                               onfocus="this.style.borderColor='#3b82f6'"
                               onblur="this.style.borderColor='#E2E8F0'"
                               placeholder="tu@email.com">
                        <x-input-error :messages="$errors->get('email')" style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;" />
                    </div>

                    <!-- Password -->
                    <div style="margin-bottom: 1.5rem;">
                        <label for="password" style="display: block; font-weight: 700; margin-bottom: 0.5rem; color: #1f2937;">
                            {{ __('Contraseña') }}
                        </label>
                        <input id="password" type="password" name="password" required autocomplete="current-password"
                               style="width: 100%; padding: 1rem; border: 2px solid #E2E8F0; border-radius: 12px; font-size: 1rem; transition: all 0.3s;"
                               onfocus="this.style.borderColor='#3b82f6'"
                               onblur="this.style.borderColor='#E2E8F0'"
                               placeholder="••••••••">
                        <x-input-error :messages="$errors->get('password')" style="color: #ef4444; font-size: 0.875rem; margin-top: 0.5rem;" />
                    </div>

                    <!-- Remember Me -->
                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 2rem;">
                        <label style="display: flex; align-items: center; gap: 0.5rem; cursor: pointer;">
                            <input id="remember_me" type="checkbox" name="remember" style="width: 18px; height: 18px; cursor: pointer;">
                            <span style="font-size: 0.875rem; color: #6b7280;">{{ __('Recordarme') }}</span>
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" style="font-size: 0.875rem; color: #3b82f6; text-decoration: none; font-weight: 700;">
                                {{ __('¿Olvidaste tu contraseña?') }}
                            </a>
                        @endif
                    </div>

                    <button type="submit" style="width: 100%; background: #3b82f6; color: white; padding: 1rem; border: none; border-radius: 12px; font-weight: 700; font-size: 1rem; cursor: pointer; transition: all 0.3s; margin-bottom: 1.5rem;"
                            onmouseover="this.style.backgroundColor='#2563eb'"
                            onmouseout="this.style.backgroundColor='#3b82f6'">
                        {{ __('Iniciar Sesión') }}
                    </button>

                    <div style="text-align: center; font-size: 0.875rem; color: #6b7280;">
                        {{ __('¿No tienes cuenta?') }}
                        <a href="{{ route('register') }}" style="color: #3b82f6; text-decoration: none; font-weight: 700;">
                            {{ __('Regístrate gratis') }}
                        </a>
                    </div>
                </form>

                <!-- Social Login Buttons -->
                <div style="margin-top: 2rem; padding-top: 2rem; border-top: 2px solid #E2E8F0;">
                    <p style="text-align: center; font-size: 0.875rem; color: #6b7280; margin-bottom: 1rem;">{{ __('O continúa con') }}</p>
                    <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1rem;">
                        <a href="{{ route('auth.socialite.redirect', 'google') }}" 
                           style="display: flex; align-items: center; justify-content: center; padding: 1rem; border: 2px solid #E2E8F0; border-radius: 12px; background: white; font-weight: 700; cursor: pointer; transition: all 0.3s; text-decoration: none; color: #1f2937;"
                           onmouseover="this.style.borderColor='#3b82f6'"
                           onmouseout="this.style.borderColor='#E2E8F0'">
                            <svg class="w-5 h-5 mr-2" viewBox="0 0 24 24" width="20" height="20" xmlns="http://www.w3.org/2000/svg" style="margin-right: 0.5rem;">
                                <g transform="matrix(1, 0, 0, 1, 27.009001, -39.238998)">
                                    <path fill="#4285F4" d="M -3.264 51.509 C -3.264 50.719 -3.334 49.969 -3.454 49.239 L -14.754 49.239 L -14.754 53.749 L -8.28426 53.749 C -8.52464 55.229 -9.24466 56.479 -10.4631 57.329 L -10.4631 60.524 L -6.02334 60.524 C -3.76334 58.489 -2.704 55.234 -2.704 51.509 L -3.264 51.509 Z"/>
                                    <path fill="#34A853" d="M -14.754 63.239 C -11.514 63.239 -8.8045 62.159 -6.02334 60.524 L -10.4631 57.329 C -11.6658 58.049 -13.172 58.489 -14.754 58.489 C -17.604 58.489 -20.0135 56.569 -20.8505 53.899 L -25.396 53.899 L -25.396 57.189 C -23.241 61.479 -19.254 63.239 -14.754 63.239 Z"/>
                                    <path fill="#FBBC05" d="M -20.8505 53.899 C -21.1905 52.919 -21.385 51.859 -21.385 50.759 C -21.385 49.659 -21.1905 48.599 -20.8505 47.619 L -20.8505 44.329 L -25.396 44.329 C -26.5465 46.629 -27.104 49.129 -27.104 51.759 C -27.104 54.389 -26.5465 56.889 -25.396 59.189 L -20.8505 53.899 Z"/>
                                    <path fill="#EA4335" d="M -14.754 45.029 C -12.9845 45.029 -11.4038 45.589 -10.0466 46.649 L -6.02334 43.439 C -8.8045 41.769 -11.514 40.279 -14.754 40.279 C -19.254 40.279 -23.241 42.039 -25.396 46.329 L -20.8505 47.619 C -20.0135 44.949 -17.604 43.029 -14.754 43.029 Z"/>
                                </g>
                            </svg>
                            Google
                        </a>
                        
                        <a href="{{ route('auth.socialite.redirect', 'linkedin') }}" 
                           style="display: flex; align-items: center; justify-content: center; padding: 1rem; border: 2px solid #E2E8F0; border-radius: 12px; background: white; font-weight: 700; cursor: pointer; transition: all 0.3s; text-decoration: none; color: #1f2937;"
                           onmouseover="this.style.borderColor='#3b82f6'"
                           onmouseout="this.style.borderColor='#E2E8F0'">
                            <svg class="w-5 h-5 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20" fill="#0A66C2" style="margin-right: 0.5rem;">
                                <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                            </svg>
                            LinkedIn
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

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
