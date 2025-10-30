<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('portfolio_section_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('portfolio_id');
            $table->string('section_id');
            $table->integer('position')->default(0);
            $table->timestamps();

            $table->unique(['portfolio_id', 'section_id']);

            // If portfolios table exists with id PK, add foreign key - optional
            if (Schema::hasTable('portfolios')) {
                $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
            }
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('portfolio_section_orders');
    }
};
