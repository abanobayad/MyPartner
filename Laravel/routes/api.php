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


    Route::middleware(['auth:sanctum', 'api'])->group(function () { //Middleware of Auth and Ban

        //Profile
        Route::prefix('/profile')->group(function () {
            Route::get('/', 'ProfileController@index');                 //Show All Profiles for handle
            Route::get('/show/{id}', 'ProfileController@GET');          //Show Profile of Specific User with his ID
            Route::post('/add', 'ProfileController@ADD');               //Add User Profile
            Route::post('/edit', 'ProfileController@EDIT');             //Edit User Profile
            Route::get('/delete/{id}', 'ProfileController@DELETE');     //Delete Profile of Specific User with his user ID
            Route::get('/account/{id}', 'ProfileController@UserAcc');   //Show Profile & Posts of  User with his user ID
        });


        //Post
        Route::prefix('/post')->group(function () {
            Route::get('/', 'PostController@index');                //Show All Posts For Handle
            Route::post('/add', 'PostController@ADD');              //Add new Post
            Route::post('/edit/{post_id}', 'PostController@EDIT');            //Edit existed Post
            Route::get('/delete/{id}', 'PostController@DELETE');    //Delete Specific post With its ID
            Route::get('/show/{id}', 'PostController@GET')->name('showPost');         //Show Post and comments and replies with its ID
        });


        //Search
        Route::prefix('/search')->group(function () {

            Route::post('/groups', 'SearchBarController@GroupSearch');              //Add new Post

        });


        //Req
            Route::prefix('/request')->group(function () {

                Route::get('/', 'ReqController@index');                   //show all requests of Auth user
                Route::get('/show/{p_id}/{r_id}', 'ReqController@showReq')->name('showRequest');                   //show specific request //Send Post ID and Requester ID
                Route::post('/doRequest', 'ReqController@doReq');                   //Req Post
                Route::get('acceptRequest/{post_id}/{requester_id}'  , 'RequestController@approveRequest')->name('acceptRequest');
                Route::get('rejectRequest/{post_id}/{requester_id}'  , 'RequestController@rejectRequest')->name('rejectRequest');
                Route::get('deleteRequest/{post_id}/{requester_id}'  , 'RequestController@deleteRequest')->name('deleteRequest');

            });


            //Notifications
            Route::prefix('/notify')->group(function () {
                Route::get('/markAllRead' , 'NotificationController@readAll');
                Route::get('/markRead/{id}' , 'NotificationController@read');
                Route::get('/get' , 'NotificationController@GET');
                Route::get('/getAll' , 'NotificationController@GetAll');
            });


        //Comments
            Route::prefix('/comment')->group(function () {
                Route::post('/add', 'CommentController@comment');                   //add NEW comment
                Route::post('/edit/{c_id}', 'CommentController@edit');              //Edit OLD Comment "Send Comment ID"
            });


        // rate
            Route::prefix('/rate')->group(function () {
                Route::get('/myRate', 'RateController@myRate');              //Show user rates
                Route::get('/get/{id}', 'RateController@GET');               //Show rates of Specific User with his ID
                Route::get('/total/{id}', 'RateController@totalRate');           //Show total rates of Specific User with his ID
                Route::post('/add', 'RateController@ADD');               //make new rate
                Route::post('/edit/{id}', 'RateController@EDIT');             //Edit Specific rate
                Route::get('/delete/{id}', 'RateController@DELETE');     //Delete specific rate
                Route::get('/make/{id}', 'RateController@make');


            });


        // report
            Route::prefix('/report')->group(function () {
                Route::post('/add', 'ReportController@ADD');                        //make new report
                Route::post('/edit/{id}', 'ReportController@EDIT');                 //Edit Specific report
                Route::get('/delete/{id}', 'ReportController@DELETE');              //Delete specific report
            });



        // contact
            Route::prefix('/contact')->group(function () {
                Route::post('/add', 'ContactController@ADD');                        //make new report
            });

        Route::post('/logout', 'Auth\AuthController@logout');
    });
});
