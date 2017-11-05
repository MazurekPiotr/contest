<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App;

class ContestServiceProvider extends ServiceProvider
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
        App::bind('App\Contest\ContestRepositoryInterface','App\Contest\ContestRepository');
    }
}
