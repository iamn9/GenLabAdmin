<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>@yield('title')</title>
	<!-- Tell the browser to be responsive to screen width -->
	<meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	<!-- Bootstrap 3.3.7 -->
	<link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
	<!-- Font Awesome -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
	<!-- Ionicons -->
	<link rel="stylesheet" href="{{ asset('css/ionicons.min.css') }}">
	<!-- Theme style -->
	<link rel="stylesheet" href="{{ asset('css/AdminLTE.min.css') }}">
		<!-- AdminLTE Skins. Choose a skin from the css/skins
		folder instead of downloading all of them to reduce the load. -->
		<link rel="stylesheet" href="{{ asset('css/_all-skins.min.css') }}">
		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body class="hold-transition skin-blue sidebar-mini">
		<div class="wrapper">
			<header class="main-header">
				<!-- Logo -->
				<a href="{{url('home')}}" class="logo">
					<!-- mini logo for sidebar mini 50x50 pixels -->
					<span class="logo-mini">GLS</span>
					<!-- logo for regular state and mobile devices -->
					<span class="logo-lg">GenLab System</span>
				</a>
				<!-- Header Navbar: style can be found in header.less -->
				<nav class="navbar navbar-static-top">
					<!-- Sidebar toggle button-->
					<a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
						<span class="sr-only">Toggle navigation</span>
					</a>
					<div class="navbar-custom-menu">
						<ul class="nav navbar-nav">
							<li class="header">
								<a href="#">
									<i class="fa fa-user"></i>
									{{Auth::user()->name}}
								</a>
							</li>
							<li class="header">
								<a href="{{url('logout')}}" class="dropdown-toggle"
								onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
								<i class="fa fa-fw fa-power-off"></i> 
								Log Out
							</a>
							<form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</li>
					</ul>
				</div>
			</nav>
		</header>
		<aside class="main-sidebar">
			<!-- sidebar: style can be found in sidebar.less -->
			<section class="sidebar">
				<!-- search form -->
			<!-- 	<form action="#" method="get" class="sidebar-form">
					<div class="input-group">
						<input type="text" name="q" class="form-control" placeholder="Search...">
						<span class="input-group-btn">
							<button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
							</button>
						</span>
					</div>
				</form> -->
				<!-- /.search form -->
				<!-- sidebar menu: : style can be found in sidebar.less -->
				<ul class="sidebar-menu">
					<li class="header">MAIN NAVIGATION</li>
					<li class="treeview active"><a href="{{url('home')}}"><i class="fa fa-dashboard"></i> <span>Home</span></i></a></li>
					<li class="treeview"><a href="{{url('/item')}}"><i class="fa fa-flask"></i> <span>Items</span></a></li>
					<li class="header">TRANSACTIONS</li>
					<li class="treeview"><a href="{{url('/transaction/user/active')}}"><i class="fa fa-shopping-cart"></i> <span>Active Transaction</span></a></li>
					<li class="treeview"><a href="{{url('/cart')}}"><i class="fa fa-shopping-cart"></i> <span>Cart</span></a></li>
					<li class="treeview"><a href="{{url('/transaction/user/history')}}"><i class="fa fa-history"></i> <span>History</span></a></li>
				</ul>
			</section>
			<!-- /.sidebar -->
		</aside>
		<div class="content-wrapper">
			@yield('content')
		</div>
	</div>
	<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
		<div class = 'AjaxisModal'>
		</div>
	</div>
	<!-- Compiled and minified JavaScript -->
	<script src="{{ asset('js/jquery-2.1.1.min.js') }}"></script>
	<script src="{{ asset('js/bootstrap.min.js') }}"></script>
	<script src="{{ asset('js/app.min.js') }}"></script>
	<script src="{{ asset('js/demo.js') }}"></script>
	<script> var baseURL = "{{ URL::to('/') }}"</script>
	<script src = "{{URL::asset('js/AjaxisBootstrap.js') }}"></script>
	<script src = "{{URL::asset('js/scaffold-interface-js/customA.js') }}"></script>
	<script src="{{ asset('js/pusher.min.js') }}"></script>
	<script>
		// pusher log to console.
		Pusher.logToConsole = true;
		// here is pusher client side code.
		var pusher = new Pusher("{{env("PUSHER_KEY")}}", {
			encrypted: true
		});
		var channel = pusher.subscribe('test-channel');
		channel.bind('test-event', function(data) {
		// display message coming from server on dashboard Notification Navbar List.
		$('.notification-label').addClass('label-warning');
		$('.notification-menu').append(
			'<li>\
			<a href="#">\
				<i class="fa fa-users text-aqua"></i> '+data.message+'\
			</a>\
		</li>'
		);
	});
</script>
</body>
</html>
