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
        if (array_key_exists('i_order_hook', $hook)) {
            call_user_func_array(
                [$hook['i_order_hook'], 'i_order_hook'],
                [$order]
            );
        }
    }
}
