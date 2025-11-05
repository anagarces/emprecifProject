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
        <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 3rem;">
            <!-- Artículo 1 -->
            <article style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);">
                <div style="height: 250px; background: linear-gradient(135deg, var(--primary), var(--secondary)); display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 5rem;">📊</span>
                </div>
                <div style="padding: 2.5rem;">
                    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                        <span style="padding: 0.5rem 1rem; background: var(--light); color: var(--primary); border-radius: 50px; font-size: 0.875rem; font-weight: 700;">Guías</span>
                        <span style="color: var(--gray); font-size: 0.875rem;">28 Oct 2025</span>
                    </div>
                    <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.75rem; font-weight: 800; margin-bottom: 1rem;">
                        <a href="{{ route('blog.show', 'como-interpretar-cuentas-anuales') }}" style="color: var(--dark); text-decoration: none;">Cómo Interpretar las Cuentas Anuales de una Empresa</a>
                    </h2>
                    <p style="font-size: 1.125rem; color: var(--gray); line-height: 1.7; margin-bottom: 1.5rem;">
                        Guía completa para entender balances, cuentas de resultados y ratios financieros. Aprende a analizar la salud financiera de cualquier empresa española.
                    </p>
                    <a href="{{ route('blog.show', 'como-interpretar-cuentas-anuales') }}" class="btn btn-outline">Leer Artículo →</a>
                </div>
            </article>

            <!-- Artículo 2 -->
            <article style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);">
                <div style="height: 250px; background: linear-gradient(135deg, var(--accent), var(--secondary)); display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 5rem;">🔍</span>
                </div>
                <div style="padding: 2.5rem;">
                    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                        <span style="padding: 0.5rem 1rem; background: var(--light); color: var(--accent); border-radius: 50px; font-size: 0.875rem; font-weight: 700;">Due Diligence</span>
                        <span style="color: var(--gray); font-size: 0.875rem;">25 Oct 2025</span>
                    </div>
                    <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.75rem; font-weight: 800; margin-bottom: 1rem;">
                        <a href="{{ route('blog.show', 'que-es-el-borme') }}" style="color: var(--dark); text-decoration: none;">Qué es el BORME y Cómo Utilizarlo</a>
                    </h2>
                    <p style="font-size: 1.125rem; color: var(--gray); line-height: 1.7; margin-bottom: 1.5rem;">
                        El Boletín Oficial del Registro Mercantil (BORME) es la fuente oficial de información empresarial en España. Descubre cómo sacarle el máximo provecho.
                    </p>
                    <a href="{{ route('blog.show', 'que-es-el-borme') }}" class="btn btn-outline">Leer Artículo →</a>
                </div>
            </article>

            <!-- Artículo 3 -->
            <article style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);">
                <div style="height: 250px; background: linear-gradient(135deg, var(--secondary), var(--primary)); display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 5rem;">💰</span>
                </div>
                <div style="padding: 2.5rem;">
                    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                        <span style="padding: 0.5rem 1rem; background: var(--light); color: var(--secondary); border-radius: 50px; font-size: 0.875rem; font-weight: 700;">Análisis</span>
                        <span style="color: var(--gray); font-size: 0.875rem;">22 Oct 2025</span>
                    </div>
                    <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.75rem; font-weight: 800; margin-bottom: 1rem;">
                        <a href="{{ route('blog.show', 'ratios-financieros-clave') }}" style="color: var(--dark); text-decoration: none;">Ratios Financieros Clave para Evaluar Empresas</a>
                    </h2>
                    <p style="font-size: 1.125rem; color: var(--gray); line-height: 1.7; margin-bottom: 1.5rem;">
                        Ratio de liquidez, solvencia, rentabilidad y endeudamiento. Aprende a calcularlos e interpretarlos para tomar decisiones de inversión informadas.
                    </p>
                    <a href="{{ route('blog.show', 'ratios-financieros-clave') }}" class="btn btn-outline">Leer Artículo →</a>
                </div>
            </article>

            <!-- Artículo 4 -->
            <article style="background: white; border-radius: 20px; overflow: hidden; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);">
                <div style="height: 250px; background: linear-gradient(135deg, var(--primary), var(--accent)); display: flex; align-items: center; justify-content: center;">
                    <span style="font-size: 5rem;">⚖️</span>
                </div>
                <div style="padding: 2.5rem;">
                    <div style="display: flex; gap: 1rem; margin-bottom: 1rem;">
                        <span style="padding: 0.5rem 1rem; background: var(--light); color: var(--primary); border-radius: 50px; font-size: 0.875rem; font-weight: 700;">Legal</span>
                        <span style="color: var(--gray); font-size: 0.875rem;">20 Oct 2025</span>
                    </div>
                    <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.75rem; font-weight: 800; margin-bottom: 1rem;">
                        <a href="{{ route('blog.show', 'due-diligence-checklist') }}" style="color: var(--dark); text-decoration: none;">Due Diligence: Checklist Completa para Inversores</a>
                    </h2>
                    <p style="font-size: 1.125rem; color: var(--gray); line-height: 1.7; margin-bottom: 1.5rem;">
                        Checklist paso a paso para realizar una due diligence completa antes de invertir o adquirir una empresa. Evita sorpresas desagradables.
                    </p>
                    <a href="{{ route('blog.show', 'due-diligence-checklist') }}" class="btn btn-outline">Leer Artículo →</a>
                </div>
            </article>
        </div>
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

