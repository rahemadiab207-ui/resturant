<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Meal;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $monthlySales = Order::whereYear('created_at', Carbon::now()->year)
                             ->whereMonth('created_at', Carbon::now()->month)
                             ->sum('total_price');

        $yearlySales = Order::whereYear('created_at', Carbon::now()->year)
                            ->sum('total_price');

        $totalUsers = User::where('role', 'user')->count();

        $topMeals = OrderItem::select('meal_id', DB::raw('SUM(quantity) as total_qty'))
                             ->groupBy('meal_id')
                             ->orderByDesc('total_qty')
                             ->limit(5)
                             ->with('meal')
                             ->get();

                             
                            $meals = Meal::with('category')->latest()->get();
        return view('admin.dashboard', compact('monthlySales', 'yearlySales', 'totalUsers', 'topMeals' , 'meals'));
    }

    public function orders()
    {
        $orders = Order::with(['user', 'items.meal'])->latest()->get();
        return view('admin.orders', compact('orders'));
    }

    public function updateOrderStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);
        return redirect()->back()->with('success', 'تم تحديث حالة الطلب بنجاح!');
    }

    public function updateDiscount(Request $request, $id)
    {
        $meal = Meal::findOrFail($id);
        $meal->update([
            'price'          => $request->price,
            'discount_price' => $request->discount_price,
            'is_on_sale'     => $request->has('is_on_sale'),
        ]);

        return redirect()->back()->with('success', 'تم تحديث الخصم بنجاح!');
    }
}
