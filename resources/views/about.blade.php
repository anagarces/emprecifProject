@extends('layouts.app')

@section('title', 'Sobre Nosotros | Misión y Valores de EmpreciF')

@section('description', 'Descubre la misión de EmpreciF: democratizar la información empresarial oficial del BORME. Conoce nuestro equipo y compromiso con la transparencia.')

@push('head')
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700;900&display=swap" rel="stylesheet">
@endpush

@section('content')
<section>
    <div class="section-header" style="text-align: center; padding: 4rem 2rem; background: linear-gradient(135deg, #f5f7ff 0%, #f0f4ff 100%);">
        <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 4rem; font-weight: 900; margin-bottom: 1.5rem;">
            Sobre Nosotros: La Misión de EmpreciF
        </h1>
        <p style="font-size: 1.375rem; color: var(--gray); line-height: 1.7; max-width: 900px; margin: 0 auto;">
            EmpreciF nace de la necesidad de democratizar el acceso a la información empresarial oficial en España. Creemos firmemente que la transparencia en los negocios es fundamental para la economía y para que profesionales, inversores y ciudadanos puedan tomar decisiones informadas.
        </p>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
        <div style="background: white; padding: 4rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06); margin: 4rem auto;">
            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.5rem; font-weight: 800; margin-bottom: 1.5rem;">Nuestra Misión</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray);">
                Ser la plataforma líder en España, ofreciendo la información más precisa, actualizada y completa del Boletín Oficial del Registro Mercantil (BORME) y el Registro Mercantil. Nuestro compromiso es transformar datos complejos en inteligencia de negocio accesible para todos.
            </p>
        </div>

        <div style="background: white; padding: 4rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06); margin: 4rem auto;">
            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.5rem; font-weight: 800; margin-bottom: 1.5rem;">Nuestros Valores</h2>
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem;">
                <div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.75rem; color: var(--primary);">🎯 Transparencia</h3>
                    <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray);">Todos nuestros datos son verificados y provienen de fuentes oficiales del BORME y Registro Mercantil.</p>
                </div>
                <div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.75rem; color: var(--secondary);">⚡ Precisión</h3>
                    <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray);">Actualización diaria automática para asegurar la máxima fiabilidad y vigencia de los datos.</p>
                </div>
                <div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.75rem; color: var(--accent);">💡 Innovación</h3>
                    <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray);">Interfaz moderna, búsqueda avanzada y herramientas de análisis que simplifican la due diligence.</p>
                </div>
                <div>
                    <h3 style="font-size: 1.5rem; font-weight: 700; margin-bottom: 0.75rem; color: var(--primary);">🤝 Compromiso</h3>
                    <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray);">Soporte dedicado y atención al cliente profesional para resolver cualquier duda o necesidad.</p>
                </div>
            </div>
        </div>

        <div style="background: white; padding: 4rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06); margin: 4rem auto;">
            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.5rem; font-weight: 800; margin-bottom: 1.5rem;">El Equipo Detrás de EmpreciF</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 2rem;">
                EmpreciF es un proyecto de <strong>APPYWEB SL</strong>, una empresa tecnológica con sede en Alcoy (Alicante), especializada en el desarrollo de plataformas de datos y software B2B. Contamos con un equipo de ingenieros de datos, desarrolladores y expertos en análisis financiero comprometidos con ofrecer la mejor experiencia de usuario.
            </p>
            <div style="background: var(--light); padding: 2rem; border-radius: 12px; border-left: 4px solid var(--accent);">
                <p style="font-size: 1rem; color: var(--dark); margin-bottom: 0.5rem;"><strong>APPYWEB SL</strong></p>
                <p style="font-size: 1rem; color: var(--gray); margin-bottom: 0.25rem;">CIF: B02720803</p>
                <p style="font-size: 1rem; color: var(--gray); margin-bottom: 0.25rem;">Calle Mestre Laporta, Nº 2, 1º piso, puerta 2</p>
                <p style="font-size: 1rem; color: var(--gray); margin-bottom: 0.25rem;">03801 Alcoy (Alicante), España</p>
                <p style="font-size: 1rem; color: var(--gray); margin-top: 1rem;">📧 info@emprecif.com</p>
                <p style="font-size: 1rem; color: var(--gray);">📞 +34 658 17 08 09</p>
            </div>
        </div>

        <div style="text-align: center; margin: 4rem 0;">
            <a href="{{ route('contact') }}" class="btn btn-primary btn-large" style="display: inline-block; background: var(--primary); color: white; font-weight: 700; padding: 1rem 2.5rem; border-radius: 50px; text-decoration: none; transition: all 0.3s ease; font-size: 1.125rem;">Contacta con el Equipo</a>
        </div>
    </div>
