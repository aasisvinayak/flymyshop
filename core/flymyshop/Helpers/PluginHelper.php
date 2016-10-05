<?php

namespace Flymyshop\Helpers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

/**
 * Class PluginHelper
 * Helper class for plugins and controllers.
 */
class PluginHelper
{
    /**
     * Get the names of all plugins in the plugins directory.
     *
     * @return array
     */
    public function getPluginNames()
    {
        $pluginList = File::directories(base_path('/flymyshop/plugins'));
        $plugins = [];

        foreach ($pluginList as $plugin) {
            array_push($plugins, ucfirst(basename($plugin)));
        }

        return $plugins;
    }

    /**
     * Return array of enabled plugins!
     *
     * @return mixed
     */
    public function getEnabledPlugins()
    {
        return DB::table('plugins')->select('name')->where('status', '=', 1)->get();
    }
}
