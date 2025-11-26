<?php

namespace App\Providers;

use App\Models\Institution;
use Illuminate\Support\Facades\DB;
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
    /* if (Schema::hasTable('institutions')) {
        View::share('institution', cache()->remember('institution', now()->addDay(), function () {
            return Institution::first();
        }));
    } */
   try {
    // Intentar verificar la tabla solo si la conexión a la base de datos está disponible
    if (DB::connection()->getDatabaseName() && Schema::hasTable('institutions')) {
        View::share('institution', cache()->remember('institution', now()->addDay(), function () {
            return Institution::first();
        }));
    } else {
        View::share('institution', null);
    }
} catch (\Exception $e) {
    // Si hay cualquier error, compartir null
    View::share('institution', null);
}
    }
}
