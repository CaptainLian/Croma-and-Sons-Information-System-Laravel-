@extends('procurement.main')

@section('title')
Procurement Dashboard
@endsection

@push('css')
	<link href="/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen">
	<link href="/css/highchars.css" />
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
					<div class="panel-body">
						<div id="graph1"></div>
					</div>
				</section>
			</div>
			<div class="col-lg-6">
				<section class="panel">
					<div class="panel-body">
						<div id="graph2" class="chart"></div>
					</div>
				</section>
			</div>
		</div>
		<!-- page end-->
	</div>
	<!--state overview end-->
@endsection

@push('javascript')
	<script src="/js/highcharts.js"></script>
	<script src="/modules/exporting.js"></script>
	<script src="/modules/data.js"></script>
	<script src="/modules/drilldown.js"></script>

	<script >
		$(function () {
		    // Create the chart
		    Highcharts.chart('graph1', {
		        chart: {
		            type: 'pie'
		        },
		        title: {
		            text: 'Browser market shares. January, 2015 to May, 2015'
		        },
		        subtitle: {
		            text: 'Click the slices to view versions. Source: netmarketshare.com.'
		        },
		        plotOptions: {
		            series: {
		                dataLabels: {
		                    enabled: true,
		                    format: '{point.name}: {point.y:.1f}%'
		                }
		            }
		        },

		        tooltip: {
		            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
		            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
		        },
		        series: [{
		            name: 'Brands',
		            colorByPoint: true,
		            data: [{
		                name: 'Microsoft Internet Explorer',
		                y: 56.33,
		                drilldown: 'Microsoft Internet Explorer'
		            }, {
		                name: 'Chrome',
		                y: 24.03,
		                drilldown: 'Chrome'
		            }, {
		                name: 'Firefox',
		                y: 10.38,
		                drilldown: 'Firefox'
		            }, {
		                name: 'Safari',
		                y: 4.77,
		                drilldown: 'Safari'
		            }, {
		                name: 'Opera',
		                y: 0.91,
		                drilldown: 'Opera'
		            }, {
		                name: 'Proprietary or Undetectable',
		                y: 0.2,
		                drilldown: null
		            }]
		        }],
		        drilldown: {
		            series: [{
		                name: 'Microsoft Internet Explorer',
		                id: 'Microsoft Internet Explorer',
		                data: [
		                    ['v11.0', 24.13],
		                    ['v8.0', 17.2],
		                    ['v9.0', 8.11],
		                    ['v10.0', 5.33],
		                    ['v6.0', 1.06],
		                    ['v7.0', 0.5]
		                ]
		            }, {
		                name: 'Chrome',
		                id: 'Chrome',
		                data: [
		                    ['v40.0', 5],
		                    ['v41.0', 4.32],
		                    ['v42.0', 3.68],
		                    ['v39.0', 2.96],
		                    ['v36.0', 2.53],
		                    ['v43.0', 1.45],
		                    ['v31.0', 1.24],
		                    ['v35.0', 0.85],
		                    ['v38.0', 0.6],
		                    ['v32.0', 0.55],
		                    ['v37.0', 0.38],
		                    ['v33.0', 0.19],
		                    ['v34.0', 0.14],
		                    ['v30.0', 0.14]
		                ]
		            }, {
		                name: 'Firefox',
		                id: 'Firefox',
		                data: [
		                    ['v35', 2.76],
		                    ['v36', 2.32],
		                    ['v37', 2.31],
		                    ['v34', 1.27],
		                    ['v38', 1.02],
		                    ['v31', 0.33],
		                    ['v33', 0.22],
		                    ['v32', 0.15]
		                ]
		            }, {
		                name: 'Safari',
		                id: 'Safari',
		                data: [
		                    ['v8.0', 2.56],
		                    ['v7.1', 0.77],
		                    ['v5.1', 0.42],
		                    ['v5.0', 0.3],
		                    ['v6.1', 0.29],
		                    ['v7.0', 0.26],
		                    ['v6.2', 0.17]
		                ]
		            }, {
		                name: 'Opera',
		                id: 'Opera',
		                data: [
		                    ['v12.x', 0.34],
		                    ['v28', 0.24],
		                    ['v27', 0.17],
		                    ['v29', 0.16]
		                ]
		            }]
		        }
		    });
		});


		$(function () {
		    Highcharts.chart('graph2', {
		        title: {
		            text: 'Monthly Total Purchases in Pesos',
		            x: -20 //center
		        },
		        xAxis: {
		            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',
		                'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
		        },
		        yAxis: {
		            title: {
		                text: 'Purchases (Php)'
		            },
		            plotLines: [{
		                value: 0,
		                width: 1,
		                color: '#808080'
		            }]
		        },
		        tooltip: {
		            valueSuffix: 'Pesos'
		        },
		        legend: {
		            layout: 'vertical',
		            align: 'right',
		            verticalAlign: 'middle',
		            borderWidth: 0
		        },
		        series: [{
		            name: 'Purchases',
		            data: [7.0, 6.9, 9.5, 14.5, 18.2, 21.5, 25.2, 26.5, 23.3, 18.3, 13.9, 9.6]
		        }]
		    });
		});
	</script>

	<!--
	<script>
		//custom select box    
        $(function(){
            $('select.styled').customSelect();
        });
	</script>

	-->
@endpush
