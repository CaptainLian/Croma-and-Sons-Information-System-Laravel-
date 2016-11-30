<?php
namespace App\Http\Controllers\BusinessControllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input as Input;

use \stdClass;

use Redirect;
use Session;

use App\InventoryModel;

class InventoryFormController extends Controller{
  function requestProcurement(Request $request){
    $woodTypeID = Input::get('woodTypeID');
    $thickness = Input::get('thickness');
    $width = Input::get('width');
    $length = Input::get('length');
    $quantity = Input::get('quantity');

    $status = InventoryModel::requestProcurement($woodTypeID, $thickness, $width, $length, $quantity);

    return $status ? 1 : 0 ;
  }

  function testAjax(){

    $status = InventoryModel::requestProcurement(1, 0.5 , 1.0, 1.0, 1);
    return $status ? 1 : 0 ;

  }
}
?>
