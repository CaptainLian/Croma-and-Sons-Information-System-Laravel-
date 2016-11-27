@extends('procurement.main')

@section('title')
Procurement Dashboard
@endsection

@push('css')
	<link href="/css/highchars.css" />
@endpush

@section('sidebar')
	@include('procurement.sidebar', ['active' => 'Dashboard'])
@endsection

@section('main-content')
	<header class="panel-heading">
		<h1>Procurement Dashboard</h1>
	</header>

	<div class="row state-overview">
		<div class="col-lg-3 col-sm-6">
			<section class="panel">
        <a href="/procurement/SelectProductPurchaseOrder">
  				<div class="symbol blue">
              <i class="fa fa-file"></i>
  				</div><!-- symbo-blue -->
        </a href="#">
				<div class="value">
					<h1>{!!$countProductNeedProcurement!!}</h1>
					<p>Products to Procure</p>
				</div>
			</section>
		</div>
		<div class="col-lg-3 col-sm-6">
			<section class="panel">
        <a href="/procurement/DeliveryReceipt">
  				<div class="symbol blue">
              <i class="fa fa-file-text-o"></i>
  				</div><!-- symbol-blue -->
        </a>
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
						<div style="height: 400;" id="graph2" class="chart"></div>


					</div>
				</section>
			</div>
		</div>
		<!-- page end-->
	</div>
	<!--state overview end-->
@endsection

@push('javascript')
	<script src="/js/highcharts.src.js"></script>
	<script src="/modules/exporting.src.js"></script>
	<script src="/modules/data.src.js"></script>
	<script src="/modules/drilldown.src.js"></script>
	<script src="/modules/no-data-to-display.src.js"></script>

	<script >

		$(function () {
		    // Create the chart
		    Highcharts.chart('graph1', {
		        chart: {
		            type: /* creampie */'pie'
		        },
		        title: {
		            text: 'Procurement Reject Ratio'
		        },
		        subtitle: {
		            text: 'Of this current month:<u>{!!date('F')!!}</u>'
		        },
		        plotOptions: {
		            series: {
		                dataLabels: {
		                    enabled: true,
		                    format: '{point.name}: {point.y:.0f}'
		                }
		            }
		        },

		        tooltip: {
		            headerFormat: '<span style="font-size:11px">{series.name}</span><br>',
		            pointFormat: '<span style="color:{point.color}">{point.name}</span>: <b>{point.percentage:.2f}%</b> of total<br/>'
		        },
		        series: [{
		        	name: 'Reject vs Accept',
		        	data: [
								@if($procurementRatio->Reject > 0){
			        		name: 'Reject',
			        		y: {!!$procurementRatio->Reject!!},
			        		color: 'red',
			        		drilldown: 'Reject',
		        		},@endif

							@if($procurementRatio-> Accept > 0){
		        		name: 'Accept',
		        		y: {!!$procurementRatio->Accept!!},
		        		color: 'green',
		        		drilldown: 'Accept',
		        	}@endif]
		        }],
		        drilldown: {
		            series: [@if($procurementRatio->Reject > 0){
			            	name: 'Reject',
			            	id: 'Reject',
			            	data: [
			            		@foreach($procurementRatioSuppliersReject AS $supplier)
												@if($supplier[1] > 0)
													['{!!$supplier[0]!!}', {!!$supplier[1]!!}],
												@endif
			            		@endforeach
			            	]
		            	},@endif
									@if($procurementRatio->Accept > 0){
			            	name: 'Accept',
			            	id: 'Accept',
			            	data: [
			            		@foreach($procurementRatioSuppliersAccept AS $supplier)
												@if($supplier[1] > 0)
													['{!!$supplier[0]!!}', {!!$supplier[1]!!}],
												@endif
			            		@endforeach
			            	]}@endif
								]
		        }
		    });
		});


		$(function () {
		    Highcharts.chart('graph2', {
		        title: {
		            text: 'Monthly Purchases in ₱esos',
		            //x: -20 //center
		        },
		        subtitle:{
		        	text: 'Of this current year {!!date('Y')!!}'
		        },
		        xAxis: {
		            categories: [
		            	@foreach($monthlyExpense as $month => $expense)
		            		'{!!$month!!}',
		            	@endforeach
		            ]
		        },
		        yAxis: {
		            title: {
		                text: 'Purchases (Php)'
		            },
		        },
		        tooltip: {
		            valueSuffix: ' ₱'
		        },
		        legend: {
		            layout: 'vertical',
		            align: 'right',
		            verticalAlign: 'middle',
		            borderWidth: 0
		        },
		        series: [{
		            name: 'Purchases',
		            data: [
		            	@foreach($monthlyExpense as $expense)
		            		{!!$expense!!},
		            	@endforeach
		            ]
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
