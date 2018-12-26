@extends('layouts.app')
@section('title')
    تواصل معنا
@endsection

@section('header')
    {!! Html::style('contact/reset.css') !!}
    {!! Html::style('contact/style.css') !!}
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <!------ Include the above in your HEAD tag ---------->

@endsection

@section('content')


    <div class="container ">
        <div class="row">
            <div class="well well-sm contact-form">
                <div class="col-md-8 contact-inputs">
                    <form action="{{route('contactus.store')}}" method="post" novalidate>
                        @csrf
                        <div class="row">

                                <div class="col-md-12">
                                    <div class="col-md-6 {{$errors->has('message')? 'has-error' : ''}} ">
                                        <div class="form-group">
                                            <label  for="name">
                                            الرسالة
                                            </label>
                                            <textarea name="message" id="message" class="form-control" name="message" rows="9" cols="25" required="required"
                                                      placeholder="Message"></textarea>
                                            @if ($errors->has('message'))
                                            <span class="help-block" >
                                                <strong>{{ $errors->first('message') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group {{$errors->has('name')? 'has-error' : ''}}">
                                            <label for="name">
                                            الاسم
                                            </label>
                                            <input type="text" class="form-control" id="name" placeholder="Enter name" name="name" required="required" />
                                            @if ($errors->has('name'))
                                                <span class="help-block" >
                                                <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>

                                        <div class="form-group {{$errors->has('email')? 'has-error' : ''}}">
                                            <label for="email">
                                                البريد الالكتروني
                                            </label>
                                            <div class="input-group ">
                                                <input type="email" class="form-control contact-email" id="name" name="email" placeholder="Enter name" required="required" />
                                                @if ($errors->has('email'))
                                                    <span class="help-block" >
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group {{$errors->has('subject')? 'has-error' : ''}}">
                                            <label for="subject">
                                                عنوان الرسالة
                                            </label>
                                            <select id="subject" name="subject" class="form-control" required="required">
                                                @foreach(subject() as $s)
                                                <option value="{{$s}}" selected="">{{$s}}</option>
                                               @endforeach
                                            </select>
                                            @if ($errors->has('subject'))
                                                <span class="help-block" >
                                                <strong>{{ $errors->first('subject') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <button type="submit" class="banner_btn pull-right contact-button" id="btnContactUs">
                                    ارسل الرسالة
                                    </button>
                                </div>
                        </div>
                    </form>

                </div>
                <div class="col-md-4">
                    <form>
                        <legend><span class="glyphicon glyphicon-globe pull-right">مقرنا</span>  </legend>
                        <div class="product-payment-details" style="height: 388px">

                            <dl class="mb-5 pull-right" style="margin-right: -20px">
                                <dt class="col-sm-3 pull-right">الايميل :</dt>
                                <dd class="col-sm-7">{{siteSetting('email')}}</dd>

                                <dt class="col-sm-3 pull-right">التليفون : </dt>
                                <dd class="col-sm-7">{{siteSetting('phone')}}</dd>
                                <br>
                                <dt class="col-sm-3 pull-right">العنوان : </dt>
                                <dd class="col-sm-7"> {{siteSetting('address')}} </dd>

                                <br>
                            </dl>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection


@section('footer')
@endsection
