@extends('jpanel.layouts.app')
@section('title')
    Add New Service
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Service</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('list.services') }}">View Services</a></li>
                        <li class="breadcrumb-item active">Add Service</li>
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
                    <form action="{{ route('store.services') }}" method="post">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">New Service Add Form</h3>
                                <div class="card-tools">
                                    <a href="{{ route('list.services') }}" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-eye"></i> View All Services
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
                                            <label for="title">Name</label>
                                            <input type="text" class="form-control form-control-sm @error('name') is-invalid @enderror " id="name"
                                                name="name" placeholder="Service Name" value="{{old('name')}}">
                                                @if ($errors->has('name'))
                                                <div class="text-danger">{{ $errors->first('name') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Price (AED)</label>
                                            <input type="text" class="form-control form-control-sm @error('price') is-invalid @enderror " id="price"
                                                name="price" placeholder="Enter Price" value="{{old('price')}}">
                                                @if ($errors->has('price'))
                                                <div class="text-danger">{{ $errors->first('price') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">VAT (%)</label>
                                            <input type="text" readonly class="form-control form-control-sm @error('gst') is-invalid @enderror " id="gst"
                                                name="gst" placeholder="Enter Gst percentage" value="5">
                                                @if ($errors->has('gst'))
                                                <div class="text-danger">{{ $errors->first('gst') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        {{-- <div class="form-group">
                                            <label for="title">Service Time (Minutes)</label>
                                            <input type="text" class="form-control form-control-sm @error('time') is-invalid @enderror " id="time"
                                                name="time" placeholder="Enter Minutes" value="{{old('time')}}">
                                                @if ($errors->has('time'))
                                                <div class="text-danger">{{ $errors->first('time') }}</div>
                                            @endif
                                        </div> --}}
                                        <div class="form-group">
                                            <label>Service Time (Minutes)</label>
                                            <select class="form-control form-control-sm @error('time') is-invalid @enderror " id="time" placeholder="Enter Minutes" value="{{old('time')}}"  name="time">
                                              <option value="15">15 minutes</option>
                                              <option value="30">30 minutes</option>
                                              <option  value="60">60 minutes</option>
                                              <option  value="90">90 minutes</option>
                                              <option  value="120">120 minutes</option>
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
    <!-- /.content -->
@endsection

@section('scripts')
    {{-- @include('jpanel.catalog.ajax') --}}
@endsection
