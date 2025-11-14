<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Laravel\Cashier\Subscription;

class TestUsersSeeder extends Seeder
{
    public function run()
    {
        // ================================
        // ROLES (Crear si no existen)
        // ================================
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
        // PREMIUM (con suscripción simulada)
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

        // Suscripción activa simulada compatible con Cashier
        \DB::table('subscriptions')->updateOrInsert(
            [
                'user_id' => $premium->id,
                'name' => 'default', // Cashier lo usa SIEMPRE
            ],
            [
                'subscription_type' => 'fake', // ← tu columna renombrada
                'stripe_id' => 'sub_fake_123',
                'stripe_status' => 'active',
                'stripe_price' => 'price_fake_123',
                'quantity' => 1,
                'trial_ends_at' => null,
                'ends_at' => null,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        );

        // ================================
        // USUARIO BÁSICO (Trial)
        // ================================
        $user = User::updateOrCreate(
            ['email' => 'usuario@emprecif.com'],
            [
                'name' => 'Usuario Básico',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
                'trial_ends_at' => now()->addDays(15),
            ]
        );
        $user->syncRoles([$userRole]);
    }
}
