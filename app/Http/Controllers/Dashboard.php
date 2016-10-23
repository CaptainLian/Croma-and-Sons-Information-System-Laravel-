<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function index(){

    	$orders = DB::table('SalesOrders')
    				->join('SalesDeliveryReceipts','SalesOrders.SalesOrderID','=',"SalesDeliveryReceipts.SalesOrderID")
    				->count("SalesOrders.SalesOrderID");

    	$deliveredOrders = DB::table('SalesDeliveryReceipts')
    						 ->join('SalesInvoice','SalesInvoice.SalesDeliveryReceiptID','=',"SalesDeliveryReceipts.SalesDeliveryReceiptID")
    						 ->count("SalesDeliveryReceipts.SalesDeliveryReceiptID");
    	
    	$pendingOrders = $orders - $deliveredOrders;

    	// Subject to change
    	$approvedSalesOrder = DB::table('SalesOrders')
                                ->where('SalesOrders.SalesOrderStatusID','2')
    							->count('SalesOrders.SalesOrderID');

    
    	$pendingDeliveryReceipts = DB::table('SalesDeliveryReceipts')
                                   ->where('DRStatusID','1')
    							   ->count('SalesDeliveryReceiptID');     
		 


		//Subject to change

		$success = 50;

		$failed = 50;




    	return view('sales.SD',['pendingOrders' => $pendingOrders,
    							'approvedSalesOrder' => $approvedSalesOrder,
    							'pendingDeliveryReceipts' => $pendingDeliveryReceipts,
    							'success' => $success,
    							'failed' => $failed]);


    }
    
}
