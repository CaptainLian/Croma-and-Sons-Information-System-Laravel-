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
              ->orderBy('Name','asc')
              ->where('StatusID','1')
    				  ->get();
    	$customer = $customer->pluck('Name','CustomerID');
      $customer = array('null' => 'Please Select Customer') + $customer->toArray();

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

    $outcomeMessage = ' ';
    $stringInput = 0;
    $width =$request->input('width');
    $thickness = $request->input('thickness');
    $length = $request->input('length');
    $qty = $request->input('qty');
     $outcome = 0;

    if(count($width)>0){
      foreach($width as $key){

        if(!is_numeric($key)){
          $stringInput = 1;
        }
      }

      foreach($thickness as $key){

        if(!is_numeric($key) ){
          $stringInput = 1;
        }
      }
      foreach($length as $key){

        if(!is_numeric($key)){
          $stringInput = 1;
        }
      }
      foreach($qty as $key){

        if(!is_numeric($key)){
          $stringInput = 1;
        }
      }
    }

    $customerNumber = -2;
   
      if($request->input('customerName') == 'null' && $request->input('customerName1') <> '' && $request->input('customer-delivery-address') <> '' && $request->input('delivery-address') <> '' ){
        $customerNumber = DB::table('Customers')
                            ->insertGetId([
                              'Name' => $request->input('customerName1'),
                              'Address' =>$request->input('customer-delivery-address')
                              ]);



      }else if ($request->input('customerName') <> "null"){
        $customerNumber = $request->input('customerName');
      } 
     
      
      $pd;
      DB::beginTransaction();
      try{
        // echo  $request->input('delivery-address');
        $id = DB::table('SalesOrders')
                ->insertGetId(['DateCreated' => Carbon::now(),
                     'SalesOrderStatusID' => '1',
                     'CustomerID' => $customerNumber,
                     'Terms' => $request->input('terms'),
                    'DeliveryAddress' => $request->input('delivery-address')
                      ]);
                $pd = 1;
                DB::rollBack();

      }catch(\Exception $e){
        $pd = -1;
        DB::rollBack();
      }


        $customer = DB::table('Customers')
              ->select('CustomerID','Name')
              ->orderBy('Name','asc')
              ->where('StatusID','1')
              ->get();
      	$customer = $customer->pluck('Name','CustomerID');
        $customer = array('null' => 'Please Select Customer') + $customer->toArray();


    	$terms = DB::table('REF_Terms')
    			   ->pluck("Terms","Terms");

       $now = Carbon::now()->toDateString();

      $result = 0;
      $outcome = 0;
      
      DB::beginTransaction();
      if($customerNumber != -2){
        if($customerNumber <> -1 && $pd <> -1 && $stringInput ==0 && !empty($width )){

          if(count($request->input('material')) > 0){
              $id = DB::table('SalesOrders')
              		->insertGetId(['DateCreated' => Carbon::now(),
              				 'SalesOrderStatusID' => '1',
              				 'CustomerID' => $customerNumber,
              				 'Terms' => $request->input('terms'),
                               'DeliveryAddress' => $request->input('delivery-address'),
                        'Discount' => ($request->input('discount')/100)]);


              for($ctr = 0; $ctr< count($request->input('material')); $ctr++){
                  try{

                    $enough =   DB::table('CompanyInventory')
                                ->select('StockQuantity')
                                ->where([
                               'Thickness' => $request->input('thickness.'.$ctr),
                              'Width' => $request->input('width.'.$ctr),
                              'Length' => $request->input('length.'.$ctr),
                              'WoodtypeID' => $request->input('material.'.$ctr)
                                  ])->pluck('StockQuantity');
                    /*echo $enough[0];
                    echo $request->input('qty.'.$ctr);*/

                    // FOR QUANTITY CHECKING
                    // if( $enough[0] >= $request->input('qty.'.$ctr)
                    //   ){
                    // END FOR QUANTITY CHECKING
                       $insert = DB::table('SalesOrderItems')
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
                      $newQuantity = $enough[0] - $request->input('qty.'.$ctr);
                      // $update = DB::table('CompanyInventory')
                      //             ->where([
                      //            ['Thickness','=',$request->input('thickness.'.$ctr)],
                      //           ['Width','=', $request->input('width.'.$ctr)],
                      //           ['Length','=', $request->input('length.'.$ctr)],
                      //           ['WoodtypeID','=', $request->input('material.'.$ctr)]
                      //               ])
                      //             ->update(['StockQuantity'=> $newQuantity]);



                      if($insert){
                      $outcome = 1;
                      }
                      else{
                        $outcome = 0;
                      DB::rollBack();
                       $outcomeMessage .= 'Listed item is not offered in sales catalog! ';
                      }
                    // FOR QUANTITY CHECKING
                    // }
                    // else{
                    //    $ctr += count($request->input('material'));
                    //   $outcomeMessage .= 'The amount of material you entered cannot be accomodated! <br>';
                    //   $outcome = 0;
                    //   DB::rollBack();
                    // }
                    // END FOR QUANTITY CHECKING

                  }
                  catch(\Exception $e){
                   /* echo $e;  */
                    $ctr += count($request->input('material'));
                    $outcomeMessage .= 'Listed item is not offered in sales catalog! <br>';
                    $outcome = 0;
                    DB::rollBack();
                  }




              }
          }
          else if(count($request->input('material')) == 0){
            $outcomeMessage .= 'No material!<br>';
            $outcome = 0;
                    DB::rollBack();

          }
        }else if($customerNumber == -1){
           $outcomeMessage .= 'Two Customers!';
           $outcome = 0;
          DB::rollBack();
        }

        DB::commit();
        if($outcome == 1){
          $sdr = DB::table('SalesDeliveryReceipts')
                   ->insert([
                      'SalesOrderID' => $id,
                      'DRStatusID' => 1,
                      'DateCreated' => $now,
                      'DeliveryAddress' => $request->input('address')
                    ]);
          if($sdr){
          
          }
        }

        
      }
      else{
        if(($request->input('customerName1')) == "") 
          $outcomeMessage .= 'Customer Name has not been set! <br>';
        if(($request->input('customer-delivery-address')) == "")
            $outcomeMessage .= 'Customer Address has not been set! <br>';
        if(($request->input('delivery-address')) == "")
            $outcomeMessage .= 'Delivery Address has not been set! <br>';
      }
    return view('sales.SOF',
    		['active' => 'sof',
    		 'customers' => $customer,
    		 'terms' => $terms,
         'now' => $now,
         'outcome' => $outcome,
         'outcomeMessage' => $outcomeMessage]);
   /* $ctr=0;
    $c =$request->input('qty.'.$ctr);
    print_r($c);	*/
    /*	$inStock = DB::table('CompanyInventory')
    				  ->select('StockQuantity')*/



    }

    public function check(Request $request){

       $customer = DB::table('Customers')
              ->select('CustomerID','Name')
              ->orderBy('Name','asc')
              ->where('StatusID','1')
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
                        ['Length',floatval($length[$ctr])],
                         ['Width',floatval($width[$ctr])],
                         ['Thickness',floatval($thickness[$ctr])],
                         ['WoodtypeID',floatval($material[$ctr])]
                        ])->get();
           $temp3 = DB::table('CompanyInventory')
                       ->select('StockQuantity')
                       ->where([
                        ['Length',floatval($length[$ctr])],
                         ['Width',floatval($width[$ctr])],
                         ['Thickness',floatval($thickness[$ctr])],
                         ['WoodtypeID',floatval($material[$ctr])]
                        ])->get();

            if($temp2 <> '[]'){
                array_push($error,'X');
                array_push($prices,$temp2);
                array_push($stock,$temp3);

            }else{

                array_push($error,$ctr);
                array_push($prices,' ');
                array_push($stock,'-1');
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
    public function change(Request $request){
      $address = DB::table('Customers')
                   ->where('CustomerID',$request->input('id'))
                   ->pluck('Address');
        echo $address[0];
    }

}
