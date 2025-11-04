<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SocialiteController extends Controller
{
    /**
     * Redirige al proveedor de autenticación
     * 
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Maneja la respuesta del proveedor de autenticación
     * 
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            // Buscar usuario existente
            $user = User::where('email', $socialUser->getEmail())->first();

            if (!$user) {
                // Crear nuevo usuario si no existe
                $user = User::create([
                    'name' => $socialUser->getName() ?? $socialUser->getNickname() ?? 'Usuario',
                    'email' => $socialUser->getEmail(),
                    'password' => Hash::make(Str::random(24)), // Contraseña aleatoria segura
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'email_verified_at' => now(),
                    'trial_ends_at' => now()->addDays(15), // Prueba gratuita de 15 días
                ]);
                
                // Asignar rol de usuario por defecto
                $user->assignRole('user');
            } else {
                // Actualizar información del proveedor si el usuario ya existe
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);
            }

            // Iniciar sesión
            Auth::login($user, true);

            return redirect()->intended(route('dashboard'));

        } catch (\Exception $e) {
            return redirect()->route('login')
                ->withErrors(['socialite' => 'Error al iniciar sesión con ' . ucfirst($provider) . '. Por favor, inténtalo de nuevo.']);
        }
    }
}
