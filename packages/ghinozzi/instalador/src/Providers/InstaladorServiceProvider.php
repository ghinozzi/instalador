<?php

namespace Ghinozzi\Instalador\Providers;

use Illuminate\Support\ServiceProvider;
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
        if($this->app->runningInConsole()){
            $this->commands([Pokemon::class]);
        }
    }
}
