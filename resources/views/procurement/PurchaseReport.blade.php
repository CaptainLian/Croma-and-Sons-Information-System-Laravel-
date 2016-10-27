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
                        <h1>Purchase Report</h1>
                      </header>
                      <div class="panel-body">
                        <div class="adv-table">
                          <table class="display table table-bordered table-striped" id="dynamic-table">
                            <thead>
                              <tr>
                                <th>Delivery Receipt #</th>
                                <th>Delivery Receipt Date</th>
                                <th>Supplier</th>
                                <th>Total Amount</th>
                                <th>Total Discount</th>
                                <th>Total Reject (In Pesos)</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr class="gradeX">
                                <td>
                                  <a href="ProcurementDeliveryReceiptSpecific.html">Trident</a>
                                </td>
                                <td>Internet Explorer 4.0</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                              </tr>
                              <tr class="gradeC">
                                <td>
                                  <a href="ProcurementDeliveryReceiptSpecific.html">Trident</a>
                                </td>
                                <td>Internet Explorer 5.0</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                              </tr>
                              <tr class="gradeC">
                                <td>
                                  <a href="ProcurementDeliveryReceiptSpecific.html">Trident</a>
                                </td>
                                <td>Internet Explorer 5.0</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                              </tr>
                              <tr class="gradeX">
                                <td><a href="ProcurementDeliveryReceiptSpecific.html">Trident</a></td>
                                <td>Internet Explorer 4.0</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                                <td>Win 95+</td>
                              </tr>
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
                    <header class="panel-heading">Sales Report</header>
                    <div class="panel-body">
                      <div class="adv-table">
                        <table class="display table table-bordered table-striped" id="dynamic-table">
                          <thead>
                            <tr>
                              <th>Invoice #</th>
                              <th>Invoice Date</th>
                              <th></th>
                              <th>Total Amount</th>
                              <th>Total Discount</th>
                              <th>Total Reject (In Pesos)</th>
                            </tr>
                          </thead>
                          <tbody>
                            <tr class="gradeX">
                              <td>Trident</td>
                              <td>Internet Explorer 4.0</td>
                              <td>Win 95+</td>
                              <td>Win 95+</td>
                              <td>Win 95+</td>
                              <td>Win 95+</td>
                            </tr>
                            <tr class="gradeC">
                              <td>Trident</td>
                              <td>Internet Explorer 5.0</td>
                              <td>Win 95+</td>
                              <td>Win 95+</td>
                              <td>Win 95+</td>
                              <td>Win 95+</td>
                            </tr>
                            <tr class="gradeC">
                              <td>Trident</td>
                              <td>Internet Explorer 5.0</td>
                              <td>Win 95+</td>
                              <td>Win 95+</td>
                              <td>Win 95+</td>
                              <td>Win 95+</td>
                            </tr>
                            <tr class="gradeX">
                              <td>Trident</td>
                              <td>Internet Explorer 4.0</td>
                              <td>Win 95+</td>
                              <td>Win 95+</td>
                              <td>Win 95+</td>
                              <td>Win 95+</td>
                            </tr>
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
                  <header class="panel-heading">Sales Report</header>
                  <div class="panel-body">
                    <div class="adv-table">
                      <table class="display table table-bordered table-striped" id="dynamic-table">
                        <thead>
                          <tr>
                            <th>Invoice #</th>
                            <th>Invoice Date</th>
                            <th></th>
                            <th>Total Amount</th>
                            <th>Total Discount</th>
                            <th>Total Reject (In Pesos)</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr class="gradeX">
                            <td>Trident</td>
                            <td>Internet Explorer 4.0</td>
                            <td>Win 95+</td>
                            <td>Win 95+</td>
                            <td>Win 95+</td>
                            <td>Win 95+</td>
                          </tr>
                          <tr class="gradeC">
                            <td>Trident</td>
                            <td>Internet Explorer 5.0</td>
                            <td>Win 95+</td>
                            <td>Win 95+</td>
                            <td>Win 95+</td>
                            <td>Win 95+</td>
                          </tr>
                          <tr class="gradeC">
                            <td>Trident</td>
                            <td>Internet Explorer 5.0</td>
                            <td>Win 95+</td>
                            <td>Win 95+</td>
                            <td>Win 95+</td>
                            <td>Win 95+</td>
                          </tr>
                          <tr class="gradeX">
                            <td>Trident</td>
                            <td>Internet Explorer 4.0</td>
                            <td>Win 95+</td>
                            <td>Win 95+</td>
                            <td>Win 95+</td>
                            <td>Win 95+</td>
                          </tr>
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