<?php

Route::get('/', ['as' => 'LoginScreen', 'uses' => 'PageController@index']);


/* FORMS */
Route::post('/', ['as' => 'LoginValidation', 'uses' => 'LoginController@validateLogin']);

Route::get('/sales/dashboard', ['as' => 'SalesDashboard', 
							  'uses' => 'BusinessControllers\SalesPageController@viewDashboard']);

Route::get('/inventory/dashboard', ['as' => 'InventoryDashboard', 
							      'uses' => 'BusinessControllers\InventoryPageController@viewDashboard']);

Route::get('/admin/dashboard', ['as' => 'InventoryDashboard', 
							      'uses' => 'BusinessControllers\AdminPageController@viewDashboard']);


Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);


/* Procurement */
Route::get('/procurement/dashboard', ['as' => 'ProcurementDashboard', 'uses' => 'BusinessControllers\ProcurementPageController@viewDashboard']);

Route::get('/procurement/CreatePurchaseOrder', ['as' => 'PurchaseOrder', 'uses' => 'BusinessControllers\ProcurementPageController@viewCreatePurchaseOrder']);

Route::get('/procurement/ProductPurchaseReport', ['as' => 'ProductPurchaseReport', 'uses' => 'BusinessControllers\ProcurementPageController@viewProductPurchaseReport' ]);

Route::get('/procurement/DeliveryReceipt', ['as' => 'EncodeDeliveryReceipt', 'uses' => 'BusinessControllers\ProcurementPageController@viewEncodeDeliveryReceipt']);

Route::get('/procurement/PurchaseOrderSpecific/{id}', ['as' => 'SpecificPurchaseOrder', 'uses' =>'BusinessControllers\ProcurementPageController@viewPurchaseOrderSpecific']);

Route::get('/procurement/DeliveryReceiptSpecific/{id}',['as' => 'SpecificDeliveryReceipt', 'uses' =>'BusinessControllers\ProcurementPageController@viewDeliveryReceiptSpecific']);
Route::get('procurement/SupplierList', ['as' =>'SupplierList', 'uses' => 'BusinessControllers\ProcurementPageController@viewSupplierList']);

Route::post('/procurement/CreatePurchaseOrder', ['as' => 'PurchaseOrderInput', 'uses' =>'BusinessControllers\ProcurementFormController@inputPurchaseOrder'])
?>