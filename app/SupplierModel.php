<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
class SupplierModel extends Model{

    public static function getSuppliers(){
    	$customers = DB::table('Suppliers')
    				->select('SupplierID', 'Name', 'Address');
  		return $customers->get();
    }

    public static function getSuppliersDetailed(){
    	//Supplier Name     Address     Contact Details     Contact Person  Last Order Date     Total Purchased (current year)
    	$customers = DB::table('Suppliers')
    				->select('SupplierID', 'Name', 'Address', 'Landline', 'ContactPerson');
  		return $customers->get();

    }
}
