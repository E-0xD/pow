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
            // Change tier from string to foreign key
            if (Schema::hasColumn('plans', 'tier')) {
                $table->dropColumn('tier');
            }
            
            $table->foreignId('tier_id')->nullable()->constrained('tiers')->onDelete('cascade');
            
            // Remove unused columns
            if (Schema::hasColumn('plans', 'benefits')) {
                $table->dropColumn('benefits');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->dropForeignKeyIfExists(['tier_id']);
            $table->dropColumn('tier_id');
            $table->string('tier')->default('free')->index();
            $table->json('benefits')->nullable();
            $table->integer('duration')->nullable();
        });
    }
};
