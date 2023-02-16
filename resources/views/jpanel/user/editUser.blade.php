@extends('jpanel.layouts.app')
@section('title')
    Edit User
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Edit User</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('list.users') }}">View Users</a></li>
                    <li class="breadcrumb-item active">Edit User</li> 
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        
        @if(hasPermission('users',3))
        <div class="row">
            
            <div class="col-md-6">
                <!-- Default box -->
                 <!-- Profile Update box -->
                 <form action="{{ route('update.user',$user->id) }}" method="post">
                    @csrf
                    @method('PUT')

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">User Edit Form</h3>
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
                                    name="uname" placeholder="Enter Name" value="{{$user->name}}">
                                @if ($errors->has('uname'))
                                    <div class="text-danger">{{ $errors->first('uname') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">User Name</label>
                                <input type="text" class="form-control form-control-sm @error('username') is-invalid @enderror" id="username"
                                    name="username" placeholder="Enter User Name" value="{{$user->username}}">
                                @if ($errors->has('username'))
                                    <div class="text-danger">{{ $errors->first('username') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">Phone</label>
                                <input type="text" class="form-control form-control-sm @error('phone') is-invalid @enderror" id="phone"
                                    name="phone" placeholder="Enter Phone Number" value="{{$user->phone}}">
                                @if ($errors->has('phone'))
                                    <div class="text-danger">{{ $errors->first('phone') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Email address</label>
                                <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror" id="email"
                                    name="email" placeholder="Enter email" value="{{$user->email}}">
                                @if ($errors->has('email'))
                                    <div class="text-danger">{{ $errors->first('email') }}</div>
                                @endif
                            </div>


                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <button type="submit" class="btn btn-secondary btn-block">Update <i
                                    class="fas fa-angle-double-right"></i></button>
                        </div>
                        <!-- /.card-footer-->

                    </div>
                    <!-- /.card -->
                </form>
                
            </div>
            <div class="col-md-6">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Assign Role to <span class="text-success">{{$user->name}}</span></h3>
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
                        <table class="table table-bordered table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>User</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($roles as $key =>$role)
                                
                                <tr class="dataRow{{$role->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$role->name}} </td>
                                    <td>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input data-id="{{$role->id}}" data-user="{{$user->id}}" type="checkbox" class="custom-control-input user_role" id="user_role{{$role->id}}" name="user_role{{$role->id}}" 
                                            @foreach ($user->roles as $user_role)
                                                @if($user_role->pivot->role_id==$role->id)
                                                checked
                                                @endif
                                            @endforeach
                                            >
                                            <label class="custom-control-label" for="user_role{{$role->id}}"></label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    <div class="card-footer">
                        
                    </div>
                    <!-- /.card-footer-->
                </div>
            </div>
        </div>
        @endif
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.user.ajax')
@endsection
