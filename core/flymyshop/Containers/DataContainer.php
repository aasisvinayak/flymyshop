<?php

namespace Flymyshop\Containers;

final class DataContainer
{
    public $data;

    public function __construct()
    {
        $this->data = [];
    }

    public static function instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new self();
        }

        return $inst;
    }

    public function getData($key)
    {
        return $this->data[$key];
    }

    public function setData($in = [])
    {
        array_push($this->data, $in);
    }

    public function removeData($in = [])
    {
    }
}
