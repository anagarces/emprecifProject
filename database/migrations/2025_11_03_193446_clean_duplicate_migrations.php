<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Marcar las migraciones duplicadas como ejecutadas
        $migrations = [
            '2025_11_03_000000_add_trial_ends_at_to_users_table',
            '2025_11_03_181037_add_trial_ends_at_to_users_table',
            '2025_11_03_181454_add_trial_ends_at_to_users_table',
        ];

        foreach ($migrations as $migration) {
            if (!DB::table('migrations')->where('migration', $migration)->exists()) {
                DB::table('migrations')->insert([
                    'migration' => $migration,
                    'batch' => 4, // Siguiente número de lote
                ]);
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // No es necesario hacer nada en el down
    }
};
