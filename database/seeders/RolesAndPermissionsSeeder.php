<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
        $permissions = [
            'view dashboard',
            'view admin panel',
            'manage users',
            'manage roles',
            'access premium content',
            'view public content',
        ];

        foreach ($permissions as $permission) {
            Permission::firstOrCreate(['name' => $permission, 'guard_name' => 'web']);
        }

        // Create roles if they don't exist
        $roles = [
            'admin' => [
                'permissions' => Permission::pluck('name')->toArray(),
                'description' => 'Administrator with full access',
            ],
            'premium' => [
                'permissions' => ['access premium content', 'view public content'],
                'description' => 'Premium subscriber with access to premium content',
            ],
            'usuario' => [
                'permissions' => ['view public content'],
                'description' => 'Regular user with basic access',
            ],
        ];

        foreach ($roles as $name => $data) {
            // Create or update role
            $role = Role::firstOrCreate(
                ['name' => $name],
                [
                    'guard_name' => 'web',
                    'description' => $data['description']
                ]
            );
            
            // Sync permissions for the role
            $role->syncPermissions($data['permissions']);
        }

        // Get all users
        $users = User::all();
        
        // Assign roles to users
        foreach ($users as $user) {
            // User with ID 1 is always admin
            if ($user->id === 1) {
                if (!$user->hasRole('admin')) {
                    $user->syncRoles(['admin']);
                }
                continue;
            }
            
            // If user has no roles, assign 'usuario' role
            if ($user->roles->isEmpty()) {
                $user->assignRole('usuario');
            }
            
            // Note: Existing roles (including 'premium') are preserved
        }
        
        // Create a test premium user if it doesn't exist (for testing purposes)
        if (!User::where('email', 'premium@example.com')->exists()) {
            $premiumUser = User::create([
                'name' => 'Premium User',
                'email' => 'premium@example.com',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]);
            $premiumUser->assignRole('premium');
        }
    }
}
