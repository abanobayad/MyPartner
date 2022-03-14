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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('App\Http\Controllers')->group(function()
{
    Route::post('/register' , 'Auth\AuthController@register')->name('reg');
    Route::post('/login' , 'Auth\AuthController@login')->name('login');
});


// Route::middleware('auth:api')->group(function () {

//     Route::resource('/product', 'API\ProductController');
//     Route::resource('/post', 'API\PostController');

    // Route::get('/product' , 'API\ProductController@index');
    // Route::post('/product-do-create' , 'API\ProductController@store');
    // Route::post('/product-do-edit' , 'API\ProductController@update');
    // Route::get('/product-show/{id}' , 'API\ProductController@show');
    // Route::get('/product-delete/{id}' , 'API\ProductController@destroy');

// });
