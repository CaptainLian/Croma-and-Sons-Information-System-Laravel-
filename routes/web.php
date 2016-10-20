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

Route::get('/sales/dashboard', ['as' => 'SalesDashboard', 
							  'uses' => 'BusinessControllers\SalesPageController@viewDashboard']);

Route::get('/procurement/dashboard', ['as' => 'ProcurementDashboard',
									 'uses' => 'BusinessControllers\ProcurementPageController@viewDashboard']);

Route::get('/inventory/dashboard', ['as' => 'InventoryDashboard', 
							      'uses' => 'BusinessControllers\InventoryPageController@viewDashboard']);

Route::get('/admin/dashboard', ['as' => 'InventoryDashboard', 
							      'uses' => 'BusinessControllers\AdminPageController@viewDashboard']);
