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
     *  BÚSQUEDA DE EMPRESAS (Dashboard / Usuarios autenticados)
     * --------------------------------------------------------------
     */
    public function search(Request $request)
    {
        $query = trim($request->input('q', ''));
        $results = [];

        if ($query) {
            $results = Company::active()
                ->where(function ($q) use ($query) {
                    $q->where('name', 'like', "%$query%")
                      ->orWhere('cif', 'like', "%$query%");
                })
                ->limit(20)
                ->get();
        }

        return view('company.search', compact('results'));
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
    public function show($slug)
    {
        $user = Auth::user();

        /** ---------------------------------------------------------
         * 1) Cargar empresa con relaciones necesarias
         * --------------------------------------------------------- */
        $company = Cache::remember(
            "company.full.{$slug}",
            now()->addMinutes(20),
            fn () => Company::with([
                'directors',
                'shareholdersRelation',
                'events',
                'accounts',
                'favoritedBy'
            ])
            ->active()
            ->where('slug', $slug)
            ->firstOrFail()
        );

        /** ---------------------------------------------------------
         * 2) Determinar nivel de acceso según rol
         * --------------------------------------------------------- */
        $isGuest           = !$user;
        $isPremiumOrAdmin  = $user && ($user->isPremium() || $user->isAdmin());
        $isTrial           = $user && $user->isOnTrial();
        $isFree            = $user && $user->isFree();



        /** ---------------------------------------------------------
         * 3) Control para usuarios Trial → máx 2 empresas
         * --------------------------------------------------------- */
        if ($user && $user->hasRole('usuario') && $isTrial) {
            
            $access = $user->canAccessCompany();

            if (!$access['canAccess']) {
                return redirect()->route('pricing')
                    ->with('error', $access['message']);
            }

            $user->incrementCompanyViewCount();
        }



        /** ---------------------------------------------------------
         * 4) Preparar variables para la vista unificada
         * --------------------------------------------------------- */
        return view('company.show', [
            'company'           => $company,

            // Roles
            'isGuest'           => $isGuest,
            'isPremiumOrAdmin'  => $isPremiumOrAdmin,
            'isTrial'           => $isTrial,
            'isFree'            => $isFree,

            // Favoritos
            'isFavorite'        => $user ? $company->isFavoritedBy($user) : false,

            // Datos que la vista filtrará por rol
            'directors'         => $company->directors,
            'shareholders'      => $company->shareholdersRelation,
            'events'            => $company->events()->orderBy('fecha', 'desc')->get(),
            'accounts'          => $company->accounts()->orderBy('ejercicio', 'desc')->get(),
        ]);
    }
}
