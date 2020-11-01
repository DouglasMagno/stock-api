<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['prefix'=>'products'], function(){
    Route::get('', ['as' => 'products', 'uses' => 'App\Http\Controllers\ProductController@getAll']);
    Route::get('find/{id}', ['as' => 'products.find', 'uses' => 'App\Http\Controllers\ProductController@findProduct']);
    Route::post('create', ['as' => 'products.create', 'uses' => 'App\Http\Controllers\ProductController@createProducts']);
    Route::put('update', ['as' => 'products.update', 'uses' => 'App\Http\Controllers\ProductController@updateProducts']);
    Route::delete('delete', ['as' => 'products.delete', 'uses' => 'App\Http\Controllers\ProductController@deleteProducts']);
});

Route::group(['prefix'=>'history'], function(){
    Route::get('', ['as' => 'products', 'uses' => 'App\Http\Controllers\HistoryController@getAll']);
    Route::post('create', ['as' => 'products.create', 'uses' => 'App\Http\Controllers\HistoryController@createHistories']);
});
