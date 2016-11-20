<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class SalesModel extends Model{
	
	public static function getPendingSalesOrders(){

		$orders = DB::table('SalesOrders')
					->whereNotIn('SalesOrderID', function($query){
						$query->select('SalesOrderID')
							   ->from('SalesDeliveryReceipts');
					});
		return $orders->get();
	}   
}
