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
        Schema::create('portfolio_clicks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('portfolio_id')->constrained()->onDelete('cascade');
            $table->string('ip_address');
            $table->string('element_type');  // e.g., 'link', 'button', etc.
            $table->string('element_id')->nullable();
            $table->string('page_url');
            $table->string('clicked_url')->nullable();
            $table->timestamps();

            $table->index(['portfolio_id', 'created_at']);
            $table->index(['ip_address', 'created_at']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolio_clicks');
    }
};
