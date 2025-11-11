<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


//Se encarga de restricciones especificas durante el trial
//Limita a los usuarios de prueba a ver un max de 2 empresas y no descargar informes
class CheckTrialAccess
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
        
        // Skip for guests, admins, and premium users
        if (!$user || $user->hasRole(['admin', 'premium'])) {
            return $next($request);
        }

        // Check if user is on trial
        if ($user->isOnTrial()) {
            // Block report downloads during trial
            if ($request->routeIs('reports.download') || $request->is('reports/*/download')) {
                return redirect()->route('dashboard')
                    ->with('error', 'La descarga de informes no está disponible durante el periodo de prueba.');
            }
            
            // Check company view limit (2 views during trial)
            if (($request->routeIs('companies.show') || $request->is('companies/*')) && 
                $user->companies_viewed >= 2) {
                return redirect()->route('dashboard')
                    ->with('error', 'Has alcanzado el límite de consultas durante tu prueba. Actualiza tu plan para continuar.');
            }
        }
        // Check if trial has ended
        elseif ($user->trial_ends_at && $user->trial_ends_at->isPast()) {
            // Block access to premium content when trial ends
            if ($request->routeIs('companies.show', 'reports.*')) {
                return redirect()->route('subscription.plans')
                    ->with('error', 'Tu periodo de prueba ha terminado. Actualiza tu plan para continuar.');
            }
        }

        return $next($request);
    }
}
