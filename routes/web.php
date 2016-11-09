<?php


	/*
	|--------------------------------------------------------------------------
	| Web Routes
	|--------------------------------------------------------------------------
	|
	| This file is where you may define all of the routes that are http_persistent_handles_ident()
	| by your application. Just tell Laravel the URIs it should respond
	| to using a Closure or controller method. Build something great!
	|
	*/

	Route::group(['prefix' => 'sales'], function(){
		Route::get('home','Dashboard@index');

		Route::get('salesOrder','SalesOrder@index');


Route::post('sales/salesOrder/check','SalesOrder@check'); 

Route::post('sales/salesOrder/create','SalesOrder@create');



Route::get('/sales/deliveryReceiptInitial','SalesOrderList@index');

Route::get('/sales/createDeliveryReceipt/{salesOrderID}','SalesOrderList@create');

Route::post('sales/deliveryReceiptInitial','SalesOrderList@post');

		Route::get('invoice','SalesInvoice@list');

Route::post('/sales/catalog/add','SalesCatalog@add');
Route::post('/sales/catalog/edit','SalesCatalog@edit');


Route::get('/sales/invoice','SalesInvoice@list');

		Route::get('productReport',function(){
			return view('sales.PSR',['active' => 'psr']);
		});


		Route::get('customerlist','CustomerList@index');


		Route::get('createDeliveryReceipt',function(){
			return view('sales.SDR',['active' => 'sdri']);
		});

Route::post('/sales/customerlist/add','CustomerList@add');

		Route::post('salesOrder/create','SalesOrder@create');
	});


	Route::get('/try',function(){
		return view('sales.SII');
	});

require_once 'Lian.php';
/*Routes::post('/sales','SalesOrder@check');*/

