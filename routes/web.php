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


Route::post('sales/salesOrder/check','SalesOrder@check');

Route::post('sales/salesOrder/check2','SalesOrder@change');

Route::post('sales/salesOrder/create','SalesOrder@create');



Route::get('/sales/deliveryReceiptInitial','SalesOrderList@index');

Route::get('/sales/createDeliveryReceipt/{salesOrderID}','SalesOrderList@create');

Route::post('sales/deliveryReceiptInitial/submit/','SalesOrderList@post');

Route::get('/sales/catalog','SalesCatalog@index');

Route::post('/sales/catalog/add','SalesCatalog@add');

Route::post('/sales/catalog/edit','SalesCatalog@edit');

Route::post('/sales/catalog/delete','SalesCatalog@delete');

Route::get('/sales/invoice','SalesInvoice@list');

Route::get('/sales/invoice/{sdrid}', 'SalesInvoice@create');

Route::post('/sales/invoice/submit', 'SalesInvoice@submit');


Route::get('/sales/productReport',function(){
	return view('sales.PSR',['active' => 'psr']);
});


Route::get('/sales/customerlist','CustomerList@index');

Route::post('/sales/customerlist/add','CustomerList@add');

Route::post('/sales/customerlist/edit','CustomerList@edit');
Route::post('/sales/customerlist/delete','CustomerList@delete');

Route::get('/sales/createDeliveryReceipt',function(){
	return view('sales.SDR',['active' => 'sdri']);
});

Route::get('/sales/report','SalesReport@index');

Route::get('/try',function(){
	return view('sales.SII');
});



/*Routes::post('/sales','SalesOrder@check');*/

require_once 'Lian.php';