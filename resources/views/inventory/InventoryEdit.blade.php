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
								<th class="col-md-2">Checked Quantity</th>
								<th class="col-md-2"> Remarks </th>
							</tr>
						</thead>
						<tbody>
							@foreach($inventory as $product)
								<tr class="gradeX">
									<td>{!!$product->Material!!}</td>
									<td>{!!$product->Size!!}</td>
									<td align="right">{!!$product->StockQuantity!!}</td>
									<td><input type="text" class="form-control" /></td>
									<td><button data-toggle="modal" data-target="#myModal" class="btn btn-info" style="margin-left: 15%">Input Remark</button></td>

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
				<h4 class="modal-title"> Remarks</h4>
			</div><!-- modal-header -->
			<div class="modal-body">
				<form role="form">
					<div class="form-group">
						<textarea style="height: 20%; width: 500px">
						</textarea>
					</div><!-- form-group -->
				</form>
			</div><!-- modal-body -->
			<div class="modal-footer">
					<button type="cancel" data-dismiss="modal" class="btn btn-danger"><i class="fa fa-window-close"></i>Cancel</button>
					<button type="submit" data-dismiss="modal" class="btn btn-success"><i class="fa fa-check"></i>Submit</button>
			</div><!-- modal-footer -->
		</div>
	</div>
</div>
@endsection

@push('javascript')
	<script type="text/javascript" src="/js/dynamic_table_init.js"></script>
  <script type="text/javascript" src="/js/dynamic_table_init2.js "></script>
  <script type="text/javascript" src="/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
  <script type="text/javascript" src="/assets/data-tables/jquery.dataTables.js"></script>
@endpush
