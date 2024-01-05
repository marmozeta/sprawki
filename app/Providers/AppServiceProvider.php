<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $menus = Menu::all();
        view()->share(compact('menus'));
        
        $menus_front = Menu::where('in_menu', 1)->orderBy('ordinal_number')->get();
        view()->share(compact('menus_front'));
    }
}
