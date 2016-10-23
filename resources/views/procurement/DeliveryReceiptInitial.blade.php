@extends('procurement.main')

@section('title')
Pending Purchase Orders
@endsection

@section('sidebar')
	@include('procurement.sidebar', ['active' => 'DeliveryReceipt']);
@endsection

@section('main-content')
<!-- page start-->
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">
				<h1>Pending Purchase Orders</h1>
				<span class="tools pull-right">
				<a href="javascript:;" class="fa fa-chevron-down"></a>
				<a href="javascript:;" class="fa fa-times"></a>
				</span>
			</header>
			<div class="panel-body">
				<div class="adv-table">
					<table class="display table table-bordered table-striped" id="dynamic-table">
						<thead>
							<tr>
								<th>Purchase Order #</th>
								<th>Date Created</th>
								<th>Supplier</th>
								<th></th>
							</tr>
						</thead>
						<tbody>
							@foreach($pendingPO as $PO)
								<?php $POID = $PO->POID; ?>
								<tr>
									<td>
										<a href="/procurement/PurchaseOrderSpecific/{!!$POID!!}">{!!$POID!!}</a>
									</td>
									<td>
										{!!$PO->DateCreated!!}
									</td>
									<td>
										{!!$PO->SupplierName!!}
									</td>
									<td>	
										<a href="/procurement/DeliveryReceiptSpecific/{!!$POID!!}" class="btn btn-success" >Encode Delivery Receipt</a>
									</td>
								</tr>
							@endforeach	
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
</div>
<!-- page end-->
@endsection