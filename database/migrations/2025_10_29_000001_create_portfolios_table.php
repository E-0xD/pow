<?php

use App\Enums\UserPortfolioStatus;
use App\Enums\UserPortfolioVisibility;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->unique();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('template_id')->constrained()->cascadeOnDelete();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('visibility')->default(UserPortfolioVisibility::PUBLIC);
            $table->string('theme')->nullable();
            $table->json('typography')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->string('status')->default(UserPortfolioStatus::DISABLED);
            $table->string('favicon')->nullable();
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};