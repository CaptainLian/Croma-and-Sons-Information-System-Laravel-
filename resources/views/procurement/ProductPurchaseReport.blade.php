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
									<h1>Product Weekly Purchase Report</h1>
								</header>
								<div class="panel-body">
									<div class="adv-table">
										<table class="display table table-bordered table-striped" id="dynamic-table">
											<thead>
												<tr>
													<th>Material</th>
													<th>Size (TxWxL)</th>
													<th>Quantity Delivered</th>
													<th>Quantity Rejected</th>
													<th>Total Quantity</th>
													<th>Amount Rejected (Php)</th>
													<th>Amount Purchased (Php)</th>
												</tr>
											</thead>
											<tbody>
												
												
												@foreach($weekly as $item)
													<tr>
														<td align="center">{!! $item->Material !!}</td>
														<td align="center">{!! $item->Size !!}</td>
														<td align="right">{!! $item->QuantityOrdered !!}</td>
														<td align="right">{!! $item->QuantityRejected !!}</td>
														<td align="right">{!! $item->TotalQuantity !!}</td>
														<td align="right">{!! $item->AmountRejected !!}</td>
														<td align="right">{!! $item->AmountPurchased !!}</td>
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
								<header class="panel-heading">
									<div class="row">
										<h1>Product Monthly Purchase Report</h1>
									</div>
									<h6>Of current month {!!date('F')!!}</h6>
								</header>
								<div class="panel-body">
									<div class="adv-table">
										<table class="display table table-bordered table-striped" id="dynamic-table">
											<thead>
												<tr>
													<th>Material</th>
													<th>Size (TxWxL)</th>
													<th>Quantity Delivered</th>
													<th>Quantity Rejected</th>
													<th>Total Quantity</th>
													<th>Amount Rejected (Php)</th>
													<th>Amount Purchased (Php)</th>
												</tr>
											</thead>
											<tbody>
												@foreach($monthly as $item)
													<tr>
														<td align="center">{!! $item->Material !!}</td>
														<td align="center">{!! $item->Size !!}</td>
														<td align="right">{!! $item->QuantityOrdered !!}</td>
														<td align="right">{!! $item->QuantityRejected !!}</td>
														<td align="right">{!! $item->TotalQuantity !!}</td>
														<td align="right">{!! $item->AmountRejected !!}</td>
														<td align="right">{!! $item->AmountPurchased !!}</td>
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
				<!-- Yearly -->
				<div id="profile" class="tab-pane">
					<div class="row">
						<div class="col-sm-12">
							<section class="panel">
								<header class="panel-heading">
									<div class="row">
										<h1>Product Yearly Purchase Report</h1>
									</div>
									<h6>Of current year {!!date('Y')!!}</h6>
								</header>
								<div class="panel-body">
									<div class="adv-table">
										<table class="display table table-bordered table-striped" id="dynamic-table">
											<thead>
												<tr>
													<th>Material</th>
													<th>Size (TxWxL)</th>
													<th>Quantity Delivered</th>
													<th>Quantity Rejected</th>
													<th>Total Quantity</th>
													<th>Amount Rejected (Php)</th>
													<th>Amount Purchased (Php)</th>
												</tr>
											</thead>
											<tbody>
												@foreach($yearly as $item)
													<tr>
														<td align="center">{!! $item->Material !!}</td>
														<td align="center">{!! $item->Size !!}</td>
														<td align="right">{!! $item->QuantityOrdered !!}</td>
														<td align="right">{!! $item->QuantityRejected !!}</td>
														<td align="right">{!! $item->TotalQuantity !!}</td>
														<td align="right">{!! $item->AmountRejected !!}</td>
														<td align="right">{!! $item->AmountPurchased !!}</td>
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
			</div>
		</div>
	</section>
	<!-- page end-->

@endsection