<?php

namespace App\Http\Controllers\BusinessControllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SalesModel;
use App\CustomerModel;
use App\InventoryModel;

use \stdClass;

class InventoryPageController extends Controller
{
    public function viewDashboard(){
      $products = InventoryModel::getProductsRequireAttention();

      $materials = [];
      $stockQuantities = [];
      $reorderPoints = [];
      $safetyStocks = [];

      foreach($products AS $product){
        $material = new stdClass();

        $material->Size = $product->Size;
        $material->StockQuantity = $product->StockQuantity;
        $material->ReorderPoint = $product->ReorderPoint;
        $material->SafetyStock = $product->SafetyStock;

        $materials[$product->Material][] = $material;
      }

      foreach($materials AS $material){
        foreach($material AS $size){
          $stockQuantities[] = $size->StockQuantity;
          $reorderPoints[] = $size->ReorderPoint;
          $safetyStocks[] = $size->SafetyStock;
        }
      }

    	$data = [
        'materials' => $materials,
        'stockQuantities' => $stockQuantities,
        'reorderPoints' => $reorderPoints,
        'safetyStocks' => $safetyStocks,
        'productCount' => $products->count(),
    	];

    	return view ('inventory.dashboard')->with($data);
    }

    public function viewInventoryList(){
    	$inventory = InventoryModel::getCompanyInventory();

    	$data= [
    		'inventory' => $inventory,
    	];

    	return view('inventory.InventoryList')->with($data);
    }

    public function viewResizeInitial(){
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
    	];

		  return view('inventory.InventoryResizeInitial')->with($data);
    }

    public function viewResize($salesOrderID){
      $salesOrderItems = SalesModel::getSalesOrderItems($salesOrderID);
      $inventory = InventoryModel::getCompanyInventory();
      $data = [
        'orderItems' => $salesOrderItems,
        'inventory' => $inventory,
        'salesOrderID' => $salesOrderID
      ];
      
      return view('inventory.InventoryResize')->with($data);
    }

    public function viewInventoryEdit(){
    	$inventory = InventoryModel::getCompanyInventory();

		  $data = [
			     'inventory' => $inventory
    	];

		    return view('inventory.InventoryEdit')->with($data);
    }

    public function viewApproveSalesOrder(){
      $pendingSalesOrders = SalesModel::getPendingSalesOrders();

      $items = [];

      foreach($pendingSalesOrders as $salesOrder){
            $salesOrderItems = SalesModel::getSalesOrderItems($salesOrder->SalesOrderID);
            foreach($salesOrderItems as $item){

            }
      }
      $data = [
        'pendingSalesOrders' => $pendingSalesOrders,
    	];

      return view('inventory.ApproveSalesOrder')->with($data);

    }

    public function view(){
    	$data = [

    	];
		  //return view('inventory.ApproveSalesOrder')->with($data);
	}

    /*
		public function view(){

		}

    */
}
