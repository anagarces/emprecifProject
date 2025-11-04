@extends('layouts.app')

@section('title', 'Características - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="display-4 fw-bold mb-3">Características Principales</h1>
        <p class="lead text-muted">Descubre todo lo que nuestra plataforma puede ofrecerte para potenciar tu negocio</p>
    </div>
    
    <div class="row g-4 mb-5">
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-search-dollar fa-2x text-primary"></i>
                    </div>
                    <h3 class="h4">Búsqueda Avanzada</h3>
                    <p class="text-muted">Encuentra empresas por nombre, sector, ubicación y múltiples criterios financieros con nuestro potente motor de búsqueda.</p>
                    <ul class="feature-list">
                        <li>Búsqueda por nombre o CIF</li>
                        <li>Filtros avanzados por sector y ubicación</li>
                        <li>Búsqueda guardada con alertas</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-chart-line fa-2x text-primary"></i>
                    </div>
                    <h3 class="h4">Análisis Financiero</h3>
                    <p class="text-muted">Accede a informes financieros detallados con análisis de ratios, tendencias y comparativas del sector.</p>
                    <ul class="feature-list">
                        <li>Estados financieros completos</li>
                        <li>Ratios financieros clave</li>
                        <li>Evolución histórica</li>
                        <li>Comparativa con el sector</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-bell fa-2x text-primary"></i>
                    </div>
                    <h3 class="h4">Alertas Personalizadas</h3>
                    <p class="text-muted">Mantente informado con alertas personalizadas sobre cambios en las empresas que te interesan.</p>
                    <ul class="feature-list">
                        <li>Alertas por cambios financieros</li>
                        <li>Notificaciones de concursos y quiebras</li>
                        <li>Alertas personalizables</li>
                        <li>Envío por email o notificación en la app</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="row g-4 mb-5">
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-file-export fa-2x text-primary"></i>
                    </div>
                    <h3 class="h4">Exportación de Datos</h3>
                    <p class="text-muted">Exporta los datos que necesites en múltiples formatos para su análisis en otras herramientas.</p>
                    <ul class="feature-list">
                        <li>Exportación a Excel, CSV y PDF</li>
                        <li>Informes personalizables</li>
                        <li>Programación de informes recurrentes</li>
                    </ul>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card h-100 border-0 shadow-sm">
                <div class="card-body p-4">
                    <div class="feature-icon mb-4">
                        <i class="fas fa-shield-alt fa-2x text-primary"></i>
                    </div>
                    <h3 class="h4">Seguridad Avanzada</h3>
                    <p class="text-muted">Tus datos están seguros con nosotros gracias a las más avanzadas medidas de seguridad.</p>
                    <ul class="feature-list">
                        <li>Cifrado de extremo a extremo</li>
                        <li>Autenticación de dos factores</li>
                        <li>Cumplimiento RGPD</li>
                        <li>Copias de seguridad diarias</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
    <div class="text-center mt-5 pt-5">
        <h2 class="mb-4">¿Listo para comenzar?</h2>
        <p class="lead mb-4">Descubre todo lo que nuestra plataforma puede ofrecer a tu negocio.</p>
        <a href="{{ route('pricing') }}" class="btn btn-primary btn-lg px-4">Ver Planes y Precios</a>
    </div>
</div>

@push('styles')
<style>
    .feature-icon {
        width: 64px;
        height: 64px;
        background: rgba(59, 130, 246, 0.1);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    
    .feature-list {
        list-style: none;
        padding-left: 0;
    }
    
    .feature-list li {
        position: relative;
        padding-left: 1.75rem;
        margin-bottom: 0.5rem;
    }
    
    .feature-list li:before {
        content: '✓';
        position: absolute;
        left: 0;
        color: #3B82F6;
        font-weight: bold;
    }
    
    .card {
        transition: all 0.3s ease;
        border-radius: 12px;
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1) !important;
    }
    
    .btn-primary {
        background-color: #3B82F6;
        border-color: #3B82F6;
        padding: 0.75rem 2rem;
        font-weight: 600;
        border-radius: 8px;
    }
    
    .btn-primary:hover {
        background-color: #2563EB;
        border-color: #2563EB;
    }
    
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
    }
</style>
@endpush

@endsection
