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
																				Customers.Name,
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
												->where('SalesOrderID', '=', $salesOrderID);
		return $salesOrderItems->get();
	}
}
