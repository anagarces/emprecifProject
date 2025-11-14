@extends('layouts.app')

@section('title', 'EmpreciF | Consultar Datos de Empresas Españolas Gratis - Información Empresarial del BORME 2025')

@push('head')
    {{-- SEO --}}
    <meta name="description" content="Consulta GRATIS información de más de 3.2M empresas españolas: NIF, CIF, administradores, cuentas anuales, facturación. Datos oficiales del BORME actualizados diariamente.">
    <meta name="keywords" content="consultar empresa por nif, buscar empresa por cif, datos empresas españa, información empresarial, borme empresas, cuentas anuales empresas, facturación empresa">

    {{-- Open Graph --}}
    <meta property="og:title" content="EmpreciF - Información Empresarial Oficial de España">
    <meta property="og:description" content="Consulta datos de más de 3.2 millones de empresas españolas. Información oficial del BORME actualizada diariamente.">

    {{-- JSON-LD ORGANIZATION --}}
    <script type="application/ld+json">
    @verbatim
    {
      "@context": "https://schema.org",
      "@type": "Organization",
      "name": "EmpreciF",
      "url": "https://emprecif.com",
      "logo": "https://emprecif.com/images/logo_emprecif_wordmark.png",
      "description": "Plataforma líder de información empresarial en España con datos oficiales del BORME",
      "address": {
        "@type": "PostalAddress",
        "streetAddress": "Calle Mestre Laporta, Nº 2, 1º piso, puerta 2",
        "addressLocality": "Alcoy",
        "addressRegion": "Alicante",
        "postalCode": "03801",
        "addressCountry": "ES"
      },
      "contactPoint": {
        "@type": "ContactPoint",
        "telephone": "+34-658-17-08-09",
        "contactType": "customer service",
        "email": "[email protected]"
      }
    }
    @endverbatim
    </script>

    {{-- JSON-LD WEBSITE --}}
    <script type="application/ld+json">
    @verbatim
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "EmpreciF",
      "url": "https://emprecif.com",
      "potentialAction": {
        "@type": "SearchAction",
        "target": "https://emprecif.com/buscar?q={search_term_string}",
        "query-input": "required name=search_term_string"
      }
    }
    @endverbatim
    </script>
@endpush

