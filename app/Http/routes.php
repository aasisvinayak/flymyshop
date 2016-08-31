<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('pages.home');
});

Route::get('login', array('before' => 'csrf', 'uses' => 'WelcomeController@login'));
Route::post('login', array('before' => 'csrf', 'uses' => 'WelcomeController@doLogin'));
Route::get('register', array('before' => 'csrf', 'uses' => 'WelcomeController@register'));
Route::post('register', array('before' => 'csrf', 'uses' => 'WelcomeController@doRegister'));
Route::get('logout', array('uses' => 'WelcomeController@logout'));


Route::group(array('prefix' => 'user', 'middleware' => 'auth'), function () {
    Route::get('address', 'StoreController@address');
});
