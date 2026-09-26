<?php

namespace App\Http\Controllers;

use App\Models\Favorite;
use App\Models\Meal;
use App\Models\Beverage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Favorites Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $favorites = Favorite::with([
            'meal.category',
            'beverage',
        ])
            ->where('user_id', Auth::id())
            ->latest()
            ->get();

        return view('customer2.favorites', compact('favorites'));
    }


    /*
    |--------------------------------------------------------------------------
    | Add Meal To Favorites
    |--------------------------------------------------------------------------
    */

    public function addMeal($mealId)
    {
        $meal = Meal::where('id', $mealId)
            ->where('is_available', true)
            ->firstOrFail();

        Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'meal_id' => $meal->id,
        ]);

        return back()->with('success', 'Meal added to favorites.');
    }


    /*
    |--------------------------------------------------------------------------
    | Add Beverage To Favorites
    |--------------------------------------------------------------------------
    */

    public function addBeverage($beverageId)
    {
        $beverage = Beverage::where('id', $beverageId)
            ->where('is_available', true)
            ->firstOrFail();

        Favorite::firstOrCreate([
            'user_id' => Auth::id(),
            'beverage_id' => $beverage->id,
        ]);

        return back()->with('success', 'Beverage added to favorites.');
    }


    /*
    |--------------------------------------------------------------------------
    | Remove Favorite
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $favorite = Favorite::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $favorite->delete();

        return back()->with('success', 'Removed from favorites.');
    }
}
