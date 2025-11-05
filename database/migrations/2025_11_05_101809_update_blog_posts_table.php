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
        Schema::table('blog_posts', function (Blueprint $table) {
            // Eliminar columnas que ya no necesitamos
            $table->dropColumn([
                'featured_image',
                'tags',
                'author',
                'meta_title',
                'meta_description',
                'views'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('blog_posts', function (Blueprint $table) {
            // Restaurar columnas eliminadas (si es necesario)
            $table->string('featured_image')->nullable()->after('content');
            $table->json('tags')->nullable()->after('category');
            $table->string('author')->default('Equipo EmpreciF')->after('category');
            $table->string('meta_title')->nullable()->after('published_at');
            $table->text('meta_description')->nullable()->after('meta_title');
            $table->unsignedInteger('views')->default(0)->after('meta_description');
        });
    }
};
