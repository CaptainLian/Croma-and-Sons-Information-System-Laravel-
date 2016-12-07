<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


use Illuminate\Support\Facades\DB;


class SalesInvoice extends Controller
{
    public function Aguy(){

    	$pd = DB::table('SalesDeliveryReceipts as SDR')
    			->join('SalesOrders as SO', 'SDR.SalesOrderID','=','SO.SalesOrderID')
    			->join('Customers as C','C.CustomerID','=','SO.CustomerID')
          ->join('SalesInvoice as SI','SI.SalesDeliveryReceiptID','=','SDR.SalesDeliveryReceiptID')
    			->where('SDR.DRStatusID','3')
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
              ->join('SalesOrderItems as SOI','SOI.SalesOrderID','=','SO.SalesOrderID')
              ->join('Customers as C','C.CustomerID','=','SO.CustomerID')
              ->join('REF_WoodTypes as RW','SOI.WoodTypeID','=','RW.WoodTypeID')
              ->join('CompanyInventory as CI', function ($join){
                  $join->on('SOI.WoodTypeID','=','CI.WoodTypeID');
                  $join->on('SOI.Thickness','=','CI.Thickness');
                  $join->on('SOI.Width','=','CI.Width');
                  $join->on('SOI.Length','=','CI.Length');
              })
              ->where('SalesInvoiceID',$id)
              ->get();

      $discount = DB::table('SalesOrders as SO')
                    ->join('SalesDeliveryReceipts as SDR','SDR.SalesOrderID','=','SO.SalesOrderID')
                    ->join('SalesInvoice as SI','SI.SalesDeliveryReceiptID','=','SDR.SalesDeliveryReceiptID')
                    ->orderBy('SDR.DateCreated','desc')
                    ->limit(1)
                    ->where('SI.SalesInvoiceID',$id)
                    ->pluck('SO.Discount');

      if(empty($discount)){{
        $discount =0;
      }}
    	return view('sales.SI',
            ['active' => 'si',
             'so' => $so,

            'discount'=>$discount[0],
          'id'=>$id ]);
    }

    public function submit(Request $request){
      $sdr = DB::table('SalesDeliveryReceipts as SDR')
               ->join('SalesInvoice as SI','SI.SalesDeliveryReceiptID','=','SDR.SalesDeliveryReceiptID')

               ->where('SI.SalesInvoiceID',$request->input('id'))
               ->orderBy('SDR.DateCreated','desc')
               ->limit(1)
               ->pluck('SDR.SalesDeliveryReceiptID');
      DB::table('SalesDeliveryReceipts')
        ->where('SalesDeliveryReceiptID',$sdr[0])
        ->update(['DRStatusID'=>5]);
      // echo $sdr[0];
      $len = $request->input('len');
      $wid = $request->input('wid');
      $thick = $request->input('thick');
      $wood = $request->input('wood');
      $quan = $request->input('quan');
      for($ctr = 0; $ctr < count($quan); $ctr++){
        if(($quan[$ctr]) > 0){
          $wd = ($wood[$ctr]);
          if($wood[$ctr] === 'Kiln Dry')
            $wd = 1;
          elseif($wood[$ctr] === 'Sun Dry')
            $wd = 2;


          $w = ($wid[$ctr]);
          $l = ($len[$ctr]);
          $t = ($thick[$ctr]);
          $price = DB::table('CompanyInventory')
                     ->where('WoodTypeID',$wd)
                     ->where('Width',$w)
                     ->where('Length',$l)
                     ->where('Thickness',$t)
                     ->pluck('CurrentUnitPrice');
          // echo $price[0];

          $suc = DB::table('SalesRejects')
                  ->insert([
                  'SalesInvoiceID' => $request->input('id'),
                  'WoodTypeID'=> $wd,
                  'Thickness'=> $t,
                  'Width'=>$w,
                  'Length'=>$l,
                  'Quantity'=>$quan[$ctr],
                  'UnitSoldPrice' => $price[0]
                ]);
          if($suc){
            // echo 'Success';
          }

        }
      }
      $pd = DB::table('SalesDeliveryReceipts as SDR')
    			->join('SalesOrders as SO', 'SDR.SalesOrderID','=','SO.SalesOrderID')
    			->join('Customers as C','C.CustomerID','=','SO.CustomerID')
          ->join('SalesInvoice as SI','SI.SalesDeliveryReceiptID','=','SDR.SalesDeliveryReceiptID')
    			->where('SDR.DRStatusID','3')
    			->get();

    	return view('sales.SII',
    		['active' => 'si',
        'outcome'=>1,
    		 'pending'=>$pd
    		 ]);







    }
}
