<?php

use Illuminate\Support\Facades\Route;

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


Route::namespace('App\Http\Controllers\Admin')->prefix('/dashboard')->group(function () {
    Route::middleware('adminsAuth:admin')->group(function () {  //kernel keyword no middelware class : guardName

        Route::get('/', 'DashboardController@index')->name('admin.home');
        // Route::get('/ban', 'BanController@ban')->name('admin.home');
        //Admin Edit
            Route::get('editAdmin' ,  'AdminsController@edit')->name('admin.edit');
            Route::post('do-editAdmin' , 'AdminsController@doEdit')->name('do-editAdmin');


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



                  //group users
                  Route::prefix('/users')->group(function () {
                    Route::get('/', 'UserAController@index')->name('admin.user.index');
                    Route::get('/create', 'UserAController@create')->name('admin.user.create');
                    Route::post('/do-create', 'UserAController@doCreate')->name('admin.user.doCreate');
                    Route::get('/edit/{id}', 'UserAController@edit')->name('admin.user.edit');
                    Route::post('/do-edit', 'UserAController@doEdit')->name('admin.user.doEdit');
                    Route::get('/delete/{id}', 'UserAController@delete')->name('admin.user.delete');
                });

        Route::get('/logout', 'AdminAuthController@logout')->name('admin.logout');

});
Route::get('/login', 'AdminAuthController@login')->name('admin.login');
Route::post('/do-login', 'AdminAuthController@doLogin')->name('admin.dologin');
});
