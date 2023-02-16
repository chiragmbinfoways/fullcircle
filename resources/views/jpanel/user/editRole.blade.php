@extends('jpanel.layouts.app')
@section('title')
    Roles
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Roles</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('list.role') }}">Roles</a></li>
                    <li class="breadcrumb-item active">Edit Roles</li> 
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if(hasPermission('roles',3))
            <div class="col-md-4">
                <form action="{{ route('update.role',$role->id) }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Edit Role</h3>
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
                                <input type="text" class="form-control form-control-sm @error('rname') is-invalid @enderror" id="rname"
                                    name="rname" placeholder="Enter Role Name" value="{{$role->name}}">
                                @if ($errors->has('rname'))
                                    <div class="text-danger">{{ $errors->first('rname') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">Slug</label>
                                <input type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror" id="slug"
                                    name="slug" placeholder="Enter Slug Name" value="{{$role->slug}}">
                                @if ($errors->has('slug'))
                                    <div class="text-danger">{{ $errors->first('slug') }}</div>
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
            
            <div class="col-md-8">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Assign Module For <span class="text-success">{{$role->name}}</span></h3>
                        <div class="card-tools">
                            @if(hasPermission('roles',1))
                            <a href="{{route('list.role')}}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-plus-square"></i> Add New Role
                            </a>
                            @endif
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
                                    <th>Module</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($modules as $key =>$module)
                                
                                <tr class="dataRow{{$module->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$module->name}} </td>
                                    <td>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input data-id="{{$module->id}}" data-role="{{$role->id}}" type="checkbox" class="custom-control-input role_module" id="role_module{{$module->id}}" name="role_module{{$module->id}}" 
                                            @foreach ($role->modules as $role_module)
                                                @if($role_module->pivot->module_id==$module->id)
                                                checked
                                                @endif
                                            @endforeach
                                            >
                                            <label class="custom-control-label" for="role_module{{$module->id}}"></label>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Module</th>
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
                <!-- /.card -->
            </div>
            @endif
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.user.ajax')
@endsection
