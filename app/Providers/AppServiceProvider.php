<?php

namespace App\Providers;

use App\Models\Categorie;
use App\Models\Info;
use App\Models\Slide;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

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
        // View::composer([
        //     'manager_view.components.sidebar',
        //     'manager_view.components.header'
        // ], function ($view) {
        //     $guards = ['auth-manager', 'auth-employer'];
        //     $currentUser = null;

        //     foreach ($guards as $guard) {
        //         if (Auth::guard($guard)->check()) {
        //             $currentUser = Auth::guard($guard)->user();
        //             break;
        //         }
        //     }
        //     $view->with('currentUser', $currentUser);
        // });


    }
}
