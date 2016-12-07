<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

use \stdClass;

class InventoryModel extends Model{
    public static function getCompanyInventory(){
    	$inventory = DB::select(DB::raw("SELECT  
                                        wt.WoodType AS Material, 
                                        ci.WoodTypeID,
                                        ci.Thickness, 
                                        ci.Width,
                                        ci.Length, 
                                        CONCAT(ci.WoodTypeID, 'x', ci.Thickness, 'x', ci.Length) AS Size, 
                                        ci.StockQuantity, 
                                        ci.RequestedQuantity,
                                        TRUNCATE(IFNULL(rp.ReorderPoint, 0), 0) AS ReorderPoint,
                                        ci.LatestDateUpdated
                                      FROM CompanyInventory ci LEFT JOIN (SELECT ac.WoodTypeID, ac.Thickness, ac.Width, ac.Length, ac.AverageConsumption, mc.MaxConsumption, (ac.AverageConsumption)*2 + (mc.MaxConsumption + ac.AverageConsumption)*2 AS ReorderPoint
                                                                            FROM (SELECT WoodTypeID, Thickness, Width, Length, SUM(FromStockQuantity - ToStockQuantity)/90 AS AverageConsumption
                                                                                    FROM AUDIT_CompanyStockChanges
                                                                                   WHERE ReasonID = 1
                                                                                     AND YEAR(DateChanged) = YEAR(CURRENT_TIMESTAMP) - 1
                                                                                     AND QUARTER(DateChanged) = QUARTER(CURRENT_TIMESTAMP)
                                                                                GROUP BY 1, 2, 3, 4) ac JOIN (SELECT WoodTypeID, Thickness, Width, Length, MAX(FromStockQuantity - ToStockQuantity) AS MaxConsumption
                                                                                                                FROM AUDIT_CompanyStockChanges
                                                                                                               WHERE ReasonID = 1
                                                                                                                 AND YEAR(DateChanged) = YEAR(CURRENT_TIMESTAMP) - 1
                                                                                                                 AND QUARTER(DateChanged) = QUARTER(CURRENT_TIMESTAMP)
                                                                                                            GROUP BY 1, 2, 3, 4)  mc
                                                                                                  ON ac.WoodTypeID = mc.WoodTypeID
                                                                                                 AND ac.Thickness = mc.Thickness
                                                                                                 AND ac.Width = mc.Width
                                                                                                 AND ac.Length = mc.Length) rp
                                                                       ON ci.WoodTypeID = rp.WoodTypeID
                                                                                    AND ci.Thickness = rp.Thickness
                                                                                    AND ci.Width = rp.Width
                                                                                    AND ci.Length = rp.Length
                                                                       JOIN REF_WoodTypes wt
                                                                                     ON ci.WoodTypeID = wt.WoodTypeID;"));
    	return $inventory ? $inventory : [];
    }

    public static function requestProcurement($woodTypeID, $thickness, $width, $length, $quantity){
      $aguy = DB::table('AUDIT_ProcurementRequests')
                ->insert([
                  'WoodTypeID' => $woodTypeID,
                  'Thickness' => $thickness,
                  'Width' => $width,
                  'Length' => $length,
                  'Quantity' => $quantity
                ]);
      return $aguy;
    }

    public static function getProductsRequireAttention(){
      $products = DB::select(DB::raw(" SELECT  
                                        wt.WoodType AS Material, 
                                        ci.WoodTypeID,
                                        ci.Thickness, 
                                        ci.Width,
                                        ci.Length, 
                                        CONCAT(ci.WoodTypeID, 'x', ci.Thickness, 'x', ci.Length) AS Size, 
                                        ci.StockQuantity, 
                                        TRUNCATE(IFNULL(rp.ReorderPoint, 0), 0) AS ReorderPoint, 
                                        ci.LatestDateUpdated
                                      FROM CompanyInventory ci LEFT JOIN (SELECT ac.WoodTypeID, ac.Thickness, ac.Width, ac.Length, ac.AverageConsumption, mc.MaxConsumption, (ac.AverageConsumption)*2 + (mc.MaxConsumption + ac.AverageConsumption)*2 AS ReorderPoint
                                                                            FROM (SELECT WoodTypeID, Thickness, Width, Length, SUM(FromStockQuantity - ToStockQuantity)/90 AS AverageConsumption
                                                                                    FROM AUDIT_CompanyStockChanges
                                                                                   WHERE ReasonID = 1
                                                                                     AND YEAR(DateChanged) = YEAR(CURRENT_TIMESTAMP) - 1
                                                                                     AND QUARTER(DateChanged) = QUARTER(CURRENT_TIMESTAMP)
                                                                                GROUP BY 1, 2, 3, 4) ac JOIN (SELECT WoodTypeID, Thickness, Width, Length, MAX(FromStockQuantity - ToStockQuantity) AS MaxConsumption
                                                                                                                FROM AUDIT_CompanyStockChanges
                                                                                                               WHERE ReasonID = 1
                                                                                                                 AND YEAR(DateChanged) = YEAR(CURRENT_TIMESTAMP) - 1
                                                                                                                 AND QUARTER(DateChanged) = QUARTER(CURRENT_TIMESTAMP)
                                                                                                            GROUP BY 1, 2, 3, 4)  mc
                                                                                                  ON ac.WoodTypeID = mc.WoodTypeID
                                                                                                 AND ac.Thickness = mc.Thickness
                                                                                                 AND ac.Width = mc.Width
                                                                                                 AND ac.Length = mc.Length) rp
                                                                               ON ci.WoodTypeID = rp.WoodTypeID
                                                                                            AND ci.Thickness = rp.Thickness
                                                                                            AND ci.Width = rp.Width
                                                                                            AND ci.Length = rp.Length
                                                                               JOIN REF_WoodTypes wt
                                                                                             ON ci.WoodTypeID = wt.WoodTypeID
                                    WHERE ci.StockQuantity <= IFNULL(rp.ReorderPoint + rp.ReorderPoint*.2, 0.0)
                                    LIMIT 5;"));
      return $products ? $products: [];
    }

    public static function editInventory($woodTypeID, $thickness, $width, $length, $reasonID, $newQuantity, $comments){
      $status = DB::table('AUDIT_CompanyStockChanges')
                  ->insert([
                    'WoodTypeID' => $woodTypeID,
                    'Thickness' => $thickness,
                    'Width' => $width,
                    'Length' => $length,
                    'ReasonID' => $reasonID,
                    'ToStockQuantity' => $newQuantity,
                    'Comments' => $comments
                  ]);
      return $status;
    }

    public static function getProductStockQuantity($woodTypeID, $thickness, $width, $length){
      $quantity = DB::table('CompanyInventory')
                    ->select('StockQuantity')
                    ->where([
                      ['WoodTypeID', '=', $woodTypeID],
                      ['Thickness', '=', $thickness],
                      ['Width', '=',$width],
                      ['Length', '=', $length]
                    ]);
        return $quantity->first()->StockQuantity;
    }

    public static function approveSalesOrder($salesOrderID, $approvedStocks){
      try{
        DB::beginTransaction();
        $drid = DB::table('SalesDeliveryReceipts')
                  ->select('SalesDeliveryReceiptID')
                  ->where('SalesOrderID', '=', $salesOrderID)->first()->SalesDeliveryReceiptID;

        DB::table('SalesDeliveryReceipts')
          ->where('SalesDeliveryReceiptID', '=', $drid)
          ->update(['DRStatusID' => 2]);

        DB::table('SalesOrders')
          ->where('SalesOrderID', '=', $salesOrderID)
          ->update(['SalesOrderStatusID' => 2]);


        foreach($approvedStocks as $stock){
          DB::table('SalesDeliveryItems')
            ->where([ 
                ['SalesDeliveryReceiptID', '=', $drid],
                ['WoodTypeID', '=' , $stock->WoodTypeID],
                ['Thickness', '=', $stock->Thickness],
                ['Width', '=', $stock->Width],
                ['Length', '=', $stock->Length],
              ])
            ->update(['Quantity' => $stock->Quantity]);

            DB::table('SalesOrderItems')
            ->where([ 
                ['SalesOrderID', '=', $salesOrderID],
                ['WoodTypeID', '=' , $stock->WoodTypeID],
                ['Thickness', '=', $stock->Thickness],
                ['Width', '=', $stock->Width],
                ['Length', '=', $stock->Length],
              ])
            ->update(['Quantity' => $stock->Quantity]);
        } 

        DB::commit();
      }catch(\Exception $e){
        DB::rollback();
        die($e->getMessage());
        return false;
      }
      
    }

    public static function resize($resizeRows){
      try{
        DB::beginTransaction();

        foreach ($resizeRows as $resize) {
          DB::table('AUDIT_Resizes')
            ->insert([
                'WoodTypeID' => $resize->woodType,
                'InputThickness' => $resize->inputThickness,
                'InputWidth' => $resize->inputWidth,
                'InputLength' => $resize->inputLength,
                'InputQuantity' => $resize->inputQuantity,

                'OutputThickness' => $resize->outputThickness,
                'OutputWidth' => $resize->outputWidth,
                'OutputLength' => $resize->outputLength,
                'OutputQuantity' => $resize->outputQuantity
              ]);
        }
        DB::commit();
      }catch(\Exception $e){
        DB::rollback();
        die($e->getMessage());
        return false;
      }

      
    }

    public static function getPendingSalesOrderCount(){
      $count = DB::table('SalesOrders')
                ->where('SalesOrderStatusID', '=', 1);

      return $count->count();
    }
} 
