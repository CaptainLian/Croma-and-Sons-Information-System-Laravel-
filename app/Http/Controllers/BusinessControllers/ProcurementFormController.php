<?php

namespace App\Http\Controllers\BusinessControllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\ProcurementModel;
use App\SupplierModel;
use App\CustomerModel;

use Input;
use Redirect;
use Session;


class ProcurementFormController extends Controller{
    
    public function inputPurchaseOrder(){
    	//$term, $supplier, $address, $woodTypes, $thicknesses, $widths, $lengths, $quantities, $unitPrices, $discounts

    	$term = Input::get('terms');
    	$supplier = Input::get('supplier');
    	$address = Input::get('address');

    	//table rows
    	$woodTypes = Input::get('WoodType');
    	$thicknesses = Input::get('Thickness');
    	$widths = Input::get('Width');
    	$lengths = Input::get('Length');
    	$quantities = Input::get('Quantity');
    	$unitPrices = Input::get('UnitPrice');
    	$discounts = Input::get('Discount');

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

    	$count = 0;
    	foreach($discounts as $discount){
    		$rows[$count]['discount'] = $discount;

    		$count++;
    	}

    	$status = ProcurementModel::createPurchaseOrder($term, $supplier, $address, $rows);
 
    	if(!$status){
    		return Redirect::back()
    						->withErrors(['error' => 'An unexpected error occured.'])
    						->withInput(Input::all());
    	}

    	$suppliers = SupplierModel::getSuppliers();
    	$terms = CustomerModel::getTerms();
    	$success = 'Purchase Order successfully created.';

    	$data = [
    		'suppliers' => $suppliers,
    		'terms' => $terms,
    		'success' => $success,
    	];

    	return view('procurement.CreatePurchaseOrder')->with($data);
    }
}
