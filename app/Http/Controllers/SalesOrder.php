<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;

class SalesOrder extends Controller
{
    public function index(){
    	return view('sales.SOF');
    }

    public function create(Request $request){

    /*	$inStock = DB::table('CompanyInventory')
    				  ->select('StockQuantity')*/
			 
    }

}
