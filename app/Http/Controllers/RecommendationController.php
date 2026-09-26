<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Beverage;
use Illuminate\Http\Request;

class RecommendationController extends Controller
{
    public function index(Request $request)
    {
        $user = auth()->user();

        $preferences = $user->preferences;

        $meals = Meal::with('category')
            ->where('is_available', true)
            ->get();

        $beverages = Beverage::with('category')
            ->where('is_available', true)
            ->get();

        $recommendations = collect();

        foreach ($meals as $meal) {
            $score = $this->mealScore(
                $meal,
                $preferences,
                $user
            );

            $recommendations->push([
                'type' => 'meal',
                'item' => $meal,
                'score' => min(100, round($score)),
                'reason' => $this->reason(
                    $meal,
                    $preferences,
                    $user
                ),
            ]);
        }

        foreach ($beverages as $beverage) {
            $score = $this->beverageScore(
                $beverage,
                $preferences
            );

            $recommendations->push([
                'type' => 'beverage',
                'item' => $beverage,
                'score' => min(100, round($score)),
                'reason' => $this->reason(
                    $beverage,
                    $preferences,
                    $user
                ),
            ]);
        }

        $recommendations = $recommendations
            ->sortByDesc('score')
            ->values();

        return view(
            'customer.recommendations',
            compact('recommendations')
        );
    }

    private function mealScore(
        $meal,
        $preferences,
        $user
    ): float {
        $score = 40;

        if (!$preferences) {
            return $score + $this->orderScore(
                $meal,
                $user
            );
        }

        $categories = strtolower(
            (string) $preferences->preferred_categories
        );

        $ingredients = strtolower(
            (string) $preferences->preferred_ingredients
        );

        $excluded = strtolower(
            (string) $preferences->excluded_ingredients
        );

        if (
            $meal->category &&
            $categories &&
            str_contains(
                $categories,
                strtolower($meal->category->name)
            )
        ) {
            $score += 20;
        }

        if ($ingredients && $meal->ingredients) {
            foreach (
                explode(',', $ingredients) as $ingredient
            ) {
                $ingredient = trim($ingredient);

                if (
                    $ingredient !== '' &&
                    str_contains(
                        strtolower($meal->ingredients),
                        $ingredient
                    )
                ) {
                    $score += 10;
                }
            }
        }

        if ($excluded && $meal->ingredients) {
            foreach (
                explode(',', $excluded) as $ingredient
            ) {
                $ingredient = trim($ingredient);

                if (
                    $ingredient !== '' &&
                    str_contains(
                        strtolower($meal->ingredients),
                        $ingredient
                    )
                ) {
                    $score -= 25;
                }
            }
        }

        if (
            $preferences->preferred_spicy_level !== null &&
            $meal->spicy_level !== null
        ) {
            $difference = abs(
                $preferences->preferred_spicy_level -
                $meal->spicy_level
            );

            $score += max(
                0,
                15 - ($difference * 3)
            );
        }

        if (
            $preferences->minimum_budget !== null &&
            $meal->active_price >=
            $preferences->minimum_budget
        ) {
            $score += 5;
        }

        if (
            $preferences->maximum_budget !== null &&
            $meal->active_price <=
            $preferences->maximum_budget
        ) {
            $score += 10;
        }

        $score += $this->orderScore(
            $meal,
            $user
        );

        return $score;
    }

    private function beverageScore(
        $beverage,
        $preferences
    ): float {
        $score = 40;

        if (!$preferences) {
            return $score;
        }

        if (
            $preferences->maximum_budget !== null &&
            $beverage->active_price <=
            $preferences->maximum_budget
        ) {
            $score += 15;
        }

        if (
            $preferences->preferred_spicy_level !== null &&
            $beverage->spicy_level !== null
        ) {
            $difference = abs(
                $preferences->preferred_spicy_level -
                $beverage->spicy_level
            );

            $score += max(
                0,
                10 - ($difference * 2)
            );
        }

        if (
            $preferences->preferred_ingredients &&
            $beverage->ingredients
        ) {
            foreach (
                explode(
                    ',',
                    strtolower(
                        $preferences->preferred_ingredients
                    )
                ) as $ingredient
            ) {
                $ingredient = trim($ingredient);

                if (
                    $ingredient !== '' &&
                    str_contains(
                        strtolower($beverage->ingredients),
                        $ingredient
                    )
                ) {
                    $score += 10;
                }
            }
        }

        return $score;
    }

    private function orderScore(
        $item,
        $user
    ): float {
        $count = $user->orders()
            ->whereHas(
                'items',
                function ($query) use ($item) {
                    $query->where(
                        'meal_id',
                        $item->id
                    );
                }
            )
            ->count();

        return min(15, $count * 3);
    }

    private function reason(
        $item,
        $preferences,
        $user
    ): string {
        $reasons = [];

        if (
            $preferences?->preferred_categories &&
            $item->category
        ) {
            if (
                str_contains(
                    strtolower(
                        $preferences->preferred_categories
                    ),
                    strtolower(
                        $item->category->name
                    )
                )
            ) {
                $reasons[] =
                    'matches your preferred category';
            }
        }

        if (
            $preferences?->preferred_ingredients &&
            $item->ingredients
        ) {
            foreach (
                explode(
                    ',',
                    strtolower(
                        $preferences->preferred_ingredients
                    )
                ) as $ingredient
            ) {
                $ingredient = trim($ingredient);

                if (
                    $ingredient !== '' &&
                    str_contains(
                        strtolower(
                            $item->ingredients
                        ),
                        $ingredient
                    )
                ) {
                    $reasons[] =
                        'contains ingredients you prefer';

                    break;
                }
            }
        }

        if (
            $item->id &&
            $this->orderScore($item, $user) > 0
        ) {
            $reasons[] =
                'similar to your previous orders';
        }

        return $reasons
            ? ucfirst(
                implode(' and ', $reasons)
            ) . '.'
            : 'Recommended based on your available menu.';
    }
}

