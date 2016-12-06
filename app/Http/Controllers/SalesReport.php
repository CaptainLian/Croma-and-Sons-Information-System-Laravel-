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

		$weekly = DB::select(DB::raw("Select SI.SalesInvoiceID, C.Name ,SI.DateCreated ,SUM(CI.CurrentUnitPrice * SOI.Quantity) as TOTALAMOUNT,SUM(SO.Total * SO.Discount)as TOTALDISCOUNT,SUM(SR.UnitSoldPrice * SR.Quantity) as TOTALREJECT
			from SalesInvoice as SI left join SalesDeliveryReceipts SDR
			on SI.SalesDeliveryReceiptID = SDR. SalesDeliveryReceiptID
			left join (Select SO.SalesOrderID, SO.CustomerID, SO.Discount , SUM(CI.CurrentUnitPrice * SOI.Quantity) as Total
			FROM SalesOrders as SO left join SalesOrderItems SOI
			on SO.SalesOrderID = SOI.SalesOrderID
			left join CompanyInventory CI
			on SOI.Thickness = CI.Thickness and SOI.Width = CI.Width and SOI.Length = CI.Length and SOI.WoodTypeID = CI.WoodTypeID
			Group By SO.SalesOrderID,2,3) SO
			on SDR.SalesOrderID = SO.SalesORderID
			left join SalesOrderItems SOI
			on SO.SalesOrderID = SOI.SalesOrderID
			left join SalesRejects SR
			on SOI.Thickness = SR.Thickness and SOI.Width = SR.Width and SOI.Length = SR.Length and SOI.WoodTypeID = SR.WoodTypeID  and SI.SalesInvoiceID = SR.SalesInvoiceID
			left join CompanyInventory CI
			on SOI.Thickness = CI.Thickness and SOI.Width = CI.Width and SOI.Length = CI.Length and SOI.WoodTypeID = CI.WoodTypeID
			left join Customers C
			on SO.CustomerID = C.CustomerID
			Where SI.DateCreated >=  '$dstart' and SI.DateCreated <= '$dend'
			Group By SI.SalesInvoiceID,2,3
			order by 1 asc"));



					// // ->join('SalesDeliveryReceipts','SalesInvoice.SalesDeliveryReceiptID','=','SalesDeliveryReceipts.SalesDeliveryReceiptID')
					// // ->join('SalesOrders', 'SalesDeliveryReceipts.SalesOrderID', '=', 'SalesOrders.SalesOrderID')
					// // ->join('Customers','Customers.CustomerID','=','SalesOrders.CustomerID')
					// ->get();


		$monthly = DB::select(DB::raw("Select SI.SalesInvoiceID,C.Name, SI.DateCreated ,SUM(CI.CurrentUnitPrice * SOI.Quantity) as TOTALAMOUNT,SUM(SO.Total * SO.Discount)as TOTALDISCOUNT,SUM(SR.UnitSoldPrice * SR.Quantity) as TOTALREJECT
			from SalesInvoice as SI left join SalesDeliveryReceipts SDR
			on SI.SalesDeliveryReceiptID = SDR. SalesDeliveryReceiptID
			left join (Select SO.SalesOrderID,SO.CustomerID, SO.Discount , SUM(CI.CurrentUnitPrice * SOI.Quantity) as Total
			FROM SalesOrders as SO left join SalesOrderItems SOI
			on SO.SalesOrderID = SOI.SalesOrderID
			left join CompanyInventory CI
			on SOI.Thickness = CI.Thickness and SOI.Width = CI.Width and SOI.Length = CI.Length and SOI.WoodTypeID = CI.WoodTypeID
			Group By SO.SalesOrderID,2,3) SO
			on SDR.SalesOrderID = SO.SalesORderID
			left join SalesOrderItems SOI
			on SO.SalesOrderID = SOI.SalesOrderID
			left join SalesRejects SR
			on SOI.Thickness = SR.Thickness and SOI.Width = SR.Width and SOI.Length = SR.Length and SOI.WoodTypeID = SR.WoodTypeID and SI.SalesInvoiceID = SR.SalesInvoiceID
			left join CompanyInventory CI
			on SOI.Thickness = CI.Thickness and SOI.Width = CI.Width and SOI.Length = CI.Length and SOI.WoodTypeID = CI.WoodTypeID
			left join Customers C
			on SO.CustomerID = C.CustomerID
			Where SI.DateCreated >=  '$mstart' and SI.DateCreated <= '$mend'

			Group By SI.SalesInvoiceID,2,3"));

		$yearly = DB::select(DB::raw("Select SI.SalesInvoiceID,C.Name, SI.DateCreated ,SUM(CI.CurrentUnitPrice * SOI.Quantity) as TOTALAMOUNT,SUM(SO.Total * SO.Discount)as TOTALDISCOUNT,SUM(SR.UnitSoldPrice * SR.Quantity) as TOTALREJECT
			from SalesInvoice as SI left join SalesDeliveryReceipts SDR
			on SI.SalesDeliveryReceiptID = SDR. SalesDeliveryReceiptID
			left join (Select SO.SalesOrderID, SO.CustomerID, SO.Discount , SUM(CI.CurrentUnitPrice * SOI.Quantity) as Total
			FROM SalesOrders as SO left join SalesOrderItems SOI
			on SO.SalesOrderID = SOI.SalesOrderID
			left join CompanyInventory CI
			on SOI.Thickness = CI.Thickness and SOI.Width = CI.Width and SOI.Length = CI.Length and SOI.WoodTypeID = CI.WoodTypeID
			Group By SO.SalesOrderID,2,3) SO
			on SDR.SalesOrderID = SO.SalesORderID
			left join SalesOrderItems SOI
			on SO.SalesOrderID = SOI.SalesOrderID
			left join SalesRejects SR
			on SOI.Thickness = SR.Thickness and SOI.Width = SR.Width and SOI.Length = SR.Length and SOI.WoodTypeID = SR.WoodTypeID and SI.SalesInvoiceID = SR.SalesInvoiceID
			left join CompanyInventory CI
			on SOI.Thickness = CI.Thickness and SOI.Width = CI.Width and SOI.Length = CI.Length and SOI.WoodTypeID = CI.WoodTypeID
			left join Customers C
			on SO.CustomerID = C.CustomerID
			Where SI.DateCreated >=  '$ystart' and SI.DateCreated <= '$yend'
			Group By SI.SalesInvoiceID,2,3"));
					//  ->whereBetween('SalesInvoice.DateCreated',[$ystart,$yend])
					// ->join('SalesDeliveryReceipts','SalesInvoice.SalesDeliveryReceiptID','=','SalesDeliveryReceipts.SalesDeliveryReceiptID')
					// ->join('SalesOrders', 'SalesDeliveryReceipts.SalesOrderID', '=', 'SalesOrders.SalesOrderID')
					// ->join('Customers','Customers.CustomerID','=','SalesOrders.CustomerID')
					//  ->get();
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
			'yearly' => $yearly
			]);
	}
}
