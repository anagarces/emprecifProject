<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;


//Verifica si el usuario es premium o admin
class EnsureUserIsPremium
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        
        // Allow access to admins and premium users
        if ($user && ($user->hasRole('admin') || $user->hasRole('premium'))) {
            return $next($request);
        }

        // Redirect to subscription plans if not premium or admin
        return redirect()->route('subscription.plans')
            ->with('error', 'Necesitas una suscripción premium para acceder a esta sección.');
    }
}
