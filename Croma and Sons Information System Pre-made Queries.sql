-- Check if Sales Order is still pending
SELECT COUNT(SalesInvoiceID) AS 'Amount' 
  FROM SalesInvoice
 WHERE SalesDeliveryReceiptID IN (SELECT SalesDeliveryReceiptID
									FROM SalesDeliveryReceipts
								   WHERE SalesOrderID = 1);
                                   
                                   
SELECT * FROM cromadb.purchaserequests;


-- Pending Purchase Requests
SELECT COUNT(RequisitionID)
 FROM PurchaseRequests
WHERE RequisitionID NOT IN (SELECT RequisitionID
							FROM PurchaseOrders);
                            
SELECT COUNT(RequisitionID)
  FROM PurchaseRequests
 WHERE RequisitionID IN (SELECT RequisitionID
						   FROM PurchaseOrders);

-- Pending Purchase Orders
SELECT COUNT(PurchaseOrderID)
 FROM PurchaseOrders
WHERE PurchaseOrderID NOT IN (SELECT PurchaseOrderID
							    FROM PurchaseDeliveryReceipts);

-- current week (starting with Sunday) 
SELECT 
 COUNT(*) AS rows  
 FROM PurchaseOrders  
 WHERE YEARWEEK(DateCreated) = YEARWEEK(CURRENT_DATE) 