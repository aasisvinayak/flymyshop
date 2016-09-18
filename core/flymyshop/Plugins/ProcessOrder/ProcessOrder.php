<?php

namespace Flymyshop\Plugins\ProcessOrder;
use App\Http\Models\Invoice;

/**
 * Class ProcessOrder
 * @package Flymyshop\Plugins\ProcessOrder
 */
class ProcessOrder
{
         /**
         * Main class of the plugin which is invoked by the reflector class
         *
         */
        public static function main()
        {
        }

        public static function order_hook(Invoice $order)
        {

               // dd($order);

        }
}
