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
    return getData('footer');
}

/**
 * Return the header content.
 * @return mixed
 */
function fmc_header()
{
    return getData('header');
}

/**
 * Return array of FlyMyShop themes.
 *
 * @return array
 */
function fms_themes()
{
    $themes = new \Flymyshop\Helpers\ThemeHelper();

    return $themes->getThemes();
}

/**
 * Return FMS plugins as an array.
 *
 * @return array
 */
function fms_plugins()
{
    $plugins = new \Flymyshop\Helpers\PluginHelper();

    return $plugins->getPluginNames();
}

/**
 * Return list of all categories.
 *
 * @return array
 */
function categories()
{
    $categories = \App\Http\Controllers\CategoryController::getAllCategories()->toArray();

    return $categories;
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
    return (array) \App\Http\Controllers\ProductController::getPublishedProducts($take, $skip);
}

/**
 * Return list of products that tagged as featured.
 *
 * @param $number
 */
function featured_products($number)
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


function get_admin_extra_menu()
{
}



/**
 * Return the data from DataContainer.
 *
 * @param $key
 * @return mixed
 */
function getData($key)
{
    $dataContainer = \Flymyshop\Containers\DataContainer::instance();
    foreach ($dataContainer->data as $item) {
        if (array_key_exists($key, $item)) {
            return $item[$key];
            break;
        }
    }
}
