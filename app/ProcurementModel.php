<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
class ProcurementModel extends Model{

	public static function getWeeklyQuantityProductPurchase(){
		$eh = DB::select(DB::raw("SELECT Types.WoodType AS Material, CONCAT(Purchased.Thickness, 'x', Purchased.Width, 'x', Purchased.Length) AS Size, 
							   Purchased.PurchasedQuantity - Rejected.RejectedQuantity AS PurchasedQuantity, 
							   Rejected.RejectedQuantity AS RejectedQuantity,
							   (Purchased.PurchasedQuantity - Rejected.RejectedQuantity)*pdi.PurchasedUnitPrice AS PurchasedAmount,
							   Rejected.RejectedQuantity*pdi.PurchasedUnitPrice AS RejectedAmount
						FROM (SELECT WoodTypeID, Thickness, width, Length, SUM(Quantity) AS PurchasedQuantity
							    FROM PurchaseDeliveryItems
							   WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
																     FROM PurchaseDeliveryReceipts
																	WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE()))
							  GROUP BY WoodTypeID, Thickness, Width, Length) Purchased JOIN (SELECT WoodTypeID, Thickness, width, Length, SUM(Quantity) AS RejectedQuantity
																							  FROM PurchaseRejects
																							 WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
																																   FROM PurchaseDeliveryReceipts
																																   WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE()))
																							GROUP BY WoodTypeID, Thickness, Width, Length) Rejected
																						ON Purchased.WoodTypeID = Rejected.WoodTypeID
						                                                                AND Purchased.Thickness = Rejected.Thickness
						                                                                AND Purchased.Width = Rejected.Width
						                                                                AND Purchased.Length = Rejected.Length
						                                                                JOIN REF_WoodTypes Types
						                                                                  ON Types.WoodTypeID = Purchased.WoodTypeID
						                                                                 JOIN PurchaseDeliveryItems pdi
						                                                                 	ON pdi.WoodTypeID = Purchased.WoodTypeID
						                                                                 	AND pdi.Thickness = Purchased.Thickness
						                                                                 	AND pdi.Width = Purchased.Width
						                                                                 	AND pdi.Length = Purchased.Length
						                                                                  "));
			return $eh ? $eh : [];

	}

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

    public static function getPendingPurchaseOrders(){
    	$pendingPO = DB::select(DB::raw('SELECT PendingPO.PurchaseOrderID AS POID, PendingPO.DateCreated AS DateCreated, S.Name AS SupplierName
										   FROM (SELECT PurchaseOrderID, DateCreated, SupplierID
												   FROM PurchaseOrders
	   											  WHERE PurchaseOrderID NOT IN (SELECT PurchaseOrderID
																				  FROM PurchaseDeliveryReceipts)) PendingPO JOIN Suppliers S
																															  ON PendingPO.SupplierID = S.SupplierID;'));
    	return $pendingPO ? $pendingPO: [];
    }

    public static function getCountProductsNeedProcurement(){
    	/*
		SELECT COUNT(*) AS Amount
		  FROM CompanyInventory
	     WHERE RequestedQuantity > 0;
    	*/
    	$count = DB::table('CompanyInventory')
    			   ->select(DB::raw('COUNT(*) AS count'))
    			   ->where('RequestedQuantity', '>', '0');
    	return $count->first()->count;
    }


    public static function createPurchaseOrder($term, $supplier, $address, $rows){
    	DB::beginTransaction();

    	try{
    		$id = DB::table('PurchaseOrders')
	    			->insertGetId([
	    				'SupplierID' => $supplier,
	    				'Terms' => $term,
	    				'Address' => $address,
	    			]
    		);

	    	foreach($rows as $row){
	    		//POID SupplierID WoodTypeID Thickness Width Length Quantity UnitPrice
	    		$insert = DB::table('PurchaseOrderItems')
	    		  ->insert(['PurchaseOrderID' => $id,
	    		  			'SupplierID' => $supplier, 
	    		  			'WoodTypeID' => $row['woodType'],
	    		  			'Thickness' => $row['thickness'],
	    		  			'Width' => $row['width'],
	    		  			'Length' => $row['length'],
	    		  			'Quantity' => $row['quantity'],
	    		  			'UnitPrice' => $row['unitPrice']]);
	    		  if(!$insert){
	    		  	DB::rollback();
    				return false;
	    		  }
	    	}
    	}catch(\Exception $e){
    		echo $e->getMessage();
    		DB::rollback();
    		return false;
    	}

    	DB::commit();
    	return true;
    }
}
