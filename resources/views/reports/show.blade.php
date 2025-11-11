@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h4 class="mb-0">Informe de Empresa</h4>
                </div>
                <div class="card-body">
                    <div class="row mb-4">
                        <div class="col-md-8">
                            <h2>{{ $company->name }}</h2>
                            <p class="text-muted mb-1">CIF: {{ $company->cif }}</p>
                            <p class="text-muted">Sector: {{ $company->sector ?? 'No especificado' }}</p>
                        </div>
                        <div class="col-md-4 text-md-end">
                            <a href="{{ route('reports.download', $company->slug) }}" class="btn btn-primary">
                                <i class="fas fa-download me-2"></i>Descargar Informe
                            </a>
                        </div>
                    </div>

                    <div class="report-content">
                        <div class="alert alert-info">
                            <i class="fas fa-info-circle me-2"></i>
                            Este es un informe simulado. En la versión real, aquí se mostrarían los datos completos de la empresa.
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Información Básica</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Nombre:</strong> {{ $company->name }}</p>
                                        <p><strong>CIF:</strong> {{ $company->cif }}</p>
                                        <p><strong>Domicilio:</strong> {{ $company->address ?? 'No disponible' }}</p>
                                        <p><strong>Código Postal:</strong> {{ $company->postal_code ?? 'No disponible' }}</p>
                                        <p><strong>Localidad:</strong> {{ $company->city ?? 'No disponible' }}</p>
                                        <p><strong>Provincia:</strong> {{ $company->province ?? 'No disponible' }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card mb-4">
                                    <div class="card-header bg-light">
                                        <h5 class="mb-0">Datos Económicos</h5>
                                    </div>
                                    <div class="card-body">
                                        <p><strong>Facturación Anual:</strong> {{ $company->annual_turnover ?? 'No disponible' }} €</p>
                                        <p><strong>Resultado Neto:</strong> {{ $company->net_profit ?? 'No disponible' }} €</p>
                                        <p><strong>Empleados:</strong> {{ $company->employees ?? 'No disponible' }}</p>
                                        <p><strong>Fecha Constitución:</strong> {{ $company->founded_at ? $company->founded_at->format('d/m/Y') : 'No disponible' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header bg-light">
                                <h5 class="mb-0">Análisis de Riesgo</h5>
                            </div>
                            <div class="card-body">
                                <div class="progress mb-3" style="height: 30px;">
                                    <div class="progress-bar bg-success" role="progressbar" style="width: 75%;" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100">75% Bajo Riesgo</div>
                                </div>
                                <p class="mb-0">
                                    <i class="fas fa-check-circle text-success me-2"></i>
                                    La empresa muestra un perfil de riesgo bajo según nuestro análisis.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between align-items-center">
                        <small class="text-muted">Informe generado el {{ now()->format('d/m/Y H:i:s') }}</small>
                        <a href="{{ route('reports.download', $company->slug) }}" class="btn btn-outline-primary btn-sm">
                            <i class="fas fa-download me-1"></i> Descargar PDF
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
