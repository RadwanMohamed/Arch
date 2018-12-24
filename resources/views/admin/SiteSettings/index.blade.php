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

                        <form action="/buidings" method="post" class="settingEdit" enctype="multipart/form-data" >
                            <div id="editformresults"></div>
                            @csrf
                            {{method_field("PUT")}}
                            @foreach($siteSettings as $setting)
                                <div class="form-group row">

                                    <div class="col-md-6 {{ $errors->has($setting->name) ? ' has-error' : '' }}">
                                        {{--<input id="name" placeholder="الاسم" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}

                                        {!! Form::label('name',$setting->slug )!!}
                                        @if($setting->type == 0)
                                            {!! Form::text($setting->name ,$setting->value,['class' => 'form-control input']) !!}
                                        @else
                                            {!! Form::Textarea($setting->name,$setting->value,['class' => 'form-control input']) !!}
                                        @endif


                                    </div>
                                </div>
                            @endforeach


                            <div class="form-group row mb-2">
                                <div class="col-md-1 ">
                                    <button type="submit" class="btn btn-success save">
                                        تعديل الاعدادات
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


@section('footer')
    <script>

        $('.save').on('click',function (e) {
            e.preventDefault();
            Button = $(this);
            form = Button.parents('.settingEdit');
            data = form.serializeArray();
            result = form.find('#editformresults');
            $.ajax({
                type: 'POST',
                url: '/admin-panel/site/settings',
                data: data,
                dataType: 'json',
                error:function (data) {
                    result.removeClass().addClass('alert alert-warning').html(data.msg);
                },
                success:function (data) {
                    result.removeClass().addClass('alert alert-success').html(data.msg);
                    setTimeout(function() {
                        window.location.reload();
                    }, 1000);
                }
            })
        });

    /*
    var Data = [];
    for (var i = 1; i < (data.length / 2); i++) {
    Data[i] = [];
    for (var j = 0; j < 2; j++) {

    Data[i][j] = data[i + j + i];
    }
    }
    */

    </script>
@endsection




