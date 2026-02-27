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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->tinyInteger('rating');
            $table->text('comment');
            $table->integer('user_id');
            $table->integer('rental_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('rental_id')->references('id')->on('rentals');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
