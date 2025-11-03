<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class CleanupMigrations extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'migrations:cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eliminar migraciones duplicadas y limpiar la base de datos';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Iniciando limpieza de migraciones...');
        
        // Lista de archivos de migración duplicados para eliminar
        $duplicateMigrations = [
            '2025_11_03_181037_add_trial_ends_at_to_users_table.php',
            '2025_11_03_181454_add_trial_ends_at_to_users_table.php'
        ];
        
        $migrationsPath = database_path('migrations');
        $deleted = 0;
        
        foreach ($duplicateMigrations as $migration) {
            $path = $migrationsPath . '/' . $migration;
            if (File::exists($path)) {
                File::delete($path);
                $this->line("Eliminada migración duplicada: {$migration}");
                $deleted++;
            }
        }
        
        // Limpiar la caché de migraciones
        $this->call('migrate:reset', ['--force' => true]);
        
        // Ejecutar migraciones
        $this->call('migrate', ['--force' => true]);
        
        $this->info("\nLimpieza completada. Se eliminaron {$deleted} migraciones duplicadas.");
        $this->info('Base de datos actualizada correctamente.');
    }
}
