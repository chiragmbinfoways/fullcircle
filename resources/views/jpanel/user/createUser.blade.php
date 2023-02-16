@extends('jpanel.layouts.app')
@section('title')
    Add New Users
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>Add New Users</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('list.users') }}">View Users</a></li>
                    <li class="breadcrumb-item active">Add Users</li> 
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row flash-message">
            <div class="col-12">
                @include('jpanel/flash-message')
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <!-- Default box -->
                 <!-- Profile Update box -->
                 <form action="{{ route('add.user') }}" method="post">
                    @csrf

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">New User Add Form</h3>
                            <div class="card-tools">
                                <a href="{{route('list.users')}}" class="btn btn-sm btn-secondary">
                                    <i class="fas fa-eye"></i> View All Users
                                </a>
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
                                <input type="text" class="form-control form-control-sm @error('uname') is-invalid @enderror" id="uname"
                                    name="uname" placeholder="Enter Name">
                                @if ($errors->has('uname'))
                                    <div class="text-danger">{{ $errors->first('uname') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" id="username"
                                    name="username" placeholder="Enter User Name">
                                @if ($errors->has('username'))
                                    <div class="text-danger">{{ $errors->first('username') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">Phone</label>
                                <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" id="phone"
                                    name="phone" placeholder="Enter Phone Number">
                                @if ($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email"
                                    name="email" placeholder="Enter email">
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
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.user.ajax')
@endsection
