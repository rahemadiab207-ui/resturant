<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use App\Models\Beverage;

class CustomerDashboardController extends Controller
{
    public function index()
    {
        $categories = Category::latest()->get();

        $meals = Meal::with('category')
            ->where('is_available', true)
            ->latest()
            ->get();

        $beverages = Beverage::latest()->get();

        return view('customer.dashboard', compact(
            'categories',
            'meals',
            'beverages'
        ));
    }
}
