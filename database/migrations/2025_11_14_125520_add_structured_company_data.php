<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | 1) Ampliar tabla companies (TODAS nullable → no rompe nada)
        |--------------------------------------------------------------------------
        */
        Schema::table('companies', function (Blueprint $table) {
            // Datos mercantiles adicionales
            $table->string('cnae')->nullable()->after('sector');
            $table->string('forma_juridica')->nullable()->after('cnae');
            $table->decimal('capital_social', 15, 2)->nullable()->after('forma_juridica');

            // Datos de registro mercantil (opcionales de momento)
            $table->string('registro_tomo')->nullable()->after('capital_social');
            $table->string('registro_folio')->nullable()->after('registro_tomo');
            $table->string('registro_hoja')->nullable()->after('registro_folio');
            $table->string('inscripcion')->nullable()->after('registro_hoja');
        });

        /*
        |--------------------------------------------------------------------------
        | 2) Tabla company_directors (administradores actuales / históricos)
        |--------------------------------------------------------------------------
        */
        Schema::create('company_directors', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('nombre');
            $table->string('cargo');
            $table->date('fecha_nombramiento')->nullable();
            $table->date('fecha_cese')->nullable();
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | 3) Tabla company_shareholders (socios / accionistas)
        |--------------------------------------------------------------------------
        */
        Schema::create('company_shareholders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('nombre');
            $table->decimal('porcentaje', 5, 2)->nullable(); // 0–100
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | 4) Tabla company_events (actos BORME / registrales)
        |--------------------------------------------------------------------------
        */
        Schema::create('company_events', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->constrained()
                ->onDelete('cascade');

            $table->date('fecha')->nullable();
            $table->string('tipo')->nullable();        // p.ej. "Depósito de cuentas", "Nombramiento"
            $table->text('descripcion')->nullable();  // texto libre del acto
            $table->string('borme_pdf')->nullable();  // URL o ruta a PDF si la hubiera
            $table->timestamps();
        });

        /*
        |--------------------------------------------------------------------------
        | 5) Tabla company_accounts (cuentas anuales)
        |--------------------------------------------------------------------------
        */
        Schema::create('company_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id')
                ->constrained()
                ->onDelete('cascade');

            $table->integer('ejercicio'); // año
            $table->decimal('facturacion', 15, 2)->nullable();
            $table->decimal('resultado_neto', 15, 2)->nullable();
            $table->integer('empleados')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('company_accounts');
        Schema::dropIfExists('company_events');
        Schema::dropIfExists('company_shareholders');
        Schema::dropIfExists('company_directors');

        Schema::table('companies', function (Blueprint $table) {
            $table->dropColumn([
                'cnae',
                'forma_juridica',
                'capital_social',
                'registro_tomo',
                'registro_folio',
                'registro_hoja',
                'inscripcion',
            ]);
        });
    }
};
