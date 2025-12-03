<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\URL;
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
        Paginator::useBootstrap();
        /* if (config('app.env') === 'production') {
        URL::forceScheme('https');} */
        /*  Request::macro('hasValidSignature', function ($absolute = true, array $ignoreQuery = []) {
            $https = clone $this;
            $https->server->set('HTTPS', 'on');

            $http = clone $this;
            $http->server->set('HTTPS', 'off');

            return URL::hasValidSignature($https, $absolute, $ignoreQuery)
                || URL::hasValidSignature($http, $absolute, $ignoreQuery);
        }); */
    
    }
}
