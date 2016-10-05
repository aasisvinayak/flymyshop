<?php

namespace App;

use RuntimeException;
use Illuminate\Foundation\Application;

/**
 * Class Flymyshop.
 */
class Flymyshop extends Application
{
    /**
     * Setting the public path for the application.
     * @return string
     */
    public function publicPath()
    {
        return $this->basePath.DIRECTORY_SEPARATOR.'/../public';
    }

    /**
     * Over-ride function
     * TODO: add checks
     *
     * @return string
     */
    public function getNamespace()
    {
        if (! is_null($this->namespace)) {
            return $this->namespace;
        }

        $this->namespace = "App\\";
    }
}
