<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\OrderItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MenuController;
// الصفحات العامة المتاحة للجميع
Route::get('/', [MealController::class, 'index'])->name('home');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('category.show');
Route::get('/live-search', [SearchController::class, 'liveSearch'])->name('live.search');

// مسارات السلة
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
// مسارات تسجيل الدخول والتسجيل
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// مسارات المستخدمين المسجلين
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/checkout', [OrderController::class, 'checkout'])->name('checkout'); 
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout'); 
    Route::get('/category/{slug}', [MenuController::class, 'Category'])->name('category.show');
});

// مسارات الأدمن المحمية (تم تصحيح الـ Prefix والروابط)
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/orders', [AdminController::class, 'orders'])->name('admin.orders');
    Route::post('/orders/update-status/{id}', [AdminController::class, 'updateOrderStatus'])->name('admin.orders.status');
    
    // إدارة الوجبات
    Route::get('/meals/create', [MealController::class, 'create'])->name('admin.meals.create');
    Route::post('/meals/store', [MealController::class, 'store'])->name('admin.meals.store');
    Route::get('/meals/{id}/delete', [MealController::class, 'delete'])->name('admin.meals.delete');
    Route::delete('/meals/{id}', [MealController::class, 'destroy'])->name('admin.meals.destroy');
    Route::post('/meals/discount/{id}', [AdminController::class, 'updateDiscount'])->name('admin.meals.discount');
});

// عناصر الطلبات
Route::post('/orders/{order}/items', [OrderItemController::class, 'store'])->name('order-items.store');
Route::put('/order-items/{orderItem}', [OrderItemController::class, 'update'])->name('order-items.update');
Route::delete('/order-items/{orderItem}', [OrderItemController::class, 'destroy'])->name('order-items.destroy');

Route::get('/menu', [MenuController::class, 'index'])->name('menu.index');
Route::get('/meal/{id}', [MenuController::class, 'show'])->name('meal.show');