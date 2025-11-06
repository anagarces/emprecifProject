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
            --gray: #6b7280;
        }
        body {
            font-family: 'Space Grotesk', sans-serif;
            line-height: 1.7;
            color: var(--dark);
            background-color: #fff;
        }
        
        /* Article Content Styles */
        .article-content {
            font-size: 1.125rem;
            line-height: 1.9;
            color: var(--dark);
        }
        
        .article-content h2 {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.5rem;
            font-weight: 800;
            margin: 3rem 0 1.5rem;
            color: var(--dark);
        }
        
        .article-content h3 {
            font-size: 1.5rem;
            font-weight: 700;
            margin: 2rem 0 1rem;
        }
        
        .article-content p {
            margin-bottom: 1.5rem;
        }
        
        .article-content ul, 
        .article-content ol {
            margin-left: 2rem;
            margin-bottom: 1.5rem;
        }
        
        .article-content li {
            margin-bottom: 0.5rem;
        }
        .article-content {
            max-width: 65ch;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .article-content h2 {
            font-size: 2rem;
            font-weight: 700;
            margin: 2.5rem 0 1.5rem;
            color: var(--dark);
        }
        .article-content p {
            margin-bottom: 1.5rem;
            font-size: 1.125rem;
            line-height: 1.8;
            color: var(--dark);
        }
        .article-content ul,
        .article-content ol {
            margin-bottom: 2rem;
            padding-left: 1.5rem;
        }
        .article-content li {
            margin-bottom: 0.75rem;
            padding-left: 0.5rem;
        }
        .article-content img {
            max-width: 100%;
            height: auto;
            border-radius: 0.5rem;
            margin: 2rem 0;
        }
        .post-header {
            text-align: center;
            margin-bottom: 3rem;
            padding: 0 1rem;
        }
        .post-category {
            display: inline-block;
            padding: 0.5rem 1rem;
            background: #f3f4f6;
            color: var(--primary);
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            margin-bottom: 1rem;
        }
        .post-title {
            font-size: 2.5rem;
            font-weight: 800;
            margin-bottom: 1.5rem;
            line-height: 1.2;
        }
        .post-meta {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 1rem;
            color: var(--gray);
            margin-bottom: 2rem;
            font-size: 0.875rem;
        }
        .post-image {
            width: 100%;
            height: 400px;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            border-radius: 1rem;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 2rem 0;
            overflow: hidden;
        }
        .post-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .post-image span {
            font-size: 5rem;
        }
        .share-section {
            max-width: 65ch;
            margin: 4rem auto;
            padding-top: 2rem;
            border-top: 1px solid #e5e7eb;
        }
        .related-articles {
            padding: 4rem 0;
            background-color: #f9fafb;
        }
        .related-articles-container {
            max-width: 80rem;
            margin: 0 auto;
            padding: 0 1rem;
        }
        .section-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 2.25rem;
            font-weight: 800;
            text-align: center;
            margin-bottom: 3rem;
            color: var(--dark);
        }
        .articles-grid {
            display: grid;
            gap: 2rem;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        }
        .article-card {
            background: white;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            transition: all 0.3s ease;
        }
        .article-card:hover {
            transform: translateY(-0.25rem);
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
        }
        .article-card-image {
            height: 12rem;
            background: linear-gradient(135deg, var(--primary), var(--secondary));
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .article-card-content {
            padding: 1.5rem;
        }
        .article-card-meta {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 0.75rem;
        }
        .article-card-category {
            padding: 0.25rem 0.75rem;
            background: #f3f4f6;
            color: var(--primary);
            border-radius: 9999px;
            font-size: 0.75rem;
            font-weight: 700;
        }
        .article-card-date {
            font-size: 0.75rem;
            color: var(--gray);
        }
        .article-card-title {
            font-family: 'Space Grotesk', sans-serif;
            font-size: 1.25rem;
            font-weight: 700;
            margin-bottom: 0.75rem;
            color: var(--dark);
        }
        .article-card-excerpt {
            color: var(--gray);
            font-size: 0.875rem;
            margin-bottom: 1rem;
            line-height: 1.5;
        }
        .read-more-link {
            display: inline-flex;
            align-items: center;
            color: var(--primary);
            font-weight: 500;
            font-size: 0.875rem;
            text-decoration: none;
            transition: color 0.2s;
        }
        .read-more-link:hover {
            color: #2563eb;
        }
        .read-more-link svg {
            width: 1rem;
            height: 1rem;
            margin-left: 0.5rem;
        }
    </style>
@endpush

@push('meta')
    <meta property="og:type" content="article">
    <meta property="article:published_time" content="{{ $post->published_at->toIso8601String() }}">
    <meta property="article:section" content="{{ $post->category }}">
@endpush

@section('content')
<article style="max-width: 900px; margin: 0 auto; padding: 6rem 2rem 4rem;">
    <div style="margin-bottom: 3rem;">
        <a href="{{ route('blog.index') }}" style="color: var(--primary); text-decoration: none; font-weight: 700; display: inline-flex; align-items: center; gap: 0.5rem;">
            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="19" y1="12" x2="5" y2="12"></line>
                <polyline points="12 19 5 12 12 5"></polyline>
            </svg>
            Volver al Blog
        </a>
    </div>

    <div style="display: flex; gap: 1rem; margin-bottom: 2rem;">
        @if($post->category)
            <span style="padding: 0.5rem 1rem; background: var(--light); color: var(--primary); border-radius: 50px; font-size: 0.875rem; font-weight: 700;">
                {{ $post->category }}
            </span>
        @endif
        <span style="color: var(--gray); font-size: 0.875rem; display: flex; align-items: center;">
            {{ $post->published_at->translatedFormat('d F Y') }} • {{ $post->reading_time ?? '5' }} min de lectura
        </span>
    </div>

    <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 3rem; font-weight: 900; margin-bottom: 2rem; line-height: 1.2;">
        {{ $post->title }}
    </h1>

    @if($post->excerpt)
        <div style="font-size: 1.375rem; color: var(--gray); line-height: 1.8; margin-bottom: 3rem;">
            {!! $post->formatted_excerpt !!}
        </div>
    @endif

    @if($post->image)
        <div style="height: 400px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 20px; overflow: hidden; margin-bottom: 4rem;">
            <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
        </div>
    @else
        @php
            $emojis = [
                'Guías' => '📊',
                'Due Diligence' => '🔍',
                'Análisis' => '💰',
                'Legal' => '⚖️',
                'default' => '📝'
            ];
            $emoji = $emojis[$post->category] ?? $emojis['default'];
        @endphp
        <div style="height: 200px; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 20px; display: flex; align-items: center; justify-content: center; margin-bottom: 4rem;">
            <span style="font-size: 5rem;">{{ $emoji }}</span>
        </div>
    @endif

    <!-- Contenido del artículo -->
    <div class="article-content">
        @if($post->content)
            {!! $post->formatted_content !!}
        @else
            <p style="color: #6b7280; font-style: italic;">No hay contenido disponible para mostrar.</p>
        @endif

        @if(!$post->content || strpos($post->content, 'conclusión') === false)
                 <!-- CTA Newsletter -->
        <div style="margin-top: 6rem; background: linear-gradient(135deg, var(--primary), var(--secondary)); border-radius: 20px; padding: 4rem 2rem; text-align: center;">
            <div style="max-width: 600px; margin: 0 auto;">
                <h2 style="font-size: 2rem; font-weight: 800; color: white; margin-bottom: 1.5rem;">Suscríbete a nuestro boletín</h2>
                <p style="font-size: 1.125rem; color: rgba(255, 255, 255, 0.9); margin-bottom: 2rem; line-height: 1.7;">
                    Recibe las últimas noticias, artículos y actualizaciones directamente en tu bandeja de entrada.
                </p>
                <form action="{{ route('newsletter.subscribe') }}" method="POST" style="display: flex; gap: 0.5rem; max-width: 500px; margin: 0 auto;">
                    @csrf
                    <input type="email" name="email" placeholder="Tu correo electrónico" required 
                           style="flex: 1; padding: 0.875rem 1.25rem; border: none; border-radius: 8px; font-size: 1rem; box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);">
                    <button type="submit" style="background: white; color: var(--primary); border: none; border-radius: 8px; padding: 0 2rem; font-weight: 600; font-size: 1rem; cursor: pointer; transition: all 0.2s;"
                            onmouseover="this.style.opacity='0.9';"
                            onmouseout="this.style.opacity='1';">
                        Suscribirme
                    </button>
                </form>
                <p style="color: rgba(255, 255, 255, 0.7); font-size: 0.875rem; margin-top: 1.5rem;">
                    No compartiremos tu correo electrónico. Puedes darte de baja en cualquier momento.
                </p>
            </div>
                Prueba Gratis 14 Días
            </a>
            <a href="{{ route('pricing') }}" 
               style="display: inline-flex; align-items: center; justify-content: center; padding: 0.75rem 2rem; border: 2px solid var(--primary); color: var(--primary); font-weight: 600; border-radius: 0.5rem; text-decoration: none; transition: all 0.3s ease;"
               onmouseover="this.style.backgroundColor='rgba(4, 42, 104, 0.77)';"
               onmouseout="this.style.backgroundColor='transparent';">
                Ver Planes y Precios
            </a>
        </div>
        @endif
    </div>

        <!-- Compartir en redes sociales -->
        <div style="margin-top: 4rem; padding-top: 3rem; border-top: 1px solid #e5e7eb;">
            <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 1.5rem;">¿Te ha gustado este artículo?</h3>
            <p style="color: var(--gray); margin-bottom: 1.5rem;">Comparte este artículo con tu red profesional</p>
            <div style="display: flex; gap: 1rem;">
                <!-- Twitter -->
                <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post)) }}&text={{ urlencode($post->title) }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   style="width: 3rem; height: 3rem; border-radius: 50%; background: #f3f4f6; display: flex; align-items: center; justify-content: center; transition: all 0.2s;"
                   onmouseover="this.style.background='#e5e7eb'; this.style.transform='translateY(-2px)';"
                   onmouseout="this.style.background='#f3f4f6'; this.style.transform='translateY(0)';"
                   aria-label="Compartir en Twitter">
                    <svg width="20" height="20" fill="#1DA1F2" viewBox="0 0 24 24">
                        <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                    </svg>
                </a>
                
                <!-- LinkedIn -->
                <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post)) }}&title={{ urlencode($post->title) }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   style="width: 3rem; height: 3rem; border-radius: 50%; background: #f3f4f6; display: flex; align-items: center; justify-content: center; transition: all 0.2s;"
                   onmouseover="this.style.background='#e5e7eb'; this.style.transform='translateY(-2px)';"
                   onmouseout="this.style.background='#f3f4f6'; this.style.transform='translateY(0)';"
                   aria-label="Compartir en LinkedIn">
                    <svg width="20" height="20" fill="#0A66C2" viewBox="0 0 24 24">
                        <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                    </svg>
                </a>
                
                <!-- Facebook -->
                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post)) }}" 
                   target="_blank" 
                   rel="noopener noreferrer"
                   style="width: 3rem; height: 3rem; border-radius: 50%; background: #f3f4f6; display: flex; align-items: center; justify-content: center; transition: all 0.2s;"
                   onmouseover="this.style.background='#e5e7eb'; this.style.transform='translateY(-2px)';"
                   onmouseout="this.style.background='#f3f4f6'; this.style.transform='translateY(0)';"
                   aria-label="Compartir en Facebook">
                    <svg width="20" height="20" fill="#1877F2" viewBox="0 0 24 24">
                        <path fill-rule="evenodd" d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z" clip-rule="evenodd" />
                    </svg>
                </a>
            </div>
        </div>
    </div>
