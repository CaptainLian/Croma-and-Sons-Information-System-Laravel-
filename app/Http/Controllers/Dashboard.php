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
    	$approvedSalesOrder = DB::table('SalesDeliveryReceipts')
                           ->where('DRStatusID',2)
                           ->count();

    
    	$pendingDeliveryReceipts = DB::table('SalesDeliveryReceipts')
                                   ->where('DRStatusID','3')
    							   ->count('SalesDeliveryReceiptID');     
        $temp = DB::select(DB::raw("Select SUM(SDI.Quantity) as Success,SUM(SR.Quantity) as Failed
  From SalesOrders SO Join SalesDeliveryReceipts SDR
                       on  SO.SalesOrderID = SDR.SalesOrderID
                      Join SalesInvoice SI
                       on SDR.SalesDeliveryReceiptID = SI.SalesDeliveryReceiptID
                      join SalesDeliveryItems SDI
                        on SDR.SalesDeliveryReceiptID = SI.SalesDeliveryReceiptID
                      join SalesRejects SR
                        on SI.SalesInvoiceID = SR.SalesInvoiceID"));
        $success = DB::table('SalesOrderItems')
                     
                     ->sum('Quantity');
        $failed = DB::table('SalesRejects')
                    ->sum('Quantity');
        

		 $monthlySales = DB::select(DB::raw("Select Month(SO.DateCreated) as MONTHID, SUM(CI.CurrentUnitPrice * SOI.Quantity) As MONTHLY
  From SalesInvoice SI join SalesDeliveryReceipts SDR
             on SI.SalesDeliveryReceiptID  = SDR.SalesDeliveryReceiptID
             join SalesOrders SO
                         on SDR.SalesOrderID = SO.SalesOrderID
          join SalesOrderItems SOI
            on SO.SalesOrderID = SOI.SalesOrderID
            join CompanyInventory CI
                        on  SOI.Thickness = CI.Thickness and SOI.Width = CI.Width and SOI.Length = CI.Length and SOI.WoodTypeID = CI.WoodTypeID
Where Year(SO.DateCreated) = Year(Now())
and SDR.DRStatusID = 5
Group by 1
Order by 1"));


		 

     $month = [0,0,0,0,0,0,0,0,0,0,0,0];
     for($x =0 ; $x < count($monthlySales) ; $x++ ){
       for($i =0 ; $i < 12 ; $i++ ){
          if($monthlySales[$x]->MONTHID == $i+1){
            $month[$i] = $monthlySales[$x]->MONTHLY;
          }
       }
     }


 

    	return view('sales.SD',['pendingOrders' => $pendingOrders,
    							'approvedSalesOrder' => $approvedSalesOrder,
    							'pendingDeliveryReceipts' => $pendingDeliveryReceipts,
    							'success' => $success,
    							'failed' => $failed,
                  'monthlySales' => $month]);


    }
    
}
