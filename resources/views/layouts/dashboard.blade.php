<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title', 'Mi Cuenta')</title>
  
  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Space+Grotesk:wght@700;800;900&display=swap" rel="stylesheet">

  {{-- Tailwind via Vite --}}
  @vite(['resources/css/app.css','resources/js/app.js'])

  {{-- Estilos inyectados por las vistas del panel --}}
  @stack('styles')
</head>
<body class="dash-app">
  @yield('content')

  {{-- Scripts inyectados por las vistas del panel --}}
  @stack('scripts')
</body>
</html>
