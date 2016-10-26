<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from thevectorlab.net/flatlab/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2016 03:18:36 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
    <link rel="shortcut icon" href="img/favicon.html">

    <title> Croma and Sons</title>

    <!-- Bootstrap core CSS -->
    <link href="{{URL::asset('css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/bootstrap-reset.css')}}" rel="stylesheet">
    <!--external css-->
    <link href="{{URL::asset('assets/font-awesome/css/font-awesome.css')}}" rel="stylesheet" />
    <link href="{{URL::asset('assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css')}}" rel="stylesheet" type="text/css" media="screen"/>
    <link rel="stylesheet" href="{{URL::asset('css/owl.carousel.css')}}" type="text/css">

    <!--right slidebar-->
    <link href="{{URL::asset('css/slidebars.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->

    <link href="{{URL::asset('css/style.css')}}" rel="stylesheet">
    <link href="{{URL::asset('css/style-responsive.css')}}" rel="stylesheet" />



    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media queries -->
    <!--[if lt IE 9]>
      <script src="js/html5shiv.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>

  <body>

  <section id="container" >
      <!--header start-->
      <header class="header white-bg">
              <div class="sidebar-toggle-box">
                  <i class="fa fa-bars"></i>
              </div>
            <!--logo start-->
            <a href="SalesDashboard.html" class="logo">Croma<span id="AND">and</span><span id="SONS">Sons</span></a>
            <!--logo end-->
            
            <div class="top-nav ">
                <!--search & user info start-->
                <ul class="nav pull-right top-menu">

                    <!-- user login dropdown start-->
                    <li class="dropdown">
                        <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                            <img alt="" src="img/avatar1_small.jpg">
                            <span class="username">Jhon Doue</span>
                            <b class="caret"></b>
                        </a>
                        <ul class="dropdown-menu extended logout">
                            <div class="log-arrow-up"></div>
                            <li><a href="#"><i class=" fa fa-suitcase"></i>Profile</a></li>
                            <li><a href="#"><i class="fa fa-cog"></i> Settings</a></li>
                            <li><a href="#"><i class="fa fa-bell-o"></i> Notification</a></li>
                            <li><a href="\logout"><i class="fa fa-key"></i> Log Out</a></li>
                        </ul>
                    </li>
                   
                    <!-- user login dropdown end -->
                </ul>
                <!--search & user info end-->
            </div>
        </header>
      <!--header end-->
      <!--sidebar start-->
      <aside>
          @section('sidebar-contents')

          @show
      </aside>
      <!--sidebar end-->
      <!--main content start-->
      <section id="main-content">
          <section class="wrapper">
              <!--state overview start-->
              
			  
			  <div class="row state-overview">
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol blue">
                              <i class="fa fa-user"></i>
                          </div>
                          <div class="value">
                              <h1 class="count">
                                  0
                              </h1>
                              <p>Pending Sales Order</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol green">
                              <i class="fa fa-tags"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count2">
                                  0
                              </h1>
                              <p>Approved Sales Order</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="panel">
                          <div class="symbol yellow">
                              <i class="fa fa-shopping-cart"></i>
                          </div>
                          <div class="value">
                              <h1 class=" count3">
                                  0
                              </h1>
                              <p>Pending Delivery Receipts</p>
                          </div>
                      </section>
                  </div>
                  
              </div>
			  
			  
					  
					  <div class="flot-chart">
                  <!-- page start-->
                
                  <div class="row">
				  
				  
				    <div class="col-lg-6">
                          <section class="panel">
                              <header class="panel-heading">
                                  Success vs Failed
                              </header>
                              <div class="panel-body">
                                  <div id="graph2" class="chart"></div>
                              </div>
                          </section>
                      </div>
				  
                      <div class="col-lg-6">
                          <section class="panel">
                              <header class="panel-heading">
                                  Monthly Sales
                              </header>
                              <div class="panel-body">
                                  <div id="chart-2" class="chart"></div>
                              </div>
                          </section>
                      </div>
                      
                  </div>
                  
                  <div class="row">
                     
                    
                  </div>
                 
                  <!-- page end-->
              </div>
			  
              <!--state overview end-->

              
           
              
         

          </section>
      </section>
      <!--main content end-->

      <!-- Right Slidebar start -->
      
      <!-- Right Slidebar end -->

      <!--footer start-->
      <footer class="site-footer">
          <div class="text-center">
              2016 &copy; Croma and Sons
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
    <script src="{{URL::asset('js/jquery.nicescroll.js')}}" type="text/javascript"></script>
    <script src="{{URL::asset('js/jquery.sparkline.js')}}" type="text/javascript"></script>
  
    <script src="{{URL::asset('js/jquery.customSelect.min.js')}}" ></script>
    <script src="{{URL::asset('js/respond.min.js')}}" ></script>  
    <script src="{{URL::asset('assets/chart-master/Chart.js')}}"></script>
   
   
    <!--right slidebar-->
    <script src="{{URL::asset('js/slidebars.min.js')}}"></script>
	
	
	
	  <script src="{{URL::asset('assets/flot/jquery.flot.js')}}"></script>
    <script src="{{URL::asset('assets/flot/jquery.flot.resize.js')}}"></script>
    <script src="{{URL::asset('assets/flot/jquery.flot.pie.js')}}"></script>
    <script src="{{URL::asset('assets/flot/jquery.flot.stack.js')}}"></script>
    <script src="{{URL::asset('assets/flot/jquery.flot.crosshair.js')}}"></script>


    <!--common script for all pages-->
    <script src="{{URL::asset('js/common-scripts.js')}}"></script>

    <!--script for this page-->

    <script>
      @yield('count')

    </script>
	   <script>
      @yield('main-chart') 
     </script>

	
  <script>

     

      //custom select box

      $(function(){
          $('select.styled').customSelect();
      });

      

  </script>

  </body>

<!-- Mirrored from thevectorlab.net/flatlab/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2016 03:18:36 GMT -->
</html>
