@extends('procurement.main')

@section('title')
Purchase List
@endsection

@section('sidebar')
	@include('procurement.sidebar', ['active' => 'PurchaseList'])
@endsection

@push('css')

@endpush

@section('main-content')
<!-- page start-->
<section class="panel">
	<div class="panel-body">
		<div class="tab-content">
			<div id="home" class="tab-pane active">
				<div class="row">
					<div class="col-sm-12">
						<section class="panel">
							<header class="panel-heading">
								<h1>Purchase List</h1>
							</header>
							<div class="panel-body">
								<div class="adv-table">
									<table class="display table table-bordered table-striped" id="dynamic-table">
										<thead>
											<tr>
												<th>Material</th>
												<th>Size</th>
												<th>Suppliers</th>
												<th>Cheapest Price</th>
												<th>Recommended Supplier (Least Rejected)</th>
											</tr>
										</thead>
										<tbody>
											<tr class="gradeX">
												<td>Kiln Dry</td>
												<td>2x2x10</td>
												<td>
													<a href="ProcurementSupplierSpecific">Ieko </a>
												</td>
												<td>31 Pesos
													<a href="ProcurementSupplierSpecific">(Trident) </a>
												</td>
												<td>
													<a href="ProcurementSupplierSpecific">Kim </a>
												</td>
											</tr>
											<tr class="gradeC ">
												<td>Kiln Dry</td>
												<td>2x2x8</td>
												<td>
													<a href="ProcurementSupplierSpecific">Ieko </a>
												</td>
												<td>80 Pesos
													<a href="ProcurementSupplierSpecific"> (Trident) </a>
												</td>
												<td>
													<a href="ProcurementSupplierSpecific">Kim </a>
												</td>
											</tr>
											<tr class="gradeX ">
												<td>Sun Dry</td>
												<td>2x4x8</td>
												<td>
													<a href="ProcurementSupplierSpecific">Ieko </a>
												</td>
												<td>
													35 Pesos <a href="ProcurementSupplierSpecific"> (Trident) </a></td>
													<td>
														<a href="ProcurementSupplierSpecific">Kim </a>
													</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</section>
						</div>
					</div>
				</div>
				<div id="about " class="tab-pane ">
					<div class="row ">
						<div class="col-sm-12 ">
							<section class="panel ">
							<header class="panel-heading ">Sales Report</header>
							<div class="panel-body ">
								<div class="adv-table ">
									<table class="display table table-bordered
										table-striped " id="dynamic-table ">
										<thead>
											<tr>
												<th>Invoice #</th>
												<th>Invoice Date</th>
												<th></th>
												<th>Total Amount</th>
												<th>Total Discount</th>
												<th>Total Reject (In Pesos)</th>
											</tr>
										</thead>
										<tbody>
											<tr class="gradeX ">
												<td>Trident</td>
												<td>Internet Explorer 4.0</td>
												<td>Win 95+</td>
												<td>Win 95+</td>
												<td>Win 95+</td>
												<td>Win 95+</td>
											</tr>
											<tr class="gradeC ">
												<td>Trident</td>
												<td>Internet Explorer 5.0</td>
												<td>Win 95+</td>
												<td>Win 95+</td>
												<td>Win 95+</td>
												<td>Win 95+</td>
											</tr>
											<tr class="gradeC ">
												<td>Trident</td>
												<td>Internet Explorer 5.0</td>
												<td>Win 95+</td>
												<td>Win 95+</td>
												<td>Win 95+</td>
												<td>Win 95+</td>
											</tr>
											<tr class="gradeX ">
												<td>Trident</td>
												<td>Internet Explorer 4.0</td>
												<td>Win 95+</td>
												<td>Win 95+</td>
												<td>Win 95+</td>
												<td>Win 95+</td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>
						</section>
					</div>
				</div>
			</div>
			<div id="profile " class="tab-pane ">
				<div class="row ">
					<div class="col-sm-12 ">
						<section class="panel ">
						<header class="panel-heading ">Sales Report</header>
						<div class="panel-body ">
							<div class="adv-table ">
								<table class="display table table-bordered
									table-striped " id="dynamic-table ">
									<thead>
										<tr>
											<th>Invoice #</th>
											<th>Invoice Date</th>
											<th></th>
											<th>Total Amount</th>
											<th>Total Discount</th>
											<th>Total Reject (In Pesos)</th>
										</tr>
									</thead>
									<tbody>
										<tr class="gradeX ">
											<td>Trident</td>
											<td>Internet Explorer 4.0</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
										</tr>
										<tr class="gradeC ">
											<td>Trident</td>
											<td>Internet Explorer 5.0</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
										</tr>
										<tr class="gradeC ">
											<td>Trident</td>
											<td>Internet Explorer 5.0</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
										</tr>
										<tr class="gradeX ">
											<td>Trident</td>
											<td>Internet Explorer 4.0</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
											<td>Win 95+</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</section>
				</div>
			</div>
		</div>
	</div>
</div>
</section>
<!-- page end-->
@endsection

@push('javascript')

@endpush