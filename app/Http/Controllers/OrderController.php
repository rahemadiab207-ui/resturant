<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $cart = session()->get('cart', []);
        if (empty($cart)) {
            return redirect()->back()->with('error', 'السلة فارغة!');
        }

        $totalPrice = 0;
        foreach ($cart as $item) {
            $totalPrice += $item['price'] * $item['quantity'];
        }

        $order = Order::create([
            'user_id'     => Auth::id(),
            'total_price' => $totalPrice,
            'status'      => 'Pending',
        ]);

        foreach ($cart as $mealId => $details) {
            OrderItem::create([
                'order_id' => $order->id,
                'meal_id'  => $mealId,
                'quantity' => $details['quantity'],
                'price'    => $details['price'],
            ]);
        }

        session()->forget('cart');

        return redirect()->route('profile')->with('success', 'تم إرسال طلبك بنجاح للتحضير!');
    }
}