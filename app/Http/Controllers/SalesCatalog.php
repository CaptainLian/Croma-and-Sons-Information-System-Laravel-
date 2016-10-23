<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Illuminate\Support\Facades\DB;

class SalesCatalog extends Controller
{
   public function index(){
   		$catalog = DB::table('CompanyInventory')
   					 ->select('WoodType','Thickness','Width','Length','CurrentUnitPrice')
   					 ->join('REF_WoodTypes','CompanyInventory.WoodTypeID','=','REF_WoodTypes.WoodTypeID')
   					 ->where('StockQuantity','>','0')
   					 ->get();
   		 

   		return view('sales.SC',
   			['active' => 'sc',
   			 'catalog' => $catalog]);
   }
}
