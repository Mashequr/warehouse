<!DOCTYPE html>
<html lang="en">
	<head>
	  <meta charset="utf-8">
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <title>WareHouse | @yield('title')</title>

	  <!-- Google Font: Source Sans Pro -->
	  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
	  <!-- Font Awesome -->
	  <link rel="stylesheet" href="{{ asset('/storage/plugins/fontawesome-free/css/all.min.css') }}">
	  <!-- Ionicons -->
	  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
	  <!-- Tempusdominus Bootstrap 4 -->
	  <link rel="stylesheet" href="{{ asset('/storage/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
	  <!-- iCheck -->
	  <link rel="stylesheet" href="{{ asset('/storage/plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
	  <!-- JQVMap -->
	  <link rel="stylesheet" href="{{ asset('/storage/plugins/jqvmap/jqvmap.min.css') }}">
	  <!-- Theme style -->
	  <link rel="stylesheet" href="{{ asset('/storage/dist/css/adminlte.min.css') }}">
	  <!-- overlayScrollbars -->
	  <link rel="stylesheet" href="{{ asset('/storage/plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
	  <!-- Daterange picker -->
	  <link rel="stylesheet" href="{{ asset('/storage/plugins/daterangepicker/daterangepicker.css') }}">
	  <!-- summernote -->
	  <link rel="stylesheet" href="{{ asset('/storage/plugins/summernote/summernote-bs4.min.css') }}">

      <script src="{{ asset('/storage/plugins/jquery/jquery.min.js') }}"></script>
      <!-- jQuery UI 1.11.4 -->
      <script src="{{ asset('/storage/plugins/jquery-ui/jquery-ui.min.js') }}"></script>

      <link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css"  />
      <link rel="stylesheet" href="{{ asset('storage/css/custom.css') }}"  />
      <script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
      <script type="text/javascript">
            $(document).ready( function () {
                $('#myTable').DataTable();
            } );
    </script>


	</head>

	<body class="hold-transition sidebar-mini layout-fixed">
		<div class="wrapper">

			<div class="preloader flex-column justify-content-center align-items-center">
				<img class="animation__shake" src="{{ asset('/storage/dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
			</div>

			<nav class="main-header navbar navbar-expand navbar-white navbar-light">

				<ul class="navbar-nav ml-auto">
					<li class="nav-item dropdown">
						<a class="nav-link" data-toggle="dropdown" href="#">
							<h5>Account  <i class="nav-icon fas fa-th"></i></h5>
						</a>
						<div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
							<a href="{{ route('admin_profile') }}" class="dropdown-item">
								<div class="media">
									Profile
								</div>
							</a>
							<div class="dropdown-divider"></div>
							<button type="submit" form="logout-form" class="dropdown-item">
								<div class="media">
									Logout
								</div>
							</button>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
						</div>
					</li>
				</ul>
			</nav>

			<aside class="main-sidebar sidebar-dark-primary elevation-4">
				<a href="{{ route('admin_dashboard') }}" class="brand-link">
				  <img src="{{ asset('storage/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
				  <span class="brand-text font-weight-light">WareHouse</span>
				</a>

				<div class="sidebar">
					<div class="user-panel mt-3 pb-3 mb-3 d-flex">
						<div class="image">
                            @if(Auth()->user()->avatar)
							<img src="{{ asset(Auth()->user()->avatar)}}" class="img-circle elevation-2" alt="User Image">
                            @else
                            <img src="{{ asset('storage/user.png')}}" class="img-circle elevation-2" alt="User Image">
                            @endif
						</div>
						<div class="info">
							<a href="#" class="d-block">{{ Auth()->user()->name }}</a>
						</div>
					</div>

					<nav class="mt-2">
						<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
							<li class="nav-item menu-open">
								<a href="{{ route('admin_dashboard') }}" class="nav-link active">
									<i class="nav-icon fas fa-tachometer-alt"></i>
									<p>Dashboard</p>
								</a>
							</li>

							<li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon fas fa-copy"></i>
									<p>Categories<i class="fas fa-angle-left right"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="{{ route('admin_addcategory') }}" class="nav-link">
											<i class="far fa-circle nav-icon"></i>
											<p>Add Categories</p>
										</a>
									</li>
								</ul>
							</li>
                            <li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon fas fa-copy"></i>
									<p>Clients<i class="fas fa-angle-left right"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="{{ route('admin_addclients') }}" class="nav-link">
											<i class="far fa-circle nav-icon"></i>
											<p>Add Clients</p>
										</a>
									</li>
								</ul>
							</li>
                            <li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon fas fa-copy"></i>
									<p>Stock Management<i class="fas fa-angle-left right"></i></p>
								</a>
								<ul class="nav nav-treeview">
									<li class="nav-item">
										<a href="{{ route('admin_addstock') }}" class="nav-link">
											<i class="far fa-circle nav-icon"></i>
											<p>Add Stock</p>
										</a>
									</li>
                                    <li class="nav-item">
										<a href="{{ route('admin_viewstocks') }}" class="nav-link">
											<i class="far fa-circle nav-icon"></i>
											<p>View Current Stock</p>
										</a>
									</li>
                                    <li class="nav-item">
										<a href="{{ route('admin_dischargedstocks') }}" class="nav-link">
											<i class="far fa-circle nav-icon"></i>
											<p>View Discharged Stock</p>
										</a>
									</li>
								</ul>
							</li>
                            {{-- <li class="nav-item">
								<a href="#" class="nav-link">
									<i class="nav-icon fas fa-th"></i>
									<p>Stock<span class="right badge badge-danger">1</span></p>
								</a>
							</li> --}}
						</ul>
					</nav>
				</div>
			</aside>
            <!-- Main content -->
			@yield('content')
            <!-- Main content -->

			<footer class="main-footer">
				<strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">WareHouse</a>.</strong>
				All rights reserved.
			</footer>
			<aside class="control-sidebar control-sidebar-dark"></aside>



			<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
			<script>
			  $.widget.bridge('uibutton', $.ui.button)
			</script>
			<!-- Bootstrap 4 -->
			<script src="{{ asset('/storage/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
			<!-- ChartJS -->
			<script src="{{ asset('/storage/plugins/chart.js/Chart.min.js') }}"></script>
			<!-- Sparkline -->
			<script src="{{ asset('/storage/plugins/sparklines/sparkline.js') }}"></script>
			<!-- JQVMap -->
			<script src="{{ asset('/storage/plugins/jqvmap/jquery.vmap.min.js') }}"></script>
			<script src="{{ asset('/storage/plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
			<!-- jQuery Knob Chart -->
			<script src="{{ asset('/storage/plugins/jquery-knob/jquery.knob.min.js') }}"></script>
			<!-- daterangepicker -->
			<script src="{{ asset('/storage/plugins/moment/moment.min.js') }}"></script>
			<script src="{{ asset('/storage/plugins/daterangepicker/daterangepicker.js') }}"></script>
			<!-- Tempusdominus Bootstrap 4 -->
			<script src="{{ asset('/storage/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
			<!-- Summernote -->
			<script src="{{ asset('/storage/plugins/summernote/summernote-bs4.min.js') }}"></script>
			<!-- overlayScrollbars -->
			<script src="{{ asset('/storage/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>
			<!-- AdminLTE App -->
			<script src="{{ asset('/storage/dist/js/adminlte.js') }}"></script>
			<!-- AdminLTE for demo purposes -->
			<script src="{{ asset('/storage/dist/js/demo.js') }}"></script>
			<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
			<script src="{{ asset('/storage/dist/js/pages/dashboard.js') }}"></script>
	</body>
</html>
