<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('affiliates', function (Blueprint $table) {
            $table->id();
            $table->string('uid');
            $table->foreignId('user_id')->constrained('users')->unique();
            $table->decimal('commission_rate', 5, 2)->default(30.00); // percentage
            $table->string('payout_method')->nullable();
            $table->json('payout_details')->nullable();
            $table->decimal('balance', 12, 2)->default(0);
            $table->timestamp('last_payout_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affiliates');
    }
};
