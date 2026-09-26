<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('customer_preferences', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->unique()->constrained('users')->cascadeOnDelete();
            $table->text('preferred_categories')->nullable();
            $table->text('preferred_ingredients')->nullable();
            $table->text('excluded_ingredients')->nullable();
            $table->unsignedTinyInteger('preferred_spicy_level')->nullable();
            $table->unsignedInteger('minimum_calories')->nullable();
            $table->unsignedInteger('maximum_calories')->nullable();
            $table->decimal('minimum_budget', 10, 2)->nullable();
            $table->decimal('maximum_budget', 10, 2)->nullable();
            $table->text('preferences_text')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('customer_preferences');
    }
};