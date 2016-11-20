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
          ->join('SalesInvoice as SI','SI.SalesDeliveryReceiptID','=','SDR.SalesDeliveryReceiptID')
    			->where('SDR.DRStatusID','2')
    			->get();

    	return view('sales.SII',
    		['active' => 'si',
    		 'pending'=>$pd
    		 ]);
    }
    public function create($id){
        
        $so=DB::table('SalesInvoice as SI')
              ->join('SalesDeliveryReceipts as SDR','SI.SalesDeliveryReceiptID','=','SDR.SalesDeliveryReceiptID')
              ->join('SalesOrders as SO', 'SDR.SalesOrderID','=','SO.SalesOrderID')
              ->join('Customers as C','C.CustomerID','=','SO.CustomerID')
              ->where('SalesInvoiceID',$id)
              ->get(); 
         
    	return view('sales.SI',
            ['active' => 'si',
             'so' => $so]);
    }
}
