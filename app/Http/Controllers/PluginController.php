<?php

namespace App\Http\Controllers;

use Flymyshop\Helpers\PluginHelper;


class PluginController extends Controller
{
    public function index(PluginHelper $pluginBasicHelper)
    {
        return $pluginBasicHelper->getPluginNames();
    }

    public function addNewPlugin(){

        
    }

    public function deletePlugin(){

        

    }

    
}
