<?php
Route::get('/home','Dashboard@index');

Route::get('/csof',function(){
	return view('sales.SOF',['active' => 'sof']);
});

Route::get('/sdri','SalesOrderList@index');

Route::get('/sc',function(){
	return view('sales.SC',['active' => 'sc']);
});


Route::get('/si',function(){
	return view('sales.SI',['active' => 'si']);
});

Route::get('/psr',function(){
	return view('sales.PSR',['active' => 'psr']);
});


Route::get('/cl',function(){
	return view('sales.CL',['active' => 'cl']);
});

Route::get('/sdr',function(){
	return view('sales.SDR',['active' => 'sdri']);
});

Route::get('/sr',function(){

	return view('sales.SR',['active' => 'sr']);
});
?>