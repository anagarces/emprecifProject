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
        Schema::table('users', function (Blueprint $table) {
            // Ensure all Cashier required columns exist
            $columns = [
                'stripe_id' => 'string',
                'pm_type' => 'string',
                'pm_last_four' => 'string',
                'trial_ends_at' => 'timestamp',
            ];

            foreach ($columns as $column => $type) {
                if (!Schema::hasColumn('users', $column)) {
                    $table->$type($column)->nullable();
                }
            }

            // Add index for stripe_id if it doesn't exist
            if (Schema::hasColumn('users', 'stripe_id') && !Schema::hasIndex('users', ['stripe_id'])) {
                $table->index('stripe_id');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // We won't drop these columns in the down migration
        // to prevent accidental data loss
    }
};
