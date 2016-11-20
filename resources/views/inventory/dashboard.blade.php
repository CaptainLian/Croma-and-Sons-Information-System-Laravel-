@extends('inventory.main', ['active' => 'dashboard'])

@section('title')
Inventory Dashboard
@endsection

@push('css')
    <link href="/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet">
    <link href="/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/data-tables/DT_bootstrap.css">
    <link href="/assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen">
@endpush

@section('main-content')
  <!--state overview start-->
  <header class="panel-heading">
    <h1>Inventory Dashboard</h1>
    <br>
  </header>
  <div class="row">
    <div class="col-sm-12">
      <section class="panel">
        <div class="panel-body">
          <div class="adv-table">
            <table class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
                <tr>
                  <th>Sales Order #</th>
                  <th>Order Date</th>
                  <th></th>
                </tr>
              </thead>
              <tbody>

                @foreach($pendingSalesOrders as $order)
                  <tr class="gradeX">
                    <td> 
                      <a href="#">{!!$order->SalesOrderID!!}</a>
                    </td>

                    <td>
                      {!!$order->DateCreated!!}
                    </td>
                   
                   <th>
                      <a href="ProcurementEncodeSupplierDeliveryReceipt.html">
                        <button type="button" class="btn btn-success">Approve</button>
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
  </div>
  <!--state overview end-->
@endsection


@push('javascript')
  <script type="text/javascript" src="/assets/chart-master/Chart.js"></script>
  <script type="text/javascript" src="/assets/data-tables/jquery.dataTables.js"></script>
  <script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
  <script type="text/javascript" src="/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="/js/dynamic_table_init.js"></script>
  <script type="text/javascript" src="/js/dynamic_table_init2.js"></script>
  <script type="text/javascript" src="/assets/flot/jquery.flot.js"></script>
  <script type="text/javascript" src="/assets/flot/jquery.flot.resize.js"></script>
  <script type="text/javascript" src="/assets/flot/jquery.flot.pie.js"></script>
  <script type="text/javascript" src="/assets/flot/jquery.flot.stack.js"></script>
  <script type="text/javascript" src="/assets/flot/jquery.flot.crosshair.js"></script>
  <script type="text/javascript" src="/js/count.js"></script>
  <script type="text/javascript" src="/js/flot-chart2.js"></script>

  <script type="text/javascript">
  //custom select box
    $(function(){
      $('select.styled').customSelect();
    });
  </script>
@endpush