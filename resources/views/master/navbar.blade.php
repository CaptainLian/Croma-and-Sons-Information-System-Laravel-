<header class="header white-bg">
	<div class="sidebar-toggle-box">
		<i class="fa fa-bars"></i>
	</div>
	<!--logo start-->
	<a href="#" class="logo">Croma<span id="AND">and</span><span id="SONS">Sons</span></a>
	<!--logo end-->
	<div class="top-nav ">
		<!--search & user info start-->
		<ul class="nav pull-right top-menu">
			<!-- user login dropdown start-->
			<li class="dropdown">
				<a data-toggle="dropdown" class="dropdown-toggle" href="#">
				<span class="username">@if(Session::has('active')) {!!Session::get('username')!!} @else Croma Employee @endif </span>
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
						<a href="/logout"><i class="fa fa-key"></i> Log Out</a>
					</li>


				</ul>
			</li>
			<!-- user login dropdown end -->
			@yield('navbar-dropdown-content');
		</ul>
		<!--search & user info end-->
	</div>
</header>