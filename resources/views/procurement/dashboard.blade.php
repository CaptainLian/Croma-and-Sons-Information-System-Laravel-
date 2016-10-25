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
	<script>
		var failed  = 30;
		var success = 50;

		var data = [
            {
                label: "United States",
                data: [[1990, 18.9], [1991, 18.7], [1992, 18.4], [1993, 19.3], [1994, 19.5], [1995, 19.3], [1996, 19.4], [1997, 20.2], [1998, 19.8], [1999, 19.9], [2000, 20.4], [2001, 20.1], [2002, 20.0], [2003, 19.8], [2004, 20.4]]
            },
            {
                label: "Germany",
                data: [[1990, 12.4], [1991, 11.2], [1992, 10.8], [1993, 10.5], [1994, 10.4], [1995, 10.2], [1996, 10.5], [1997, 10.2], [1998, 10.1], [1999, 9.6], [2000, 9.7], [2001, 10.0], [2002, 9.7], [2003, 9.8], [2004, 9.79]]
            },
            {
                label: "Denmark",
                data: [[1990, 9.7], [1991, 12.1], [1992, 10.3], [1993, 11.3], [1994, 11.7], [1995, 10.6], [1996, 12.8], [1997, 10.8], [1998, 10.3], [1999, 9.4], [2000, 8.7], [2001, 9.0], [2002, 8.9], [2003, 10.1], [2004, 9.80]]
            },
            {
                label: "Sweden",
                data: [[1990, 5.8], [1991, 6.0], [1992, 5.9], [1993, 5.5], [1994, 5.7], [1995, 5.3], [1996, 6.1], [1997, 5.4], [1998, 5.4], [1999, 5.1], [2000, 5.2], [2001, 5.4], [2002, 6.2], [2003, 5.9], [2004, 5.89],]
            },
           
        ];

	</script>
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
