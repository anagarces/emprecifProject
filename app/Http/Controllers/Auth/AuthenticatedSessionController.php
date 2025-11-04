<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

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
     * Redirect the user to the provider authentication page.
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from provider.
     */
    public function handleProviderCallback($provider)
    {
        try {
            $socialUser = Socialite::driver($provider)->user();
            
            // Verificar si el correo electrónico está verificado (si es necesario)
            if (empty($socialUser->getEmail())) {
                return redirect()->route('login')
                    ->with('error', 'No se pudo obtener el correo electrónico del proveedor. Por favor, utiliza otro método de inicio de sesión.');
            }
            
            $user = User::where('email', $socialUser->getEmail())->first();
            
            if (!$user) {
                // Generar una contraseña aleatoria segura
                $password = Str::random(16);
                
                $user = User::create([
                    'name' => $socialUser->getName() ?: $socialUser->getNickname() ?: $socialUser->getEmail(),
                    'email' => $socialUser->getEmail(),
                    'password' => bcrypt($password), // Contraseña aleatoria segura
                    'provider' => $provider,
                    'provider_id' => $socialUser->getId(),
                    'email_verified_at' => now(),
                    'trial_ends_at' => now()->addDays(15), // Período de prueba de 15 días
                ]);
            } else {
                // Actualizar datos del proveedor si es necesario
                if (empty($user->provider)) {
                    $user->update([
                        'provider' => $provider,
                        'provider_id' => $socialUser->getId(),
                    ]);
                }
            }
            
            Auth::login($user, true); // Recordar sesión
            
            return redirect()->intended(route('dashboard', absolute: false));
            
        } catch (\Exception $e) {
            \Log::error('Error en autenticación social: ' . $e->getMessage());
            return redirect()->route('login')
                ->with('error', 'No se pudo iniciar sesión con ' . ucfirst($provider) . '. Por favor, inténtalo de nuevo.');
        }
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
}
