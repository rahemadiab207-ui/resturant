<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

use App\Models\Meal;
use App\Models\Category;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\MealController;
use App\Http\Controllers\BeverageController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\AdminChatbotController;
use App\Http\Controllers\CustomerChatbotController;
use App\Http\Controllers\CustomerPreferenceController;
use App\Http\Controllers\CustomerRecommendationController;
use App\Http\Controllers\CustomerDashboardController;
use App\Http\Controllers\FavoriteController;


/*
|--------------------------------------------------------------------------
| Public Home
|--------------------------------------------------------------------------
*/

Route::get('/', function () {

    $meals = Meal::with('category')
        ->where('is_available', true)
        ->latest()
        ->get();

    $categories = Category::withCount('meals')
        ->latest()
        ->get();

    return view('home.home', compact(
        'meals',
        'categories'
    ));

})->name('home');


/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [AuthController::class, 'showLogin'])
        ->name('login.form');

    Route::post('/login', [AuthController::class, 'login'])
        ->name('login');


    // Register
    Route::get('/register', [AuthController::class, 'showRegister'])
        ->name('register.form');

    Route::post('/register', [AuthController::class, 'register'])
        ->name('register');

});


/*
|--------------------------------------------------------------------------
| Logout
|--------------------------------------------------------------------------
*/

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');


/*
|--------------------------------------------------------------------------
| Live Search
|--------------------------------------------------------------------------
*/

Route::get('/search/live', [SearchController::class, 'liveSearch'])
    ->name('search.live');


/*
|--------------------------------------------------------------------------
| Cart
|--------------------------------------------------------------------------
|
| Current CartController supports Meals.
| Beverage cart support will be added after checking
| Order / OrderItem database structure.
|
*/

Route::get('/cart', [CartController::class, 'index'])
    ->name('cart');

Route::post('/cart/add/{id}', [CartController::class, 'add'])
    ->name('cart.add');

Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])
    ->name('cart.remove');


/*
|--------------------------------------------------------------------------
| ADMIN ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'admin'])
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Admin Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [AdminController::class, 'dashboard'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Categories
        |--------------------------------------------------------------------------
        */

        Route::get('/admin/categories', [CategoryController::class, 'index'])
            ->name('categories.index');

        Route::get('/admin/categories/create', [CategoryController::class, 'create'])
            ->name('categories.create');

        Route::post('/admin/categories', [CategoryController::class, 'store'])
            ->name('categories.store');

        Route::get('/admin/categories/{category}', [CategoryController::class, 'show'])
            ->name('categories.show');

        Route::get('/admin/categories/{category}/edit', [CategoryController::class, 'edit'])
            ->name('categories.edit');

        Route::put('/admin/categories/{category}', [CategoryController::class, 'update'])
            ->name('categories.update');

        Route::delete('/admin/categories/{category}', [CategoryController::class, 'destroy'])
            ->name('categories.destroy');


        /*
        |--------------------------------------------------------------------------
        | Meals
        |--------------------------------------------------------------------------
        */

        Route::get('/admin/meals', [MealController::class, 'index'])
            ->name('meals.index');

        Route::get('/admin/meals/create', [MealController::class, 'create'])
            ->name('meals.create');

        Route::post('/admin/meals', [MealController::class, 'store'])
            ->name('meals.store');

        Route::get('/admin/meals/{meal}', [MealController::class, 'show'])
            ->name('meals.show');

        Route::get('/admin/meals/{meal}/edit', [MealController::class, 'edit'])
            ->name('meals.edit');

        Route::put('/admin/meals/{meal}', [MealController::class, 'update'])
            ->name('meals.update');

        Route::delete('/admin/meals/{meal}', [MealController::class, 'destroy'])
            ->name('meals.destroy');


        /*
        |--------------------------------------------------------------------------
        | Beverages
        |--------------------------------------------------------------------------
        */

        Route::get('/admin/beverages', [BeverageController::class, 'index'])
            ->name('beverages.index');

        Route::get('/admin/beverages/create', [BeverageController::class, 'create'])
            ->name('beverages.create');

        Route::post('/admin/beverages', [BeverageController::class, 'store'])
            ->name('beverages.store');

        Route::get('/admin/beverages/{beverage}', [BeverageController::class, 'show'])
            ->name('beverages.show');

        Route::get('/admin/beverages/{beverage}/edit', [BeverageController::class, 'edit'])
            ->name('beverages.edit');

        Route::put('/admin/beverages/{beverage}', [BeverageController::class, 'update'])
            ->name('beverages.update');

        Route::delete('/admin/beverages/{beverage}', [BeverageController::class, 'destroy'])
            ->name('beverages.destroy');


        /*
        |--------------------------------------------------------------------------
        | Admin Orders
        |--------------------------------------------------------------------------
        */

        Route::get('/admin/orders', [OrderController::class, 'index'])
            ->name('orders');

        Route::get('/admin/orders/{order}', [OrderController::class, 'show'])
            ->name('orders.show');

        Route::put('/admin/orders/{order}/status', [OrderController::class, 'updateStatus'])
            ->name('orders.status');


        /*
        |--------------------------------------------------------------------------
        | Customers
        |--------------------------------------------------------------------------
        */

        Route::get('/admin/customers', [CustomerController::class, 'index'])
            ->name('customers.index');

        Route::get('/admin/customers/create', [CustomerController::class, 'create'])
            ->name('customers.create');

        Route::post('/admin/customers', [CustomerController::class, 'store'])
            ->name('customers.store');

        Route::get('/admin/customers/{customer}', [CustomerController::class, 'show'])
            ->name('customers.show');

        Route::get('/admin/customers/{customer}/edit', [CustomerController::class, 'edit'])
            ->name('customers.edit');

        Route::put('/admin/customers/{customer}', [CustomerController::class, 'update'])
            ->name('customers.update');

        Route::delete('/admin/customers/{customer}', [CustomerController::class, 'destroy'])
            ->name('customers.destroy');


        /*
        |--------------------------------------------------------------------------
        | Admin Chatbot
        |--------------------------------------------------------------------------
        */

        Route::get('/admin-ai-chatbot', [AdminChatbotController::class, 'index'])
            ->name('chatbot');

        Route::post('/admin-ai-chatbot/respond', [AdminChatbotController::class, 'respond'])
            ->name('chatbot.respond');

    });


