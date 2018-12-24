@extends('admin.layouts.app')

@section('title')
    تعديل عقار
@endsection
@section('content')

    <section class="content-header">

        <ol class="breadcrumb">
            <li><a href="{{url('adminpanel')}}"><i class="fa fa-dashboard"></i> الرئيسية </a></li>
            <li><a href="{{url('admin-panel/buildings')}}"> العقارات </a></li>
            <li><a href="{{url("admin-panel/buildings/".$building->id."/images/")}}"> تعديل صورة العقار </a></li>
            <li class="active"><a href="{{url('admin-panel/buildings/create')}}">  اضف عقار جديد

                </a></li>
        </ol>
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-xs-12">

                <!-- /.box -->

                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title"> تعديل عقار </h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form method="POST" action="{{ route('buildings.update',$building->id) }}">
                            @csrf
                            @method('PUT')

                            @if (session('flash'))
                                <div class="alert alert-danger">
                                    {{ session('flash') }}
                                </div>
                            @endif
                            {{--'name', 'price', 'square', 'proberty', 'desc', 'meta', 'address', 'latitude', 'description', 'status', 'user_id', 'type_id'--}}

                            <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                                    {{--<input id="name" placeholder="الاسم" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}
                                    {{Form::label('name', ' الاسم ')}}
                                    {!! Form::text('name',$building->name ,['class' => 'form-control']) !!}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('name') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('price') ? ' has-error' : '' }}">
                                    {{--<input id="name" placeholder="الاسم" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}
                                    {{Form::label('price', ' السعر ')}}
                                    {!! Form::text('price', $building->price ,['class' => 'form-control']) !!}
                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('price') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('square') ? ' has-error' : '' }}">
                                    {{Form::label('square', ' المساحة الكلية ')}}
                                    {!! Form::text('square', $building->square ,['class' => 'form-control']) !!}
                                    @if ($errors->has('square'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('square') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('rooms') ? ' has-error' : '' }}">
                                    {{Form::label('rooms', ' عدد الغرف ')}}
                                    {!! Form::text('rooms', $building->rooms ,['class' => 'form-control']) !!}
                                    @if ($errors->has('rooms'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('rooms') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('property') ? ' has-error' : '' }}">
                                    {{Form::label('property', ' نوع الملكية ')}}
                                    {!! Form::select('property', ['0' => 'ايجار', '1' => 'ملك'],$building->proberty,['class' => 'form-control']);!!}
                                    @if ($errors->has('property'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('property') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('desc') ? ' has-error' : '' }}">
                                    {{Form::label('desc', ' وصف الموقع   (لايزيد عن 160 حرف) ')}}
                                    {!! Form::textarea('desc', $building->desc ,['class' => 'form-control']) !!}
                                    @if ($errors->has('desc'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('desc') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('meta') ? ' has-error' : '' }}">
                                    {{Form::label('meta', ' الكلمات الدلالية ')}}
                                    {!! Form::textarea('meta', $building->meta ,['class' => 'form-control']) !!}
                                    @if ($errors->has('meta'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('meta') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('address') ? ' has-error' : '' }}">
                                    {{Form::label('address', ' عنوان العقار  ')}}
                                    {{--{!! Form::text('address', null ,['class' => 'form-control']) !!}--}}
                                    <select  class="form-control select" name="address_id" >

                                    </select>
                                    @if ($errors->has('address'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('address') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>




                            <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('description') ? ' has-error' : '' }}">
                                    {{--<input id="name" placeholder="الاسم" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}
                                    {{Form::label('description', ' الوصف التفصيلى  ')}}
                                    {!! Form::text('description', $building->description ,['class' => 'form-control']) !!}
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('description') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('status') ? ' has-error' : '' }}">
                                    {{Form::label('status', '  حالة العقار ')}}
                                    {!! Form::select('status', ['0' => 'غير متاج', '1' => 'متاح'],$building->status,['class' => 'form-control']);!!}
                                    @if ($errors->has('status'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('status') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <div class="col-md-6 {{ $errors->has('type_id') ? ' has-error' : '' }}">
                                    {{Form::label('type', ' نوع العقار ')}}
                                    <select name="type_id" class="form-control">
                                        @foreach($types as $type)
                                            <option value="{{$type->id}}">
                                                {{$type->name}}
                                            </option>
                                        @endforeach
                                    </select>

                                    @if ($errors->has('type_id'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('type_id') }}</strong>
                                         </span>
                                    @endif
                                </div>
                            </div>



                            <div class="form-group row mb-2">
                                <div class="col-md-1 ">
                                    <button type="submit" class="btn btn-success">
                                        تعديل العقار
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
    {!! Html::style("website/css/select2.min.css") !!}
    {!! Html::script("website/js/select2.min.js") !!}

    <script>



        $('.select').select2({
            placeholder: 'مكان العقار',
            ajax: {
                url: '/countries',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }

        });

    </script>

@endsection
