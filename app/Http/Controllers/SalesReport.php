<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Carbon;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class SalesReport extends Controller
{
	public function index(){
		$dstart = Carbon::parse('last monday')->toDateString();
    	$dend =Carbon::parse('this sunday')->toDateString();

    	$mstart = Carbon::now()->startOfMonth();
    	$mend = Carbon::now()->endOfMonth();

    	$ystart = Carbon::now()->startOfYear();
    	$yend = Carbon::now()->endOfYear();

		$weekly = DB::table('SalesInvoice')					 
					->whereBetween('SalesInvoice.DateCreated',[$dstart,$dend])
					->join('SalesDeliveryReceipts','SalesInvoice.SalesDeliveryReceiptID','=','SalesDeliveryReceipts.SalesDeliveryReceiptID')
					->join('SalesOrders', 'SalesDeliveryReceipts.SalesOrderID', '=', 'SalesOrders.SalesOrderID')
					->join('Customers','Customers.CustomerID','=','SalesOrders.CustomerID')
					->get();
		$monthly = DB::table('SalesInvoice')
					 ->whereBetween('SalesInvoice.DateCreated',[$mstart,$mend])
					 ->join('SalesDeliveryReceipts','SalesInvoice.SalesDeliveryReceiptID','=','SalesDeliveryReceipts.SalesDeliveryReceiptID')
					->join('SalesOrders', 'SalesDeliveryReceipts.SalesOrderID', '=', 'SalesOrders.SalesOrderID')
					->join('Customers','Customers.CustomerID','=','SalesOrders.CustomerID')
					 ->get();
		$yearly = DB::table('SalesInvoice')
					 ->whereBetween('SalesInvoice.DateCreated',[$ystart,$yend])
					->join('SalesDeliveryReceipts','SalesInvoice.SalesDeliveryReceiptID','=','SalesDeliveryReceipts.SalesDeliveryReceiptID')
					->join('SalesOrders', 'SalesDeliveryReceipts.SalesOrderID', '=', 'SalesOrders.SalesOrderID')
					->join('Customers','Customers.CustomerID','=','SalesOrders.CustomerID')
					 ->get();			
		/*echo $dstart; 
		echo $mstart;
		echo $ystart;
		echo $dend;
		echo $mend;
		echo $yend;*/
		return view('sales.SR',[
				'active' => 'sr',
				'weekly' => $weekly,
				'monthly' => $monthly,
				'yearly' => $yearly]);
	}
}