/*
|--------------------------------------------------------------------------
| CUSTOMER / CUSTOMER2 ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')
    ->prefix('customer')
    ->name('customer.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Customer2 Dashboard / Home
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [CustomerDashboardController::class, 'index'])
            ->name('dashboard');


        /*
        |--------------------------------------------------------------------------
        | Favorites
        |--------------------------------------------------------------------------
        */

        Route::get('/favorites', [FavoriteController::class, 'index'])
            ->name('favorites');

        // Add Meal to Favorites
        Route::post('/favorites/meal/{meal}', [FavoriteController::class, 'addMeal'])
            ->name('favorites.meal.add');

        // Add Beverage to Favorites
        Route::post('/favorites/beverage/{beverage}', [FavoriteController::class, 'addBeverage'])
            ->name('favorites.beverage.add');

        // Remove Favorite
        Route::delete('/favorites/{favorite}', [FavoriteController::class, 'destroy'])
            ->name('favorites.destroy');


        /*
        |--------------------------------------------------------------------------
        | Customer Preferences
        |--------------------------------------------------------------------------
        */

        Route::get('/preferences', [CustomerPreferenceController::class, 'edit'])
            ->name('preferences');

        Route::put('/preferences', [CustomerPreferenceController::class, 'update'])
            ->name('preferences.update');


        /*
        |--------------------------------------------------------------------------
        | Recommendations
        |--------------------------------------------------------------------------
        */

        Route::get('/recommendations', [CustomerRecommendationController::class, 'index'])
            ->name('recommendations');


        /*
        |--------------------------------------------------------------------------
        | Customer Chatbot
        |--------------------------------------------------------------------------
        */

        Route::get('/chatbot', [CustomerChatbotController::class, 'index'])
            ->name('chatbot');

        Route::post('/chatbot/respond', [CustomerChatbotController::class, 'respond'])
            ->name('chatbot.respond');

    });


/*
|--------------------------------------------------------------------------
| Customer Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::get('/profile', [AuthController::class, 'profile'])
        ->name('profile');

});


/*
|--------------------------------------------------------------------------
| Database Seeder
|--------------------------------------------------------------------------
|
| Temporary route for development.
| Remove this route in production.
|
*/

Route::get('/seed-database', function () {

    Artisan::call('db:seed', [
        '--class' => 'Database\\Seeders\\DatabaseSeeder',
        '--force' => true,
    ]);

    return 'Fake data seeded successfully!';

});
