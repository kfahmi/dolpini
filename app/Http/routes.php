<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

//BEFORELOGIN
Route::get('/register',['middleware' => ['guest'], 'uses'=>'GuestController@register']);
Route::get('/password/reset',['middleware' => ['guest'], 'uses'=>'GuestController@forget']);
Route::auth();

Route::get('/',[ 'uses'=>'GuestController@index']);



//AFTER LOGIN

//homepage
Route::get('/home',['middleware' => ['authUser'], 'uses'=>'HomeController@index']);



	//POST
		//Create
		Route::post('/post',['middleware' => ['authUser'], 'uses'=>'Post\PostController@store']);
		//view detail
		Route::get('/post/detail/{id}/{reply_id?}',['middleware' => ['auth'], 'uses'=>'Post\PostController@view']);

		//post edit
		Route::get('/post/edit/{id}',['middleware' => ['auth'], 'uses'=>'Post\PostController@edit']);
		//prosess edit
		Route::post('/post/edit/{id}',['middleware' => ['auth'], 'uses'=>'Post\PostController@editProcess']);


		//flag
		Route::get('/post/flag/{type}/{id}',['middleware' => ['authUser'], 'uses'=>'Post\PostFlagController@store']);
		//post subscribe
		Route::get('/post/subscribe/{id}',['middleware' => ['authUser'], 'uses'=>'Post\PostController@subscribe']);
		//post delete
		Route::get('/post/delete/{id}',['middleware' => ['auth'], 'uses'=>'Post\PostController@delete']);

		//post delete
		Route::get('/post/deleteDetail/{id}',['middleware' => ['auth'], 'uses'=>'Post\PostController@deleteDetail']);

		//post reactivate
		Route::get('/post/reactivate/{id}',['middleware' => ['auth'], 'uses'=>'Post\PostController@reactivate']);


	//sorting home dengan hastags
		Route::get('/home/{tags}',['middleware' => ['auth'], 'uses'=>'HomeController@index']);



	//reply
		//reply kubu
		Route::post('/post/reply',['middleware' => ['authUser'], 'uses'=>'Post\PostController@reply']);
		//reply flag
		Route::get('/post/reply/flag/{type}/{id}',['middleware' => ['authUser'], 'uses'=>'Post\ReplyFlagController@store']);

	//User
		//View user
		Route::get('/user/profile/{nick_name}',['middleware' => ['auth'], 'uses'=>'User\UserController@profile']);
		//edit profile
		Route::post('/user/edit',['middleware' => ['auth'], 'uses'=>'User\UserController@edit']);

	//follow
		//add request follow
		Route::get('/follow/add/{id}',['middleware' => ['authUser'], 'uses'=>'User\FollowController@store']);
		//approve request follow
		Route::get('/follow/app/{id}',['middleware' => ['authUser'], 'uses'=>'User\FollowController@app']);

	//Notif
		//Request follow
		// Route::get('/notif/{type}',['middleware' => ['auth'], 'uses'=>'NotifController@notifDetail']);	

		//read notif
		Route::get('/notif/read',['middleware' => ['auth'], 'uses'=>'NotifController@read']);

	//search
		Route::post('/search',['middleware' => ['auth'], 'uses'=>'HomeController@search']);













//ADMIN DASHBOARD

		//adminhomepage
		Route::get('/homeAdmin',['middleware' => ['authAdmin'], 'uses'=>'HomeController@indexAdmin']);

		//user
		Route::get('/user/admin',['middleware' => ['authAdmin'], 'uses'=>'User\UserController@admin']);

		Route::post('/user/deleteRestore',['middleware' => ['authAdmin'], 'uses'=>'User\UserController@deleteRestore']);

		Route::get('/user/verify_unverify_ByAdmin/{id}',['middleware' => ['authAdmin'], 'uses'=>'User\UserController@verify_unverify_ByAdmin']);

		Route::get('/user/verifyByUser/{user_id}/{confirmation_code}',['middleware' => ['guest'], 'uses'=>'User\UserController@verifyByUser']);

		Route::get('/user/sendCode/{user_id}',['middleware' => ['authAdmin'], 'uses'=>'User\UserController@sendCode']);


		//post
		Route::get('/post/admin',['middleware' => ['authAdmin'], 'uses'=>'Post\PostController@admin']);

		//post
		Route::get('/post/cleanReported/{post_id}',['middleware' => ['authAdmin'], 'uses'=>'Post\PostFlagController@cleanReported']);

		//ReplyKubu
		Route::get('/post/reply/admin',['middleware' => ['authAdmin'], 'uses'=>'Post\PostController@adminReply']);
	
		//ReplyKubu restore
		Route::post('/post/reply/deleteRestoreReply',['middleware' => ['auth'], 'uses'=>'Post\PostController@deleteRestoreReply']);

		//replykubu cleanreported
		Route::get('/post/reply/cleanReported/{reply_id}',['middleware' => ['authAdmin'], 'uses'=>'Post\ReplyFlagController@cleanReported']);

		//badwords
		Route::get('/badwords/admin',['middleware' => ['authAdmin'], 'uses'=>'Post\BadwordsController@admin']);

		//bw create
		Route::get('/badwords/create',['middleware' => ['authAdmin'], 'uses'=>'Post\BadwordsController@create']);
		Route::post('/badwords/create',['middleware' => ['authAdmin'], 'uses'=>'Post\BadwordsController@store']);

		//bw edit
		Route::get('/badwords/edit/{id}',['middleware' => ['authAdmin'], 'uses'=>'Post\BadwordsController@edit']);
		Route::post('/badwords/edit',['middleware' => ['authAdmin'], 'uses'=>'Post\BadwordsController@update']);


		//bw delete
		Route::post('/badwords/forceDelete',['middleware' => ['authAdmin'], 'uses'=>'Post\BadwordsController@forceDelete']);


		//tags
		Route::get('/tag/admin',['middleware' => ['authAdmin'], 'uses'=>'Post\TagController@admin']);

