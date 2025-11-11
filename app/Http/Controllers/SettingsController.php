<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SettingsController extends Controller
{
    /**
     * Muestra la página principal de configuración.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        return view('settings.index');
    }
}
