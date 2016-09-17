<?php

namespace App\Providers;

use Flymyshop\Containers\DataContainer;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class FmsContainerServiceProvider extends ServiceProvider
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

        //TODO
//        App::singleton('DataContainer', function () {
//            return  DataContainer::instance();
//        });

    }
}
