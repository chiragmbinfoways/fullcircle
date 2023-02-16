@extends('jpanel.layouts.app')
@section('title')
    Modules
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Modules</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Modules</li> 
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>
<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if(hasPermission('modules',1))
            <div class="col-md-4">
                <form action="{{ route('add.module') }}" method="post">
                    @csrf
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Add New Modules</h3>
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
                                <input type="text" class="form-control form-control-sm @error('pname') is-invalid @enderror" id="pname"
                                    name="pname" placeholder="Enter Module Name">
                                @if ($errors->has('pname'))
                                    <div class="text-danger">{{ $errors->first('pname') }}</div>
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
                        <h3 class="card-title">Module List</h3>
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
                                    <th>Module</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                                @foreach ($modules as $key =>$module)
                                
                                <tr class="dataRow{{$module->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$module->name}}</td>
                                    <td>{{$module->slug}}</td>
                                    <td>
                                        @if(hasPermission('modules',3))
                                        <a href="{{ route('edit.module',$module->id) }}" class="text-primary" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                        @endif
                                        @if(hasPermission('modules',4))
                                        <a href="javascript:void(0)" data-id="{{$module->id}}" class="text-danger deleteModule" id="delete{{$module->id}}" name="delete{{$module->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Module</th>
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
