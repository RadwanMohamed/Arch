@extends('admin.layouts.app')


@section('title')
    اعدادات الموقع
@endsection






@section('content')

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> الرئيسية </a></li>

            <li class="active"> تعديل  اعدادات الموقع  </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> التعديل على اعدادات الموقع </h3>
                    </div>
                    @if (session('message'))
                        <div class="alert alert-info">
                            {{ session('message') }}
                        </div>
                @endif
                <!-- /.box-header -->
                    <div class="box-body">

                        <form action="{{url('admin-panel/site/settings/slider')}}" method="post" class="settingEdit" enctype="multipart/form-data" >
                            <div id="editformresults"></div>
                            @csrf

                                <div class="form-group row">

                                    <div class="col-md-6 {{ $errors->has('image') ? ' has-error' : '' }}">
                                        {{--<input id="name" placeholder="الاسم" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}

                                        {!! Form::label('name',' صورة السليدر (يجب ان يكون طول الصورة 500  وعرضها 1600بيكسل) ' )!!}

                                            {!! Form::file('image',['class' => 'form-control']) !!}

                                        @if ($errors->has('image'))
                                            <span class="help-block">
                                            <strong>{{ $errors->first('image') }}</strong>
                                       </span>
                                        @endif
                                    </div>
                                </div>



                            <div class="form-group row mb-2">
                                <div class="col-md-1 ">
                                    <button type="submit" class="btn btn-success save">
                                        تعديل الاعدادات
                                    </button>
                                </div>
                            </div>

                        </form>
                        @if(hasSlider() != false)
                        <hr>
                        <form action="{{url('admin-panel/site/settings/slider/restore')}}" method="post">
                            @csrf
                            <div class="form-group row mb-2">
                                <div class="col-md-1 ">
                                    <button type="submit" class="btn btn-danger">
                                    اعادة السليدر الاصلي
                                    </button>
                                </div>
                            </div>
                        </form>
                        @endif
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



