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

Route::get('/', function () {
      return view('welcome');
});

Route::group([
    'prefix' => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['admin'],
    'namespace' => 'Admin'
], function() {
    // your CRUD resources and other admin routes here
    CRUD::resource('product', 'ProductCrudController');
    CRUD::resource('supplie', 'SupplieCrudController');
    CRUD::resource('product_transaction', 'Product_transactionCrudController');
    CRUD::resource('supplie_transaction', 'Supplie_transactionCrudController');
    Route::get('stock', 'ReportController@stock');
    Route::get('balance', 'ReportController@balance');
});
