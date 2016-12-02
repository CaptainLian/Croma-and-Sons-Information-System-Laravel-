@extends('procurement.main')

@section('title')
Create Purchase Order
@endsection

@section('navbar-dropdown-content')
<li class="sb-toggle-right">
 	<i class="fa fa-align-right"></i>
</li>
@endsection

@section('sidebar')
	@include('procurement.sidebar', ['active' => 'PurchaseOrder'])
@endsection

@push('css')
    <link href="/css/invoice-print.css" rel="stylesheet" media="print" />
    <link rel="stylesheet" href="/assets/data-tables/DT_bootstrap.css" />
    <link href="/css/cloud.css" rel="stylesheet" />
    <link href="/css/form.css" rel="stylesheet" />
@endpush

@section('main-content')
<!-- invoice start-->
<section>
	<div class="panel panel-primary">
		<!--<div class="panel-heading navyblue"> INVOICE</div>-->
		<div class="text-center corporate-id">
			<img src="/img/vector-lab.jpg" alt="">
			<h1>Purchase Order</h1>
		</div>
		<div class="panel-body">
			@if(isset($success))
			<div class="row">
				<div class="alert alert-success">
					<strong>Success!</strong> {!!$success!!}
				</div>
			</div>
			@endif
			@if($errors->has('error'))
				<div class="row">
					<div class="alert alert-danger">
						<strong>Danger!</strong> {{$errors->first('error')}}
					</div>
				</div>
			@endif
			<div class="row">
				{!!Form::open(['action' => 'BusinessControllers\ProcurementFormController@inputPurchaseOrder', 'id' => 'form'])!!}

				<div class="row" id="newUserRow">
					<div class="form-group">
						<label class="control-label col-md-1">Requested Delivery Date</label>
						<div class="col-md-3 col-xs-11">
							<div data-date-viewmode="years" data-date-format="yyyy-mm-dd" data-date="{!!date('Y-m-d')!!}" class="input-append date dpYears">
								<input type="text" name="deliveryDate" readonly="" value="{!!date('Y-m-d')!!}" size="16" class="form-control">
								<span class="input-group-btn add-on">
									<button class="btn btn-danger" type="button">
									<i class="fa fa-calendar"></i>
									</button>
								</span>
							</div>
							<br />
						</div>
					</div>
				</div>
				<div class="row" id="newUserRow">
					<div class="form-group" id="toHide1">
						<label class="col-sm-1 control-label col-lg-1">Payment Terms</label>
						<div class="col-sm-3">
							<select name="terms" required class="form-control m-bot15">
								<option></option>
								@foreach($terms as $term)
									<?php $termy = $term->Terms; ?>
									<option value="{!!$termy!!}">{!!$termy!!}</option>
								@endforeach
							</select>
						</div>
					</div>
				</div>

				<div class="row" id="newUserRow">
					<div class="form-group" id="toHide1">
						<label class="col-sm-1 control-label col-lg-1">Supplier Name</label>
						<div class="col-lg-3">
							<div class="input-group m-bot15">
								<span class="input-group-btn">
									<button class="btn btn-white" type="button" id="newUser">New Supplier</button>
								</span>
								<select name="supplier" id="supplier" required class="form-control m-bot15">
									<option></option>
									@foreach($suppliers as $supplier)
										<option id="supplier{!!$supplier->SupplierID!!}" data-address="{!!$supplier->Address!!}" value="{!!$supplier->SupplierID!!}">{!!$supplier->Name!!}</option>
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
							<input name="address" value="976 A. Bonifacio Ave, Balingasa, Balintawak, Quezon City" id="address" type="text" required class="form-control">
						</div>
					</div>
				</div>
				<div class="row invoice-list">

					<!--
						<div class="col-lg-4 col-sm-4">
								<h4>PURCHASE ORDER INFORMATION</h4>
								<ul class="unstyled">
										<li>Purchase Order Number :
												<strong>69626</strong>
										</li>
										<li>Prepared By :
												<strong>John Fisher</strong>
										</li>
								</ul>
						</div>
					-->
				</div>
				<section class="panel">
				<header class="panel-heading">Order Items</header>
				<div class="panel-body">
					<div class="adv-table editable-table ">
						<div class="clearfix">
							<div class="btn-group">
								<button id="editable-sample_new" class="btn green">
								Add New <i class="fa fa-plus"></i>
								</button>
							</div>
              <!--
							<div class="btn-group pull-right">
								<button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
								</button>
								<ul class="dropdown-menu pull-right">
									<li><a href="#">Print</a></li>
									<li><a href="#">Save as PDF</a></li>
									<li><a href="#">Export to Excel</a></li>
								</ul>
							</div>
            -->
						</div>
						<div class="space15"></div>
						<div class="table-responsive">
							<table class="table table-striped table-hover table-bordered" id="editable-sample">
								<thead>
									<tr>
										<th>Material</th>
										<th>Thickness (in.)</th>
										<th>Width (in.)</th>
										<th>Length (Ft.)</th>
										<th>Quantity</th>
										<th>Unit</th>
										<th>Unit Price</th>
										<th>Total</th>
                    <th></th>
									</tr>
								</thead>

								<tbody>
                  <?php $hidden = ''; ?>
                  @if (isset($requestedProducts))
                    @foreach ($requestedProducts as $product)
                      <tr>
                        <td>
                          {!!Form::hidden('WoodType[]', $product->WoodTypeID);!!}
                          @if ($product->WoodTypeID === 1)
                            <input type="text" value="Kiln Dry" disabled class="form-control columnAdjust10p" />
                          @elseif($product->WoodTypeID === 2)
                            <input type="text" value="Sun Dry" disable class="form-control columnAdjust10p" />
                          @endif
                        </td>


                        <td>{!!Form::number('Thickness[]', $product->Thickness, ['readonly' => 'on', 'class' => 'form-control columnAdjust9p','step' => 'any', 'min' => 0, 'required' => 'required'] )!!}</td>
                        <td>{!!Form::number('Width[]', $product->Width, ['readonly' => 'on', 'class' => 'form-control columnAdjust9p','step' => 'any', 'min' => 0, 'required' => 'required'] )!!}</td>
                        <td>{!!Form::number('Length[]', $product->Length, ['readonly' => 'on','class' => 'form-control columnAdjust9p', 'step' => 'any', 'min' => 0, 'required' => 'required'] )!!}</td>
                        <td>{!!Form::number('Quantity[]', $product->RequestedQuantity, [ 'class' => 'form-control columnAdjust9p InputQuantity','step' => '1', 'min' => 0, 'required' => 'required'] )!!}</td>

                        <td>pcs</td>
                        <td>{!!Form::number('UnitPrice[]', 0.0, [ 'class' => 'form-control columnAdjust9p InputUnitPrice','step' => 'any', 'min' => 0, 'required' => 'required'] )!!}</td>
                        <td><input type="text" class="Amount columnAdjust9p form-control" step="any" min=0 disabled /></td> <!-- Amount -->
                        <td><a class="delete" href="javascript:;">Cancel</a></td> <!-- delete -->
                      </tr>
                    @endforeach
                  @endif

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
							<strong>Subtotal:</strong>&nbsp;<u id="subtotal">0.0</u>&nbsp;Php
						</li>
						<li>
							<strong>Discount: %</strong><input name="discount" id="inputDiscount" type="number" step="any" min=0.0 max=100 value=0.0 />
						</li>
						<li>
							<strong>Grand Total :</strong>&nbsp;<u id="grandTotal">0.0</u>&nbsp;Php
						</li>
					</ul>
				</div>
			</div>
			<div class="text-center invoice-btn">
				<input type="Submit" class="btn btn-success btn-lg" value ="Submit Purchase Order"/>
				<!-- <a class="btn btn-info btn-lg" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a> -->
			</div>
			{!!Form::close()!!}
		</div>
	</div>
