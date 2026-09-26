// database/migrations/2026_09_25_000005_create_recommendations_table.php

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recommendations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('meal_id')->nullable()->constrained('meals')->cascadeOnDelete();
            $table->foreignId('beverage_id')->nullable()->constrained('beverages')->cascadeOnDelete();
            $table->decimal('match_percentage', 5, 2)->default(0);
            $table->text('reason')->nullable();
            $table->string('source')->default('ai');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recommendations');
    }
};