</section>

<footer style="background: #1a1a2e; color: white; padding: 4rem 2rem 2rem; margin-top: 4rem;">
    <div style="max-width: 1400px; margin: 0 auto; display: grid; grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); gap: 2rem; margin-bottom: 3rem;">
        <div class="footer-brand" style="grid-column: 1 / -1; max-width: 350px;">
            <img src="{{ asset('images/logo_emprecif_wordmark_white.png') }}" alt="EmpreciF" style="height: 40px; margin-bottom: 1.5rem;">
            <p style="color: #a0a0b8; line-height: 1.7; margin-bottom: 1.5rem;">Plataforma líder de información empresarial en España. Datos oficiales del BORME actualizados diariamente. Más de 3.2 millones de empresas, 15 años de histórico.</p>
            <div style="display: flex; gap: 1rem;">
                <a href="#" style="color: white; font-size: 1.5rem;"><i class="fab fa-twitter"></i></a>
                <a href="#" style="color: white; font-size: 1.5rem;"><i class="fab fa-linkedin"></i></a>
                <a href="#" style="color: white; font-size: 1.5rem;"><i class="fab fa-facebook"></i></a>
            </div>
        </div>
        
        <div class="footer-section">
            <h4 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 1.5rem; color: white;">Producto</h4>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="margin-bottom: 0.75rem;"><a href="{{ route('search') }}" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Buscar Empresas</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="{{ route('pricing') }}" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Precios</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="#" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">API</a></li>
                <li><a href="#" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Integraciones</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 1.5rem; color: white;">Empresa</h4>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="margin-bottom: 0.75rem;"><a href="{{ route('about') }}" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Sobre Nosotros</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="{{ route('blog.index') }}" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Blog</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="{{ route('contact') }}" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Contacto</a></li>
                <li><a href="#" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Prensa</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 1.5rem; color: white;">Recursos</h4>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="margin-bottom: 0.75rem;"><a href="#" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Centro de Ayuda</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="#" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Documentación</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="#" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Guías</a></li>
                <li><a href="#" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Estado del Sistema</a></li>
            </ul>
        </div>
        
        <div class="footer-section">
            <h4 style="font-size: 1.125rem; font-weight: 700; margin-bottom: 1.5rem; color: white;">Legal</h4>
            <ul style="list-style: none; padding: 0; margin: 0;">
                <li style="margin-bottom: 0.75rem;"><a href="{{ route('legal.notice') }}" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Aviso Legal</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="{{ route('legal.privacy') }}" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Política de Privacidad</a></li>
                <li style="margin-bottom: 0.75rem;"><a href="{{ route('legal.cookies') }}" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Política de Cookies</a></li>
                <li><a href="{{ route('legal.terms') }}" style="color: #a0a0b8; text-decoration: none; transition: color 0.3s ease;">Términos y Condiciones</a></li>
            </ul>
        </div>
    </div>
    
    <div style="border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 2rem; text-align: center; color: #a0a0b8; font-size: 0.875rem;">
        <p>&copy; {{ date('Y') }} EmpreciF - APPYWEB SL (B02720803). Todos los derechos reservados.</p>
        <p style="margin-top: 0.5rem;">Datos oficiales del BORME • Actualizado diariamente • Registro Mercantil de Alicante</p>
    </div>
</footer>

