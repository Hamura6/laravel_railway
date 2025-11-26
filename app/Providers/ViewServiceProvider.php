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
    // Verificar si la tabla existe y tiene datos
    if (Schema::hasTable('institutions')) {
        try {
            View::share('institution', cache()->remember('institution', now()->addDay(), function () {
                return Institution::first();
            }));
        } catch (\Exception $e) {
            // Si hay algún error, compartir null o un valor por defecto
            View::share('institution', null);
        }
    } else {
        View::share('institution', null);
    }
    }
}
