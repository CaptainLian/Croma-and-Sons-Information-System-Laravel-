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
							<tr class="gradeX">
								<td>
									<a href="ProcurementPurchaseOrderSpecific.html">Trident</a>
								</td>
								<td>Internet Explorer 4.0</td>
								<td>Win 95+</td>
								<th>
									<a href="ProcurementEncodeSupplierDeliveryReceipt.html"><button type="button" class="btn btn-success">Encode Delivery Receipt</button></a>
								</th>
							</tr>
							<tr class="gradeC">
								<td>
									<a href="ProcurementPurchaseOrderSpecific.html">Trident</a>
								</td>
								<td>Internet Explorer 5.0</td>
								<td>Win 95+</td>
								<th>
									<a href="ProcurementEncodeSupplierDeliveryReceipt.html"><button type="button" class="btn btn-success">Encode Delivery Receipt</button></a>
								</th>
							</tr>
							<tr class="gradeC">
								<td>
									<a href="ProcurementPurchaseOrderSpecific.html">Trident</a>
								</td>
								<td>Internet Explorer 5.0</td>
								<td>Win 95+</td>
								<th>
									<a href="ProcurementEncodeSupplierDeliveryReceipt.html"><button type="button" class="btn btn-success">Encode Delivery Receipt</button></a>
								</th>
							</tr>
							<tr class="gradeC">
								<td>
									<a href="ProcurementPurchaseOrderSpecific.html">Trident</a>
								</td>
								<td>Internet Explorer 5.0</td>
								<td>Win 95+</td>
								<th>
									<a href="ProcurementEncodeSupplierDeliveryReceipt.html"><button type="button" class="btn btn-success">Encode Delivery Receipt</button></a>
								</th>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
</div>
<!-- page end-->
@endsection