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


Route::namespace('App\Http\Controllers\API')->group(function () {


    //Auth Routes "without middleware of sanctum Auth"
    Route::post('/register', 'AuthController@register')->name('reg');
    Route::post('/login', 'AuthController@login')->name('login');


    Route::middleware(['auth:sanctum', 'api'])->group(function () { //Middleware of Auth

        //Profile
        Route::prefix('/profile')->group(function () {
            Route::get('/', 'ProfileController@index');                 //Show All Profiles for handle
            Route::get('/show/{id}', 'ProfileController@GET');          //Show Profile of Specific User with his ID
            Route::post('/add', 'ProfileController@ADD');               //Add User Profile
            Route::post('/edit', 'ProfileController@EDIT');             //Edit User Profile
            Route::get('/delete/{id}', 'ProfileController@DELETE');     //Delete Profile of Specific User with his ID
            Route::get('/account/{id}', 'ProfileController@UserAcc');     //Delete Profile of Specific User with his ID
        });


        //Post
        Route::prefix('/post')->group(function () {
            Route::get('/', 'PostController@index');                //Show All Posts For Handle
            Route::post('/add', 'PostController@ADD');              //Add new Post
            Route::post('/edit', 'PostController@EDIT');            //Edit existed Post
            Route::get('/delete/{id}', 'PostController@DELETE');    //Delete Specific post With its ID
            Route::get('/show/{id}', 'PostController@GET');         //Show Post with its ID
        });

        Route::post('/logout', 'Auth\AuthController@logout');
    });
});
