<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            if (!Schema::hasColumn('users', 'companies_viewed')) {
                $table->unsignedInteger('companies_viewed')->default(0);
            }
            if (!Schema::hasColumn('users', 'can_download_reports')) {
                $table->boolean('can_download_reports')->default(false);
            }
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            if (Schema::hasColumn('users', 'companies_viewed')) {
                $table->dropColumn('companies_viewed');
            }
            if (Schema::hasColumn('users', 'can_download_reports')) {
                $table->dropColumn('can_download_reports');
            }
        });
    }
};
