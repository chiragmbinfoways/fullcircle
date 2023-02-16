@extends('jpanel.layouts.app')
@section('title')
  Booking List
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Booking List</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Booking List</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            @if(hasPermission('booking',2))
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Booking List</h3>
                        <div class="card-tools">
                            @if(hasPermission('booking',1))
                            <a href="{{route('create.booking')}}" class="btn btn-sm btn-secondary">
                                <i class="fas fa-plus-square"></i> Add New Booking
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
                        <table class="table table-bordered table-hover" id="bookingDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Appointment Date</th>
                                    <th>Day</th>
                                    <th>Customer Name</th>
                                    <th>Package</th>
                                    <th>Trainer</th>
                                    <th>Branch</th>
                                    <th>Time</th>
                                    <th>Training Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $key =>$booking)

                                <tr class="dataRow{{$booking->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{\Carbon\Carbon::Parse($booking->booking_date)->format('d-M-Y') }}</td>
                                    <td>{{$booking->day }}</td>
                                    <td>{{$booking->customer->fname}} {{$booking->customer->lname}}</td>
                                    <td>{{$booking->package->package_name}} </td>
                                    <td>{{$booking->employee->fname}} {{$booking->employee->lname}}</td>
                                    <td>{{$booking->branches->name }}</td>
                                    <td>{{$booking->stime .'-'.$booking->etime }}</td>
                                     <td>
                                        @if(hasPermission('booking',2))
                                        <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                                            <input data-id="{{$booking->id}}" type="checkbox" class="custom-control-input workStatus" id="workStatus{{$booking->id}}" name="workStatus{{$booking->id}}" {{ $booking->work_status ? 'checked' : '' }}>
                                            <label class="custom-control-label" for="workStatus{{$booking->id}}"></label>
                                        </div>
                                        @endif
                                    </td>

                                   <td>
                                        @if(hasPermission('booking',2))
                                         <a href="{{route('edit.booking.dashboard',$booking->id)}}" class="text-success " data-toggle="tooltip" data-placement="top" title="Edit"><i class="fas fa-edit"></i></a> |
                                        @endif
                                        @if(hasPermission('booking',4))
                                        <a href="javascript:void(0)" data-id="{{$booking->id}}" class="text-danger deleteBooking" id="delete{{$booking->id}}" name="delete{{$booking->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Appointment Date</th>
                                    <th>Day</th>
                                    <th>Customer Name</th>
                                    <th>Package</th>
                                    <th>Trainer</th>
                                    <th>Branch</th>
                                    <th>Time</th>
                                    <th>Training Status</th>
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
    @include('jpanel.booking.ajax')
@endsection