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
        Schema::create('stages', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->string('title');
            $table->dateTime('date');
            $table->string('place');
            $table->decimal('longitude', $precision = 11, $scale = 8)->nullable();
            $table->decimal('latitude', $precision = 11, $scale = 8)->nullable();
            $table->tinyInteger('rating')->nullable();
            $table->boolean('is_visited');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stages');


    }
};
