<?php

namespace App\Http\Controllers\BusinessControllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CustomerModel;
use App\ProcurementModel;
use App\SupplierModel;

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


    public function viewCreatePurchaseOrder(){

    	$suppliers = SupplierModel::getSuppliers();
    	$terms = CustomerModel::getTerms();

    	$data = [
    		'suppliers' => $suppliers,
    		'terms' => $terms,
    	];
    	return view('procurement.CreatePurchaseOrder')->with($data);
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

    public function viewPurchaseOrderSpecific($id){
        echo "PO: $id";
    }

    public function viewDeliveryReceiptSpecific($id){
        echo "DR: $id";
    }

    public function viewSupplierList(){
        $suppliers = SupplierModel::getSuppliersDetailed();

        $data =[
            'suppliers' => $suppliers,
        ];

        return view('procurement.SupplierList')->with($data);

    }
}
