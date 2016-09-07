<?php

namespace App\Providers;

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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Only Development plugins
        if ($this->app->environment() == 'local') {
            // Laracasts Generators
            $this->app->register('Laracasts\Generators\GeneratorsServiceProvider');

            // Laracademy Model Generators
            $this->app->register('\Laracademy\Generators\GeneratorsServiceProvider');
        }
    }
}
