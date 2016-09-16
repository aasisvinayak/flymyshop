<?php

namespace Flymyshop\Helpers;

use Flymyshop\Containers\DataContainer;
use Illuminate\Support\Facades\File;

class PluginHelper
{
    public function hello()
    {
        return 'hello';
    }

    public function getPluginNames()
    {
        $pluginList= File::directories(base_path('/flymyshop/plugins'));
        $plugins=array();

        foreach ($pluginList as $plugin){
            array_push($plugins,ucfirst(basename($plugin))) ;
        }

        return $plugins;


    }
}
