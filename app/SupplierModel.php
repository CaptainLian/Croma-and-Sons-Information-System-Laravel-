<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;

use \stdClass;

class SupplierModel extends Model{

    public static function getSuppliers(){
    	$suppliers = DB::table('Suppliers')
    				->select('SupplierID', 'Name', 'Address');
  		return $suppliers->get();
    }

    public static function getSuppliersDetailed(){
    	//Supplier Name     Address     Contact Details     Contact Person  Last Order Date     Total Purchased (current year)
    	$suppliers = DB::table('Suppliers')
    				->select('SupplierID', 'Name', 'Address', 'Landline', 'ContactPerson');
  		return $suppliers->get();
    }

    public static function getSupplierDetails($supplierID){
        $supplier = DB::table('Suppliers')
          ->where('SupplierID', '=', $supplierID);
        return $supplier->first();
    }

    public static function getSupplierPrices(){
        $supplierPrices = DB::table('SupplierPrices')
                            ->select(DB::raw("SupplierID, REF_WoodTypes.WoodType AS Material, Thickness, Width, Length, CONCAT(Thickness, 'x', Width, 'x', Length) AS Size, CurrentPrice"))
                            ->join('REF_WoodTypes', 'SupplierPrices.WoodTypeID', '=', 'REF_WoodTypes.WoodTypeID');

        $suppliers = [];

        foreach($supplierPrices->get() as $supplierPrice){
            
            $price = new stdClass();

            $price->SupplierID = $supplierPrice->SupplierID;
            $price->Thickness = $supplierPrice->Thickness;
            $price->Width = $supplierPrice->Width;
            $price->Length = $supplierPrice->Length;
            $price->Material = $supplierPrice->Material;
            $price->Size = $supplierPrice->Size;
            $price->CurrentPrice = $supplierPrice->CurrentPrice;

            $suppliers[$price->SupplierID][] = $price;
        }

        return $suppliers;
    }   
}
