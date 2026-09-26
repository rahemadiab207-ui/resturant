<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Recommendation;
use Illuminate\Support\Facades\Auth;

class CustomerRecommendationController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $recommendations = Recommendation::with([
            'meal',
            'beverage',
        ])
        ->where('user_id', $userId)
        ->latest()
        ->get();

        if ($recommendations->isEmpty()) {
            $recommendations = Meal::where('is_available', true)
                ->latest()
                ->take(12)
                ->get();
        }

        return view(
            'customer.recommendations',
            compact('recommendations')
        );
    }
}
