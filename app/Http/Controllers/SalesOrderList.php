<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon;

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
    public function create($salesID){
        $now = Carbon::now()->toDateString();
        $so = DB::table('SalesOrders')
                ->where('SalesOrderID',$salesID)
                ->get();
    
        $customer = DB::table('Customers')
                      ->where('CustomerID',$so[0]->CustomerID)
                      ->get();

        $items = DB::table('SalesOrderItems')
                   ->leftJoin('CompanyInventory',function($join){
                         $join->on('SalesOrderItems.Thickness', '=', 'CompanyInventory.Thickness');
                            $join->on('SalesOrderItems.Width', '=', 'CompanyInventory.Width');
                            $join->on('SalesOrderItems.Length', '=', 'CompanyInventory.Length');
                            $join->on('SalesOrderItems.WoodTypeID', '=', 'CompanyInventory.WoodTypeID');
                   })
                   ->join('REF_WoodTypes as REW','SalesOrderItems.WoodTypeID','=','REW.WoodTypeID')
                   ->where('SalesOrderID',$salesID)
                   ->get();

        return view('sales.SDR',['active' => 'sdr',
            'so' => $so,
            'now' => $now,
            'customer' => $customer,
            'items' => $items]);
    }

    public function post(Request $request){

    }
}
