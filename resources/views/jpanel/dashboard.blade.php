@extends('jpanel.layouts.app')
@section('title')
    Dashboard
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        {{-- <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item"><a href="#">Layout</a></li>
                    <li class="breadcrumb-item active">Dashboard</li> --}}
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row flash-message ">
                <div class="col-12">
                    @include('jpanel/flash-message')
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <!-- Default box -->
                    {{-- @if (hasPermission(4, 1) == 1) --}}
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Booked Appointment</h3>
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
                                <!-- Modal -->
                                <div class="modal fade" id="bookingModal" tabindex="-1" role="dialog"
                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">Add New Booking</h5>
                                                <button type="button"  class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                      {{-- BRANCH NAME  --}}
                                                      <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="d-block">Branch Name:</label>
                                                            <select class="form-control form-control-sm  emp"
                                                                id="branch" name="branch"
                                                                data-placeholder="Select branch">
                                                                <option value="" selected disabled>Select Branch</option>
                                                                @foreach ($branches as $branch )
                                                                <option value="{{$branch->id}}" >{{$branch->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <div class="text-danger" id="branchError"></div>
                                                        </div>
                                                    </div>
                                                    {{-- CUSTOMER NAME  --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="d-block">Customer Name:</label>
                                                            <select class="form-control form-control-sm "
                                                                id="customer" name="customer"
                                                                data-placeholder="Select customer">
                                                                <option value="" selected disabled>select customer</option>
                                                                @foreach ($customers as $customer)
                                                                    <option value="{{ $customer->id }}">
                                                                        {{ $customer->fname }} {{ $customer->lname }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <div class="text-danger" id="customerError"></div>
                                                        </div>
                                                    </div>
                                                    {{-- PACKAGE NAME  --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="d-block">Package Name:</label>
                                                            <select class="form-control form-control-sm "
                                                                id="package" name="package"
                                                                data-placeholder="Select package">
                                                            </select>
                                                            <div class="text-danger" id="packageError"></div>
                                                        </div>
                                                    </div>
                                                    {{-- EMPLOYEE NAME  --}}
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="d-block">Employee Name:</label>
                                                            <select class="form-control form-control-sm  emp"
                                                                id="emp" name="emp"
                                                                data-placeholder="Select Employee">
                                                            </select>
                                                            <div class="text-danger" id="empError"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" onclick="" class="btn btn-secondary"
                                                    data-dismiss="modal">Close</button>
                                                <button type="button" id="bookAppointment" class="btn btn-primary">Book
                                                    Appointment</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- EDIT AND DELETE MODAL   --}}
                            <!-- Modal -->
                            <div class="modal fade" id="DetailsModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Booking Details</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="container-fluid">
                                            <dl>
                                                <dt class="text-muted">Customer Name</dt>
                                                <dd id="title" class="fw-bold fs-4"></dd>
                                                <dt class="text-muted">Start</dt>
                                                <dd id="start" class=""></dd>
                                                <dt class="text-muted">End</dt>
                                                <dd id="end" class=""></dd>
                                            </dl>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <a href="" id="edit"><button type="button" class="btn btn-primary">Edit</button></a>
                                    <button type="button" id="delete" class="btn btn-danger">Delete</button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="row">
                                {{-- <div class="col-md-4"> --}}
                                <form action="{{ route('dashboard.branch.filter') }}" method="post">
                                    @csrf
                                            <div class="form-group mr-2">
                                                <label class="d-block">Branch Name:</label>
                                                <select class="form-control  form-control-sm  emp" id="branchFilter" name="branchFilter" data-placeholder="Select branch" onchange="this.form.submit()">
                                                <option value="" selected hidden>{{$branch_name}}</option>
                                                @foreach ($branches as $branch )
                                                <option value="{{$branch->id}}" >{{$branch->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        {{-- </div> --}}
                                </form>
                                <form action="{{ route('dashboard.employee.filter') }}" method="post">
                                    @csrf
                                        {{-- <div class="col-md-4"> --}}
                                            <div class="form-group">
                                                <label class="d-block">Employee Name:</label>
                                                <select class="form-control  form-control-sm  emp" id="employeeFilter" name="employeeFilter" data-placeholder="Select Employee" onchange="this.form.submit()">
                                                <option value="" selected hidden>{{$employee_name}}</option>
                                                <option value="All">All</option>
                                                @foreach ($employees as $employee )
                                                <option value="{{$employee->id}}" >{{$employee->fname}} {{$employee->lname}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                                        {{-- </div> --}}
                                </form>
                            </div>
                        <!-- THE CALENDAR -->
                            <div id="calendar"></div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                    {{-- @endif --}}
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@endsection
@section('scripts')
    @include('jpanel.ajax')
@endsection
