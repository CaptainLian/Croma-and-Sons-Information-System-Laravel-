<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use Illuminate\Support\Facades\DB;


class SalesInvoice extends Controller
{
    public function list(){
    	$pd = DB::table('SalesDeliveryReceipts as SDR')
    			->join('SalesOrders as SO', 'SDR.SalesOrderID','=','SO.SalesOrderID')
    			->join('Customers as C','C.CustomerID','=','SO.CustomerID')
    			->where('SDR.DRStatusID','1')
    			->get();

    	return view('sales.SII',
    		['active' => 'si',
    		 'pending'=>$pd
    		 ]);
    }
    public function create($id){

    	return view('sales.SI',['active' => 'si']);
    }
}
