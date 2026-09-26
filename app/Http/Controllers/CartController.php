<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);

        $total = collect($cart)->sum(function ($item) {
            return $item['price'] * $item['quantity'];
        });

        return view(
            'cart.index',
            compact('cart', 'total')
        );
    }

    public function add(Request $request, $id)
    {
        $validated = $request->validate([
            'quantity' => 'nullable|integer|min:1|max:99',
        ]);

        $meal = Meal::findOrFail($id);

        if (!$meal->is_available) {
            return back()->with(
                'error',
                'هذه الوجبة غير متاحة حالياً.'
            );
        }

        $cart = session()->get('cart', []);

        $quantity = $validated['quantity'] ?? 1;

        if (isset($cart[$id])) {
            $cart[$id]['quantity'] += $quantity;
        } else {
            $cart[$id] = [
                'id' => $meal->id,
                'name' => $meal->name,
                'quantity' => $quantity,
                'original_price' => (float) $meal->price,
                'price' => (float) $meal->active_price,
                'discount' => $meal->discount_price,
                'image' => $meal->image,
            ];
        }

        session()->put('cart', $cart);

        return back()->with(
            'success',
            'تمت إضافة الوجبة إلى السلة بنجاح.'
        );
    }

    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return back()->with(
            'success',
            'تم حذف الوجبة من السلة.'
        );
    }
}