</section>
<!-- invoice end-->
@endsection

@section('slidebar')
  <h4 class="side-title">Procurement Request</h4>
  <div class="panel-body">
  	<div class="adv-table">
  		<table class="display table table-bordered table-striped" id="dynamic-table">
  			<thead>
  				<tr>
  					<th><font color="white">Material</font></th>
  					<th><font color="white">Size</font></th>
  					<th><font color="white">Quantity</font></th>
  				</tr>
  			</thead>
  			<tbody>
          @if ($product != NULL)
            @foreach($productRequests as $product)
    					<tr class="gradeC">
    						<td>
    							<font color="white" >{!!$product->Material!!}</font>
    						</td>
    						<td>
    							<font color="white" size="1.8">{!!$product->Size!!}</font>
    						</td>
    						<td>
    							<font color="white">{!!$product->RequestedQuantity!!}</font>
    						</td>
    					</tr>
    				@endforeach
          @endif
  			</tbody>
  		</table>
  	</div>
  </div>
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
  <script type="text/javascript" src="/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
  <script type="text/javascript" src="/assets/data-tables/jquery.dataTables.js"></script>
  <script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
  <script type="text/javascript" src="/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
  <script type="text/javascript" src="/js/advanced-form-components.js"></script>

  <script type="text/javascript" src="/js/bootstrap-multiselect.js"></script>
  <script type="text/javascript" src="/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
  <script src="/js/dynamic_table_init.js"></script>
  <script src="/js/dynamic_table_init2.js "></script>

  <!--script for this page only-->
  <script src="/js/editable-table8.js"></script>

  <!--this page script only-->
  <!--right slidebar-->

  <!--common script for all pages-->
  <script src="/js/advanced-form-components.js" type="text/javascript"></script>
	<script>
	  $(document).ready(function() {
	    $("#newUser").click(function (){
	     $("#toHide").show();
	     $("#toHide1").hide();
	   });
	    $("#cancelButton").click(function(){
	      $("#toHide").hide();
	      $("#toHide1").show();
	    });

	    EditableTable.init();
	  });
	 </script>
   <script type="text/javascript" src="/js/procurement/PurchaseOrder.js"></script>
@endpush
