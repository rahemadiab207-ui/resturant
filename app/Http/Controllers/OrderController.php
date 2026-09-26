<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Display All Orders
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | Display Single Order
    |--------------------------------------------------------------------------
    */

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


    /*
    |--------------------------------------------------------------------------
    | Update Order Status
    |--------------------------------------------------------------------------
    */

    public function updateStatus(Request $request, $id)
    {
        /*
        |--------------------------------------------------------------------------
        | Validate Status
        |--------------------------------------------------------------------------
        |
        | The database uses:
        |
        | pending
        | confirmed
        | preparing
        | ready
        | out_for_delivery
        | delivered
        | cancelled
        |
        */

        $statuses = array_keys(Order::statuses());

        $validated = $request->validate([
            'status' => [
                'required',
                'in:' . implode(',', $statuses),
            ],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Find Order
        |--------------------------------------------------------------------------
        */

        $order = Order::findOrFail($id);


        /*
        |--------------------------------------------------------------------------
        | Update Status
        |--------------------------------------------------------------------------
        */

        $order->update([
            'status' => $validated['status'],
        ]);


        /*
        |--------------------------------------------------------------------------
        | Return
        |--------------------------------------------------------------------------
        */

        return back()->with(
            'success',
            'تم تحديث حالة الطلب بنجاح.'
        );
    }
}
