<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Meal;

class MealSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Meal::create([
            'category_id' => 1,
            'name' => 'وجبة شاورما دجاج',
            'description' => 'شاورما دجاج مميزة مع الثومية والبطاطس',
            'price' => 120,
        ]);

        Meal::create([
            'category_id' => 1,
            'name' => 'وجبة شاورما لحم',
            'description' => 'شاورما لحم بلدي مع الطحينة والبقدونس',
            'price' => 140,
        ]);
    }
}