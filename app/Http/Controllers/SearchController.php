<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;
use App\Models\Category;

class SearchController extends Controller
{
    public function liveSearch(Request $request)
    {
        $query = $request->input('query');

        if (empty($query)) {
            return response()->json(['meals' => [], 'categories' => []]);
        }

        $meals = Meal::where('name', 'LIKE', "%{$query}%")
                     ->select('id', 'name', 'price', 'discount_price', 'is_on_sale', 'image')
                     ->limit(5)
                     ->get();

        $categories = Category::where('name', 'LIKE', "%{$query}%")
                              ->select('id', 'name', 'slug')
                              ->limit(3)
                              ->get();

        return response()->json([
            'meals'      => $meals,
            'categories' => $categories,
        ]);
    }
}
