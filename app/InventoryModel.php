<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

use \stdClass;

class InventoryModel extends Model{
    public static function getCompanyInventory(){
    	$inventory = DB::table('CompanyInventory')
    				  ->select(DB::raw("REF_WoodTypes.WoodType AS Material,
                                CONCAT(Thickness, 'x', Width, 'x', Length) AS Size,
                                StockQuantity,
                                SafetyStock,
                                IFNULL(ReorderPoint, 0) AS ReorderPoint,
                                EconomicOrderQuantity"))
    				  ->join('REF_WoodTypes', 'CompanyInventory.WoodTypeID', '=', 'REF_WoodTypes.WoodTypeID' );
    				  //join('REF_WoodTypes', 'PurchaseOrderItems.WoodTypeID', '=', 'REF_WoodTypes.WoodTypeID');
    	return $inventory->get();
    }
}
