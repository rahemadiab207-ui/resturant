<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        /*
        |--------------------------------------------------------------------------
        | MEALS
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('meals', 'is_spicy')) {
            Schema::table('meals', function (Blueprint $table) {
                $table->boolean('is_spicy')->default(false);
            });
        }

        if (!Schema::hasColumn('meals', 'has_cheese')) {
            Schema::table('meals', function (Blueprint $table) {
                $table->boolean('has_cheese')->default(false);
            });
        }

        if (!Schema::hasColumn('meals', 'has_chicken')) {
            Schema::table('meals', function (Blueprint $table) {
                $table->boolean('has_chicken')->default(false);
            });
        }

        if (!Schema::hasColumn('meals', 'has_meat')) {
            Schema::table('meals', function (Blueprint $table) {
                $table->boolean('has_meat')->default(false);
            });
        }

        if (!Schema::hasColumn('meals', 'has_mushroom')) {
            Schema::table('meals', function (Blueprint $table) {
                $table->boolean('has_mushroom')->default(false);
            });
        }

        if (!Schema::hasColumn('meals', 'is_vegetarian')) {
            Schema::table('meals', function (Blueprint $table) {
                $table->boolean('is_vegetarian')->default(false);
            });
        }

        if (!Schema::hasColumn('meals', 'is_healthy')) {
            Schema::table('meals', function (Blueprint $table) {
                $table->boolean('is_healthy')->default(false);
            });
        }

        if (!Schema::hasColumn('meals', 'is_vegan')) {
            Schema::table('meals', function (Blueprint $table) {
                $table->boolean('is_vegan')->default(false);
            });
        }

        if (!Schema::hasColumn('meals', 'is_gluten_free')) {
            Schema::table('meals', function (Blueprint $table) {
                $table->boolean('is_gluten_free')->default(false);
            });
        }

        if (!Schema::hasColumn('meals', 'is_dairy_free')) {
            Schema::table('meals', function (Blueprint $table) {
                $table->boolean('is_dairy_free')->default(false);
            });
        }

        if (!Schema::hasColumn('meals', 'is_high_protein')) {
            Schema::table('meals', function (Blueprint $table) {
                $table->boolean('is_high_protein')->default(false);
            });
        }

        if (!Schema::hasColumn('meals', 'is_low_calorie')) {
            Schema::table('meals', function (Blueprint $table) {
                $table->boolean('is_low_calorie')->default(false);
            });
        }


        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */

        if (!Schema::hasColumn('categories', 'is_spicy')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('is_spicy')->default(false);
            });
        }

        if (!Schema::hasColumn('categories', 'has_cheese')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('has_cheese')->default(false);
            });
        }

        if (!Schema::hasColumn('categories', 'has_chicken')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('has_chicken')->default(false);
            });
        }

        if (!Schema::hasColumn('categories', 'has_meat')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('has_meat')->default(false);
            });
        }

        if (!Schema::hasColumn('categories', 'has_mushroom')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('has_mushroom')->default(false);
            });
        }

        if (!Schema::hasColumn('categories', 'is_vegetarian')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('is_vegetarian')->default(false);
            });
        }

        if (!Schema::hasColumn('categories', 'is_healthy')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('is_healthy')->default(false);
            });
        }

        if (!Schema::hasColumn('categories', 'is_vegan')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('is_vegan')->default(false);
            });
        }

        if (!Schema::hasColumn('categories', 'is_gluten_free')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('is_gluten_free')->default(false);
            });
        }

        if (!Schema::hasColumn('categories', 'is_dairy_free')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('is_dairy_free')->default(false);
            });
        }

        if (!Schema::hasColumn('categories', 'is_high_protein')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('is_high_protein')->default(false);
            });
        }

        if (!Schema::hasColumn('categories', 'is_low_calorie')) {
            Schema::table('categories', function (Blueprint $table) {
                $table->boolean('is_low_calorie')->default(false);
            });
        }
    }

    public function down(): void
    {
        $mealColumns = [
            'is_spicy',
            'has_cheese',
            'has_chicken',
            'has_meat',
            'has_mushroom',
            'is_vegetarian',
            'is_healthy',
            'is_vegan',
            'is_gluten_free',
            'is_dairy_free',
            'is_high_protein',
            'is_low_calorie',
        ];

        foreach ($mealColumns as $column) {
            if (Schema::hasColumn('meals', $column)) {
                Schema::table('meals', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }

        $categoryColumns = [
            'is_spicy',
            'has_cheese',
            'has_chicken',
            'has_meat',
            'has_mushroom',
            'is_vegetarian',
            'is_healthy',
            'is_vegan',
            'is_gluten_free',
            'is_dairy_free',
            'is_high_protein',
            'is_low_calorie',
        ];

        foreach ($categoryColumns as $column) {
            if (Schema::hasColumn('categories', $column)) {
                Schema::table('categories', function (Blueprint $table) use ($column) {
                    $table->dropColumn($column);
                });
            }
        }
    }
};