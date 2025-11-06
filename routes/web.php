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
Route::get('/caracteristicas', [PageController::class, 'features'])->name('features');
Route::get('/sobre-nosotros', [PageController::class, 'about'])->name('about');
Route::get('/equipo', [PageController::class, 'about']); // Redirige a sobre-nosotros

// Contacto
Route::get('/contacto', [PageController::class, 'contact'])->name('contact');
Route::post('/contacto', [PageController::class, 'contactSubmit'])->name('contact.submit');

// Blog - Rutas públicas
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\NewsletterController;
use App\Models\BlogPost;

Route::get('/blog', [BlogPostController::class, 'index'])->name('blog.index');

// Ruta para mostrar un post del blog
Route::get('/blog/{post}', function (BlogPost $post) {
    return app(BlogPostController::class)->show($post);
})->name('blog.show');

// Newsletter Subscription
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])
    ->name('newsletter.subscribe');

// Panel de administración - Blog
Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('blog', \App\Http\Controllers\Admin\BlogPostController::class)
        ->except(['show'])
        ->names('blog');
    
    // Ruta adicional para mostrar un artículo en el panel de administración
    Route::get('blog/{blogPost}', [\App\Http\Controllers\Admin\BlogPostController::class, 'show'])
        ->name('blog.show');
});



// Páginas legales
Route::prefix('legal')->name('legal.')->group(function () {
    Route::get('/aviso-legal', [PageController::class, 'legalNotice'])->name('notice');
    Route::get('/politica-privacidad', [PageController::class, 'privacy'])->name('privacy');
    Route::get('/politica-cookies', [PageController::class, 'cookies'])->name('cookies');
    Route::get('/terminos-condiciones', [PageController::class, 'terms'])->name('terms');
});

// Área de autenticación
require __DIR__.'/auth.php';

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