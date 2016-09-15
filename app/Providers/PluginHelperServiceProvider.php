<?php

namespace App\Providers;

use Flymyshop\Helpers\PluginHelper;
use Illuminate\Support\ServiceProvider;

class PluginHelperServiceProvider extends ServiceProvider
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
        $this->app->bind('PluginHelper', function () {
            return new PluginHelper();
        });
    }
}
