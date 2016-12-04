@extends('inventory.main', ['active' => 'dashboard'])

@section('title')
Inventory Dashboard
@endsection

@push('css')

@endpush

@section('main-content')
<!--state overview start-->
<header class="panel-heading">
  <h2>Inventory Dashboard</h2>
</header>

<section class="panel">
  <div class="panel-body">
    <div class="container-fluid">

      <div class="row">
        <div class="col-md-12">
          <div id="graph1" style="background-color: white; height: 40%;">

          </div><!-- graph -->
        </div><!-- col-md-12 -->
      </div><!-- row -->

      <div class="row">
        <div class="col-md-6">
          <div id="graph2" style="background-color: blue; height: 40%;" >

          </div><!-- graph -->
        </div><!-- col-md-6 -->


        <div class="col-md-6">
          <div id="graph3" style="background-color: white; height: 40%;" >

          </div><!-- graph -->
        </div><!-- col-md-6 -->

      </div><!-- row -->

    </div><!-- container-fluid -->
  </div><!-- panel-body -->
</section>
@endsection


@push('javascript')
  <script type="text/javascript" src="/js/highcharts.js"></script>
  <script type="text/javascript" src="/js/modules/no-data-to-display.js"></script>
  <script type="text/javascript" src="/js/modules/exporing.js"></script>
  <script type="text/javascript" src="/js/modules/drilldown.js"></script>
  <script type="text/javascript" src="/js/modules/grouped-categories.js"></script>
  <script type="text/javascript">
    $(document).ready(function(){
      $('#graph1').highcharts({
        chart: {
            type: "column",
        },
        title: {
            useHTML: true,
            text: '<span class="chart-title"><strong>Top {!!$productCount!!} Products That Require Attention</strong></span>'
        },
        subtitle:{
          useHTML:true,
          text: 'Products nearing reorder or below safety stock'
        },
        yAxis: {
          title: {
            text: 'Pieces'
          }
        },
        series: [{
            name: 'Current Stock Quantity',
            type: 'column',
            data: [@foreach($stockQuantities as $quantity)
              {!!$quantity!!},
            @endforeach],
            tooltip: {
                valueSuffix: ' pieces'
            }
        }, {
            name: 'Reorder Point',
            type: 'column',
            data:[@foreach($reorderPoints as $quantity)
              {!!$quantity!!},
            @endforeach],
            tooltip: {
                valueSuffix: ' pieces'
            }
        }, {
            name: 'Safety Stock',
            type: 'column',
            data: [@foreach($safetyStocks as $quantity)
              {!!$quantity!!},
            @endforeach],
            tooltip: {
                valueSuffix: ' pieces'
            }
        }],
        xAxis: {
          categories:
          [@foreach($materials as $material => $sizes)
             {
              useHTML: true,
              name: "<strong>{!!$material!!}</strong>",
              categories:
                [@foreach($sizes as $size)
                  "{!!$size->Size!!}",
                @endforeach]
            },
          @endforeach]

        }
      });
    });
  </script>

  <script type="text/javascript">
  //custom select box
    $(function(){
      $('select.styled').customSelect();
    });
  </script>
@endpush
