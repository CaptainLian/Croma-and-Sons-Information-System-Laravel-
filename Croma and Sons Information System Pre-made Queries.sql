
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


 SELECT COUNT(*) AS Amount
FROM CompanyInventory
WHERE RequestedQuantity > 0;

SELECT PurchaseOrderID
 FROM PurchaseOrders
WHERE PurchaseOrderID NOT IN (SELECT PurchaseOrderID
							    FROM PurchaseDeliveryReceipts);
                                
SELECT PendingPO.PurchaseOrderID AS POID, PendingPO.DateCreated AS DateCreated, S.Name AS SupplierName
										   FROM (SELECT PurchaseOrderID, DateCreated, SupplierID
												   FROM PurchaseOrders
	   											  WHERE PurchaseOrderID NOT IN (SELECT PurchaseOrderID
																				  FROM PurchaseDeliveryReceipts)) PendingPO JOIN Suppliers S
																															  ON PendingPO.SupplierID = S.SupplierID;
									
							
SELECT SupplierID AS Supplier, WoodTypeID, Thickness, Width, Length, MIN(CurrentPrice) AS CheapestPrice
FROM SupplierPrices
GROUP BY 1, WoodTypeID, Thickness, Width, Length;	



SELECT *
FROM Suppliers;					

SELECT * 
  FROM PurchaseDeliveryReceipts DR JOIN PurchaseDeliveryItems DRI
									 ON DR.PurchaseDeliveryReceiptID = DRI.PurchaseDeliveryReceiptID;
-- Material	Size	Quantity Purchased	Quantity Rejected	Amount Purchased	Amount Rejected

SELECT *
FROM (SELECT *
	   FROM PurchaseOrders
	  WHERE PurchaseOrderID IN (SELECT DISTINCT PurchaseOrderID
								  FROM PurchaseDeliveryItems)) PO JOIN (SELECT *
																		  FROM PurchaseDeliveryItems
																		 WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
																											   FROM PurchaseDeliveryReceipts
																											  WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE()))) DR
																	ON PO.PurchaseOrderID = DR.PurchaseOrderID
;


-- PRODUCT PURCHASE REPORT

-- Weekly
SELECT WoodType, Size, QuantityOrdered, QuantityRejected, TotalQuantity, AmountPurchased, AmountRejected
FROM (SELECT WoodTypeID, CONCAT(Thickness, 'x', Width, 'x', 'Length') AS Size, SUM(Quantity) AS QuantityOrdered, SUM(IFNULL(RejectedQuantity,0)) AS QuantityRejected, SUM(Quantity - IFNULL(RejectedQuantity, 0)) AS TotalQuantity, SUM((Quantity - IFNULL(RejectedQuantity, 0 ))*PurchasedUnitPrice) AS AmountPurchased, SUM(IFNULL(RejectedQuantity, 0)*PurchasedUnitPrice) AS AmountRejected
	    FROM PurchaseDeliveryItems 
	   WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										     FROM PurchaseDeliveryReceipts
										    WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE()))
                                          
     GROUP BY WoodTypeID, Thickness, Width, Length) DR JOIN REF_WoodTypes wt  
														 ON DR.WoodTypeID = wt.WoodTypeID;

SELECT WoodType, Size, QuantityOrdered, QuantityRejected, TotalQuantity, AmountPurchased, AmountRejected
FROM (SELECT WoodTypeID, CONCAT(Thickness, 'x', Width, 'x', 'Length') AS Size, SUM(Quantity) AS QuantityOrdered, SUM(IFNULL(RejectedQuantity,0)) AS QuantityRejected, SUM(Quantity - IFNULL(RejectedQuantity, 0)) AS TotalQuantity, SUM((Quantity - IFNULL(RejectedQuantity, 0 ))*PurchasedUnitPrice) AS AmountPurchased, SUM(IFNULL(RejectedQuantity, 0)*PurchasedUnitPrice) AS AmountRejected
	    FROM PurchaseDeliveryItems 
	   WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										     FROM PurchaseDeliveryReceipts
										    WHERE YEAR(DateDelivered) = YEAR(CURDATE())
											  AND MONTH(DateDelivered) = MONTH(CURDATE()))
                                          
     GROUP BY WoodTypeID, Thickness, Width, Length) DR JOIN REF_WoodTypes wt  
														 ON DR.WoodTypeID = wt.WoodTypeID;

SELECT WoodType, Size, QuantityOrdered, QuantityRejected, TotalQuantity, AmountPurchased, AmountRejected
FROM (SELECT WoodTypeID, CONCAT(Thickness, 'x', Width, 'x', 'Length') AS Size, SUM(Quantity) AS QuantityOrdered, SUM(IFNULL(RejectedQuantity,0)) AS QuantityRejected, SUM(Quantity - IFNULL(RejectedQuantity, 0)) AS TotalQuantity, SUM((Quantity - IFNULL(RejectedQuantity, 0 ))*PurchasedUnitPrice) AS AmountPurchased, SUM(IFNULL(RejectedQuantity, 0)*PurchasedUnitPrice) AS AmountRejected
	    FROM PurchaseDeliveryItems 
	   WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										     FROM PurchaseDeliveryReceipts
										    WHERE YEAR(DateDelivered) = YEAR(CURDATE()))
                                          
     GROUP BY WoodTypeID, Thickness, Width, Length) DR JOIN REF_WoodTypes wt  
														 ON DR.WoodTypeID = wt.WoodTypeID;
                                                         







