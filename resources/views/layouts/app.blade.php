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
        
        @stack('head')

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
        @vite(['resources/css/app.css', 'resources/css/styles.css', 'resources/js/app.js'])

    
        
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @stack('head-scripts')
    </head>
    <body class="font-sans antialiased text-gray-900 bg-white">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-XXXXXX" height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        
        <!-- News Ticker -->
        <x-layout.news-ticker />
        
        <x-layout.header />
        
        <!-- Page Content -->
        <main class="min-h-screen">
            @yield('content')
        </main>
        
        <x-layout.footer />
        
        <!-- Scripts -->
        @stack('scripts')
        
        <script>
            // Back to top button
            const backToTopButton = document.getElementById('backToTop');
            
            window.addEventListener('scroll', () => {
                if (window.pageYOffset > 300) {
                    backToTopButton.classList.add('visible');
                } else {
                    backToTopButton.classList.remove('visible');
                }
            });
            
            backToTopButton.addEventListener('click', () => {
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
            
            // Mobile menu toggle
            const mobileMenuButton = document.getElementById('mobileMenuButton');
            const mobileMenu = document.getElementById('mobileMenu');
            
            if (mobileMenuButton && mobileMenu) {
                mobileMenuButton.addEventListener('click', () => {
                    const isExpanded = mobileMenuButton.getAttribute('aria-expanded') === 'true';
                    mobileMenuButton.setAttribute('aria-expanded', !isExpanded);
                    mobileMenu.classList.toggle('hidden');
                });
            }
            
            // Dropdown menus
            document.addEventListener('DOMContentLoaded', function() {
                // Enable dropdowns
                document.querySelectorAll('.dropdown').forEach(dropdown => {
                    const button = dropdown.querySelector('button');
                    const menu = dropdown.querySelector('.dropdown-menu');
                    
                    button.addEventListener('click', () => {
                        const isExpanded = button.getAttribute('aria-expanded') === 'true';
                        button.setAttribute('aria-expanded', !isExpanded);
                        menu.classList.toggle('opacity-0');
                        menu.classList.toggle('invisible');
                        menu.classList.toggle('opacity-100');
                        menu.classList.toggle('visible');
                    });
                    
                    // Close when clicking outside
                    document.addEventListener('click', (e) => {
                        if (!dropdown.contains(e.target)) {
                            button.setAttribute('aria-expanded', 'false');
                            menu.classList.add('opacity-0', 'invisible');
                            menu.classList.remove('opacity-100', 'visible');
                        }
                    });
                });
            });
            
            // Flash messages auto-dismiss
            document.addEventListener('DOMContentLoaded', function() {
                const alerts = document.querySelectorAll('.alert');
                alerts.forEach(alert => {
                    setTimeout(() => {
                        alert.style.transition = 'opacity 0.5s ease-out';
                        alert.style.opacity = '0';
                        setTimeout(() => alert.remove(), 500);
                    }, 5000);
                });
            });
        </script>
    </body>
</html>
