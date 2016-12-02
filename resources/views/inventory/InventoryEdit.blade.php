@extends('inventory.main', ['active' => 'InventoryEdit'])

@push('meta')
	<meta name="csrf-token" content="{!!csrf_token()!!}" />
@endpush

@section('title')
Edit Inventory
@endsection

@push('css')
	<link href="/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet">
    <link href="/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/data-tables/DT_bootstrap.css">
@endpush

@section('main-content')
<div id="alert">

</div><!-- alert -->

<!-- page start-->
<div class="row">
	<div class="col-sm-12">
		<section class="panel">
			<header class="panel-heading">
				<h1>Edit Inventory</h1>
			</header>
			<div class="panel-body">
				<div class="adv-table">
					<table class="display table table-bordered table-striped" id="dynamic-table">
						<thead>
							<tr>
								<th class="col-md-3">Material</th>
								<th class="col-md-3">Size</th>
								<th class="col-md-2">Current Quantity</th>
								<th class="col-md-2">Edit Quantity</th>
							</tr>
						</thead>
						<tbody>
							@foreach($inventory as $product)
								<tr class="gradeX">
									<input type="hidden" class="WoodTypeID"  value="{!!$product->WoodTypeID!!}" />
									<input type="hidden" class="Thickness"  value="{!!$product->Thickness!!}" />
									<input type="hidden" class="Width"  value="{!!$product->Width!!}" />
									<input type="hidden" class="Length"  value="{!!$product->Length!!}" />

									<td class="MaterialCell">{!!$product->Material!!}</td>
									<td class="SizeCell">{!!$product->Size!!}</td>
									<td class="StockQuantityCell" align="right">{!!$product->StockQuantity!!}</td>
									<td><button data-toggle="modal" data-target="#myModal" class="btn btn-info ButtonEditQuantity" style="margin-left: 15%">Edit Quantity</button></td>
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

<div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
				<h4 class="modal-title">Edit Stock Quantity</h4>
			</div><!-- modal-header -->

			<div class="modal-body">
				<center>
					<p><h3><strong>Product information</strong></h3></p>
				</center>

				<table>
					<tr>
						<td>Material:&nbsp;</td>
						<td id="modalMaterial" align="right"></td>
					</tr>

					<tr>
						<td>Size:&nbsp;</td>
						<td id="modalSize" align="right"></td>
					</tr>

					<tr>
						<td>Current Stock Quantity:&nbsp;</td>
						<td id="modalStockQuantity" align="right"></td>
					</tr>
				</table>

				<center>
					<p><h4><strong>Edit Quantity Information</strong></h4></p>
				</center>

				<form id="modalForm" role="form">
					<div class="form-group">
						<label for="newQuantity">Checked Quantity</label>
						<input id="newQuantity" class="form-control" name="newQuantity" type="number" min="0" step="1" value=0 />
					</div>

					<div class="form-group">
						<label for="reason">Reason:</label>
						<label class="checkbox-inline">
							<input id="reason" name="reason" type="radio" value="7" checked="checked" />&nbsp;Manually Checked
						</label>
						<label class="checkbox-inline">
							<input name="reason" type="radio" value="8" />&nbsp;Spoilage
						</label>
						<label class="checkbox-inline">
							<input name="reason" type="radio" value="13" />&nbsp;Theft
						</label>
					</div>

					<div class="form-group">
						<label for="remark"> Remark</label>
						<textarea id="remark" class="form-control" name="remark" maxlength="255"></textarea>
					</div><!-- form-group -->
				</form>

			</div><!-- modal-body -->
			<div class="modal-footer">
			  	<button id="modalSubmit" data-dismiss="modal" class="btn btn-success"><i class="fa fa-check"></i>Submit</button>
					<button id="modalCancel" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-window-close"></i>Cancel</button>
			</div><!-- modal-footer -->
		</div><!-- modal-content -->
	</div><!-- modal-dialog-->
</div><!-- modal -->
@endsection

@push('javascript')
	<script type="text/javascript" src="/js/dynamic_table_init.js"></script>
  <script type="text/javascript" src="/js/dynamic_table_init2.js "></script>
  <script type="text/javascript" src="/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
  <script type="text/javascript" src="/assets/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="/js/inventory/InventoryEditTable.js"></script>
@endpush
