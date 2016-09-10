<?php


Route::group(['middleware' => 'menu'], function () {

    Route::get('/', 'StoreController@home');
    Route::get('home', 'StoreController@home');



    Route::get('images/{slug}', function ($slug)
    {
        $path = 'public/uploads/' . $slug;
        if(!File::exists($path)) abort(404);
        $file = File::get($path);
        $type = File::mimeType($path);
        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);
        return $response;
    });

    Route::pattern('id', '[a-z0-9-]+');
    Route::get('contact', 'WelcomeController@contact');
    Route::post('contact', 'WelcomeController@sendEmail');
    Route::post('newsletter', 'WelcomeController@newsletter');
    Route::post('search', 'WelcomeController@search');
    Route::get('listing/{slug}', 'StoreController@category');

    Route::group(array('prefix' => 'account', 'middleware' => 'auth'), function () {
        Route::get('/', 'UserDetailController@profile');
        //TODO complete support for third-party address retrieval
        Route::get('address', 'StoreController@address');
        Route::get('add_address', 'StoreController@addAddress');
        Route::get('update_address', 'StoreController@updateAddress');
        Route::resource('/payment_cards', 'PaymentCardController');
        Route::get('/payment_cards/pay', 'PaymentCardController@pay');
        Route::post('/payment_cards/make', 'PaymentCardController@orderPost');
        Route::get('/profile', 'UserDetailController@profile');
        Route::get('/profile/edit', 'UserDetailController@edit');
        Route::post('/profile/edit', 'UserDetailController@update');
        Route::post('/profile/add', 'UserDetailController@store');
        Route::resource('addresses', 'AddressController');
        Route::get('/order_history', 'OrderController@index');
        Route::get('/orders/{slug}', 'OrderController@view');

    });


    Route::group(array('prefix' => 'shop', 'middleware' => array('auth','checkout')), function () {

        Route::get('check_out', 'StoreController@checkOut');

    });


    Route::group(array('prefix' => 'shop',), function () {
        Route::get('product/{slug}', 'StoreController@productDetails');
        Route::get('cart', 'StoreController@cart');
        Route::get('favourites', 'StoreController@favourites');
        Route::post('favourites', 'StoreController@removeFavourite');
        Route::get('empty_cart', 'StoreController@emptyCart');
        Route::get('currency/{iso}', 'StoreController@currency');
        Route::get('/', 'StoreController@home');

    });


    Route::group(array('prefix' => 'admin','middleware' => array('auth','admin') ), function () {
        Route::get('/', 'AdminController@welcome');
        Route::get('/sales', 'AdminController@sales');
        Route::resource('categories', 'CategoryController');
        Route::resource('products', 'ProductController');
        Route::resource('pages', 'PageController');
        Route::get('/users', 'AdminController@users');

    });

    Route::post('cart', 'StoreController@addCart');
    Route::post('favourite', 'StoreController@addFavourite');
    Route::post('update_cart', 'StoreController@updateCart');
    Route::post('remove_from_cart', 'StoreController@removeFromCart');
    Route::auth();
    Route::get('pages/{title}/{page_id}', 'StoreController@page');
    Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
    Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');

});


