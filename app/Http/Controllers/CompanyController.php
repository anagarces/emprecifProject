<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Cache;

class CompanyController extends Controller
{
    /**
     * Display the public view of a company.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function showPublic($slug)
    {
        $company = Cache::remember("company.public.{$slug}", now()->addDay(), function () use ($slug) {
            return Company::with(['favoritedBy' => function($query) {
                if (auth()->check()) {
                    $query->where('user_id', auth()->id());
                }
            }])
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();
        });

        // Check if user has access to premium content
        $hasPremiumAccess = auth()->check() && (auth()->user()->isPremium() || auth()->user()->isAdmin());
        
        return view('company.public', [
            'company' => $company,
            'hasPremiumAccess' => $hasPremiumAccess,
            'isFavorite' => auth()->check() ? $company->isFavoritedBy(auth()->user()) : false,
        ]);
    }

    /**
     * Display the premium view of a company.
     *
     * @param  string  $slug
     * @return \Illuminate\View\View|\Illuminate\Http\Response
     */
    public function showPremium($slug)
    {
        $company = Cache::remember("company.premium.{$slug}", now()->addHours(6), function () use ($slug) {
            return Company::with(['favoritedBy' => function($query) {
                $query->where('user_id', auth()->id());
            }])
            ->active()
            ->where('slug', $slug)
            ->firstOrFail();
        });

        // Check if user has premium access
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
     * Search for companies based on the search query.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function search(Request $request): JsonResponse
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
     * Get company details for API.
     *
     * @param  string  $id
     * @return \Illuminate\Http\JsonResponse
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
