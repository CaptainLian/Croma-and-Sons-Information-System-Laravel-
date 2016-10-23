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
							<th>Last Order Date</th>
							<th>Total Purchased (current year)</th>
							<th>Edit</th>
							<th>Delete</th>
						</tr>
					</thead>
					<tbody>
						@foreach($suppliers as $supplier)
							<tr>
								<td>{!!$supplier->Name!!}</td>
								<td>{!!$supplier->Address!!}</td>
								<td>{!!$supplier->Landline!!}</td>
								<td>{!!$supplier->ContactPerson!!}</td>
								<td>N/A</td>
								<td>N/A</td>
								<td>N/A</td>
								<td>N/A</td>
							</tr>
						@endforeach
						<!--
						<tr class="">
							<td>
								<a href="ProcurementSupplierSpecific.html">Jondi Rose </a>
							</td>
							<td>Alfred Jondi Rose</td>
							<td>1234</td>
							<td class="center">super user</td>
							<td>2/12/16</td>
							<td>58888</td>
							<td>
								<a class="edit" href="javascript:;">Edit</a>
							</td>
							<td>
								<a class="delete" href="javascript:;">Delete</a>
							</td>
						</tr>
						-->
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
    <script src="/js/editable-table.js"></script>
@endpush