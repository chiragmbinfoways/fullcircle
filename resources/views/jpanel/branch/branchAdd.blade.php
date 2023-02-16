@extends('jpanel.layouts.app')
@section('title')
    Add New Branch
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Branch</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('list.branch') }}">View Branch</a></li>
                        <li class="breadcrumb-item active">Add Branch</li>
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
                    <form action="{{ route('store.branch') }}" method="post">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">New Branch Add Form</h3>
                                <div class="card-tools">
                                    <a href="{{ route('list.branch') }}" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-eye"></i> View All Branches
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
                                            <label for="title">Branch Name</label>
                                            <input type="text" class="form-control form-control-sm @error('bname') is-invalid @enderror " id="bname"
                                                name="bname" placeholder="Branch Name" value="{{old('bname')}}">
                                                @if ($errors->has('bname'))
                                                <div class="text-danger">{{ $errors->first('bname') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Address </label>
                                            <input type="text" class="form-control form-control-sm @error('address') is-invalid @enderror " id="address"
                                                name="address" placeholder="Enter Address " value="{{old('address')}}">
                                                @if ($errors->has('address'))
                                                <div class="text-danger">{{ $errors->first('address') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">City </label>
                                            <input type="text" class="form-control form-control-sm @error('city') is-invalid @enderror " id="city"
                                                name="city" placeholder="Enter City " value="{{old('city')}}">
                                                @if ($errors->has('city'))
                                                <div class="text-danger">{{ $errors->first('city') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Zipcode</label>
                                            <input type="text" class="form-control form-control-sm @error('zipcode') is-invalid @enderror " id="zipcode"
                                                name="zipcode" placeholder="Enter Zipcode " max="7" value="{{old('zipcode')}}">
                                                @if ($errors->has('zipcode'))
                                                <div class="text-danger">{{ $errors->first('zipcode') }}</div>
                                            @endif
                                        </div>
                                    </div>
                               
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Contact Number</label>
                                            <input type="text"  class="form-control  form-control-sm @error('number') is-invalid @enderror " id="number"
                                            name="number" placeholder="Enter Contact Number" max="10" value="{{old('number')}}">
                                            @if ($errors->has('number'))
                                            <div class="text-danger">{{ $errors->first('number') }}</div>
                                             @endif
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
    {{-- @include('jpanel.catalog.ajax') --}}
@endsection
