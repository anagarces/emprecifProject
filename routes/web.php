<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PageController,
    ProfileController,
    SubscriptionController,
    CompanyController,
    DashboardController,
    BlogPostController,
    NewsletterController
};
use App\Models\BlogPost;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
| Accesibles para visitantes sin iniciar sesión
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/buscar', [PageController::class, 'search'])->name('search');

// Información de marketing
Route::get('/precios', [PageController::class, 'pricing'])->name('pricing');
Route::get('/caracteristicas', [PageController::class, 'features'])->name('features');
Route::get('/sobre-nosotros', [PageController::class, 'about'])->name('about');
Route::get('/equipo', [PageController::class, 'about']); // Redirige a "sobre-nosotros"

// Contacto
Route::get('/contacto', [PageController::class, 'contact'])->name('contact');
Route::post('/contacto', [PageController::class, 'contactSubmit'])->name('contact.submit');

// Blog público
Route::get('/blog', [BlogPostController::class, 'index'])->name('blog.index');
Route::get('/blog/{post}', fn (BlogPost $post) => app(BlogPostController::class)->show($post))
    ->name('blog.show');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Página de empresa pública
Route::get('/empresa/{company:slug}', [CompanyController::class, 'showPublic'])->name('company.show');

// Páginas legales
Route::prefix('legal')->name('legal.')->group(function () {
    Route::get('/aviso-legal', [PageController::class, 'legalNotice'])->name('notice');
    Route::get('/politica-privacidad', [PageController::class, 'privacy'])->name('privacy');
    Route::get('/politica-cookies', [PageController::class, 'cookies'])->name('cookies');
    Route::get('/terminos-condiciones', [PageController::class, 'terms'])->name('terms');
});

/*
|--------------------------------------------------------------------------
| AUTENTICACIÓN
|--------------------------------------------------------------------------
| Controlado por Breeze (login, registro, reset password, etc.)
*/
require __DIR__.'/auth.php';

// Login con redes sociales (Google, etc.)
Route::get('login/{provider}', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'redirectToProvider'])
    ->name('login.provider');
Route::get('login/{provider}/callback', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'handleProviderCallback'])
    ->name('login.provider.callback');

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS (usuario autenticado y verificado)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified'])->group(function () {
    // Panel principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Perfil
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Suscripciones
    Route::prefix('suscripcion')->name('subscription.')->group(function () {
        Route::get('/planes', [SubscriptionController::class, 'plans'])->name('plans');
        Route::post('/', [SubscriptionController::class, 'subscribe'])->name('subscribe');
        Route::get('/exito', [SubscriptionController::class, 'success'])->name('success');
        Route::get('/cancelar', [SubscriptionController::class, 'cancel'])->name('cancel');
        Route::get('/portal', [SubscriptionController::class, 'portal'])->name('portal');
    });

    // Panel de administración del blog
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::resource('blog', \App\Http\Controllers\Admin\BlogPostController::class)
            ->except(['show'])
            ->names('blog');
        Route::get('blog/{blogPost}', [\App\Http\Controllers\Admin\BlogPostController::class, 'show'])
            ->name('blog.show');
    });
});

/*
|--------------------------------------------------------------------------
| RUTAS PREMIUM / SUSCRIPCIÓN ACTIVA
|--------------------------------------------------------------------------
| Requieren que el usuario tenga plan activo o esté en prueba
*/
Route::middleware(['auth', 'verified', 'subscribed'])->group(function () {
    Route::get('/empresa/{company:slug}/premium', [CompanyController::class, 'showPremium'])
        ->name('company.premium');
});

/*
|--------------------------------------------------------------------------
| RUTAS VARIAS
|--------------------------------------------------------------------------
*/
Route::get('/welcome', fn () => redirect()->route('home'));
Route::fallback(fn () => response()->view('errors.404', [], 404));
