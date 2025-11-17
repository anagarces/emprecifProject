<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class CompanyController extends Controller
{
    /**
     * --------------------------------------------------------------
     *  BÚSQUEDA DE EMPRESAS (Dentro del Dashboard / Usuarios autenticados)
     * --------------------------------------------------------------
     */
    
    public function search(Request $request)
    {
        $query = trim($request->input('q', ''));
        $results = collect();

        if ($query !== '') {
            $results = Company::with(['accounts' => function ($q) {
                    $q->orderBy('ejercicio', 'desc');
                }])
                ->active()
                ->search($query)
                ->limit(20)
                ->get();
        }

        return view('company.search', [
            'results' => $results,
        ]);
    }



    /**
     * --------------------------------------------------------------
     *  BUSCADOR AJAX (barra de búsqueda del dashboard)
     * --------------------------------------------------------------
     */
     public function searchAjax(Request $request)
    {
        $request->validate([
            'query' => 'required|string|min:2|max:255',
        ]);

        $companies = Company::active()
            ->search($request->query('query'))
            ->limit(10)
            ->get(['id', 'slug', 'name', 'cif', 'city', 'province']);

        return response()->json($companies);
    }



    /**
     * --------------------------------------------------------------
     *  SHOW UNIFICADO (público + autenticados + premium)
     * --------------------------------------------------------------
     */
     public function show(Company $company)
    {
        $user = Auth::user();

        // Recargar con relaciones y cachear
        $company = Cache::remember(
            "company.full.{$company->slug}",
            now()->addMinutes(20),
            function () use ($company) {
                return Company::with([
                        'directors',
                        'shareholdersRelation',
                        'events',
                        'accounts',
                    ])
                    ->active()
                    ->where('id', $company->id)
                    ->firstOrFail();
            }
        );

        // ---- Roles / estado de usuario ----
        $isGuest          = !$user;
        $isPremiumOrAdmin = $user && ($user->isPremium() || $user->isAdmin());
        $isTrial          = $user && $user->isOnTrial();
        $isFree           = $user && $user->isFree();

        // ---- Límite de trial: máximo 2 empresas ----
        if ($user && $user->hasRole('usuario') && $isTrial) {
            $access = $user->canAccessCompany();

            if (!$access['canAccess']) {
                return redirect()->route('pricing')
                    ->with('error', $access['message']);
            }

            $user->incrementCompanyViewCount();
        }

        // ---- Permisos de datos por rol ----
        $canSeePublic  = true;              // cualquier usuario autenticado
        $canSeePremium = $isPremiumOrAdmin; // solo premium / admin

        return view('company.show', [
            'company'          => $company,

            // Info de rol
            'isGuest'          => $isGuest,
            'isPremiumOrAdmin' => $isPremiumOrAdmin,
            'isTrial'          => $isTrial,
            'isFree'           => $isFree,
            'canSeePublic'     => $canSeePublic,
            'canSeePremium'    => $canSeePremium,

            // Favoritos (lo dejaremos inactivo de momento)
            'isFavorite'       => false,

            // Relaciones
            'directors'        => $company->directors,
            'shareholders'     => $company->shareholdersRelation,
            'events'           => $company->events()->orderBy('fecha', 'desc')->get(),
            'accounts'         => $company->accounts()->orderBy('ejercicio', 'desc')->get(),
        ]);
    }
}

