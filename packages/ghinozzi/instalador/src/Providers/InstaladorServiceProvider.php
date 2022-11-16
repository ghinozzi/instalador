<?php

namespace Ghinozzi\Instalador\Providers;

use Illuminate\Support\ServiceProvider;

class InstaladorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([]);
        }

        // Configs
        $this->mergeConfigFrom(__DIR__ . '/../configs/instalador.php', 'instalador');

        // Routes
        $this->loadRoutesFrom(__DIR__ . '/../routes/web.php');

        // Views
        $this->loadViewsFrom(__DIR__ . '/../views', 'instalador');

        // Publish
        $this->publishes([__DIR__ . '/../public/assets' => public_path('assets')], 'instalador-public');
        $this->publishes([__DIR__ . '/../views' => resource_path('views/vendor/instalador')], 'instalador-views');


        // php artisan vendor:publish --tag=public --force


        //Migrations
        //$this->loadMigrationsFrom(__DIR__.'/../database/migrations');/


    }
}
