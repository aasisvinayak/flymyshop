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

//Route::get('/', function () {
//    return view('pages.home');
//});

Route::get('/', 'StoreController@home');



Route::get('images/{slug}', function ($slug)
{
   // $path = storage_path()  . $filename; // for private files


   $path = 'public/uploads/' . $slug;
    if(!File::exists($path)) abort(404);
    $file = File::get($path);
    $type = File::mimeType($path);
    $response = Response::make($file, 200);
    $response->header("Content-Type", $type);
    return $response;
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
Route::get('listing/{slug}', 'StoreController@category');

//});


Route::group(array('prefix' => 'shop',), function () {
    Route::get('product/{slug}', 'StoreController@productDetails');
    Route::resource('categories', 'CategoryController');
    Route::resource('products', 'ProductController');
    Route::get('cart', 'StoreController@cart');
    Route::get('empty_cart', 'StoreController@emptyCart');
});


Route::post('cart', 'StoreController@addCart');
Route::post('favourite', 'StoreController@addFavourite');

Route::post('update_cart', 'StoreController@updateCart');
Route::post('remove_from_cart', 'StoreController@removeFromCart');
