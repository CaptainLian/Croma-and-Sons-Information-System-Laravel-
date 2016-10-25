<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
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
}
