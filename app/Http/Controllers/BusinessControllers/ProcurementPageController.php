<?php

namespace App\Http\Controllers\BusinessControllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CustomerModel;
use App\ProcurementModel;
use App\SupplierModel;
use \stdClass;

use Illuminate\Support\Facades\Validator as Validator;
use Illuminate\Support\Facades\Session as Session;
use Illuminate\Support\Facades\View as View;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Redirect as Redirect;

class ProcurementPageController extends Controller{
    const PURCHASE_ORDER_SELECT_PRODUCT_RULES = ['products' => 'required'];
    const PURCHASE_ORDER_SELECT_PRODUCT_MESSSAGES = ['products.required' => 'Please select a product before proceeding.'];

    public function viewDashboard(){
        /* Retrieve information */
        $pendingPurchaseOrderCount = ProcurementModel::getPendingPurchaseOrderCount();
        $countProductNeedProcurement = ProcurementModel::getCountProductsNeedProcurement();
        $procurementRatio = ProcurementModel::getProcurementRatio();
        $procurementRatioSuppliers = ProcurementModel::getProcurementRatioSuppliers();
        $monthlyProcurement = ProcurementModel::getMonthlyProcurementOfCurrentYear();

        /* Process information */
        $procurementRatioSuppliersAccept = [];
        $procurementRatioSuppliersReject = [];

        foreach($procurementRatioSuppliers as $supplier){
            $procurementRatioSuppliersAccept[] = [$supplier->Name, $supplier->Accept];
            $procurementRatioSuppliersReject[] = [$supplier->Name, $supplier->Reject];
        }

        $monthlyExpense = [
          'January' => 0,
          'February' => 0,
          'March' => 0,
          'April' => 0,
          'May' => 0,
          'June' => 0,
          'July' => 0,
          'August' => 0,
          'September' => 0,
          'October' => 0,
          'November' => 0,
          'December' => 0,
        ];

        foreach($monthlyProcurement AS $month){
            $monthlyExpense[$month->Month] = $month->PurchaseAmount;
        }

        $data = [
            'pendingPurchaseOrderCount' => $pendingPurchaseOrderCount,
            'countProductNeedProcurement' => $countProductNeedProcurement,
            'procurementRatio' => $procurementRatio,
            'procurementRatioSuppliersAccept' => $procurementRatioSuppliersAccept,
            'procurementRatioSuppliersReject' => $procurementRatioSuppliersReject,
            'monthlyExpense' => $monthlyExpense,
        ];

        /* Send information */
    	return view('procurement.dashboard')->with($data);
    }


    public function viewCreatePurchaseOrder(){
      $leastReject = ProcurementModel::getLeastRejectPerProductBySupplier();

      $data = [
        'leastReject' => $leastReject,
      ];

      return view('procurement.PurchaseOrderSelect')->with($data);
    }

    public function viewFormPurchaseOrder(){
      $input = Input::all();

      $validator = Validator::make($input, ProcurementPageController::PURCHASE_ORDER_SELECT_PRODUCT_RULES, ProcurementPageController::PURCHASE_ORDER_SELECT_PRODUCT_MESSSAGES);

      if($validator->fails()){
  			return Redirect::back()
  						   ->withErrors($validator)
  						   ->withInput();
  		}

      $suppliers = SupplierModel::getSuppliers();
      $terms = CustomerModel::getTerms();
      $requestedProducts = ProcurementModel::getRequestedProducts();

      $data = [
        'suppliers' => $suppliers,
        'terms' => $terms,
        'productRequests' => $requestedProducts,

      ];

        if($input != NULL){
          $products = $input['products'];

          $requests = [];

          foreach ($products  as $product) {
            $parse = explode(',' , $product);
            $parseSize = explode('x', $parse[1]);

            $parseProduct = new stdClass();
            $parseProduct->WoodTypeID = (int)$parse[0];
            $parseProduct->Thickness = (float)$parseSize[0];
            $parseProduct->Width = (float)$parseSize[1];
            $parseProduct->Length = (float)$parseSize[2];
            $parseProduct->RequestedQuantity = (int)$parse[2];
            $parseProduct->SupplierID = (int)$parse[3];

            $requests[] = $parseProduct;
          }

          $data['requestedProducts'] = $requests;
        }




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

        $pendingPODetails = [];

        foreach($pendingPO as $po){
            $PODetail = ProcurementModel::getPurchaseOrder($po->POID);

            $pendingPODetails[$po->POID] = new stdClass();
            $pendingPODetails[$po->POID]->Terms = $PODetail->Terms;
            $pendingPODetails[$po->POID]->DeliveryAddress = $PODetail->DeliveryAddress;
            $pendingPODetails[$po->POID]->RequestedDeliveryDate = $PODetail->RequestedDeliveryDate;
            $pendingPODetails[$po->POID]->DateCreated = $PODetail->DateCreated;
            $pendingPODetails[$po->POID]->Discount = $PODetail->Discount;

            $supplierDetail = SupplierModel::getSupplierDetails($PODetail->SupplierID);
            $pendingPODetails[$po->POID]->SupplierName = $supplierDetail->Name;
            $pendingPODetails[$po->POID]->SupplierAddress = $supplierDetail->Address;
            $pendingPODetails[$po->POID]->Landline = $supplierDetail->Landline;

            $POItems = ProcurementModel::getPurchaseOrderItems($po->POID);

             $pendingPODetails[$po->POID]->items = [];

            foreach($POItems as $item){
                 $pendingPODetails[$po->POID]->items[] = $item;
            }
        }

        $data = [
            'pendingPO' => $pendingPO,
            'pendingPODetails' => $pendingPODetails,
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

    public function viewDeliveryReceiptSpecificInputless($id){
        $deliveryReceiptDetails = ProcurementModel::getDeliveryReceipt($id);
       // print_r($deliveryReceiptDetails);
        $deliveryReceiptItems = ProcurementModel::getDeliveryReceiptItems($id);
        $supplierDetails = SupplierModel::getSupplierDetails($deliveryReceiptDetails->SupplierID);

        //var_dump($supplierDetails);


        $data = [
            'deliveryReceiptDetails' => $deliveryReceiptDetails,
            'deliveryReceiptItems' => $deliveryReceiptItems,
            'supplierDetails' => $supplierDetails,
        ];

        return view('procurement.DeliveryReceiptSpecificInputless ')->with($data);
    }

    public function viewSupplierList(){
        $suppliers = SupplierModel::getSuppliersDetailed();
        $supplierPrices = SupplierModel::getSupplierPrices();

        //print_r($supplierPrices);
        $data =[
            'suppliers' => $suppliers,
            'supplierPrices' => $supplierPrices,
        ];

        return view('procurement.SupplierList')->with($data);
    }

    public function viewPurchaseList(){
    	return view('procurement.PurchaseList');
    }

    public function viewPurchaseReport(){
        $weeklyPurchase = ProcurementModel::getPurchaseReportWeekly();
        $monthlyPurchase = ProcurementModel::getPurchaseReportMonthly();
        $yearlyPurchase = ProcurementModel::getPurchaseReportYearly();

        $data = [
            'weekly' => $weeklyPurchase,
            'monthly' => $monthlyPurchase,
            'yearly' => $yearlyPurchase,
        ];

        return view('procurement.PurchaseReport')->with($data);
    }
}
