<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckTrialPeriod
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->hasRole('admin') || $user->hasRole('premium')) {
            return $next($request);
        }

        if ($user->trial_ends_at && $user->trial_ends_at->isFuture()) {
            return $next($request);
        }

        return redirect()->route('subscription.plans')
            ->with('message', 'Tu período de prueba ha expirado. Por favor, elige un plan para continuar.');
    }
}
