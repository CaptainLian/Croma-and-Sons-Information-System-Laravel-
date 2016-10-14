<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

/* */
Route::get('/', ['as' => 'LoginScreen', 'uses' => 'PageController@index']);



/* FORMS */

Route::post('/', ['as' => 'LoginValidation', 'uses' => 'LoginController@validateLogin']);

Route::get('aguy', ['as' =>'Tester', 'uses' => 'PageController@aguy']);

Route::get('/test', function(){
	return view ('dashboard');
});

Route::get('/test1', function(){
	return view ('Templates\Sales\Master');
});


/* SALES ROUTES */
Route::get('/sales/dashboard', function(){
	return view ('SalesPages\dashboard');
});

