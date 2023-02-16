@extends('jpanel.layouts.app')
@section('title')
    customer Package
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{$name->fname}} {{$name->lname}} - Packages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('list.employee') }}">View Customers</a></li>
                        <li class="breadcrumb-item active">Add Customers Packages</li>
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
                <div class="col-6">
                    <!-- Default box -->
                    <!-- Profile Update box -->
                    <form action="{{ route('store.customerPackage',$name->id) }}" method="post">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add Package</h3>
                                <div class="card-tools">
                                    <a href="{{ route('list.customer') }}" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-eye"></i> View All Customers
                                    </a>
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
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Select Package:</label>
                                            <select class="form-control select2 @error('package') is-invalid @enderror " name="package" data-placeholder="Select Package" >
                                                @foreach ($packages as $package)
                                                    <option value="{{$package->id}}">{{$package->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('package'))
                                            <div class="text-danger">{{ $errors->first('package') }}</div>
                                            @endif
                                        </div>
                                    </div>  
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
                        {{-- Payment status  --}}
                        <div class="col-6">
                            <!-- Default box -->
                            <div class="card">
                                <div class="card-header">
                                    <h3 class="card-title">Payments </h3>
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
                                    <table class="table table-bordered table-hover" >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Package Name</th>
                                                <th>Payment Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($customerpackages as $key =>$customerpackage)
            
                                            <tr class="dataRow{{$customerpackage->id}}">
                                                <td>{{++$key}}</td>
                                                <td>{{$customerpackage->package_name}}</td>
                                                <td>
                                                    @if(hasPermission('customer',2))
                                                    <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                                        <input data-id="{{$customerpackage->id}}" type="checkbox" class="custom-control-input customerPackageStatus" id="status{{$customerpackage->id}}" name="status{{$customerpackage->id}}" {{ $customerpackage->payment_status ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="status{{$customerpackage->id}}"></label>
                                                    </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            @endforeach 
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>#</th>
                                                <th>Package Name</th>
                                                <th>Payment Status</th>
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
@foreach ($customerpackages as $customerpackage)
    <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            {{-- @if(hasPermission('attribute',2)) --}}
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">{{$customerpackage->package_name}}</h3>
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
                        <table class="table table-bordered table-hover" id="employeeDataTable">
                            <thead>
                                <tr>
                                    <th>Appointment Date</th>
                                    <th>Time</th>
                                    <th>Trainer</th>
                                    <th>Visited</th>
                                    <th>Appointment Taken</th>
                                    {{-- <th>Action</th> --}}
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allAppointments as $key =>$appointment)
                                @if ( $customerpackage->id == $appointment->customerPack_id )
                                <tr class="dataRow{{$appointment->id}}">
                                    <td>@if ($appointment->Appointment_date != "-")
                                        {{\Carbon\Carbon::Parse($appointment->Appointment_date)->format('d-M-Y') }}
                                        @else
                                        {{$appointment->Appointment_date}}
                                        @endif  
                                      
                                    </td>
                                    <td>{{$appointment->time}}</td>
                                    <td>@if ($appointment->Trainer != "-")
                                        {{$appointment->employee->fname}} {{$appointment->employee->lname}}
                                        @else
                                        {{$appointment->Trainer}}
                                        @endif 
                                    </td>
                                    <td>
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input data-id="{{$appointment->id}}" type="checkbox"   @if($appointment->appointment_taken == "0") disabled  @endif class="custom-control-input visited" id="workStatus{{$appointment->id}}" name="workStatus{{$appointment->id}}" {{ $appointment->visited ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="workStatus{{$appointment->id}}"></label>
                                        </div>
                                       
                                    </td>
                                    <td>@if ($appointment->appointment_taken == 0) <p class="text-warning">Pending</p>
                                        @else 
                                        <p class="text-success">Success</p>
                                        @endif
                                       </td>
                                   {{-- <td>
                                        <a href="javascript:void(0)" data-id="{{$appointment->id}}" class="text-danger deleteAvl" id="delete{{$appointment->id}}" name="delete{{$appointment->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                    </td> --}}
                                </tr>
                                @endif
                                @endforeach 
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>Appointment Date</th>
                                    <th>Time</th>
                                    <th>Trainer</th>
                                    <th>Visited</th>
                                    <th>Appointment Taken</th>
                                    {{-- <th>Action</th> --}}
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
            {{-- @endif --}}
        </div>
    </div>
</section>
    <!-- /.content -->
    @endforeach
@endsection

@section('scripts')
    @include('jpanel.customer.ajax')
@endsection
