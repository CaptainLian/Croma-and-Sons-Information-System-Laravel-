
SELECT *
	FROM PurchaseDeliveryItems DRI JOIN PurchaseDeliveryReceipts DR
									  ON DRI.PurchaseDeliveryReceiptID = DR.PurchaseDeliveryReceiptID;
    
-- PRODUCT PURCHASE REPORT

SELECT  WoodTypeID, CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, SUM(Quantity) AS QuantityDelivered, SUM(RejectedQuantity) AS QuantityRejected, SUM(Quantity - RejectedQuantity) AS TotalQuantity, SUM(RejectedQuantity*PurchasedUnitPrice) AS AmountRejected, SUM((Quantity - RejectedQuantity)*PurchasedUnitPrice) AS AmountPurchased
  FROM PurchaseDeliveryItems
GROUP BY WoodTypeID, Thickness, Width, Length;

SELECT * 
FROM PurchaseDeliveryItems
WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										     FROM PurchaseDeliveryReceipts
										    WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE()));
                     

SELECT  WoodTypeID, CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, SUM(Quantity) AS QuantityDelivered, SUM(RejectedQuantity) AS QuantityRejected, SUM(Quantity - RejectedQuantity) AS TotalQuantity, SUM(RejectedQuantity*PurchasedUnitPrice) AS AmountRejected, SUM((Quantity - RejectedQuantity)*PurchasedUnitPrice) AS AmountPurchased
  FROM PurchaseDeliveryItems
WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										     FROM PurchaseDeliveryReceipts
										    WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE()))
GROUP BY WoodTypeID, Thickness, Width, Length;

SELECT *
  FROM (SELECT  WoodTypeID, CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, SUM(Quantity) AS QuantityDelivered, SUM(RejectedQuantity) AS QuantityRejected, SUM(Quantity - RejectedQuantity) AS TotalQuantity, SUM(RejectedQuantity*PurchasedUnitPrice) AS AmountRejected, SUM((Quantity - RejectedQuantity)*PurchasedUnitPrice) AS AmountPurchased
		  FROM PurchaseDeliveryItems
		WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										      FROM PurchaseDeliveryReceipts
										      WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE()))
GROUP BY WoodTypeID, Thickness, Width, Length) DR;

-- Weekly
SELECT WoodType, Size, QuantityOrdered, QuantityRejected, TotalQuantity, AmountPurchased, AmountRejected
FROM (SELECT WoodTypeID, CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, SUM(Quantity) AS QuantityOrdered, SUM(IFNULL(RejectedQuantity,0)) AS QuantityRejected, SUM(Quantity - IFNULL(RejectedQuantity, 0)) AS TotalQuantity, SUM((Quantity - IFNULL(RejectedQuantity, 0 ))*PurchasedUnitPrice) AS AmountPurchased, SUM(IFNULL(RejectedQuantity, 0)*PurchasedUnitPrice) AS AmountRejected
	    FROM PurchaseDeliveryItems 
	   WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										     FROM PurchaseDeliveryReceipts
										    WHERE YEARWEEK(DateDelivered) = YEARWEEK(CURDATE()))
                                          
     GROUP BY WoodTypeID, Thickness, Width, Length) DR JOIN REF_WoodTypes wt  
														 ON DR.WoodTypeID = wt.WoodTypeID;

SELECT WoodType, Size, QuantityOrdered, QuantityRejected, TotalQuantity, AmountPurchased, AmountRejected
FROM (SELECT WoodTypeID, CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, SUM(Quantity) AS QuantityOrdered, SUM(IFNULL(RejectedQuantity,0)) AS QuantityRejected, SUM(Quantity - IFNULL(RejectedQuantity, 0)) AS TotalQuantity, SUM((Quantity - IFNULL(RejectedQuantity, 0 ))*PurchasedUnitPrice) AS AmountPurchased, SUM(IFNULL(RejectedQuantity, 0)*PurchasedUnitPrice) AS AmountRejected
	    FROM PurchaseDeliveryItems 
	   WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										     FROM PurchaseDeliveryReceipts
										    WHERE YEAR(DateDelivered) = YEAR(CURDATE())
											  AND MONTH(DateDelivered) = MONTH(CURDATE()))
                                          
     GROUP BY WoodTypeID, Thickness, Width, Length) DR JOIN REF_WoodTypes wt  
														 ON DR.WoodTypeID = wt.WoodTypeID;

SELECT WoodType, Size, QuantityOrdered, QuantityRejected, TotalQuantity, AmountPurchased, AmountRejected
FROM (SELECT WoodTypeID, CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, SUM(Quantity) AS QuantityOrdered, SUM(IFNULL(RejectedQuantity,0)) AS QuantityRejected, SUM(Quantity - IFNULL(RejectedQuantity, 0)) AS TotalQuantity, SUM((Quantity - IFNULL(RejectedQuantity, 0 ))*PurchasedUnitPrice) AS AmountPurchased, SUM(IFNULL(RejectedQuantity, 0)*PurchasedUnitPrice) AS AmountRejected
	    FROM PurchaseDeliveryItems 
	   WHERE PurchaseDeliveryReceiptID IN (SELECT PurchaseDeliveryReceiptID
										     FROM PurchaseDeliveryReceipts
										    WHERE YEAR(DateDelivered) = YEAR(CURDATE()))
                                          
     GROUP BY WoodTypeID, Thickness, Width, Length) DR JOIN REF_WoodTypes wt  
														 ON DR.WoodTypeID = wt.WoodTypeID;
                                                         

  SELECT MONTHNAME(DateDelivered) AS Month, SUM((Quantity - RejectedQuantity)*PurchasedUnitPrice) AS PurchaseAmount
    FROM PurchaseDeliveryItems di JOIN PurchaseDeliveryReceipts dr
								    ON di.PurchaseDeliveryReceiptID = dr.PurchaseDeliveryReceiptID
GROUP BY 1
ORDER BY 1;

SELECT DISTINCT MONTHNAME(DateDelivered)
FROM PurchaseDeliveryReceipts;
                                                