<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

class CustomerList extends Controller
{
    public function index(){
    $customers =DB::select( DB::raw("SELECT  C.CustomerID,C.Name,C.Address,C.MobileNumber,C.ContactPerson, SUM(SOI.Quantity * CI.CurrentUnitPrice) as 'TOTALSALES'
  FROM  Customers C left join (Select SO.SalesOrderID,SO.CustomerID
                From SalesOrders SO join SalesDeliveryReceipts SDR
                           on SO.SalesOrderID = SDR.SalesOrderID
                 Where Year(SO.DateCreated) = 2016
                                 and SDR.DRStatusID = 5 ) SO
               on C.CustomerID = SO.CustomerID
          left join SalesOrderItems SOI
                           on SO.SalesOrderID = SOI.SalesOrderID
          left join CompanyInventory CI
                           on CI.WoodtypeID  = SOI.WoodtypeID and CI.Thickness = SOI.Thickness and CI.Width = SOI.Width and CI.Length = SOI.Length
Where C.StatusID = 1

 Group By 1,2,3,4,5   "));


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
    public function edit(Request $request){
      $item = $request->input('json');

       /*DB::beginTransaction();*/

      $update = DB::table('Customers')
                 ->where('Name',$item[0])
                 ->update([
                      'Address' => $item[1],
                      'ContactPerson' =>$item[3],
                      'MobileNumber' =>$item[2],
                      ]);
       if($update){
            echo 'Success';
         }else{
            echo 'Failed';
         }

       /*DB::commit();*/

   }
   public function delete(Request $request){
      $item = $request->input('json');

       /*DB::beginTransaction();*/

      $update = DB::table('Customers')
                 ->where('Name',$item[0])
                 ->update(['StatusID' => '2']);
       if($update){
            echo 'Success';
         }else{
            echo 'Failed';
         }

       /*DB::commit();*/

   }
}
