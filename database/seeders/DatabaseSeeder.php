<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;
public function run(): void
{
    // Clear all roles and permissions cache
    app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

    // Run seeders
    $this->call([
        RolesAndPermissionsSeeder::class,
        TestUsersSeeder::class,
        BlogPostSeeder::class,
        CompanySeeder::class,
        CompanyFullSeeder::class,

    ]);

    // Create test users if not in production
    if (!app()->environment('production')) {
        // Create regular users
        $users = \App\Models\User::factory(5)->create();
        
        // Assign 'usuario' role to new users if they don't have any roles
        foreach ($users as $user) {
            if ($user->roles->isEmpty()) {
                $user->assignRole('usuario');
                $user->update(['trial_ends_at' => now()->addDays(15)]);
            }
        }
    }
}
}
