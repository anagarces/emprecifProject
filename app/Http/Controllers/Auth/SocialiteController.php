<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Spatie\Permission\Models\Role;

class SocialiteController extends Controller
{
    protected $providers = ['google', 'linkedin'];

    /**
     * Redirect to the provider's authentication page.
     * 
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        if (!in_array($provider, $this->providers)) {
            return redirect()->route('login')
                ->with('error', 'Método de inicio de sesión no soportado.');
        }

        try {
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
            Log::error('Socialite redirect error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'No se pudo conectar con el proveedor de autenticación.');
        }
    }

    /**
     * Handle provider callback response.
     * 
     * @param string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleProviderCallback($provider)
    {
        if (!in_array($provider, $this->providers)) {
            return redirect()->route('login')
                ->with('error', 'Método de inicio de sesión no soportado.');
        }

        try {
            $socialUser = Socialite::driver($provider)->user();
            
            if (!$socialUser->getEmail()) {
                return redirect()->route('login')
                    ->with('error', 'No se pudo obtener la dirección de correo electrónico del proveedor.');
            }
            
            // Find existing user or create new one
            $user = $this->findOrCreateUser($provider, $socialUser);

            // Log the user in
            Auth::login($user, true);

            return redirect()->intended(route('dashboard'));

        } catch (\Laravel\Socialite\Two\InvalidStateException $e) {
            Log::error('Socialite InvalidStateException: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'La sesión ha expirado. Por favor, inténtalo de nuevo.');
        } catch (\Exception $e) {
            Log::error('Socialite error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'Error al autenticar con ' . ucfirst($provider) . '. Por favor, inténtalo de nuevo.');
        }
    }

    /**
     * Find or create a user based on provider data.
     *
     * @param string $provider
     * @param \Laravel\Socialite\Contracts\User $socialUser
     * @return \App\Models\User
     */
    protected function findOrCreateUser($provider, $socialUser)
    {
        // Check if user with this email already exists
        $user = User::where('email', $socialUser->getEmail())->first();

        if ($user) {
            // Update provider information if user exists
            $user->update([
                'provider' => $provider,
                'provider_id' => $socialUser->getId(),
                'email_verified_at' => $user->email_verified_at ?? now(),
            ]);
            
            return $user;
        }

        // Create new user if doesn't exist
        $user = User::create([
            'name' => $this->getUserName($socialUser),
            'email' => $socialUser->getEmail(),
            'password' => Hash::make(Str::random(24)), // Random secure password
            'provider' => $provider,
            'provider_id' => $socialUser->getId(),
            'email_verified_at' => now(),
            'trial_ends_at' => now()->addDays(15), // 15-day trial
        ]);
        
        // Assign default user role
        $this->assignDefaultRole($user);
        
        return $user;
    }
    
    /**
     * Get the username from social user.
     *
     * @param \Laravel\Socialite\Contracts\User $socialUser
     * @return string
     */
    protected function getUserName($socialUser)
    {
        if ($name = $socialUser->getName()) {
            return $name;
        }
        
        if ($nickname = $socialUser->getNickname()) {
            return $nickname;
        }
        
        return explode('@', $socialUser->getEmail())[0]; // Use email username as fallback
    }
    
    /**
     * Assign default role to the user.
     *
     * @param \App\Models\User $user
     * @return void
     */
    protected function assignDefaultRole($user)
    {
        $roleName = 'user';
        
        // Check if role exists, if not create it
        if (!Role::where('name', $roleName)->exists()) {
            Role::create(['name' => $roleName, 'guard_name' => 'web']);
        }
        
        $user->assignRole($roleName);
    }
}
