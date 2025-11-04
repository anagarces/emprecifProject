const mix = require('laravel-mix');

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel applications. By default, we are compiling the CSS
 | file for the application as well as bundling up all the JS files.
 |
 */

// Compilar CSS
mix.styles([
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/@fortawesome/fontawesome-free/css/all.min.css',
    'public/css/custom.css'
], 'public/css/app.css');

// Compilar JavaScript
mix.js('resources/js/app.js', 'public/js')
   .postCss('resources/css/app.css', 'public/css', [
       require('postcss-import'),
       require('tailwindcss'),
   ]);

// Copiar imágenes
mix.copyDirectory('maquetacion_emprecif/images', 'public/images');

// Configuración adicional
if (mix.inProduction()) {
    mix.version();
    mix.sourceMaps();
} else {
    mix.sourceMaps();
    mix.webpackConfig({ devtool: 'inline-source-map' });
}

// Deshabilitar notificaciones de éxito
mix.disableSuccessNotifications();
