<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('meals', function (Blueprint $table) {
            $table->id();

            $table->foreignId('category_id')
                ->constrained('categories')
                ->cascadeOnDelete();

            $table->string('name');
            $table->string('slug')->unique();

            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();

            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();

            $table->boolean('is_on_sale')->default(false);

            $table->integer('calories')->nullable();
            $table->integer('spicy_level')->default(0);

            $table->boolean('is_available')->default(true);

            $table->decimal('rating', 3, 2)->default(0);

            $table->string('image')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('meals');
    }
};
