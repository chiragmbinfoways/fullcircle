@extends('jpanel.layouts.app')
@section('title')
package List
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>package List</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">package List</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if(hasPermission('package',2))
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">package List</h3>
                        <div class="card-tools">
                            @if(hasPermission('branch',1))
                            <a href="{{route('create.package')}}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-plus-square"></i> Add New package
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
                        <table class="table table-bordered table-hover" id="packageDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Service</th>
                                    <th>Times</th>
                                    <th>Total (AED)</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $key =>$package)

                                <tr class="dataRow{{$package->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$package->name}}</td>
                                    <td>{{$package->service}}</td>
                                    <td>{{$package->times}} </td>
                                    <td>{{$package->total}} </td>
                                   <td>
                                        @if(hasPermission('package',2))
                                            <a href="{{route('edit.package',$package->id)}}" class="text-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                        @endif
                                        @if(hasPermission('package',4))
                                        <a href="javascript:void(0)" data-id="{{$package->id}}" class="text-danger deletePackage" id="delete{{$package->id}}" name="delete{{$package->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Service</th>
                                    <th>Times</th>
                                    <th>Total (AED)</th>
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
    @include('jpanel.package.ajax')
@endsection