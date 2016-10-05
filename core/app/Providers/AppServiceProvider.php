<?php

namespace App\Providers;

use Flymyshop\Core\EnablePlugins;
use Illuminate\Support\Facades\Schema;
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
        $this->app->bind('path.storage', function () {
            return 'files';
        });


        if (Schema::hasTable('plugins')) {
            new EnablePlugins();
        }

    }
}

require base_path() . '/flymyshop/functions.php';
require base_path() . '/flymyshop/hooks.php';
