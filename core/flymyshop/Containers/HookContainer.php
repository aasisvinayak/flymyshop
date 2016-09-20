<?php

namespace Flymyshop\Containers;

final class HookContainer
{
    public $hooks;

    public function __construct()
    {
        $this->hooks = [];
    }

    public static function instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new self();
        }

        return $inst;
    }

    public function getHook($key)
    {
        return $this->hooks[$key];
    }

    public function setHook($in = [])
    {
        array_push($this->hooks, $in);
    }

    public function removeData($in = [])
    {
    }
}
