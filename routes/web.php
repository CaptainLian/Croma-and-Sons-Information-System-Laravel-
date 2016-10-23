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

Route::get('/sales/home','Dashboard@index');

Route::get('/sales/salesOrder','SalesOrder@index');

 


Route::get('/sales/deliveryReceiptInitial','SalesOrderList@index');

Route::get('/sales/catalog','SalesCatalog@index');


Route::get('/sales/invoice','SalesInvoice@list');

Route::get('/sales/invoice/{sdrid}', 'SalesInvoice@create');


Route::get('/sales/productReport',function(){
	return view('sales.PSR',['active' => 'psr']);
});


Route::get('/sales/customerlist','CustomerList@index');


Route::get('/sales/createDeliveryReceipt',function(){
	return view('sales.SDR',['active' => 'sdri']);
});

Route::get('/sales/report','SalesReport@index');

Route::get('/try',function(){
	return view('sales.SII');
});

Route::post('sales/salesOrder/create','SalesOrder@create');