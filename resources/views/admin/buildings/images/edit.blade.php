@extends('admin.layouts.app')


@section('title')
    تعديل صورة العقار
@endsection





@section('content')

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> الرئيسية </a></li>
            <li><a href="{{url('admin-panel/buildings/create')}}"> تعديل صورة العقار </a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">تعديل صورة العقار :
                            <a href="/admin-panel/buildings/{{$building->id}}/edit">{{$building->name}}</a>
                        </h3>
                    </div>
                    <div id="result"></div>
                    <!-- /.box-header -->
                    <div class="box-body">

                            <form action="{{route("buildings.images.update",["building"=>$building->id,"image"=>$image->id])}}" method="post" class="settingEdit" enctype="multipart/form-data" >
                                <div id="editformresults"></div>
                                @csrf
                                @method('PUT')
                                <div class="form-group row">

                                    <div class="col-md-6 {{ $errors->has('images') ? ' has-error' : '' }}">

                                        {!! Form::label('name',' تعديل صورة العقار ' )!!}

                                        {!! Form::file('images',['class' => 'form-control']) !!}

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





