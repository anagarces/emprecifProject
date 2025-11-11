<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

class ReportController extends Controller
{
    /**
     * Download a company report
     *
     * @param  string  $slug
     * @return \Symfony\Component\HttpFoundation\StreamedResponse|\Illuminate\Http\RedirectResponse
     */
    public function download($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        // Check if user is authenticated
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para descargar informes.');
        }

        // Check if user can download reports
        if (!$user->canDownloadReports()) {
            $message = $user->isOnTrial() 
                ? 'La descarga de informes no está disponible durante el periodo de prueba.'
                : 'Tu plan actual no permite la descarga de informes.';
                
            return redirect()->route('dashboard')
                ->with('error', $message);
        }

        // In a real application, you would generate or retrieve the report file here
        // For simulation, we'll create a simple text file
        $filename = "informe-{$company->slug}.txt";
        $content = "Informe de empresa: {$company->name}\n";
        $content .= "CIF: {$company->cif}\n";
        $content .= "Fecha de generación: " . now()->format('d/m/Y H:i:s') . "\n\n";
        $content .= "Este es un informe simulado. En la versión real, aquí estarían los datos completos de la empresa.";

        // Return the file as a download response
        return response()->streamDownload(function () use ($content) {
            echo $content;
        }, $filename, [
            'Content-Type' => 'text/plain',
        ]);
    }

    /**
     * Display the report generation page
     *
     * @param  string  $slug
     * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show($slug)
    {
        $company = Company::where('slug', $slug)->firstOrFail();
        $user = auth()->user();

        // Check if user is authenticated
        if (!$user) {
            return redirect()->route('login')
                ->with('error', 'Debes iniciar sesión para ver los informes.');
        }

        // Check if user can download reports
        if (!$user->canDownloadReports()) {
            $message = $user->isOnTrial() 
                ? 'La visualización de informes completos no está disponible durante el periodo de prueba.'
                : 'Tu plan actual no permite acceder a informes completos.';
                
            return redirect()->route('dashboard')
                ->with('error', $message);
        }

        return view('reports.show', [
            'company' => $company,
        ]);
    }
}
