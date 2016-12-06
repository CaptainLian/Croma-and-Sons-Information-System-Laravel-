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

  function editInventory(Request $request){
    $woodTypeID = Input::get('woodTypeID');
    $thickness = Input::get('thickness');
    $width = Input::get('width');
    $length = Input::get('length');

    $reasonID = Input::get('reasonID');
    $newQuantity = Input::get('newQuantity');
    $comments = Input::get('comments');

    $status = InventoryModel::editInventory($woodTypeID, $thickness, $width, $length, $reasonID, $newQuantity, $comments);

    return $status ? 1 : 0;
  }

  function testAjax(){
    $status = InventoryModel::editInventory(1, 0.5, 1, 1, 7, 32, 'ASDASDSADSADSA');
    return $status ? 1 : 0 ;

  }

  function inputResize(Request $request){
    $salesOrderID = Input::get('salesOrderID');
    // approvals
    $approvedWoodType = Input::get('ApprovedWoodTypeID');
    $approvedThickness = Input::get('ApprovedThickness');
    $approvedWidth = Input::get('ApprovedWidth');
    $approvedLength = Input::get('ApprovedLength');
    $approvedQuantity = Input::get('ApprovedQuantity');

    $approvedRows = [];

    $count = 0;
    foreach($approvedWoodType as $woodType){
      $approvedRows[$count] = new stdClass();
      $approvedRows[$count]->WoodTypeID = $woodType;
      $count++;
    }

    $count = 0;
    foreach($approvedThickness as $thickness){
      $approvedRows[$count]->Thickness = $thickness;
      $count++;
    }

    $count = 0;
    foreach($approvedWidth as $width){
      $approvedRows[$count]->Width = $width;
      $count++;
    }

    $count = 0;
    foreach($approvedLength as $length){
      $approvedRows[$count]->Length = $length;
      $count++;
    }

    $count = 0;
    foreach($approvedQuantity as $quantity){
      $approvedRows[$count]->Quantity = $quantity;
      $count++;
    }




  }
}
?>
