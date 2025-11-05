<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display search results.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        $query = $request->input('q');
        $results = [];

        if (!empty($query)) {
            // In a real application, you would query your database here
            // This is a simplified example with mock data
            $results = $this->searchCompanies($query);
        }

        return view('search', [
            'results' => $results,
        ]);
    }

    /**
     * Mock search function - replace with actual database query
     *
     * @param string $query
     * @return array
     */
    protected function searchCompanies($query)
    {
        // This is mock data - replace with actual database query
        // Example: return DB::table('empresas')
        //     ->where('nombre', 'like', "%{$query}%")
        //     ->orWhere('nif', 'like', "%{$query}%")
        //     ->get()
        //     ->toArray();

        $mockResults = [
            [
                'id' => 1,
                'nombre' => 'TECNOLOGÍA AVANZADA SL',
                'nif' => 'A12345678',
                'localidad' => 'Barcelona',
                'provincia' => 'Barcelona',
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
                'facturacion' => 5800000,
                'resultado_neto' => 892000,
                'empleados' => 47,
            ],
        ];

        // Filter mock results based on query (case-insensitive)
        $query = strtolower($query);
        return array_filter($mockResults, function($company) use ($query) {
            return strpos(strtolower($company['nombre']), $query) !== false || 
                   strpos(strtolower($company['nif']), $query) !== false;
        });
    }
}
