@extends('layouts.app')

@section('title', ($post->title ?? 'Artículo') . ' | Blog EmpreciF')

@section('description', $post->excerpt ? Str::limit(strip_tags($post->excerpt), 160) : 'Artículo del blog de EmpreciF')

@push('head')
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --primary: #3b82f6;
            --secondary: #8b5cf6;
            --accent: #ec4899;
            --dark: #1f2937;
            --light: #f9fafb;
        }
        body {
            font-family: 'Space Grotesk', sans-serif;
            line-height: 1.7;
            color: #374151;
        }
        .article-content h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            margin: 3rem 0 1.5rem;
            color: var(--dark);
        }
        .article-content p {
            margin-bottom: 1.5rem;
            font-size: 1.125rem;
            line-height: 1.9;
            color: var(--dark);
        }
        .article-content ul {
            list-style: none;
            padding: 0;
            margin-bottom: 2rem;
        }
        .article-content li {
            padding: 1rem;
            background: var(--light);
            border-radius: 12px;
            margin-bottom: 1rem;
            border-left: 4px solid var(--primary);
        }
        .article-content li:nth-child(2n) {
            border-left-color: var(--secondary);
        }
        .article-content li:nth-child(3n) {
            border-left-color: var(--accent);
        }
        .article-content strong {
            color: var(--dark);
        }
    </style>
@endpush

@push('meta')
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="{{ $post->published_at->toIso8601String() }}">
    <meta property="article:section" content="{{ $post->category }}">
@endpush

@section('content')
<article class="py-16 bg-white">
    <div class="max-w-4xl mx-auto px-4">
        <!-- Encabezado del artículo -->
        <header class="mb-12">
            <div style="display: flex; align-items: center; justify-content: center; gap: 1rem; margin-bottom: 1.5rem;">
                <span style="padding: 0.5rem 1rem; background: #f3f4f6; color: var(--primary); border-radius: 9999px; font-weight: 700; font-size: 0.875rem;">
                    {{ $post->category }}
                </span>
                <span style="color: #6b7280;">
                    {{ $post->published_at->format('d M Y') }}
                </span>
                <span style="color: #6b7280; display: flex; align-items: center;">
                    <svg xmlns="http://www.w3.org/2000/svg" style="width: 1.25rem; height: 1.25rem; margin-right: 0.25rem;" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    {{ number_format($post->views) }} vistas
                </span>
            </div>
            
            <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 3rem; font-weight: 800; text-align: center; margin-bottom: 2rem; color: var(--dark);">
                {{ $post->title }}
            </h1>

            <div style="height: 400px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin-bottom: 4rem;">
                <span style="font-size: 8rem;">
                    @switch($post->category)
                        @case('Guías') 📊 @break
                        @case('Due Diligence') 🔍 @break
                        @case('Análisis') 💰 @break
                        @case('Legal') ⚖️ @break
                        @default 📝
                    @endswitch
                </span>
            </div>
        </header>

        <!-- Contenido del artículo -->
        <div class="article-content" style="max-width: 65ch; margin: 0 auto;">
            {!! $post->content !!}
        </div>

        <!-- Compartir en redes sociales -->
        <div style="max-width: 65ch; margin: 4rem auto; padding-top: 2rem; border-top: 1px solid #e5e7eb;">
            <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 1.5rem; color: var(--dark);">¿Te ha resultado útil este artículo?</h3>
            <div style="display: flex; align-items: center; gap: 1rem;">
                <span style="color: #4b5563;">Compartir:</span>
                <div style="display: flex; gap: 0.75rem;">
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post)) }}&text={{ urlencode($post->title) }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       style="width: 3rem; height: 3rem; border-radius: 9999px; background: #f3f4f6; color: #4b5563; display: flex; align-items: center; justify-content: center; transition: background-color 0.2s;"
                       onmouseover="this.style.backgroundColor='#e5e7eb'"
                       onmouseout="this.style.backgroundColor='#f3f4f6'">
                        <span style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0;">Compartir en Twitter</span>
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post)) }}&title={{ urlencode($post->title) }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       style="width: 3rem; height: 3rem; border-radius: 9999px; background: #f3f4f6; color: #4b5563; display: flex; align-items: center; justify-content: center; transition: background-color 0.2s;"
                       onmouseover="this.style.backgroundColor='#e5e7eb'"
                       onmouseout="this.style.backgroundColor='#f3f4f6'">
                        <span style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0;">Compartir en LinkedIn</span>
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post)) }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       style="width: 3rem; height: 3rem; border-radius: 9999px; background: #f3f4f6; color: #4b5563; display: flex; align-items: center; justify-content: center; transition: background-color 0.2s;"
                       onmouseover="this.style.backgroundColor='#e5e7eb'"
                       onmouseout="this.style.backgroundColor='#f3f4f6'">
                        <span style="position: absolute; width: 1px; height: 1px; padding: 0; margin: -1px; overflow: hidden; clip: rect(0, 0, 0, 0); white-space: nowrap; border: 0;">Compartir en Facebook</span>
                        <svg style="width: 1.25rem; height: 1.25rem;" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</article>

