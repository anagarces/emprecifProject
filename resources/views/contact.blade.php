@extends('layouts.app')

@section('title', 'Contacto | Soporte y Atención al Cliente | EmpreciF')

@section('description', 'Contacta con el equipo de EmpreciF. Soporte técnico, ventas y consultas generales. Email, teléfono y formulario de contacto.')

@push('head')
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700;800;900&display=swap" rel="stylesheet">
@endpush

@section('content')
<section>
    <div class="section-header" style="text-align: center; padding: 4rem 2rem; background: linear-gradient(135deg, #f5f7ff 0%, #f0f4ff 100%);">
        <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 4rem; font-weight: 900; margin-bottom: 1.5rem;">
            Contacta con Nosotros
        </h1>
        <p style="font-size: 1.375rem; color: var(--gray); line-height: 1.7;">
            Estamos aquí para ayudarte. Respuesta en menos de 24 horas.
        </p>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 0 2rem;">
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem; margin-bottom: 4rem;">
            <h1 class="text-5xl md:text-6xl font-black font-display mb-6">
                Contacta con Nosotros
            </h1>
            <p class="text-xl md:text-2xl text-gray-600 leading-relaxed">
                Estamos aquí para ayudarte. Respuesta en menos de 24 horas.
            </p>
        </div>

        <div class="max-w-6xl mx-auto">
            <!-- Formulario de Contacto -->
            <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);">
                <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 2rem; font-weight: 800; margin-bottom: 2rem;">Envíanos un Mensaje</h2>
                    
                    @if(session('status'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded" role="alert">
                            <p>{{ session('status') }}</p>
                        </div>
                    @endif

                    <form action="#" method="post">
                        <div class="mb-6">
                            <label style="display: block; font-weight: 700; margin-bottom: 0.5rem; color: var(--dark);">Nombre Completo *</label>
                            <input type="text" name="name" required 
                                   style="width: 100%; padding: 1rem; border: 2px solid #E2E8F0; border-radius: 12px; font-size: 1rem; transition: all 0.3s;"
                                   placeholder="Juan García"
                                   onfocus="this.style.borderColor='var(--primary)'"
                                   onblur="this.style.borderColor='#E2E8F0'"
                                   value="{{ old('name') }}">
                            @error('name')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label style="display: block; font-weight: 700; margin-bottom: 0.5rem; color: var(--dark);">Email *</label>
                            <input type="email" name="email" required 
                                   style="width: 100%; padding: 1rem; border: 2px solid #E2E8F0; border-radius: 12px; font-size: 1rem; transition: all 0.3s;"
                                   placeholder="tu@email.com"
                                   onfocus="this.style.borderColor='var(--primary)'"
                                   onblur="this.style.borderColor='#E2E8F0'"
                                   value="{{ old('email') }}">
                            @error('email')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-6">
                            <label style="display: block; font-weight: 700; margin-bottom: 0.5rem; color: var(--dark);">Asunto *</label>
                            <select name="subject" required 
                                    style="width: 100%; padding: 1rem; border: 2px solid #E2E8F0; border-radius: 12px; font-size: 1rem; transition: all 0.3s; background: white; cursor: pointer;"
                                    onfocus="this.style.borderColor='var(--primary)'"
                                    onblur="this.style.borderColor='#E2E8F0'">
                                <option value="">Selecciona un asunto</option>
                                <option value="soporte">Soporte Técnico</option>
                                <option value="ventas">Consulta de Ventas</option>
                                <option value="facturacion">Facturación</option>
                                <option value="api">API y Desarrollo</option>
                                <option value="otro">Otro</option>
                            </select>
                            @error('subject')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="mb-8">
                            <label style="display: block; font-weight: 700; margin-bottom: 0.5rem; color: var(--dark);">Mensaje *</label>
                            <textarea name="message" required rows="6"
                                      style="width: 100%; padding: 1rem; border: 2px solid #E2E8F0; border-radius: 12px; font-size: 1rem; transition: all 0.3s; font-family: inherit; resize: vertical;"
                                      placeholder="Cuéntanos cómo podemos ayudarte..."
                                      onfocus="this.style.borderColor='var(--primary)'"
                                      onblur="this.style.borderColor='#E2E8F0'">{{ old('message') }}</textarea>
                            @error('message')
                                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary btn-large" style="width: 100%;">
                            Enviar Mensaje
                        </button>
                    </form>
                </div>

                <!-- Información de Contacto -->
                <div>
                    <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06); margin-bottom: 2rem;">
                        <h3 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin-bottom: 2rem;">Información de Contacto</h3>
                        
                        <div style="margin-bottom: 2rem;">
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                                <span style="font-size: 1.5rem;">📧</span>
                                <strong style="color: var(--dark);">Email</strong>
                            </div>
                            <p style="margin-left: 2.5rem; color: var(--gray);">
                                <a href="mailto:info@emprecif.com" style="color: var(--primary); text-decoration: none; font-weight: 700;">info@emprecif.com</a>
                            </p>
                        </div>

                        <div>
                            <div style="display: flex; align-items: center; gap: 1rem; margin-bottom: 0.5rem;">
                                <span style="font-size: 1.5rem;">📍</span>
                                <strong style="color: var(--dark);">Dirección</strong>
                            </div>
                            <p style="margin-left: 2.5rem; color: var(--gray); line-height: 1.6;">
                                APPYWEB SL<br>
                                Calle Mestre Laporta, Nº 2, 1º piso, puerta 2<br>
                                03801 Alcoy (Alicante)<br>
                                España
                            </p>
                        </div>
                    </div>

                    <div style="background: linear-gradient(135deg, var(--primary), var(--secondary)); padding: 3rem; border-radius: 20px; color: white;">
                        <h3 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin-bottom: 1rem;">Soporte Prioritario</h3>
                        <p style="margin-bottom: 1.5rem; opacity: 0.95;">
                            Los usuarios Premium tienen acceso a soporte prioritario con respuesta en menos de 2 horas.
                        </p>
                        <a href="{{ route('pricing') }}" class="btn btn-large" style="background: white; color: var(--primary); display: inline-block;">
                            Ver Planes Premium
                        </a>
                    </div>
                </div>
            </div>

            <!-- Preguntas Frecuentes -->
            <div style="background: white; padding: 4rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.06);">
                <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 2.5rem; font-weight: 800; margin-bottom: 3rem; text-align: center;">Preguntas Frecuentes</h2>
                
                <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 2rem;">
                    <div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem; color: var(--primary);">¿Cuánto tarda la respuesta?</h3>
                        <p style="font-size: 1rem; color: var(--gray); line-height: 1.7;">
                            Respondemos en menos de 24 horas laborables. Usuarios Premium: menos de 2 horas.
                        </p>
                    </div>
                    
                    <div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem; color: var(--primary);">¿Ofrecen soporte técnico?</h3>
                        <p style="font-size: 1rem; color: var(--gray); line-height: 1.7;">
                            Sí, tenemos un equipo técnico especializado para resolver cualquier problema o duda.
                        </p>
                    </div>
                    
                    <div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem; color: var(--primary);">¿Puedo solicitar una demo?</h3>
                        <p style="font-size: 1rem; color: var(--gray); line-height: 1.7;">
                            Sí, contáctanos y te mostraremos todas las funcionalidades de la plataforma.
                        </p>
                    </div>
                    
                    <div>
                        <h3 style="font-size: 1.25rem; font-weight: 700; margin-bottom: 0.75rem; color: var(--primary);">¿Tienen API para desarrolladores?</h3>
                        <p style="font-size: 1rem; color: var(--gray); line-height: 1.7;">
                            Sí, ofrecemos API REST con documentación completa para integrar nuestros datos.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@push('scripts')
<script>
    // Ticker animation
    document.addEventListener('DOMContentLoaded', function() {
        const ticker = document.querySelector('.ticker');
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
    });
</script>
@endpush


@endsection

