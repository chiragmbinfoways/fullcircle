@extends('jpanel.layouts.app')
@section('title')
  Service List
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Service List</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Service List</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if(hasPermission('services',2))
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Service List</h3>
                        <div class="card-tools">
                            @if(hasPermission('services',1))
                            <a href="{{route('create.services')}}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-plus-square"></i> Add New Service
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
                        <table class="table table-bordered table-hover" id="serviceDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Price(AED)</th>
                                    <th>VAT(%)</th>
                                    <th>Time</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($services as $key =>$service)

                                <tr class="dataRow{{$service->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$service->name}}</td>
                                    <td>{{$service->price}}</td>
                                    <td>{{$service->gst}} %</td>
                                    <td>{{$service->time}} Minutes</td>
                                     <td>
                                        @if(hasPermission('services',2))
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input data-id="{{$service->id}}" type="checkbox" class="custom-control-input serviceStatus" id="status{{$service->id}}" name="status{{$service->id}}" {{ $service->status ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status{{$service->id}}"></label>
                                        </div>
                                        @endif
                                    </td>

                                   <td>
                                        @if(hasPermission('services',2))
                                            <a href="{{route('edit.services',$service->id)}}" class="text-success" data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                        @endif
                                        @if(hasPermission('services',4))
                                        <a href="javascript:void(0)" data-id="{{$service->id}}" class="text-danger deleteService" id="delete{{$service->id}}" name="delete{{$service->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Cost</th>
                                    <th>VAT</th>
                                    <th>Time</th>
                                    <th>Status</th>
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
    @include('jpanel.services.ajax')
@endsection