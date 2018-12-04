@extends('admin.layouts.app')


@section('title')
    تغيير كلمة المرور
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
            <li class="active"> تغيير كلمة السر الخاصة بك</li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">تغيير كلمة المرور</h3>
                    </div>
                    <!-- /.box-header -->
                    @if (session('message'))
                        <div class="alert alert-info">
                            {{ session('message') }}
                        </div>
                    @endif
                    <div class="box-body">
                        <form method="POST" action="/admin-panel/admin/{{Auth::user()->id}}" novalidate>
                            @csrf
                            @method('PUT')
                            <div class="form-group row">

                                <div class="col-md-6 {{ $errors->has('old_password') ? ' has-error' : '' }}">
                                    {{Form::label('password', 'كلمة المرور القديمة ')}}

                                    <input id="password" placeholder="كلمة المرور القديمة" type="password"
                                           class="form-control"
                                           name="old_password" autofocus required>

                                    @if ($errors->has('old_password'))
                                        <span class="help-block" role="alert">
                                             <strong>{{ $errors->first('old_password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">

                                <div class="col-md-6 {{ $errors->has('password') ? ' has-error' : '' }}">
                                    {{Form::label('password', 'كلمة المرور الجديدة')}}

                                    <input id="password" placeholder="كلمة المرور الجديدة" type="password"
                                           class="form-control"
                                           name="password" autofocus required>

                                    @if ($errors->has('password'))
                                        <span class="help-block" role="alert">
                                             <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="form-group {{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                    <div class="col-md-6">
                                        {{Form::label('password', 'تاكيد كلمة المرور ')}}

                                        <input id="password-confirm" placeholder="اعادة ادخال الباسورد" type="password"
                                               class="form-control" name="password_confirmation" autofocus required>
                                        @if ($errors->has('password_confirmation'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <input type="hidden" value="{{Auth::user()->id}}" name="id">
                            <div class="form-group row mb-2">
                                <div class="col-md-1 ">
                                    <button type="submit" class="btn btn-success">
                                        تغيير كلمة المرور
                                    </button>
                                </div>
                            </div>


                        </form>
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




