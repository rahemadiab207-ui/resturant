<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function liveSearch(Request $request)
    {
        $query = trim(
            $request->input('query', '')
        );

        if ($query === '') {
            return response()->json([
                'meals' => [],
                'categories' => [],
            ]);
        }

        $meals = Meal::where(function ($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%");
        })
            ->select([
                'id',
                'name',
                'price',
                'discount_price',
                'is_on_sale',
                'image',
            ])
            ->limit(5)
            ->get();

        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->select([
                'id',
                'name',
                'slug',
            ])
            ->limit(3)
            ->get();

        return response()->json([
            'meals' => $meals,
            'categories' => $categories,
        ]);
    }
}