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

Route::pattern('id', '[a-z0-9-]+');

Route::get('login', array('before' => 'csrf', 'uses' => 'WelcomeController@login'));
Route::post('login', array('before' => 'csrf', 'uses' => 'WelcomeController@doLogin'));
Route::get('register', array('before' => 'csrf', 'uses' => 'WelcomeController@register'));
Route::post('register', array('before' => 'csrf', 'uses' => 'WelcomeController@doRegister'));
Route::get('logout', array('uses' => 'WelcomeController@logout'));
Route::get('contact', 'WelcomeController@contact');
Route::post('contact', 'WelcomeController@sendEmail');





//'middleware' => 'auth'
//Route::group(array('prefix' => 'account', 'middleware' => 'auth'), function () {
Route::get('address', 'StoreController@address');
Route::get('add_address', 'StoreController@addAddress');
Route::get('update_address', 'StoreController@updateAddress');


//});


Route::group(array('prefix' => 'shop',), function () {
    Route::get('product/{id}', 'StoreController@productDetails');
    Route::resource('categories', 'CategoryController');
});
