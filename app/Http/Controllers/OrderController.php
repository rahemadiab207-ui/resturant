<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with([
            'user',
            'items.meal',
        ])
            ->latest()
            ->get();

        return view(
            'admin.orders',
            compact('orders')
        );
    }

    public function show($id)
    {
        $order = Order::with([
            'user',
            'items.meal',
        ])->findOrFail($id);

        return view(
            'admin.order-show',
            compact('order')
        );
    }

    public function updateStatus(Request $request, $id)
    {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:Pending,Preparing,Out for Delivery,Completed,Canceled',
            ],
        ]);

        $order = Order::findOrFail($id);

        $order->update([
            'status' => $validated['status'],
        ]);

        return back()->with(
            'success',
            'تم تحديث حالة الطلب بنجاح.'
        );
    }
}