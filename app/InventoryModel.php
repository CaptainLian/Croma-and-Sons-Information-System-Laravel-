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
      $aguy = DB::table('CompanyInventory')
        ->where([
            ['WoodTypeID', '=', $woodTypeID],
            ['Thickness', '=', $thickness],
            ['Width', '=', $width],
            ['Length', '=', $length],
         ])
         ->increment('RequestedQuantity', $quantity);
      return $aguy;
    }
}
