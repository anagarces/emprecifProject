@extends('layouts.app')

@section('title', 'Blog | Guías y Recursos sobre Información Empresarial')

@section('description', 'Artículos, guías y recursos sobre información empresarial, BORME, due diligence y análisis financiero de empresas españolas.')

@push('head')
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700;800;900&display=swap" rel="stylesheet">
@endpush

@section('content')
<section>
    <div class="section-header" style="text-align: center; padding: 4rem 2rem; background: linear-gradient(135deg, #f5f7ff 0%, #f0f4ff 100%);">
        <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 4rem; font-weight: 900; margin-bottom: 1.5rem;">
            Blog de EmpreciF
        </h1>
        <p style="font-size: 1.375rem; color: var(--gray); line-height: 1.7;">
            Guías, recursos y análisis sobre información empresarial, BORME y due diligence en España.
        </p>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
        @if($posts->count() > 0)
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 3rem;">
                @foreach($posts as $post)
                    <article style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);">
                        <div style="height: 250px; background: linear-gradient(135deg, var(--primary), var(--secondary)); display: flex; align-items: center; justify-content: center; overflow: hidden;">
                            @if($post->image)
                                <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" style="width: 100%; height: 100%; object-fit: cover;">
                            @else
                                @php
                                    // Default emojis based on category
                                    $emojis = [
                                        'Guías' => '📊',
                                        'Due Diligence' => '🔍',
                                        'Análisis' => '💰',
                                        'Legal' => '⚖️',
                                        'default' => '📄'
                                    ];
                                    $emoji = $emojis[$post->category] ?? $emojis['default'];
                                @endphp
                                <span style="font-size: 5rem;">{{ $emoji }}</span>
                            @endif
                        </div>
                        <div style="padding: 2.5rem;">
                            <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                                @if($post->category)
                                    <span style="padding: 0.5rem 1rem; background: var(--light); color: var(--primary); border-radius: 50px; font-size: 0.875rem; font-weight: 700;">{{ $post->category }}</span>
                                @endif
                                <span style="color: var(--gray); font-size: 0.875rem;">
                                    {{ $post->published_at ? $post->published_at->translatedFormat('d M Y') : '' }}
                                </span>
                            </div>
                            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.75rem; font-weight: 800; margin-bottom: 1rem;">
                                <a href="{{ route('blog.show', $post) }}" style="color: var(--dark); text-decoration: none;">
                                    {{ $post->title }}
                                </a>
                            </h2>
                          <div class="text-gray-600">{!! $post->formatted_excerpt !!}</div>
                            <a href="{{ route('blog.show', $post) }}" class="btn btn-outline">Leer Artículo →</a>
                        </div>
                    </article>
                @endforeach
            </div>
            
            <!-- Paginación -->
            <div style="margin-top: 3rem; text-align: center;">
                {{ $posts->links() }}
            </div>
        @else
            <div style="text-align: center; padding: 4rem 0;">
                <p style="font-size: 1.25rem; color: var(--gray);">
                    No hay artículos publicados en este momento. ¡Vuelve pronto para ver nuevas publicaciones!
                </p>
            </div>
        @endif
    </div>
</section>

@push('scripts')
<script>
    // Ticker animation
    document.addEventListener('DOMContentLoaded', function() {
        const ticker = document.querySelector('.ticker');
        if (ticker) {
            const tickerItems = document.querySelectorAll('.ticker-item');
            const tickerWidth = tickerItems[0].offsetWidth * tickerItems.length / 2; // Divide by 2 because we duplicate items
            
            // Set the width of the ticker to fit all items
            ticker.style.width = tickerWidth + 'px';
            
            // Animate the ticker
            let position = 0;
            function animateTicker() {
                position -= 1;
                if (position <= -tickerWidth / 2) {
                    position = 0;
                }
                ticker.style.transform = `translateX(${position}px)`;
                requestAnimationFrame(animateTicker);
            }
            
            // Start animation
            animateTicker();
        }
    });
</script>
@endpush

 

@endsection
