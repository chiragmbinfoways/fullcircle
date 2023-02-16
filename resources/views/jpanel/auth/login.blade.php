<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Log in</title>
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <!-- overlayScrollbars -->
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <!-- Custom styles for ourApp-->
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">
</head>
<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="#" class="h1">{{env('APP_NAME')}}</a>
            </div>
            <div class="card-body">
                <p class="login-box-msg">Sign in to start your session</p>

                <form action="{{ route('login.post') }}" method="post">
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
                    <div class="input-group mb-3">
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Email" value="{{ $email ?? old('email') }}">
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
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Password" value="{{ $password ?? old('password') }}">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    @if ($errors->has('password'))
                        <div class="text-danger">{{ $errors->first('password') }}</div>
                    @endif
                    <div class="row">
                        <div class="col-8">
                            <div class="icheck-primary">
                                <input type="checkbox" id="remember" name="remember" {{ old('remember') !== null ? 'checked' : '' }}>
                                <label for="remember">
                                    Remember Me
                                </label>
                            </div>
                        </div>
                        <!-- /.col -->
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
                        </div>
                        <!-- /.col -->
                    </div>
                </form>
                <p class="mb-1">
                    <a href="{{ route('forgotPassword') }}">I forgot my password</a>
                </p>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
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
