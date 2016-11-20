<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
class ProcurementModel extends Model{

	public static function getRequestedProducts(){
		/* 
		
		*/

		$eh = DB::select(DB::raw("SELECT wt.WoodType AS Material,  CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, RequestedQuantity
									FROM (SELECT *
											FROM CompanyInventory
											WHERE RequestedQuantity > 0) ci JOIN REF_WoodTypes wt
																			  ON ci.WoodTypeID = wt.WoodTypeID;"));
		return $eh ? $eh : [];
	}

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

	public static function getPurchaseReportWeekly(){
		$eh = DB::select(DB::raw('SELECT dri.PurchaseDeliveryReceiptID AS DeliveryReceipt, s.Name AS Supplier, dr.DateDelivered AS DeliveryDate, dri.PurchasedAmount, dr.Discount, dri.RejectedAmount
  FROM (SELECT PurchaseDeliveryReceiptID, PurchaseOrderID, IFNULL(SUM((Quantity - RejectedQuantity)*PurchasedUnitPrice), 0) AS PurchasedAmount, IFNULL(SUM(RejectedQuantity*PurchasedUnitPrice), 0) AS RejectedAmount
		  FROM PurchaseDeliveryItems
	     WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										       FROM PurchaseDeliveryReceipts
										      WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE()))
	GROUP BY PurchaseDeliveryReceiptID, WoodTypeID, Thickness, Width, Length) dri JOIN PurchaseDeliveryReceipts dr
																					ON dri.PurchaseDeliveryReceiptID = dr.PurchaseDeliveryReceiptID
																				  JOIN PurchaseOrders po
																					ON dr.PurchaseOrderID = po.PurchaseOrderID
																				  JOIN Suppliers s
																					ON s.SupplierID = po.SupplierID;'));
		return $eh ? $eh : [];

	}

	public static function getPurchaseReportMonthly(){
		$eh = DB::select(DB::raw('SELECT dri.PurchaseDeliveryReceiptID AS DeliveryReceipt, s.Name AS Supplier, dr.DateDelivered AS DeliveryDate, dri.PurchasedAmount, dr.Discount, dri.RejectedAmount
  FROM (SELECT PurchaseDeliveryReceiptID, PurchaseOrderID, IFNULL(SUM((Quantity - RejectedQuantity)*PurchasedUnitPrice), 0) AS PurchasedAmount, IFNULL(SUM(RejectedQuantity*PurchasedUnitPrice), 0) AS RejectedAmount
		  FROM PurchaseDeliveryItems
	     WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										       FROM PurchaseDeliveryReceipts
										      WHERE YEAR(DateDelivered) = YEAR(CURDATE())
                                                AND MONTH(DateDelivered) = MONTH(CURDATE()))
	GROUP BY PurchaseDeliveryReceiptID, WoodTypeID, Thickness, Width, Length) dri JOIN PurchaseDeliveryReceipts dr
																					ON dri.PurchaseDeliveryReceiptID = dr.PurchaseDeliveryReceiptID
																				  JOIN PurchaseOrders po
																					ON dr.PurchaseOrderID = po.PurchaseOrderID
																				  JOIN Suppliers s
																					ON s.SupplierID = po.SupplierID;'));
		return $eh ? $eh : [];

	}

	public static function getPurchaseReportYearly(){
		$eh = DB::select(DB::raw('SELECT dri.PurchaseDeliveryReceiptID AS DeliveryReceipt, s.Name AS Supplier, dr.DateDelivered AS DeliveryDate, dri.PurchasedAmount, dr.Discount, dri.RejectedAmount
  FROM (SELECT PurchaseDeliveryReceiptID, PurchaseOrderID, IFNULL(SUM((Quantity - RejectedQuantity)*PurchasedUnitPrice), 0) AS PurchasedAmount, IFNULL(SUM(RejectedQuantity*PurchasedUnitPrice), 0) AS RejectedAmount
		  FROM PurchaseDeliveryItems
	     WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										       FROM PurchaseDeliveryReceipts
										      WHERE YEAR(DateDelivered) = YEAR(CURDATE()))
	GROUP BY PurchaseDeliveryReceiptID, WoodTypeID, Thickness, Width, Length) dri JOIN PurchaseDeliveryReceipts dr
																					ON dri.PurchaseDeliveryReceiptID = dr.PurchaseDeliveryReceiptID
																				  JOIN PurchaseOrders po
																					ON dr.PurchaseOrderID = po.PurchaseOrderID
																				  JOIN Suppliers s
																					ON s.SupplierID = po.SupplierID;;'));
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
																															  ON PendingPO.SupplierID = S.S<!-- page start-->
<div class="row">
	<div class="col-sm-7">
		<section class="panel">
			<header class="panel-heading">
				<h1>Pending Purchase Orders</h1>
			</header>
			<div class="panel-body">
				<div class="adv-table">
					<table class="display table table-bordered table-striped" id="dynamic-table">
						<thead>
							<tr>
								<th>Material</th>
								<th>Size</th>
								<th>Qty</th>
								<th>Safety Stock</th>
								<th>Reorder Part</th>
								<th class="col-sm-1">Procure</th>
							</tr>
						</thead>
						<tbody>
							<tr class="gradeX">
								<td>
									<a href="ProcurementPurchaseOrderSpecific.html">Kin Dry</a>
								</td>
								<td>2x2x10</td>
								<td>15</td>
								<td>4</td>
								<td>10</td>
								<th>
									<a href="ProcurementEncodeSupplierDeliveryReceipt.html"><button type="button" class="btn btn-success"><b>+</b></button></a>
								</th>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
	<div class="col-sm-5">
		<section class="panel">
			<header class="panel-heading">
				<h1>Procurement Requests</h1>
			</header>
			<div class="panel-body">
				<div class="adv-table">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Material</th>
								<th>Size</th>
								<th class="col-sm-4">Qty</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Kin Dry</td>
								<td>2x2x10</td>
								<td>   <input class="form-control" type="text"></td>
							</tr>
							<tr>
								<td>Sun Dry Dry</td>
								<td>2x2x10</td>
								<td>   <input class="form-control" type="text"></td>
							</tr>
							<tr>
								<td>Example Dry</td>
								<td>2x2x10</td>
								<td>   <input class="form-control" type="text"></td>
							</tr>
						</tbody>
					</table>
					<button type="button" class="btn btn-info">Create Procurement Request</button>
				</div>
			</div>
		</section>
	</div>
</div>
<!-- page end-->upplierID;'));
    	return $pendingPO ? $pendingPO: [];
    }

    public static function getProcurementRatio(){
    	/* 
    	SELECT IFNULL(SUM(IFNULL(Quantity, 0) - IFNULL(RejectedQuantity, 0)), 0) AS Accept, IFNULL(SUM(IFNULL(RejectedQuantity, 0)), 0) AS Reject
  FROM PurchaseDeliveryItems dr
 WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
									   FROM PurchaseDeliveryReceipts
									  WHERE MONTH(DateDelivered) = MONTH(CURDATE()));*/

		$eh = DB::table('PurchaseDeliveryItems')
				 ->select(DB::raw('IFNULL(SUM(IFNULL(Quantity, 0) - IFNULL(RejectedQuantity, 0)), 0) AS Accept, IFNULL(SUM(IFNULL(RejectedQuantity, 0)), 0) AS Reject'))

				 ->whereIn('PurchaseDeliveryReceiptID', function($query){
				 	$query->select('PurchaseDeliveryReceiptID')
				 		  ->from('PurchaseDeliveryReceipts')
				 		  ->where(DB::raw('MONTH(DateDelivered)'), '=', DB::raw('MONTH(CURDATE())'));

				 });


    	return $eh->first();
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

    	//$eh = DB::table();
    	
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


    public static function createPurchaseOrder($term, $supplier, $address, $deliveryDate, $discount, $rows){
    	DB::beginTransaction();

    	try{
    		$id = DB::table('PurchaseOrders')
	    			->insertGetId([
	    				'SupplierID' => $supplier,
	    				'Terms' => $term,
	    				'DeliveryAddress' => $address,
	    				'RequestedDeliveryDate' => $deliveryDate,
	    				'Discount' => $discount,
	    			]
    		);

	    	foreach($rows as $row){
	    		//POID SupplierID WoodTypeID Thickness Width Length Quantity UnitPrice
	    		
	    		
				$checkExist = DB::table('SupplierPrices')
								->select(['SupplierID', 'WoodTypeID', 'Thickness', 'Width', 'Length'])
								->where([
										'SupplierID' => $supplier,
										'WoodTypeID' => $row['woodType'],
										'Thickness' => $row['thickness'],
										'Width' => $row['width'],
										'Length' => $row['length'],
									])->first();

				if($checkExist == NULL){
					DB::table('SupplierPrices')
					  ->insert([
					  		'SupplierID' => $supplier,
					  		'WoodTypeID' => $row['woodType'],
							'Thickness' => $row['thickness'],
							'Width' => $row['width'],
							'Length' => $row['length'],
							'CurrentPrice' => $row['unitPrice']
					  	]);
				}else{	
					DB::table('SupplierPrices')
					  ->where([
					  		'SupplierID' => $supplier,
							'WoodTypeID' => $row['woodType'],
							'Thickness' => $row['thickness'],
							'Width' => $row['width'],
							'Length' => $row['length'],
					  	])
					  	->update(['CurrentPrice' => $row['unitPrice']]);
				}

				$insert = DB::table('PurchaseOrderItems')
				    		  ->insert(['PurchaseOrderID' => $id,
				    		  			'SupplierID' => $supplier, 
				    		  			'WoodTypeID' => $row['woodType'],
				    		  			'Thickness' => $row['thickness'],
				    		  			'Width' => $row['width'],
				    		  			'Length' => $row['length'],
				    		  			'Quantity' => $row['quantity'],
				    		  			'UnitPrice' => $row['unitPrice']]);

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


    public static function getPurchaseOrder($id){
    	$PO = DB::table('PurchaseOrders')
    			->where('PurchaseOrderID', '=', $id);

    	return $PO->first();
    }
    
    public static function getPurchaseOrderItems($id){
    	$items = DB::table('PurchaseOrderItems')
    			   ->select(DB::raw("REF_WoodTypes.WoodTypeID AS WoodTypeID, WoodType AS Material, CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, Thickness, Width, Length, Quantity, BoardFeet, UnitPrice, Discount"))
    			   ->where('PurchaseOrderID', '=', $id)
    			   ->join('REF_WoodTypes', 'PurchaseOrderItems.WoodTypeID', '=', 'REF_WoodTypes.WoodTypeID');
    	return $items->get();

    	//# 	Material 	Size 	Unit 	Quantity 	B/F 	Unit Price 	Discount 	Total
    }

    public static function getDeliveryReceipt($id){
    	$DR = DB::table('PurchaseDeliveryReceipts')
    			->select(DB::raw("PurchaseDeliveryReceiptID, DateDelivered, PurchaseDeliveryReceipts.Discount, PurchaseDeliveryReceipts.DeliveryAddress, PurchaseDeliveryReceipts.Comments, PurchaseDeliveryReceipts.PreparedBy, SupplierID"))
    			->where('PurchaseDeliveryReceiptID', '=', $id)
    			->join('PurchaseOrders', 'PurchaseOrders.PurchaseOrderID', '=', 'PurchaseDeliveryReceipts.PurchaseOrderID');
    	return $DR->first();
    }

    public static function getDeliveryReceiptItems($id){
    	$items = DB::table('PurchaseDeliveryItems')
    			   ->select(DB::raw("REF_WoodTypes.WoodTypeID AS WoodTypeID, WoodType AS Material, CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, Thickness, Width, Length, BoardFeet, Quantity, RejectedQuantity, PurchasedUnitPrice"))
    			   ->where('PurchaseDeliveryReceiptID', '=', $id)
    			   ->join('REF_WoodTypes', 'PurchaseDeliveryItems.WoodTypeID', '=', 'REF_WoodTypes.WoodTypeID');
    	return $items->get();

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
    		//echo $e->getMessage();
    		DB::rollback();
    		return false;
    	}

    	DB::commit();
    	return true;
    }

    public static function getMonthlyProcurementOfCurrentYear(){
    	/*
			SELECT MONTHNAME(DateDelivered) AS Month, SUM((Quantity - RejectedQuantity)*PurchasedUnitPrice) AS PurchaseAmount
    FROM PurchaseDeliveryItems di JOIN PurchaseDeliveryReceipts dr
								    ON di.PurchaseDeliveryReceiptID = dr.PurchaseDeliveryReceiptID
GROUP BY 1;
    	*/

		$eh = DB::table('PurchaseDeliveryItems')
				->select(DB::raw("MONTHNAME(DateDelivered) AS Month, SUM((Quantity - RejectedQuantity)*PurchasedUnitPrice) AS PurchaseAmount"))
				->join('PurchaseDeliveryReceipts', 'PurchaseDeliveryItems.PurchaseDeliveryReceiptID' ,'=','PurchaseDeliveryReceipts.PurchaseDeliveryReceiptID')
				->groupBy(DB::raw(1));
		return $eh->get();
    }
}
