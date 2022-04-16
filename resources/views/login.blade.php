<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Gamifikasi</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{ asset('') }}adminlte/plugins/fontawesome-free/css/all.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('') }}adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('') }}adminlte/dist/css/adminlte.min.css">
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="{{ asset('') }}adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
  <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript">
    function clickNotif(){
      document.getElementById('notifSwal').click();
    }
  </script>
  <style>
      body {
        background-image: url(adminlte/dist/img/bgcontentcollege.jpg); 
        height: 100%  /* Center and scale the image nicely */
        background-position: center;
        background-repeat: no-repeat;
        background-size: cover;
      }
      
      .content-wrapper {
          opacity: 0.2%;
      }

      .mt-2 {
          padding-top: 20vh;
      }

      .burger i{
          color: white
      }
  </style>
</head>
<body class="hold-transition sidebar-mini ">
  @if(session('success'))
		<div class="alert alert-success" id="notif" swalType="success" swalTitle="{{session('success')}}" style="display: none">{{session('success')}}</div>
		<script>window.addEventListener("load",clickNotif);</script>	
	@endif
	@if(session('notif'))
		<div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{session('notif')}}" style="display: none">{{session('notif')}}</div>
		<script>window.addEventListener("load",clickNotif);</script>	
	@endif
  <button type="button" id="notifSwal" class="btn btn-success notifSwal" style="display: none"></button>
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__wobble" src="adminlte/dist/img/g.png" alt="Gamifikasi" height="60" width="60">
    <H1><b>Gamifikasi</b></H1>
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar border-bottom-0"">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item burger">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
      <img src="adminlte/dist/img/g.png" alt="Gamifikasi Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
      <span class="brand-text font-weight-light">Gamifikasi</span>
    </a>
    <ul class="navbar-nav ml-auto">
    </ul>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        @error('password')
        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
        <script> window.addEventListener("load",clickNotif);</script>	
        @enderror
        @error('email')
        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
        <script> window.addEventListener("load",clickNotif);</script>	
        @enderror
      </nav>
      <!-- /.sidebar-menu -->
      <form action="{{ route('login')}}" method="POST">
        @csrf
    
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>

        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        
        <div>
            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Sign In">
        </div>
        <!-- /.col -->
      </form>
        <div>
          <a href="{{route('registrationForm')}}">Don't Have an Account?</a>
        </div>
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  
  <div class="content-wrapper">
  </div>
  <!-- /.content-wrapper -->
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
<!-- ChartJS -->
<script src="{{ asset('') }}adminlte/plugins/chart.js/Chart.min.js"></script>
<!-- SweetAlert2 -->
<script src="{{ asset('') }}adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
<script src="{{ asset('') }}adminlte/package/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="{{ asset('') }}adminlte/package/dist/sweetalert2.min.css">
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
</script>
</body>
</html>
