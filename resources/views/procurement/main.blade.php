<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="Mosaddek">
		<meta name="keyword" content="FlatLab, Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">
		<link rel="shortcut icon" href="img/favicon.html">
		<title>Procurement Dashboard</title>
		<!-- Bootstrap core CSS -->
		<link href="css/bootstrap.min.css" rel="stylesheet">
		<link href="css/bootstrap-reset.css" rel="stylesheet">
		<!--external css-->
		<link href="assets/font-awesome/css/font-awesome.css" rel="stylesheet">
		<link href="assets/jquery-easy-pie-chart/jquery.easy-pie-chart.css" rel="stylesheet" type="text/css" media="screen">
		<link rel="stylesheet" href="css/owl.carousel.css" type="text/css">
		<!--right slidebar-->
		<link href="css/slidebars.css" rel="stylesheet">
		<!-- Custom styles for this template -->
		<link href="css/style.css" rel="stylesheet">
		<link href="css/style-responsive.css" rel="stylesheet">


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



								<span class="username">Jhon Doue</span>

								<b class="caret"></b>

							</a>
							<ul class="dropdown-menu extended logout">
								<div class="log-arrow-up"></div>
								<li>
									<a href="#"><i class=" fa fa-suitcase"></i>Profile</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-cog"></i> Settings</a>
								</li>
								<li>
									<a href="#"><i class="fa fa-bell-o"></i> Notification</a>
								</li>
								<li>
									<a href="login.html"><i class="fa fa-key"></i> Log Out</a>
								</li>
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
				<div id="sidebar" class="nav-collapse ">
					<!-- sidebar menu start-->
					<ul class="sidebar-menu" id="nav-accordion">

						@include('procurement\sidebar', ['active' => $active])

						<!--multi level menu start-->
						<!-- sidebar menu end-->
					</ul>
				</div>
			</aside>
			<!--sidebar end-->
			<!--main content start-->
			<section id="main-content">
				<section class="wrapper">
					@yield('main_content')
				</section>
			</section>
			<!--main content end-->
			<!-- Right Slidebar start -->
			<!-- Right Slidebar end -->
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
		<script src="js/jquery.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script class="include" type="text/javascript" src="js/jquery.dcjqaccordion.2.7.js"></script>
		<script src="js/jquery.scrollTo.min.js"></script>
		<script src="js/jquery.nicescroll.js" type="text/javascript"></script>
		<script src="js/jquery.sparkline.js" type="text/javascript"></script>
		<script src="js/jquery.customSelect.min.js"></script>
		<script src="js/respond.min.js"></script>
		<script src="assets/chart-master/Chart.js"></script>
		<!--right slidebar-->
		<script src="js/slidebars.min.js"></script>
		<script src="assets/flot/jquery.flot.js"></script>
		<script src="assets/flot/jquery.flot.resize.js"></script>
		<script src="assets/flot/jquery.flot.pie.js"></script>
		<script src="assets/flot/jquery.flot.stack.js"></script>
		<script src="assets/flot/jquery.flot.crosshair.js"></script>
		<!--common script for all pages-->
		<script src="js/common-scripts.js"></script>
		<!--script for this page-->
		<script src="js/count.js"></script>
		<script src="js/flot-chart2.js"></script>

		@stack('javascript')

		<script>
		  //custom select box

			$(function(){
				$('select.styled').customSelect();
			});
		</script>
	<!-- Mirrored from thevectorlab.net/flatlab/index.html by HTTrack
		Website Copier/3.x [XR&CO'2014], Tue, 23 Aug 2016 03:18:36 GMT -->


	</body>
</html>