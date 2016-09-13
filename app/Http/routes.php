<?php

Route::group(
    ['middleware' => 'install'],
    function () {
        Route::get('install', 'InstallController@index');
    }
);
Route::group(
    ['middleware' => 'menu'],
    function () {
        Route::get('/', 'ShopController@home');
        Route::get('home', 'ShopController@home');
        Route::get(
            'images/{slug}',
            function ($slug) {
                $path = 'public/uploads/'.$slug;
                if (! File::exists($path)) {
                    abort(404);
                }
                $file = File::get($path);
                $type = File::mimeType($path);
                $response = Response::make($file, 200);
                $response->header('Content-Type', $type);

                return $response;
            }
        );

        Route::pattern('id', '[a-z0-9-]+');
        Route::get('contact', 'ShopController@contact');
        Route::post('contact', 'ShopController@sendEmail');
        Route::post('newsletter', 'ShopController@newsletter');
        Route::post('search', 'ShopController@search');
        Route::get('listing/{slug}', 'ShopController@category');

        Route::group(
            ['prefix' => 'account',
                    'middleware' => 'auth', ],
            function () {
                Route::get('/', 'UserDetailController@profile');
                        //TODO complete support for third-party address retrieval
                        Route::get('address', 'ShopController@address');
                Route::get('add_address', 'ShopController@addAddress');
                Route::get('update_address', 'ShopController@updateAddress');
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
            }
        );


        Route::group(
            ['prefix' => 'shop',
                    'middleware' => ['auth', 'checkout'], ],
            function () {
                Route::get('check_out', 'ShopController@checkOut');
            }
        );


        Route::group(
            ['prefix' => 'shop'],
            function () {
                Route::get('product/{slug}', 'ShopController@productDetails');
                Route::get('cart', 'ShopController@cart');
                Route::get('favourites', 'ShopController@favourites');
                Route::post('favourites', 'ShopController@removeFavourite');
                Route::get('empty_cart', 'ShopController@emptyCart');
                Route::get('currency/{iso}', 'ShopController@currency');
                Route::get('/', 'ShopController@home');
            }
        );


        Route::group(
            ['prefix' => 'admin',
                    'middleware' => ['auth', 'admin'], ],
            function () {
                Route::get('/', 'AdminController@welcome');
                Route::get('/sales', 'AdminController@sales');
                Route::resource('categories', 'CategoryController');
                Route::resource('products', 'ProductController');
                Route::resource('pages', 'PageController');
                Route::get('/users', 'AdminController@users');
                Route::get('/orders', 'AdminController@orders');
            }
        );

        Route::post('cart', 'ShopController@addCart');
        Route::post('favourite', 'ShopController@addFavourite');
        Route::post('update_cart', 'ShopController@updateCart');
        Route::post('remove_from_cart', 'ShopController@removeFromCart');
        Route::auth();
        Route::get('pages/{title}/{page_id}', 'ShopController@page');
        Route::get('auth/facebook', 'Auth\AuthController@redirectToProvider');
        Route::get('auth/facebook/callback', 'Auth\AuthController@handleProviderCallback');
    }
);
