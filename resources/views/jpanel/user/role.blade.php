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
                    <li class="breadcrumb-item active">Roles</li> 
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        
        <div class="row">
            @if(hasPermission('roles',1))
            <div class="col-md-4">
                <form action="{{ route('add.role') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Role</h3>
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
                                    name="rname" placeholder="Enter Role Name">
                                @if ($errors->has('rname'))
                                    <div class="text-danger">{{ $errors->first('rname') }}</div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="name">Slug</label>
                                <input type="text" class="form-control form-control-sm @error('slug') is-invalid @enderror" id="slug"
                                    name="slug" placeholder="Enter Slug Name">
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
            @endif
            <div class="col-md-8">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Role List</h3>
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
                        <table class="table table-bordered table-hover" id="dataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Role</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($roles as $key =>$role)
                                
                                <tr class="dataRow{{$role->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$role->name}}</td>
                                    <td>{{$role->slug}}</td>
                                    <td>
                                        @if(hasPermission('roles',3))
                                            <a href="{{ route('edit.role',$role->id) }}" class="text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                            <a href="{{ route('edit.role',$role->id) }}" class="text-primary" data-toggle="tooltip" data-placement="top" title="Module"><i class="fas fa-box"></i></a>  |
                                        @endif
                                        @if(hasPermission('roles',4))
                                            <a href="javascript:void(0)" data-id="{{$role->id}}" class="text-danger deleteRole" id="delete{{$role->id}}" name="delete{{$role->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Slug</th>
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
        </div>
    </div>
</section>
<!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.user.ajax')
@endsection
