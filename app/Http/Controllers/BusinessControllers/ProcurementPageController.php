<?php

namespace App\Http\Controllers\BusinessControllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CustomerModel;
use App\ProcurementModel;

use Session;

class ProcurementPageController extends Controller{
    public function viewDashboard(){
        $pendingPurchaseOrderCount = ProcurementModel::getPendingPurchaseOrderCount();
        $countProductNeedProcurement = ProcurementModel::getCountProductsNeedProcurement();

        $data =[
            'pendingPurchaseOrderCount' => $pendingPurchaseOrderCount,
            'countProductNeedProcurement' => $countProductNeedProcurement,

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
        $weeklyQuantity = ProcurementModel::getWeeklyQuantityProductPurchase();

        $data = [
            'weekly' => $weeklyQuantity,
        ];
        return view('procurement.ProductPurchaseReport')->with($data);
    }

    public function viewEncodeDeliveryReceipt(){
        $pendingPO = ProcurementModel::getPendingPurchaseOrders();

        $data = [
            'pendingPO' => $pendingPO,
        ];

        return view('procurement.DeliveryReceiptInitial')->With($data);
    }
}
