<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\BlogPostController;
use App\Models\BlogPost;

class PageController extends Controller
{
    /**
     * Muestra la página de inicio
     */
    public function home()
    {
        return view('home');
    }

    /**
     * Muestra la página de búsqueda
     */
    public function search(Request $request)
    {
        $searchController = new \App\Http\Controllers\SearchController();
        return $searchController->index($request);
    }

    /**
     * Muestra la página de precios
     */
    public function pricing()
    {
        return view('pricing');
    }

    /**
     * Muestra la página de contacto
     */
    public function contact()
    {
        return view('contact');
    }

    /**
     * Procesa el formulario de contacto
     */
    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'required|string|max:255',
            'message' => 'required|string',
        ]);

        // Aquí iría la lógica para enviar el correo
        // Por ejemplo:
        // Mail::to('contacto@emprecif.com')->send(new ContactFormMail($validated));
        
        return redirect()->route('contact')
            ->with('status', '¡Gracias por contactarnos! Te responderemos lo antes posible.');
    }

    /**
     * Muestra la página de sobre nosotros
     */
    public function about()
    {
        return view('about');
    }

    /**
     * Muestra la página de términos y condiciones
     */
    public function terms()
    {
        return view('legal.terms');
    }

    /**
     * Muestra la página de política de privacidad
     */
    public function privacy()
    {
        return view('legal.privacy');
    }

    /**
     * Muestra la página de política de cookies
     */
    public function cookies()
    {
        return view('legal.cookies');
    }

    /**
     * Muestra la página de aviso legal
     */
    public function legalNotice()
    {
        return view('legal.notice');
    }

    /**
     * Muestra la página de equipo
     */
    public function team()
    {
        return view('pages.team');
    }

    /**
     * Muestra la página de carreras
     */
    public function careers()
    {
        return view('pages.careers');
    }

    /**
     * Muestra la página de características
     */
    public function features()
    {
        return view('pages.features');
    }
}
