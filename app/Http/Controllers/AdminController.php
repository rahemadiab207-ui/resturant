<?php

namespace App\Http\Controllers;

use App\Models\Meal;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Dashboard
    |--------------------------------------------------------------------------
    */

    public function dashboard()
    {
        $monthlySales = Order::whereYear(
            'created_at',
            Carbon::now()->year
        )
            ->whereMonth(
                'created_at',
                Carbon::now()->month
            )
            ->where('status', 'Completed')
            ->sum('total_price');

        $yearlySales = Order::whereYear(
            'created_at',
            Carbon::now()->year
        )
            ->where('status', 'Completed')
            ->sum('total_price');

        $totalUsers = User::where(
            'role',
            'user'
        )->count();

        $topMeals = OrderItem::select(
            'meal_id',
            DB::raw('SUM(quantity) as total_qty')
        )
            ->whereNotNull('meal_id')
            ->groupBy('meal_id')
            ->orderByDesc('total_qty')
            ->limit(5)
            ->with('meal')
            ->get();

        $meals = Meal::with('category')
            ->latest()
            ->get();

        $totalOrders = Order::count();

        $pendingOrders = Order::where(
            'status',
            'Pending'
        )->count();

        return view(
            'admin.dashboard',
            compact(
                'monthlySales',
                'yearlySales',
                'totalUsers',
                'topMeals',
                'meals',
                'totalOrders',
                'pendingOrders'
            )
        );
    }


    /*
    |--------------------------------------------------------------------------
    | Orders
    |--------------------------------------------------------------------------
    */

    public function orders()
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
    | Update Order Status
    |--------------------------------------------------------------------------
    */

    public function updateOrderStatus(
        Request $request,
        Order $order
    ) {
        $validated = $request->validate([
            'status' => [
                'required',
                'in:Pending,Confirmed,Preparing,Ready,Out for Delivery,Completed,Cancelled',
            ],
        ]);

        $order->update([
            'status' => $validated['status'],
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                'Order status updated successfully.'
            );
    }
}