<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>


    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Custom styles for ourApp-->
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Verify Your Email Address</div>
                      <div class="card-body">
                       @if (session('resent'))
                            <div class="alert alert-success" role="alert">
                               {{ __('A fresh verification link has been sent to your email address.') }}
                           </div>
                       @endif
                       <a href="{{ url('/reset-password/'.$token) }}">Click Here</a>
                   </div>
               </div>
           </div>
       </div>
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <!-- Bootstrap 4 -->
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <!-- AdminLTE App -->
    <script src="{{ asset('dist/js/adminlte.min.js') }}"></script>
</body>

</html>
