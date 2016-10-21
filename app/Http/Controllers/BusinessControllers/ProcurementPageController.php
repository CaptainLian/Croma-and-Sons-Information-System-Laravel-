<?php

namespace App\Http\Controllers\BusinessControllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CustomerModel;
use App\DashboardModel;

use Session;

class ProcurementPageController extends Controller{
    public function viewDashboard(){

        $pendingPurchaseRequestCount = DashboardModel::getPendingPurchaseRequestCount();

        $pendingPurchaseOrderCount = DashboardModel::getPendingPurchaseOrderCount();
        $data =[
            'pendingPurchaseRequestCount' => $pendingPurchaseRequestCount,
            'pendingPurchaseOrderCount' => $pendingPurchaseOrderCount,
        ];
    	return view('procurement.dashboard')->with($data);
    }


    public function viewPurchaseOrder(){

    	$customers = CustomerModel::getCustomers();
    	$terms = CustomerModel::getTerms();

    	$data = [
    		'customers' => $customers,
    		'terms' => $terms,
    	];


    	return view('procurement.PurchaseOrder')->with($data);
    }

    public function viewProductPurchaseReport(){

        return view('procurement.ProductPurchaseReport');
    }
}
