<?php

/**
 * Functions for views (custom themes).
 *
 * For function names FlyMyShop's own standard are used.
 * If you are using PHP_CodeSniffer please add the custom standard to stop
 * receiving errors
 */


/**
 * Returns the footer content.
 * @return mixed
 */
function fmc_footer()
{
    $dataContainer = \Flymyshop\Containers\DataContainer::instance();
    foreach ($dataContainer->data as $item) {
        if (array_key_exists('footer', $item)) {
            return $item['footer'];
            break;
        }
    }
}


function fms_themes()
{
}

function fms_plugins()
{
}

function categories()
{
    return (array)\App\Http\Controllers\CategoryController::getAllCategories();
}

/**
 * Get products.
 *
 * @param $take
 * @param $skip
 * @return mixed
 */
function products($take, $skip)
{
    return (array)\App\Http\Controllers\ProductController::getPublishedProducts($take, $skip);
}

function featured_products()
{
}

/**
 * Get the name of the shop.
 */
function get_shop_name()
{
}

/**
 * Get current version of Flymyshop.
 */
function get_fms_version()
{
}

/**
 * Get user's favourites.
 */
function favourites()
{
}

/**
 * Return csrf token.
 * @return \Illuminate\Support\HtmlString
 */
function token()
{
    return csrf_field();
}
