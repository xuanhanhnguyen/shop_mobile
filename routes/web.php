<?php

use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Page Routes
|--------------------------------------------------------------------------
|
|
*/

Route::get('/', 'PageController@home');
Route::get('/home', 'PageController@home');
Route::post('/order', 'PageController@order');
Route::get('/new/{id}', 'PageController@new');
Route::get('/detail/{id}', 'PageController@detail');
Route::post('/cart', 'PageController@cart');
Route::post('/orderCart', 'PageController@orderCart');
Route::get('/cart', 'PageController@getCart');




/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
|
*/

Auth::routes();

Route::group(['middleware' => 'auth', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {


    Route::get('/', 'DashboardController@index');
    Route::get('/chart', 'DashboardController@show');
    Route::get('/profile', 'UserController@index');
    Route::post('/profile', 'UserController@update');
    Route::get('/tk', 'DashboardController@thong_ke');

    /*========================================================
      Quản lý hệ thống
      ========================================================
    */
    Route::resource('bh', 'BaoHanhController');
    Route::resource('cat', 'CatController');
    Route::resource('nv', 'NhanVienController');
    Route::resource('news', 'NewController');
    Route::resource('product', 'ProductController');
    Route::resource('member', 'MemberController');
    Route::resource('order', 'OrderController');
    Route::resource('order-detail', 'OrderDetailController');
    Route::resource('store', 'StoreController');
    Route::resource('post', 'PostController');
    Route::resource('service', 'ServiceController');
    Route::resource('book', 'BookController');
    Route::resource('user', 'UserController');
});
