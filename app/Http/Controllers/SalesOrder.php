<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
	
use App\Category;

use Carbon;

use Illuminate\Support\Facades\DB;



class SalesOrder extends Controller
{

    public function index(){
    	$customer = DB::table('Customers')
    				  ->select('CustomerID','Name')
    				  ->get();
    	$customer = $customer->pluck('Name','CustomerID');
    	$terms = DB::table('REF_Terms')

    			   ->pluck("Terms","Terms");
        $now = Carbon::now()->toDateString();

      
       
    	return view('sales.SOF',
    		['active' => 'sof',
    		 'customers' => $customer,
    		 'terms' => $terms,
             'now' => $now]);
    }

    public function create(Request $request){

    $customer = DB::table('Customers')
    				  ->select('CustomerID','Name')
    				  ->get();
	$customer = $customer->pluck('Name','CustomerID');
	$terms = DB::table('REF_Terms')
			   ->pluck("Terms","Terms");

     $now = Carbon::now()->toDateString();

    

    DB::beginTransaction();
    if(count($request->input('material')) > 0){
        $id = DB::table('SalesOrders')
        		->insertGetId(['DateCreated' => Carbon::now(),
        				 'SalesOrderStatusID' => '1',
        				 'CustomerID' => $request->input('customerName'),
        				 'Terms' => $request->input('terms'),
                         'DeliveryAddress' => $request->input('address')]);

        for($ctr = 0; $ctr< count($request->input('material')); $ctr++){
            try{
    	    DB::table('SalesOrderItems')
    	      ->insert(['SalesOrderID' => $id,
    	      			'Thickness' => $request->input('thickness.'.$ctr),
    	      			'Width' => $request->input('width.'.$ctr),
    	      			'Length' => $request->input('length.'.$ctr),
    	      			'WoodtypeID' => $request->input('material.'.$ctr),
                        'BoardFeet' =>(
                            $request->input('width.'.$ctr)*
                            $request->input('length.'.$ctr)
                            ),
    	      			'Quantity' =>$request->input('qty.'.$ctr)]);
            }
           catch(\Exception $e){
                echo "error";
                DB::rollBack();
            }
        }
    }

    DB::commit();

    
    return view('sales.SOF',
    		['active' => 'sof',
    		 'customers' => $customer,
    		 'terms' => $terms,
              'now' => $now]);
   /* $ctr=0;
    $c =$request->input('qty.'.$ctr);
    print_r($c);	*/
    /*	$inStock = DB::table('CompanyInventory')
    				  ->select('StockQuantity')*/



    }

    public function check(Request $request){
        $customer = DB::table('Customers')
                  ->select('CustomerID','Name')
                  ->get();
        $customer = $customer->pluck('Name','CustomerID');
        $terms = DB::table('REF_Terms')
                   ->pluck("Terms","Terms");

        $now = Carbon::now()->toDateString();


        $width = $request->input('width');
        $length = $request->input('length');
        $thickness = $request->input('thickness');
        $quantity = $request->input('quantity');
        $material = $request->input('material');

        $error = array(count($width));
        $prices = array(count($width));
        $stock = array(count($width));

        for($ctr = 0; $ctr < count($width); $ctr++){
            $temp2 = DB::table('CompanyInventory')
                       ->select('CurrentUnitPrice')
                       ->where([
                        ['Length',intval($length[$ctr])],
                         ['Width',intval($width[$ctr])],
                         ['Thickness',intval($thickness[$ctr])],
                         ['WoodtypeID',intval($material[$ctr])]
                        ])->get();
           $temp3 = DB::table('CompanyInventory')
                       ->select('StockQuantity')
                       ->where([
                        ['Length',intval($length[$ctr])],
                         ['Width',intval($width[$ctr])],
                         ['Thickness',intval($thickness[$ctr])],
                         ['WoodtypeID',intval($material[$ctr])]
                        ])->get();

            if($temp2 <> '[]'){                            
                array_push($error,'X');
                array_push($prices,$temp2);
                array_push($stock,$temp3);

            }else{
                 
                array_push($error,$ctr);
                array_push($prices,' ');
                array_push($stock,' ');
            }

        }
         

        
        /*
        var_dump($width);
        var_dump($length);
        var_dump($thickness);*/
        $temp = true;
        return response()->json(['error' => $error, 'prices' => $prices,'stock' => $stock ]);
                /*return view('sales.SOF',
            ['active' => 'sof',
             'customers' => $customer,
             'terms' => $terms,
              'now' => $now,
              'temp' => $temp,
              'error' => $error,
              'prices' => $prices]);*/

    }

}
