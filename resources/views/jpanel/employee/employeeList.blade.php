@extends('jpanel.layouts.app')
@section('title')
  Employee List
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Employee List</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Employee List</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if(hasPermission('employees',2))
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Employee List</h3>
                        <div class="card-tools">
                            @if(hasPermission('employees',1))
                            <a href="{{route('create.employee')}}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-plus-square"></i> Add New Employee
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
                        <table class="table table-bordered table-hover" id="employeeDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Date Of Birth</th>
                                    <th>Phone</th>
                                    <th>Commission</th>
                                    <th>Gender</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $key =>$employee)

                                <tr class="dataRow{{$employee->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$employee->fname}} {{$employee->lname}}</td>
                                    <td>{{$employee->email}}</td>
                                    <td>{{\Carbon\Carbon::Parse($employee->dob)->format('d-M-Y') }}</td>
                                    <td>{{$employee->phone}} </td>
                                    <td>{{$employee->commission }} (AED)</td>
                                    <td>@if($employee->gender == 'M') Male @else Female @endif </td>
                                     <td>
                                        @if(hasPermission('employees',2))
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input data-id="{{$employee->id}}" type="checkbox" class="custom-control-input employeeStatus" id="status{{$employee->id}}" name="status{{$employee->id}}" {{ $employee->status ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status{{$employee->id}}"></label>
                                        </div>
                                        @endif
                                    </td>

                                   <td>
                                     @if(hasPermission('employees',2))
                                     <a href="{{route('availability.employee',$employee->id)}}" class="" data-toggle="tooltip" data-placement="top" title=""><i class="fas fa-calendar-week"></i></a> |
                                     @endif
                                        @if(hasPermission('employees',2))
                                            <a href="{{route('edit.employee',$employee->id)}}" class="text-success " data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                        @endif
                                        @if(hasPermission('employees',4))
                                        <a href="javascript:void(0)" data-id="{{$employee->id}}" class="text-danger deleteEmployee" id="delete{{$employee->id}}" name="delete{{$employee->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
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
                                    <th>Date Of Birth</th>
                                    <th>Phone</th>
                                    <th>Commission</th>
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
    @include('jpanel.employee.ajax')
@endsection