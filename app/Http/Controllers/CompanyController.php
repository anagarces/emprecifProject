<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Http\JsonResponse;

class CompanyController extends Controller
{
    /**
     * Muestra el formulario de búsqueda de empresas dentro del dashboard (usuarios autenticados).
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\View\View
     */
    public function search(Request $request)
    {
        $query = trim($request->input('q', ''));
        $results = [];

        if ($query) {
            // ⚠️ Por ahora, simulamos datos hasta conectar con la API real
            $results = [
                [
                    'id' => 1,
                    'nombre' => 'TECNOLOGÍA AVANZADA SL',
                    'nif' => 'A12345678',
                    'localidad' => 'Barcelona',
                    'provincia' => 'Barcelona',
                    'estado' => 'ACTIVA',
                    'facturacion' => 2400000,
                    'resultado_neto' => 347000,
                    'empleados' => 24,
                ],
                [
                    'id' => 2,
                    'nombre' => 'INNOVACIÓN TECNOLÓGICA SA',
                    'nif' => 'A98765432',
                    'localidad' => 'Madrid',
                    'provincia' => 'Madrid',
                    'estado' => 'ACTIVA',
                    'facturacion' => 5800000,
                    'resultado_neto' => 892000,
                    'empleados' => 47,
                ],
            ];
        }

        return view('company.search', compact('results'));
    }

    /**
     * Vista pública de una empresa (accesible sin login).
     */
    public function showPublic($slug)
    {
        $company = Cache::remember("company.public.{$slug}", now()->addDay(), function () use ($slug) {
            return Company::with(['favoritedBy' => function ($query) {
                if (auth()->check()) {
                    $query->where('user_id', auth()->id());
                }
            }])
                ->active()
                ->where('slug', $slug)
                ->firstOrFail();
        });

        $hasPremiumAccess = false;
        $isFavorite = false;

        if (auth()->check()) {
            $user = auth()->user();

            // Usuarios en prueba: limitar accesos
            if ($user->hasRole('usuario') && $user->isOnTrial()) {
                $access = $user->canAccessCompany();

                if (!$access['canAccess']) {
                    return redirect()->route('dashboard')
                        ->with('error', $access['message']);
                }

                $user->incrementCompanyViewCount();
            }

            $hasPremiumAccess = $user->isPremium() || $user->isAdmin();
            $isFavorite = $company->isFavoritedBy($user);
        }

        return view('company.public', [
            'company' => $company,
            'hasPremiumAccess' => $hasPremiumAccess,
            'isFavorite' => $isFavorite,
        ]);
    }

    /**
     * Vista premium de una empresa (solo premium/admin).
     */
    public function showPremium($slug)
    {
        $company = Cache::remember("company.premium.{$slug}", now()->addHours(6), function () use ($slug) {
            return Company::with(['favoritedBy' => function ($query) {
                $query->where('user_id', auth()->id());
            }])
                ->active()
                ->where('slug', $slug)
                ->firstOrFail();
        });

        if (!auth()->user()->isPremium() && !auth()->user()->isAdmin()) {
            return redirect()->route('pricing')
                ->with('message', 'Necesitas una suscripción premium para acceder a esta información.');
        }

        return view('company.premium', [
            'company' => $company,
            'isFavorite' => $company->isFavoritedBy(auth()->user()),
        ]);
    }

    /**
     * Búsqueda AJAX (para autocompletado o resultados dinámicos).
     */
    public function searchAjax(Request $request): JsonResponse
    {
        $request->validate([
            'query' => 'required|string|min:2|max:255',
        ]);

        $companies = Company::search($request->query('query'))
            ->active()
            ->limit(10)
            ->get(['id', 'name', 'cif', 'sector', 'city', 'province']);

        return response()->json($companies);
    }

    /**
     * Endpoint API para obtener información de empresa (futuro uso en frontend).
     */
    public function apiShow($id): JsonResponse
    {
        $company = Company::findOrFail($id);

        $data = [
            'id' => $company->id,
            'name' => $company->name,
            'cif' => $company->cif,
            'sector' => $company->sector,
            'website' => $company->website,
            'employees' => $company->employees,
            'revenue' => $company->formatted_revenue,
            'profit' => $company->formatted_profit,
            'is_premium' => $company->is_premium,
        ];

        return response()->json($data);
    }
}
