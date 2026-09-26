<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Meal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MealController extends Controller
{
    public function index()
    {
        $meals = Meal::with('category')
            ->latest()
            ->get();

        return view('meals.index', compact('meals'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('meals.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',

            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',

            'category_id' => 'required|exists:categories,id',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'ingredients' => 'nullable|string',

            'calories' => 'nullable|integer|min:0',

            'spicy_level' => 'nullable|integer|min:0|max:5',

            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Basic values
        |--------------------------------------------------------------------------
        */

        $validated['is_on_sale'] = $request->boolean('is_on_sale');

        $validated['is_available'] = $request->boolean('is_available');

        $validated['rating'] = $validated['rating'] ?? 0;

        $validated['spicy_level'] = $validated['spicy_level'] ?? 0;


        /*
        |--------------------------------------------------------------------------
        | Food Properties
        |--------------------------------------------------------------------------
        */

        $validated['is_spicy'] = $request->boolean('is_spicy');

        $validated['has_cheese'] = $request->boolean('has_cheese');

        $validated['has_chicken'] = $request->boolean('has_chicken');

        $validated['has_meat'] = $request->boolean('has_meat');

        $validated['has_mushroom'] = $request->boolean('has_mushroom');

        $validated['is_vegetarian'] = $request->boolean('is_vegetarian');

        $validated['is_healthy'] = $request->boolean('is_healthy');

        $validated['is_vegan'] = $request->boolean('is_vegan');

        $validated['is_gluten_free'] = $request->boolean('is_gluten_free');

        $validated['is_dairy_free'] = $request->boolean('is_dairy_free');

        $validated['is_high_protein'] = $request->boolean('is_high_protein');

        $validated['is_low_calorie'] = $request->boolean('is_low_calorie');


        /*
        |--------------------------------------------------------------------------
        | Discount
        |--------------------------------------------------------------------------
        */

        if (!$validated['is_on_sale']) {
            $validated['discount_price'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('meals', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Create Meal
        |--------------------------------------------------------------------------
        */

        Meal::create($validated);

        return redirect()
            ->route('meals')
            ->with('success', 'Meal added successfully.');
    }

    public function show(Meal $meal)
    {
        $meal->load('category');

        return view('meals.show', compact('meal'));
    }

    public function edit(Meal $meal)
    {
        $categories = Category::orderBy('name')->get();

        return view(
            'meals.edit',
            compact('meal', 'categories')
        );
    }

    public function update(Request $request, Meal $meal)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',

            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',

            'category_id' => 'required|exists:categories,id',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',

            'ingredients' => 'nullable|string',

            'calories' => 'nullable|integer|min:0',

            'spicy_level' => 'nullable|integer|min:0|max:5',

            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Basic values
        |--------------------------------------------------------------------------
        */

        $validated['is_on_sale'] = $request->boolean('is_on_sale');

        $validated['is_available'] = $request->boolean('is_available');

        $validated['rating'] = $validated['rating'] ?? 0;

        $validated['spicy_level'] = $validated['spicy_level'] ?? 0;


        /*
        |--------------------------------------------------------------------------
        | Food Properties
        |--------------------------------------------------------------------------
        */

        $validated['is_spicy'] = $request->boolean('is_spicy');

        $validated['has_cheese'] = $request->boolean('has_cheese');

        $validated['has_chicken'] = $request->boolean('has_chicken');

        $validated['has_meat'] = $request->boolean('has_meat');

        $validated['has_mushroom'] = $request->boolean('has_mushroom');

        $validated['is_vegetarian'] = $request->boolean('is_vegetarian');

        $validated['is_healthy'] = $request->boolean('is_healthy');

        $validated['is_vegan'] = $request->boolean('is_vegan');

        $validated['is_gluten_free'] = $request->boolean('is_gluten_free');

        $validated['is_dairy_free'] = $request->boolean('is_dairy_free');

        $validated['is_high_protein'] = $request->boolean('is_high_protein');

        $validated['is_low_calorie'] = $request->boolean('is_low_calorie');


        /*
        |--------------------------------------------------------------------------
        | Discount
        |--------------------------------------------------------------------------
        */

        if (!$validated['is_on_sale']) {
            $validated['discount_price'] = null;
        }


        /*
        |--------------------------------------------------------------------------
        | Image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('image')) {

            if (
                $meal->image &&
                Storage::disk('public')->exists($meal->image)
            ) {
                Storage::disk('public')->delete($meal->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('meals', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $meal->update($validated);

        return redirect()
            ->route('meals')
            ->with('success', 'Meal updated successfully.');
    }

    public function destroy(Meal $meal)
    {
        if (
            $meal->image &&
            Storage::disk('public')->exists($meal->image)
        ) {
            Storage::disk('public')->delete($meal->image);
        }

        $meal->delete();

        return redirect()
            ->route('meals')
            ->with('success', 'Meal deleted successfully.');
    }
}