@extends('admin.layouts.app')


@section('title')
    تعديل بيانات عضو
@endsection






@section('content')

    <section class="content-header">
        <h1>
            Data Tables
            <small>advanced tables</small>
        </h1>
        <ol class="breadcrumb">
            <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> الرئيسية </a></li>
            <li><a href="{{url('admin-panel/users')}}"> الاعضاء </a></li>
            <li class="active"> تعديل بيانات عضو </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> التعديل على البيانات </h3>
                    </div>
                    @if (session('message'))
                        <div class="alert alert-info">
                            {{ session('message') }}
                        </div>
                @endif
                    <!-- /.box-header -->
                    <div class="box-body">
                        {!! Form::open(['route' =>['users.update',$user->id], 'method' => 'put']) !!}
                            @include('admin.users.form')
                        {!! Form::close() !!}
                    </div>
                    <!-- /.box-body -->
                </div>
                <!-- /.box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
@endsection




