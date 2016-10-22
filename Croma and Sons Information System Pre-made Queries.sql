
-- Pending Purchase Orders
SELECT COUNT(PurchaseOrderID)
 FROM PurchaseOrders
WHERE PurchaseOrderID NOT IN (SELECT PurchaseOrderID
							    FROM PurchaseDeliveryReceipts);
                                
-- current week (starting with Sunday) 
SELECT 
 COUNT(*) AS rows  
 FROM PurchaseOrders  
 WHERE YEARWEEK(DateCreated) = YEARWEEK(CURRENT_DATE) ;
 
 
 -- Purchase Delivery Receipts created within the week
 SELECT *
 FROM PurchaseDeliveryReceipts
 WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE());
 

-- Puchased Quantity     CONCAT(Thickness, 'x', Width, 'x', Length)                                                            
SELECT WoodTypeID, Thickness, width, Length, SUM(Quantity) AS PurchaseQuantity, SUM(Quantity)*PurchasedUnitPrice AS PurchaseAmount
  FROM PurchaseDeliveryItems
 WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
									   FROM PurchaseDeliveryReceipts
                                       WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE()))
GROUP BY WoodTypeID, Thickness, Width, Length;

-- Rejected Quantity     CONCAT(Thickness, 'x', Width, 'x', Length)                                                            
SELECT WoodTypeID, Thickness, width, Length, SUM(Quantity) AS RejectedQuantity
  FROM PurchaseRejects
 WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
									   FROM PurchaseDeliveryReceipts
                                       WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE()))
GROUP BY WoodTypeID, Thickness, Width, Length;

-- JOIN 
SELECT Types.WoodType AS Material, CONCAT(Purchased.Thickness, 'x', Purchased.Width, 'x', Purchased.Length) AS Size, 
	   Purchased.PurchasedQuantity AS PurchasedQuantity, 
	   Rejected.RejectedQuantity AS RejectedQuantity, 
       Purchased.PurchasedQuantity*Purchased.PurchasedUnitPrice AS PurchasedAmount, 
       Rejected.RejectedQuantity*Purchased.PurchasedUnitPrice AS RejectedAmount 
FROM (SELECT WoodTypeID, Thickness, width, Length, SUM(Quantity) AS PurchasedQuantity, PurchasedUnitPrice
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
                                                                  ON Types.WoodTypeID = Purchased.WoodTypeID;


 