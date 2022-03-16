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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::namespace('App\Http\Controllers')->group(function()
{

    Route::post('/register' , 'Auth\AuthController@register')->name('reg');

    Route::post('/login' , 'Auth\AuthController@login')->name('login');


 Route::middleware(['auth:sanctum'  , 'api'] )->group(function () {
    // Route::resource('/profile', 'ProfileController');

        //Profile
        Route::prefix('/profile')->group(function () {
            Route::get('/', 'ProfileController@index');
            Route::get('/show/{id}', 'ProfileController@GET');       //user ID
            Route::post('/add', 'ProfileController@ADD');
            Route::post('/edit', 'ProfileController@EDIT');
            Route::get('/delete/{id}', 'ProfileController@DELETE'); //user ID
        });


        //Post
        Route::prefix('/post')->group(function () {
            Route::get('/', 'PostController@index');
            Route::post('/add', 'PostController@ADD');
            Route::post('/edit', 'PostController@EDIT');
            Route::get('/delete/{id}', 'PostController@DELETE');  //user ID
            Route::get('/show/{id}', 'PostController@GET');       //user ID
        });

        Route::post('/logout', 'Auth\AuthController@logout');

});
});
