<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function showLogin() { return view('auth.login'); }
    
    public function showRegister() { return view('auth.register'); }

    public function register(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:255',
        'email'    => 'required|string|email|unique:users',
        'password' => 'required|string|min:6',
        'phone1'   => 'required|string|max:20',
        'phone2'   => 'nullable|string|max:20',
        'address'  => 'required|string',
        'role'     => 'required|in:user,admin',
    ]);

    $user = User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'phone1'   => $request->phone1,
        'phone2'   => $request->phone2,
        'address'  => $request->address,
        'role'     => $request->role,
    ]);

    Auth::login($user);

    if ($user->role === 'al-shami1@gmail.com,admin-1gmail.com') {
        return redirect()->route('admin.dashboard')->with('success', 'أهلاً بك في لوحة تحكم الأدمن');
    }
    if ($user->email=== 'admin') {
        return redirect()->route('admin.dashboard')->with('success', 'أهلاً بك في لوحة تحكم الأدمن');
    }

    return redirect()->route('home')->with('success', 'تم إنشاء الحساب بنجاح!');
}

    public function login(Request $request)
{
    $credentials = $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        $user = Auth::user();

        // التوجيه بحسب دور المستخدم
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        }

        return redirect()->route('home');
    }

    return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة']);
 }
       
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('home');
    }

    public function profile()
    {
        $user = Auth::user();
        if ($user->role === 'admin') {
        $todayOrdersCount = Order::whereDate('created_at', Carbon::today())->count();
        $pendingOrdersCount = Order::where('status', 'pending')->count();
        $todaySales = Order::whereDate('created_at', Carbon::today())
                            ->where('status', 'completed')
                            ->sum('total_price'); // أو total حسب اسم العمود عندك

        return view('profile.admin', compact('user', 'todayOrdersCount', 'pendingOrdersCount', 'todaySales'));
    }
             $currentOrder = Order::where('user_id', $user->id)
                         ->whereIn('status', ['pending', 'preparing', 'delivering'])
                         ->latest()
                         ->first();

    // جلب الطلبات السابقة (المكتملة أو الملقاة)
    $pastOrders = Order::where('user_id', $user->id)
                       ->whereIn('status', ['completed', 'cancelled'])
                       ->latest()
                       ->get();

    // إرسال جميع المتغيرات التي تحتاجها الصفحة
    return view('profile.AllInfo', compact('user', 'currentOrder', 'pastOrders'));
    // للمستخدم العادي
    
$currentOrder = Order::where('user_id', $user->id)->latest()->first();
return view('profile.AllInfo', compact('user', 'currentOrder'));
    }}