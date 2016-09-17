<?php

namespace Flymyshop\Containers;

final class DataContainer{

    public $data;

    public function __construct()
    {
        $this->data=array();
    }

    public static function instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new DataContainer();
        }
        return $inst;

    }

    public function getData($key)
    {
        return $this->data[$key];
    }

    public function setData($in=array())
    {
        array_push($this->data,$in);
    }

    public function removeData($in=array())
    {

    }

}