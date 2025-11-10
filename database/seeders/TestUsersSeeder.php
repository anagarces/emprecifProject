<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Carbon\Carbon;

class TestUsersSeeder extends Seeder
{
    public function run()
    {
        // Crear roles si no existen
        $adminRole   = Role::firstOrCreate(['name' => 'admin', 'guard_name' => 'web']);
        $premiumRole = Role::firstOrCreate(['name' => 'premium', 'guard_name' => 'web']);
        $userRole    = Role::firstOrCreate(['name' => 'usuario', 'guard_name' => 'web']);

        // ================================
        // ADMIN
        // ================================
        $admin = User::updateOrCreate(
            ['email' => 'admin@emprecif.com'],
            [
                'name' => 'Admin User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'trial_ends_at' => null,
            ]
        );
        $admin->syncRoles([$adminRole]);

        // ================================
        // PREMIUM
        // ================================
        $premium = User::updateOrCreate(
            ['email' => 'premium@emprecif.com'],
            [
                'name' => 'Premium User',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'trial_ends_at' => null,
            ]
        );
        $premium->syncRoles([$premiumRole]);

        // Crear suscripción activa para el usuario Premium
        $premiumPlan = Plan::where('name', 'Premium')->first();

        if ($premiumPlan) {
            Subscription::updateOrCreate(
                ['user_id' => $premium->id, 'plan_id' => $premiumPlan->id],
                [
                    'starts_at' => now(),
                    'ends_at' => Carbon::now()->addMonth(), // activa por 1 mes
                ]
            );
        }

        // ================================
        // USUARIO BÁSICO (Trial)
        // ================================
        $user = User::updateOrCreate(
            ['email' => 'usuario@emprecif.com'],
            [
                'name' => 'Usuario Básico',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'trial_ends_at' => now()->addDays(15), // 15 días de prueba
            ]
        );
        $user->syncRoles([$userRole]);
    }
}
