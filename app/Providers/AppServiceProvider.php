<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Session;

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
    public function boot()
    {
        
        Schema::defaultStringLength(191);
        // You can access the request object from the service container
        
        $locale = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
        if ($locale[0] == 'locale') {
           Session::put('locale', $locale[1]);
           App::setLocale(Session::get('locale'));
        }
        return redirect()->back();
        
        
    }
}
