<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('about', function (Blueprint $table) {
            $table->integer('years_of_experience')->nullable();
            $table->integer('total_projects_done')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('about', function (Blueprint $table) {
            $table->dropColumn(['years_of_experience', 'total_projects_done']);
        });
    }
};
