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
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->decimal('total_price',10);
            $table->integer('user_id');
            $table->integer('equipment_id');

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('equipment_id')->references('id')->on('equipment');
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rentals');
    }
};
