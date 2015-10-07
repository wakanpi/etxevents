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

Route::get('/', 'PageController@index');
Route::get('/about', 'PageController@about');
Route::resource('contact', 'ContactController');

Route::post('/search', 'SearchController@search');


// Login and Session Routes
Route::get('/registration-complete', 'AuthController@getRegisterComplete');
Route::get('/verify/{auth_key}', 'AuthController@getVerify');


Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    'tag' => 'TagController',
    'entity' => 'EntityController',
    'ajax' => 'AjaxController'
]);

//  Facebook Login
Route::get('/social/facebook', 'FacebookController@redirectToProvider');
Route::get('/social/facebook/callback', 'FacebookController@handleProviderCallback');

//  Google Login
Route::get('/social/google', 'GoogleController@redirectToProvider');
Route::get('/social/google/callback', 'GoogleController@handleProviderCallback');

//  Twitter Login
Route::get('/social/twitter', 'TwitterController@redirectToProvider');
Route::get('/social/twitter/callback', 'TwitterController@handleProviderCallback');

//  User Specific Routes
Route::get('/dashboard', 'DashboardController@index');

Route::get('/{slug}', 'ETXCategoryController@getCategory');


//  Event Related Routes
Route::get('/event/create', 'ETXEventController@getCreate');
Route::post('/event/create', 'ETXEventController@postCreate');
Route::get('/event/manage/{id}', 'ETXEventController@getManage');

Route::get('/detail/{slug}', 'ETXEventController@getEvent');


