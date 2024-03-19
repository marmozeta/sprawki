<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Menu;
use Illuminate\Support\Facades\Auth;
use App\Models\Role;
use Illuminate\Contracts\View\View;

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
        
        view()->composer('*', function($view) {
            if(auth()->check() && auth()->user()->is_admin==1) {
                $user_permissions = array('modify' => array(), 'remove' => array());
                $roleModel = new Role;
                $permissions = $roleModel->getUserPermissions(auth()->user()->id);
                foreach($permissions as $perm) {
                    $user_permissions[$perm->perm_type][] = $perm->perm_module;
                }
                view()->share(compact('user_permissions'));
            }
        });
        
       
    }
}
