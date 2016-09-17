<?php

namespace App\Http\Controllers;

use Flymyshop\Helpers\PluginHelper;
use Flymyshop\Plugins\Test\Test;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\File;


class PluginController extends Controller
{
    public function index(PluginHelper $pluginBasicHelper)
    {
        return view('admin/plugins/list');
    }

    public function addNewPlugin()
    {
    }

    public function deletePlugin()
    {
    }

}
