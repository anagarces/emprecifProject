<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;

class FavoriteController extends Controller
{
    public function toggle(Company $company)
    {
        $user = auth()->user();

        if ($user->hasFavorited($company)) {
            $user->favorites()->detach($company);
            return back()->with('success', 'Empresa eliminada de favoritos.');
        }

        $user->favorites()->attach($company);
        return back()->with('success', 'Empresa agregada a favoritos.');
    }
}
