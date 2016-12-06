<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon;

use Illuminate\Support\Facades\DB;

class SalesOrderList extends Controller
{
    public function index(){
    	$pendingSalesOrder = DB::table('SalesDeliveryReceipts')
    						   ->select('*')
                   ->join('SalesOrders','SalesOrders.SalesOrderID','=','SalesDeliveryReceipts.SalesOrderID')
    						   ->join('Customers', 'SalesOrders.CustomerID','=','Customers.CustomerID')
    						   ->where('SalesDeliveryReceipts.DRStatusID', '2')->get();


    	return view('sales.SDRI',
    		['pendingSalesOrder' => $pendingSalesOrder,
    		 'active' => 'sdri']);

    }

    public function create($salesID){
        $now = Carbon::now()->toDateString();
        $so = DB::table('SalesOrders')
                ->where('SalesOrderID',$salesID)
                ->get();
        $sdr = DB::table('SalesDeliveryReceipts')
                 ->where('SalesOrderID',$salesID)
                 ->pluck('SalesDeliveryReceiptID');
        $addr = DB::table('SalesOrders')
                 ->where('SalesOrderID',$salesID)
                 ->pluck('DeliveryAddress');
        $dis = DB::table('SalesOrders')
                 ->where('SalesOrderID',$salesID)
                 ->pluck('Discount');

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
            'sdrID'=>$sdr[0],

            'customer' => $customer,
            'address' =>$addr[0],
            'dis' => $dis[0]*100,
            'items' => $items]);
    }

    public function post(Request $request){
          $date = $request->input('date');
          $id = $request->input('sdrID');
          // echo $id;
          DB::beginTransaction();
          try{
          $insert =DB::table('SalesInvoice')
            ->insert([
              'SalesDeliveryReceiptID'=>$id,
              'Discount'=>$request->input('discount')/100

              ]);

          /*echo $insert.'Insert';
          echo $date;*/

          $update = DB::table('SalesDeliveryReceipts')
          ->where('SalesDeliveryReceiptID',intval($id))
          ->update(['DRStatusID' => intval(3),
                    'DateDelivered' => $date]);

          /*echo $update.'Update';*/

            if(!$insert || !$update){
               DB::rollBack();
               echo 'Fail';
            }
          }
          catch(\Exception $e){
            echo $e;
            DB::rollBack();
          }
          DB::commit();
          $pendingSalesOrder = DB::table('SalesOrders')
                   ->select('*')
                   ->join('Customers', 'SalesOrders.CustomerID','=','Customers.CustomerID')
                   ->join('SalesDeliveryReceipts','SalesOrders.SalesOrderID','=','SalesDeliveryReceipts.SalesOrderID')
                   ->where('SalesDeliveryReceipts.DRStatusID', '2')->get();


      return view('sales.SDRI',
        ['pendingSalesOrder' => $pendingSalesOrder,
         'active' => 'sdri']);
    }
}
