<?php

Route::redirect('/', '/login');

Route::redirect('/home', '/admin');

Auth::routes(['register' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');

});

Route::resource('cars', 'CarController');

Route::group(['prefix' => 'Cars', 'as' => 'cars.'], function () {
//    Route::get('index', ['as' => 'index', 'uses' => 'CarController@index']);
    Route::get('search', ['as' => 'search', 'uses' => 'CarController@search']);
});

Route::resource('rents', 'RentController');

//Route::group(['prefix' => 'Rents', 'as' => 'rents.'], function () {
//    Route::get('index', ['as' => 'index', 'uses' => 'RentController@index']);
//    Route::get('search', ['as' => 'search', 'uses' => 'RentController@search']);
//    Route::get('create', ['as' => 'create', 'uses' => 'RentController@create']);
//    Route::post('store', ['as' => 'store', 'uses' => 'RentController@store']);
//});
