<?php

namespace App\Providers;


use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use App\Models\Setting;
class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if (Schema::hasTable('settings')) {
            View::composer('*', function ($view) {
                $settings = Setting::pluck('value', 'key');
                $view->with('settings', $settings);
            });
        }
    }
}