@push('scripts')
<script>
    // Ticker animation
    document.addEventListener('DOMContentLoaded', function() {
        const ticker = document.querySelector('.ticker');
        if (ticker) {
            const items = ticker.querySelectorAll('.ticker-item');
            const firstItem = items[0];
            
            // Clone items for seamless loop
            items.forEach(item => {
                const clone = item.cloneNode(true);
                ticker.appendChild(clone);
            });
            
            // Animation
            let position = 0;
            const speed = 1;
            const itemWidth = firstItem.offsetWidth + 20; // 20px gap
            
            function animate() {
                position -= speed;
                if (position <= -itemWidth) {
                    position = 0;
                }
                ticker.style.transform = `translateX(${position}px)`;
                requestAnimationFrame(animate);
            }
            
            animate();
        }
    });
</script>
@endpush

        <div class="max-w-6xl mx-auto">
            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 mb-12">
                <h2 class="text-4xl font-display font-bold mb-6">Nuestra Misión</h2>
                <p class="text-lg md:text-xl text-gray-700 leading-relaxed">
                    Ser la plataforma líder en España, ofreciendo la información más precisa, actualizada y completa del Boletín Oficial del Registro Mercantil (BORME) y el Registro Mercantil. Nuestro compromiso es transformar datos complejos en inteligencia de negocio accesible para todos.
                </p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 mb-12">
                <h2 class="text-4xl font-display font-bold mb-8">Nuestros Valores</h2>
                <div class="grid md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-2xl font-bold mb-3 text-primary-600">🎯 Transparencia</h3>
                        <p class="text-gray-700">Todos nuestros datos son verificados y provienen de fuentes oficiales del BORME y Registro Mercantil.</p>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold mb-3 text-secondary-600">⚡ Precisión</h3>
                        <p class="text-gray-700">Actualización diaria automática para asegurar la máxima fiabilidad y vigencia de los datos.</p>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold mb-3 text-accent-600">💡 Innovación</h3>
                        <p class="text-gray-700">Interfaz moderna, búsqueda avanzada y herramientas de análisis que simplifican la due diligence.</p>
                    </div>
                    <div>
                        <h3 class="text-2xl font-bold mb-3 text-primary-600">🤝 Compromiso</h3>
                        <p class="text-gray-700">Soporte dedicado y atención al cliente profesional para resolver cualquier duda o necesidad.</p>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-lg p-8 md:p-12 mb-12">
                <h2 class="text-4xl font-display font-bold mb-6">El Equipo Detrás de EmpreciF</h2>
                <p class="text-lg text-gray-700 mb-8 leading-relaxed">
                    EmpreciF es un proyecto de <strong>APPYWEB SL</strong>, una empresa tecnológica con sede en Alcoy (Alicante), especializada en el desarrollo de plataformas de datos y software B2B. Contamos con un equipo de ingenieros de datos, desarrolladores y expertos en análisis financiero comprometidos con ofrecer la mejor experiencia de usuario.
                </p>
                <div class="bg-gray-50 p-6 rounded-lg border-l-4 border-accent-500">
                    <p class="font-semibold text-gray-900 mb-1">APPYWEB SL</p>
                    <p class="text-gray-700">CIF: B02720803</p>
                    <p class="text-gray-700">Calle Mestre Laporta, Nº 2, 1º piso, puerta 2</p>
                    <p class="text-gray-700">03801 Alcoy (Alicante), España</p>
                    <p class="text-gray-700 mt-3">📧 <a href="mailto:info@appyweb.es" class="hover:text-primary-600 transition-colors">info@appyweb.es</a></p>
                    <p class="text-gray-700">📞 <a href="tel:+34658170809" class="hover:text-primary-600 transition-colors">+34 658 17 08 09</a></p>
                </div>
            </div>

            <div class="text-center mt-12">
                <a href="{{ route('contact') }}" class="inline-flex items-center justify-center px-8 py-4 text-lg font-medium text-white bg-primary-600 hover:bg-primary-700 rounded-lg transition-colors duration-200">
                    Contacta con el Equipo
                </a>
            </div>
        </div>
    </div>
</section>
@endsection
