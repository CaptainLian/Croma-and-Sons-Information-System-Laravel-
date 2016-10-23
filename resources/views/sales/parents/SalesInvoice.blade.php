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

    <body>

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

                  <span class="username">Jhon Doue</span>
                  <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                  <div class="log-arrow-up"></div>
                  <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                  <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                  <li><a href="#"><i class="fa fa-bell-o"></i> Notification</a></li>
                  <li><a href="login.html"><i class="fa fa-key"></i> Log Out</a></li>
                </ul>
              </li>
              <!-- user login dropdown end -->
              <li class="sb-toggle-right">
                <i class="fa  fa-align-right"></i>
              </li>
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
                  <div class="row invoice-list">
                    <div class="text-center corporate-id">
                      <img src="img/vector-lab.jpg" alt="">

                      <h1>Sales Invoice</h1>
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
                    <th class="">B/F</th>
                    <th class="">Unit Price</th>
                    <th class="">Discount</th>    
                    <th>Total</th>
                  </tr>
                </thead>
                <tbody>
                  @yield('sales-item')
                   
                </tbody>
              </table>
              <div class="row">
                <div class="col-lg-4 invoice-block pull-right">
                  <ul class="unstyled amounts">
                    <li><strong>Sub - Total amount :</strong> $6820</li>
                    <li><strong>Discount :</strong> 10%</li>
                    <li><strong>VAT :</strong> -----</li>
                    <li><strong>Grand Total :</strong> $6138</li>
                  </ul>
                </div>
              </div>
              <div class="text-center invoice-btn">
                <a class="btn btn-danger btn-lg"><i class="fa fa-check"></i> Submit Invoice </a>
                <a class="btn btn-info btn-lg" onclick="javascript:window.print();"><i class="fa fa-print"></i> Print </a>

              </div>
            </div>
          </div>
        </section>
        <!-- invoice end-->
      </section>
    </section>
    <!--main content end-->
    <!-- Right Slidebar start -->
    <div class="sb-slidebar sb-right sb-style-overlay">
      <h5 class="side-title">Online Customers</h5>
      <ul class="quick-chat-list">
        <li class="online">
          <div class="media">
            <a href="#" class="pull-left media-thumb">
              <img alt="" src="img/chat-avatar2.jpg" class="media-object">
            </a>
            <div class="media-body">
              <strong>John Doe</strong>
              <small>Dream Land, AU</small>
            </div>
          </div><!-- media -->
        </li>
        <li class="online">
          <div class="media">
            <a href="#" class="pull-left media-thumb">
              <img alt="" src="img/chat-avatar.jpg" class="media-object">
            </a>
            <div class="media-body">
              <div class="media-status">
                <span class=" badge bg-important">3</span>
              </div>
              <strong>Jonathan Smith</strong>
              <small>United States</small>
            </div>
          </div><!-- media -->
        </li>

        <li class="online">
          <div class="media">
            <a href="#" class="pull-left media-thumb">
              <img alt="" src="img/pro-ac-1.png" class="media-object">
            </a>
            <div class="media-body">
              <div class="media-status">
                <span class=" badge bg-success">5</span>
              </div>
              <strong>Jane Doe</strong>
              <small>ABC, USA</small>
            </div>
          </div><!-- media -->
        </li>
        <li class="online">
          <div class="media">
            <a href="#" class="pull-left media-thumb">
              <img alt="" src="img/avatar1.jpg" class="media-object">
            </a>
            <div class="media-body">
              <strong>Anjelina Joli</strong>
              <small>Fockland, UK</small>
            </div>
          </div><!-- media -->
        </li>
        <li class="online">
          <div class="media">
            <a href="#" class="pull-left media-thumb">
              <img alt="" src="img/mail-avatar.jpg" class="media-object">
            </a>
            <div class="media-body">
              <div class="media-status">
                <span class=" badge bg-warning">7</span>
              </div>
              <strong>Mr Tasi</strong>
              <small>Dream Land, USA</small>
            </div>
          </div><!-- media -->
        </li>
      </ul>
      <h5 class="side-title"> pending Task</h5>
      <ul class="p-task tasks-bar">
        <li>
          <a href="#">
            <div class="task-info">
              <div class="desc">Dashboard v1.3</div>
              <div class="percent">40%</div>
            </div>
            <div class="progress progress-striped">
              <div style="width: 40%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="40" role="progressbar" class="progress-bar progress-bar-success">
                <span class="sr-only">40% Complete (success)</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="#">
            <div class="task-info">
              <div class="desc">Database Update</div>
              <div class="percent">60%</div>
            </div>
            <div class="progress progress-striped">
              <div style="width: 60%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="60" role="progressbar" class="progress-bar progress-bar-warning">
                <span class="sr-only">60% Complete (warning)</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="#">
            <div class="task-info">
              <div class="desc">Iphone Development</div>
              <div class="percent">87%</div>
            </div>
            <div class="progress progress-striped">
              <div style="width: 87%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="20" role="progressbar" class="progress-bar progress-bar-info">
                <span class="sr-only">87% Complete</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="#">
            <div class="task-info">
              <div class="desc">Mobile App</div>
              <div class="percent">33%</div>
            </div>
            <div class="progress progress-striped">
              <div style="width: 33%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="80" role="progressbar" class="progress-bar progress-bar-danger">
                <span class="sr-only">33% Complete (danger)</span>
              </div>
            </div>
          </a>
        </li>
        <li>
          <a href="#">
            <div class="task-info">
              <div class="desc">Dashboard v1.3</div>
              <div class="percent">45%</div>
            </div>
            <div class="progress progress-striped active">
              <div style="width: 45%" aria-valuemax="100" aria-valuemin="0" aria-valuenow="45" role="progressbar" class="progress-bar">
                <span class="sr-only">45% Complete</span>
              </div>
            </div>

          </a>
        </li>
        <li class="external">
          <a href="#">See All Tasks</a>
        </li>
      </ul>
    </div>
    <!-- Right Slidebar end -->
    <!--footer start-->
    <footer class="site-footer">
      <div class="text-center">
        2013 &copy; FlatLab by VectorLab.
        <a href="#" class="go-top">
          <i class="fa fa-angle-up"></i>
        </a>
      </div>
    </footer>
    <!--footer end-->
  </section>

  <!-- js placed at the end of the document so the pages load faster -->
  <script src="{{URL::asset('js/jquery.js')}}"></script>
  <script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
  <script class="include" type="text/javascript" src="{{URL::asset('js/jquery.dcjqaccordion.2.7.js')}}"></script>
  <script src="{{URL::asset('js/jquery.scrollTo.min.js')}}"></script>
  <script src="{{URL::asset('js/jquery.nicescroll.js"')}} type="text/javascript"></script>
  <script src="{{URL::asset('js/respond.min.js')}}" ></script>

  <!--right slidebar-->
  <script src="{{URL::asset('js/slidebars.min.js')}}"></script>

  <!--common script for all pages-->
  <script src="{{URL::asset('js/common-scripts.js')}}"></script>


</body>

<!-- Mirrored from thevectorlab.net/flatlab/invoice.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2016 03:22:32 GMT -->
</html>
