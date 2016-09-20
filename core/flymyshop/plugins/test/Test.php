<?php

namespace Flymyshop\Plugins\Test;

use Flymyshop\Containers\DataContainer;
use Flymyshop\Plugins\Plugin;

/**
 * Class Test
 * Test plugin.
 */
class Test implements Plugin
{
    /**
     * Main class of the plugin which is invoked by the reflector class.
     */
    public static function main()
    {
        $dataContainer = DataContainer::instance();
        $dataContainer->setData([
                'footer' => 'This line is added using a plugin!',
            ]
        );
    }
}
