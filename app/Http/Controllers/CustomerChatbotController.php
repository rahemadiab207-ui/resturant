<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Beverage;
use App\Models\Category;
use Illuminate\Http\Request;

class CustomerChatbotController extends Controller
{
    public function index()
    {
        return view('customer.chatbot');
    }

    public function respond(Request $request)
    {
        $message = trim($request->input('message', ''));

        if ($message === '') {
            return response()->json([
                'reply' => 'Please write your question first.'
            ]);
        }

        $message = mb_strtolower($message);

        $meals = Meal::with('category')
            ->where('is_available', true)
            ->get();

        $beverages = Beverage::all();

        $categories = Category::with('meals')->get();

        if (
            str_contains($message, 'menu') ||
            str_contains($message, 'menu') ||
            str_contains($message, 'اكل') ||
            str_contains($message, 'أكل') ||
            str_contains($message, 'وجبات') ||
            str_contains($message, 'الوجبات')
        ) {
            $items = $meals->take(10);

            if ($items->isEmpty()) {
                return response()->json([
                    'reply' => 'There are no available meals at the moment.'
                ]);
            }

            $names = $items
                ->map(fn ($meal) => $meal->name)
                ->implode(', ');

            return response()->json([
                'reply' => 'Available meals: ' . $names
            ]);
        }

        if (
            str_contains($message, 'drink') ||
            str_contains($message, 'drinks') ||
            str_contains($message, 'مشروب') ||
            str_contains($message, 'مشروبات')
        ) {
            if ($beverages->isEmpty()) {
                return response()->json([
                    'reply' => 'There are no available beverages at the moment.'
                ]);
            }

            $names = $beverages
                ->take(10)
                ->map(fn ($beverage) => $beverage->name)
                ->implode(', ');

            return response()->json([
                'reply' => 'Available beverages: ' . $names
            ]);
        }

        if (
            str_contains($message, 'category') ||
            str_contains($message, 'categories') ||
            str_contains($message, 'قسم') ||
            str_contains($message, 'اقسام') ||
            str_contains($message, 'الأقسام')
        ) {
            $names = $categories
                ->map(fn ($category) => $category->name)
                ->implode(', ');

            return response()->json([
                'reply' => $names
                    ? 'Available categories: ' . $names
                    : 'There are no categories available.'
            ]);
        }

        foreach ($meals as $meal) {
            $name = mb_strtolower($meal->name);

            if (
                str_contains($message, $name) ||
                str_contains($name, $message)
            ) {
                return response()->json([
                    'reply' =>
                        $meal->name .
                        ' - Price: ' .
                        number_format($meal->price, 2) .
                        ($meal->description
                            ? ' - ' . $meal->description
                            : '')
                ]);
            }
        }

        foreach ($categories as $category) {
            $name = mb_strtolower($category->name);

            if (
                str_contains($message, $name) ||
                str_contains($name, $message)
            ) {
                $categoryMeals = $category->meals
                    ->where('is_available', true)
                    ->take(10);

                if ($categoryMeals->isEmpty()) {
                    return response()->json([
                        'reply' => 'There are no available meals in this category.'
                    ]);
                }

                $names = $categoryMeals
                    ->map(fn ($meal) => $meal->name)
                    ->implode(', ');

                return response()->json([
                    'reply' =>
                        'Meals in ' .
                        $category->name .
                        ': ' .
                        $names
                ]);
            }
        }

        return response()->json([
            'reply' =>
                'I can help you with the menu, meals, categories, beverages, and prices.'
        ]);
    }
}
