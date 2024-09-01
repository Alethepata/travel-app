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
        Schema::create('curiosity_stage', function (Blueprint $table) {
            $table->unsignedBigInteger('curiosity_id')->nullable();
            $table->foreign('curiosity_id')
            ->references('id')
            ->on('curiosities')
            ->cascadeOnDelete();

            $table->unsignedBigInteger('stage_id')->nullable();
            $table->foreign('stage_id')
            ->references('id')
            ->on('stages')
            ->cascadeOnDelete();

            $table->dateTime('ending_date')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('curiosity_stage');
    }
};
