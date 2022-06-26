<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::namespace('App\Http\Controllers\API')->group(function () {

    //Auth Routes "without middleware of sanctum Auth"
    Route::post('/register', 'AuthController@register')->name('reg');
    Route::post('/login', 'AuthController@login')->name('login');
    Route::post('/facebook-login', 'FacebookLoginController@login')->name('face-login');
    Route::post('password/email', 'ForgotPasswordController@forgot');
    Route::post('password/reset', 'ForgotPasswordController@reset');


    //Start Middlewares
    Route::middleware(['auth:sanctum', 'api'])->group(function () {      //Middleware of Auth and Ban
        //Profile
        Route::prefix('/profile')->group(function () {
            Route::get('/', 'ProfileController@index');                 //Show All Profiles for handle
            Route::get('/show/{id}', 'ProfileController@GET');          //Show Profile of Specific User with his ID
            Route::post('/add', 'ProfileController@ADD');               //Add User Profile
            Route::post('/edit', 'ProfileController@EDIT');             //Edit User Profile
            Route::get('/delete/{id}', 'ProfileController@DELETE');     //Delete Profile of Specific User with his user ID
            Route::get('/{id}', 'ProfileController@UserAcc');   //Show Profile & Posts of  User with his user ID
        });


        //Account
        Route::prefix('/account')->group(function () {
            Route::get('/', 'AccountController@myAccount');
            Route::get('/{user_id}', 'AccountController@guestAccount');
        });

        //Interests
        Route::prefix('/interest')->group(function () {
            Route::post('/make', 'InterestController@make');
            Route::get('/show', 'InterestController@show');
            Route::get('/many-vistited-groups', 'InterestController@manyVgroups');


        });


        //Post
        Route::prefix('/post')->group(function () {
            Route::get('/', 'PostController@index');                //Show All Posts For Handle
            Route::post('/add', 'PostController@ADD');              //Add new Post
            Route::post('/edit/{post_id}', 'PostController@EDIT');            //Edit existed Post
            Route::get('/delete/{id}', 'PostController@DELETE');    //Delete Specific post With its ID
            Route::get('/show/{id}', 'PostController@GET')->name('showPost');         //Show Post and comments and replies with its ID
            Route::get('/save-post/{id}', 'PostController@SavePost');         //Show Post and comments and replies with its ID
            Route::get('/unsave-post/{id}', 'PostController@UnSavePost');         //Show Post and comments and replies with its ID
            Route::get('/show-saved-posts', 'PostController@showSaved');         //Show Post and comments and replies with its ID
        });


        //group
        Route::prefix('/group')->group(function () {
            Route::get('/', 'GroupController@index');                //Show All Posts For Handle
            Route::get('/show/{id}', 'GroupController@show')->name('showGroup');         //Show Post and comments and replies with its ID
            Route::get('/fav-group/{id}', 'GroupController@FavGroup');         //Show Post and comments and replies with its ID
            Route::get('/unfav-group/{id}', 'GroupController@UnFavGroup');         //Show Post and comments and replies with its ID
            Route::get('/show-fav-group', 'GroupController@showFav');         //Show Post and comments and replies with its ID
        });

        //group
        Route::prefix('/tag')->group(function () {

            Route::get('/show/{id}', 'TagController@get')->name('showTag');         //Show Tag and Groups of this tag and some posts
        });


        //Search
        Route::prefix('/search')->group(function () {
            Route::post('/homepage', 'SearchBarController@HomepageSearch');
            Route::post('/profile/{id}', 'SearchBarController@ProfilePostSearch'); //Add User Id
            Route::post('/group/{id}', 'SearchBarController@GroupPostSearch');     //Add Group Id
        });


        //Request
        Route::prefix('/request')->group(function () {
            Route::get('/', 'ReqController@index');                   //show all requests of Auth user
            Route::get('/pending', 'ReqController@showPending')->name('show.pending');                   //show all requests of Auth user
            Route::get('/accepted', 'ReqController@showAccepted');                   //show all requests of Auth user
            Route::get('/rejected', 'ReqController@showRejected');                   //show all requests of Auth user
            Route::get('/cancel/{p_id}/{r_id}', 'ReqController@cancelRequest');                   //show all requests of Auth user
            Route::get('/my/sent/requests', 'ReqController@mySentRequests');                   //show all requests of Auth user
            Route::get('/show/{p_id}/{r_id}', 'ReqController@showReq')->name('showRequest');
            Route::post('/doRequest', 'ReqController@doReq');                   //Req Post
            Route::get('acceptRequest/{post_id}/{requester_id}', 'ReqController@approveRequest')->name('acceptRequest');
            Route::get('rejectRequest/{post_id}/{requester_id}', 'ReqController@rejectRequest')->name('rejectRequest');
            Route::get('deleteRequest/{post_id}/{requester_id}', 'ReqController@deleteRequest')->name('deleteRequest');
        });


        //Notifications
        Route::prefix('/notify')->group(function () {
            Route::get('/markAllRead', 'NotificationController@readAll');
            Route::get('/markRead/{id}', 'NotificationController@read');
            Route::get('/get', 'NotificationController@GET');
            Route::get('/getAll', 'NotificationController@GetAll');
        });


        //Comments
        Route::prefix('/comment')->group(function () {
            Route::post('/add', 'CommentController@comment');                   //add NEW comment
            Route::post('/edit/{c_id}', 'CommentController@edit');              //Edit OLD Comment "Send Comment ID"
            Route::get('/get/{c_id}', 'CommentController@get');                //get OLD Comment "Send Comment ID"
            Route::get('/post_comment/{post_id}', 'CommentController@post_comment');    //get all Comment of post "Send post ID"
            Route::post('/delete/{c_id}', 'CommentController@DELETE');          //delete Comment "Send Comment ID"
            Route::get('/post_comment/{post_id}', 'CommentController@post_comment');    //get all Comment of post "Send post ID"
        });


        //Replies
        Route::prefix('/reply')->group(function () {
            Route::post('/add', 'ReplyController@make');                      //add NEW Reply
            Route::post('/edit/{r_id}', 'ReplyController@edit');              //Edit OLD Reply "Send Reply ID"
            Route::post('/delete/{r_id}', 'ReplyController@DELETE');          //delete Reply "Send Reply ID"
            Route::get('/get/{c_id}', 'ReplyController@get');                //get OLD Comment "Send Comment ID"

        });


        //Category
        Route::prefix('/category')->group(function () {
            Route::get('/show', 'CategoryController@show');
            Route::get('/getByCat/{id}', 'CategoryController@GetGroupsByCategory');

        });


        //Rate
        Route::prefix('/rate')->group(function () {
            Route::get('/myRate', 'RateController@myRate');              //Show user rates
            Route::get('/get/{id}', 'RateController@GET');               //Show rates of Specific User with his ID
            Route::get('/total/{id}', 'RateController@totalRate');           //Show total rates of Specific User with his ID
            Route::post('/add', 'RateController@ADD');               //make new rate
            Route::post('/edit/{id}', 'RateController@EDIT');             //Edit Specific rate
            Route::get('/delete/{id}', 'RateController@DELETE');     //Delete specific rate
            Route::get('/make/{id}', 'RateController@make');
        });


        //Report
        Route::prefix('/report')->group(function () {
            Route::post('/add', 'ReportController@ADD');                        //make new report
            Route::post('/edit/{id}', 'ReportController@EDIT');                 //Edit Specific report
            Route::get('/delete/{id}', 'ReportController@DELETE');              //Delete specific report
        });


        //Contact
        Route::prefix('/contact')->group(function () {
            Route::post('/add', 'ContactController@ADD');                        //make new report
        });


        //Chat
        Route::prefix('/chat')->group(function () {
            Route::get('/conversation/{user_id}', 'ChatController@conversation')->name('conversation');
            Route::post('/send_message/{user_id}', 'ChatController@send_message')->name('send_message');
            Route::get('/delete_message/{id}', 'ChatController@delete_message')->name('delete_message');
            Route::get('/delete_conversation/{user_id}', 'ChatController@delete_conversation')->name('delete_conversation');
            Route::get('/my_chats', 'ChatController@my_chats')->name('my_chats');
        });


        //Logout
        Route::post('/logout', 'AuthController@logout');
    });
});
