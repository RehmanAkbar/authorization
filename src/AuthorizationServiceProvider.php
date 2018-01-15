<?php

namespace Softpyramid\Authorization;

use Illuminate\Support\ServiceProvider;

class AuthorizationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        include __DIR__.'/routes.php';
        $this->loadMigrationsFrom(__DIR__.'/migrations');
        $this->loadTranslationsFrom(__DIR__.'/lang/en', 'authorization');

        $this->publishes([
            __DIR__.'/migrations' => base_path('database/migrations'),
        ]);

        $this->publishes([
            __DIR__.'/lang/en' => resource_path('lang/en'),
        ]);

        $this->loadViewsFrom(__DIR__.'/views', 'authorization');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/'),
        ]);

        $this->publishes([
            __DIR__.'/assets' => public_path(''),
        ], 'public');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
