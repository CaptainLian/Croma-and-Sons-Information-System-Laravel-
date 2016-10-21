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
		if($eh){	
			return $eh;
		}

		return [];
	}
}
