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
        Schema::create('equipmentsports', function (Blueprint $table) {
            $table->integer('sport_id')->primary();
            $table->integer('equipment_id')->primary();

            $table->foreign('sport_id')->references('id')->on('sports');
            $table->foreign('equipment_id')->references('id')->on('equipment');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipmentsports');
    }
};
