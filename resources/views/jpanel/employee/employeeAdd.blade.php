@extends('jpanel.layouts.app')
@section('title')
    Add New Employee
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('list.employee') }}">View Employees</a></li>
                        <li class="breadcrumb-item active">Add Employees</li>
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
                    <form action="{{ route('store.employee') }}" method="post">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">New Employee Add Form</h3>
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
                                            <label for="title">First Name</label>
                                            <input type="text" class="form-control form-control-sm @error('fname') is-invalid @enderror " id="fname"
                                                name="fname" placeholder="First Name" value="{{old('fname')}}">
                                                @if ($errors->has('fname'))
                                                <div class="text-danger">{{ $errors->first('fname') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Last Name</label>
                                            <input type="text" class="form-control form-control-sm @error('lname') is-invalid @enderror " id="lname"
                                                name="lname" placeholder="Last Name" value="{{old('lname')}}">
                                                @if ($errors->has('lname'))
                                                <div class="text-danger">{{ $errors->first('lname') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Date OF Birth</label>
                                            <input type="date" class="form-control form-control-sm @error('dob') is-invalid @enderror " id="dob"
                                                name="dob" placeholder="Enter Date OF Birth" value="{{old('dob')}}">
                                                @if ($errors->has('dob'))
                                                <div class="text-danger">{{ $errors->first('dob') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Email Address</label>
                                            <input type="email" class="form-control form-control-sm @error('email') is-invalid @enderror " id="email"
                                                name="email" placeholder="Enter Email Address" value="{{old('email')}}">
                                                @if ($errors->has('email'))
                                                <div class="text-danger">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Phone No</label>
                                            <input type="text" class="form-control form-control-sm @error('number') is-invalid @enderror " id="number"
                                                name="number" placeholder="Enter Number" value="{{old('number')}}">
                                                @if ($errors->has('number'))
                                                <div class="text-danger">{{ $errors->first('number') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="title">Gender</label>
                                        <div class="form-group d-flex">
                                            <div class="form-check mr-3">
                                                <input class="form-check-input @error('gender') is-invalid @enderror" checked type="radio" name="gender" value="M">
                                                <label class="form-check-label">Male</label>
                                              </div>
                                            <div class="form-check">
                                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="F">
                                                <label class="form-check-label">Female</label>
                                              </div>
                                        </div>
                                        @if ($errors->has('gender'))
                                        <div class="text-danger">{{ $errors->first('gender') }}</div>
                                    @endif
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Commission (AED)</label>
                                            <input type="text" class="form-control form-control-sm @error('commission') is-invalid @enderror " id="commission"
                                                name="commission" placeholder="Enter Commission" value="{{old('commission')}}">
                                                @if ($errors->has('commission'))
                                                <div class="text-danger">{{ $errors->first('commission') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Branch:</label>
                                            <select class="select2 " multiple="multiple" name="branch[]"  style="width: 100%;" data-placeholder="Select Branch" >
                                                @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}">
                                                        {{ $branch->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Service Provides:</label>
                                            <select class="select2 " name="service[]" multiple="multiple" style="width: 100%;" data-placeholder="Select Services" >
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">
                                                        {{ $service->name }}
                                                    </option>
                                                @endforeach
                                            </select>
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
    <!-- /.content -->
@endsection

@section('scripts')
    @include('jpanel.employee.ajax')
@endsection
