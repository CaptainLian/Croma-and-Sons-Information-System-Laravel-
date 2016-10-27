@extends('procurement.main')

@section('title')
Purchase Order : {!!$purchaseOrderDetails->PurchaseOrderID!!} 
@endsection

@section('sidebar')
	@include('procurement.sidebar', ['active' => 'PurchaseOrder'])
@endsection

@push('css')
 	<link href="css/invoice-print.css" rel="stylesheet" media="print">
@endpush

@section('main-content')
<!-- invoice start-->
<section>
	<div class="panel panel-primary">
		<!--<div class="panel-heading navyblue"> INVOICE</div>-->
		<div class="panel-body">
			<div class="row invoice-list">
				<div class="text-center corporate-id">
					<img src="img/vector-lab.jpg" alt="">
					<h1>Purchase Order</h1>
				</div>
				<div class="col-lg-4 col-sm-4">
					<h4>BILLING AND DELIVERY INFORMATION</h4>
					<p>Payment Terms :
						<b>{!!$purchaseOrderDetails->Terms!!}</b>
						<br>Delivery Address: <strong>{!!$purchaseOrderDetails->DeliveryAddress!!}</strong>
					</p>
				</div>
				<div class="col-lg-4 col-sm-4">
					<h4>SUPPLIER INFORMATION</h4>
					<p>Supplier :
						<strong>{!!$supplierDetails->Name!!}</strong>
						<br>Address: <strong>{!!$supplierDetails->Address!!}</strong>
						<br>Contact Number:
						<string>{!!$supplierDetails->Landline!!}</strong>
						<br>
					</p>
				</div>
				<div class="col-lg-4 col-sm-4">
					<h4>PURCHASE ORDER INFORMATION</h4>
					<ul class="unstyled">
						<li>Order Number :
							<strong>{!!$purchaseOrderDetails->PurchaseOrderID!!}</strong>
						</li>
						<li>Order Date : <strong>{!!$purchaseOrderDetails->DateCreated!!}</strong></li>
						<li>Requested Delivery Date : <strong>{!!$purchaseOrderDetails->RequestedDeliveryDate!!}</strong></li>
						
						<!--
						<li>Prepared By :
							<b>John Fisher</b>
						</li>
						-->
					</ul>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Material</th>
						<th class="">Size (LxWxH)</th>
						<th class="">Unit</th>
						<th class="">Quantity</th>
						<th class="">B/F</th>
						<th class="">Unit Price (Php)</th>
						<th class="">Discount (%)</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						$count = 1; 
						$total = 0.0;
					?>
					@foreach($purchaseOrderItems as $orderItem)
						<td>{!!$count!!}</td>
						<td>{!!$orderItem->Material!!}</td>
						<td>{!!$orderItem->Size!!}</td>
						<td>piece</td>
						<td>{!!$orderItem->Quantity!!}</td>
						<td>{!!$orderItem->BoardFeet!!}</td>
						<td>{!!$orderItem->UnitPrice!!}</td>
						<td>{!!$orderItem->Discount!!}</td>
						<td>{!!($total += $orderItem->Quantity*$orderItem->UnitPrice*(1-$orderItem->Discount))!!}</td>

						$count++;
					@endforeach
				</tbody>
			</table>
			<div class="row">
				<div class="col-lg-4 invoice-block pull-right">
					<ul class="unstyled amounts">
						<!--
						<li>
						<strong>Sub - Total amount :</strong>$6820</li>
						<li>
						<strong>Discount :</strong>10%</li>
						<li>
						<strong>VAT :</strong>-----</li>
						-->
						<li>
						<u>Grand Total :</u> <strong>{!!$total!!} Php</strong></li>
					</ul>
				</div>
			</div>
			<div class="text-center invoice-btn">
				<a class="btn btn-danger btn-lg" href="/procurement/DeliveryReceipt"><i class="fa fa-check"></i> Back </a>
			</div>
		</div>
	</div>
</section>
<!-- invoice end-->
@endsection

@push('javascript')
	<script src="/js/respond.min.js"></script>
	<script type="text/javascript" src="/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
	<script type="text/javascript" src="/assets/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
	<script type="text/javascript" language="javascript" src="/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
	<script src="/js/dynamic_table_init.js"></script>
	<!--right slidebar-->
	<script src="/js/slidebars.min.js"></script>
	<!--common script for all pages-->
	<script src="/js/common-scripts.js"></script>
@endpush