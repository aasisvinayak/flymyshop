<?php

namespace App\Http\Controllers;
use Flymyshop\Helpers\PluginHelper;
use Illuminate\Http\Request;

use App\Http\Requests;

class PluginController extends Controller
{
    public function index(PluginHelper $pluginBasicHelper)
    {
        return $pluginBasicHelper->getPluginNames();
    }
}
