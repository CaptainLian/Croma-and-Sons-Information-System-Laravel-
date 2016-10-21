<?php

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


Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);


/* Procurement */

Route::get('/procurement/PurchaseOrder', ['as' => 'PurchaseOrder', 'uses' => 'BusinessControllers\ProcurementPageController@viewPurchaseOrder']);

Route::get('/procurement/ProductPurchaseReport', ['as' => 'ProductPurchaseReport', 'uses' => 'BusinessControllers\ProcurementPageController@viewProductPurchaseReport' ])
?>