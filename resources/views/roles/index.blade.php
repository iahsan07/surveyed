@extends('layouts.admin-layout')
@section('title')Roles @endsection
@section('content')
    <section class="content-header">
        <h1>
            Roles
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{route('home')}}"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Roles</li>
        </ol>
    </section>

    <section class="content">
        <div class="box">
            <div class="box-header with-border">
                @if($createRole)
                    <a href="{{route('roles.create')}}" class="btn btn-primary">Create Role</a>
                @endif
            </div>

            <roles-index :edit-role="{{$editRole}}" :del-role="{{$deleteRole}}"></roles-index>

        </div>
    </section>
@endsection
