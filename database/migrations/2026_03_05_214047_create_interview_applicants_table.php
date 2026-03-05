<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('interview_applicants', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email');
            $table->string('whatsapp')->nullable();
            $table->string('role')->nullable();
            $table->string('row_hash')->unique();
            $table->dateTime('scheduled_at');
            $table->dateTime('invitation_sent_at')->nullable();
            $table->dateTime('reminder_6h_sent_at')->nullable();
            $table->dateTime('reminder_1h_sent_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('interview_applicants');
    }
};
