<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class SurchargesServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('surcharges', function()
       {
           return new \App\Classes\Surcharges;
       });
    }
}
