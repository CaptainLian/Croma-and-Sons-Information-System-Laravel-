<?php

namespace App\Http\Controllers\BusinessControllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ProcurementModel;
use App\SupplierModel;
use App\CustomerModel;

use Illuminate\Support\Facades\Input as Input;
use Redirect;
use Session;
use \stdClass;

class ProcurementFormController extends Controller{


    public function inputPurchaseOrder(Request $request){
    	//$term, $supplier, $address, $woodTypes, $thicknesses, $widths, $lengths, $quantities, $unitPrices, $discounts

    	$term = Input::get('terms');
    	$supplier = Input::get('supplier');
    	$address = Input::get('address');
      $deliveryDate = Input::get('deliveryDate');

      $discount = ((float)Input::get('discount'));
    	//table rows
    	$woodTypes = Input::get('WoodType');
    	$thicknesses = Input::get('Thickness');
    	$widths = Input::get('Width');
    	$lengths = Input::get('Length');
    	$quantities = Input::get('Quantity');
    	$unitPrices = Input::get('UnitPrice');

    	$rows = [];

    	foreach($woodTypes as $woodType){
    		$rows[] = ['woodType' => $woodType];
    	}

    	$count = 0;
    	foreach($thicknesses as $thickness){
    		$rows[$count]['thickness'] = $thickness;

    		$count++;
    	}

    	$count = 0;
    	foreach($widths as $width){
    		$rows[$count]['width'] = $width;

    		$count++;
    	}

    	$count = 0;
    	foreach($lengths as $length){
    		$rows[$count]['length'] = $length;

    		$count++;
    	}

    	$count = 0;
    	foreach($quantities as $quantity){
    		$rows[$count]['quantity'] = $quantity;

    		$count++;
    	}

    	$count = 0;
    	foreach($unitPrices as $UnitPrice){
    		$rows[$count]['unitPrice'] = $UnitPrice;

    		$count++;
    	}

    	$count = 0;
    	foreach($quantities as $quantity){
    		$rows[$count]['quantity'] = $quantity;

    		$count++;
    	}


    	$status = ProcurementModel::createPurchaseOrder($term, $supplier, $address, $deliveryDate, $discount, $rows);

    	if(!$status){
            //echo 'ADASDASDADASDAS';
            return Redirect::back()
    					             ->withErrors(['error' => 'An unexpected error occured.'])
   						             ->withInput(Input::all());


            //return mysql_errno() ? "true" : "false";
    	}

    	$success = 'Purchase Order successfully created.';
      $leastReject = ProcurementModel::getLeastRejectPerProductBySupplier();

      $data = [
        'leastReject' => $leastReject,
        'success' => $success,
      ];

      return view('procurement.PurchaseOrderSelect')->with($data);
    }

    public function inputDeliveryReceipt(Request $request){
        $purchaseOrderID = Input::get('PurchaseOrderID');
        $term = Input::get('Terms');
        $supplier = Input::get('SupplierID');
        $discount = Input::get('discount');
        $deliveryAddress = Input::get('DeliveryAddress');
        $deliveryDate = Input::get('DeliveryDate');

        $woodTypes = Input::get('Material');
        $thicknesses = Input::get('Thickness');
        $widths = Input::get('Width');
        $lengths = Input::get('Length');
        $quantitiesRejected = Input::get('QuantityRejected');
        $quantitiesRecieved = Input::get('QuantityReceived');
        $unitPrices = Input::get('Price');


        $rows = [];

        foreach($woodTypes as $woodType){
            $rows[] = ['woodType' => $woodType];
        }

        $count = 0;
        foreach($thicknesses as $thickness){
            $rows[$count]['thickness'] = $thickness;

            $count++;
        }

        $count = 0;
        foreach($widths as $width){
            $rows[$count]['width'] = $width;

            $count++;
        }

        $count = 0;
        foreach($lengths as $length){
            $rows[$count]['length'] = $length;

            $count++;
        }

        $count = 0;
        foreach($quantitiesRejected as $quantity){
            $rows[$count]['quantityRejected'] = $quantity;

            $count++;
        }

        $count = 0;
        foreach($quantitiesRecieved as $quantity){
            $rows[$count]['quantityReceived'] = $quantity;

            $count++;
        }

        $count = 0;
        foreach($unitPrices as $unitPrice){
            $rows[$count]['unitPrice'] = $unitPrice;

            $count++;
        }

        $status = ProcurementModel::createDeliveryReceipt($purchaseOrderID, $term, $deliveryAddress, $deliveryDate, $discount, $rows);

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
            'success' => 'Purchase order succesfully received.',
        ];

        return view('procurement.DeliveryReceiptInitial')->with($data);
    }
}
