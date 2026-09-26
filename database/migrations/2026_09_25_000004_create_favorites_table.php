<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('favorites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('meal_id')->nullable()->constrained('meals')->cascadeOnDelete();
            $table->foreignId('beverage_id')->nullable()->constrained('beverages')->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['user_id', 'meal_id']);
            $table->unique(['user_id', 'beverage_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};