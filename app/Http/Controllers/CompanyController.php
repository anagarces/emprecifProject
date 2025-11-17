<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /* ============================================================
     *  1) BUSCADOR (PÚBLICO Y PRIVADO)
     * ============================================================ */
    public function search(Request $request)
    {
        $query = trim($request->input('q', ''));

        if ($query === '') {
            return view('company.search', [
                'results' => [],
                'query'   => $query,
            ]);
        }

        // Búsqueda insensible a mayúsculas (PostgreSQL)
        $results = Company::where('name', 'ILIKE', "%{$query}%")
            ->orWhere('cif', 'ILIKE', "%{$query}%")
            ->limit(20)
            ->get();

        return view('company.search', [
            'results' => $results,
            'query'   => $query,
        ]);
    }

    /* ============================================================
     *  2) BUSCADOR AJAX (PÚBLICO)
     * ============================================================ */
    public function searchAjax(Request $request)
    {
        $query = trim($request->input('q', ''));

        if ($query === '') {
            return response()->json([]);
        }

        $results = Company::where('name', 'ILIKE', "%{$query}%")
            ->orWhere('cif', 'ILIKE', "%{$query}%")
            ->limit(10)
            ->get([
                'id',
                'name',
                'slug',
                'cif',
                'city',
                'province',
            ]);

        return response()->json($results);
    }

    /* ============================================================
     *  3) PERFIL PÚBLICO (VISITANTES + LOGUEADOS)
     * ============================================================ */
    public function showPublic(Company $company)
    {
        return view('company.show_public', [
            'company'       => $company->load(['accounts', 'events']),
            'canSeePublic'  => true,
            'canSeePremium' => false,
        ]);
    }

    /* ============================================================
     *  4) PERFIL PRIVADO / COMPLETO (LOGUEADOS)
     * ============================================================ */
    public function show(Company $company)
    {
        $user = auth()->user();

        $isAdmin   = $user->hasRole('admin');
        $isPremium = $user->hasRole('premium');
        $isTrial   = $user->trial_ends_at && now()->lt($user->trial_ends_at);

        return view('company.show', [
            'company'       => $company->load(['accounts', 'events', 'directors', 'shareholdersRelation']),
            'canSeePublic'  => true,
            'canSeePremium' => ($isPremium || $isAdmin),
            'isFavorite'    => $user ? $company->isFavoritedBy($user) : false,
        ]);
    }
}



