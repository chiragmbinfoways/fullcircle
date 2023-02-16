@extends('jpanel.layouts.app')
@section('title')
    Add New Booking
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Booking</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('list.booking') }}">View Bookings</a></li>
                        <li class="breadcrumb-item active">Add Booking </li>
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
                    <form action="{{ route('store.booking') }}" method="post" >
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">New booking Add Form</h3>
                                <div class="card-tools">
                                    <a href="{{ route('list.booking') }}" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-eye"></i> View All bookings
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
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Branch Name:</label>
                                            <select class="form-control form-control-sm select2 @error('branch') is-invalid @enderror "
                                                id="branch" name="branch" data-placeholder="Select Branch">
                                                <option value="" selected disabled>Select Branch</option>
                                                @foreach ($branches as $branch )
                                                <option value="{{$branch->id}}" >{{$branch->name}}</option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('branch'))
                                                <div class="text-danger">{{ $errors->first('branch') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Select Customer:</label>
                                            <select class="form-control form-control-sm select2  @error('customer') is-invalid @enderror"
                                                id="customer" name="customer" data-placeholder="Select customer">
                                                <option value="" selected disabled>select customer</option>
                                                @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}">
                                                        {{ $customer->fname }} {{ $customer->lname }} 
                                                    </option>
                                                @endforeach
                                            </select>
                                            @if ($errors->has('customer'))
                                                <div class="text-danger">{{ $errors->first('customer') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group mt-2">
                                    <h5 for="name">Package Type :</h5>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Package Name:</label>
                                            <select class="form-control select2 form-control-sm  @error('package') is-invalid @enderror"
                                                id="package" name="package" data-placeholder="Select package">
                                                <option value="" selected disabled>select package</option>
                                            </select>
                                            @if ($errors->has('package'))
                                                <div class="text-danger">{{ $errors->first('package') }}</div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Employee Name:</label>
                                            <select class="form-control form-control-sm select2 @error('emp') is-invalid @enderror "
                                                id="emp" name="emp" data-placeholder="Select Employee">
                                                <option value="" selected disabled>Select Employee</option>
                                            </select>
                                            @if ($errors->has('emp'))
                                                <div class="text-danger">{{ $errors->first('emp') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="title">Booking Date</label>
                                            <input type="date"
                                                class="form-control form-control-sm @error('date') is-invalid @enderror "
                                                id="date" name="date">
                                            {{-- DAY  --}}
                                            <input type="text"
                                                class="form-control form-control-sm @error('day') is-invalid @enderror  d-none"
                                                id="day" name="day">

                                                {{-- SERVICE TIME   --}}
                                            <input type="text"
                                                class="form-control form-control-sm @error('time') is-invalid @enderror d-none"
                                                id="time" name="time">
                                                @if ($errors->has('date'))
                                                <div class="text-danger">{{ $errors->first('date') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Start Time:</label>
                                            <input type="time"
                                                class="form-control form-control-sm @error('stime') is-invalid @enderror "
                                                id="stime" onselect="calculate()" name="stime">
                                            @if ($errors->has('stime'))
                                                <div class="text-danger">{{ $errors->first('stime') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label>Office Time</label>
                                            <div id="available" class=""></div>
                                        </div>
                                    </div>
                                </div> --}}
                                {{-- <div class="form-group mt-2">
                                    <h5 for="name">Booked Slots :</h5>
                                </div>
                                <div class="row" id="bookings"> --}}
                                  
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary btn-block">Book An Appointment <i
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
    <!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.booking.ajax')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.23.0/moment.min.js"></script>
@endsection
