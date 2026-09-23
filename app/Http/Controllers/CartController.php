<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Meal;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

   public function add(Request $request, $id)
{
    $meal = Meal::findOrFail($id);
    $cart = session()->get('cart', []);

    $finalPrice = $meal->price;
    $hasDiscount = false; // متغيّر لتتبع ما إذا كان هناك خصم أم لا

    // 1. إذا كان الخصم عبارة عن سعر بعد الخصم مباشرة (discount_price):
    if (isset($meal->discount_price) && $meal->discount_price > 0 && $meal->discount_price < $meal->price) {
        $finalPrice = $meal->discount_price;
        $hasDiscount = true;
    } 
    // 2. أما إذا كان الخصم عبارة عن نسبة مئوية (مثلاً discount = 20 يعني 20% خصم):
    elseif (isset($meal->discount) && $meal->discount > 0) {
        $finalPrice = $meal->price - ($meal->price * ($meal->discount / 100));
        $hasDiscount = true;
    }

    $quantity = $request->input('quantity', 1);

    // إذا كانت الوجبة موجودة سابقاً في السلة نزيد الكمية
    if (isset($cart[$id])) {
        $cart[$id]['quantity'] += $quantity;
    } else {
        // إضافة وجبة جديدة للسلة مع السعر الأصلي والسعر النهائي بعد الخصم
        $cart[$id] = [
            "name" => $meal->name,
            "quantity" => $quantity,
            "original_price" => $meal->price, // السعر الأصلي قبل الخصم
            "price" => $finalPrice,           // السعر الفعلي المخصوم المعتمد في السلة
            "discount" => $meal->discount ?? 0,
            "image" => $meal->image
        ];
    }

    // حفظ السلة في الـ Session
    session()->put('cart', $cart);

    // تحديد الرسالة المناسبة بناءً على وجود الخصم
    if ($hasDiscount) {
        $message = 'تمت إضافة الوجبة إلى السلة بالسعر المخصوم بنجاح!';
    } else {
        $message = 'تمت إضافة الوجبة إلى السلة بنجاح!';
    }

    return redirect()->back()->with('success', $message);
}
    public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
            session()->save();
        }

        return redirect()->back()->with('success', 'تم حذف الوجبة من السلة!');
    }
}
