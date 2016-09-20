<?php

namespace Flymyshop\Helpers;

use Illuminate\Support\Facades\File;

/**
 * Class PluginHelper
 * Helper class for plugins and controllers
 *
 * @package Flymyshop\Helpers
 */
class PluginHelper
{

    /**
     * Get the names of all plugins in the plugins directory
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
}
