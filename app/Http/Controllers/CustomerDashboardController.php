<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use App\Models\Beverage;
use Illuminate\Support\Facades\Auth;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $categories = Category::withCount([
            'meals' => function ($query) {
                $query->where('is_available', true);
            }
        ])
            ->latest()
            ->get();


        $meals = Meal::with('category')
            ->where('is_available', true)
            ->latest()
            ->get();


        $beverages = Beverage::where('is_available', true)
            ->latest()
            ->get();


        return view('customer2.dashboard', compact(
            'categories',
            'meals',
            'beverages'
        ));
    }
}
