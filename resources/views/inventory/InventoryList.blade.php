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
							@foreach($inventory as $product)
								<tr class="gradeX">
										<?php
											$threshold = $product->ReorderPoint + $product->ReorderPoint*0.2;
										?>
										@if($product->StockQuantity > $threshold )
											<td style="padding-top: 1.5%;padding-left: 1.3%; width: 10%">
												<span class="label label-success label-mini" style="padding-left: 20%; padding-right: 20%">Above</span>
											</td>
										@elseif($product->StockQuantity == $product->ReorderPoint)
											<td style="padding-top: 1.5%;padding-left: 1.3%">
												<span class="label label-info label-mini" style="padding-left: 20%; padding-right: 10%">Reorder</span>
											</td>
										@elseif($product->StockQuantity <= $threshold AND $product->StockQuantity > $product->ReorderPoint)
											<td style="padding-top: 1.5%;padding-left: 1.3%">
												<span class="label label-warning label-mini" style="padding-left: 20%; padding-right: 10%">Nearing</span>
											</td>
										@else
											<td style="padding-top: 1.5%;padding-left: 1.3%">
												<span class="label label-danger label-mini" style="padding-left: 20%; padding-right: 20%">Below</span>
											</td>
										@endif
										<td>
											{!!$product->Material!!}
										</td>
										<td>
											{!!$product->Size!!}
										</td>
										<td>
											{!!$product->StockQuantity!!}
										</td>
										<td>
											{!!$product->EconomicOrderQuantity!!}
										</td>
										<td>
											{!!$product->ReorderPoint!!}
										</td>
										<td class="AguyInput">
											<input class="form-control" type="text" style="width: 150px" />
											<a class="aguy" href="#">aguy</a>
										</td>
								</tr>
							@endforeach
						</tbody>
					</table>
				</div>
			</div>
			<div class="text-center invoice-btn">
				<a class="btn btn-success btn-lg" id="request"><i class="fa fa-check"></i> Make Procurement Request </a>
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
		$(".aguy").click(function(){
			/*
			$(this).closest("tr").children().each(function(){
				console.log($(this).html());
			});
			*/
			var x = $(this).closest("tr").find("td.AguyInput").find("input").val();
			console.log(x);
		});
	</script>
	<script>

	  $(document).ready( function () {
	      $("#request").click( function () {
	          alert("PLACE HOLDER ALERT HERE");
	      });
	  });

	</script>
@endpush
