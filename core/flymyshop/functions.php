<?php

/**
 * Functions for views (custom themes).
 */


/**
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


function themes()
{
}

function plugins()
{
}

function categories()
{
    return \App\Http\Controllers\CategoryController::getAllCategories();
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
    return \App\Http\Controllers\ProductController::getPublishedProducts($take, $skip);
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
function get_version()
{
}


function favourites()
{
}

function creditCards()
{
}

function token()
{
    return csrf_field();
}
