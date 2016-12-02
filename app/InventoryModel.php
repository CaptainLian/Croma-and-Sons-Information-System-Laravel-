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
}
