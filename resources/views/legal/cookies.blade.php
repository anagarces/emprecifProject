@extends('layouts.app')

@section('title', 'Política de Cookies | EmpreciF')
@section('description', 'Información sobre el uso de cookies en el sitio web de EmpreciF y cómo gestionarlas.')

@push('head')
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700;800;900&display=swap" rel="stylesheet">
@endpush

@section('content')
<section>
    <div class="section-header" style="text-align: center; padding: 4rem 2rem; background: linear-gradient(135deg, #f5f7ff 0%, #f0f4ff 100%);">
        <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 3rem; font-weight: 900; margin-bottom: 1.5rem;">
            Política de Cookies
        </h1>
        <p style="font-size: 1.125rem; color: var(--gray); max-width: 800px; margin: 0 auto; line-height: 1.7;">
            Utilizamos cookies para mejorar tu experiencia en nuestro sitio web. En esta página te explicamos qué son las cookies, cómo las usamos y cómo puedes gestionarlas.
        </p>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 4rem 2rem;">
        <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); margin-bottom: 3rem;">
            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.75rem; font-weight: 800; margin-bottom: 1.5rem; color: var(--dark);">1. ¿Qué son las cookies?</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 2rem;">
                Las cookies son pequeños archivos de texto que se almacenan en tu dispositivo cuando visitas nuestro sitio web. Son ampliamente utilizadas para hacer que los sitios web funcionen de manera más eficiente, así como para proporcionar información a los propietarios del sitio.
            </p>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">2. Tipos de cookies que utilizamos</h2>
            <div style="margin-bottom: 2rem;">
                <h3 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.25rem; font-weight: 700; margin: 1.5rem 0 1rem; color: var(--dark);">Cookies estrictamente necesarias</h3>
                <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray);">
                    Son esenciales para que puedas navegar por el sitio web y utilizar sus funciones. Sin estas cookies, los servicios que has solicitado no pueden ser proporcionados.
                </p>
                
                <h3 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.25rem; font-weight: 700; margin: 1.5rem 0 1rem; color: var(--dark);">Cookies de rendimiento</h3>
                <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray);">
                    Recopilan información sobre cómo los visitantes utilizan nuestro sitio web, como qué páginas visitan con más frecuencia. Estas cookies no recopilan información que identifique a un visitante.
                </p>
                
                <h3 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.25rem; font-weight: 700; margin: 1.5rem 0 1rem; color: var(--dark);">Cookies de funcionalidad</h3>
                <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray);">
                    Permiten que el sitio web recuerde elecciones que haces (como tu nombre de usuario, idioma o la región en la que te encuentras) y ofrecen características mejoradas y más personales.
                </p>
            </div>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">3. Cómo gestionar las cookies</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 1rem;">
                Puedes gestionar las cookies a través de la configuración de tu navegador. A continuación, te indicamos cómo hacerlo en los navegadores más populares:
            </p>
            <ul style="list-style: disc; padding-left: 2rem; margin-bottom: 2rem; color: var(--gray); font-size: 1.125rem; line-height: 1.8;">
                <li><a href="https://support.google.com/chrome/answer/95647" target="_blank" style="color: var(--primary); text-decoration: none;">Google Chrome</a></li>
                <li><a href="https://support.mozilla.org/es/kb/habilitar-y-deshabilitar-cookies-sitios-web-rastrear-preferencias" target="_blank" style="color: var(--primary); text-decoration: none;">Mozilla Firefox</a></li>
                <li><a href="https://support.apple.com/es-es/guide/safari/sfri11471/mac" target="_blank" style="color: var(--primary); text-decoration: none;">Safari</a></li>
                <li><a href="https://support.microsoft.com/es-es/microsoft-edge/eliminar-las-cookies-en-microsoft-edge-63947406-40ac-c3b8-57b9-2a946a29ae09" target="_blank" style="color: var(--primary); text-decoration: none;">Microsoft Edge</a></li>
            </ul>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">4. Cambios en nuestra política de cookies</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray);">
                Podemos actualizar nuestra Política de Cookies ocasionalmente. Te recomendamos que revises esta página periódicamente para cualquier cambio. Los cambios en esta política son efectivos cuando se publican en esta página.
            </p>
        </div>
    </div>
</section>
@endsection
