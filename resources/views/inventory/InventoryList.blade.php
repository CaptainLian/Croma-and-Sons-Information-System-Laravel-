@extends('inventory.main', ['active' => 'InventoryList'])

@section('title')
Inventory List
@endsection

@push('meta')
<meta name="csrf-token" content="{!!csrf_token()!!}" />
@endpush

@push('css')
	<link href="/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet">
	<link href="/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet">
	<link rel="stylesheet" href="/assets/data-tables/DT_bootstrap.css">
@endpush

@section('main-content')
<!-- page start-->
<div id="alert">

</div>
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
								<th class="col-sm-1">Status </th>
								<th class="col-sm-1">Material</th>
								<th class="col-sm-1">Size</th>
								<th class="col-sm-1">Quantity</th>
								<th class="col-sm-2">Quantity Requested</th>
								<th class="col-sm-2">Reorder Point</th>
								<th class="col-sm-3">Procurement Quantity Request</th>
							</tr>
						</thead>
						<tbody>
							@foreach($inventory as $product)
								<tr class="gradeX">
										<?php
											$threshold = $product->ReorderPoint + $product->ReorderPoint*0.2;
										?>
										<td align="center" class="StatusCell" style="padding-top: 1.5%;padding-left: 1.3%">
										@if($product->StockQuantity > $threshold )
												<span class="label label-success label-mini" style="padding-left: 20%; padding-right: 20%">Above</span>
										@elseif($product->StockQuantity == $product->ReorderPoint)
												<span class="label label-info label-mini" style="padding-left: 20%; padding-right: 10%">Reorder</span>
										@elseif($product->StockQuantity <= $threshold AND $product->StockQuantity > $product->ReorderPoint)
												<span class="label label-warning label-mini" style="padding-left: 20%; padding-right: 10%">Nearing</span>
										@else
												<span class="label label-danger label-mini" style="padding-left: 20%; padding-right: 20%">Below</span>
										@endif
										</td>

										<td align="left" class="MaterialCell">
											{!!$product->Material!!}
										</td>
										<td align="center" class="SizeCell">
											{!!$product->Size!!}
										</td>
										<td align="right" class="StockQuantityCell">
											{!!$product->StockQuantity!!}
										</td>
										<td align="right" class="RequestedQuantityCell">
											{!!$product->RequestedQuantity!!}
										</td>
										<td align="right" class="ReorderPointCell">
											{!!$product->ReorderPoint!!}
										</td>
										<td class="ProcureRequestCell" align="left">
											<input type="number" min=0 step=1 class="form-control RequestAmount" type="text" style="width: 125px" />
											<button class="btn btn-success btn-sm RequestButton">Request Quantity</button>

											<input type="hidden" class="WoodTypeID" value="{!!$product->WoodTypeID!!}" />
											<input type="hidden" class="Thickness" value="{!!$product->Thickness!!}" />
											<input type="hidden" class="Width" value="{!!$product->Width!!}" />
											<input type="hidden" class="Length" value="{!!$product->Length!!}" />
										</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<!--
			<div class="text-center invoice-btn">
				<a class="btn btn-success btn-lg" id="request"><i class="fa fa-check"></i> Make Procurement Request </a>
			</div>
		-->
		</section>
	</div>
</div>
<!-- page end-->

<!-- Modal -->
<div id="ProcurementModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Confirm Procurement Request</h4>
      </div><!-- modal-header -->
      <div class="modal-body">
				<center>
					<p><h3><strong>Current Product Information</strong></h3></p>
				</center>
				<table align="center">

					<tr>
						<td align="right">
							<strong>Material:</strong>&nbsp;
						</td>

						<td align="left" id="modalMaterial">

						</td>
					</tr>

					<tr>
						<td align="right">
							<strong>Size:</strong>&nbsp;
						</td>

						<td align="center" id="modalSize">

						</td>
					</tr>

					<tr>
						<td align="right">
							<strong>Current Stock Quantity:</strong>&nbsp;
						</td>

						<td align="right" id="modalCurrentQuantity">

						</td>
					</tr>

					<tr>
						<td align="right">
							<strong>Current Quantity Requested:</strong>&nbsp;
						</td>

						<td align="right" id="modalQuantityRequested">

						</td>
					</tr>

					<tr>
						<td align="right">
							<strong>Reorder Point</strong>:&nbsp;
						</td>

						<td align="right" id="modalReorderPoint">

						</td>
					</tr>

				</table>

				<br />
				<br />
				<h4><strong>Quantity to request: </strong>&nbsp;<u id="modalRequestQuantity">99</u></h4>
      </div> <!-- modal-body -->
      <div class="modal-footer">
				<button id="ProcurementConfirmation" type="button" class="btn btn-success" data-dismiss="modal">Continue Request</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancel</button>
      </div><!-- modal-footer -->
    </div><!-- model-dailog -->
  </div><!-- modal-dialog -->
</div> <!-- modal fade -->
<!-- Modal -->
@endsection

@push('javascript')
	<script type="text/javascript" src="/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
	<script type="text/javascript" src="/assets/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="/js/dynamic_table_init.js"></script>
	<script type="text/javascript" src="/js/dynamic_table_init2.js "></script>

	<script type="text/javascript" src="/js/inventory/InventoryListTable.js"></script>
	<script type="text/javascript">
	  $(document).ready( function () {
	      $("#request").click( function () {
	          alert("PLACE HOLDER ALERT HERE");
	      });
	  });
	</script>
@endpush
