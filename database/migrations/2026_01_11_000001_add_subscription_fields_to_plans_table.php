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
        Schema::table('plans', function (Blueprint $table) {
            // Add tier identifier
            $table->string('tier')->after('uid')->default('free')->index();
            
            // Add billing cycle (monthly, yearly)
            $table->string('billing_cycle')->after('tier')->default('monthly');
            
            // Make price nullable for free tier
            $table->decimal('price', 10, 2)->nullable()->change();
            
            // Rename duration to interval_days for clarity
            if (!Schema::hasColumn('plans', 'interval_days')) {
                $table->integer('interval_days')->after('billing_cycle')->nullable();
            }
            
            // Add is_active flag
            if (!Schema::hasColumn('plans', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('interval_days');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            if (Schema::hasColumn('plans', 'tier')) {
                $table->dropColumn('tier');
            }
            if (Schema::hasColumn('plans', 'billing_cycle')) {
                $table->dropColumn('billing_cycle');
            }
            if (Schema::hasColumn('plans', 'interval_days')) {
                $table->dropColumn('interval_days');
            }
            if (Schema::hasColumn('plans', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};