<footer style="background-color: #1a202c; color: white; padding: 4rem 2rem 2rem;">
    <div style="max-width: 1200px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
        <div class="footer-brand">
            <img src="{{ asset('images/logo_emprecif_wordmark_white.png') }}" alt="EmpreciF" style="height: 40px; margin-bottom: 1rem;">
            <p style="color: #a0aec0; line-height: 1.6;">Plataforma líder de información empresarial en España. Datos oficiales del BORME actualizados diariamente. Más de 3.2 millones de empresas, 15 años de histórico.</p>
        </div>
        <div>
            <h4 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.125rem; font-weight: 700; margin-bottom: 1.5rem; color: white;">Producto</h4>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="margin-bottom: 0.75rem;"><a href="{{ route('search') }}" style="color: #a0aec0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#4299e1'" onmouseout="this.style.color='#a0aec0'">Buscar Empresas</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="{{ route('pricing') }}" style="color: #a0aec0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#4299e1'" onmouseout="this.style.color='#a0aec0'">Precios</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="#" style="color: #a0aec0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#4299e1'" onmouseout="this.style.color='#a0aec0'">API</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="#" style="color: #a0aec0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#4299e1'" onmouseout="this.style.color='#a0aec0'">Integraciones</a></li>
            </ul>
        </div>
        <div>
            <h4 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.125rem; font-weight: 700; margin-bottom: 1.5rem; color: white;">Empresa</h4>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="margin-bottom: 0.75rem;"><a href="{{ route('about') }}" style="color: #a0aec0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#4299e1'" onmouseout="this.style.color='#a0aec0'">Sobre Nosotros</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="{{ route('blog.index') }}" style="color: #a0aec0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#4299e1'" onmouseout="this.style.color='#a0aec0'">Blog</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="{{ route('contact') }}" style="color: #a0aec0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#4299e1'" onmouseout="this.style.color='#a0aec0'">Contacto</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="#" style="color: #a0aec0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#4299e1'" onmouseout="this.style.color='#a0aec0'">Prensa</a></li>
            </ul>
        </div>
        <div>
            <h4 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.125rem; font-weight: 700; margin-bottom: 1.5rem; color: white;">Recursos</h4>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="margin-bottom: 0.75rem;"><a href="#" style="color: #a0aec0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#4299e1'" onmouseout="this.style.color='#a0aec0'">Centro de Ayuda</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="#" style="color: #a0aec0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#4299e1'" onmouseout="this.style.color='#a0aec0'">Documentación</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="#" style="color: #a0aec0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#4299e1'" onmouseout="this.style.color='#a0aec0'">Guías</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="#" style="color: #a0aec0; text-decoration: none; transition: color 0.2s;" onmouseover="this.style.color='#4299e1'" onmouseout="this.style.color='#a0aec0'">Estado del Sistema</a></li>
            </ul>
        </div>
    </div>
    <div style="max-width: 1200px; margin: 0 auto; padding-top: 2rem; border-top: 1px solid #2d3748; text-align: center; color: #a0aec0; font-size: 0.875rem; line-height: 1.5;">
        <div>© {{ date('Y') }} EmpreciF - APPYWEB SL (B02720803). Todos los derechos reservados.</div>
        <div>Datos oficiales del BORME • Actualizado diariamente • Registro Mercantil de Alicante</div>
    </div>
</footer>

@endsection
