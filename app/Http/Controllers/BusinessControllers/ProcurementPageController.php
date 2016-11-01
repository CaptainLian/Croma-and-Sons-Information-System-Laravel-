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
        $procurementRatio = ProcurementModel::getProcurementRatio();
        $procurementRatioSuppliers = ProcurementModel::getProcurementRatioSuppliers();

        $procurementRatioSuppliersAccept = [];
        $procurementRatioSuppliersReject = [];

       

        foreach($procurementRatioSuppliers as $supplier){
            $procurementRatioSuppliersAccept[] = [$supplier->Name, $supplier->Accept];
            $procurementRatioSuppliersReject[] = [$supplier->Name, $supplier->Reject];
        }

        $data =[
            'pendingPurchaseOrderCount' => $pendingPurchaseOrderCount,
            'countProductNeedProcurement' => $countProductNeedProcurement,
            'procurementRatio' => $procurementRatio,
            'procurementRatioSuppliersAccept' => $procurementRatioSuppliersAccept,
            'procurementRatioSuppliersReject' => $procurementRatioSuppliersReject,
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
        $monthlyQuantity = ProcurementModel::getMonthlyQuantityProductPurchase();
        $yearlyQuantity = ProcurementModel::getYearlyQuantityProductPurchase();

        $data = [
            'weekly' => $weeklyQuantity,
            'monthly' => $monthlyQuantity,
           	'yearly' => $yearlyQuantity,

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
        $purchaseOrderDetails = ProcurementModel::getPurchaseOrder($id);
        $purchaseOrderItems = ProcurementModel::getPurchaseOrderItems($id);
        $supplierDetails = SupplierModel::getSupplierDetails($purchaseOrderDetails->SupplierID);


        $data = [
        	'purchaseOrderDetails' => $purchaseOrderDetails,
        	'supplierDetails' => $supplierDetails,
        	'purchaseOrderItems' => $purchaseOrderItems, 
        ];

        return view('procurement.PurchaseOrderSpecific')->with($data);
    }

    public function viewDeliveryReceiptSpecific($id){
        $purchaseOrderDetails = ProcurementModel::getPurchaseOrder($id);
        $purchaseOrderItems = ProcurementModel::getPurchaseOrderItems($id);
        $supplierDetails = SupplierModel::getSupplierDetails($purchaseOrderDetails->SupplierID);


        $data = [
            'purchaseOrderDetails' => $purchaseOrderDetails,
            'supplierDetails' => $supplierDetails,
            'purchaseOrderItems' => $purchaseOrderItems, 
        ];
        return view('procurement.DeliveryReceiptSpecific')->with($data);
    }

    public function viewSupplierList(){
        $suppliers = SupplierModel::getSuppliersDetailed();

        $data =[
            'suppliers' => $suppliers,
        ];

        return view('procurement.SupplierList')->with($data);

    }

    public function viewPurchaseList(){
    	return view('procurement.PurchaseList');
    }

    public function viewPurchaseReport(){
        return view('procurement.PurchaseReport');
    }
}
