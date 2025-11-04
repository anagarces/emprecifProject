<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <!-- SEO Meta Tags -->
        <title>@yield('title', 'EmpreciF | Consultar Datos de Empresas Españolas Gratis')</title>
        <meta name="description" content="@yield('description', '✅ Consulta GRATIS información de +3.2M empresas españolas: NIF, CIF, administradores, cuentas anuales, facturación. Datos oficiales del BORME actualizados diariamente.')">
        <meta name="keywords" content="@yield('keywords', 'consultar empresa por nif, buscar empresa por cif, datos empresas españa, información empresarial, borme empresas')">
        
        <!-- Open Graph / Facebook -->
        <meta property="og:type" content="website">
        <meta property="og:url" content="{{ url()->current() }}">
        <meta property="og:title" content="@yield('og:title', 'EmpreciF - Información Empresarial Oficial de España')">
        <meta property="og:description" content="@yield('og:description', 'Consulta datos de más de 3.2 millones de empresas españolas. Información oficial del BORME actualizada diariamente.')">
        <meta property="og:image" content="@yield('og:image', asset('images/og-image.jpg'))">
        
        <!-- Twitter -->
        <meta property="twitter:card" content="summary_large_image">
        <meta property="twitter:url" content="{{ url()->current() }}">
        <meta property="twitter:title" content="@yield('twitter:title', 'EmpreciF - Información Empresarial')">
        <meta property="twitter:description" content="@yield('twitter:description', 'Datos oficiales de empresas españolas. Consulta GRATIS.')">
        <meta property="twitter:image" content="@yield('twitter:image', asset('images/twitter-card.jpg'))">
        
        <!-- Favicon -->
        <link rel="icon" type="image/png" href="{{ asset('favicon.ico') }}">
        <link rel="apple-touch-icon" href="{{ asset('apple-touch-icon.png') }}">
        
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Space+Grotesk:wght@700&display=swap" rel="stylesheet">
        
        <!-- Font Awesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}">
        @stack('styles')
        
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @stack('head-scripts')
    </head>
    <body class="font-sans antialiased text-gray-900 bg-gray-50">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXX" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

        <div class="min-h-screen flex flex-col sm:justify-center items-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="w-full sm:max-w-md">
                <div class="text-center mb-8">
                    <a href="{{ route('home') }}" class="inline-block">
                        <img src="{{ asset('images/logo_emprecif_wordmark.png') }}" alt="EmpreciF" class="h-12 mx-auto">
                    </a>
                </div>

                <div class="bg-white py-8 px-6 shadow rounded-lg sm:px-10">
                    {{ $slot }}
                </div>

                <div class="mt-6 text-center text-sm text-gray-600">
                    <p>¿Necesitas ayuda? <a href="{{ route('contact') }}" class="font-medium text-blue-600 hover:text-blue-500">Contáctanos</a></p>
                </div>
            </div>
        </div>

        @stack('scripts')
    </body>
</html>
