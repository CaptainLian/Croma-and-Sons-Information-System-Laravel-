  <!DOCTYPE html>
  <html lang="en">

  <!-- Mirrored from thevectorlab.net/flatlab/invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2016 03:22:31 GMT -->
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="{{URL::asset('img/favicon.html')}}">

    <title>Croma and Sons</title>

    <!-- Bootstrap core CSS -->
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/bootstrap-reset.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{URL::asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <!--right slidebar-->
    <link href="{{URL::asset('css/slidebars.css')}}" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/style-responsive.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('css/invoice-print.css')}}" rel="stylesheet" media="print">


    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
      <![endif]-->
    </head>

    <body ng-app='item'>

      <section id="container" class="">
        <!--header start-->
        <header class="header white-bg">
          <div class="sidebar-toggle-box">
            <i class="fa fa-bars"></i>
          </div>
          <!--logo start-->
          <a href="SalesDashboard.html" class="logo">Croma<span id="AND">and</span><span id="SONS">Sons</span></a>
          <!--logo end-->

          <div class="top-nav ">
            <ul class="nav pull-right top-menu">

              <!-- user login dropdown start-->
              <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">

                  <span class="username">Audrey Cobankiat</span>
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                  <div class="log-arrow-up"></div>
                  <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                  <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                  <li><a href="#"><i class="fa fa-bell-o"></i> Notification</a></li>
                  <li><a href="/logout"><i class="fa fa-key"></i> Log Out</a></li>
                </ul>
              </li>
              <!-- user login dropdown end -->
              
            </ul>
          </div>
        </header>
        <!--header end-->
        <!--sidebar start-->







        <aside>
          @yield('sidebar')
        </aside>

        <!--sidebar end-->
        <!--main content start-->
        <section id="main-content">
          <section class="wrapper">
            <!-- invoice start-->
            <section>
              <div class="panel panel-primary">
                <!--<div class="panel-heading navyblue"> INVOICE</div>-->
                <div class="panel-body">



                 <div class="row">
                  {!! Form::open(['url' => 'sales/deliveryReceiptInitial/submit']) !!}
                  <div class="form-group">
                    <label class="control-label col-md-1">Set Delivery Date</label>
                    <div class="col-md-2 col-xs-11">

                    {{Form::hidden('sdrID',$sdrID)}}
                      <div data-date-viewmode="years" data-date-format="yyyy-mm-dd" min='{{\Carbon\Carbon::today()}}'   class="input-append date dpYears">

                        {!! Form::date('date',\Carbon\Carbon::now(),['class'=>'form-control','type'=>'date','min'=>\Carbon\Carbon::today(),'size'=>'16']) !!}

                        <span class="input-group-btn add-on">
                          {!! Form::button('<i class="fa fa-calendar"></i>',
                          ['class' => 'btn ',
                          'style' => 'padding:6px 9px 6px 9px;background-color:#ff6c60;color:white'])!!}

                        </span>
                      </div>


                      <br>
                    </div>






                  </div>
                </div>





                <div class="row invoice-list">
                  <div class="text-center corporate-id">
                    <img src="img/vector-lab.jpg" alt="">
                    <h1>Sales Delivery Receipt</h1>
                  </div>
                  @yield('billing-info')
                  @yield('customer-info')
                  @yield('delivery-info')


                </div>
                <table class="table table-striped table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Material</th>
                      <th class="">Size</th>
                      <th class="">Unit</th>
                      <th class="">Quantity</th>

                      <th class="">Unit Price</th>
                      <th class="" style="text-align:right">Total</th>

                    </tr>
                  </thead>
                  <tbody>
                    @yield('materials')
                  </tbody>
                </table>
                <div class="row">
                  <div class="col-lg-4 invoice-block pull-right">
                    <ul class="unstyled amounts">
                      <li><strong>Subtotal amount :</strong><a id='sub'> </a></li>
                      <li><strong >Discount :</strong> <a id="dis">{{$dis}}</a>%</li>
                      {!! Form::hidden('discount',$dis) !!}
                      <li><strong> Total :</strong> <a id='tot'></a></li>
                    </ul>
                  </div>
                </div>
                <div class="text-center invoice-btn">
                  {!! Form::button('<i class="fa fa-check"></i>Submit Form',[
                  "class" => 'btn btn-danger btn-lg ',
                  'type' => 'submit',
                  'style' => 'font-weight:100;font-size:16px;font-family:Open Sans;background-color:#ff6c60;border-color:#ff6c60']) !!}
                  <a class="btn btn-info btn-lg" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>
                  {!! Form::close()!!}
                </div>
              </div>
            </div>
          </section>
          <!-- invoice end-->
        </section>
      </section>
      <!--main content end-->
      <!-- Right Slidebar start -->
      
      <!-- Right Slidebar end -->
      <!--footer start-->
      <footer class="site-footer">
        <div class="text-center">
          2013 &copy; Croma and Sans
          <a href="#" class="go-top">
            <i class="fa fa-angle-up"></i>
          </a>
        </div>
      </footer>
      <!--footer end-->
    </section>

    <!-- js placed at the end of the document so the pages load faster -->
    <script src="{{URL::asset('js/jquery.js')}}"></script>
    <script>
      var price = [];
      var quan = [];
      $('.pcs').each(function(){
        console.log(parseInt($(this).html()));
        price.push(parseInt($(this).html()));
        console.log(price);

      });
      $('.price').each(function(){
        console.log(parseInt($(this).html()));
        quan.push(parseInt($(this).html()));
        console.log(price);

      });
      total = 0;

      $('.price2').each(function(){
        console.log($(this).html());
        total += parseInt($(this).html());
      });
      $('#sub').html(total);
      total = total - (total *(parseInt($('#dis').html()))/100);
      $('#tot').html(total);
    </script>
     
    <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
    <script class="include" type="text/javascript" src="{{URL::asset('js/jquery.dcjqaccordion.2.7.js')}}"></script>
    <script src="{{URL::asset('js/jquery.scrollTo.min.js')}}"></script>
    <script src="{{URL::asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('js/respond.min.js')}}" ></script>




    <script type="text/javascript" src="{{URL::asset('assets/fuelux/js/spinner.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/bootstrap-fileupload/bootstrap-fileupload.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/bootstrap-datepicker/js/bootstrap-datepicker.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/bootstrap-daterangepicker/moment.min.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/bootstrap-daterangepicker/daterangepicker.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/bootstrap-colorpicker/js/bootstrap-colorpicker.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/bootstrap-timepicker/js/bootstrap-timepicker.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/jquery-mult  i-select/js/jquery.multi-select.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/jquery-multi-select/js/jquery.quicksearch.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/data-tables/jquery.dataTables.js')}}"></script>
    <script type="text/javascript" src="{{URL::asset('assets/data-tables/DT_bootstrap.js')}}"></script>





    <script src="{{URL::asset('js/advanced-form-components.js')}}"></script>

    <!--right slidebar-->
    <script src="{{URL::asset('js/slidebars.min.js')}}"></script>

    <!--common script for all pages-->
    <script src="{{URL::asset('js/common-scripts.js')}}"></script>

    <script>
    // var sample = angular.module('item',[], function($interpolateProvider){
    //     $interpolateProvider.startSymbol('{');
    //     $interpolateProvider.endSymbol('}');
    //   })a
    </script>



  </body>

  <!-- Mirrored from thevectorlab.net/flatlab/invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2016 03:22:32 GMT -->
  </html>
