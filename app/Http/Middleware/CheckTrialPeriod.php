<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;

class CheckTrialPeriod
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        
        // Rutas permitidas sin verificación de suscripción
        $allowedRoutes = [
            'subscription.plans',
            'subscription.success',
            'subscription.cancel',
            'subscription.portal',
            'profile.show',
            'profile.update',
            'profile.destroy',
            'verification.notice',
            'verification.verify',
            'verification.send',
            'password.request',
            'password.email',
            'password.reset',
            'password.update',
            'password.confirm',
            'logout',
        ];

        // Si la ruta actual está en la lista de permitidas, continuar
        if (in_array(Route::currentRouteName(), $allowedRoutes)) {
            return $next($request);
        }

        // Si el usuario no está autenticado, continuar
        if (!$user) {
            return $next($request);
        }

        // Si el usuario es administrador, permitir el acceso
        if ($user->hasRole('admin')) {
            return $next($request);
        }

        // Si el usuario tiene una suscripción activa, permitir el acceso
        if ($user->subscribed('default')) {
            return $next($request);
        }

        // Verificar si el período de prueba está activo
        $onTrial = $user->trial_ends_at && $user->trial_ends_at->isFuture();
        
        // Si el período de prueba está activo, permitir el acceso
        if ($onTrial) {
            return $next($request);
        }

        // Redirigir a la página de planes si el período de prueba ha expirado
        return redirect()->route('subscription.plans')
            ->with('message', 'Tu período de prueba ha expirado. Por favor, elige un plan para continuar.');
    }
}
