<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/




Route::group(['middleware' => ['check.login']], function () {
    Route::get('/login', 'HomeController@login')->name('home.login');
    Route::get('/register', 'HomeController@register')->name('home.register');
    Route::post('/postRegister', 'HomeController@postRegister')->name('home.postRegister');
    Route::post('/postLogin', 'HomeController@postLogin')->name('home.postLogin');
    Route::post('/checkCode', 'HomeController@checkCode')->name('home.checkCode');
    Route::get('/logout', 'HomeController@logout')->name('home.logout');
});


Route::group(['middleware' => ['check.logout']], function () {
    Route::get('/', 'HomeController@index')->name('home.index');


    Route::group(['prefix' => 'profile'], function () {
        Route::get('/', 'HomeController@profile')->name('dashboard.profile.show');
        Route::get('/change-password', 'HomeController@changePassword')->name('dashboard.profile.changePassword');
        Route::post('/reset-password', 'HomeController@postResetPassword')->name('dashboard.profile.resetPassword');
        Route::get('/edit/{id}', 'HomeController@editProfile')->name('dashboard.profile.edit');
        Route::post('/update', 'HomeController@updateProfile')->name('dashboard.profile.update');
    });


    Route::group(['prefix' => 'category'], function () {
        Route::get('/add', 'CategoryController@add')->name('dashboard.category.add');
        Route::get('/', 'CategoryController@index')->name('dashboard.category.show');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('dashboard.category.edit');
        Route::post('/update', 'CategoryController@update')->name('dashboard.category.update');
        Route::post('/delete', 'CategoryController@delete')->name('dashboard.category.delete');
        Route::post('/addPost', 'CategoryController@addPost')->name('dashboard.category.addPost');
    });

    Route::group(['prefix' => 'pay'], function () {
        Route::get('/add', 'PayController@add')->name('dashboard.pay.add');
        Route::get('/', 'PayController@index')->name('dashboard.pay.show');
        Route::get('/edit/{id}', 'PayController@edit')->name('dashboard.pay.edit');
        Route::post('/update', 'PayController@update')->name('dashboard.pay.update');
        Route::post('/delete', 'PayController@delete')->name('dashboard.pay.delete');
        Route::post('/addPost', 'PayController@addPost')->name('dashboard.pay.addPost');
    });

    Route::group(['prefix' => 'permission'], function () {
        Route::get('/add', 'PermissionController@add')->name('dashboard.permission.add');
        Route::get('/', 'PermissionController@index')->name('dashboard.permission.show');
        Route::get('/edit/{id}', 'PermissionController@edit')->name('dashboard.permission.edit');
        Route::post('/update', 'PermissionController@update')->name('dashboard.permission.update');
        Route::post('/delete', 'PermissionController@delete')->name('dashboard.permission.delete');
        Route::post('/addPost', 'PermissionController@addPost')->name('dashboard.permission.addPost');
    });

    Route::group(['prefix' => 'user'], function () {
        Route::get('/add', 'UserController@add')->name('dashboard.user.add');
        Route::get('/', 'UserController@index')->name('dashboard.user.show');
        Route::get('/edit/{id}', 'UserController@edit')->name('dashboard.user.edit');
        Route::post('/update', 'UserController@update')->name('dashboard.user.update');
        Route::post('/delete', 'UserController@delete')->name('dashboard.user.delete');
        Route::post('/addPost', 'UserController@addPost')->name('dashboard.user.addPost');
    });

    Route::group(['prefix' => 'product'], function () {
        Route::get('/add', 'ProductController@add')->name('dashboard.product.add');
        Route::get('/addProductImg', 'ProductController@addProductImg')->name('dashboard.product.addProductImg');
        Route::get('/img', 'ProductController@productImg')->name('dashboard.product.productImg');
        Route::post('/addPostImg', 'ProductController@addPostImg')->name('dashboard.product.addPostImg');
        Route::post('/deleteImg', 'ProductController@deleteImg')->name('dashboard.product.deleteImg');
        Route::get('/', 'ProductController@index')->name('dashboard.product.show');
        Route::get('/edit/{id}', 'ProductController@edit')->name('dashboard.product.edit');
        Route::get('/editImg/{id}', 'ProductController@editImg')->name('dashboard.product.editImg');
        Route::post('/update', 'ProductController@update')->name('dashboard.product.update');
        Route::post('/editPostImg', 'ProductController@editPostImg')->name('dashboard.product.editPostImg');
        Route::post('/delete', 'ProductController@delete')->name('dashboard.product.delete');
        Route::post('/addPost', 'ProductController@addPost')->name('dashboard.product.addPost');
        Route::post('/editPost', 'ProductController@editPost')->name('dashboard.product.editPost');
    });

    Route::group(['prefix' => 'ship'], function () {
        Route::get('/add', 'ShipController@add')->name('dashboard.ship.add');
        Route::get('/', 'ShipController@index')->name('dashboard.ship.show');
        Route::get('/edit/{id}', 'ShipController@edit')->name('dashboard.ship.edit');
        Route::post('/update', 'ShipController@update')->name('dashboard.ship.update');
        Route::post('/delete', 'ShipController@delete')->name('dashboard.ship.delete');
        Route::post('/addPost', 'ShipController@addPost')->name('dashboard.ship.addPost');
        Route::post('/addPostConnect', 'ShipController@addPostConnect')->name('dashboard.ship.addPostConnect');
        Route::post('/delete-connect', 'ShipController@deleteConnect')->name('dashboard.ship.deleteConnect');
        Route::get('/connect', 'ShipController@shipConnect')->name('dashboard.ship.connect');
        Route::get('/add-connect/{id}', 'ShipController@addConnect')->name('dashboard.ship.addConnect');
    });

    Route::group(['prefix' => 'order'], function () {
        // Route::get('/add', 'UserController@add')->name('dashboard.user.add');
        Route::get('/', 'OrderController@index')->name('dashboard.order.show');
        Route::get('/edit/{id}', 'OrderController@edit')->name('dashboard.order.edit');
        Route::post('/update', 'OrderController@update')->name('dashboard.order.update');
        Route::post('/delete', 'OrderController@delete')->name('dashboard.order.delete');
        Route::post('/addPost', 'OrderController@addPost')->name('dashboard.order.addPost');
    });

});
