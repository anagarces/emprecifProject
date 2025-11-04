@extends('layouts.app')

@section('title', 'Nuestro Equipo - ' . config('app.name'))

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <h1 class="mb-4">Nuestro Equipo</h1>
            <p class="lead">Conoce al equipo detrás de EmpreciF</p>
            
            <div class="row mt-5">
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <div class="avatar-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <h5 class="card-title">Ana García</h5>
                            <p class="text-muted">CEO & Fundadora</p>
                            <p class="card-text">Experta en análisis de datos empresariales con más de 10 años de experiencia en el sector.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <div class="avatar-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <h5 class="card-title">Carlos Méndez</h5>
                            <p class="text-muted">CTO</p>
                            <p class="card-text">Especialista en desarrollo de software y arquitectura de sistemas.</p>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        <div class="card-body text-center">
                            <div class="mb-3">
                                <div class="avatar-placeholder">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <h5 class="card-title">Laura Torres</h5>
                            <p class="text-muted">Diseñadora UX/UI</p>
                            <p class="card-text">Apasionada por crear experiencias de usuario intuitivas y atractivas.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="mt-5">
                <h2 class="mb-4">¿Quieres unirte a nuestro equipo?</h2>
                <p>Estamos buscando talento apasionado por los datos y la tecnología. Consulta nuestras <a href="{{ route('careers') }}">ofertas de trabajo</a>.</p>
            </div>
        </div>
    </div>
</div>

@push('styles')
<style>
    .avatar-placeholder {
        width: 120px;
        height: 120px;
        margin: 0 auto;
        border-radius: 50%;
        background-color: #f0f0f0;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        color: #666;
    }
    
    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        box-shadow: 0 2px 15px rgba(0,0,0,0.1);
    }
    
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.15);
    }
</style>
@endpush

@endsection
