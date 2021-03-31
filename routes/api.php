<?php

//Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1'], function () {
//
//    Route::apiResource('permissions', 'PermissionsApiController');
//
//    Route::apiResource('roles', 'RolesApiController');
//
//    Route::apiResource('users', 'UsersApiController');
//
//    Route::apiResource('products', 'ProductsApiController');
//
//    Route::apiResource('cars', 'CarsApiController');
//
//    Route::apiResource('rents', 'RentsApiController');
//
//});
Route::group(['middleware' => ['cors', 'json.response']], function () {

    Route::group(['prefix' => 'v1', 'as' => 'client.', 'namespace' => 'Api\V1'], function () {

        Route::post('/register', 'ApiAuthController@register')->name('register.api');

        Route::post('/login', 'ApiAuthController@login')->name('login.api');

        Route::group(['middleware' =>['auth:api']], function () {

            Route::get('/logout', 'ApiAuthController@logout')->name('logout.api');

            Route::group(['prefix' => 'cars'], function () {
                Route::get('/index', 'CarsApiController@index');
                Route::get('/search', 'CarsApiController@search');
            });

            Route::group(['prefix' => 'rents'], function () {
                Route::get('/search', 'RentsApiController@search');
                Route::post('/store', 'RentsApiController@store');
            });

        });
    });
});


Route::get('/master_rent_details/{carId}', 'RentController@search')->name('api.master_rent_details');
