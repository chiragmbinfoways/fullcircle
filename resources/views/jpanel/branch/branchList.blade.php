@extends('jpanel.layouts.app')
@section('title')
  Branch List
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Branch List</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Branch List</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if(hasPermission('branch',2))
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Branch List</h3>
                        <div class="card-tools">
                            @if(hasPermission('branch',1))
                            <a href="{{route('create.branch')}}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-plus-square"></i> Add New Branch
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
                        <table class="table table-bordered table-hover" id="branchDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Branch Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Zipcode</th>
                                    <th>Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($branches as $key =>$branch)

                                <tr class="dataRow{{$branch->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$branch->name}}</td>
                                    <td>{{$branch->address}}</td>
                                    <td>{{$branch->city}} </td>
                                    <td>{{$branch->pincode}} </td>
                                    <td>{{$branch->number}}</td>
                                   <td>
                                        @if(hasPermission('branch',2))
                                            <a href="{{route('edit.branch',$branch->id)}}" class="text-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                        @endif
                                        @if(hasPermission('branch',4))
                                        <a href="javascript:void(0)" data-id="{{$branch->id}}" class="text-danger deleteBranch" id="delete{{$branch->id}}" name="delete{{$branch->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Branch Name</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Zipcode</th>
                                    <th>Number</th>
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
    @include('jpanel.branch.ajax')
@endsection