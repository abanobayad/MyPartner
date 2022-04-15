<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\RateController ;      // to access fun , class exist in productController

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

Route::get('/', function(){
    return view('Admin.weclome');
});

Route::namespace('App\Http\Controllers\Admin')->prefix('/dashboard')->group(function () {
    Route::middleware('adminsAuth:admin')->group(function () {  //kernel keyword no middelware class : guardName

        Route::get('/', 'DashboardController@index')->name('admin.home');
        // Route::get('/ban', 'BanController@ban')->name('admin.home');
        //Admin Edit
        Route::get('editAdmin',  'AdminsController@edit')->name('admin.edit');
        Route::post('do-editAdmin', 'AdminsController@doEdit')->name('do-editAdmin');
        // Notitifications
        Route::get('/markAllRead' , 'NotificationController@readAll')->name('markAllRead');
        Route::get('/markRead/{id}' , 'NotificationController@read')->name('markRead');


        //category routes
        Route::prefix('/cat')->group(function () {
            Route::get('/', 'CatController@index')->name('admin.cat.index');
            Route::get('/create', 'CatController@create')->name('admin.cat.create');
            Route::post('/do-create', 'CatController@doCreate')->name('admin.cat.doCreate');
            Route::get('/edit/{id}', 'CatController@edit')->name('admin.cat.edit');
            Route::post('/do-edit', 'CatController@doEdit')->name('admin.cat.doEdit');
            Route::get('/delete/{id}', 'CatController@delete')->name('admin.cat.delete');
        });



        //tag routes
        Route::prefix('/tag')->group(function () {
            Route::get('/', 'TagController@index')->name('admin.tag.index');
            Route::get('/create', 'TagController@create')->name('admin.tag.create');
            Route::post('/do-create', 'TagController@doCreate')->name('admin.tag.doCreate');
            Route::get('/edit/{id}', 'TagController@edit')->name('admin.tag.edit');
            Route::post('/do-edit', 'TagController@doEdit')->name('admin.tag.doEdit');
            Route::get('/delete/{id}', 'TagController@delete')->name('admin.tag.delete');
        });


        //group routes
        Route::prefix('/group')->group(function () {
            Route::get('/', 'GroupController@index')->name('admin.group.index');
            Route::get('/create', 'GroupController@create')->name('admin.group.create');
            Route::post('/do-create', 'GroupController@doCreate')->name('admin.group.doCreate');
            Route::get('/edit/{id}', 'GroupController@edit')->name('admin.group.edit');
            Route::post('/do-edit', 'GroupController@doEdit')->name('admin.group.doEdit');
            Route::get('/delete/{id}', 'GroupController@delete')->name('admin.group.delete');
        });

        //users routes
        Route::prefix('/users')->group(function () {
            Route::get('/', 'UserAController@index')->name('admin.user.index');
            Route::get('/{id}', 'UserAController@showUser')->name('admin.user.show');
            Route::post('/searchUserPosts/{user_id}' , 'UserAController@search')->name('searchUserPosts');
            Route::get('ban/detailes/{user_id}', 'BanController@index')->name('ban-detailes');
            Route::post('ban/', 'BanController@ban')->name('ban');
            Route::post('unban/', 'BanController@unban')->name('unban');
            Route::post('ban/check', 'BanController@bannedStatus')->name('ban.check');


         //rate
            Route::get('/rate/index', 'RateController@index')->name('admin.rate.index');
            Route::get('/rate/low', 'RateController@low')->name('admin.rate.low');
            Route::get('/rate/show/{id}', 'RateController@show')->name('admin.rate.show');
            Route::get('/rate/get/{id}', 'RateController@GET')->name('admin.rate.get');
            Route::get('/rate/delete/{id}', 'RateController@DELETE')->name('admin.rate.delete');

        });

        // contact
        Route::prefix('/contact')->group(function () {
            Route::get('index', 'ContController@index')->name('admin.contact.index');
            Route::get('/get/{id}', 'ContController@GET')->name('admin.contact.get');
            Route::get('/show/{id}', 'ContController@show')->name('admin.contact.show');
            Route::get('/delete/{id}', 'ContController@DELETE')->name('admin.contact.delete');
        });

        //report
        Route::prefix('/report')->group(function () {
            Route::any('/index', 'RepController@index')->name('admin.report.index');
            Route::get('/show/{post_id}/{user_id}', 'RepController@show')->name('admin.report.show');
            Route::get('/delete/{post_id}/{user_id}', 'RepController@DELETE')->name('admin.report.delete');
            Route::get('/approve/{post_id}/{user_id}', 'RepController@approve')->name('admin.report.approve');
            Route::get('/reject/{post_id}/{user_id}', 'RepController@reject')->name('admin.report.reject');


        });


        Route::get('/logout', 'AdminAuthController@logout')->name('admin.logout');
    });
    Route::get('/login', 'AdminAuthController@login')->name('admin.login');
    Route::post('/do-login', 'AdminAuthController@doLogin')->name('admin.dologin');
});

