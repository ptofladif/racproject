<?php

Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1'], function () {

    Route::apiResource('permissions', 'PermissionsApiController');

    Route::apiResource('roles', 'RolesApiController');

    Route::apiResource('users', 'UsersApiController');

    Route::apiResource('products', 'ProductsApiController');

    Route::apiResource('cars', 'CarsApiController');

    Route::apiResource('rents', 'RentsApiController');

});

Route::group(['prefix' => 'v1', 'as' => 'client.', 'namespace' => 'Api\V1'], function () {

    Route::post('/register', 'UsersController@register');

    Route::post('/login', 'UsersController@login');

    Route::group(['middleware' =>['auth:api']], function () {

        Route::get('/logout', 'UsersController@logout');

        Route::get('/cars', 'CarsApiController@index');

        Route::get('/rents', 'RentsApiController@index');

        Route::get('/my/rents', 'RentsApiController@myrents');

        Route::post('/rent', 'RentsApiController@store');

    });
});






Route::get('/master_rent_details/{carId}', 'RentController@search')->name('api.master_rent_details');
