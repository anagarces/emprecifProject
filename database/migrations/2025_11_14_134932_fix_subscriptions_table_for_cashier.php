<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            // Cashier necesita name = nombre de la suscripción
            if (!Schema::hasColumn('subscriptions', 'name')) {
                $table->string('name')->default('default')->after('user_id');
            }

            // Cashier usa type de Stripe internamente, no tu columna type
            // Renombramos tu "type" → "subscription_type"
            if (Schema::hasColumn('subscriptions', 'type')) {
                $table->renameColumn('type', 'subscription_type');
            }
        });
    }

    public function down(): void
    {
        Schema::table('subscriptions', function (Blueprint $table) {
            if (Schema::hasColumn('subscriptions', 'name')) {
                $table->dropColumn('name');
            }

            if (Schema::hasColumn('subscriptions', 'subscription_type')) {
                $table->renameColumn('subscription_type', 'type');
            }
        });
    }
};
