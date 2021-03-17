<?php

Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1'], function () {
    Route::apiResource('permissions', 'PermissionsApiController');

    Route::apiResource('roles', 'RolesApiController');

    Route::apiResource('users', 'UsersApiController');

    Route::apiResource('products', 'ProductsApiController');

    Route::apiResource('cars', 'ProductsApiController');

    Route::apiResource('rents', 'ProductsApiController');

    Route::post('/login', 'UsersController@login');

    Route::post('/register', 'UsersController@register');

    Route::get('/logout', 'UsersController@logout')->middleware('auth:api');

});

//Route::group(['prefix' => 'v1'], function () {
//    Route::post('/login', 'UsersController@login');
//    Route::post('/register', 'UsersController@register');
//    Route::get('/logout', 'UsersController@logout')->middleware('auth:api');
//});


Route::get('/master_rent_details/{carId}', 'RentController@search')->name('api.master_rent_details');
