<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class AuthenticatedSessionController extends Controller
{
    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();

        return redirect()->intended(route('dashboard', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

    /**
     * Redirect the user to the provider authentication page.
     */
    public function redirectToProvider($provider)
    {
        if (!in_array($provider, ['google', 'linkedin'])) {
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
     * Obtain the user information from provider.
     */
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            if (empty($socialUser->getEmail())) {
                return redirect()->route('login')
                    ->with('error', 'No se pudo obtener el correo electrónico del proveedor. Por favor, utiliza otro método de inicio de sesión.');
            }
            
            $user = User::where('email', $socialUser->getEmail())->first();
            
            if (!$user) {
                $user = User::create([
                    'name' => $socialUser->getName() ?: $socialUser->getNickname() ?: $socialUser->getEmail(),
                    'email' => $socialUser->getEmail(),
                    'password' => bcrypt(Str::random(16)),
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'email_verified_at' => now(),
                    'trial_ends_at' => now()->addDays(15),
                ]);
                
                // Assign default user role
                $user->assignRole('user');
            } else if (empty($user->provider)) {
                $user->update([
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                ]);
            }
            
            Auth::login($user, true);
            return redirect()->intended(route('dashboard', absolute: false));
            
        } catch (\Exception $e) {
            Log::error('Social authentication error: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'No se pudo iniciar sesión con ' . ucfirst($provider) . '. Por favor, inténtalo de nuevo.');
        }
    }
}
