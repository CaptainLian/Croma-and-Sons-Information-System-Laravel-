@extends('procurement.main')

@section('title')
Delivery Receipt for PO: {!!$deliveryReceiptDetails->PurchaseDeliveryReceiptID!!} 
@endsection

@section('sidebar')
	@include('procurement.sidebar', ['active' => 'PurchaseOrder'])
@endsection

@push('css')
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet">
    <link href="/css/invoice-print.css" rel="stylesheet" media="print">
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
					<h1>Supplier Delivery Receipt</h1>
				</div>
					
				<div class="col-lg-4 col-sm-4">
					<h4>SUPPLIER INFORMATION</h4>
					<p>Supplier Name :
						<strong>{!!$supplierDetails->Name!!}</strong>
						<br>Supplier Address:
						<b>{!!$supplierDetails->Address!!}</b>
						<br>
					</p>
				</div>
				<div class="col-lg-4 col-sm-4">
					<h4>DELIVERY RECEIPT INFORMATION</h4>
					<ul class="unstyled">
						<!--
						<li>Delivery Receipt Number :
							<strong>69626</strong>
						</li>

						-->
						<li>Delivery Receipt Number :
							<strong>{!!$deliveryReceiptDetails->PurchaseDeliveryReceiptID!!}</strong>
						</li>
						<li>
							Delivery Date:
							<strong>{!!$deliveryReceiptDetails->DateDelivered!!}</strong>
						</li>
						<li>Prepared By :
							<b>{!!$deliveryReceiptDetails->PreparedBy!!}</b>
						</li>

					</ul>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>#</th>
						<th>Material</th>
						<th class="">Size</th>
						<th class="">Unit</th>
						<th class="">Quantity Recieved</th>
						<th class="">Quantity Rejected</th>
						<th class="">B/F</th>
						<th class="">Unit Price</th>
						<th>Total</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$count = 1;
						$sum = 0.0;

					?>
					@foreach($deliveryReceiptItems as $item)
						<tr>
							<td>{!!$count!!}</td>
							<td><{!!$item->Material!!}/></td>
							<td>{!!$item->Size!!}</td>
							<td>piece</td>
							<td>{!!$item->Quantity!!}</td>
							<td>{!!$item->RejectedQuantity!!}</td>
							<td>{!!$item->BoardFeet!!}</td>
							<td>{!!$item->PurchasedUnitPrice!!}</td>
							<td>{!!$tmp = ($item->Quantity-$item->RejectedQuantity)*$item->PurchasedUnitPrice!!}</td>
							<?php $sum += $tmp; ?>
						</tr>

						<?php $count++; ?>
					@endforeach
					<tr>

					
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
							<u>Grand Total</u> : <strong>{!!$sum!!} Php</strong>
						</li>

						
					</ul>
				</div>
			</div>

			<a href="/procurement/PurchaseReport" class="btn btn-danger" >Return</a>
		</div>
	</div>
</section>
<!-- invoice end-->
@endsection

@push('javascript')
	<script type="text/javascript" src="/assets/fuelux/js/spinner.min.js"></script>
    <script type="text/javascript" src="/assets/bootstrap-fileupload/bootstrap-fileupload.js"></script>
    <script type="text/javascript" src="/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
    <script type="text/javascript" src="/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
    <script type="text/javascript" src="/assets/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
    <script type="text/javascript" src="/assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js"></script>
    <script type="text/javascript" src="/assets/bootstrap-daterangepicker/moment.min.js"></script>
    <script type="text/javascript" src="/assets/bootstrap-daterangepicker/daterangepicker.js"></script>
    <script type="text/javascript" src="/assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js"></script>
    <script type="text/javascript" src="/assets/bootstrap-timepicker/js/bootstrap-timepicker.js"></script>
    <script type="text/javascript" src="/assets/jquery-mult  i-select/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
    <script type="text/javascript" src="/assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript" src="/js/advanced-form-components.js"></script>
    <script type="text/javascript" src="/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
    <script type="text/javascript" src="/assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript" language="javascript" src="/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
@endpush