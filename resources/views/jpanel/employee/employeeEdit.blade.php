@extends('jpanel.layouts.app')
@section('title')
    Edit Employee
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Employee</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('list.employee') }}">View Employees</a></li>
                        <li class="breadcrumb-item active">Edit Employee</li>
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
                    <form action="{{ route('update.employee',$employee->id) }}" method="post">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">  Edit Employee</h3>
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
                                                name="fname" placeholder="First Name" value="{{$employee->fname}}">
                                                @if ($errors->has('fname'))
                                                <div class="text-danger">{{ $errors->first('fname') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Last Name</label>
                                            <input type="text" class="form-control form-control-sm @error('lname') is-invalid @enderror " id="lname"
                                                name="lname" placeholder="Last Name" value="{{$employee->lname}}">
                                                @if ($errors->has('lname'))
                                                <div class="text-danger">{{ $errors->first('lname') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Date OF Birth</label>
                                            <input type="date" class="form-control form-control-sm @error('dob') is-invalid @enderror " id="dob"
                                                name="dob" placeholder="Enter Date OF Birth" value="{{$employee->dob}}">
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
                                                name="email" placeholder="Enter Email Address" value="{{$employee->email}}">
                                                @if ($errors->has('email'))
                                                <div class="text-danger">{{ $errors->first('email') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Phone No</label>
                                            <input type="text" class="form-control form-control-sm @error('number') is-invalid @enderror " id="number"
                                                name="number" placeholder="Enter Number" value="{{$employee->phone}}">
                                                @if ($errors->has('number'))
                                                <div class="text-danger">{{ $errors->first('number') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label for="title">Gender</label>
                                        <div class="form-group d-flex">
                                            <div class="form-check mr-3">
                                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="M" @if ($employee->gender == 'M') checked @endif>
                                                <label class="form-check-label">Male</label>
                                              </div>
                                            <div class="form-check">
                                                <input class="form-check-input @error('gender') is-invalid @enderror" type="radio" name="gender" value="F"  @if ($employee->gender == 'F') checked @endif>
                                                <label class="form-check-label">Female</label>
                                              </div>
                                              @if ($errors->has('gender'))
                                              <div class="text-danger">{{ $errors->first('gender') }}</div>
                                          @endif
                                              
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Commission (AED)</label>
                                            <input type="text" class="form-control form-control-sm @error('commission') is-invalid @enderror " id="commission"
                                                name="commission" placeholder="Enter Commission" value="{{$employee->commission}}">
                                                @if ($errors->has('commission'))
                                                <div class="text-danger">{{ $errors->first('commission') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Branch:</label>
                                            <ul>
                                                @foreach ($branches as $branch)
                                                    <li>{{ $branch->branchDetails->name }} </li>      
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Services provided:</label>
                                            <ul>
                                                @foreach ($services as $service)
                                                    <li>{{ $service->servicesDetail->name }} </li>      
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- /.card-body -->
                            <div class="card-footer">
                                <button type="submit" class="btn btn-secondary btn-block">Update <i
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
