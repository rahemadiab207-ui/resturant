<?php
namespace App\Http\Controllers;


use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Meal;
use Illuminate\Http\Request;

class OrderItemController extends Controller
{
    // 1. إضافة عنصر/وجبة جديدة إلى طلب قائم
    public function store(Request $request, Order $order)
    {
        $request->validate([
            'meal_id'  => 'required|exists:meals,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $meal = Meal::findOrFail($request->meal_id);

        // التحقق مما إذا كانت الوجبة مضافة مسبقاً للطلب لتحديث الكمية فقط
        $existingItem = OrderItem::where('order_id', $order->id)
                                 ->where('meal_id', $meal->id)
                                 ->first();

        if ($existingItem) {
            $existingItem->quantity += $request->quantity;
            $existingItem->price = $meal->price; // تحديث السعر بناءً على سعر الوجبة الحالي
            $existingItem->save();
        } else {
            OrderItem::create([
                'order_id' => $order->id,
                'meal_id'  => $meal->id,
                'quantity' => $request->quantity,
                'price'    => $meal->price,
            ]);
        }

        // تحديث إجمالي سعر الطلب الكلي (Total Amount)
        $this->updateOrderTotal($order);

        return redirect()->back()->with('success', 'تمت إضافة الوجبة للطلب بنجاح!');
    }

    // 2. تحديث كمية عنصر معين داخل الطلب
    public function update(Request $request, OrderItem $orderItem)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $orderItem->update([
            'quantity' => $request->quantity,
        ]);

        // إعادة حساب إجمالي الطلب
        $this->updateOrderTotal($orderItem->order);

        return redirect()->back()->with('success', 'تم تحديث الكمية بنجاح!');
    }

    // 3. حذف عنصر من الطلب
    public function destroy(OrderItem $orderItem)
    {
        $order = $orderItem->order;
        
        $orderItem->delete();

        // إعادة حساب إجمالي الطلب بعد الحذف
        $this->updateOrderTotal($order);

        return redirect()->back()->with('success', 'تم إزالة الوجبة من الطلب!');
    }

    // دالة مساعدة لإعادة حساب إجمالي مبلغ الطلب الكلي
    private function updateOrderTotal(Order $order)
    {
        $total = $order->items->sum(function ($item) {
            return $item->price * $item->quantity;
        });

        $order->update(['total_price' => $total]);
    }
}