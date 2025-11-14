<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\CompanyDirector;
use App\Models\CompanyShareholder;
use App\Models\CompanyEvent;
use App\Models\CompanyAccount;

class CompanyFullSeeder extends Seeder
{
    public function run(): void
    {
        // =====================================================
        // 1. EMPRESA BASE
        // =====================================================
        $company = Company::updateOrCreate(
            ['cif' => 'A12345678'],
            [
                'name' => 'TECNOLOGÍA AVANZADA SL',
                'slug' => 'tecnologia-avanzada-sl',
                'legal_name' => 'TECNOLOGÍA AVANZADA SL',
                'sector' => 'Tecnología',
                'website' => 'https://empresa-ejemplo.com',
                'email' => 'contacto@empresa-ejemplo.com',
                'phone' => '912345678',
                'address' => 'Calle Balmes 123',
                'city' => 'Barcelona',
                'province' => 'Barcelona',
                'postal_code' => '08008',
                'country' => 'España',
                'employees' => 24,
                'revenue' => 2450000,
                'profit' => 347000,
                'founded_at' => '2010-03-15',
                'is_active' => true,
            ]
        );

        // =====================================================
        // 2. DIRECTORES
        // =====================================================
        CompanyDirector::updateOrCreate(
            ['company_id' => $company->id, 'nombre' => 'Juan García Martínez'],
            [
                'cargo' => 'Administrador Único',
                'fecha_nombramiento' => '2018-01-10',
                'fecha_cese' => null,
            ]
        );

        // =====================================================
        // 3. SOCIOS / ACCIONISTAS
        // =====================================================
        CompanyShareholder::updateOrCreate(
            ['company_id' => $company->id, 'nombre' => 'Juan García Martínez'],
            [
                'porcentaje' => 100,
            ]
        );

        // =====================================================
        // 4. ACTOS REGISTRALES / BORME
        // =====================================================
        CompanyEvent::updateOrCreate(
            ['company_id' => $company->id, 'tipo' => 'Depósito de cuentas'],
            [
                'fecha' => '2024-10-24',
                'descripcion' => 'Depósito de Cuentas Anuales 2024',
                'borme_pdf' => null,
            ]
        );

        CompanyEvent::updateOrCreate(
            ['company_id' => $company->id, 'tipo' => 'Nombramiento'],
            [
                'fecha' => '2018-01-10',
                'descripcion' => 'Nombramiento de Administrador Único: Juan García Martínez',
                'borme_pdf' => null,
            ]
        );

        // =====================================================
        // 5. CUENTAS ANUALES
        // =====================================================
        CompanyAccount::updateOrCreate(
            ['company_id' => $company->id, 'ejercicio' => 2024],
            [
                'facturacion' => 2450000,
                'resultado_neto' => 347000,
                'empleados' => 24,
            ]
        );

        CompanyAccount::updateOrCreate(
            ['company_id' => $company->id, 'ejercicio' => 2023],
            [
                'facturacion' => 1980000,
                'resultado_neto' => 210000,
                'empleados' => 19,
            ]
        );
    }
}
