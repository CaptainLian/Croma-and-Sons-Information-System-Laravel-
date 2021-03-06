<?php

	Route::get('/', ['as' => 'LoginScreen', 'uses' => 'PageController@index']);


	/* FORMS */
	Route::post('/', ['as' => 'LoginValidation', 'uses' => 'LoginController@validateLogin']);

	Route::get('/sales/dashboard', ['as' => 'SalesDashboard',
								  'uses' => 'BusinessControllers\SalesPageController@viewDashboard']);



Route::get('/logout', ['as' => 'logout', 'uses' => 'LoginController@logout']);

Route::group(['prefix' => 'admin'], function(){
	Route::get('dashboard', ['as' => 'InventoryDashboard','uses' => 'BusinessControllers\AdminPageController@viewDashboard']);
});

	/* Procurement */

Route::group(['prefix' => 'procurement'], function(){
	Route::get('dashboard', ['as' => 'ProcurementDashboard', 'uses' => 'BusinessControllers\ProcurementPageController@viewDashboard']);

	Route::get('SelectProductPurchaseOrder', ['as' => 'CreatePurchaseOrderInitial', 'uses' => 'BusinessControllers\ProcurementPageController@viewCreatePurchaseOrder']);
	Route::get('CreatePurchaseOrder', ['uses' => 'BusinessControllers\ProcurementPageController@viewFormPurchaseOrder']);
  Route::post('inputPurchaseOrder', ['uses' => 'BusinessControllers\ProcurementFormController@inputPurchaseOrder']);

	Route::get('ProductPurchaseReport', ['as' => 'ProductPurchaseReport', 'uses' => 'BusinessControllers\ProcurementPageController@viewProductPurchaseReport' ]);

	Route::get('DeliveryReceipt', ['as' => 'EncodeDeliveryReceipt', 'uses' => 'BusinessControllers\ProcurementPageController@viewEncodeDeliveryReceipt']);

	Route::get('PurchaseOrderSpecific/{id}', ['as' => 'SpecificPurchaseOrder', 'uses' =>'BusinessControllers\ProcurementPageController@viewPurchaseOrderSpecific']);

	Route::get('DeliveryReceiptSpecific/{id}',['as' => 'SpecificDeliveryReceipt', 'uses' =>'BusinessControllers\ProcurementPageController@viewDeliveryReceiptSpecific']);

	Route::get('DeliveryReceiptSpecificInputless/{id}',['as' => 'SpecificDeliveryReceiptInputless', 'uses'=> 'BusinessControllers\ProcurementPageController@viewDeliveryReceiptSpecificInputless']);

	Route::get('SupplierList', ['as' =>'SupplierList', 'uses' => 'BusinessControllers\ProcurementPageController@viewSupplierList']);

	Route::get('PurchaseList', ['as' => 'PurchaseList', 'uses' => 'BusinessControllers\ProcurementPageController@viewPurchaseList']);

	Route::get('PurchaseReport', ['as' => 'PurchaseReport', 'uses' => 'BusinessControllers\ProcurementPageController@viewPurchaseReport']);


	//Route::post('CreatePurchaseOrder', ['as' => 'PurchaseOrderInput', 'uses' =>'BusinessControllers\ProcurementFormController@inputPurchaseOrder']);

	Route::post('CreateDeliveryReceipt', ['as' => 'DeliveryReceiptInput', 'uses' => 'BusinessControllers\ProcurementFormController@inputDeliveryReceipt']);

	Route::group(['prefix' => 'ajax'], function(){
		Route::get('test', function(){
			return 'aguy';
		});
	});
});

Route::group(['prefix' => 'inventory'], function(){
	Route::get('dashboard', ['as' => 'viewInventoryDashboard', 'uses' => 'BusinessControllers\InventoryPageController@viewDashboard']);

	Route::get('InventoryList', ['as' => 'viewInventoryList', 'uses' => 'BusinessControllers\InventoryPageController@viewInventoryList']);

	Route::get('EditInventory', ['as' => 'viewInventoryEdit', 'uses' => 'BusinessControllers\InventoryPageController@viewInventoryEdit']);

	Route::get('InventoryResizeInitial', ['as' => 'viewResizeInitial', 'uses' => 'BusinessControllers\InventoryPageController@viewResizeInitial']);
	Route::get('InventoryResize/{SalesOrderID}', ['as' => 'viewResize', 'uses' => 'BusinessControllers\InventoryPageController@viewResize']);

	Route::get('ApproveSalesOrder', ['as'=> 'viewApproveSalesOrder', 'uses' => 'BusinessControllers\InventoryPageController@viewApproveSalesOrder']);


	Route::get('inputResize', ['as' => '$inputResize', 'uses' => 'BusinessControllers\InventoryFormController@inputResize']);
	Route::group(['prefix' => 'ajax'], function(){
		Route::get('ProcurementRequest', ['as' => 'ProcurementRequest', 'uses' => 'BusinessControllers\InventoryFormController@requestProcurement']);

		Route::get('EditInventory', ['as' => 'EditInventory', 'uses' => 'BusinessControllers\InventoryFormController@editInventory']);

		Route::get('testAJAX', ['as' => 'dummyRoute', 'uses' => 'BusinessControllers\InventoryFormController@testAjax']);
	});
});

?>
