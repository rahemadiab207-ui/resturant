
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {

            /*
            |--------------------------------------------------------------------------
            | Basic Category Information
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('categories', 'description')) {
                $table->text('description')
                    ->nullable()
                    ->after('slug');
            }

            if (!Schema::hasColumn('categories', 'image')) {
                $table->string('image')
                    ->nullable()
                    ->after('description');
            }

            /*
            |--------------------------------------------------------------------------
            | Price
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('categories', 'price')) {
                $table->decimal('price', 10, 2)
                    ->nullable()
                    ->after('slug');
            }

            if (!Schema::hasColumn('categories', 'discount_price')) {
                $table->decimal('discount_price', 10, 2)
                    ->nullable()
                    ->after('price');
            }

            if (!Schema::hasColumn('categories', 'is_on_sale')) {
                $table->boolean('is_on_sale')
                    ->default(false)
                    ->after('discount_price');
            }

            /*
            |--------------------------------------------------------------------------
            | Rating
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('categories', 'rating')) {
                $table->decimal('rating', 3, 2)
                    ->default(0)
                    ->after('is_on_sale');
            }

            /*
            |--------------------------------------------------------------------------
            | Food Attributes
            |--------------------------------------------------------------------------
            */

            if (!Schema::hasColumn('categories', 'is_spicy')) {
                $table->boolean('is_spicy')
                    ->default(false)
                    ->after('rating');
            }

            if (!Schema::hasColumn('categories', 'has_cheese')) {
                $table->boolean('has_cheese')
                    ->default(false)
                    ->after('is_spicy');
            }

            if (!Schema::hasColumn('categories', 'has_chicken')) {
                $table->boolean('has_chicken')
                    ->default(false)
                    ->after('has_cheese');
            }

            if (!Schema::hasColumn('categories', 'has_meat')) {
                $table->boolean('has_meat')
                    ->default(false)
                    ->after('has_chicken');
            }

            if (!Schema::hasColumn('categories', 'has_mushroom')) {
                $table->boolean('has_mushroom')
                    ->default(false)
                    ->after('has_meat');
            }

            if (!Schema::hasColumn('categories', 'is_vegetarian')) {
                $table->boolean('is_vegetarian')
                    ->default(false)
                    ->after('has_mushroom');
            }
        });
    }

    public function down(): void
    {
        Schema::table('categories', function (Blueprint $table) {

            $columns = [
                'is_vegetarian',
                'has_mushroom',
                'has_meat',
                'has_chicken',
                'has_cheese',
                'is_spicy',
                'rating',
                'is_on_sale',
                'discount_price',
                'price',
                'image',
                'description',
            ];

            foreach ($columns as $column) {
                if (Schema::hasColumn('categories', $column)) {
                    $table->dropColumn($column);
                }
            }
        });
    }
};

