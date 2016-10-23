@extends('procurement.main')

@section('title')
Procurement Dashboard
@endsection

@push('css')
	<link href="/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen">
@endpush

@section('sidebar')
	@include('procurement.sidebar', ['active' => 'Dashboard'])
@endsection

@section('main-content')
	<header class="panel-heading">
		<h1>Procurement Dashboard</h1>
		<br>
		<span class="tools pull-right">
			<a href="javascript:;" class="fa fa-chevron-down"></a>
			<a href="javascript:;" class="fa fa-times"></a>
		</span>
	</header>

	<div class="row state-overview">
		<div class="col-lg-3 col-sm-6">
			<section class="panel">
				<div class="symbol blue">
					<i class="fa fa-user"></i>
				</div>
				<div class="value">
					<h1>{!!$countProductNeedProcurement!!}</h1>
					<p>Products to Procure</p>
				</div>
			</section>
		</div>
		<div class="col-lg-3 col-sm-6">
			<section class="panel">
				<div class="symbol blue">
					<i class="fa fa-user"></i>
				</div>
				<div class="value">
				<!-- count -->
					<h1>{!!$pendingPurchaseOrderCount!!}</h1>
					<p>Pending Purchase Orders</p>
				</div>
			</section>
		</div>
	</div>
	<div class="flot-chart">
		<!-- page start-->
		<div class="row">
			<div class="col-lg-6">
				<section class="panel">
					<header class="panel-heading">
						<div class="row"> 
							<h3>Reject vs Total Purchases</h3>
						</div>
						<font size="2%" align="center">(of current month: <u>{!!date('F')!!}</u>)</font>
					</header>
					<div class="panel-body">
						<div id="graph2" class="chart"></div>
					</div>
				</section>
			</div>
			<div class="col-lg-6">
				<section class="panel">
					<header class="panel-heading">
						<h3>Monthly Procurement</h3>
					</header>
					<div class="panel-body">
						<div id="chart-2" class="chart"></div>
					</div>
				</section>
			</div>
		</div>
		<!-- page end-->
	</div>
	<!--state overview end-->
@endsection

@push('javascript')
	<script src="/assets/chart-master/Chart.js"></script>
	<!--right slidebar-->
	
	<script src="/assets/flot/jquery.flot.js"></script>
	<script src="/assets/flot/jquery.flot.resize.js"></script>
	<script src="/assets/flot/jquery.flot.pie.js"></script>
	<script src="/assets/flot/jquery.flot.stack.js"></script>
	<script src="/assets/flot/jquery.flot.crosshair.js"></script>
	<!--script for this page-->
	<script src="/js/count.js"></script>
	<script src="/js/flot-chart2.js"></script>
	<script>
		//custom select box    
        $(function(){
            $('select.styled').customSelect();
        });
	</script>
@endpush
