@extends('inventory.main', ['active' => 'InventoryList'])

@section('title')
Inventory List
@endsection

@push('css')
	<link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet">
  	<link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet">
  	<link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css">
@endpush

@section('main-content')
<!-- page start-->
<div class="row">
	<div class="col-sm-7">
		<section class="panel">
			<header class="panel-heading">
				<h1>Pending Purchase Orders</h1>
			</header>
			<div class="panel-body">
				<div class="adv-table">
					<table class="display table table-bordered table-striped" id="dynamic-table">
						<thead>
							<tr>
								<th>Material</th>
								<th>Size</th>
								<th>Qty</th>
								<th>Safety Stock</th>
								<th>Reorder Part</th>
								<th class="col-sm-1">Procure</th>
							</tr>
						</thead>
						<tbody>
							@foreach($inventory as $stock)
								<tr class="gradeX">
									<td>
										<a href="#">{!!$stock->Material!!}</a>
									</td>

									<td>{!!$stock->Size!!}</td>
									<td>{!!$stock->StockQuantity!!}</td>
									<td>{!!$stock->SafetyStock!!}</td>
									<td>{!!$stock->ReorderPoint!!}</td>

									<th>
										<a href="#">
											<button type="button" class="btn btn-success">
												<b>
													+
												</b>
											</button>
										</a>
									</th>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
		</section>
	</div>
	<div class="col-sm-5">
		<section class="panel">
			<header class="panel-heading">
				<h1>Procurement Requests</h1>
			</header>
			<div class="panel-body">
				<div class="adv-table">
					<table class="table table-striped">
						<thead>
							<tr>
								<th>Material</th>
								<th>Size</th>
								<th class="col-sm-4">Qty</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Kin Dry</td>
								<td>2x2x10</td>
								<td>   <input class="form-control" type="text"></td>
							</tr>
							<tr>
								<td>Sun Dry Dry</td>
								<td>2x2x10</td>
								<td>   <input class="form-control" type="text"></td>
							</tr>
							<tr>
								<td>Example Dry</td>
								<td>2x2x10</td>
								<td>   <input class="form-control" type="text"></td>
							</tr>
						</tbody>
					</table>
					<button type="button" class="btn btn-info">Create Procurement Request</button>
				</div>
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
	<script src="/js/dynamic_table_init.js"></script>
	<script src="/js/dynamic_table_init2.js "></script>
@endpush