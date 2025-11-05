@extends('layouts.app')

@section('title', ($post->title ?? 'Artículo') . ' | Blog EmpreciF')

@section('description', $post->excerpt ? Str::limit(strip_tags($post->excerpt), 160) : 'Artículo del blog de EmpreciF')

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
            <div class="flex items-center justify-center gap-4 mb-6">
                <span class="px-4 py-2 bg-gray-100 text-primary rounded-full text-sm font-bold">
                    {{ $post->category }}
                </span>
                <span class="text-gray-500">
                    {{ $post->published_at->format('d M Y') }}
                </span>
                <span class="text-gray-500 flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-1" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                    </svg>
                    {{ number_format($post->views) }} vistas
                </span>
            </div>
            
            <h1 class="font-display text-4xl md:text-5xl font-black text-center mb-8">
                {{ $post->title }}
            </h1>

            <div class="max-w-2xl mx-auto">
                <div class="h-96 bg-gradient-to-r from-primary to-secondary rounded-2xl flex items-center justify-center mb-12">
                    <span class="text-9xl">
                        @switch($post->category)
                            @case('Guías')
                                📊
                                @break
                            @case('Due Diligence')
                                🔍
                                @break
                            @case('Análisis')
                                💰
                                @break
                            @case('Legal')
                                ⚖️
                                @break
                            @default
                                📝
                        @endswitch
                    </span>
                </div>
            </div>
        </header>

        <!-- Contenido del artículo -->
        <div class="prose prose-lg max-w-3xl mx-auto">
            {!! $post->content !!}
        </div>

        <!-- Compartir en redes sociales -->
        <div class="max-w-3xl mx-auto mt-16 pt-8 border-t border-gray-200">
            <h3 class="text-xl font-bold mb-6">¿Te ha resultado útil este artículo?</h3>
            <div class="flex items-center gap-4">
                <span class="text-gray-600">Compartir:</span>
                <div class="flex gap-3">
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(route('blog.show', $post)) }}&text={{ urlencode($post->title) }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="w-12 h-12 rounded-full bg-gray-100 text-gray-700 flex items-center justify-center hover:bg-gray-200 transition-colors">
                        <span class="sr-only">Compartir en Twitter</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84"></path>
                        </svg>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(route('blog.show', $post)) }}&title={{ urlencode($post->title) }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="w-12 h-12 rounded-full bg-gray-100 text-gray-700 flex items-center justify-center hover:bg-gray-200 transition-colors">
                        <span class="sr-only">Compartir en LinkedIn</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path d="M19 0h-14c-2.761 0-5 2.239-5 5v14c0 2.761 2.239 5 5 5h14c2.762 0 5-2.239 5-5v-14c0-2.761-2.238-5-5-5zm-11 19h-3v-11h3v11zm-1.5-12.268c-.966 0-1.75-.79-1.75-1.764s.784-1.764 1.75-1.764 1.75.79 1.75 1.764-.783 1.764-1.75 1.764zm13.5 12.268h-3v-5.604c0-3.368-4-3.113-4 0v5.604h-3v-11h3v1.765c1.396-2.586 7-2.777 7 2.476v6.759z"/>
                        </svg>
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(route('blog.show', $post)) }}" 
                       target="_blank" 
                       rel="noopener noreferrer"
                       class="w-12 h-12 rounded-full bg-gray-100 text-gray-700 flex items-center justify-center hover:bg-gray-200 transition-colors">
                        <span class="sr-only">Compartir en Facebook</span>
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
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
    <section class="py-16 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4">
            <h2 class="text-3xl font-bold mb-12 text-center">Artículos relacionados</h2>
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($relatedPosts as $relatedPost)
                    <article class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1">
                        <div class="h-48 bg-gradient-to-r from-primary to-secondary flex items-center justify-center">
                            <span class="text-6xl">
                                @switch($relatedPost->category)
                                    @case('Guías')
                                        📊
                                        @break
                                    @case('Due Diligence')
                                        🔍
                                        @break
                                    @case('Análisis')
                                        💰
                                        @break
                                    @case('Legal')
                                        ⚖️
                                        @break
                                    @default
                                        📝
                                @endswitch
                            </span>
                        </div>
                        <div class="p-6">
                            <div class="flex items-center gap-3 mb-3">
                                <span class="px-3 py-1 bg-gray-100 text-primary rounded-full text-xs font-bold">
                                    {{ $relatedPost->category }}
                                </span>
                                <span class="text-xs text-gray-500">
                                    {{ $relatedPost->published_at->format('d M Y') }}
                                </span>
                            </div>
                            <h3 class="font-display text-xl font-bold mb-3">
                                <a href="{{ route('blog.show', $relatedPost) }}" class="text-gray-900 hover:text-primary transition-colors">
                                    {{ Str::limit($relatedPost->title, 60) }}
                                </a>
                            </h3>
                            @if($relatedPost->excerpt)
                                <p class="text-gray-600 text-sm mb-4">
                                    {{ Str::limit($relatedPost->excerpt, 120) }}
                                </p>
                            @endif
                            <a href="{{ route('blog.show', $relatedPost) }}" class="inline-flex items-center text-primary font-medium hover:text-primary-dark transition-colors text-sm">
                                Leer artículo →
                            </a>
                        </div>
                    </article>
                @endforeach
            </div>
        </div>
    </section>
@endif

<!-- CTA -->
<section class="py-16 bg-white border-t border-gray-100">
    <div class="max-w-4xl mx-auto px-4 text-center">
        <h2 class="font-display text-3xl md:text-4xl font-black mb-6">¿Quieres acceder a más información empresarial?</h2>
        <p class="text-xl text-gray-600 mb-8 max-w-2xl mx-auto">
            Obtén acceso ilimitado a datos de más de 3.2 millones de empresas españolas con EmpreciF.
        </p>
        <div class="flex flex-col sm:flex-row gap-4 justify-center">
            <a href="{{ route('register') }}" class="btn btn-primary">
                Prueba Gratis 14 Días
            </a>
            <a href="{{ route('pricing') }}" class="btn btn-outline">
                Ver Planes y Precios
            </a>
        </div>
    </div>
</section>
@endsection

<!-- Newsletter -->
<section class="bg-white py-16">
    <div class="container mx-auto px-4">
        <div class="max-w-3xl mx-auto text-center bg-gray-50 p-8 md:p-12 rounded-2xl shadow-lg">
            <h2 class="text-3xl md:text-4xl font-display font-bold mb-4">¿Te gustó este artículo?</h2>
            <p class="text-gray-600 mb-8 max-w-2xl mx-auto">
                Suscríbete a nuestro boletín para recibir más contenido como este directamente en tu bandeja de entrada.
            </p>
            <form class="max-w-md mx-auto flex flex-col sm:flex-row gap-4">
                @csrf
                <input type="email" name="email" placeholder="Tu correo electrónico" required
                       class="flex-1 px-6 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-primary-500 focus:border-transparent">
                <button type="submit" class="px-6 py-3 bg-primary-600 hover:bg-primary-700 text-white font-semibold rounded-lg transition-colors">
                    Suscribirme
                </button>
            </form>
            <p class="text-sm text-gray-500 mt-4">
                Respetamos tu privacidad. Nunca compartiremos tu información.
            </p>
        </div>
    </div>
</section>

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
