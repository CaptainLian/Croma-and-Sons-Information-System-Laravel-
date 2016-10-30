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

        $error = array();

        /*for*/

        $temp = true;
        return view('sales.SOF',
            ['active' => 'sof',
             'customers' => $customer,
             'terms' => $terms,
              'now' => $now,
              'temp' => $temp]);

    }

}
