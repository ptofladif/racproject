<?php

Route::group(['prefix' => 'v1', 'as' => 'admin.', 'namespace' => 'Api\V1'], function () {

    Route::apiResource('permissions', 'PermissionsApiController');

    Route::apiResource('roles', 'RolesApiController');

    Route::apiResource('users', 'UsersApiController');

    Route::apiResource('products', 'ProductsApiController');

    Route::apiResource('cars', 'CarsApiController');

    Route::apiResource('rents', 'RentsApiController');

});




Route::group(['prefix' => 'v1', 'as' => 'v1', 'namespace' => 'Api\V1'], function () {

    Route::post('/register', 'UsersController@register');
    Route::post('/login', 'UsersController@login');

    Route::group(['middleware' =>['auth:api']], function () {
        Route::get('/logout', 'UsersController@logout');

        Route::get('/cars', 'CarsApiController@index');

        Route::get('/rents', 'RentsApiController@index');

        Route::get('/me/rents', 'RentsApiController@merents');

        Route::post('/rent', 'RentsApiController@store');

    });
});



//Route::group(['prefix' => 'v1'], function () {
//    Route::post('/login', 'UsersController@login');
//    Route::post('/register', 'UsersController@register');
//    Route::get('/logout', 'UsersController@logout')->middleware('auth:api');
//});


Route::get('/master_rent_details/{carId}', 'RentController@search')->name('api.master_rent_details');
