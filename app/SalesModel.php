<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class SalesModel extends Model{

	public static function getPendingSalesOrders(){
		$pendingSales = DB::table('SalesOrders')
											->select(DB::raw("SalesOrders.SalesOrderID,
																				DATE_FORMAT(SalesOrders.DateCreated, '%b %d, %Y - %r') AS DateCreated,
																				SalesOrders.CustomerID,
																				SalesOrders.DeliveryAddress,
																				Customers.Name AS CustomerName,
																				Customers.Address,
																				Customers.ContactPerson,
																				Customers.Landline"))
											->where('SalesOrderStatusID' , '=', 1)
											->join('Customers', 'Customers.CustomerID', '=', 'SalesOrders.CustomerID');
		return $pendingSales->get();
	}

	public static function getSalesOrderDetails($salesOrderID){
			$salesOrder = DB::table('SalesOrders')
											->where('SalesOrderID', '=', $salesOrderID);
			return $salesOrder->get();
	}

	public static function getSalesOrderItems($salesOrderID){
		$salesOrderItems = DB::table('SalesOrderItems')
												->select(DB::raw(
														"SalesOrderItems.SalesOrderID,
														SalesOrderItems.WoodTypeID,
														REF_WoodTypes.WoodType,
														SalesOrderItems.Thickness,
														SalesOrderItems.Width,
														SalesOrderItems.Length,
														CONCAT(SalesOrderItems.Thickness, 'x', SalesOrderItems.Width, 'x', SalesOrderItems.Length) AS Size,
														SalesOrderItems.Quantity,
														SalesOrderItems.BoardFeet"
													))
												->where('SalesOrderID', '=', $salesOrderID)
												->join('REF_WoodTypes', 'REF_WoodTypes.WoodTypeID', '=', 'SalesOrderItems.WoodTypeID');
		return $salesOrderItems->get();
	}

	public static function getDeliveryReceiptOfSalesOrder($salesOrderID){
		$drid = DB::table('SalesDeliveryReceipts')
							->select(DB::raw('SalesOrderID, SalesDeliveryReceiptID AS AGUY'))
							->where('SalesOrderID', '=', $salesOrderID);
		return $drid->first();
	}
}
