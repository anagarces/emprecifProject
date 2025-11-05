@extends('layouts.app')

@section('title', 'Términos y Condiciones | EmpreciF')
@section('description', 'Términos y condiciones de uso del sitio web y servicios de EmpreciF.')

@push('head')
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700;800;900&display=swap" rel="stylesheet">
@endpush

@section('content')
<section>
    <div class="section-header" style="text-align: center; padding: 4rem 2rem; background: linear-gradient(135deg, #f5f7ff 0%, #f0f4ff 100%);">
        <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 3rem; font-weight: 900; margin-bottom: 1.5rem;">
            Términos y Condiciones
        </h1>
        <p style="font-size: 1.125rem; color: var(--gray); max-width: 800px; margin: 0 auto; line-height: 1.7;">
            Por favor, lee detenidamente estos términos y condiciones antes de utilizar nuestro sitio web y servicios.
        </p>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 4rem 2rem;">
        <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); margin-bottom: 3rem;">
            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.75rem; font-weight: 800; margin-bottom: 1.5rem; color: var(--dark);">1. Aceptación de los Términos</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 2rem;">
                Al acceder y utilizar el sitio web de EmpreciF, aceptas estar sujeto a estos Términos y Condiciones de Uso, todas las leyes y regulaciones aplicables, y aceptas que eres responsable del cumplimiento de las leyes locales aplicables. Si no estás de acuerdo con alguno de estos términos, tienes prohibido usar o acceder a este sitio.
            </p>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">2. Uso de la Licencia</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 1rem;">
                Se otorga permiso para descargar temporalmente una copia de los materiales (información o software) en el sitio web de EmpreciF solo para visualización transitoria personal y no comercial. Esta es la concesión de una licencia, no una transferencia de título, y bajo esta licencia no puedes:
            </p>
            <ul style="list-style: disc; padding-left: 2rem; margin-bottom: 2rem; color: var(--gray); font-size: 1.125rem; line-height: 1.8;">
                <li>Modificar o copiar los materiales.</li>
                <li>Utilizar los materiales para ningún propósito comercial o para su exhibición pública.</li>
                <li>Intentar descompilar o aplicar ingeniería inversa a cualquier software contenido en el sitio web de EmpreciF.</li>
                <li>Eliminar los derechos de autor u otras notaciones de propiedad de los materiales.</li>
                <li>Transferir los materiales a otra persona o "reflejar" los materiales en cualquier otro servidor.</li>
            </ul>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">3. Cuentas de Usuario</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 1rem;">
                Al crear una cuenta en nuestro sitio, aceptas ser responsable de mantener la confidencialidad de tu cuenta y contraseña, y aceptas que eres responsable de toda la actividad que ocurra bajo tu cuenta. Te comprometes a notificarnos de inmediato cualquier uso no autorizado de tu cuenta o cualquier otra violación de seguridad.
            </p>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">4. Limitación de Responsabilidad</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 1rem;">
                En ningún caso EmpreciF o sus proveedores serán responsables por daños (incluidos, entre otros, daños por pérdida de datos o beneficio, o debido a la interrupción del negocio) que surjan del uso o la imposibilidad de utilizar los materiales en el sitio web de EmpreciF, incluso si EmpreciF o un representante autorizado de EmpreciF ha sido notificado oralmente o por escrito de la posibilidad de tales daños.
            </p>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">5. Precisión de los Materiales</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 1rem;">
                Los materiales que aparecen en el sitio web de EmpreciF podrían incluir errores técnicos, tipográficos o fotográficos. EmpreciF no garantiza que ninguno de los materiales en su sitio web sea preciso, completo o actual. EmpreciF puede realizar cambios en los materiales contenidos en su sitio web en cualquier momento sin previo aviso. Sin embargo, EmpreciF no se compromete a actualizar los materiales.
            </p>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">6. Enlaces</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 1rem;">
                EmpreciF no ha revisado todos los sitios vinculados a su sitio web y no es responsable del contenido de dichos sitios vinculados. La inclusión de cualquier enlace no implica aprobación por parte de EmpreciF del sitio. El uso de dichos sitios web vinculados es bajo el propio riesgo del usuario.
            </p>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">7. Modificaciones</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 1rem;">
                EmpreciF puede revisar estos términos de servicio para su sitio en cualquier momento sin previo aviso. Al usar este sitio web, aceptas estar sujeto a la versión actual de estos Términos y Condiciones de Uso.
            </p>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">8. Ley Aplicable</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray);">
                Estos términos y condiciones se rigen e interpretan de acuerdo con las leyes de España y te sometes irrevocablemente a la jurisdicción exclusiva de los tribunales en ese estado o ubicación.
            </p>
        </div>
    </div>
</section>
@endsection
