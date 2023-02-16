@extends('jpanel.layouts.app')
@section('title')
    User Permissions
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>User Permission</h1>
            </div>
            <div class="col-5 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('list.users') }}">View Users</a></li>
                    <li class="breadcrumb-item active">User Permission</li> 
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
            <div class="col-12">
                <!-- Default box -->
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
                                            <input data-id="{{$module->id}}" data-user="{{$user->id}}" data-action="1" type="checkbox" class="custom-control-input user_permission" id="user_per_c{{$module->id}}{{$user->id}}" 
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
                                            <input data-id="{{$module->id}}" data-user="{{$user->id}}" data-action="2" type="checkbox" class="custom-control-input user_permission" id="user_per_r{{$module->id}}{{$user->id}}" 
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
                                            <input data-id="{{$module->id}}" data-user="{{$user->id}}" data-action="3" type="checkbox" class="custom-control-input user_permission" id="user_per_u{{$module->id}}{{$user->id}}" 
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
                                            <input data-id="{{$module->id}}" data-user="{{$user->id}}" data-action="4" type="checkbox" class="custom-control-input user_permission" id="user_per_d{{$module->id}}{{$user->id}}" 
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
        @endif
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.user.ajax')
@endsection
