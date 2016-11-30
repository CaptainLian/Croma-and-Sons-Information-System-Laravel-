<html>
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Mosaddek">
    <meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    @stack('meta')

    <link rel="shortcut icon" href="/img/favicon.html">

    <title>@yield('title', 'Inventory')</title>

    <!-- Bootstrap core CSS -->
    <link href="/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/bootstrap-reset.css" rel="stylesheet">
    <!--external css-->
    <link href="/assets/font-awesome/css/font-awesome.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/owl.carousel.css" type="text/css">
    <link href="/css/slidebars.css" rel="stylesheet">
    <!-- ???? -->
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-responsive.css" rel="stylesheet">

    @stack('css')

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 tooltipss and media
    queries -->
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
    <section id="container">
      <!--header start-->
      @include('master.navbar')
      <!--header end-->

      <!--sidebar start-->
      @include('inventory.sidebar')
      <!--sidebar end-->

      <!--main content start-->
      <section id="main-content">
        <section class="wrapper">
          <!--state overview start-->

          @yield('main-content')

        </section>
      </section>
      <!--main content end-->

      <!--footer start-->
      <footer class="site-footer">
        <div class="text-center">2016 © Croma and Sons
          <a href="#" class="go-top">
            <i class="fa fa-angle-up"></i>
          </a>
        </div>
      </footer>
      <!--footer end-->
    </section>

      <!-- js placed at the end of the document so the pages load faster -->
      <script type="text/javascript" src="/js/jquery.js"></script>
      <script src="/js/jquery-ui-1.9.2.custom.min.js"></script>
      <script src="/js/jquery-migrate-1.2.1.min.js"></script>
      <script type="text/javascript" src="/js/bootstrap.min.js"></script>
      <script type="text/javascript" src="/js/jquery.dcjqaccordion.2.7.js"></script>
      <script type="text/javascript" src="/js/jquery.scrollTo.min.js"></script>
      <script type="text/javascript" src="/js/jquery.nicescroll.js"></script>
      <script type="text/javascript" src="/js/jquery.sparkline.js"></script>
      <script type="text/javascript" src="/assets/jquery-multi-select/js/jquery.quicksearch.js"></script>
      <script type="text/javascript" src="/js/jquery.customSelect.min.js"></script>
      <script type="text/javascript" src="/js/respond.min.js"></script>
      <script type="text/javascript" src="/js/slidebars.min.js"></script>

      <script type="text/javascript" src="/js/common-scripts.js"></script>

      @stack('javascript')

      <!-- Mirrored from thevectorlab.net/flatlab/index.html by HTTrack
      Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2016 03:18:36 GMT -->
    </body>
  </html>
