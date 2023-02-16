@extends('jpanel.layouts.app')
@section('title')
    Admin Panel Settings
@endsection

@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Admin Panel Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Admin Panel Settings</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    @include('jpanel/flash-message')
                </div>
            </div>
            <div class="row">
                @if(hasAnyOnePermission('modules'))
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $totalModule }}</h3>
                            <p>Modules</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <a href="{{ route('list.module') }}" class="small-box-footer">
                            Manage Modules <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                @endif
                @if(hasAnyOnePermission('language'))
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $totalLanguage }}</h3>
                            <p>Language</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-language"></i>
                        </div>
                        <a href="{{ route('list.language') }}" class="small-box-footer">
                            Manage Language <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                @endif
                @if(hasAnyOnePermission('roles'))
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $totalRole }}</h3>
                            <p>Roles</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-user-tag"></i>
                        </div>
                        <a href="{{ route('list.role') }}" class="small-box-footer">
                            Manage Roles <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                    @endif
                </div>
                @if(hasAnyOnePermission('users'))
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $totalUser }}</h3>
                            <p>Users</p>
                        </div>
                        <div class="icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <a href="{{ route('list.users') }}" class="small-box-footer">
                            Manage Users <i class="fas fa-arrow-circle-right"></i>
                        </a>
                    </div>
                </div>
                @endif
                

            </div>

        </div>
    </section>
    <!-- /.content -->
@endsection
