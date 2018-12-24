@extends('admin.layouts.app')


@section('title')
    اعدادات الموقع
@endsection






@section('content')

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> الرئيسية </a></li>

            <li class="active"> اضافة صور العقار  </li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> اضف صور للعقار </h3>
                    </div>
                    @if (session('message'))
                        <div class="alert alert-info">
                            {{ session('message') }}
                        </div>
                @endif
                <!-- /.box-header -->
                    <div class="box-body">

                        <form action="{{route("buildings.images.store",["building"=>$building->id])}}" method="post" class="settingEdit" enctype="multipart/form-data" >
                            <div id="editformresults"></div>
                            @csrf

                            <div class="form-group row">

                                <div class="col-md-6 {{ $errors->has('images') ? ' has-error' : '' }}">
                                    {{--<input id="name" placeholder="الاسم" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}

                                    {!! Form::label('name',' صور العقار ' )!!}

                                    {!! Form::file('images[]',['class' => 'form-control','multiple'=>true]) !!}

                                    @if ($errors->has('images'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('images') }}</strong>
                                       </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group row mb-2">
                                <div class="col-md-1 ">
                                    <button type="submit" class="btn btn-success save">
                                        اضافة صور
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



