<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

use \stdClass;

class InventoryModel extends Model{
    public static function getCompanyInventory(){
    	$inventory = DB::table('CompanyInventory')
    				  ->select(DB::raw("REF_WoodTypes.WoodType AS Material,
                                CompanyInventory.WoodTypeID,
                                Thickness,
                                Width,
                                Length,
                                CONCAT(Thickness, 'x', Width, 'x', Length) AS Size,
                                StockQuantity,
                                SafetyStock,
                                IFNULL(ReorderPoint, 0) AS ReorderPoint,
                                EconomicOrderQuantity,
                                RequestedQuantity"))
    				  ->join('REF_WoodTypes', 'CompanyInventory.WoodTypeID', '=', 'REF_WoodTypes.WoodTypeID' );
    				  //join('REF_WoodTypes', 'PurchaseOrderItems.WoodTypeID', '=', 'REF_WoodTypes.WoodTypeID');
    	return $inventory->get();
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
      $products = DB::table('CompanyInventory')
                    ->select(DB::raw("CompanyInventory.WoodTypeID,
                                      REF_WoodTypes.WoodType AS Material,
                                      CONCAT(Thickness, 'x', Width, 'x', Length) AS Size,
                                      StockQuantity,
                                      ReorderPoint,
                                      SafetyStock"))

                    ->orWhere([
                      ['StockQuantity', '<=', 'SafetStock'],
                      ['StockQuantity', '<=', 'ReorderPoint']
                    ])
                    ->join('REF_WoodTypes', 'REF_WoodTypes.WoodTypeID', '=', 'CompanyInventory.WoodTypeID')
                    ->orderBy('StockQuantity', 'ASC')
                    ->limit(5);
      return $products->get();
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
} 
