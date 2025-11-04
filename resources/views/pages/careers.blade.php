@extends('layouts.app')

@section('title', 'Trabaja con Nosotros - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <h1 class="mb-4">Trabaja con Nosotros</h1>
            <p class="lead">Únete a nuestro equipo y ayúdanos a transformar la forma en que las empresas acceden a información financiera.</p>
            
            <div class="mt-5">
                <h2 class="mb-4">Ofertas de Trabajo</h2>
                
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="h4">Desarrollador Full Stack</h3>
                        <p class="text-muted">Tiempo completo · Remoto</p>
                        <p>Buscamos un/a desarrollador/a Full Stack con experiencia en Laravel y Vue.js para unirse a nuestro equipo de desarrollo.</p>
                        <h5 class="mt-3">Requisitos:</h5>
                        <ul>
                            <li>Experiencia demostrable con Laravel y Vue.js</li>
                            <li>Conocimientos de bases de datos SQL</li>
                            <li>Experiencia con APIs RESTful</li>
                            <li>Conocimientos de Git</li>
                        </ul>
                        <a href="{{ route('contact') }}?subject=Postulación%20Desarrollador%20Full%20Stack" class="btn btn-primary">Postularme</a>
                    </div>
                </div>
                
                <div class="card mb-4">
                    <div class="card-body">
                        <h3 class="h4">Analista de Datos</h3>
                        <p class="text-muted">Tiempo completo · Presencial en Madrid</p>
                        <p>Buscamos un/a analista de datos para procesar y analizar información financiera de empresas.</p>
                        <h5 class="mt-3">Requisitos:</h5>
                        <ul>
                            <li>Experiencia en análisis de datos financieros</li>
                            <li>Conocimientos de Excel avanzado</li>
                            <li>Conocimientos básicos de SQL</li>
                            <li>Atención al detalle</li>
                        </ul>
                        <a href="{{ route('contact') }}?subject=Postulación%20Analista%20de%20Datos" class="btn btn-primary">Postularme</a>
                    </div>
                </div>
                
                <div class="card">
                    <div class="card-body">
                        <h3 class="h4">Diseñador UX/UI</h3>
                        <p class="text-muted">Tiempo completo · Híbrido</p>
                        <p>Buscamos un/a diseñador/a UX/UI para mejorar la experiencia de usuario de nuestra plataforma.</p>
                        <h5 class="mt-3">Requisitos:</h5>
                        <ul>
                            <li>Portafolio que demuestre experiencia en diseño de interfaces</li>
                            <li>Conocimientos de herramientas como Figma o Adobe XD</li>
                            <li>Experiencia en diseño responsivo</li>
                            <li>Conocimientos básicos de HTML/CSS</li>
                        </ul>
                        <a href="{{ route('contact') }}?subject=Postulación%20Diseñador%20UX/UI" class="btn btn-primary">Postularme</a>
                    </div>
                </div>
            </div>
            
            <div class="mt-5 p-4 bg-light rounded">
                <h3 class="h4">¿No encuentras el puesto que buscas?</h3>
                <p>Envíanos tu CV y cuéntanos por qué te gustaría unirte a nuestro equipo. ¡Puede que tengamos algo para ti en el futuro!</p>
                <a href="{{ route('contact') }}?subject=Envio%20de%20CV" class="btn btn-outline-primary">Enviar CV</a>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
        margin-bottom: 1.5rem;
    }
    
    .card:hover {
        transform: translateY(-3px);
        box-shadow: 0 5px 20px rgba(0,0,0,0.15);
    }
    
    .btn {
        padding: 0.5rem 1.5rem;
        font-weight: 500;
    }
    
    h1, h2, h3, h4, h5, h6 {
        font-family: 'Space Grotesk', sans-serif;
        font-weight: 700;
    }
</style>
@endpush

@endsection
