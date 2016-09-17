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

function categories($number){

}

function products(){

}

function featuredProducts(){

}