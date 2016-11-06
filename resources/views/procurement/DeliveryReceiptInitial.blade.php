@extends('procurement.main')

@section('title')
Pending Purchase Orders
@endsection

@section('sidebar')
	@include('procurement.sidebar', ['active' => 'DeliveryReceipt']);
@endsection

@push('css')
	<link href="/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet">
    <link href="/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/data-tables/DT_bootstrap.css">
@endpush

@section('main-content')
<!-- page start-->
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">
				<h1>Pending Purchase Orders</h1>
				
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
							<?php $count = 0; ?>
							@foreach($pendingPO as $PO)
							<?php $POID = $PO->POID; ?>
							<tr>
								<td>
									<a data-toggle="modal" href="#myModal{!!$count!!}">{!!$POID!!}</a>
									<div class="modal fade" id="myModal{!!$count!!}" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
										<div class="modal-dialog modal-lg">
											<div class="modal-content">
												<div class="modal-header">
													<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
													
												</div>
												
												<div class="modal-body">
													<section class="wrapper">
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
																				<b>{!!$pendingPODetails[$POID]->Terms!!}</b>
																				<br>Delivery Address:
																				<b>{!!$pendingPODetails[$POID]->DeliveryAddress!!}</b>
																			</p>
																		</div>
																		<div class="col-lg-4 col-sm-4">
																			<h4>SUPPLIER INFORMATION</h4>
																			<p>Supplier :
																				<strong>{!!$pendingPODetails[$POID]->SupplierName!!}</strong>
																				<br>Address:
																				<b>{!!$pendingPODetails[$POID]->SupplierAddress!!}</b>
																				<br>Contact Number:
																				<b>{!!$pendingPODetails[$POID]->Landline!!}</b>
																				<br>
																			</p>
																		</div>
																		<div class="col-lg-4 col-sm-4">
																			<h4>PURCHASE ORDER INFORMATION</h4>
																			<ul class="unstyled">
																				<li>Purchase Order # : <b>{!!$POID!!}</b></li>
																				<li>Order Date : <b>{!!$pendingPODetails[$POID]->DateCreated!!}</b></li>
																				<li>Requested Delivery Date : <strong>{!!$pendingPODetails[$POID]->RequestedDeliveryDate!!}</strong></li>
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
																				<th class="">Size</th>
																				<th class="">Unit</th>
																				<th class="">Quantity</th>
																				<th class="">B/F</th>
																				<th class="">Unit Price (Ph₱) </th>
																				<th>Total (Ph₱)</th>
																			</tr>
																		</thead>
																		<tbody>
																			<?php 
																				$count = 1;
																				$total = 0;
																			?>
																			@foreach($pendingPODetails[$POID]->items as $item)

																				<tr>
																					<td>{!!$count++!!}</td>

																					<td>{!!$item->Material!!}</td>

																					<td>{!!$item->Size!!}</td>

																					<td>piece</td>

																					<td>{!!$item->Quantity!!}</td>

																					<td>{!!$item->BoardFeet!!}</td>

																					<td>{!!$item->UnitPrice!!}</td>

																					<td>
																						{!!($total = $item->UnitPrice*$item->Quantity)!!}
																					</td>

																				</tr>
																			@endforeach
																		</tbody>
																	</table>
																	<div class="row">
																		<div class="col-lg-4 invoice-block pull-right">
																			<ul class="unstyled amounts">
																				<li>
																					<strong>Subtotal:</strong> ₱ {!!$total!!}
																				</li>
																				<li>
																					<strong>Discount: </strong> {!!$pendingPODetails[$POID]->Discount!!} %
																				</li>
																				<li>
																					<strong>Grand Total :</strong> ₱ {!!$total*(1 - $pendingPODetails[$POID]->Discount)!!}
																				</li>
																			</ul>
																		</div>
																	</div>
																
																</div>
															</div>
														</section>
													<!-- invoice end-->
													</section>
												</div>
												<div class="modal-footer">
													<button data-dismiss="modal" class="btn btn-default" type="button">Close</button>
												</div>
											</div>
										</div>
									</div>
								</td>
								<td>
									{!!$PO->DateCreated!!}
								</td>
								<td>
									{!!$PO->SupplierName!!}
								</td>
								<td>
									<a href="/procurement/DeliveryReceiptSpecific/{!!$POID!!}" class="btn btn-success" >Receive Purchase Order</a>
								</td>
							</tr>
							<?php $count++; ?>
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

@push('javascript')
	<script type="text/javascript" language="javascript" src="/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
    <!--dynamic table initialization -->
    <script src="/js/dynamic_table_init.js"></script>
    <script src="/js/dynamic_table_init2.js "></script>
@endpush