</article>

        <!-- Artículos relacionados -->
        @if(isset($relatedPosts) && $relatedPosts->count() > 0)
            <div style="margin-top: 6rem; padding-top: 4rem; border-top: 1px solid #e5e7eb;">
                <h2 style="font-size: 1.875rem; font-weight: 800; text-align: center; margin-bottom: 3rem;">Artículos relacionados</h2>
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(300px, 1fr)); gap: 2rem; margin-top: 2rem;">
                    @foreach($relatedPosts as $relatedPost)
                        <article style="border-radius: 12px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06); transition: transform 0.2s;"
                                onmouseover="this.style.transform='translateY(-4px)';"
                                onmouseout="this.style.transform='translateY(0)';">
                            @if($relatedPost->image)
                                <div style="height: 180px; overflow: hidden;">
                                    <img src="{{ asset('storage/' . $relatedPost->image) }}" alt="{{ $relatedPost->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                                </div>
                            @else
                                @php
                                    $emojis = [
                                        'Guías' => '📊',
                                        'Due Diligence' => '🔍',
                                        'Análisis' => '💰',
                                        'Legal' => '⚖️',
                                        'default' => '📝'
                                    ];
                                    $emoji = $emojis[$relatedPost->category] ?? $emojis['default'];
                                @endphp
                                <div style="height: 180px; display: flex; align-items: center; justify-content: center; background: linear-gradient(135deg, var(--primary), var(--secondary));">
                                    <span style="font-size: 3.5rem;">{{ $emoji }}</span>
                                </div>
                            @endif
                            <div style="padding: 1.5rem;">
                                @if($relatedPost->category)
                                    <span style="display: inline-block; padding: 0.25rem 0.75rem; background: var(--light); color: var(--primary); border-radius: 50px; font-size: 0.75rem; font-weight: 700; margin-bottom: 0.75rem;">
                                        {{ $relatedPost->category }}
                                    </span>
                                @endif
                                <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem; line-height: 1.4;">
                                    <a href="{{ route('blog.show', $relatedPost) }}" style="color: var(--dark); text-decoration: none;">{{ $relatedPost->title }}</a>
                                </h3>
                                <p style="color: var(--gray); font-size: 0.9375rem; margin-bottom: 1rem; line-height: 1.6;">
                                    {{ Str::limit(strip_tags($relatedPost->excerpt), 100) }}
                                </p>
                                <div style="display: flex; align-items: center; color: var(--gray); font-size: 0.8125rem;">
                                    <span>{{ $relatedPost->published_at->translatedFormat('d M Y') }}</span>
                                    <span style="margin: 0 0.5rem;">•</span>
                                    <span>{{ $relatedPost->reading_time ?? '5' }} min de lectura</span>
                                </div>
                            </div>
                        </article>
                    @endforeach
                </div>
            </div>
        @endif


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
