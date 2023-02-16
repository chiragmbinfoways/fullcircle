@extends('jpanel.layouts.app')
@section('title')
    Profile Settings
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Profile Settings</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('jpanel/flash-message')
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6">
                     <!-- Profile Update box -->
                    <form action="{{ route('profile.update') }}" method="post">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Update Profiles</h3>
                                <div class="card-tools">
                                    
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control @error('uname') is-invalid @enderror" id="uname"
                                        name="uname" placeholder="Enter Name" value="{{ Auth::user()->name }}">
                                    @if ($errors->has('uname'))
                                        <div class="text-danger">{{ $errors->first('uname') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">User Name</label>
                                    <input type="text" class="form-control @error('username') is-invalid @enderror" id="username"
                                        name="username" placeholder="Enter User Name" value="{{ Auth::user()->username }}">
                                    @if ($errors->has('username'))
                                        <div class="text-danger">{{ $errors->first('username') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="name">Phone</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror" id="phone"
                                        name="phone" placeholder="Enter Phone Number" value="{{ Auth::user()->phone }}">
                                    @if ($errors->has('phone'))
                                        <div class="text-danger">{{ $errors->first('phone') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                                        name="email" placeholder="Enter email" value="{{ Auth::user()->email }}">
                                    @if ($errors->has('email'))
                                        <div class="text-danger">{{ $errors->first('email') }}</div>
                                    @endif
                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary btn-block">Submit <i
                                        class="fas fa-angle-double-right"></i></button>
                            </div>
                            <!-- /.card-footer-->

                        </div>
                        <!-- /.card -->
                    </form>
                </div>
                <div class="col-md-6">
                    <!-- Profile Image Update box -->
                     <form action="{{ route('profile.image.update') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Update Profiles Image</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <img height="80px" src="{{ asset('/storage/images/userProfile/th/'.Auth::getUser()->avatar) }}" class="img-circle elevation-2 mb-4 p-2">
                                    <input type="file" name="avatar" class="form-control @error('avatar') is-invalid @enderror" >
                                    @if ($errors->has('avatar'))
                                        <div class="text-danger">{{ $errors->first('avatar') }}</div>
                                    @endif
                                    
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary btn-block">Submit <i
                                        class="fas fa-angle-double-right"></i></button>
                            </div>
                            <!-- /.card-footer-->

                        </div>
                        <!-- /.card -->
                    </form>
                    <!-- Password Update box -->
                    <form action="{{ route('password.update') }}" method="post">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Update Password</h3>
                                <div class="card-tools">
                                    <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="password" class="form-control @error('password') is-invalid @enderror"
                                        id="password" name="password" placeholder="Enter Password"
                                        value="{{ $password ?? old('password') }}">
                                    @if ($errors->has('password'))
                                        <div class="text-danger">{{ $errors->first('password') }}</div>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="password_confirmation">Confirm Password</label>
                                    <input type="password"
                                        class="form-control @error('password_confirmation') is-invalid @enderror"
                                        id="password_confirmation" name="password_confirmation"
                                        placeholder="Enter Confirm Password">
                                    @if ($errors->has('password_confirmation'))
                                        <div class="text-danger">{{ $errors->first('password_confirmation') }}</div>
                                    @endif
                                </div>


                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary btn-block">Submit <i
                                        class="fas fa-angle-double-right"></i></button>
                            </div>
                            <!-- /.card-footer-->

                        </div>
                        <!-- /.card -->
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
