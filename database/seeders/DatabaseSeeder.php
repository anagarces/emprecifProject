<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Ejecutar los seeders necesarios
        $this->call([
            RolePermissionSeeder::class,
            BlogPostSeeder::class,
        ]);

        // Crear usuarios de prueba
        User::factory(10)->create();
    }
}
