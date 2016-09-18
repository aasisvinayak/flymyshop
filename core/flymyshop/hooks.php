<?php

function productHook()
{

}

function cartHook()
{

}

function orderHook(\App\Http\Models\Invoice $order)
{

    $hookContainer = \Flymyshop\Containers\HookContainer::instance();
    $hooks = $hookContainer->hooks;

    foreach ($hooks as $hook) {
        if (array_key_exists('order_hook', $hook)) {
            call_user_func_array(
                array($hook['order_hook'], 'order_hook'),
                array($order)
            );
        }
    }

}