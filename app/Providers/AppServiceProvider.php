<?php

namespace App\Providers;

use App\Models\Area;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use Orangehill\Iseed\IseedServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        View::composer('backpack::auth.register', function($view) {
            return $view->with('areas', Area::all());
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        //
    }
}
