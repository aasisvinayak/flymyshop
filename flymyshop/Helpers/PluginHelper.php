<?php

namespace Flymyshop\Helpers;

use Illuminate\Support\Facades\File;

class PluginHelper
{
    public function hello()
    {
        return 'hello';
    }

    public function getPluginNames()
    {
        return  File::directories(base_path('/resources/plugins'));
    }
}
