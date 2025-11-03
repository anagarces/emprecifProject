<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Crear permisos
        $permissions = [
            'ver empresas',
            'crear empresas',
            'editar empresas',
            'eliminar empresas',
            'ver informes',
            'generar informes',
            'ver usuarios',
            'crear usuarios',
            'editar usuarios',
            'eliminar usuarios',
            'gestionar roles',
            'gestionar permisos',
            'ver dashboard',
            'ver pagos',
            'gestionar suscripciones',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Crear roles y asignar permisos
        $admin = Role::create(['name' => 'admin']);
        $admin->givePermissionTo(Permission::all());

        $user = Role::create(['name' => 'usuario']);
        $user->givePermissionTo([
            'ver empresas',
            'ver informes',
            'generar informes',
            'ver dashboard',
        ]);

        // Crear usuario administrador
        $adminUser = \App\Models\User::factory()->create([
            'name' => 'Administrador',
            'email' => 'admin@emprecif.test',
            'password' => bcrypt('password'),
        ]);

        $adminUser->assignRole('admin');
    }
}
