@extends('inventory.main', ['active' => 'InventoryEdit'])

@section('title')
Edit Inventory
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
				<h1>Edit Inventory</h1>
				<span class="tools pull-right">
					<a href="javascript:;" class="fa fa-chevron-down"></a>
					<a href="javascript:;" class="fa fa-times"></a>
				</span>
			</header>
			<div class="panel-body">
				<div class="adv-table">
					<table class="display table table-bordered table-striped" id="dynamic-table">
						<thead>
							<tr>
								<th>Material</th>
								<th>Size</th>
								<th>Current Quantity</th>
								<th>Quantity</th>
							</tr>
						</thead>
						<tbody>
							@foreach($inventory as $stock)
								<tr class="gradeX">
									<td>
										{!!$stock->Material!!}
									</td>

									<td>
										{!!$stock->Size!!}
									</td>

									<td>
										{!!$stock->StockQuantity!!}
									</td>

									<td width="30px">
										<input class="form-control" type="text">
									</td>
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
@endsection

@push('javascript')
	<script type="text/javascript" src="/js/dynamic_table_init.js"></script>
    <script type="text/javascript" src="/js/dynamic_table_init2.js "></script>
    <script type="text/javascript" src="/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
    <script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
    <script type="text/javascript" src="/assets/data-tables/jquery.dataTables.js"></script>
@endpush