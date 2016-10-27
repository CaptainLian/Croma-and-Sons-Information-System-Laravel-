<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

class DashboardModel extends Model{
    public static function getPendingPurchaseRequestCount(){
    	/*
			SELECT COUNT(RequisitionID)
 			  FROM PurchaseRequests
			 WHERE RequisitionID NOT IN (SELECT RequisitionID
										  FROM PurchaseOrders);
    	*/
		$count = DB::table('PurchaseRequests')
				   ->select(DB::raw('COUNT(RequisitionID) as count'))
				   ->whereNotIn('RequisitionID', function($query){
				   		$query->from('PurchaseOrders')
				   			  ->select('RequisitionID');
				   })->first();
		return $count->count;

    }

    public static function getPendingPurchaseOrderCount(){
    	/*
			SELECT COUNT(PurchaseOrderID)
 FROM PurchaseOrders
WHERE PurchaseOrderID NOT IN (SELECT PurchaseOrderID
							    FROM PurchaseDeliveryReceipts);
    	*/
		$count = DB::table('PurchaseOrders')
				   ->select(DB::raw('COUNT(PurchaseOrderID) as count'))
				   ->whereNotIn('PurchaseOrderID', function($query){
				   		$query->from('PurchaseDeliveryReceipts')
				   			  ->select('PurchaseOrderID');
				   });
		return $count->first()->count;

    }
}
