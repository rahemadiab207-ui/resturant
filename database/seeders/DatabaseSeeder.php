<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        /*
        |--------------------------------------------------------------------------
        | USERS
        |--------------------------------------------------------------------------
        */

        $adminId = DB::table('users')->insertGetId([
            'name' => 'Admin',
            'email' => 'admin@restaurant.com',
            'password' => Hash::make('password'),
            'phone1' => '01000000000',
            'phone2' => null,
            'address' => 'Restaurant Admin Office',
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $userIds = [];

        $users = [
            [
                'name' => 'Ahmed Mohamed',
                'email' => 'ahmed@example.com',
                'phone1' => '01011111111',
                'phone2' => null,
                'address' => 'Cairo, Egypt',
            ],
            [
                'name' => 'Sara Ali',
                'email' => 'sara@example.com',
                'phone1' => '01022222222',
                'phone2' => null,
                'address' => 'Alexandria, Egypt',
            ],
            [
                'name' => 'Omar Hassan',
                'email' => 'omar@example.com',
                'phone1' => '01033333333',
                'phone2' => null,
                'address' => 'Giza, Egypt',
            ],
            [
                'name' => 'Mariam Khaled',
                'email' => 'mariam@example.com',
                'phone1' => '01044444444',
                'phone2' => null,
                'address' => 'Alexandria, Egypt',
            ],
            [
                'name' => 'Youssef Mahmoud',
                'email' => 'youssef@example.com',
                'phone1' => '01055555555',
                'phone2' => null,
                'address' => 'Cairo, Egypt',
            ],
            [
                'name' => 'Nour Adel',
                'email' => 'nour@example.com',
                'phone1' => '01066666666',
                'phone2' => null,
                'address' => 'Mansoura, Egypt',
            ],
            [
                'name' => 'Karim Samir',
                'email' => 'karim@example.com',
                'phone1' => '01077777777',
                'phone2' => null,
                'address' => 'Cairo, Egypt',
            ],
            [
                'name' => 'Laila Ibrahim',
                'email' => 'laila@example.com',
                'phone1' => '01088888888',
                'phone2' => null,
                'address' => 'Alexandria, Egypt',
            ],
            [
                'name' => 'Mostafa Tarek',
                'email' => 'mostafa@example.com',
                'phone1' => '01099999999',
                'phone2' => null,
                'address' => 'Giza, Egypt',
            ],
            [
                'name' => 'Hana Ahmed',
                'email' => 'hana@example.com',
                'phone1' => '01111111111',
                'phone2' => null,
                'address' => 'Cairo, Egypt',
            ],
        ];

        foreach ($users as $user) {
            $userIds[] = DB::table('users')->insertGetId([
                'name' => $user['name'],
                'email' => $user['email'],
                'password' => Hash::make('password'),
                'phone1' => $user['phone1'],
                'phone2' => $user['phone2'],
                'address' => $user['address'],
                'role' => 'user',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CATEGORIES
        |--------------------------------------------------------------------------
        */

        $categories = [
            [
                'name' => 'Burgers',
                'slug' => 'burgers',
                'description' => 'Delicious burgers with fresh ingredients.',
                'image' => 'categories/burgers.jpg',
            ],
            [
                'name' => 'Pizza',
                'slug' => 'pizza',
                'description' => 'Freshly baked pizzas with different toppings.',
                'image' => 'categories/pizza.jpg',
            ],
            [
                'name' => 'Chicken',
                'slug' => 'chicken',
                'description' => 'Crispy and grilled chicken meals.',
                'image' => 'categories/chicken.jpg',
            ],
            [
                'name' => 'Pasta',
                'slug' => 'pasta',
                'description' => 'Italian style pasta dishes.',
                'image' => 'categories/pasta.jpg',
            ],
            [
                'name' => 'Seafood',
                'slug' => 'seafood',
                'description' => 'Fresh seafood dishes.',
                'image' => 'categories/seafood.jpg',
            ],
            [
                'name' => 'Salads',
                'slug' => 'salads',
                'description' => 'Fresh and healthy salads.',
                'image' => 'categories/salads.jpg',
            ],
            [
                'name' => 'Desserts',
                'slug' => 'desserts',
                'description' => 'Sweet desserts for every taste.',
                'image' => 'categories/desserts.jpg',
            ],
            [
                'name' => 'Breakfast',
                'slug' => 'breakfast',
                'description' => 'Fresh breakfast meals.',
                'image' => 'categories/breakfast.jpg',
            ],
        ];

        $categoryIds = [];

        foreach ($categories as $category) {
            $categoryIds[$category['name']] = DB::table('categories')->insertGetId([
                'name' => $category['name'],
                'slug' => $category['slug'],
                'description' => $category['description'],
                'image' => $category['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | MEALS
        |--------------------------------------------------------------------------
        */

        $meals = [
            [
                'category' => 'Burgers',
                'name' => 'Classic Beef Burger',
                'description' => 'Juicy beef burger with lettuce, tomato and special sauce.',
                'ingredients' => 'Beef, lettuce, tomato, onion, special sauce, bun',
                'price' => 180,
                'discount_price' => 150,
                'is_on_sale' => true,
                'calories' => 650,
                'spicy_level' => 0,
                'is_available' => true,
                'rating' => 4.8,
                'image' => 'meals/default.jpg',
            ],
            [
                'category' => 'Burgers',
                'name' => 'Chicken Burger',
                'description' => 'Crispy chicken burger with cheese and special sauce.',
                'ingredients' => 'Chicken, cheese, lettuce, tomato, sauce, bun',
                'price' => 160,
                'discount_price' => 135,
                'is_on_sale' => true,
                'calories' => 590,
                'spicy_level' => 1,
                'is_available' => true,
                'rating' => 4.6,
                'image' => 'meals/default.jpg',
            ],
            [
                'category' => 'Pizza',
                'name' => 'Margherita Pizza',
                'description' => 'Classic pizza with tomato sauce, mozzarella and basil.',
                'ingredients' => 'Pizza dough, tomato sauce, mozzarella, basil',
                'price' => 190,
                'discount_price' => null,
                'is_on_sale' => false,
                'calories' => 720,
                'spicy_level' => 0,
                'is_available' => true,
                'rating' => 4.7,
                'image' => 'meals/default.jpg',
            ],
            [
                'category' => 'Pizza',
                'name' => 'Chicken BBQ Pizza',
                'description' => 'Pizza topped with grilled chicken and BBQ sauce.',
                'ingredients' => 'Pizza dough, chicken, mozzarella, BBQ sauce',
                'price' => 240,
                'discount_price' => 210,
                'is_on_sale' => true,
                'calories' => 820,
                'spicy_level' => 1,
                'is_available' => true,
                'rating' => 4.9,
                'image' => 'meals/default.jpg',
            ],
            [
                'category' => 'Chicken',
                'name' => 'Crispy Chicken Meal',
                'description' => 'Crispy fried chicken served with fries and sauce.',
                'ingredients' => 'Chicken, flour, spices, fries, sauce',
                'price' => 220,
                'discount_price' => 195,
                'is_on_sale' => true,
                'calories' => 900,
                'spicy_level' => 2,
                'is_available' => true,
                'rating' => 4.7,
                'image' => 'meals/default.jpg',
            ],
            [
                'category' => 'Chicken',
                'name' => 'Grilled Chicken',
                'description' => 'Grilled chicken breast served with vegetables.',
                'ingredients' => 'Chicken breast, vegetables, herbs, spices',
                'price' => 230,
                'discount_price' => null,
                'is_on_sale' => false,
                'calories' => 540,
                'spicy_level' => 0,
                'is_available' => true,
                'rating' => 4.5,
                'image' => 'meals/default.jpg',
            ],
            [
                'category' => 'Pasta',
                'name' => 'Chicken Alfredo Pasta',
                'description' => 'Creamy pasta with grilled chicken and parmesan.',
                'ingredients' => 'Pasta, chicken, cream, parmesan, herbs',
                'price' => 210,
                'discount_price' => 185,
                'is_on_sale' => true,
                'calories' => 780,
                'spicy_level' => 0,
                'is_available' => true,
                'rating' => 4.8,
                'image' => 'meals/default.jpg',
            ],
            [
                'category' => 'Pasta',
                'name' => 'Spicy Arrabbiata',
                'description' => 'Pasta with spicy tomato sauce and herbs.',
                'ingredients' => 'Pasta, tomato sauce, chili, garlic, herbs',
                'price' => 175,
                'discount_price' => null,
                'is_on_sale' => false,
                'calories' => 610,
                'spicy_level' => 3,
                'is_available' => true,
                'rating' => 4.4,
                'image' => 'meals/default.jpg',
            ],
            [
                'category' => 'Seafood',
                'name' => 'Grilled Fish',
                'description' => 'Fresh grilled fish with vegetables and lemon.',
                'ingredients' => 'Fish, lemon, vegetables, herbs',
                'price' => 280,
                'discount_price' => 250,
                'is_on_sale' => true,
                'calories' => 480,
                'spicy_level' => 0,
                'is_available' => true,
                'rating' => 4.8,
                'image' => 'meals/default.jpg',
            ],
            [
                'category' => 'Seafood',
                'name' => 'Shrimp Pasta',
                'description' => 'Creamy pasta with fresh shrimp.',
                'ingredients' => 'Shrimp, pasta, cream, garlic, parmesan',
                'price' => 290,
                'discount_price' => null,
                'is_on_sale' => false,
                'calories' => 700,
                'spicy_level' => 1,
                'is_available' => true,
                'rating' => 4.7,
                'image' => 'meals/default.jpg',
            ],
            [
                'category' => 'Salads',
                'name' => 'Caesar Salad',
                'description' => 'Fresh lettuce, parmesan and Caesar dressing.',
                'ingredients' => 'Lettuce, parmesan, croutons, Caesar dressing',
                'price' => 120,
                'discount_price' => 100,
                'is_on_sale' => true,
                'calories' => 320,
                'spicy_level' => 0,
                'is_available' => true,
                'rating' => 4.5,
                'image' => 'meals/default.jpg',
            ],
            [
                'category' => 'Desserts',
                'name' => 'Chocolate Cake',
                'description' => 'Rich chocolate cake with chocolate sauce.',
                'ingredients' => 'Chocolate, flour, eggs, sugar, butter',
                'price' => 110,
                'discount_price' => null,
                'is_on_sale' => false,
                'calories' => 450,
                'spicy_level' => 0,
                'is_available' => true,
                'rating' => 4.9,
                'image' => 'meals/default.jpg',
            ],
        ];

        $mealIds = [];

        foreach ($meals as $meal) {
            $mealIds[] = DB::table('meals')->insertGetId([
                'category_id' => $categoryIds[$meal['category']],
                'name' => $meal['name'],
                'description' => $meal['description'],
                'ingredients' => $meal['ingredients'],
                'price' => $meal['price'],
                'discount_price' => $meal['discount_price'],
                'is_on_sale' => $meal['is_on_sale'],
                'calories' => $meal['calories'],
                'spicy_level' => $meal['spicy_level'],
                'is_available' => $meal['is_available'],
                'rating' => $meal['rating'],
                'image' => $meal['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | BEVERAGES
        |--------------------------------------------------------------------------
        */

        $beverages = [
            [
                'category' => 'Breakfast',
                'name' => 'Fresh Orange Juice',
                'description' => 'Freshly squeezed orange juice.',
                'ingredients' => 'Fresh oranges',
                'price' => 70,
                'discount_price' => 60,
                'is_on_sale' => true,
                'calories' => 110,
                'spicy_level' => 0,
                'is_available' => true,
                'rating' => 4.7,
                'image' => 'beverages/default.jpg',
            ],
            [
                'category' => 'Breakfast',
                'name' => 'Mango Juice',
                'description' => 'Fresh mango juice.',
                'ingredients' => 'Fresh mango, water',
                'price' => 80,
                'discount_price' => null,
                'is_on_sale' => false,
                'calories' => 150,
                'spicy_level' => 0,
                'is_available' => true,
                'rating' => 4.8,
                'image' => 'beverages/default.jpg',
            ],
            [
                'category' => 'Desserts',
                'name' => 'Chocolate Milkshake',
                'description' => 'Creamy chocolate milkshake.',
                'ingredients' => 'Milk, chocolate, ice cream',
                'price' => 100,
                'discount_price' => 85,
                'is_on_sale' => true,
                'calories' => 420,
                'spicy_level' => 0,
                'is_available' => true,
                'rating' => 4.9,
                'image' => 'beverages/default.jpg',
            ],
            [
                'category' => 'Desserts',
                'name' => 'Strawberry Milkshake',
                'description' => 'Fresh strawberry milkshake.',
                'ingredients' => 'Milk, strawberry, ice cream',
                'price' => 100,
                'discount_price' => null,
                'is_on_sale' => false,
                'calories' => 390,
                'spicy_level' => 0,
                'is_available' => true,
                'rating' => 4.7,
                'image' => 'beverages/default.jpg',
            ],
            [
                'category' => 'Burgers',
                'name' => 'Cola',
                'description' => 'Cold soft drink.',
                'ingredients' => 'Carbonated water, flavor',
                'price' => 45,
                'discount_price' => null,
                'is_on_sale' => false,
                'calories' => 140,
                'spicy_level' => 0,
                'is_available' => true,
                'rating' => 4.3,
                'image' => 'beverages/default.jpg',
            ],
            [
                'category' => 'Burgers',
                'name' => 'Iced Tea',
                'description' => 'Cold refreshing iced tea.',
                'ingredients' => 'Tea, lemon, sugar, ice',
                'price' => 55,
                'discount_price' => 45,
                'is_on_sale' => true,
                'calories' => 90,
                'spicy_level' => 0,
                'is_available' => true,
                'rating' => 4.5,
                'image' => 'beverages/default.jpg',
            ],
        ];

        $beverageIds = [];

        foreach ($beverages as $beverage) {
            $beverageIds[] = DB::table('beverages')->insertGetId([
                'category_id' => $categoryIds[$beverage['category']],
                'name' => $beverage['name'],
                'description' => $beverage['description'],
                'ingredients' => $beverage['ingredients'],
                'price' => $beverage['price'],
                'discount_price' => $beverage['discount_price'],
                'is_on_sale' => $beverage['is_on_sale'],
                'calories' => $beverage['calories'],
                'spicy_level' => $beverage['spicy_level'],
                'is_available' => $beverage['is_available'],
                'rating' => $beverage['rating'],
                'image' => $beverage['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }


        /*
        |--------------------------------------------------------------------------
        | CUSTOMER PREFERENCES
        |--------------------------------------------------------------------------
        */

        if (Schema::hasTable('customer_preferences')) {

            foreach ($userIds as $index => $userId) {

                $preferredCategoryNames = [
                    'Burgers',
                    'Pizza',
                    'Chicken',
                    'Pasta',
                    'Salads',
                ];

                $preferredCategory = $preferredCategoryNames[$index % count($preferredCategoryNames)];

                DB::table('customer_preferences')->insert([
                    'user_id' => $userId,
                    'preferred_categories' => $preferredCategory,
                    'preferred_ingredients' => 'Chicken, Cheese, Tomato',
                    'excluded_ingredients' => $index % 3 === 0 ? 'Spicy Sauce' : null,
                    'preferred_spicy_level' => $index % 4,
                    'minimum_calories' => 300,
                    'maximum_calories' => 900,
                    'minimum_budget' => 50,
                    'maximum_budget' => 300,
                    'preferences_text' => 'Prefers fresh meals with good ratings.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | FAVORITES
        |--------------------------------------------------------------------------
        */

        if (Schema::hasTable('favorites')) {

            foreach ($userIds as $index => $userId) {

                $mealId = $mealIds[$index % count($mealIds)];

                $exists = DB::table('favorites')
                    ->where('user_id', $userId)
                    ->where('meal_id', $mealId)
                    ->exists();

                if (!$exists) {
                    DB::table('favorites')->insert([
                        'user_id' => $userId,
                        'meal_id' => $mealId,
                        'beverage_id' => null,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);
                }

                if (!empty($beverageIds)) {

                    $beverageId = $beverageIds[$index % count($beverageIds)];

                    $beverageExists = DB::table('favorites')
                        ->where('user_id', $userId)
                        ->where('beverage_id', $beverageId)
                        ->exists();

                    if (!$beverageExists) {
                        DB::table('favorites')->insert([
                            'user_id' => $userId,
                            'meal_id' => null,
                            'beverage_id' => $beverageId,
                            'created_at' => now(),
                            'updated_at' => now(),
                        ]);
                    }
                }
            }
        }


        /*
        |--------------------------------------------------------------------------
        | ORDERS
        |--------------------------------------------------------------------------
        */

        $orderStatuses = [
            'Pending',
            'Preparing',
            'Out for Delivery',
            'Completed',
            'Canceled',
        ];

        $orderIds = [];

        foreach ($userIds as $index => $userId) {

            $status = $orderStatuses[$index % count($orderStatuses)];

            $orderId = DB::table('orders')->insertGetId([
                'user_id' => $userId,
                'total_price' => 0,
                'status' => $status,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            $orderIds[] = $orderId;

            $firstMealId = $mealIds[$index % count($mealIds)];
            $secondMealId = $mealIds[($index + 1) % count($mealIds)];

            $firstMeal = DB::table('meals')
                ->where('id', $firstMealId)
                ->first();

            $secondMeal = DB::table('meals')
                ->where('id', $secondMealId)
                ->first();

            $firstPrice = $firstMeal->is_on_sale && $firstMeal->discount_price
                ? $firstMeal->discount_price
                : $firstMeal->price;

            $secondPrice = $secondMeal->is_on_sale && $secondMeal->discount_price
                ? $secondMeal->discount_price
                : $secondMeal->price;

            $firstQuantity = ($index % 3) + 1;
            $secondQuantity = ($index % 2) + 1;

            DB::table('order_items')->insert([
                [
                    'order_id' => $orderId,
                    'meal_id' => $firstMealId,
                    'quantity' => $firstQuantity,
                    'price' => $firstPrice,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
                [
                    'order_id' => $orderId,
                    'meal_id' => $secondMealId,
                    'quantity' => $secondQuantity,
                    'price' => $secondPrice,
                    'created_at' => now(),
                    'updated_at' => now(),
                ],
            ]);

            $totalPrice =
                ($firstPrice * $firstQuantity) +
                ($secondPrice * $secondQuantity);

            DB::table('orders')
                ->where('id', $orderId)
                ->update([
                    'total_price' => $totalPrice,
                    'updated_at' => now(),
                ]);
        }


        /*
        |--------------------------------------------------------------------------
        | RECOMMENDATIONS
        |--------------------------------------------------------------------------
        |
        | The project had a migration issue where the recommendations migration
        | could create the favorites table. Therefore we check that the table
        | really exists before inserting recommendation data.
        |
        */

        if (Schema::hasTable('recommendations')) {

            foreach ($userIds as $index => $userId) {

                $mealId = $mealIds[$index % count($mealIds)];

                DB::table('recommendations')->insert([
                    'user_id' => $userId,
                    'meal_id' => $mealId,
                    'beverage_id' => null,
                    'match_percentage' => 80 + ($index % 20),
                    'reason' => 'Recommended based on your food preferences and previous choices.',
                    'source' => 'AI',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }


        /*
        |--------------------------------------------------------------------------
        | FINISHED
        |--------------------------------------------------------------------------
        */

        $this->command->info('Fake data inserted successfully!');
        $this->command->info('Admin Email: admin@restaurant.com');
        $this->command->info('Admin Password: password');
        $this->command->info('User Password: password');
    }
}
