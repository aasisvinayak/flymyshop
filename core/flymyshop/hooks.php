<?php

/**
 * Hook to modify the product object.
 * Called when a product is viewed.
 *
 */
function productHook()
{
}

/**
 * interrupting productHook
 */
function i_productHook()
{
}

/**
 * Hook to modify the order object.
 * This is called by the application once an order is generated.
 *
 * @param \App\Http\Models\Invoice $order
 */
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

/**
 * Interrupting order hook
 *
 * @param \App\Http\Models\Invoice $order
 */
function i_orderHook(\App\Http\Models\Invoice $order)
{
}

/**
 * Hook to modify cart object.
 *
 * @param \Gloudemans\Shoppingcart\Cart $cart
 */
function cartHook(\Gloudemans\Shoppingcart\Cart $cart)
{
}

/**
 * Interrupting cart hook.
 *
 * @param \Gloudemans\Shoppingcart\Cart $cart
 */
function i_cartHook(\Gloudemans\Shoppingcart\Cart $cart)
{
}

/**
 * Hook to modify the page object.
 * Called in a page view.
 *
 * @param \App\Http\Models\Page $page
 */
function pageHook(\App\Http\Models\Page $page)
{
}

/**
 * Modify menu object.
 */
function menuHook()
{
}



