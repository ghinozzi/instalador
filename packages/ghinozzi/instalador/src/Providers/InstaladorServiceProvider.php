<?php

namespace Ghinozzi\Instalador\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Foundation\Console\AboutCommand;
use Ghinozzi\Instalador\Commands\Pokemon;

class InstaladorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        AboutCommand::add('teste', fn () => ['Version' => '1.0.0']);
        if($this->app->runningInConsole()){
            $this->commands([Pokemon::class]);
        }

        // php artisan vendor:publish --tag=public --force
        //Rotas da aplicacao 
        //$this->loadRoutesFrom(__DIR__.'/../routes/web.php');


        //Migrations
        //$this->loadMigrationsFrom(__DIR__.'/../database/migrations');/

        //views
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'courier');

        /*
        assets 
        this->publishes([
        __DIR__.'/../public' => public_path('vendor/courier'),
    ], 'public');
        */
    }
}
