<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // تأكدي من استدعاء الموديل

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'دجاج الشامي', 'slug' => 'chicken'],
            ['name' => 'شاورما الشامي', 'slug' => 'shawarma'],
            ['name' => 'سندوتشات الشامي', 'slug' => 'sandwiches'],
            ['name' => 'مقبلات الشامي', 'slug' => 'appetizers'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(
                ['slug' => $category['slug']], 
                ['name' => $category['name']]  );
        }
    }
}
