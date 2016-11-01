<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

class CustomerList extends Controller
{
    public function index(){
    $customers =DB::select( DB::raw('
                SELECT Customers.CustomerID as CustomerID,Customers.Address as Address, Customers.Name as Name, Customers.MobileNumber as MobileNumber, Customers.ContactPerson as ContactPerson, Max(SalesOrders.DateCreated) as DateCreated
                  FROM Customers  left join SalesOrders 
                                             on Customers.CustomerID = SalesOrders.CustomerID
                        Group By Customers.CustomerID,Customers.Name,Customers.Address, Customers.MobileNumber, Customers.ContactPerson'));
        
   	$totalPrice= DB::table('SalesOrderItems')
    				   ->select(DB::raw('SUM(   Quantity*CurrentUnitPrice) AS TOTAL,SalesOrders.CustomerID'))
    				   
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

    public function add(Request $request){
        $item = $request->input('json');

        /*DB::beginTransaction();*/        
        
        $var = DB::table('Customers')
              ->insert([
              'Name' => $item[0],
              'Address' => $item[1],
              'MobileNumber' => $item[2],
              'ContactPerson' => $item[3]]);
        echo 'neil';
        if($var){
            echo 'Success';
        }else{
            echo 'Failed';
        }
     
      


       /*DB::commit();*/
   
    }
}
