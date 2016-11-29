<?php

namespace App\Http\Controllers\BusinessControllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\SalesModel;
use App\CustomerModel;
use App\InventoryModel;

class InventoryPageController extends Controller
{
    public function viewDashboard(){

    	$pendingSalesOrders = SalesModel::getPendingSalesOrders();

    	$data = [
    		'pendingSalesOrders' => $pendingSalesOrders,
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

    public function view(){
    	$data = [

    	];
		//return view('inventory.')->with($data);
	}

    /*
		public function view(){

		}

    */
}
