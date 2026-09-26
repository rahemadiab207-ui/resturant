<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::withCount('meals')
            ->latest()
            ->get();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',

            'description' => 'nullable|string',

            'price' => 'required|numeric|min:0',

            'discount_price' => 'nullable|numeric|min:0',

            'rating' => 'nullable|numeric|min:0|max:5',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        $validated['slug'] = Str::slug($validated['name']);


        /*
        |--------------------------------------------------------------------------
        | Basic values
        |--------------------------------------------------------------------------
        */

        $validated['is_on_sale'] = $request->boolean('is_on_sale');

        $validated['rating'] = $validated['rating'] ?? 0;


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
                ->store('categories', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Create
        |--------------------------------------------------------------------------
        */

        Category::create($validated);

        return redirect()
            ->route('categories')
            ->with('success', 'Category added successfully.');
    }

    public function edit(Category $category)
    {
        return view(
            'categories.edit',
            compact('category')
        );
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,

            'description' => 'nullable|string',

            'price' => 'required|numeric|min:0',

            'discount_price' => 'nullable|numeric|min:0',

            'rating' => 'nullable|numeric|min:0|max:5',

            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
        ]);

        /*
        |--------------------------------------------------------------------------
        | Slug
        |--------------------------------------------------------------------------
        */

        $validated['slug'] = Str::slug($validated['name']);


        /*
        |--------------------------------------------------------------------------
        | Basic values
        |--------------------------------------------------------------------------
        */

        $validated['is_on_sale'] = $request->boolean('is_on_sale');

        $validated['rating'] = $validated['rating'] ?? 0;


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
                $category->image &&
                Storage::disk('public')->exists($category->image)
            ) {
                Storage::disk('public')->delete($category->image);
            }

            $validated['image'] = $request
                ->file('image')
                ->store('categories', 'public');
        }


        /*
        |--------------------------------------------------------------------------
        | Update
        |--------------------------------------------------------------------------
        */

        $category->update($validated);

        return redirect()
            ->route('categories')
            ->with('success', 'Category updated successfully.');
    }

    public function destroy(Category $category)
    {
        if (
            $category->image &&
            Storage::disk('public')->exists($category->image)
        ) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()
            ->route('categories')
            ->with('success', 'Category deleted successfully.');
    }
}