@section('content')



    {{-- HERO SECTION --}}
    <div class="hero">
        <div class="hero-content">
            <h1>La Radiografía Financiera de Cualquier Empresa Española en Tiempo Real</h1>

            <p class="subtitle">
                Accede a información oficial de <strong>más de 3.2 millones de empresas</strong> españolas:
                NIF, CIF, administradores, cuentas anuales, facturación y actos del BORME.
                Datos verificados del Registro Mercantil actualizados diariamente.
            </p>

            {{-- SEARCH BOX --}}
        <form action="{{ route('company.search') }}" method="GET" class="search-box">

                <input 
                    type="text"
                    name="q"
                    placeholder="Busca por nombre de empresa, NIF/CIF o administrador..."
                    aria-label="Buscar empresa"
                    required
                >
                <button type="submit">🔍 Buscar Ahora</button>
            </form>

            {{-- TRUST BADGES --}}
            <div class="trust-badges">
                <div class="trust-badge">
                    <span style="color:#F59E0B;">⭐⭐⭐⭐⭐</span>
                    <span><strong>4.9/5</strong> en 2.847 reseñas</span>
                </div>
                <div class="trust-badge">
                    <span style="color:#10B981;">✓</span>
                    <span>Sin tarjeta de crédito</span>
                </div>
                <div class="trust-badge">
                    <span style="color:#10B981;">✓</span>
                    <span>Datos oficiales BORME</span>
                </div>
                <div class="trust-badge">
                    <span style="color:#10B981;">✓</span>
                    <span>Actualización diaria</span>
                </div>
            </div>
        </div>

        {{-- DASHBOARD PREVIEW --}}
        <div class="dashboard-preview">
            <div class="dashboard-header">
                <div class="company-info">
                    <h3>TECNOLOGÍA AVANZADA SL</h3>
                    <p>NIF: A12345678 • Barcelona</p>
                </div>
                <div class="status-badge">✓ ACTIVA</div>
            </div>

            <div class="metrics-grid">
                <div class="metric-card">
                    <div class="metric-label">Facturación 2024</div>
                    <div class="metric-value">2.4M €</div>
                </div>
                <div class="metric-card secondary">
                    <div class="metric-label">Resultado Neto</div>
                    <div class="metric-value">+347K €</div>
                </div>
            </div>
        </div>
    </div>

    {{-- FEATURES SECTION --}}
    <section>
        <div class="section-header">
            <h2>¿Qué Información Empresarial Puedes Consultar en EmpreciF?</h2>
            <p>
                Accede a la base de datos más completa de información empresarial de España.
                Datos oficiales del BORME (Boletín Oficial del Registro Mercantil) actualizados diariamente desde 2009.
            </p>
        </div>

        <div class="features-grid">
            {{-- Datos Mercantiles --}}
            <div class="feature-card">
                <div class="feature-icon">🏢</div>
                <h3>Datos Mercantiles Completos</h3>
                <p>
                    Consulta toda la información mercantil oficial de cualquier empresa española registrada en el Registro Mercantil.
                </p>
                <ul class="feature-list">
                    <li>NIF/CIF y razón social completa</li>
                    <li>Domicilio social y sede real</li>
                    <li>Capital social y participaciones</li>
                    <li>Forma jurídica (SL, SA, SLU, etc.)</li>
                    <li>CNAE y objeto social</li>
                    <li>Fecha de constitución</li>
                    <li>Estado actual (activa, disuelta, concurso)</li>
                    <li>Registro Mercantil de inscripción</li>
                </ul>
            </div>

            {{-- Administradores --}}
            <div class="feature-card">
                <div class="feature-icon">👥</div>
                <h3>Administradores y Cargos</h3>
                <p>
                    Identifica quién dirige realmente cada empresa. Histórico completo de nombramientos, ceses y poderes notariales.
                </p>
                <ul class="feature-list">
                    <li>Administradores actuales y pasados</li>
                    <li>Tipo de cargo (único, solidario, mancomunado)</li>
                    <li>Fecha de nombramiento y cese</li>
                    <li>Poderes y facultades</li>
                    <li>Vinculaciones empresariales</li>
                    <li>Historial de cargos en otras empresas</li>
                    <li>Red de contactos empresariales</li>
                </ul>
            </div>

            {{-- Finanzas --}}
            <div class="feature-card">
                <div class="feature-icon">💰</div>
                <h3>Cuentas Anuales y Finanzas</h3>
                <p>
                    Analiza la salud financiera real de cualquier empresa. Balances, resultados y evolución de los últimos 15 años.
                </p>
                <ul class="feature-list">
                    <li>Cifra de negocios (facturación)</li>
                    <li>Resultado del ejercicio (beneficios/pérdidas)</li>
                    <li>Activo total y patrimonio neto</li>
                    <li>Pasivo y nivel de endeudamiento</li>
                    <li>Fondos propios</li>
                    <li>Número de empleados</li>
                    <li>Evolución financiera histórica</li>
                    <li>Ratios financieros clave</li>
                </ul>
            </div>

            {{-- Actos BORME --}}
            <div class="feature-card">
                <div class="feature-icon">📋</div>
                <h3>Actos del BORME</h3>
                <p>
                    Todos los actos registrales publicados en el Boletín Oficial del Registro Mercantil desde 2009 hasta hoy.
                </p>
                <ul class="feature-list">
                    <li>Constituciones de sociedades</li>
                    <li>Nombramientos y ceses</li>
                    <li>Ampliaciones de capital</li>
                    <li>Reducciones de capital</li>
                    <li>Fusiones y escisiones</li>
                    <li>Disoluciones y liquidaciones</li>
                    <li>Concursos de acreedores</li>
                    <li>Cambios de domicilio social</li>
                </ul>
            </div>

            {{-- Informes PDF --}}
            <div class="feature-card">
                <div class="feature-icon">⚡</div>
                <h3>Informes Profesionales PDF</h3>
                <p>
                    Genera informes de due diligence en formato PDF en segundos. Listos para presentar a clientes, inversores o entidades financieras.
                </p>
                <ul class="feature-list">
                    <li>Formato profesional y corporativo</li>
                    <li>Descarga instantánea</li>
                    <li>Datos verificados y actualizados</li>
                    <li>Gráficos de evolución financiera</li>
                    <li>Análisis de riesgo incluido</li>
                    <li>Exportación ilimitada (Premium)</li>
                </ul>
            </div>

            {{-- Alertas --}}
            <div class="feature-card">
                <div class="feature-icon">🔔</div>
                <h3>Alertas Automáticas</h3>
                <p>
                    Monitoriza empresas clave y recibe notificaciones instantáneas cuando haya cambios críticos en el Registro Mercantil.
                </p>
                <ul class="feature-list">
                    <li>Cambios de administradores</li>
                    <li>Nuevas cuentas anuales depositadas</li>
                    <li>Concursos de acreedores</li>
                    <li>Ampliaciones/reducciones de capital</li>
                    <li>Cambios de domicilio social</li>
                    <li>Disoluciones y liquidaciones</li>
                    <li>Notificaciones por email y SMS</li>
                </ul>
            </div>
        </div>
    </section>

    {{-- STATS SECTION --}}
    <div class="stats-section">
        <div class="stats-grid">
            <div class="stat">
                <h3>3.2M+</h3>
                <p>Empresas en la Base de Datos</p>
            </div>
            <div class="stat">
                <h3>15</h3>
                <p>Años de Histórico del BORME</p>
            </div>
            <div class="stat">
                <h3>50K+</h3>
                <p>Profesionales Confían en Nosotros</p>
            </div>
            <div class="stat">
                <h3>24h</h3>
                <p>Actualización Diaria Garantizada</p>
            </div>
        </div>
    </div>

    {{-- USE CASES --}}
    <section>
        <div class="section-header">
            <h2>¿Para Qué Sirve Consultar Información Empresarial?</h2>
            <p>
                Profesionales de todos los sectores utilizan EmpreciF para tomar decisiones informadas y proteger sus intereses económicos.
            </p>
        </div>

        <div class="use-cases-grid">
            <div class="use-case">
                <h3><span class="use-case-icon">💼</span> Empresas y Comerciales</h3>
                <p>Verifica la solvencia de clientes y proveedores antes de cerrar operaciones comerciales importantes.</p>
            </div>
            <div class="use-case">
                <h3><span class="use-case-icon">⚖️</span> Abogados y Asesores</h3>
                <p>Accede a información oficial para due diligence, litigios y asesoramiento legal a clientes.</p>
            </div>
            <div class="use-case">
                <h3><span class="use-case-icon">🏦</span> Entidades Financieras</h3>
                <p>Evalúa el riesgo crediticio y la capacidad de pago de empresas solicitantes de financiación.</p>
            </div>
            <div class="use-case">
                <h3><span class="use-case-icon">📊</span> Inversores y Fondos</h3>
                <p>Investiga empresas objetivo antes de invertir. Analiza competidores y tendencias del mercado.</p>
            </div>
            <div class="use-case">
                <h3><span class="use-case-icon">🔍</span> Detectives e Investigadores</h3>
                <p>Obtén información oficial para investigaciones privadas, patrimoniales y corporativas.</p>
            </div>
            <div class="use-case">
                <h3><span class="use-case-icon">📰</span> Periodistas y Medios</h3>
                <p>Verifica datos empresariales para investigaciones periodísticas y reportajes económicos.</p>
            </div>
        </div>
    </section>

    {{-- SEO LONG CONTENT --}}
    <section style="background: white; border-radius: 30px; padding: 5rem 4rem; margin: 6rem 2rem;">
        <div style="max-width: 1200px; margin: 0 auto;">
            <h2 style="font-family: 'Space Grotesk', sans-serif; font-size: 3rem; font-weight: 900; margin-bottom: 2rem;">
                ¿Por Qué Consultar Datos de Empresas en EmpreciF?
            </h2>

            <div style="color: #64748B; line-height: 1.9; font-size: 1.125rem;">
                <p style="margin-bottom: 1.5rem;">
                    <strong>EmpreciF es la plataforma líder en España</strong> para consultar información empresarial oficial del BORME (Boletín Oficial del Registro Mercantil). Con más de <strong>3.2 millones de empresas</strong> en nuestra base de datos, ofrecemos acceso instantáneo a datos verificados y actualizados diariamente desde 2009.
                </p>

                <h3 style="font-size: 2rem; font-weight: 800; margin: 3rem 0 1.5rem;">
                    Información Empresarial Oficial y Verificada
                </h3>
                <p style="margin-bottom: 1.5rem;">
                    Todos los datos que ofrecemos provienen directamente del <strong>Registro Mercantil</strong> y del <strong>BORME oficial</strong>, garantizando la máxima fiabilidad y validez legal. Nuestros datos se actualizan <strong>automáticamente cada 24 horas</strong>, asegurando que siempre tengas acceso a la información más reciente.
                </p>

                <h3 style="font-size: 2rem; font-weight: 800; margin: 3rem 0 1.5rem;">
                    Consulta Empresas por NIF, CIF o Nombre
                </h3>
                <p style="margin-bottom: 1.5rem;">
                    Nuestro potente motor de búsqueda te permite <strong>buscar cualquier empresa española</strong> por su NIF, CIF, razón social o incluso por el nombre de sus administradores.
                </p>

                <h3 style="font-size: 2rem; font-weight: 800; margin: 3rem 0 1.5rem;">
                    Cuentas Anuales y Datos Financieros Completos
                </h3>
                <p style="margin-bottom: 1.5rem;">
                    Accede a las <strong>cuentas anuales depositadas</strong> en el Registro Mercantil de los últimos 15 años. Analiza facturación, resultados, activos, pasivos y evolución histórica.
                </p>

                <h3 style="font-size: 2rem; font-weight: 800; margin: 3rem 0 1.5rem;">
                    Administradores y Vinculaciones Empresariales
                </h3>
                <p style="margin-bottom: 1.5rem;">
                    Descubre <strong>quién está detrás de cada empresa</strong> y sus vínculos con otras sociedades.
                </p>

                <h3 style="font-size: 2rem; font-weight: 800; margin: 3rem 0 1.5rem;">
                    Actos del BORME en Tiempo Real
                </h3>
                <p style="margin-bottom: 1.5rem;">
                    Mantente informado de todas las publicaciones relevantes: constituciones, nombramientos, ampliaciones de capital, concursos de acreedores, etc.
                </p>

                <h3 style="font-size: 2rem; font-weight: 800; margin: 3rem 0 1.5rem;">
                    Alternativa Profesional a Infocif, Infoempresas y Axesor
                </h3>
                <p style="margin-bottom: 1.5rem;">
                    EmpreciF es la <strong>alternativa moderna y económica</strong> a plataformas tradicionales, con interfaz intuitiva y precios competitivos.
                </p>

                <h3 style="font-size: 2rem; font-weight: 800; margin: 3rem 0 1.5rem;">
                    Prueba Gratis Durante 14 Días
                </h3>
                <p style="margin-bottom: 1.5rem;">
                    Empieza a consultar información empresarial <strong>sin tarjeta de crédito</strong>. Prueba todas las funcionalidades Premium durante 14 días completamente gratis.
                </p>
            </div>
        </div>
    </section>

    {{-- CTA FINAL --}}
    <div class="cta-section">
        <h2>Empieza a Consultar Empresas Gratis Hoy Mismo</h2>
        <p>
            Únete a más de 50.000 profesionales que ya utilizan EmpreciF para tomar decisiones informadas. Prueba completa durante 14 días sin tarjeta de crédito.
        </p>

        <div class="cta-buttons">
            <a href="{{ route('register') }}" class="btn btn-primary btn-large">🚀 Crear Cuenta Gratis</a>
            <a href="{{ route('pricing') }}" class="btn btn-outline btn-large">Ver Planes y Precios</a>
        </div>

        <p style="margin-top: 2rem; font-size: 1rem; opacity: 0.8;">
            ✓ Sin permanencia • ✓ Cancela cuando quieras • ✓ Soporte 24/7 • ✓ Datos oficiales BORME
        </p>
    </div>
@endsection
