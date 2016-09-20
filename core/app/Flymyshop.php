<?php

namespace App;

use Illuminate\Foundation\Application;

class Flymyshop extends Application
{
    public function publicPath()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'/../public';
    }
}
