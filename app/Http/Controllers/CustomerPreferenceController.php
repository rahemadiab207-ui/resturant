<?php

namespace App\Http\Controllers;

use App\Models\CustomerPreference;
use Illuminate\Http\Request;

class CustomerPreferenceController extends Controller
{
    public function edit()
    {
        $preference = CustomerPreference::firstOrCreate([
            'user_id' => auth()->id(),
        ]);

        return view(
            'customer.preferences',
            compact('preference')
        );
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'preferred_categories' => 'nullable|string|max:2000',
            'preferred_ingredients' => 'nullable|string|max:2000',
            'excluded_ingredients' => 'nullable|string|max:2000',
            'preferred_spicy_level' => 'nullable|integer|min:0|max:5',
            'minimum_calories' => 'nullable|integer|min:0',
            'maximum_calories' => 'nullable|integer|min:0',
            'minimum_budget' => 'nullable|numeric|min:0',
            'maximum_budget' => 'nullable|numeric|min:0',
            'preferences_text' => 'nullable|string|max:5000',
        ]);

        CustomerPreference::updateOrCreate(
            ['user_id' => auth()->id()],
            $validated
        );

        return back()->with(
            'success',
            'تم تحديث تفضيلاتك بنجاح.'
        );
    }
}