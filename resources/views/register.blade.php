<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('')}}colorlib/fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('')}}colorlib/css/style.css">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="{{ asset('') }}adminlte/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
    <!-- JQuery -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script type="text/javascript">
    function clickNotif(){
      document.getElementById('notifSwal').click();
    }
  </script>
</head>
<body>
    @if(session('success'))
        <div class="alert alert-success" id="notif" swalType="success" swalTitle="{{session('success')}}" style="display: none">{{session('success')}}</div>
        <script>window.addEventListener("load",clickNotif);</script>	
    @endif
    @if(session('notif'))
        <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{session('notif')}}" style="display: none">{{session('notif')}}</div>
        <script>window.addEventListener("load",clickNotif);</script>	
    @endif
    <button type="button" id="notifSwal" class="btn btn-success notifSwal" style="display: none"></button>
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Sign up</h2>
                <form method="POST" action="{{url('registerUser')}}" class="register-form" id="register-form">
                    @csrf
                    <div class="form-group">
                        <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                        <input type="text" name="name" id="name" placeholder="Your Name" value="{{old('name')}}"/>
                    </div>
                    @error('name')
                    <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                    <script> window.addEventListener("load",clickNotif);</script>	
                    @enderror
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" name="email" id="email" placeholder="Your Email" value="{{old('email')}}"/>
                    </div>
                    @error('email')
                    <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                    <script> window.addEventListener("load",clickNotif);</script>	
                    @enderror
                    <div class="form-group">
                        <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" name="password" id="password" placeholder="Password"/>
                    </div>
                    @error('password')
                    <div class="alert alert-danger" id="notif" swalType="error" swalTitle="{{$message}}" style="display: none">{{session('notif')}}</div>
                    <script> window.addEventListener("load",clickNotif);</script>	
                    @enderror
                    <div class="form-group">
                        <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" id="password-confirm" name="password_confirmation" autocomplete="new-password" value="{{ old('password_confirmation') }}" placeholder="Repeat your password"/>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="submit" class="form-submit" value="Register"/>
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure><img src="{{asset('')}}colorlib/images/signup-image.jpg" alt="sing up image"></figure>
                <a href="{{route('login')}}" class="signup-image-link">I am already member</a>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="{{asset('')}}colorlib/vendor/jquery/jquery.min.js"></script>
    <script src="{{asset('')}}colorlib/js/main.js"></script>
    <!-- SweetAlert2 -->
    <script src="{{ asset('') }}adminlte/plugins/sweetalert2/sweetalert2.min.js"></script>
    <script src="{{ asset('') }}adminlte/package/dist/sweetalert2.min.js"></script>
    <link rel="stylesheet" href="{{ asset('') }}adminlte/package/dist/sweetalert2.min.css">
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
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->
</html>