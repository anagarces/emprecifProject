@extends('layouts.app')

@section('title', 'Aviso Legal | EmpreciF')
@section('description', 'Aviso legal y condiciones de uso del sitio web de EmpreciF.')

@push('head')
    <link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;700;800;900&display=swap" rel="stylesheet">
@endpush

@section('content')
<section>
    <div class="section-header" style="text-align: center; padding: 4rem 2rem; background: linear-gradient(135deg, #f5f7ff 0%, #f0f4ff 100%);">
        <h1 style="font-family: 'Space Grotesk', sans-serif; font-size: 3rem; font-weight: 900; margin-bottom: 1.5rem;">
            Aviso Legal
        </h1>
        <p style="font-size: 1.125rem; color: var(--gray); max-width: 800px; margin: 0 auto; line-height: 1.7;">
            Información legal sobre las condiciones de uso del sitio web de EmpreciF y datos de la empresa.
        </p>
    </div>

    <div style="max-width: 1200px; margin: 0 auto; padding: 4rem 2rem;">
        <div style="background: white; padding: 3rem; border-radius: 20px; box-shadow: 0 10px 40px rgba(0,0,0,0.06); margin-bottom: 3rem;">
            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.75rem; font-weight: 800; margin-bottom: 1.5rem; color: var(--dark);">1. Datos Identificativos</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 2rem;">
                En cumplimiento con el artículo 10 de la Ley 34/2002, de 11 de julio, de Servicios de la Sociedad de la Información y Comercio Electrónico (LSSICE) se exponen los datos identificativos de la empresa.
            </p>
            
            <div style="background: #f8f9fa; padding: 1.5rem; border-radius: 10px; margin-bottom: 2rem;">
                <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 0.5rem;">
                    <strong>Denominación Social:</strong> APPYWEB SL
                </p>
                <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 0.5rem;">
                    <strong>Nombre Comercial:</strong> EmpreciF
                </p>
                <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 0.5rem;">
                    <strong>CIF:</strong> B02720803
                </p>
                <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 0.5rem;">
                    <strong>Domicilio Social:</strong> Calle Ejemplo, 123, 03001, Alicante, España
                </p>
                <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 0.5rem;">
                    <strong>Teléfono:</strong> +34 965 123 456
                </p>
                <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray);">
                    <strong>Email:</strong> info@emprecif.com
                </p>
            </div>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">2. Propiedad Intelectual e Industrial</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 1rem;">
                Los derechos de propiedad intelectual de esta web, su código fuente, diseño, estructuras de navegación y los distintos elementos en ella contenidos son titularidad de APPYWEB SL, a quien corresponde el ejercicio exclusivo de los derechos de explotación de los mismos en cualquier forma y, en especial, los derechos de reproducción, distribución, comunicación pública y transformación.
            </p>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 2rem;">
                Queda terminantemente prohibida la reproducción total o parcial de los contenidos de esta web sin el consentimiento expreso y por escrito de su titular. El acceso al sitio web no presupone la adquisición por parte de los usuarios de derecho de propiedad alguno sobre los contenidos que figuren en el mismo.
            </p>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">3. Condiciones de Uso</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 1rem;">
                El acceso y uso de este sitio web atribuye la condición de USUARIO, que acepta, desde dicho acceso y/o uso, las presentes condiciones de uso, rigiéndose en cada caso por la legislación vigente en cada momento que le sea de aplicación.
            </p>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 2rem;">
                El USUARIO se compromete a hacer un uso adecuado de los contenidos que ofrece EmpreciF a través de su portal y con carácter enunciativo pero no limitativo, a no emplearlos para (i) incurrir en actividades ilícitas, ilegales o contrarias a la buena fe y al orden público; (ii) difundir contenidos o propaganda de carácter racista, xenófobo, pornográfico-ilegal, de apología del terrorismo o atentatorio contra los derechos humanos; (iii) provocar daños en los sistemas físicos y lógicos de EmpreciF, de sus proveedores o de terceras personas, introducir o difundir en la red virus informáticos o cualesquiera otros sistemas físicos o lógicos que sean susceptibles de provocar los daños anteriormente mencionados.
            </p>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">4. Responsabilidad</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 1rem;">
                EmpreciF no se hace responsable, en ningún caso, de los daños y perjuicios de cualquier naturaleza que pudieran ocasionar, a título enunciativo: errores u omisiones en los contenidos, falta de disponibilidad del portal o la transmisión de virus o programas maliciosos o lesivos en los contenidos, a pesar de haber adoptado todas las medidas tecnológicas necesarias para evitarlo.
            </p>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 2rem;">
                Los enlaces contenidos en esta web pueden dirigir a contenidos de terceros sitios web. EmpreciF no se hace responsable del contenido, informaciones o prácticas de privacidad de dichos sitios web.
            </p>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">5. Protección de Datos</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 1rem;">
                En cumplimiento de lo dispuesto en la normativa vigente en materia de Protección de Datos de Carácter Personal, se informa que los datos personales recabados a través de los formularios del sitio web se incorporarán a un fichero titularidad de APPYWEB SL, con la finalidad de atender su solicitud y mantenerle informado sobre nuestros servicios.
            </p>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray); margin-bottom: 2rem;">
                Podrá ejercer sus derechos de acceso, rectificación, cancelación y oposición mediante escrito dirigido a la dirección postal o electrónica indicada en el apartado de Datos Identificativos de este Aviso Legal, adjuntando copia de su DNI o documento identificativo equivalente.
            </p>

            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 1.5rem; font-weight: 800; margin: 2.5rem 0 1rem; color: var(--dark);">6. Ley Aplicable y Jurisdicción</h2>
            <p style="font-size: 1.125rem; line-height: 1.8; color: var(--gray);">
                La relación entre EmpreciF y el USUARIO se regirá por la normativa española vigente y cualquier controversia se someterá a los Juzgados y Tribunales de la ciudad de Alicante, salvo que la Ley aplicable disponga otra cosa.
            </p>
        </div>
    </div>
</section>
@endsection
