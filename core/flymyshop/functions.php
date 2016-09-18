<?php

/**
 * Functions for views (custom themes)
 *
 */


/**
 *
 * @return mixed
 */
function fmsFooter()
{
    $dataContainer =  \Flymyshop\Containers\DataContainer::instance();
    foreach ($dataContainer->data as $item){
        if (array_key_exists('footer', $item)) {
            return ($item['footer']) ;
            break;
        }
    }
}

/**
 *
 */
function themes(){

}

function plugins(){

}

function categories(){

    return \App\Http\Controllers\CategoryController::getAllCategories();

}

/**
 * Get products
 *
 * @param $take
 * @param $skip
 * @return mixed
 */
function products($take,$skip){
    return \App\Http\Controllers\ProductController::getPublishedProducts($take,$skip);
}

function featuredProducts(){


}

/**
 * Get the name of the shop
 */
function getShopName()
{

}

/**
 * Get current version of Flymyshop
 */
function getVersion()
{

}


function favourites()
{

}

function creditCards(){

}

function token(){
    return csrf_field();
}