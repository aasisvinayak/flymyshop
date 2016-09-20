<?php

namespace Flymyshop\Core;

use Flymyshop\Containers\HookContainer;
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
        $hookContainer = HookContainer::instance();
        $pluginNames= new PluginHelper();
        $plugins= $pluginNames->getPluginNames();
        foreach ($plugins as $plugin){
        $reflector = new \ReflectionClass('Flymyshop\Plugins\\'.$plugin.'\\'.$plugin);
        $main=$reflector->getMethod('main');
        $methods=    $reflector->getMethods();
           // var_dump($methods);
             foreach ($methods as $method){
                 if($method->name=="i_order_hook"){
                     $hookContainer->setHook(array('i_order_hook'=>$reflector->getName()));
                 }
             }

        $main->invoke('');
        }

    }

}