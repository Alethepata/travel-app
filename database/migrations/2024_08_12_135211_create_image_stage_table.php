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
        Schema::create('image_stage', function (Blueprint $table) {
            $table->unsignedBigInteger('image_id')->nullable();
            $table->foreign('image_id')
            ->references('id')
            ->on('images')
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
        Schema::dropIfExists('image_stage');
    }
};
