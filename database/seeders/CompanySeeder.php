<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;
use App\Models\CompanyDirector;
use App\Models\CompanyShareholder;
use App\Models\CompanyEvent;
use App\Models\CompanyAccount;

class CompanySeeder extends Seeder
{
    public function run(): void
    {
        // Evitar duplicados si ya existe
        $company = Company::firstOrCreate(
            ['slug' => 'tecnologia-avanzada-sl'],
            [
                'name' => 'TECNOLOGÍA AVANZADA SL',
                'cif' => 'A12345678',
                'legal_name' => 'TECNOLOGÍA AVANZADA SOCIEDAD LIMITADA',
                'description' => 'Empresa dedicada a soluciones tecnológicas avanzadas.',
                'sector' => 'Tecnología',
                'cnae' => '6201 - Programación informática',
                'forma_juridica' => 'Sociedad Limitada',
                'capital_social' => 100000,
                'website' => 'https://tecnologia-avanzada.example.com',
                'email' => 'info@tecnologia-avanzada.com',
                'phone' => '934567890',
                'address' => 'Calle Balmes 123',
                'city' => 'Barcelona',
                'province' => 'Barcelona',
                'postal_code' => '08008',
                'country' => 'España',
                'employees' => 24,
                'revenue' => 2450000,
                'profit' => 347000,
                'founded_at' => '2010-03-15 00:00:00',
                'is_active' => true,
            ]
        );

        // ADMINISTRADORES
        if ($company->directors()->count() === 0) {
            CompanyDirector::create([
                'company_id' => $company->id,
                'nombre' => 'Juan García Martínez',
                'cargo' => 'Administrador Único',
                'fecha_nombramiento' => '2018-01-10',
            ]);
        }

        // SOCIOS
        if ($company->shareholdersRelation()->count() === 0) {
            CompanyShareholder::create([
                'company_id' => $company->id,
                'nombre' => 'Juan García Martínez',
                'porcentaje' => 100,
            ]);
        }

        // CUENTAS ANUALES
        if ($company->accounts()->count() === 0) {
            CompanyAccount::insert([
                [
                    'company_id' => $company->id,
                    'ejercicio' => 2024,
                    'facturacion' => 2450000,
                    'resultado_neto' => 347000,
                    'empleados' => 24,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'company_id' => $company->id,
                    'ejercicio' => 2023,
                    'facturacion' => 1980000,
                    'resultado_neto' => 210000,
                    'empleados' => 19,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }

        // ACTOS BORME
        if ($company->events()->count() === 0) {
            CompanyEvent::insert([
                [
                    'company_id' => $company->id,
                    'fecha' => '2024-10-24',
                    'tipo' => 'Depósito de Cuentas Anuales 2024',
                    'descripcion' => 'Depósito de cuentas anuales correspondientes al ejercicio 2024.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'company_id' => $company->id,
                    'fecha' => '2018-01-10',
                    'tipo' => 'Nombramiento de Administrador Único',
                    'descripcion' => 'Nombramiento de Juan García Martínez como Administrador Único.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);
        }
    }
}

