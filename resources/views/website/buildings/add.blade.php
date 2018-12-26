@extends("layouts.app")
@section('title')
اضافة عقار
@endsection

@section('header')


    {!! Html::style('customs/addbuilding.css') !!}
@endsection


@section('content')
    <div class="container register">
        <div class="row">
            <div class=" register-left">
                <img src="https://image.ibb.co/n7oTvU/logo_white.png" alt=""/>
                <h3>مرحبا بك فى موقعنا</h3>
                <p>انت الان على بعد 30 ثانية من فعل شئ عظيم وكسب  الاموال</p>
            </div>
            <div class="col-md-9 register-right" >

                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane  show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading"> قم بعرض عقارك الان بابسط المتطلبات </h3>
                        <form method="POST" action="/building/store" enctype="multipart/form-data">
                        @csrf
                        <div class="row register-form" style="margin-right: 90px" >
                            <div class="col-md-8 pull-right">
                                <div class=" {{ $errors->has('name') ? ' has-error' : '' }}" >
                                    {{--<input id="name" placeholder="الاسم" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}
                                    <label for="name" style="float: right"> الاسم </label>
                                    {!! Form::text('name',isset($user->name)? $user->name : null ,['class' => 'form-control']) !!}
                                    @if ($errors->has('name'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('name') }}</strong>
                                         </span>
                                    @endif
                                </div>
                                <div class=" {{ $errors->has('price') ? ' has-error' : '' }}" style="margin-top:17px">
                                    {{--<input id="name" placeholder="الاسم" type="text" class="form-control" name="name" value="{{ old('name') }}" required autofocus>--}}
                                    <label for="name" style="float: right"> السعر </label>
                                    {!! Form::text('price', null ,['class' => 'form-control']) !!}
                                    @if ($errors->has('price'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('price') }}</strong>
                                         </span>
                                    @endif
                                </div>

                                <div class=" {{ $errors->has('meta') ? ' has-error' : '' }}">
                                    <label for="name" style="float: right"> الكلمات الدلالية  </label>
                                    {!! Form::textarea('meta', null ,['class' => 'form-control']) !!}
                                    @if ($errors->has('meta'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('meta') }}</strong>
                                         </span>
                                    @endif
                                </div>
                                <div class=" {{ $errors->has('property') ? ' has-error' : '' }}">
                                    <label for="name" style="float: right"> نوع الملكية </label>
                                    {!! Form::select('property', ['0' => 'ايجار', '1' => 'ملك'],null,['class' => 'form-control']);!!}
                                    @if ($errors->has('property'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('property') }}</strong>
                                         </span>
                                    @endif
                                </div>
                                <div class=" {{ $errors->has('type_id') ? ' has-error' : '' }}">
                                    <label for="name" style="float: right"> نوع العقار </label>
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

                            <div class="col-lg-8 pull-left">
                                <div class="form-group row">
                                    <div class="col-md-12 {{ $errors->has('square') ? ' has-error' : '' }}" >
                                        <label for="name" style="float: right"> المساحة </label>
                                        {!! Form::text('square', null ,['class' => 'form-control']) !!}
                                        @if ($errors->has('square'))
                                            <span class="help-block">
                                             <strong>{{ $errors->first('square') }}</strong>
                                         </span>
                                        @endif
                                    </div>
                                </div>
                                <div class=" {{ $errors->has('rooms') ? ' has-error' : '' }}">
                                    <label for="name" style="float: right"> عدد الغرف </label>
                                    {!! Form::text('rooms', null ,['class' => 'form-control']) !!}
                                    @if ($errors->has('rooms'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('rooms') }}</strong>
                                         </span>
                                    @endif
                                </div>
                                <div class=" {{ $errors->has('description') ? ' has-error' : '' }}">
                                    <label for="name" style="float: right"> وصف العقار </label>
                                    {!! Form::textarea('description', null ,['class' => 'form-control',"cols"=>20]) !!}
                                    @if ($errors->has('description'))
                                        <span class="help-block">
                                             <strong>{{ $errors->first('description') }}</strong>
                                         </span>
                                    @endif
                                </div>

                                    <div class="select2{{ $errors->has('address_id') ? ' has-error' : '' }}">
                                        <label for="name" style="float: right"> مكان العقار </label>
                                        {{--{!! Form::text('address', null ,['class' => 'form-control']) !!}--}}
                                        <select  class="form-control select" name="address_id" >

                                        </select>

                                        @if ($errors->has('address_id'))
                                            <span class="help-block">
                                             <strong>{{ $errors->first('address_id') }}</strong>
                                         </span>
                                        @endif
                                    </div>

                                <div class="{{$errors->has('images') ? ' has-error' : '' }}">
                                    <label for="name" style="float: right"> صور العقار(5 صور كافية ) </label>
                                    <input type="file" multiple name="images[]" placeholder="اضف صور للعقار"class="form-control">

                                    @if ($errors->has('images'))
                                        <span class="help-block">

                                            <strong>
                                                 {{ $errors->first('images') }}
                                             </strong>

                                         </span>
                                    @endif
                                </div>
                                <button class="btnRegister" style="margin-right:-100px "> انشاء عقار جديد </button>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

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
