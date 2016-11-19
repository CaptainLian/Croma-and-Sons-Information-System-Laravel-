
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
SELECT *
  FROM PurchaseDeliveryReceipts 
 WHERE MONTH(DateDelivered) = MONTH(CURDATE()); 
 
 
SELECT *
   FROM PurchaseDeliveryItems
  WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										FROM PurchaseDeliveryReceipts
									   WHERE MONTH(DateDelivered) = MONTH(CURDATE()));
       
SELECT IFNULL(SUM(IFNULL(Quantity, 0) - IFNULL(RejectedQuantity, 0)), 0) AS Accept, IFNULL(SUM(IFNULL(RejectedQuantity, 0)), 0) AS Reject
  FROM PurchaseDeliveryItems dr
 WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
									   FROM PurchaseDeliveryReceipts
									  WHERE MONTH(DateDelivered) = MONTH(CURDATE()));


SELECT s.Name, d.Accept, d.Reject
  FROM (SELECT po.SupplierID AS SupplierID, SUM(IFNULL(Quantity, 0) - IFNULL(RejectedQuantity, 0)) AS Accept, SUM(IFNULL(RejectedQuantity, 0)) AS Reject
	      FROM PurchaseDeliveryItems dr JOIN PurchaseOrders po
										  ON dr.PurchaseOrderID = po.PurchaseOrderID
		 WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
											   FROM PurchaseDeliveryReceipts
											  WHERE MONTH(DateDelivered) = MONTH(CURDATE()))
		 GROUP BY po.SupplierID) d JOIN Suppliers s
									ON d.SupplierID = s.SupplierID;

-- Needed products
SELECT *
FROM CompanyInventory
WHERE RequestedQuantity > 0;

SELECT *
  FROM PurchaseDeliveryReceipts
 WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE());
 
SELECT WoodTypeID, CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, IFNULL(SUM((Quantity - RejectedQuantity)*PurchasedUnitPrice), 0) AS PurchasedAmount, IFNULL(SUM(RejectedQuantity*PurchasedUnitPrice), 0) AS RejectedAmount
  FROM PurchaseDeliveryItems
 WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
									  FROM PurchaseDeliveryReceipts
								     WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE()))
GROUP BY WoodTypeID, Thickness, Width, Length;


-- Purchase Report
-- Weekly
SELECT dri.PurchaseDeliveryReceiptID AS DeliveryReceipt, s.Name AS Supplier, dr.DateDelivered AS DeliveryDate, dri.PurchasedAmount, dr.Discount, dri.RejectedAmount
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
																					ON s.SupplierID = po.SupplierID;

-- Purchase Report
-- Monthly
SELECT dri.PurchaseDeliveryReceiptID AS DeliveryReceipt, s.Name AS Supplier, dr.DateDelivered AS DeliveryDate, dri.PurchasedAmount, dr.Discount, dri.RejectedAmount
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
																					ON s.SupplierID = po.SupplierID;
-- Purchase Report
-- Yearly
SELECT dri.PurchaseDeliveryReceiptID AS DeliveryReceipt, s.Name AS Supplier, dr.DateDelivered AS DeliveryDate, dri.PurchasedAmount, dr.Discount, dri.RejectedAmount
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
																					ON s.SupplierID = po.SupplierID;
                                                                                    
                                                                                    
SELECT CONCAT(YEAR('2016-01-01'), '-', MONTHNAME('2016-01-01'), '-', DAY('2016-01-01'));


SELECT *
FROM CompanyInventory
WHERE RequestedQuantity > 0;
