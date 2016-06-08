<?php

namespace App\Providers;

use App;
use Illuminate\Support\ServiceProvider;

class ModelsServiceProvider extends ServiceProvider
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
      $this->app->bind('App\Repositories\Interfaces\OrderRepositoryInterface', 'App\Repositories\DbOrderRepository');
      $this->app->bind('App\Repositories\Interfaces\SurchargeRepositoryInterface', 'App\Repositories\DbSurchargeRepository');
      $this->app->bind('App\Repositories\Interfaces\RateRepositoryInterface', 'App\Repositories\DbRateRepository');
      $this->app->bind('App\Repositories\Interfaces\ActionRepositoryInterface', 'App\Repositories\DbActionRepository');
      $this->app->bind('App\Repositories\Interfaces\EmailRepositoryInterface', 'App\Repositories\DbEmailRepository');
      $this->app->bind('App\Repositories\Interfaces\DiscountRepositoryInterface', 'App\Repositories\DbDiscountRepository');
    }
}
