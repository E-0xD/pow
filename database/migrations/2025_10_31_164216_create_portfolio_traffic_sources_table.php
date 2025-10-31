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
        Schema::create('portfolio_traffic_sources', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained()->onDelete('cascade');
            $table->string('source');  // e.g., 'direct', 'google', 'facebook', etc.
            $table->integer('visits_count')->default(0);
            $table->date('date');
            $table->timestamps();

            $table->unique(['portfolio_id', 'source', 'date']);
            $table->index(['portfolio_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_traffic_sources');
    }
};
