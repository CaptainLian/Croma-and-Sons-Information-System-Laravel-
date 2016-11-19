@extends('procurement.main')

@section('title')
Supplier List
@endsection

@section('sidebar')
@include('procurement.sidebar', ['active' => 'SupplierList'])
@endsection

@push('css')

@endpush

@section('main-content')
<!-- page start-->
<section class="panel">
	<header class="panel-heading">
		<h1>Supplier List</h1>
	</header>
	<div class="panel-body">
		<div class="adv-table editable-table ">
			<div class="clearfix">
				<div class="btn-group">
					<button id="editable-sample_new" class="btn green">Add New
					<i class="fa fa-plus"></i>
					</button>
				</div>
			</div>
			<div class="space15"></div>
			<div class="table-responsive">
				<table class="table table-striped table-hover table-bordered" id="editable-sample">
					<thead>
						<tr>
							<th>Supplier Name</th>
							<th>Address</th>
							<th>Contact Details</th>
							<th>Contact Person</th>
							<th>Total Purchased (current year)</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						@foreach($suppliers as $supplier)
							<tr>
								<td>
									<a data-toggle="modal" href="#myModal2">
										{!!$supplier->Name!!}
									</a>
									
									<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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
																			<h1>Supplier Catalog</h1>
																		</div>
																		<div class="col-lg-4 col-sm-4">
																			<h4>SUPPLIER INFORMATION</h4>
																			<p>Supplier:
																				<strong>{!!$supplier->Name!!}</strong>
																				<br>Address:
																				<b>{!!$supplier->Address!!}</b>
																				<br>Contact Number:
																				<b>{!!$supplier->Landline!!}</b>
																				<br>
																			</p>
																			<p></p>
																		</div>
																		<div class="col-lg-4 col-sm-4"></div>
																	</div>
																	<table class="table table-striped table-hover">
																		<?php 
																			$count = 1;
																				
																		?>
																		<thead>
																			<tr>
																				<th>#</th>
																				<th>Material</th>
																				<th class="">Thickness (in)</th>
																				<th class="">Width (in)</th>
																				<th class="">Length (ft)</th>
																				<th class="">Price</th>
																				<th class="">Edit</th>
																				<th class="">Delete</th>
																			</tr>
																		</thead>
																		<tbody>
																			@if(isset($supplierPrices[$supplier->SupplierID]))
																				@foreach($supplierPrices[$supplier->SupplierID] as $prices)
																					
 																					<tr>
																						<td>{!!$count!!}</td>
																						<td>{!!$prices->Material!!}</td>
																						<td>{!!$prices->Thickness!!}</td>
																						<td>{!!$prices->Width!!}</td>
																						<td>{!!$prices->Length!!}</td>
																						<td>{!!$prices->CurrentPrice!!}</td>
																						<td>
																							<a class="edit" href="javascript:;">Edit</a>
																						</td>
																						<td>
																							<a class="delete" href="javascript:;">Delete</a>
																						</td>
																					</tr>

																					<?php $count++; ?>
																				@endforeach
																			@endif
																		</tbody>
																	</table>

																	<!-- 
																	<div class="row">
																		<div class="col-lg-4 invoice-block pull-right">
																			<ul class="unstyled amounts">
																				<li>
																				<strong>Sub - Total amount :</strong>$6820</li>
																				<li>
																				<strong>Discount :</strong>10%</li>
																				<li>
																				<strong>VAT :</strong>-----</li>
																				<li>
																				<strong>Grand Total :</strong>$6138</li>
																			</ul>
																		</div>
																	</div>
																	-->
																	<div class="text-center invoice-btn">
																		<!-- <a class="btn btn-danger btn-lg"><i class="fa fa-check"></i> Submit Invoice </a> -->
																		<a class="btn btn-info btn-lg" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>
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
								<td>{!!$supplier->Address!!}</td>
								<td>{!!$supplier->Landline!!}</td>
								<td>{!!$supplier->ContactPerson!!}</td>
								<td>N/A</td>
								<td>
									<a class="edit" href="javascript:;">Edit</a>
								</td>
								<td>
									<a class="delete" href="javascript:;">Delete</a>
								</td>
							</tr>
						@endforeach
						</tr>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<!-- page end-->
@endsection

@push('javascript')
	<script type="text/javascript" src="/assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
    <script src="/js/dynamic_table_init.js"></script>
    <script src="/js/respond.min.js"></script>
    <!--right slidebar-->
    <script src="/js/slidebars.min.js"></script>
    <!--common script for all pages-->
    <script src="/js/common-scripts.js"></script>
    <!--script for this page only-->
    <script src="/js/editable-table5.js"></script>

    <script>
      jQuery(document).ready(function() {
          EditableTable.init();
      });
    </script>
@endpush