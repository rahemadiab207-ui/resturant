<?php

namespace App\Http\Controllers;

use App\Models\Beverage;
use Illuminate\Http\Request;

class BeverageController extends Controller
{
    public function index()
    {
        $beverages = Beverage::latest()->get();

        return view(
            'beverages.index',
            compact('beverages')
        );
    }

    public function create()
    {
        return view('beverages.create');
    }

    public function store(Request $request)
    {
        $validated = $this->validateBeverage($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('beverages', 'public');
        }

        $validated['is_on_sale'] =
            !empty($validated['discount_price']) &&
            $validated['discount_price'] < $validated['price'];

        $validated['is_available'] =
            $request->boolean('is_available');

        Beverage::create($validated);

        return redirect()
            ->route('beverages')
            ->with('success', 'تم إضافة المشروب بنجاح.');
    }

    public function show(Beverage $beverage)
    {
        return view(
            'beverages.show',
            compact('beverage')
        );
    }

    public function edit(Beverage $beverage)
    {
        return view(
            'beverages.edit',
            compact('beverage')
        );
    }

    public function update(Request $request, Beverage $beverage)
    {
        $validated = $this->validateBeverage($request);

        if ($request->hasFile('image')) {
            $validated['image'] = $request
                ->file('image')
                ->store('beverages', 'public');
        }

        $validated['is_on_sale'] =
            !empty($validated['discount_price']) &&
            $validated['discount_price'] < $validated['price'];

        $validated['is_available'] =
            $request->boolean('is_available');

        $beverage->update($validated);

        return redirect()
            ->route('beverages')
            ->with('success', 'تم تعديل المشروب بنجاح.');
    }

    public function destroy(Beverage $beverage)
    {
        $beverage->delete();

        return redirect()
            ->route('beverages')
            ->with('success', 'تم حذف المشروب بنجاح.');
    }

    private function validateBeverage(Request $request): array
    {
        return $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:5000',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0|lte:price',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'calories' => 'nullable|integer|min:0',
            'is_available' => 'nullable|boolean',
        ]);
    }
}