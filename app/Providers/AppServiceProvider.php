<?php

namespace App\Providers;

use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // TODO: does this belong here?
        setlocale(LC_TIME, 'de_DE.utf8');
        // Use HTTPS for all routes
        if($this->app->environment('production')) {
            \Illuminate\Support\Facades\URL::forceScheme('https');
        }        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
