<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('meals', function (Blueprint $table) {
            if (!Schema::hasColumn('meals', 'ingredients')) {
                $table->text('ingredients')
                    ->nullable()
                    ->after('description');
            }

            if (!Schema::hasColumn('meals', 'calories')) {
                $table->integer('calories')
                    ->nullable()
                    ->after('ingredients');
            }

            if (!Schema::hasColumn('meals', 'spicy_level')) {
                $table->integer('spicy_level')
                    ->default(0)
                    ->after('calories');
            }

            if (!Schema::hasColumn('meals', 'is_available')) {
                $table->boolean('is_available')
                    ->default(true)
                    ->after('spicy_level');
            }

            if (!Schema::hasColumn('meals', 'rating')) {
                $table->decimal('rating', 3, 2)
                    ->default(0)
                    ->after('is_available');
            }

            if (!Schema::hasColumn('meals', 'image')) {
                $table->string('image')
                    ->nullable()
                    ->after('rating');
            }
        });
    }

    public function down(): void
    {
        Schema::table('meals', function (Blueprint $table) {
            $columns = [
                'ingredients',
                'calories',
                'spicy_level',
                'is_available',
                'rating',
                'image',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('meals', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};
