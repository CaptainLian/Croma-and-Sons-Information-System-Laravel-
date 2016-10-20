@extends('procurement.main')

@push('css')
	<link href="/css/invoice-print.css" rel="stylesheet" media="print">
    <link rel="/stylesheet" href="/assets/data-tables/DT_bootstrap.css">
@endpush

@section('sidebar')
	@include('procurement.sidebar', ['active' => 'PurchaseOrder'])
@endsection


@section('main-content')
	<section>
		{!!Form::open()!!}
		<div class="panel panel-primary">
			<!--<div class="panel-heading navyblue"> INVOICE</div>-->
			<div class="panel-body">
				<div class="row">
					<div class="form-group">
						<label class="control-label col-md-1">Set Order Date</label>
						<div class="col-md-3 col-xs-11">
							<div data-date-viewmode="years" data-date-format="dd-mm-yyyy" data-date={{date('d-m-Y')}} class="input-append date dpYears">
								<input type="text" readonly="" value={{date('d-m-Y')}} size="16" class="form-control">
								<span class="input-group-btn add-on">
								<button class="btn btn-danger" type="button">
								<i class="fa fa-calendar"></i>
								</button>
								</span>
							</div>
							<br>
						</div>
					</div>
				</div>
				<br>
				<br>
				<div class="row">
					<label class="col-sm-1 col-sm-2 control-label">Payment Terms</label>
					<div class="col-sm-3">
						<select name="terms" class="form-control m-bot15">

							@foreach($terms as $term)
								<?php $t = $term->Terms; ?>
								<option value={{$t}}>{!!$t!!}</option>
							@endforeach

						</select>
					</div>
				</div>
				<div class="row" id="newUserRow">
					<div class="form-group" id="toHide1">
						<label class="col-sm-1 control-label col-lg-1">Supplier Name</label>
						<div class="col-lg-3">
							<div class="input-group m-bot15">
								<span class="input-group-btn">
								<button class="btn btn-white" type="button" id="newUser">New User</button>
								</span>
								<select name="customer" class="form-control m-bot15">
									@foreach($customers as $customer)
										<option value={{$customer->CustomerID}} address="{{$customer->Address}}">{!!$customer->Name!!}</option>
									@endforeach
								</select>
							</div>
						</div>
					</div>
					<div class="form-group" id="toHide">
						<label class="col-sm-1 control-label col-lg-1">Supplier Name</label>
						<div class="col-lg-3">
							<div class="input-group m-bot15">
								<span class="input-group-btn">
								<button class="btn btn-white" type="button" id="cancelButton">Cancel</button>
								</span>
								<input type="text" class="form-control">
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="form-group">
						<label class="col-sm-1 col-sm-2 control-label">Delivery Address</label>
						<div class="col-sm-3">
							<input type="text" class="form-control">
						</div>
					</div>
				</div>
				<div class="row invoice-list">
					<div class="text-center corporate-id">
						<img src="/img/vector-lab.jpg" alt="">
						<h1>Purchase Order</h1>
					</div>
					<div class="col-lg-4 col-sm-4">
						<h4>PURCHASE ORDER INFORMATION</h4>
						<ul class="unstyled">
						<!--
							<li>Purchase Order Number :
								<strong>69626</strong>
							</li>
						-->
							<li>Prepared By :
								<strong>John Fisher</strong>
							</li>
						</ul>
					</div>
				</div>
				<section class="panel">
					<header class="panel-heading">Orders</header>
					<div class="panel-body">
						<div class="adv-table editable-table ">
							<div class="clearfix">
								<div class="btn-group">
									<button id="editable-sample_new" class="btn green">Add New
									<i class="fa fa-plus"></i>
									</button>
								</div>
								<div class="btn-group pull-right">
									<button class="btn dropdown-toggle" data-toggle="dropdown">Tools
									<i class="fa fa-angle-down"></i>
									</button>
									<ul class="dropdown-menu pull-right">
										<li>
											<a href="#">Print</a>
										</li>
										<li>
											<a href="#">Save as PDF</a>
										</li>
										<li>
											<a href="#">Export to Excel</a>
										</li>
									</ul>
								</div>
							</div>
							<div class="space15"></div>
							<div class="table-responsive">
								<table class="table table-striped table-hover table-bordered" id="editable-sample">
									<thead>
										<tr>
											<th>Material</th>
											<th>Thickness (in)</th>
											<th>Width (in)</th>
											<th>Length (ft)</th>
											<th>Qty</th>
											<th>Unit</th>
											<th>B/F</th>
											<th>Unit Price</th>
											<th>Discount</th>
											<th>Amount</th>
											<th>Delete</th>
										</tr>
									</thead>
									<tbody>
										<tr class="">
											<td>
												<input class="form-control m-bot15" type="text" placeholder="Material">
											</td>
											<td>
												<input class="form-control m-bot15" type="text" placeholder="T">
											</td>
											<td>
												<input class="form-control m-bot15" type="text" placeholder="W">
											</td>
											<td>
												<input class="form-control m-bot15" type="text" placeholder="L">
											</td>
											<td>
												<input class="form-control m-bot15" type="text" placeholder="Qty">
											</td>
											<td>
												<input class="form-control m-bot15" type="text" placeholder="Input">
											</td>
											<td>
												<input class="form-control m-bot15" type="text" placeholder="B/F">
											</td>
											<td>
												<input class="form-control m-bot15" type="text" placeholder="Unit Price">
											</td>
											<td>
												<input class="form-control m-bot15" type="text" placeholder="Discount">
											</td>
											<td>52432</td>
											<td>
												<a class="delete" href="javascript:;">Delete</a>
											</td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</section>
				<div class="row">
					<div class="col-lg-4 invoice-block pull-right">
						<ul class="unstyled amounts">
							<li>
								<strong id="total">Sub - Total amount :</strong>$6820
							</li>
							<li>
								<strong>Discount :</strong>10%
							</li>
							<!--
							<li>
								<strong>VAT :</strong>-----
							</li>
							-->
							<li>
								<strong>Grand Total :</strong id="grandTotal">$6138
							</li>
						</ul>
					</div>
				</div>
				<div class="text-center invoice-btn">
					<input type="Submit" class="btn btn-danger btn-lg"><i class="fa fa-check"></i> Submit Purchase Order </a>
					<a class="btn btn-info btn-lg" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>
				</div>
			</div>
		</div>
	{!!Form::close()!!}
	</section>
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
    <script type="text/javascript" src="/assets/jquery-multi-select/js/jquery.multi-select.js"></script>
    <script type="text/javascript" src="/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
    <script type="text/javascript" src="/assets/data-tables/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
	<script src="/js/jquery.sparkline.js" type="text/javascript"></script>
	<script src="/js/jquery.customSelect.min.js"></script>
	 <!--script for this page only-->
    <script src="/js/editable-table.js"></script>
    <!--this page script only-->
    <script src="/js/advanced-form-components.js"></script>
    <!--right slidebar-->
    <script src="/js/slidebars.min.js"></script>
    <!--common script for all pages-->
    <script src="/js/common-scripts.js"></script>

	<script>
		$(document).ready(function() {
			$("#newUser").click(function (){		
				$("#toHide").show();
				$("#toHide1").hide();
			
				/*	$("#newUserRow").html(" <div class=\"form-group\">" + 
				"<label class=\"col-sm-1 col-sm-2 control-label\">Customer Name</label>" +
				"<div class=\"col-sm-3\">" +
				"<input type=\"text\" class=\"form-control\">" + 
				"  </div> " +
				"  </div> ");
				*/
			
			});
		
		
		
			$("#cancelButton").click(function(){
				$("#toHide").hide();
				$("#toHide1").show();
			
			});

			EditableTable.init();

		});
	</script>

    <!-- Mirrored from thevectorlab.net/flatlab/invoice.html by HTTrack
    Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2016 03:22:32 GMT -->
@endpush