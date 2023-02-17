@extends('jpanel.layouts.app')
@section('title')
  Trainer Report
@endsection

@section('content')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2 flash-message">
            <div class="col-sm-3">
                <h1>Trainer Report</h1>
            </div>
            <div class="col-6 messageArea">
                @include('jpanel/flash-message')
            </div>
            <div class="col-sm-3">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item active">Trainer Report</li>
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
                        <h3 class="card-title">Trainer Report</h3>
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
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="title">Select Trainer </label>
                                    <select class="select2 " name="trainer" id="trainer"  style="width: 100%;" data-placeholder="Select Trainer" >
                                        @foreach ($trainers as $trainer)
                                            <option value="{{ $trainer->id }}">
                                                {{ $trainer->fname }}  {{ $trainer->lname }}
                                            </option>
                                        @endforeach
                                    </select>
                                        @if ($errors->has('trainer'))
                                        <div class="text-danger">{{ $errors->first('trainer') }}</div>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Date range:</label>
                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">
                                            <i class="far fa-calendar-alt"></i>
                                            </span>
                                        </div>
                                        <input type="button" name="date" id="date" class="form-control float-right">
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-4">
                                <button type="button" id="trainerFilter"  class="btn btn-secondary">Filter</button>
                            </div>
                        </div>
                        <table class="table table-bordered table-hover" id="trainerDataTable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Trainer Name</th>
                                    <th>Appointment Date</th>
                                    <th>Branch Name</th>
                                    <th>Customer Name</th>
                                    <th>Package Name</th>
                                    <th>Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bookings as $key =>$booking)

                                <tr class="dataRow{{$booking->id}} filterTrainer">
                                    <td>{{++$key}}</td>
                                    <td>{{$booking->employee->fname}} {{$booking->employee->lname}}</td>
                                    <td>{{\Carbon\Carbon::Parse($booking->booking_date)->format('d-M-Y') }}</td>
                                    <td>{{$booking->branches->name }}</td>
                                    <td>{{$booking->customer->fname}} {{$booking->customer->lname}}</td>
                                    <td>{{$booking->package->package_name}} </td>
                                    <td>{{$booking->stime .'-'.$booking->etime }}</td>

                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Trainer Name</th>
                                    <th>Appointment Date</th>
                                    <th>Branch Name</th>
                                    <th>Customer Name</th>
                                    <th>Package Name</th>
                                    <th>Time</th>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                    {{-- <div class="card-footer">

                    </div> --}}
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
    @include('jpanel.report.ajax')
@endsection