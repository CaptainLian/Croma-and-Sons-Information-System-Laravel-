@extends('procurement.main')

@section('title')
Purchase Report
@endsection

@section('sidebar')
	@include('procurement.sidebar', ['active' => 'PurchaseReport'])
@endsection

@push('css')
 <!--dynamic table-->
<link href="/assets/advanced-datatable/media/css/demo_page.css" rel="stylesheet">
<link href="/assets/advanced-datatable/media/css/demo_table.css" rel="stylesheet">
<link rel="stylesheet" href="/assets/data-tables/DT_bootstrap.css">
<!--right slidebar-->
<link href="/css/slidebars.css" rel="stylesheet">
<!-- Custom styles for this template -->
<link href="/css/style.css" rel="stylesheet">
<link href="/css/style-responsive.css" rel="stylesheet">
@endpush

@section('main-content')
<!-- page start-->
<section class="panel">
  <header class="panel-heading tab-bg-dark-navy-blue ">
    <ul class="nav nav-tabs">
      <li class="active">
        <a data-toggle="tab" href="#home">Weekly</a>
      </li>
      <li class="">
        <a data-toggle="tab" href="#about">Monthly</a>
      </li>
      <li class="">
        <a data-toggle="tab" href="#profile">Yearly</a>
      </li>
    </ul>
  </header>
  <div class="panel-body">
    <div class="tab-content">
      <div id="home" class="tab-pane active">
        <div class="row">
          <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading">
                <h1>Weekly Purchase Report</h1> <br />
                For this current week
              </header>
              <div class="panel-body">
                <div class="adv-table">
                  <table class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                      <tr>
                        <th>Purchase Order #</th>
                        <th>Delivery Date (Year-Month-Day)</th>
                        <th>Supplier</th>
                        <th>Purchased Amount (Php)</th>
                        <th>Discount</th>
                        <th>Rejected Amount (Php)</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($weekly as $item)
                        <tr>
                          <td><a href="" data-toggle="modal" data-target="#myModal{!!$item->DeliveryReceipt!!}">{!!$item->DeliveryReceipt!!}</a></td>
                          <td>{!!$item->DeliveryDate!!}</td>
                          <td>{!!$item->Supplier!!}</td>
                          <td>{!!$item->PurchasedAmount!!}</td>
                          <td>{!!$item->Discount!!}</td>
                          <td>{!!$item->RejectedAmount!!}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
      <div id="about" class="tab-pane">
        <div class="row">
          <div class="col-sm-12">
            <section class="panel">
              <header class="panel-heading">
                <h1>Monthly Purchase Report</h1> <br />
                For this current month {!!date('F')!!}
              </header>
              <div class="panel-body">
                <div class="adv-table">
                  <table class="display table table-bordered table-striped" id="dynamic-table">
                    <thead>
                      <tr>
                        <th>Purchase Order #</th>
                        <th>Delivery Date (Year-Month-Day)</th>
                        <th>Supplier</th>
                        <th>Purchased Amount (Php)</th>
                        <th>Discount</th>
                        <th>Rejected Amount (Php)</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($monthly as $item)
                        <tr>
                          <td><a href="" data-toggle="modal" data-target="#myModal{!!$item->DeliveryReceipt!!}">{!!$item->DeliveryReceipt!!}</a></td>
                          <td>{!!$item->DeliveryDate!!}</td>
                          <td>{!!$item->Supplier!!}</td>
                          <td>{!!$item->PurchasedAmount!!}</td>
                          <td>{!!$item->Discount!!}</td>
                          <td>{!!$item->RejectedAmount!!}</td>
                        </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div>
            </section>
          </div>
        </div>
      </div>
      <div id="profile" class="tab-pane">
        <div class="row">
          <div class="col-sm-12">
            <section class="panel">
            <header class="panel-heading">
                <h1>Monthly Purchase Report</h1> <br />
                For this current year {!!date('Y')!!}
              </header>
            <div class="panel-body">
              <div class="adv-table">
                <table class="display table table-bordered table-striped" id="dynamic-table">
                  <thead>
                      <tr>
                        <th>Purchase Order #</th>
                        <th>Delivery Date (Year-Month-Day)</th>
                        <th>Supplier</th>
                        <th>Purchased Amount (Php)</th>
                        <th>Discount</th>
                        <th>Rejected Amount (Php)</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($yearly as $item)
                        <tr>
                          <td><a href="" data-toggle="modal" data-target="#myModal{!!$item->DeliveryReceipt!!}">{!!$item->DeliveryReceipt!!}</a></td>
                          <td>{!!$item->DeliveryDate!!}</td>
                          <td>{!!$item->Supplier!!}</td>
                          <td>{!!$item->PurchasedAmount!!}</td>
                          <td>{!!$item->Discount!!}</td>
                          <td>{!!$item->RejectedAmount!!}</td>
                        </tr>
                      @endforeach
                    </tbody>
                </table>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</div>
</section>
<!-- page end-->
@foreach($purchaseItems as $id => $items)
  <div id="myModal{!!$id!!}" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button aria-hidden="true" data-dismiss="modal" class="close" type="button"></button>
          <h4 class="modal-title"><strong>Purchase Order:&nbsp;{!!$id!!}</strong></h4>
        </div><!-- .modal-header -->

        <div class="modal-body">
          <table align="center">
            <thead>
              <tr>
                <th>&nbsp;</th>
                <th>Material&nbsp;</th>
                <th>Size&nbsp;</th>
                <th>Board Feet&nbsp;</th>
                <th>Quantity&nbsp;</th>
              </tr>
            </thead>

            <tbody>
              <tr>
                  <?php $count = 1; ?>
                @foreach($items as $item)
                  <td align="right">{!!$count!!}</td>
                  <td align="left">{!!$item->Material!!}</td>
                  <td align="center">{!!$item->Size!!}</td>
                  <td align="right">{!!$item->BoardFeet!!}</td>
                  <td align="right">{!!$item->Quantity!!}</td>
                  <?php $count++; ?>
                @endforeach
              </tr>
            </tbody>
          </table>
        </div><!-- .modal-body-->
        <div class="modal-footer">
        </div><!-- .modal-footer -->
      </div><!-- .modal-content -->
    </div><!-- .modal-dialog -->
  </div><!-- .modal fade-->  
@endforeach


@endsection

@push('javascript')
	<script type="text/javascript" language="javascript" src="/assets/advanced-datatable/media/js/jquery.dataTables.js"></script>
	<script type="text/javascript" src="/assets/data-tables/DT_bootstrap.js"></script>
	<script src="/js/respond.min.js"></script>
	<!--right slidebar-->
	<script src="/js/slidebars.min.js"></script>
	<!--dynamic table initialization -->
	<script src="/js/dynamic_table_init.js"></script>
	<script src="/js/dynamic_table_init2.js"></script>
	<!--common script for all pages-->
	<script src="/js/common-scripts.js"></script>
	<!-- Mirrored from thevectorlab.net/flatlab/dynamic_table.html
	by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2016 03:21:13 GMT
  -->
@endpush
