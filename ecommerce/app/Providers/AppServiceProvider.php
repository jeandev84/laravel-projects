<?php

namespace App\Providers;

use App\Category;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;



/**
 *
*/
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // Schema::defaultStringLength(191);

        // определяем глобальную переменную, которую используем на каждом контроллере

        // переменная $categories будет доступна для всего приложения
        $categories = Category::orderBy('id')->get();

        View::share([
            'categories' => $categories
        ]);
    }
}
