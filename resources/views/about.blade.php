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

@endsection
