<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>
    @yield('title')
  </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('') }}adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="{{ asset('') }}adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('') }}adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{ asset('') }}adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('') }}adminlte/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('') }}adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('') }}adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- Toastr -->
  <link rel="stylesheet" href="{{ asset('') }}adminlte/plugins/toastr/toastr.min.css">
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript">
    function clickNotif(){
      document.getElementById('notifSwal').click();
    }
  </script>
  @yield('head-script')
  <style>
    .navbar-white {
      background-color: #a12520;
    }
    .navbar-light .navbar-nav .nav-link {
      color: rgb(255 255 255);
    }

    [class*=sidebar-dark] .brand-link, [class*=sidebar-dark] .brand-link .pushmenu {
      color: rgba(44, 44, 44, 0.8);
      background-color: #e1e1e1;
    }
  </style>
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
  @if(session('success'))
		<div class="alert alert-success" id="notif" swalType="success" swalTitle="{{session('success')}}" style="display: none">{{session('success')}}</div>
		<script>window.addEventListener("load",clickNotif);</script>	
	@endif
	@if(session('notif'))
		<div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{session('notif')}}" style="display: none">{{session('notif')}}</div>
		<script>window.addEventListener("load",clickNotif);</script>	
	@endif
  <button type="button" id="notifSwal" class="btn btn-success notifSwal" style="display: none"></button>
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="{{ asset('') }}adminlte/dist/img/g.png" alt="Gamifikasi" height="60" width="60">
    <H1><b>Gamifikasi</b></H1>
  </div>
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('/dashboard')}}" class="nav-link">Home</a>
      </li>
    </ul>
    
    <ul class="navbar-nav ml-auto">
      <!-- Navbar Search -->
      <li class="nav-item">
        <a href="{{ route('logout')}}" onclick="event.preventDefault(); document.getElementById('formLogout').submit();" 
        style="text-decoration: none; color:white"><i class="fas fa-sign-out-alt"></i> Logout</a>
		    <form id="formLogout" action="{{ route('logout') }}" method="POST">@csrf</form>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->
  

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('') }}adminlte/dist/img/g.png" alt="Gamifikasi Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-bold">Gamifikasi</span>
      </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="{{ asset('') }}adminlte/dist/img/avatar.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">{{ auth()->user()->name}}</a>
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent nav-collapse-hide-child" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{ route('register')}}" class="nav-link">
                  <i class="nav-icon fas fa-user-plus"></i>
                  <p>Register New User</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('userList')}}" class="nav-link">
                  <i class="fas fa-user-friends nav-icon"></i>
                  <p>User List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Courses
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="{{route('addcourse')}}" class="nav-link">
                  <i class="fas fa-book-open nav-icon"></i>
                  <p>Add New Course</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="{{route('coursesList')}}" class="nav-link">
                  <i class="fas fa-list nav-icon"></i>
                  <p>Course List</p>
                </a>
              </li>
            </ul>
          </li>
          <li class="nav-item">
            <a href="{{ url('/leaderboards')}}" class="nav-link">
              <i class="nav-icon fas fa-award"></i>
              <p>
                Leaderboards
                <span class="right badge badge-danger">New</span>
              </p>
            </a>
          </li>
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    @yield('content')
  </div>
  <!-- /.content-wrapper -->
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->
<!-- jQuery -->
<script src="{{ asset('') }}adminlte/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{ asset('') }}adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('') }}adminlte/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('') }}adminlte/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{ asset('') }}adminlte/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{ asset('') }}adminlte/plugins/raphael/raphael.min.js"></script>
<script src="{{ asset('') }}adminlte/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{ asset('') }}adminlte/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('') }}adminlte/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('') }}adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('') }}adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('') }}adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('') }}adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('') }}adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('') }}adminlte/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('') }}adminlte/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('') }}adminlte/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('') }}adminlte/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('') }}adminlte/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('') }}adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('') }}adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('') }}adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="{{ asset('') }}adminlte/package/dist/sweetalert2.min.js"></script>
  <link rel="stylesheet" href="{{ asset('') }}adminlte/package/dist/sweetalert2.min.css">
<!-- Toastr -->
<script src="{{ asset('') }}adminlte/plugins/toastr/toastr.min.js"></script>
<!-- page script -->
<script>
  $('.notifSwal').click(function() {
      Swal.fire({
        icon: $('#notif').attr('swalType'),
        title: $('#notif').attr('swalTitle'),
        showConfirmButton: true,
        timer: 5000
      })
    });

  $(function () {
    $("#courseList").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#courseList_wrapper .col-md-6:eq(0)');
  });

  $(function () {
    $("#memberlist").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print"]
    }).buttons().container().appendTo('#memberlist_wrapper .col-md-6:eq(0)');
  });
</script>
</body>
</html>