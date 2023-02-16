@extends('jpanel.layouts.app')
@section('title')
    Employee Availability
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Employee Availability</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('list.employee') }}">View Employees</a></li>
                        <li class="breadcrumb-item active">Add Employee Availability</li>
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
                <div class="col-12">
                    <!-- Default box -->
                    <!-- Profile Update box -->
                    <form action="{{ route('store.availability',$emp_id) }}" method="post">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Employee Availability</h3>
                                <div class="card-tools">
                                    <a href="{{ route('list.employee') }}" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-eye"></i> View All Employees
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
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Select Day:</label>
                                            <select class="form-control select2 @error('day') is-invalid @enderror " name="day" data-placeholder="Select Day" >
                                                <option value="" selected disabled ></option>
                                                <option value="monday">Monday</option>
                                                <option value="tuesday">Tuesday</option>
                                                <option value="wednesday">Wednesday</option>
                                                <option value="thursday">Thursday</option>
                                                <option value="friday">Friday</option>
                                                <option value="saturday">Saturday</option>
                                                <option value="sunday">Sunday</option>
                                            </select>
                                            @if ($errors->has('day'))
                                            <div class="text-danger">{{ $errors->first('day') }}</div>
                                            @endif
                                        </div>
                                    </div>  
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Timeing:</label>
                                            <select class="form-control select2 " name="time"  @error('time') is-invalid @enderror data-placeholder="Select Timings" >
                                                <option value="" selected disabled ></option>
                                                <option value="fullDay">Full Day [9:00 AM To 6:00 PM]</option>
                                                <option value="halfDay">Half Day [9:00 AM To 2:00 PM]</option>
                                            </select>
                                            @if ($errors->has('time'))
                                            <div class="text-danger">{{ $errors->first('time') }}</div>
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
            </div>
        </div>
    </section>

    <!-- Main content -->
<section class="content">
    <div class="container-fluid">
        <div class="row">
            {{-- @if(hasPermission('attribute',2)) --}}
            <div class="col-12">
                <!-- Default box -->
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Avalability</h3>
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
                                    <th>Day</th>
                                    <th>Time</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($days as $key =>$day)

                                <tr class="dataRow{{$day->id}}">
                                    <td>{{++$key}}</td>
                                    <td>{{$day->day}}</td>
                                    <td>{{$day->time}}</td>
                                   <td>
                                        {{-- @if(hasPermission('category',4)) --}}
                                        <a href="javascript:void(0)" data-id="{{$day->id}}" class="text-danger deleteAvl" id="delete{{$day->id}}" name="delete{{$day->id}}" data-toggle="tooltip" data-placement="top" title="Trash"><i class="fas fa-trash"></i></a>
                                        {{-- @endif --}}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>#</th>
                                    <th>Day</th>
                                    <th>Time</th>
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
            {{-- @endif --}}
        </div>
    </div>
</section>
    <!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.employee.ajax')
@endsection
