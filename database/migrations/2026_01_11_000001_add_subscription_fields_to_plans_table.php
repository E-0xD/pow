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
            
            // Add billing cycle (monthly, yearly)
            $table->string('billing_cycle')->default('monthly');
            
            // Make price nullable for free tier
            $table->decimal('price', 10, 2)->nullable()->change();
        
            
            // Add is_active flag
            if (!Schema::hasColumn('plans', 'is_active')) {
                $table->boolean('is_active')->default(true);
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
          
            if (Schema::hasColumn('plans', 'billing_cycle')) {
                $table->dropColumn('billing_cycle');
            }
          
            if (Schema::hasColumn('plans', 'is_active')) {
                $table->dropColumn('is_active');
            }
        });
    }
};
