<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

class CustomerList extends Controller
{
    public function index(){
    	$customers = DB::table('Customers')
    				   ->select('Customers.CustomerID','Customers.Address','Customers.Name','Customers.MobileNumber','Customers.ContactPerson','SalesOrders.DateCreated')
    				   ->leftJoin('SalesOrders', 'Customers.CustomerID','=','SalesOrders.CustomerID')
    				   ->get();
    	$totalPrice= DB::table('SalesOrderItems')
    				   ->select(DB::raw('SUM(Quantity*CurrentUnitPrice) AS TOTAL,SalesOrders.CustomerID'))
    				   
    				   ->join('CompanyInventory', function ($join) {
				            $join->on('SalesOrderItems.Thickness', '=', 'CompanyInventory.Thickness');
				            $join->on('SalesOrderItems.Width', '=', 'CompanyInventory.Width');
				            $join->on('SalesOrderItems.Length', '=', 'CompanyInventory.Length');
				        })
    				   ->join('SalesOrders','SalesOrders.SalesOrderID','=','SalesOrderItems.SalesOrderID')
    				   ->groupBy('SalesOrders.CustomerID')
    				   ->get();




    	return view('sales.CL',[
    		'active' => 'cl',
    		'customer' => $customers,
    		'total' => $totalPrice]);
    }
}
