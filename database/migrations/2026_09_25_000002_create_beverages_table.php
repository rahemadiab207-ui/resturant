<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('beverages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();
            $table->string('name');
            $table->text('description')->nullable();
            $table->text('ingredients')->nullable();
            $table->decimal('price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->boolean('is_on_sale')->default(false);
            $table->unsignedInteger('calories')->nullable();
            $table->unsignedTinyInteger('spicy_level')->default(0);
            $table->boolean('is_available')->default(true);
            $table->decimal('rating', 3, 2)->nullable();
            $table->string('image')->default('beverages/default.jpg');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('beverages');
    }
};