<!-- Artículos relacionados -->
@if(isset($relatedPosts) && $relatedPosts->count() > 0)
    <section style="padding: 4rem 0; background-color: #f9fafb;">
        <div style="max-width: 80rem; margin: 0 auto; padding: 0 1rem;">
            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.25rem; font-weight: 800; text-align: center; margin-bottom: 3rem; color: var(--dark);">
                Artículos relacionados
            </h2>
            <div style="display: grid; gap: 2rem; grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));">
                @foreach($relatedPosts as $relatedPost)
                    <article style="background: white; border-radius: 1rem; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); transition: all 0.3s ease;"
                            onmouseover="this.style.transform='translateY(-0.25rem)'; this.style.boxShadow='0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04)';"
                            onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06)';">
                        <div style="height: 12rem; background: linear-gradient(135deg, var(--primary), var(--secondary)); display: flex; align-items: center; justify-content: center;">
                            <span style="font-size: 4rem;">
                                @switch($relatedPost->category)
                                    @case('Guías') 📊 @break
                                    @case('Due Diligence') 🔍 @break
                                    @case('Análisis') 💰 @break
                                    @case('Legal') ⚖️ @break
                                    @default 📝
                                @endswitch
                            </span>
                        </div>
                        <div style="padding: 1.5rem;">
                            <div style="display: flex; align-items: center; gap: 0.75rem; margin-bottom: 0.75rem;">
                                <span style="padding: 0.25rem 0.75rem; background: #f3f4f6; color: var(--primary); border-radius: 9999px; font-size: 0.75rem; font-weight: 700;">
                                    {{ $relatedPost->category }}
                                </span>
                                <span style="font-size: 0.75rem; color: #6b7280;">
                                    {{ $relatedPost->published_at->format('d M Y') }}
                                </span>
                            </div>
                            <h3 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem; color: var(--dark);">
                                <a href="{{ route('blog.show', $relatedPost) }}" style="color: inherit; text-decoration: none; transition: color 0.2s;"
                                   onmouseover="this.style.color='var(--primary)';"
                                   onmouseout="this.style.color='var(--dark)';">
                                    {{ Str::limit($relatedPost->title, 60) }}
                                </a>
                            </h3>
                            @if($relatedPost->excerpt)
                                <p style="color: #6b7280; font-size: 0.875rem; margin-bottom: 1rem; line-height: 1.5;">
                                    {{ Str::limit($relatedPost->excerpt, 120) }}
                                </p>
                            @endif
                            <a href="{{ route('blog.show', $relatedPost) }}" 
                               style="display: inline-flex; align-items: center; color: var(--primary); font-weight: 500; font-size: 0.875rem; text-decoration: none; transition: color 0.2s;"
                               onmouseover="this.style.color='#2563eb';"
                               onmouseout="this.style.color='var(--primary)';">
                                Leer artículo →
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- CTA Section -->
<section style="padding: 4rem 0; background: white; border-top: 1px solid #e5e7eb;">
    <div style="max-width: 64rem; margin: 0 auto; padding: 0 1rem; text-align: center;">
        <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.25rem; font-weight: 800; margin-bottom: 1.5rem; color: var(--dark);">
            ¿Quieres acceder a más información empresarial?
        </h2>
        <p style="font-size: 1.25rem; color: #4b5563; margin-bottom: 2rem; max-width: 42rem; margin-left: auto; margin-right: auto; line-height: 1.6;">
            Obtén acceso ilimitado a datos de más de 3.2 millones de empresas españolas con EmpreciF.
        </p>
        <div style="display: flex; flex-direction: column; gap: 1rem; align-items: center; justify-content: center;">
            <a href="{{ route('register') }}" 
               style="display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem 2rem; background: linear-gradient(135deg, var(--primary), var(--secondary)); color: white; font-weight: 600; border-radius: 0.5rem; text-decoration: none; transition: all 0.3s ease;"
               onmouseover="this.style.transform='translateY(-2px)'; this.style.boxShadow='0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05)';"
               onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='none';">
                Prueba Gratis 14 Días
            </a>
            <a href="{{ route('pricing') }}" 
               style="display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem 2rem; border: 2px solid var(--primary); color: var(--primary); font-weight: 600; border-radius: 0.5rem; text-decoration: none; transition: all 0.3s ease;"
               onmouseover="this.style.backgroundColor='rgba(59, 130, 246, 0.05)';"
               onmouseout="this.style.backgroundColor='transparent';">
                Ver Planes y Precios
            </a>
        </div>
    </div>
