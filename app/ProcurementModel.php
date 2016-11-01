<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
class ProcurementModel extends Model{

	public static function getWeeklyQuantityProductPurchase(){
		// Material Size QuantityOrdered, Quantity Rejected , Total Quantity, Ampunt Purchased, Ampount Rejected
		$eh = DB::select(DB::raw("SELECT WoodType AS Material, Size, QuantityOrdered, QuantityRejected, TotalQuantity, AmountPurchased, AmountRejected
									FROM (SELECT WoodTypeID, 
												CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, 
												SUM(Quantity) AS QuantityOrdered, SUM(IFNULL(RejectedQuantity,0)) AS QuantityRejected, 
												SUM(Quantity - IFNULL(RejectedQuantity, 0)) AS TotalQuantity, 
												SUM((Quantity - IFNULL(RejectedQuantity, 0 ))*PurchasedUnitPrice) AS AmountPurchased, 
												SUM(IFNULL(RejectedQuantity, 0)*PurchasedUnitPrice) AS AmountRejected
	    							FROM PurchaseDeliveryItems 
	  							   WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										     							 FROM PurchaseDeliveryReceipts
										    							WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE()))
                                          
     																 GROUP BY WoodTypeID, Thickness, Width, Length) DR JOIN REF_WoodTypes wt  
														 				   ON DR.WoodTypeID = wt.WoodTypeID"));
			return $eh ? $eh : [];
	}

	public static function getMonthlyQuantityProductPurchase(){
		$eh = DB::select(DB::raw("SELECT 
										WoodType AS Material, 
										Size, 
										QuantityOrdered, 
										QuantityRejected, 
										TotalQuantity, 
										AmountPurchased, 
										AmountRejected
									FROM (SELECT 
												WoodTypeID, 
												CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, 
												SUM(Quantity) AS QuantityOrdered, 
												SUM(IFNULL(RejectedQuantity,0)) AS QuantityRejected, 
												SUM(Quantity - IFNULL(RejectedQuantity, 0)) AS TotalQuantity, 
												SUM((Quantity - IFNULL(RejectedQuantity, 0 ))*PurchasedUnitPrice) AS AmountPurchased, 
												SUM(IFNULL(RejectedQuantity, 0)*PurchasedUnitPrice) AS AmountRejected
	    									FROM PurchaseDeliveryItems 
	   									   WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										     									 FROM PurchaseDeliveryReceipts
										   										WHERE YEAR(DateDelivered) = YEAR(CURDATE())
											  									AND MONTH(DateDelivered) = MONTH(CURDATE()))
                                          
     							GROUP BY WoodTypeID, Thickness, Width, Length) DR JOIN REF_WoodTypes wt  
														 							ON DR.WoodTypeID = wt.WoodTypeID;"));

		return $eh ? $eh : [];
	}

	public static function getYearlyQuantityProductPurchase(){ 
		$eh = DB::select(DB::raw("SELECT WoodType AS Material, Size, QuantityOrdered, QuantityRejected, TotalQuantity, AmountPurchased, AmountRejected
FROM (SELECT WoodTypeID, CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, SUM(Quantity) AS QuantityOrdered, SUM(IFNULL(RejectedQuantity,0)) AS QuantityRejected, SUM(Quantity - IFNULL(RejectedQuantity, 0)) AS TotalQuantity, SUM((Quantity - IFNULL(RejectedQuantity, 0 ))*PurchasedUnitPrice) AS AmountPurchased, SUM(IFNULL(RejectedQuantity, 0)*PurchasedUnitPrice) AS AmountRejected
	    FROM PurchaseDeliveryItems 
	   WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										     FROM PurchaseDeliveryReceipts
										    WHERE YEAR(DateDelivered) = YEAR(CURDATE()))
                                          
     GROUP BY WoodTypeID, Thickness, Width, Length) DR JOIN REF_WoodTypes wt  
														 ON DR.WoodTypeID = wt.WoodTypeID;"));

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

    public static function getProcurementRatio(){
    	$eh = DB::select("SELECT IFNULL(SUM(IFNULL(Quantity, 0) - IFNULL(RejectedQuantity, 0)), 0) AS Accept, IFNULL(SUM(IFNULL(RejectedQuantity, 0)), 0) AS Reject
  FROM PurchaseDeliveryItems dr
 WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
									   FROM PurchaseDeliveryReceipts
									  WHERE MONTH(DateDelivered) = MONTH(CURDATE()));");

    	return $eh[0];
    }

    public static function getProcurementRatioSuppliers(){
    	$eh = DB::select("SELECT s.Name, d.Accept, d.Reject
  FROM (SELECT po.SupplierID AS SupplierID, SUM(IFNULL(Quantity, 0) - IFNULL(RejectedQuantity, 0)) AS Accept, SUM(IFNULL(RejectedQuantity, 0)) AS Reject
	      FROM PurchaseDeliveryItems dr JOIN PurchaseOrders po
										  ON dr.PurchaseOrderID = po.PurchaseOrderID
		 WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
											   FROM PurchaseDeliveryReceipts
											  WHERE MONTH(DateDelivered) = MONTH(CURDATE()))
		 GROUP BY po.SupplierID) d JOIN Suppliers s
									ON d.SupplierID = s.SupplierID;");
    	
    	return $eh ? $eh : [];
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
