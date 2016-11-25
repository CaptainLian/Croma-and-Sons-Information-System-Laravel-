@extends('inventory.main', ['active' => 'InventoryList'])

@section('title')
Inventory List
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
									<th class="col-sm-1">Status </th>
									<th class="col-sm-2">Material</th>
									<th class="col-sm-2">Size</th>
									<th class="col-sm-2">Qty</th>
									<th class="col-sm-2">EOQ</th>
									<th class="col-sm-2">Reorder Point</th>
									<th class="col-sm-2">Procurement Qty Request</th>
								</tr>
							</thead>
							<tbody>
								@foreach ($inventory as $product)
									<tr>
										<td>Aguy<td>
										<td>{!!$product->Material!!}</td>
										<td>{!!$product->Size!!}</td>
										<td>{!!$product->StockQuantity!!}</td>
										<td>{!!$product->EconomicOrderQuantity!!}</td>
										<td>{!!$product->ReorderPoint!!}</td>
										<td><input class="form-control" type="text" style="width: 150px" /></td>
									</tr>

								@endforeach


							</tbody>
						</table>
					</div>
				</div>

				<div class="text-center invoice-btn">
					<a class="btn btn-info btn-lg" id="request"><i class="fa fa-check"></i> Make Procurement Request </a>
				</div>

			</section>
		</div>
	</div>
	<!-- page end-->
@endsection

@push('javascript')
	<script type="text/javascript" src="/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
	<script type="text/javascript" src="/assets/data-tables/jquery.dataTables.js"></script>
	<script type="text/javascript" src="/js/dynamic_table_init.js"></script>
	<script type="text/javascript" src="/js/dynamic_table_init2.js "></script>

	<script>

	  $(document).ready( function () {


	      $("#request").click( function () {


	          alert("PLACE HOLDER ALERT HERE");


	      });


	  });

	</script>
@endpush
