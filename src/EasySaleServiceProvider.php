<?php

namespace AdemOzmermer;

use Illuminate\Support\ServiceProvider;

class EasySaleServiceProvider extends ServiceProvider
{
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/config/easysale.php', 'easysale');
    }

    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/route.php');

        $this->loadViewsFrom(__DIR__ . '/Views', 'easysale');

        $this->loadMigrationsFrom(__DIR__.'/Migrations');

        $this->publishes([
            __DIR__.'/config' => config_path('/'),
        ], 'config');

        $this->publishes([
            __DIR__.'/Views' => resource_path('views/vendor/easysale'),
        ], 'view');

        $this->publishes([
            __DIR__.'/Migrations' => database_path('migrations'),
        ], 'migration');
    }
}