</section>

<!-- Newsletter -->
<section style="padding: 4rem 0; background: white;">
    <div style="max-width: 80rem; margin: 0 auto; padding: 0 1rem;">
        <div style="max-width: 48rem; margin: 0 auto; text-align: center; background: #f9fafb; padding: 3rem 2rem; border-radius: 1rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 2rem; font-weight: 800; margin-bottom: 1rem; color: var(--dark);">
                ¿Te gustó este artículo?
            </h2>
            <p style="color: #4b5563; margin-bottom: 2rem; line-height: 1.6;">
                Suscríbete a nuestro boletín para recibir más contenido como este directamente en tu bandeja de entrada.
            </p>
            <form style="max-width: 28rem; margin: 0 auto; display: flex; flex-direction: column; gap: 1rem;">
                @csrf
                <input type="email" 
                       name="email" 
                       placeholder="Tu correo electrónico" 
                       required
                       style="flex: 1; padding: 0.875rem 1.25rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 1rem; transition: all 0.2s;"
                       onfocus="this.style.borderColor='var(--primary)'; this.style.outline='none'; this.style.boxShadow='0 0 0 3px rgba(59, 130, 246, 0.2)';"
                       onblur="this.style.borderColor='#d1d5db'; this.style.boxShadow='none';">
                <button type="submit" 
                        style="padding: 0.875rem 1.25rem; background: var(--primary); color: white; font-weight: 600; border: none; border-radius: 0.5rem; cursor: pointer; font-size: 1rem; transition: all 0.3s ease;"
                        onmouseover="this.style.backgroundColor='#2563eb'; this.style.transform='translateY(-1px)';"
                        onmouseout="this.style.backgroundColor='var(--primary)'; this.style.transform='translateY(0)';">
                    Suscribirme
                </button>
            </form>
            <p style="color: #6b7280; font-size: 0.875rem; margin-top: 1.5rem;">
                Respetamos tu privacidad. Nunca compartiremos tu información.
            </p>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
    // Resaltar bloques de código con Prism.js (opcional)
    document.addEventListener('DOMContentLoaded', function() {
        // Inicializar Prism.js si está cargado
        if (typeof Prism !== 'undefined') {
            Prism.highlightAll();
        }
        
        // Añadir clases a las tablas para un mejor estilo
        document.querySelectorAll('article table').forEach(table => {
            table.classList.add('min-w-full', 'divide-y', 'divide-gray-200', 'my-6');
            table.querySelectorAll('th, td').forEach(cell => {
                cell.classList.add('px-4', 'py-2', 'text-left', 'border');
            });
            table.querySelectorAll('th').forEach(header => {
                header.classList.add('bg-gray-50', 'font-semibold');
            });
        });
    });
</script>
@endpush
@endsection
