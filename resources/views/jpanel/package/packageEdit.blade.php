@extends('jpanel.layouts.app')
@section('title')
    Edit Package
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Package</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('list.package') }}">View Packages</a></li>
                        <li class="breadcrumb-item active">Edit Package</li>
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
                    <form action="{{ route('update.package',$package->id) }}" method="post">
                        @csrf

                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Edit Package Form</h3>
                                <div class="card-tools">
                                    <a href="{{ route('list.package') }}" class="btn btn-sm btn-secondary">
                                        <i class="fas fa-eye"></i> View All Packages
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
                                            <label for="title">Package Name</label>
                                            <input type="text" class="form-control form-control-sm @error('pname') is-invalid @enderror " id="pname"
                                                name="pname" placeholder="Package Name" value="{{$package->name}}">
                                                @if ($errors->has('bname'))
                                                <div class="text-danger">{{ $errors->first('pname') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Select Service </label>
                                            <select class="select2 " name="service"  style="width: 100%;" data-placeholder="Select service" >
                                                <option value=" {{ $package->service }}" selected>{{ $package->services->name}}</option>
                                                @foreach ($services as $service)
                                                    <option value="{{ $service->id }}">
                                                        {{ $service->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                                @if ($errors->has('service'))
                                                <div class="text-danger">{{ $errors->first('service') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Service Included (Times) </label>
                                            <input type="text" class="form-control form-control-sm @error('time') is-invalid @enderror " id="time"
                                                name="time" placeholder="Enter Time " value="{{$package->times}}">
                                                @if ($errors->has('time'))
                                                <div class="text-danger">{{ $errors->first('time') }}</div>
                                            @endif
                                        </div>
                                    </div>
                                     <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Total Amount (AED)</label>
                                            <input type="text" class="form-control form-control-sm @error('total') is-invalid @enderror " id="total"
                                                name="total" placeholder="Enter Total Amt " max="7" value="{{$package->total}}">
                                                @if ($errors->has('total'))
                                                <div class="text-danger">{{ $errors->first('total') }}</div>
                                            @endif
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
    {{-- @include('jpanel.catalog.ajax') --}}
@endsection
