<?php

Route::get('logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::redirect('/', '/login');

Route::redirect('/home', '/cars');

Auth::routes(['register' => true]);

//Auth::routes(['verify' => true]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' =>  ['auth','admin']], function () {

    Route::get('/', 'HomeController@index')->name('home');

    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');

    Route::resource('permissions', 'PermissionsController');

    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');

    Route::resource('roles', 'RolesController');

    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');

    Route::resource('users', 'UsersController');

});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' =>  ['auth']], function () {

    Route::delete('products/destroy', 'ProductsController@massDestroy')->name('products.massDestroy');

    Route::resource('products', 'ProductsController');

    Route::post('searchClient',['as' => 'searchClient','uses'=>'UsersController@searchClientByAjax']);

});

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'middleware' => ['auth']], function () {
    Route::resource('cars', 'CarController');
    Route::resource('rents', 'RentController');
});

Route::resource('cars', 'CarController');

Route::group(['prefix' => 'Cars', 'as' => 'cars.'], function () {
    Route::get('search', ['as' => 'search', 'uses' => 'CarController@search']);
});

Route::resource('rents', 'RentController');

Route::group(['prefix' => 'Rents', 'as' => 'rents.'], function () {
    Route::get('search', ['as' => 'search', 'uses' => 'RentController@search']);
});

//Route::group(['prefix' => 'Rents', 'as' => 'rents.'], function () {
//    Route::get('index', ['as' => 'index', 'uses' => 'RentController@index']);
//    Route::get('search', ['as' => 'search', 'uses' => 'RentController@search']);
//    Route::get('create', ['as' => 'create', 'uses' => 'RentController@create']);
//    Route::post('store', ['as' => 'store', 'uses' => 'RentController@store']);
//});
