<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
class CustomerModel extends Model{

	/**
	*/
    public static function getCustomers(){
    	$customers = DB::table('Customers')
    				->select('CustomerID', 'Name', 'Address')->get();
  		return $customers;
    }

    public static function getTerms(){
    	$terms = DB::table('REF_Terms')->get();
    	return $terms;
    }
}
