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

	Route::group(['prefix' => 'procurement'], function(){
		Route::get('home','Dashboard@index');

		Route::get('salesOrder','SalesOrder@index');

		Route::get('deliveryReceiptInitial','SalesOrderList@index');

		Route::get('createDeliveryReceipt/{salesOrderID}','SalesOrderList@create');
		Route::post('deliveryReceiptInitial','SalesOrderList@post');

		Route::get('catalog','SalesCatalog@index');


		Route::get('invoice','SalesInvoice@list');

		Route::get('invoice/{sdrid}', 'SalesInvoice@create');


		Route::get('productReport',function(){
			return view('sales.PSR',['active' => 'psr']);
		});


		Route::get('customerlist','CustomerList@index');


		Route::get('createDeliveryReceipt',function(){
			return view('sales.SDR',['active' => 'sdri']);
		});

		Route::get('report','SalesReport@index');

		Route::post('salesOrder/create','SalesOrder@create');
	});


	Route::get('/try',function(){
		return view('sales.SII');
	});

	require_once 'Lian.php';

?>