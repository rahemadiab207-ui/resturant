<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\BeverageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\StatisticsController;
use App\Http\Controllers\ChatbotController;

// Customer Controllers
use App\Http\Controllers\Customer\CustomerDashboardController;
use App\Http\Controllers\Customer\CartController;


// =========================
// Authentication
// =========================

Route::get('/login', [AuthController::class, 'showLogin'])
    ->name('login.form');

Route::post('/login', [AuthController::class, 'login'])
    ->name('login');


// =========================
// Customer Register
// =========================

Route::get('/register', [AuthController::class, 'showRegister'])
    ->name('register.form');

Route::post('/register', [AuthController::class, 'register'])
    ->name('register');


// =========================
// Customer Routes
// =========================

Route::middleware(['auth'])
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        // Customer Dashboard
        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])
            ->name('dashboard');


        // =========================
        // Customer Cart
        // =========================

        Route::get('/cart', [CartController::class, 'index'])
            ->name('cart');

        Route::post('/cart/add', [CartController::class, 'add'])
            ->name('cart.add');

        Route::post('/cart/update', [CartController::class, 'update'])
            ->name('cart.update');

        Route::post('/cart/remove', [CartController::class, 'remove'])
            ->name('cart.remove');
    });


// =========================
// Admin Routes
// =========================

Route::middleware('admin')->group(function () {


    // =========================
    // Dashboard
    // =========================

    Route::get('/home', [DashboardController::class, 'index'])
        ->name('home');

    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');


    // =========================
    // Categories
    // =========================

    Route::get('/categories', [CategoryController::class, 'index'])
        ->name('categories');

    Route::post('/categories', [CategoryController::class, 'store'])
        ->name('categories.store');

    Route::get('/categories/{id}/edit', [CategoryController::class, 'edit'])
        ->name('categories.edit');

    Route::put('/categories/{id}', [CategoryController::class, 'update'])
        ->name('categories.update');

    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])
        ->name('categories.destroy');


    // =========================
    // Food
    // =========================

    Route::get('/food', [FoodController::class, 'index'])
        ->name('food');

    Route::post('/food', [FoodController::class, 'store'])
        ->name('food.store');

    Route::get('/food/{id}/edit', [FoodController::class, 'edit'])
        ->name('food.edit');

    Route::put('/food/{id}', [FoodController::class, 'update'])
        ->name('food.update');

    Route::delete('/food/{id}', [FoodController::class, 'destroy'])
        ->name('food.destroy');


    // =========================
    // Beverages
    // =========================

    Route::get('/beverages', [BeverageController::class, 'index'])
        ->name('beverages');

    Route::post('/beverages', [BeverageController::class, 'store'])
        ->name('beverages.store');

    Route::get('/beverages/{id}/edit', [BeverageController::class, 'edit'])
        ->name('beverages.edit');

    Route::put('/beverages/{id}', [BeverageController::class, 'update'])
        ->name('beverages.update');

    Route::delete('/beverages/{id}', [BeverageController::class, 'destroy'])
        ->name('beverages.destroy');


    // =========================
    // Orders
    // =========================

    Route::get('/orders', [OrderController::class, 'index'])
        ->name('orders');

    Route::get('/orders/{id}', [OrderController::class, 'show'])
        ->name('orders.show');

    Route::put('/orders/{id}/status', [OrderController::class, 'updateStatus'])
        ->name('orders.status');


    // =========================
    // Customers
    // =========================

    Route::get('/customers', [CustomerController::class, 'index'])
        ->name('customers');

    Route::post('/customers', [CustomerController::class, 'store'])
        ->name('customers.store');

    Route::get('/customers/{id}/edit', [CustomerController::class, 'edit'])
        ->name('customers.edit');

    Route::get('/customers/{id}', [CustomerController::class, 'show'])
        ->name('customers.show');

    Route::put('/customers/{id}', [CustomerController::class, 'update'])
        ->name('customers.update');

    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])
        ->name('customers.destroy');


    // =========================
    // Statistics
    // =========================

    Route::get('/statistics', [StatisticsController::class, 'index'])
        ->name('statistics');


    // =========================
    // AI Chatbot
    // =========================

    Route::get('/chatbot', [ChatbotController::class, 'index'])
        ->name('chatbot');

    Route::post('/chatbot/respond', [ChatbotController::class, 'respond'])
        ->name('chatbot.respond');


    // =========================
    // Admin Logout
    // =========================

    Route::get('/logout', function () {

        session()->forget([
            'admin_id',
            'admin_name',
            'admin_email'
        ]);

        return redirect()->route('login.form');

    })->name('logout');

});