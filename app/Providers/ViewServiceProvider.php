<?php

namespace App\Providers;

use App\Models\Institution;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
         /* view()->composer('*', function ($view) {
        $institution = Institution::first();
        $view->with('institution', $institution);
    });  */
    if (Schema::hasTable('institutions')) {
        View::share('institution', cache()->remember('institution', now()->addDay(), function () {
            return Institution::first();
        }));
    }
    }
}
