<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('cif', 9)->unique();
            $table->string('legal_name')->nullable();
            $table->text('description')->nullable();
            $table->string('sector');
            $table->string('website')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->string('postal_code', 5);
            $table->string('country')->default('España');
            $table->integer('employees')->nullable();
            $table->decimal('revenue', 15, 2)->nullable();
            $table->decimal('profit', 15, 2)->nullable();
            $table->json('financials')->nullable();
            $table->json('directors')->nullable();
            $table->json('shareholders')->nullable();
            $table->boolean('is_active')->default(true);
            $table->timestamp('founded_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index('name');
            $table->index('cif');
            $table->index('sector');
            $table->index('city');
            $table->index('province');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
