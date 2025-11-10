<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class CheckSubscription
{
   public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        // Permitir acceso a administradores
        if ($user->isAdmin()) {
            return $next($request);
        }

        // Verificar si el usuario tiene una suscripción activa
        if (!$user->isPremium()) {
            return redirect()
                ->route('pricing')
                ->with('message', 'Necesitas una suscripción premium para acceder a esta sección.');
        }

        return $next($request);
    }
}
