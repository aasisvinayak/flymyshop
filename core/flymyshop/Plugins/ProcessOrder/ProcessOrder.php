<?php

namespace Flymyshop\Plugins\ProcessOrder;

use App\Http\Models\Invoice;
use Flymyshop\Plugins\Plugin;

/**
 * Class ProcessOrder.
 */
class ProcessOrder implements Plugin
{
    /**
         * Main class of the plugin which is invoked by the reflector class.
         */
        public static function main()
        {
        }

    public static function i_order_hook(Invoice $order)
    {

               // dd($order);
    }
}
