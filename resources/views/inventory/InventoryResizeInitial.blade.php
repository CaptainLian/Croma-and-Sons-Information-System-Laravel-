@extends('inventory.main',['active' => 'InventoryResize'])

@section('title')
Product Resizing
@endsection

@push('css')
  <!--dynamic table-->
  <link href="assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet">
  <link href="assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet">
  <link rel="stylesheet" href="assets/data-tables/DT_bootstrap.css">
@endpush

@section('main-content')
  <!-- page start-->
  <div class="row">
    <div class="col-sm-12">
      <section class="panel">
        <header class="panel-heading">
          <h1>Resize Initial</h1>
        </header>
        <div class="panel-body">
          <div class="adv-table">
            <table class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
                <tr>
                  <th class="col-md-1">Accomdation Status</th>
                  <th class="col-md-2">Sales Order ID</th>
                  <th class="col-md-3">Date Requested</th>
                  <th class="col-md-1">Details</th>
                  <th class="col-md-1">Approve</th>
                  <th class="col-md-1">Resize</th>
                </tr>
              </thead>
              <tbody>
                @foreach($pendingSalesOrders as $salesOrder)
                  <tr>
                    <td align="center"><a class="label label-success label-mini" href="#">Can Fully Accomodate</a></td>
                    <td align="right">{!!$salesOrder->SalesOrderID!!}</td>
                    <td align="center">{!!$salesOrder->DateCreated!!}</td>
                    <td align="center">
                      <button class="label label-info label-mini" data-toggle="modal" data-target="#myModal{!!$salesOrder->SalesOrderID!!}">View Details</button>
                      <div id="myModal{!!$salesOrder->SalesOrderID!!}" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    					<h4 class="modal-title">Sales Order:&nbsp;{!!$salesOrder->SalesOrderID!!}&nbsp;</h4>
                            </div><!-- .modal-header -->
                            <div class="modal-body">


                            </div><!-- .modal-body-->

                            <div class="modal-footer">

                            </div><!-- .modal-footer -->
                          </div><!-- .modal-content -->
                        </div><!-- .modal-dialog -->
                      </div><!-- .modal fade-->
                    </td>
                    <td align="center"><button class="label label-success label-mini">Approve</button></td>
                    <td align="center">
                      <button class="btn btn-info btn-md"><i class="fa fa-check"></i>&nbsp;Resize</a></button>
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
  <script type="text/javascript" language="javascript" src="assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="assets/data-tables/DT_bootstrap.js"></script>
  <script type="text/javascript" src="assets/data-tables/jquery.dataTables.js"></script>

  <!--right slidebar-->

  <!--dynamic table initialization -->
  <script src="js/dynamic_table_init.js"></script>
  <script src="js/dynamic_table_init2.js "></script>
  <!--common script for all pages-->
  <script src="js/common-scripts.js"></script>
@endpush
