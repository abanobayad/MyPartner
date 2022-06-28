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
Route::view('forgot_password', 'User.reset-password')->name('password.reset');
Route::namespace('App\Http\Controllers\Admin')->prefix('/dashboard')->group(function () {
    Route::middleware('adminsAuth:admin')->group(function () {  //kernel keyword no middelware class : guardName

        Route::get('/', 'DashboardController@index')->name('admin.home');
        //Route::get('/ban', 'BanController@ban')->name('admin.home');
        //Admin Edit
        Route::get('editAdmin',  'AdminsController@edit')->name('admin.edit');
        Route::post('do-editAdmin', 'AdminsController@doEdit')->name('do-editAdmin');
        // Notitifications
        Route::get('/markAllRead' , 'NotificationController@readAll')->name('markAllRead');
        Route::get('/showAll' , 'NotificationController@showAll')->name('showAll');
        Route::get('/markRead/{id}' , 'NotificationController@read')->name('markRead');


        //category routes
        Route::prefix('/illegalword')->group(function () {
            Route::get('/', 'IllegalWordsController@index')->name('admin.word.index');
            Route::get('/create', 'IllegalWordsController@add')->name('admin.word.create');
            Route::post('/do-create', 'IllegalWordsController@store')->name('admin.word.doCreate');
            Route::get('/edit/{id}', 'IllegalWordsController@edit')->name('admin.word.edit');
            Route::post('/do-edit', 'IllegalWordsController@doEdit')->name('admin.word.doEdit');
            Route::get('/delete/{id}', 'IllegalWordsController@delete')->name('admin.word.delete');
        });


        //category routes
        Route::prefix('/cat')->group(function () {
            Route::get('/test', 'CatController@test');
            Route::get('/', 'CatController@index')->name('admin.cat.index');
            Route::get('/show/{id}', 'CatController@show')->name('admin.cat.show');
            Route::get('/create', 'CatController@create')->name('admin.cat.create');
            Route::post('/do-create', 'CatController@doCreate')->name('admin.cat.doCreate');
            Route::post('/do-create2', 'CatController@doCreate2')->name('admin.cat.doCreate2');
            Route::get('/edit/{id}', 'CatController@edit')->name('admin.cat.edit');
            Route::post('/do-edit', 'CatController@doEdit')->name('admin.cat.doEdit');
            Route::get('/delete/{id}', 'CatController@delete')->name('admin.cat.delete');
        });



        //tag routes
        Route::prefix('/tag')->group(function () {
            Route::get('/', 'TagController@index')->name('admin.tag.index');
            Route::get('/show/{id}', 'TagController@show')->name('admin.tag.show');
            Route::get('/create', 'TagController@create')->name('admin.tag.create');
            Route::post('/do-create', 'TagController@doCreate')->name('admin.tag.doCreate');
            Route::get('/edit/{id}', 'TagController@edit')->name('admin.tag.edit');
            Route::post('/do-edit', 'TagController@doEdit')->name('admin.tag.doEdit');
            Route::get('/delete/{id}', 'TagController@delete')->name('admin.tag.delete');
        });


        //group routes
        Route::prefix('/group')->group(function () {
            Route::get('/', 'GroupController@index')->name('admin.group.index');
            Route::get('/show/{id}', 'GroupController@show')->name('admin.group.show');
            Route::any('/show-group-posts/{id}', 'GroupController@showGroupPosts')->name('admin.group.posts.show');
            Route::get('/create', 'GroupController@create')->name('admin.group.create');
            Route::post('/do-create', 'GroupController@doCreate')->name('admin.group.doCreate');
            Route::get('/create1', 'GroupController@create1')->name('admin.group.create1');
            Route::get('/do-create1/{id}', 'GroupController@doCreate1')->name('admin.group.doCreate1');
            Route::get('/edit/{id}', 'GroupController@edit')->name('admin.group.edit');
            Route::post('/do-edit', 'GroupController@doEdit')->name('admin.group.doEdit');
            Route::get('/delete/{id}', 'GroupController@delete')->name('admin.group.delete');
        });

        //users routes
        Route::prefix('/users')->group(function () {
            Route::get('/', 'UserAController@index')->name('admin.user.index');
            Route::get('/{id}', 'UserAController@showUser')->name('admin.user.show');
            Route::any('/searchUserPosts/{user_id}' , 'UserAController@search')->name('searchUserPosts');
            Route::get('ban/detailes/{user_id}', 'BanController@index')->name('ban-detailes');
            Route::post('ban/', 'BanController@ban')->name('ban');
            Route::post('unban/', 'BanController@unban')->name('unban');
            Route::post('ban/check', 'BanController@bannedStatus')->name('ban.check');
        });


         //rate
         Route::prefix('/rate')->group(function () {
            Route::get('/', 'RateController@index')->name('admin.rate.index');
            Route::get('/low', 'RateController@low')->name('admin.rate.low');
            Route::get('/show/{s_id}/{r_id}', 'RateController@show')->name('admin.rate.show');
            Route::get('/get/{id}', 'RateController@GET')->name('admin.rate.get');
            Route::get('/delete/{s_id}/{r_id}', 'RateController@DELETE')->name('admin.rate.delete');

        });

        // contact
        Route::prefix('/contact')->group(function () {
            Route::get('index', 'ContController@index')->name('admin.contact.index');
            Route::get('/get/{id}', 'ContController@GET')->name('admin.contact.get');
            Route::get('/show/{id}', 'ContController@show')->name('admin.contact.show');
            Route::post('/replay/{id}', 'ContController@Replay')->name('admin.contact.replay');
            Route::get('/delete/{id}', 'ContController@DELETE')->name('admin.contact.delete');
        });

//Posts
        Route::prefix('/post')->group(function () {
            Route::any('/', 'PostController@index')->name('admin.post.index');
            Route::get('/show/{id}', 'PostController@show')->name('admin.post.show');
            Route::any('/show-post-requests/{id}', 'PostController@showPostRequests')->name('admin.post.requests.show');

        });


        //report
        Route::prefix('/report')->group(function () {
            Route::any('/index', 'RepController@index')->name('admin.report.index');
            Route::get('/show/{post_id}/{user_id}', 'RepController@show')->name('admin.report.show');
            Route::get('/getall/{user_id}', 'RepController@GetAll')->name('admin.report.getall');
            Route::get('/delete/{post_id}/{user_id}', 'RepController@DELETE')->name('admin.report.delete');
            Route::get('/approve/{post_id}/{user_id}', 'RepController@approve')->name('admin.report.approve');
            Route::get('/reject/{post_id}/{user_id}', 'RepController@reject')->name('admin.report.reject');



        });


        Route::get('/logout', 'AdminAuthController@logout')->name('admin.logout');
    });
    Route::get('/login', 'AdminAuthController@login')->name('admin.login');
    Route::post('/do-login', 'AdminAuthController@doLogin')->name('admin.dologin');
});

