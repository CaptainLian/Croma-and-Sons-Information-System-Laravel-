<?php
namespace App\Http\Controllers\BusinessControllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Input as Input;

use \stdClass;

use Redirect;
use Session;

use App\SalesModel;
use App\CustomerModel;
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

    $inputWoodType = Input::get('InputWoodTypeID');
    $inputThickness = Input::get('InputThickness');
    $inputWidth = Input::get('InputWidth');
    $inputLength = Input::get('InputLength');
    $inputQuantity = Input::get('InputQuantity');

    $outputThickness = Input::get('OutputThickness');
    $outputWidth = Input::get('OutputWidth');
    $outputLength = Input::get('OutputLength');
    $outputQuantity = Input::get('OutputQuantity');

    $resizeRows = [];
    $count = 0;
    if(isset($inputWoodType)){
      foreach($inputWoodType as $woodType){
        $resizeRows[$count] = new stdClass();

        $resizeRows[$count]->woodType = $woodType;
        $count++;
      }

      $count = 0;
      foreach($inputThickness as $thickness){
        $resizeRows[$count]->inputThickness = $thickness;
        $count++;
      }

       $count = 0;
      foreach($inputWidth as $width){
        $resizeRows[$count]->inputWidth = $width;
        $count++;
      }

      $count = 0;
      foreach($inputLength as $length){
        $resizeRows[$count]->inputLength = $length;
        $count++;
      }

       $count = 0;
      foreach($inputQuantity as $quantity){
          $resizeRows[$count]->inputQuantity = $quantity;
          $count++;
      }

       $count = 0;
      foreach($outputThickness as $thickness){
        $resizeRows[$count]->outputThickness = $thickness;
        $count++;
      }

      $count = 0;
      foreach($outputWidth as $width){
        $resizeRows[$count]->outputWidth = $width;
        $count++;
      }

      $count = 0;
      foreach($outputLength as $length){
        $resizeRows[$count]->outputLength = $length;
        $count++;
      }

      $count = 0;
      foreach($outputQuantity as $quantity){
        $resizeRows[$count]->output = $quantity;
        $count++;
      }

      InventoryModel::resize($resizeRows);
    }


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


    InventoryModel::approveSalesOrder($salesOrderID, $approvedRows);

    $pendingSalesOrders = SalesModel::getPendingSalesOrders();
    $pendingItems = [];

    foreach($pendingSalesOrders as $salesOrder){
      $salesOrderItems = SalesModel::getSalesOrderItems($salesOrder->SalesOrderID);
      $salesOrder->canAccomodate = TRUE;
      foreach($salesOrderItems as  $item){
            $pendingItem = new stdClass();

            $pendingItem->Material = $item->WoodType;
            $pendingItem->WoodTypeID = $item->WoodTypeID;

            $pendingItem->Size = $item->Size;
            $pendingItem->Thickness = $item->Thickness;
            $pendingItem->Width = $item->Width;
            $pendingItem->Length = $item->Length;

            $pendingItem->Quantity = $item->Quantity;
            $pendingItems[$item->SalesOrderID][] = $pendingItem;
            if($pendingItem->Quantity > InventoryModel::getProductStockQuantity($pendingItem->WoodTypeID,  $pendingItem->Thickness, $pendingItem->Width,  $pendingItem->Length)){
              $salesOrder->canAccomodate = FALSE;
            }

         }
      }

      $data = [
        'pendingSalesOrders' => $pendingSalesOrders,
        'pendingItems' => $pendingItems,
        'success' => '<strong>Success!</strong>&nbsp;Sales order has been approved and resizing is recorded.'
      ];

      return view('inventory.InventoryResizeInitial')->with($data);

    
  }
}
?>
