<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        return view('auth.login');
    }

    public function showRegister()
    {
        return view('auth.register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'phone1' => 'required|string|max:20',
            'phone2' => 'nullable|string|max:20',
            'address' => 'required|string|max:500',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'phone1' => $validated['phone1'],
            'phone2' => $validated['phone2'] ?? null,
            'address' => $validated['address'],
            'role' => 'user',
        ]);

        Auth::login($user);

        $request->session()->regenerate();

        return redirect()
            ->route('home')
            ->with('success', 'تم إنشاء الحساب وتسجيل الدخول بنجاح.');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!Auth::attempt($credentials)) {
            return back()
                ->withInput($request->only('email'))
                ->withErrors([
                    'email' => 'بيانات الدخول غير صحيحة.',
                ]);
        }

        $request->session()->regenerate();

        if (Auth::user()->isAdmin()) {
            return redirect()->route('dashboard');
        }

        return redirect()->route('home');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()
            ->route('home')
            ->with('success', 'تم تسجيل الخروج بنجاح.');
    }

    public function profile()
    {
        $user = Auth::user();

        if ($user->isAdmin()) {
            $todayOrdersCount = Order::whereDate(
                'created_at',
                Carbon::today()
            )->count();

            $pendingOrdersCount = Order::where(
                'status',
                'Pending'
            )->count();

            $todaySales = Order::whereDate(
                'created_at',
                Carbon::today()
            )
                ->where('status', 'Completed')
                ->sum('total_price');

            return view('profile.admin', compact(
                'user',
                'todayOrdersCount',
                'pendingOrdersCount',
                'todaySales'
            ));
        }

        $currentOrder = Order::where('user_id', $user->id)
            ->whereIn('status', [
                'Pending',
                'Preparing',
                'Out for Delivery',
            ])
            ->latest()
            ->first();

        $pastOrders = Order::where('user_id', $user->id)
            ->whereIn('status', [
                'Completed',
                'Canceled',
            ])
            ->latest()
            ->get();

        return view('profile.AllInfo', compact(
            'user',
            'currentOrder',
            'pastOrders'
        ));
    }
}