<?php

namespace App\Http\Controllers;

use App\User;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{
    public function index(){
    	$pendingOrders = DB::table('SalesDeliveryReceipts')
                           ->where('DRStatusID',1)
                           ->count();
                           
        
    	// Subject to change
    	$approvedSalesOrder = DB::table('SalesOrders')
                                ->where('SalesOrders.SalesOrderStatusID','2')
    							->count();

    
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
