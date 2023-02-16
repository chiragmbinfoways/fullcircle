@extends('jpanel.layouts.app')
@section('title')
Customer List
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Customer List</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Customer List</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if(hasPermission('customer',2))
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        {{-- <h3 class="card-title">Customer List</h3> --}}
                        <div class="card-tools">
                            @if(hasPermission('customer',1))
                            <a href="{{route('create.customer')}}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-plus-square"></i> Add New Customer
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
                        <table class="table table-bordered table-hover" id="customerDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($customers as $key =>$customer)

                                <tr class="dataRow{{$customer->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$customer->fname}} {{$customer->lname}}</td>
                                    <td>{{$customer->email}}</td>
                                    <td>{{$customer->phone}} </td>
                                    <td>@if($customer->gender == 'M') Male @else Female @endif </td>
                                     <td>
                                        @if(hasPermission('customer',2))
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input data-id="{{$customer->id}}" type="checkbox" class="custom-control-input customerStatus" id="status{{$customer->id}}" name="status{{$customer->id}}" {{ $customer->status ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status{{$customer->id}}"></label>
                                        </div>
                                        @endif
                                    </td>

                                   <td>
                                     @if(hasPermission('customer',2))
                                     <a href="{{route('package.customer',$customer->id)}}" class="" data-toggle="tooltip" data-placement="top" title=""><i class="fas fa-cube"></i></a> |
                                     @endif
                                        @if(hasPermission('customer',2))
                                            <a href="{{route('edit.customer',$customer->id)}}" class="text-success " data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                        @endif
                                        @if(hasPermission('customer',4))
                                        <a href="javascript:void(0)" data-id="{{$customer->id}}" class="text-danger deleteCustomer" id="delete{{$customer->id}}" name="delete{{$customer->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Gender</th>
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
    @include('jpanel.customer.ajax')
@endsection