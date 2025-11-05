@extends('layouts.app')

@section('title', 'Política de Privacidad | EmpreciF')
@section('description', 'Lee nuestra Política de Privacidad y conoce cómo protegemos tus datos en EmpreciF.')

@push('head')
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700;800;900&display=swap" rel="stylesheet">
@endpush

@section('content')
<section>
    <div class="section-header" style="text-align: center; padding: 4rem 2rem; background: linear-gradient(135deg, #f5f7ff 0%, #f0f4ff 100%);">
        <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 3rem; font-weight: 900; margin-bottom: 1.5rem;">
            Política de Privacidad
        </h1>
        <p style="font-size: 1.125rem; color: var(--gray); max-width: 800px; margin: 0 auto; line-height: 1.7;">
            En esta página encontrarás toda la información relacionada con la gestión y protección de tus datos personales en EmpreciF.
        </p>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 4rem 2rem;">
        <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); margin-bottom: 3rem;">
            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.75rem; font-weight: 800; margin-bottom: 1.5rem; color: var(--dark);">1. Introducción</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 2rem;">
                En EmpreciF nos comprometemos a proteger y respetar tu privacidad. Esta política establece las bases sobre las que tratamos cualquier dato personal que nos proporciones o que recopilemos de ti.
            </p>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">2. Datos que recopilamos</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 2rem;">
                Podemos recopilar y procesar los siguientes datos sobre ti:
            </p>
            <ul style="list-style: disc; padding-left: 2rem; margin-bottom: 2rem; color: var(--gray); font-size: 1.125rem; line-height: 1.8;">
                <li>Información que nos proporcionas al registrarte o al utilizar nuestros servicios.</li>
                <li>Datos de contacto, incluyendo dirección de correo electrónico y número de teléfono.</li>
                <li>Información sobre transacciones y pagos.</li>
                <li>Datos técnicos como direcciones IP, tipo de navegador y versión.</li>
            </ul>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">3. Uso de tus datos</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 2rem;">
                Utilizamos la información que recopilamos para:
            </p>
            <ul style="list-style: disc; padding-left: 2rem; margin-bottom: 2rem; color: var(--gray); font-size: 1.125rem; line-height: 1.8;">
                <li>Proporcionarte nuestros servicios y gestionar tu cuenta.</li>
                <li>Procesar tus transacciones y enviarte facturas.</li>
                <li>Mejorar nuestro sitio web y servicios.</li>
                <li>Enviarte actualizaciones y comunicaciones relacionadas con nuestros servicios.</li>
            </ul>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">4. Tus derechos</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 2rem;">
                Tienes derecho a acceder, rectificar, oponerte al tratamiento, suprimir, limitar y portar tus datos personales. Puedes ejercer estos derechos contactándonos a través de los medios indicados en el apartado de contacto de nuestro sitio web.
            </p>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">5. Cambios en nuestra política de privacidad</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray);">
                Cualquier cambio que realicemos en nuestra política de privacidad en el futuro se publicará en esta página y, cuando corresponda, se te notificará por correo electrónico.
            </p>
        </div>
    </div>
</section>
@endsection
