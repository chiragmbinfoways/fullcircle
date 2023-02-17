@extends('jpanel.layouts.app')
@section('title')
  Employee Commissions
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3 col-md-4">
                <h1>Commission Amount</h1>
            </div>
            <div class="col-6 col-md-4 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3 col-md-4">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Commissions</li>
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
                        <h3 class="card-title">Commission Recivable: {{$recivableAmt}} (AED)</h3>
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
                                    <th>#</th>
                                    <th>Appointment Date</th>
                                    <th>Customer Name</th>
                                    <th>Package</th>
                                    <th>Commission(AED)</th>
                                    <th>Payment Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($commissions as $key =>$commission)
                                {{-- @dd($commission); --}}

                                <tr class="dataRow{{$commission->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{\Carbon\Carbon::Parse($commission->appointment->booking_date)->format('d-M-Y') }}</td>
                                    <td>{{$commission->appointment->customer->fname}} {{$commission->appointment->customer->lname}}</td>
                                    <td>{{$commission->appointment->package->packages->name}}</td>
                                    <td>{{$commission->commission}} </td>
                                    <td>
                                        @if(hasPermission('employees',2))
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input data-id="{{$commission->id}}" type="checkbox" class="custom-control-input commissionStatus" id="status{{$commission->id}}" name="status{{$commission->id}}" {{ $commission->payment_status ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="status{{$commission->id}}"></label>
                                        </div>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Appointment Date</th>
                                    <th>Customer Name</th>
                                    <th>Package</th>
                                    <th>Commission(AED)</th>
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
            @endif
        </div>
    </div>
</section>

<!-- /.content -->

@endsection

@section('scripts')
    @include('jpanel.employee.ajax')
@endsection