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
        Schema::create('user_daily_activities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->date('date');
            $table->string('country')->nullable()->comment('User country from geolocation');
            $table->string('city')->nullable()->comment('User city from geolocation');
            $table->string('ip_address')->nullable();
            $table->text('user_agent')->nullable();
            $table->enum('device_type', ['mobile', 'tablet', 'desktop'])->default('desktop');
            $table->timestamps();

            // Indexes for efficient queries
            $table->index(['user_id', 'date']);
            $table->index('date');
            $table->index('country');
            $table->index('city');
            $table->index('device_type');
            $table->unique(['user_id', 'date']); // Only one activity record per user per day
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_daily_activities');
    }
};
