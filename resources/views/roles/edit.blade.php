@extends('layouts.admin-layout')
@section('title')Roles | Edit Role @endsection
@section('content')
    <section class="content-header">
        <h1>
            Roles
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li><a href="{{route('roles.index')}}"><i class="fa fa-dashboard"></i> Roles</a></li>
            <li class="active">Edit Role</li>
        </ol>
    </section>

    <section class="content">
        <div class="row">
            <!-- left column -->
            <div class="col-md-12">
                <!-- general form elements -->
                <div class="box box-primary">
                    <div class="box-header with-border">
                        <h3 class="box-title">Edit Role</h3>
                    </div>
                    <!-- /.box-header -->
                    <!-- form start -->
                    <roles-create :role-obj="{{$role}}"></roles-create>

                </div>
            </div>
        </div>
    </section>
@endsection
