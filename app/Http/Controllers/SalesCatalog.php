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
   					 ->where('StatusID','1')
   					 ->get();
   		 

   		return view('sales.SC',
   			['active' => 'sc',
   			 'catalog' => $catalog]);
   }

   public function add(Request $request){
      $item = $request->input('json');

       /*DB::beginTransaction();*/
      $wood = DB::table('REF_WoodTypes')
                 ->select('WoodTypeID')
                 ->where('WoodType',$item[0])
                 ->pluck('WoodTypeID');
      if($wood <> '[]'){
         $var = DB::table('CompanyInventory')
                  ->insert([
                  'WoodTypeID' => $wood[0],
                  'Thickness' => $item[1],
                  'Width' => $item[2],
                  'Length' => $item[3],
                  'CurrentUnitPrice' => $item[4]]);
         if($var){
            echo 'Success';
         }else{
            echo 'Failed';
         }
      }else{

      }

      


       /*DB::commit();*/

   }
   public function edit(Request $request){
      $item = $request->input('json');

       /*DB::beginTransaction();*/
      $wood = DB::table('REF_WoodTypes')
                 ->select('WoodTypeID')
                 ->where('WoodType',$item[0])
                 ->pluck('WoodTypeID');
      $update = DB::table('CompanyInventory')                 
                 ->where([
                          ['WoodTypeID',$wood],
                          ['Thickness',$item[1]],
                          ['Width',$item[2]],
                          ['Length',$item[3]]
                          ])
                 ->update(['CurrentUnitPrice' => $item[4]]);
       if($update){
            echo 'Success';
         }else{
            echo 'Failed';
         }          
      

      


       /*DB::commit();*/

   }
   public function delete(Request $request){
      $item = $request->input('json');

       /*DB::beginTransaction();*/
      $wood = DB::table('REF_WoodTypes')
                 ->select('WoodTypeID')
                 ->where('WoodType',$item[0])
                 ->pluck('WoodTypeID');
      
     try{ 
        $update = DB::table('CompanyInventory')                 
                  ->where([
                           ['WoodTypeID',$wood],
                           ['Thickness',$item[1]],
                           ['Width',$item[2]],
                           ['Length',$item[3]]
                           ])
                  ->update(['StatusId'=>'2']);
        if($update){
             echo 'Success';
          }else{
             echo 'Failed';
          }  
        }catch(\Exception $e){
          echo 'Foreign Key!';
        }        
      

      


       /*DB::commit();*/

   }
}
