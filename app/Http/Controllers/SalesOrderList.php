<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

class SalesOrderList extends Controller
{
    public function index(){
    	$pendingSalesOrder = DB::table('SalesOrders')
    						   ->select('*')
    						   ->join('Customers', 'SalesOrders.CustomerID','=','Customers.CustomerID')
    						   ->where('SalesOrders.SalesOrderStatusID', '1')->get();  
    	
		
    	return view('sales.SDRI',
    		['pendingSalesOrder' => $pendingSalesOrder,
    		 'active' => 'sdri']);

    }
}
