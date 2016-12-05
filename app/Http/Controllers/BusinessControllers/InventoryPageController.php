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

    public function viewResize(){

    	$data = [

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
      $pendingSalesOrders = InventoryModel::getPendingSalesOrder();

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
