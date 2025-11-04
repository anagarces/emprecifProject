<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Página de inicio
Route::get('/', [PageController::class, 'home'])->name('home');

// Búsqueda
Route::get('/buscar', [PageController::class, 'search'])->name('search');

// Páginas informativas
Route::get('/precios', [PageController::class, 'pricing'])->name('pricing');
Route::get('/sobre-nosotros', [PageController::class, 'about'])->name('about');
Route::get('/equipo', [PageController::class, 'team'])->name('team');
Route::get('/trabaja-con-nosotros', [PageController::class, 'careers'])->name('careers');
Route::get('/caracteristicas', [PageController::class, 'features'])->name('features');

// Contacto
Route::get('/contacto', [PageController::class, 'contact'])->name('contact');
Route::post('/contacto', [PageController::class, 'contactSubmit'])->name('contact.submit');

// Blog
Route::get('/blog', [PageController::class, 'blog'])->name('blog.index');
Route::get('/blog/{slug}', [PageController::class, 'blogShow'])->name('blog.show');

// Páginas legales
Route::prefix('legal')->name('legal.')->group(function () {
    Route::get('/terminos', [PageController::class, 'terms'])->name('terms');
    Route::get('/privacidad', [PageController::class, 'privacy'])->name('privacy');
    Route::get('/cookies', [PageController::class, 'cookies'])->name('cookies');
    Route::get('/aviso-legal', [PageController::class, 'legalNotice'])->name('notice');
});

// Área de autenticación
require __DIR__.'/auth.php';

// Rutas de autenticación social
Route::get('/auth/{provider}/redirect', [\App\Http\Controllers\Auth\SocialiteController::class, 'redirectToProvider'])
    ->name('auth.socialite.redirect');

Route::get('/auth/{provider}/callback', [\App\Http\Controllers\Auth\SocialiteController::class, 'handleProviderCallback'])
    ->name('auth.socialite.callback');

// Rutas protegidas por autenticación
Route::middleware(['auth', 'verified'])->group(function () {
    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Perfil de usuario
    Route::prefix('perfil')->name('profile.')->group(function () {
        Route::get('/', [ProfileController::class, 'edit'])->name('edit');
        Route::patch('/', [ProfileController::class, 'update'])->name('update');
        Route::delete('/', [ProfileController::class, 'destroy'])->name('destroy');
    });

    // Suscripciones
    Route::prefix('suscripcion')->name('subscription.')->group(function () {
        Route::get('/planes', [SubscriptionController::class, 'plans'])->name('plans');
        Route::post('/', [SubscriptionController::class, 'subscribe'])->name('subscribe');
        Route::get('/exito', [SubscriptionController::class, 'success'])->name('success');
        Route::get('/cancelar', [SubscriptionController::class, 'cancel'])->name('cancel');
        Route::get('/portal', [SubscriptionController::class, 'portal'])->name('portal');
    });
});

// Ruta de bienvenida (redirige a la página de inicio)
Route::get('/welcome', function () {
    return redirect()->route('home');
});

// Manejo de rutas 404 personalizadas
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// Rutas de autenticación social
Route::get('login/{provider}', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'redirectToProvider'])
    ->name('login.provider');
    
Route::get('login/{provider}/callback', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'handleProviderCallback'])
    ->name('login.provider.callback');