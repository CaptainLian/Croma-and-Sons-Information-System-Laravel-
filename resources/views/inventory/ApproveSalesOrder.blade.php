@extends('inventory.main', ['active' => 'SalesOrder'])

@section('title')
Sales Order Approval
@endsection

@push('css')
  <link href="/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet">
  <link href="/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet">
  <link rel="stylesheet" href="/assets/data-tables/DT_bootstrap.css">
@endpush

@section('main-content')
  <div id="alert">

  </div><!-- #alert -->

  <div class="row">
    <div class="col-md-12">
      <section class="panel">
        <header class="panel-heading">
          <h1>Sales Order Approval</h1>
        </header><!-- .panel-heading-->
        <div class="panel-body">
          <div class="adv-table">
            <table class="display table table-bordered table-striped" id="dynamic-table">
              <thead>
                <tr>
                  <th class="col-md-1">Accomdation Status</th>
                  <th class="col-md-1">Sales Order ID</th>
                  <th class="col-md-2">Customer</th>
                  <th class="col-md-2">Date Requested</th>
                  <th class="col-md-1">Details</th>
                  <th class="col-md-1">Approve</th>
                </tr>
              </thead>

              <tbody>
                @foreach($pendingSalesOrders as $salesOrder)
                  <tr>
                    <td align="center"><span class="label label-success label-mini">Can Fully Accomodate</span></td>
                    <td align="right">{!!$salesOrder->SalesOrderID!!}</td>
                    <td align="left">{!!$salesOrder->CustomerName!!}</td>
                    <td align="center">{!!$salesOrder->DateCreated!!}</td>
                    <td align="center">
                      <button class="label label-info label-mini" data-toggle="modal" data-target="#myModal{!!$salesOrder->SalesOrderID!!}" >View Details</button>

                      <div id="myModal{!!$salesOrder->SalesOrderID!!}" class="modal fade">
                        <div class="modal-dialog">
                          <div class="modal-content">
                            <div class="modal-header">
                              <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
                    					<h4 class="modal-title">Sales Order:&nbsp;{!!$salesOrder->SalesOrderID!!}&nbsp;</h4>
                            </div><!-- .modal-header -->
                            <div class="modal-body">
                              <table>
                                <thead>
                                  <tr>
                                      <th>Material</th>
                                      <th>Size</th>
                                      <th>Quantity Requested</th>
                                  </tr>
                                </thead>

                                <tbody>
                                  <tr>
                                    @foreach($pendingItems[$salesOrder->SalesOrderID] as $item)
                                      <td>{!!$item->Material!!}</td>
                                      <td>{!!$item->Size!!}</td>
                                      <td>{!!$item->Quantity!!}</td>
                                    @endforeach

                                  </tr>
                                </tbody>
                              </table>

                              {!!var_dump($pendingItems[$salesOrder->SalesOrderID])!!}
                            </div><!-- .modal-body-->

                            <div class="modal-footer">

                            </div><!-- .modal-footer -->
                          </div><!-- .modal-content -->
                        </div><!-- .modal-dialog -->
                      </div><!-- .modal fade-->
                    </td>

                    <td align="center"><span class="label label-success label-mini">Approve</span></td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div><!-- .adv-table -->
        </div><!-- .panel-body -->
      </section><!-- .panel -->
    </div><!-- .col-md-12 -->
  </div><!-- .row -->
@endsection

@push('javascript')
  <script type="text/javascript" src="/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
  <script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
  <script type="text/javascript" src="/assets/data-tables/jquery.dataTables.js"></script>
  <script type="text/javascript" src="/js/inventory/ApproveSalesOrderTable.js"></script>
@endpush
