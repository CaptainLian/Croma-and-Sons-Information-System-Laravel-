<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use DB;
class CustomerModel extends Model{

    public static function getTerms(){
    	$terms = DB::table('REF_Terms')->get();
    	return $terms;
    }
}
