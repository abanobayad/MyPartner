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



 Route::middleware('auth:sanctum')->group(function () {

    // Route::resource('/profile', 'ProfileController');


    Route::get('/getAllProfiles', 'ProfileController@index');
    Route::post('/addProfile', 'ProfileController@ADD');
    Route::post('/editProfile', 'ProfileController@EDIT');
    Route::get('/deleteProfile/{id}', 'ProfileController@DELETE'); //user ID
    Route::get('/getProfile/{id}', 'ProfileController@GET'); //user ID

});


 });
