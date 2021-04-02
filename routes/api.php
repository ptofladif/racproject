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

    Route::group(['prefix' => 'v1', 'as' => 'verification.', 'namespace' => 'Api\V1'], function () {

        Route::get('email/verify/{id}', 'VerificationController@verify')->name('verify');

        Route::get('email/resend', 'VerificationController@resend')->name('resend');

    });

    Route::group(['prefix' => 'v1', 'as' => 'client.', 'namespace' => 'Api\V1'], function () {

        Route::post('/register', 'AuthApiController@register')->name('register.api');


        Route::post('/login', 'AuthApiController@login')->name('login.api');

        Route::group(['middleware' =>['auth:api']], function () {

            Route::get('/logout', 'AuthApiController@logout')->name('logout.api');

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
