<?php

namespace App;

use Illuminate\Foundation\Application;

/**
 * Class Flymyshop
 * @package App
 * 
 */
class Flymyshop extends Application
{
    /**
     * Setting the public path for the application
     * @return string
     */
    public function publicPath()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'/../public';
    }
}
