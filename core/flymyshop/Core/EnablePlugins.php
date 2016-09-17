<?php

namespace Flymyshop\Core;

use Flymyshop\Helpers\PluginHelper;

/**
 * Class EnablePlugins
 * Enable plugins that are independent of time of execution
 *
 * @package Flymyshop\Core
 */
class EnablePlugins{

    public function __construct()
    {
        $pluginNames= new PluginHelper();
        $plugins= $pluginNames->getPluginNames();
        foreach ($plugins as $plugin){
        $reflector = new \ReflectionClass('Flymyshop\Plugins\\'.$plugin.'\\'.$plugin);
        $main=$reflector->getMethod('main');
        $main->invoke('');
        }
    }

}