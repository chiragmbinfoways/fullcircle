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
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
              <a href="../../index2.html" class="h1">{{env('APP_NAME')}}</a>
            </div>
            <div class="card-body">
              <p class="login-box-msg">You are only one step a way from your new password, recover your password now.</p>
              <form action="{{ route('resetPassword.post') }}" method="post">
                @csrf
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session()->get('message') }}
                    </div>
                @endif
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
                <input type="hidden" name="token" value="{{ $token }}">
                <div class="input-group mb-3">
                    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" autocomplete="email" placeholder="Email"  value="{{ $email ?? old('email') }}" autofocus>
                    <div class="input-group-append">
                      <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                      </div>
                    </div>
                  </div>
                  @if ($errors->has('email'))
                          <div class="text-danger">{{ $errors->first('email') }}</div>
                      @endif
                <div class="input-group mb-3">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" autocomplete="new-password">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                @if ($errors->has('password'))
                        <div class="text-danger">{{ $errors->first('password') }}</div>
                    @endif
                <div class="input-group mb-3">
                  <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm Password">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                @if ($errors->has('password_confirmation'))
                        <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                    @endif
                <div class="row">
                  <div class="col-12">
                    <button type="submit" class="btn btn-primary btn-block">Change password</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>

              <p class="mt-3 mb-1">
                <a href="{{ route('login') }}">Login</a>
              </p>
            </div>
            <!-- /.login-card-body -->
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
