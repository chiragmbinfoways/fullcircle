@extends('jpanel.layouts.app')
@section('title')
    View User Detail
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    @if (hasPermission('users', 2))
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View User Detail</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('list.users') }}">View Users</a></li>
                            <li class="breadcrumb-item active">View User Details</li>
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

                    <div class="col-md-3">
                        <!-- Default box -->
                        <!-- Profile Update box -->
                        <form action="{{ route('update.user', $user->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">View {{ $user->name }} Details</h3>
                                    <div class="card-tools">
                                        <a href="{{ route('list.users') }}" class="btn btn-sm btn-secondary">
                                            <i class="fas fa-eye"></i> View All Users
                                        </a>
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                        <button type="button" class="btn btn-tool" data-card-widget="remove"
                                            title="Remove">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <img height="80px" src="{{ asset('/storage/images/userProfile/' . $user->avatar) }}"
                                            class="img-circle elevation-2 mb-4 p-2">
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        {{ $user->name }}
                                    </div>
                                    <div class="form-group">
                                        <label for="name">User Name</label>
                                        {{ $user->username }}
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Phone</label>
                                        {{ $user->phone }}
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Email</label>
                                        {{ $user->email }}
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Status</label>
                                        {{ $user->status === 1 ? 'Active' : 'Inactive' }}
                                    </div>
                                </div>
                                <!-- /.card-footer-->
                            </div>
                            <!-- /.card -->
                        </form>
                    </div>
                    <div class="col-md-3">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Assign Role to <span
                                        class="text-success">{{ $user->name }}</span></h3>
                                <div class="card-tools">

                                    <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                        title="Collapse">
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
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach ($roles as $key => $role)

                                            <tr class="dataRow{{ $role->id }}">
                                                <td>{{ ++$key }}</td>
                                                <td>{{ $role->name }} </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Role</th>
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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Assign Permission to <span class="text-success">{{$user->name}}</span></h3>
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
                                            <th>Modules</th>
                                            <th>Add [1]</th>
                                            <th>View [2]</th>
                                            <th>Update [3]</th>
                                            <th>Delete [4]</th>
                                        </tr>
                                    </thead>
                                    <tbody>    
                                        @foreach ($modules as $key =>$module)
                                        <tr class="dataRow{{$module->id}}">
                                            <td>{{++$key}}</td>
                                            <td>{{$module->name}} </td>
                                            <td>
                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                    <input data-id="{{$module->id}}" data-user="{{$user->id}}" data-action="1" type="checkbox" class="custom-control-input user_permission" id="user_per_c{{$module->id}}{{$user->id}}" disabled 
                                                    @foreach ($permissions as $key =>$permission)
                                                        @if($permission->user_id==$user->id && $permission->module_id==$module->id && $permission->action_id==1)
                                                        checked
                                                        @endif
                                                    @endforeach
                                                    >
                                                    {{-- <input data-id="{{$module->id}}" data-action="{{$user->id}}" type="checkbox" class="custom-control-input role_permission" id="role_permission{{$permission->id}}" name="role_permission{{$permission->id}}" 
                                                    @foreach ($user->permissions as $user_permission)
                                                        @if($role_permission->pivot->permission_id==$permission->id)
                                                        checked
                                                        @endif
                                                    @endforeach
                                                    >  --}}
                                                    <label class="custom-control-label" for="user_per_c{{$module->id}}{{$user->id}}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                    <input data-id="{{$module->id}}" data-user="{{$user->id}}" data-action="2" type="checkbox" class="custom-control-input user_permission" id="user_per_r{{$module->id}}{{$user->id}}" disabled
                                                    @foreach ($permissions as $key =>$permission)
                                                        @if($permission->user_id==$user->id && $permission->module_id==$module->id && $permission->action_id==2)
                                                        checked
                                                        @endif
                                                    @endforeach
                                                    >
                                                    <label class="custom-control-label" for="user_per_r{{$module->id}}{{$user->id}}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                    <input data-id="{{$module->id}}" data-user="{{$user->id}}" data-action="3" type="checkbox" class="custom-control-input user_permission" id="user_per_u{{$module->id}}{{$user->id}}" disabled
                                                    @foreach ($permissions as $key =>$permission)
                                                        @if($permission->user_id==$user->id && $permission->module_id==$module->id && $permission->action_id==3)
                                                        checked
                                                        @endif
                                                    @endforeach
                                                    >
                                                    <label class="custom-control-label" for="user_per_u{{$module->id}}{{$user->id}}"></label>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                    <input data-id="{{$module->id}}" data-user="{{$user->id}}" data-action="4" type="checkbox" class="custom-control-input user_permission" id="user_per_d{{$module->id}}{{$user->id}}" disabled
                                                    @foreach ($permissions as $key =>$permission)
                                                        @if($permission->user_id==$user->id && $permission->module_id==$module->id && $permission->action_id==4)
                                                        checked
                                                        @endif
                                                    @endforeach
                                                    >
                                                    <label class="custom-control-label" for="user_per_d{{$module->id}}{{$user->id}}"></label>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>#</th>
                                            <th>Modules</th>
                                            <th>Add [1]</th>
                                            <th>View [2]</th>
                                            <th>Update [3]</th>
                                            <th>Delete [4]</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                {{-- <p> For Developers: check permission function: hasPermission(module_slug,action_id): Use 1 for Add, 2 for view, 3 for update and 4 for delete </p> --}}
                            </div>
                            <!-- /.card-footer-->
                        </div>
                    </div>

                </div>
            </div>
        </section>
        <!-- /.content -->
    @endsection
@endif
@section('scripts')
    @include('jpanel.user.ajax')
@endsection
