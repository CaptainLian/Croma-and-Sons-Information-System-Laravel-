-- Check if Sales Order is still pending
SELECT COUNT(SalesInvoiceID) AS 'Amount' 
  FROM SalesInvoice
 WHERE SalesDeliveryReceiptID IN (SELECT SalesDeliveryReceiptID
									FROM SalesDeliveryReceipts
								   WHERE SalesOrderID = 1);
                                   
                                   
SELECT * FROM cromadb.purchaserequests;


SELECT COUNT(RequisitionID)
 FROM PurchaseRequests
WHERE RequisitionID NOT IN (SELECT RequisitionID
							FROM PurchaseOrders);
                            
SELECT COUNT(RequisitionID)
  FROM PurchaseRequests
 WHERE RequisitionID IN (SELECT RequisitionID
						   FROM PurchaseOrders);

SELECT COUNT(PurchaseOrderID)
 FROM PurchaseOrders
WHERE PurchaseOrderID NOT IN (SELECT PurchaseOrderID
							    FROM PurchaseDeliveryReceipts);