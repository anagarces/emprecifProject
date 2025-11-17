<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PageController,
    ProfileController,
    SubscriptionController,
    CompanyController,
    DashboardController,
    BlogPostController,
    NewsletterController,
    SettingsController,
    ReportController
};
use App\Models\BlogPost;

/*
|--------------------------------------------------------------------------
| RUTAS PÚBLICAS
|--------------------------------------------------------------------------
| Accesibles para visitantes sin iniciar sesión
*/

Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/buscar', function () {
    return redirect()->route('company.search');
})->name('search');



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
*/
require __DIR__.'/auth.php';

// Login con redes sociales
Route::get('login/{provider}', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'redirectToProvider'])
    ->name('login.provider');
Route::get('login/{provider}/callback', [\App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'handleProviderCallback'])
    ->name('login.provider.callback');

/*
|--------------------------------------------------------------------------
| RUTAS PROTEGIDAS
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'verified', 'subscription'])->group(function () {

    // Panel principal
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Favoritos
    Route::get('/favoritos', fn() => view('placeholders.favorites'))->name('favorites.index');

    // Alertas
    Route::get('/alertas', fn() => view('placeholders.alerts'))->name('alerts.index');

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

    /*
    |--------------------------------------------------------------------------
    | RUTAS CON RESTRICCIÓN DE TRIAL (FREE + TRIAL + PREMIUM)
    |--------------------------------------------------------------------------
    */
    Route::middleware(['trial.access'])->group(function () {

        // Búsqueda y visualización de empresas
        Route::prefix('empresas')->name('company.')->group(function () {
            Route::get('/buscar', [CompanyController::class, 'search'])->name('search');
            Route::get('/buscar/resultados', [CompanyController::class, 'searchAjax'])->name('search.ajax');
            Route::get('/{company:slug}', [CompanyController::class, 'show'])->name('show'); // ← mostrar empresa
            Route::post('/{company:slug}/favorito', [FavoriteController::class, 'toggle'])->name('favorite'); //agregar / quitar de favoritos
        });

        // Informes
        Route::prefix('informes')->name('reports.')->group(function () {
            Route::get('/', [ReportController::class, 'index'])->name('index');
            Route::get('/empresa/{company:slug}', [ReportController::class, 'show'])->name('show');
            Route::get('/descargar/{company:slug}', [ReportController::class, 'download'])->name('download');
        });

    });

    // Configuración
    Route::get('/configuracion', [SettingsController::class, 'index'])->name('settings');

    // PREMIUM
   /* Route::middleware(['premium'])->group(function () {
        Route::get('/empresa/{company:slug}/premium', [CompanyController::class, 'showPremium'])
            ->name('company.premium');
    });*/

    // Panel admin blog
    Route::middleware(['role:admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::resource('blog', \App\Http\Controllers\Admin\BlogPostController::class)
            ->except(['show'])
            ->names('blog');
        Route::get('blog/{blogPost}', [\App\Http\Controllers\Admin\BlogPostController::class, 'show'])
            ->name('blog.show');
    });
});

/*
|--------------------------------------------------------------------------
| RUTAS VARIAS
|--------------------------------------------------------------------------
*/
Route::get('/welcome', fn () => redirect()->route('home'));
Route::fallback(fn () => response()->view('errors.404', [], 404));
