<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

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
        
        // Allow access if user is admin or has premium access
        if ($user && ($user->isAdmin() || $user->isPremium())) {
            return $next($request);
        }

        // Redirect to pricing page if not premium
        return redirect()->route('pricing')
            ->with('error', 'You need a premium subscription to access this content.');
    }
}
