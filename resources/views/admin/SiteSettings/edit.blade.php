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
                        <form action="{{route('settings.update')}}" method="post">
                            @csrf
                            {{method_field("PUT")}}
                            @foreach($siteSettings as $setting)
                                <div class="form-group row">

                                    <div class="col-md-6 {{ $errors->has($setting->name) ? ' has-error' : '' }}">
                                        {{--<input id="name" placeholder="الاسم" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}

                                        {!! Form::label('name',$setting->slug )!!}
                                        @if($setting->type == 0)
                                            {!! Form::text($setting->name,$setting->value,['class' => 'form-control']) !!}
                                        @else
                                            {!! Form::Textarea($setting->name,$setting->value,['class' => 'form-control']) !!}
                                        @endif
                                        @if ($errors->has($setting->name))
                                            <span class="help-block">
                                            <strong>{{ $errors->first($setting->name) }}</strong>
                                       </span>
                                        @endif
                                    </div>
                                </div>
                            @endforeach
                            <input type="hidden" value="{{$setting->id}}" name="id" readonly >


                            <div class="form-group row mb-2">
                                <div class="col-md-1 ">
                                    <button type="submit" class="btn btn-success">
                                        تسجيل عضو
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


