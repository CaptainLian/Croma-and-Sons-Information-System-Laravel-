@extends('procurement.main')

@section('title')
Product Purchase Report
@endsection

@section('sidebar')
	@include('procurement.sidebar', ['active' => 'ProductPurchaseReport']);
@endsection

@section('main-content')
	<!-- page start-->
	<section class="panel">
		<header class="panel-heading tab-bg-dark-navy-blue ">
			<ul class="nav nav-tabs">
				<li class="active">
					<a data-toggle="tab" href="#home">Weekly</a>
				</li>
				<li class="">
					<a data-toggle="tab" href="#about">Monthly</a>
				</li>
				<li class="">
					<a data-toggle="tab" href="#profile">Yearly</a>
				</li>
			</ul>
		</header>
		<div class="panel-body">
			<div class="tab-content">
				<!-- Weekly -->
				<div id="home" class="tab-pane active">
					<div class="row">
						<div class="col-sm-12">
							<section class="panel">
								<header class="panel-heading">
									<h1>Product Purchase Report</h1>
								</header>
								<div class="panel-body">
									<div class="adv-table">
										<table class="display table table-bordered table-striped" id="dynamic-table">
											<thead>
												<tr>
													<th>Material</th>
													<th>Size (TxWxL)</th>
													<th>Quantity Purchased</th>
													<th>Quantity Rejected</th>
													<th>Amount Purchased</th>
													<th>Amount Rejected</th>
												</tr>
											</thead>
											<tbody>
												
												
												@foreach($weekly as $item)
													<tr>
														<td>{!! $item->Material !!}</td>
														<td>{!! $item->Size !!}</td>
														<td>{!! $item->PurchasedQuantity !!}</td>
														<td>{!! $item->RejectedQuantity !!}</td>
														<td>{!! $item->PurchasedAmount !!}</td>
														<td>{!! $item->RejectedAmount !!}</td>
													</tr>
												@endforeach
											</tbody>
										</table>
									</div>
								</div>
							</section>
						</div>
					</div>
				</div>
				<!-- Monthly -->
				<div id="about" class="tab-pane">
					<div class="row">
						<div class="col-sm-12">
							<section class="panel">
								<header class="panel-heading">Sales Report</header>
								<div class="panel-body">
									<div class="adv-table">
										<table class="display table table-bordered table-striped" id="dynamic-table">
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
												<tr class="gradeX">
													<td>Trident</td>
													<td>Internet Explorer 4.0</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
												</tr>
												<tr class="gradeC">
													<td>Trident</td>
													<td>Internet Explorer 5.0</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
												</tr>
												<tr class="gradeC">
													<td>Trident</td>
													<td>Internet Explorer 5.0</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
												</tr>
												<tr class="gradeX">
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
				<!-- Yearly -->
				<div id="profile" class="tab-pane">
					<div class="row">
						<div class="col-sm-12">
							<section class="panel">
								<header class="panel-heading">Sales Report</header>
								<div class="panel-body">
									<div class="adv-table">
										<table class="display table table-bordered table-striped" id="dynamic-table">
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
												<tr class="gradeX">
													<td>Trident</td>
													<td>Internet Explorer 4.0</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
												</tr>
												<tr class="gradeC">
													<td>Trident</td>
													<td>Internet Explorer 5.0</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
												</tr>
												<tr class="gradeC">
													<td>Trident</td>
													<td>Internet Explorer 5.0</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
													<td>Win 95+</td>
												</tr>
												<tr class="gradeX">
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