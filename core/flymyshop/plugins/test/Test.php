<?php

namespace Flymyshop\Plugins\Test;

use Flymyshop\Containers\DataContainer;

/**
 * Class Test
 * Test plugin
 *
 * @package Flymyshop\Plugins\Test
 */
class Test{

    /**
     * Main class of the plugin which is invoked by the reflector class
     * 
     */
    public static function main()
    {
        $dataContainer =   DataContainer::instance();
        $dataContainer->setData(array(
                'footer' => 'This line is added using a plugin!',
            )
        );
    }

}
