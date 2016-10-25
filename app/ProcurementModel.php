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
						                                                                 	AND pdi.Length = Purchased.Length;"));
			return $eh ? $eh : [];

	}

	public static function getMonthlyQuantityProductPurchase(){
		$eh = DB::select(DB::raw("SELECT Types.WoodType AS Material, 
	   CONCAT(Purchased.Thickness, 'x', Purchased.Width, 'x', Purchased.Length) AS Size, 
	   Purchased.PurchasedQuantity - Rejected.RejectedQuantity AS PurchasedQuantity, 
	   Rejected.RejectedQuantity AS RejectedQuantity,
	   (Purchased.PurchasedQuantity - Rejected.RejectedQuantity)*pdi.PurchasedUnitPrice AS PurchasedAmount,
	   Rejected.RejectedQuantity*pdi.PurchasedUnitPrice AS RejectedAmount
FROM (SELECT WoodTypeID, Thickness, width, Length, SUM(Quantity) AS PurchasedQuantity
		FROM PurchaseDeliveryItems
	   WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
											 FROM PurchaseDeliveryReceipts
											WHERE YEAR(DateDelivered) = YEAR(CURDATE())
											  AND MONTH(DateDelivered) = MONTH(CURDATE()))
	  GROUP BY WoodTypeID, Thickness, Width, Length) Purchased JOIN (SELECT WoodTypeID, Thickness, width, Length, SUM(Quantity) AS RejectedQuantity
																	   FROM PurchaseRejects
																	  WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
																										   FROM PurchaseDeliveryReceipts
																										  WHERE YEAR(DateDelivered) = YEAR(CURDATE())
																											AND MONTH(DateDelivered) = MONTH(CURDATE()))
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
																AND pdi.Length = Purchased.Length;"));
		return $eh ? $eh : [];
	}

	public static function getYearlyQuantityProductPurchase(){ 
		$eh = DB::select(DB::raw("SELECT Types.WoodType AS Material, 
	   CONCAT(Purchased.Thickness, 'x', Purchased.Width, 'x', Purchased.Length) AS Size, 
	   Purchased.PurchasedQuantity - Rejected.RejectedQuantity AS PurchasedQuantity, 
	   Rejected.RejectedQuantity AS RejectedQuantity,
	   (Purchased.PurchasedQuantity - Rejected.RejectedQuantity)*pdi.PurchasedUnitPrice AS PurchasedAmount,
	   Rejected.RejectedQuantity*pdi.PurchasedUnitPrice AS RejectedAmount
FROM (SELECT WoodTypeID, Thickness, width, Length, SUM(Quantity) AS PurchasedQuantity
		FROM PurchaseDeliveryItems
	   WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
											 FROM PurchaseDeliveryReceipts
											WHERE YEAR(DateDelivered) = YEAR(CURDATE()))
	  GROUP BY WoodTypeID, Thickness, Width, Length) Purchased JOIN (SELECT WoodTypeID, Thickness, width, Length, SUM(Quantity) AS RejectedQuantity
																	   FROM PurchaseRejects
																	  WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
																										   FROM PurchaseDeliveryReceipts
																										  WHERE YEAR(DateDelivered) = YEAR(CURDATE()))
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
																AND pdi.Length = Purchased.Length;"));
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


    public static function createPurchaseOrder($term, $supplier, $address, $deliveryDate, $rows){
    	DB::beginTransaction();

    	try{
    		$id = DB::table('PurchaseOrders')
	    			->insertGetId([
	    				'SupplierID' => $supplier,
	    				'Terms' => $term,
	    				'DeliveryAddress' => $address,
	    				'RequestedDeliveryDate' => $deliveryDate,
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
				    		  			'UnitPrice' => $row['unitPrice'],
				    		  			'Discount' => $row['discount']]);
	    	}
    	}catch(\Exception $e){
    		//echo '<script> console.log('.$e->getMessage().')</script>';
    		//echo 'FAILED DUE TO EXCEPTION';
    		//echo $e->getMessage();
    		DB::rollback();
    		return false;
    	}

    	DB::commit();
    	return true;
    }


    public static function getPurchaseOrder($id){
    	$PO = DB::table('PurchaseOrders')
    			->where('PurchaseOrderID', '=', $id);

    	return $PO->first();
    }

    public static function getPurchaseOrderItems($id){
    	$items = DB::table('PurchaseOrderItems')
    			   ->select(DB::raw("REF_WoodTypes.WoodTypeID AS WoodTypeID, WoodType AS Material, CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, Thickness, Length, Width, Quantity, BoardFeet, UnitPrice, Discount"))
    			   ->where('PurchaseOrderID', '=', $id)
    			   ->join('REF_WoodTypes', 'PurchaseOrderItems.WoodTypeID', '=', 'REF_WoodTypes.WoodTypeID');
    	return $items->get();

    	//# 	Material 	Size 	Unit 	Quantity 	B/F 	Unit Price 	Discount 	Total
    }

    public static function createDeliveryReceipt($purchaseOrderID, $term, $deliveryAddress, $deliveryDate, $rows){
    	DB::beginTransaction();

    	try{
    		$id = DB::table('PurchaseDeliveryReceipts')
	    			->insertGetId([
	    				'PurchaseOrderID' => $purchaseOrderID,
	    				'DateDelivered' => $deliveryDate,
	    				'DeliveryAddress' => $deliveryAddress,
	    			]
    		);

	    	foreach($rows as $row){
	    		//POID SupplierID WoodTypeID Thickness Width Length Quantity UnitPrice
	    		$insert = DB::table('PurchaseDeliveryItems')
				    		  ->insert([
				    		  			'PurchaseDeliveryReceiptID' => $id,
				    		  			'PurchaseOrderID' => $purchaseOrderID,
				    		  			'WoodTypeID' => $row['woodType'],
				    		  			'Thickness' => $row['thickness'],
				    		  			'Width' => $row['width'],
				    		  			'Length' => $row['length'],
				    		  			'Quantity' => $row['quantityReceived'],
				    		  			'RejectedQuantity' => $row['quantityRejected'],
				    		  			'PurchasedUnitPrice' => $row['unitPrice'],
				    		  			'Discount' => $row['discount']]);
	    	}
    	}catch(\Exception $e){
    		//echo '<script> console.log('.$e->getMessage().')</script>';
    		//echo 'FAILED DUE TO EXCEPTION';
    		echo $e->getMessage();
    		DB::rollback();
    		return false;
    	}

    	DB::commit();
    	return true;
    }

}
