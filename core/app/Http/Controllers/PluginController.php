<?php

namespace App\Http\Controllers;

use Flymyshop\Helpers\PluginHelper;
use Illuminate\Support\Facades\Response;

class PluginController extends Controller
{
    public function index()
    {
        return view('admin/plugins/list');
    }

    public function addNewPlugin()
    {
    }

    public function deletePlugin()
    {
    }

    public function pluginList(PluginHelper $pluginBasicHelper)
    {
        return Response::json($pluginBasicHelper->getPluginNames(), 200);
    }
}
