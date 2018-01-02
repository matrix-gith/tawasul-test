<?php

/*------------------------------------
/ Frontend Routes
/------------------------------------*/

Route::group(['namespace' => 'front','middleware' => 'language'], function() {

	Route::get('/login', ['as' => 'login', 'uses' => 'LoginController@index']);
	Route::post('/login', ['as' => 'do_user_login', 'uses' => 'LoginController@userLogin']);

});

/*
* Using User Middleware
*/
Route::get('/after-login', 		['as' => 'afterlogin',  	'uses' => 'front\UserController@afterlogin']);


Route::group(['namespace' => 'front', 'middleware' => ['language','auth:user','user']], function() {

	Route::get('/', 				['as' => 'home',  			'uses' => 'HomeController@index']);
	Route::get('/logout', 			['as' => 'user_logout',  	'uses' => 'LoginController@logout' ]);
	//Route::get('/after-login', 		['as' => 'afterlogin',  	'uses' => 'UserController@afterlogin']);

	Route::get('/profile', 			['as' => 'profile',  		'uses' => 'UserController@profile']);	
	Route::post('/profile',  		['as' => 'store_profile',	'uses' => 'UserController@storeProfile']);
	Route::get('/user-directory', 	['as' => 'user_directory',  'uses' => 'UserController@user_directory']);	
	Route::post('/ajax_follow', 	['as' => 'ajax_follow', 	'uses' => 'UserController@ajax_follow']);

	Route::post('/ajax_statelist', 	['as' => 'ajax_statelist', 	'uses' => 'UserController@ajax_getState']);
	Route::post('/ajax_citylist', 	['as' => 'ajax_citylist', 	'uses' => 'UserController@ajax_getCity']);

	Route::get('/calendar/{username?}',			['as' => 'calendar', 		'uses' => 'EventController@calendar']);

	//Route::get('/event/{username?}', 	['as' => 'event',  'uses' => 'EventController@index']);
	Route::get('/event/{eventDay}', 	['as' => 'event',  'uses' => 'EventController@index']);
	Route::any('/event_ajax_list', 		['as' => 'ajax_event',  'uses' => 'EventController@ajax_event']);

	Route::get('/event/add', ['middleware' => ['permission:add-event'], 'as' => 'add_event', 'uses' => 'EventController@addEvent']);
	Route::get('/event/edit',['middleware' => ['permission:edit-event'], 'as' => 'edit_event',   'uses' => 'EventController@editEvent']);
    Route::get('/event/details/{id}', ['as' => 'event_details',   'uses' => 'EventController@details']);

	Route::get('/tickets/{type?}', ['as' => 'tickets',  'uses' => 'TicketController@index']);
	Route::post('/create-ticket', ['as' => 'create_ticket',  'uses' => 'TicketController@create']);
	Route::get('/get-issues', ['as' => 'get_issues',  'uses' => 'TicketController@getIssues']);
	Route::get('/view-ticket/{id}', ['as' => 'view_ticket',  'uses' => 'TicketController@viewTicket']);
	Route::post('/reply-ticket/{id}', ['as' => 'reply_ticket',  'uses' => 'TicketController@reply']);
    Route::post('/close-ticket/{id}', ['as' => 'close_ticket',  'uses' => 'TicketController@closeTicket']);

	Route::get('/posted-tickets/{type?}', ['as' => 'posted_tickets',  'uses' => 'TicketController@postedTickets']);
    Route::get('/view-posted-ticket/{id}', ['as' => 'view_posted_ticket',  'uses' => 'TicketController@viewPostedTicket']);

    Route::get('/about/{username?}', ['as' => 'user_about',  'uses' => 'UserController@about']);
    Route::get('/friends/{username?}', ['as' => 'user_friends',  'uses' => 'UserController@friendList']);
    Route::get('/timeline/{username?}', ['as' => 'user_timeline',  'uses' => 'UserController@timeline']);

    Route::post('/create-post', ['as' => 'user_post_create',  'uses' => 'PostController@add']);
    Route::post('/create-comment', ['as' => 'user_post_comment',  'uses' => 'CommentController@add']);

    Route::get('/group-list/{keywords?}', ['as' => 'group',  'uses' => 'GroupController@index']);
	Route::get('/group-list', ['as' => 'group',  'uses' => 'GroupController@index']);
	Route::get('/group-details/{gid?}', ['as' => 'group_details',  'uses' => 'GroupController@details']);
	Route::get('/group-add', ['as' => 'group_add',  'uses' => 'GroupController@add']);


});


