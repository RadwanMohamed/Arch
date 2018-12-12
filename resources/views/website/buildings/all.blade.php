@extends('layouts.app')
@section('title')
    {{siteSetting('sitename')}}
@endsection

<!--

<div class="flex-center position-ref full-height">
    @if (Route::has('login'))
    <div class="top-right links">
@auth
        <a href="{{ url('/home') }}">Home</a>
            @else
        <a href="{{ route('login') }}">Login</a>

                @if (Route::has('register'))
            <a href="{{ route('register') }}">Register</a>
                @endif
    @endauth
        </div>
    @endif



    </div>
-->

<!------ Include the above in your HEAD tag ---------->
@section('header')
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
    {!! Html::style('/customs/buildings.css') !!}
    {!! Html::script('/customs/buildings.js') !!}

@endsection
@section('content')

    <div class="col-sm-4 col-md-3 sidebar" style="float: right">
        <div class="mini-submenu">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </div>
        <div class="list-group">
                          <span href="#" class="list-group-item active" style="background-color: #2ABB9B">
                                تصفية النتائج
                                <span class="pull-right" id="slide-submenu">
                                    <i class="fa fa-times"></i>
                                </span>
                          </span>
            <a href="{{url('/buildings')}}" class="list-group-item">
                <span class="pull-right">

                    جميع العقارات
                </span>
                <span class="badge pull-left">{{typeCount()}}</span>
            </a>

            <a href="/buildings/possession/0" class="list-group-item">
                <span class="pull-right">
                    ايجار

                </span>

                <span class="badge pull-left">{{typeCount('property',"0")}}</span>
            </a>

            <a href="/buildings/possession/1" class="list-group-item">

                <span class="pull-right">
                     تمليك
                </span>

                <span class="badge pull-left">{{typeCount('property','1')}}</span>
            </a>
            @foreach(buildingTypes() as $type)
                <a href="/buildings/type/{{$type->id}}" class="list-group-item">
                    <span class="pull-right">{{$type->name}}</span>
                    <span class="badge pull-left">  {{typeCount('type_id',$type->id)}}</span>

                </a>
            @endforeach
        </div>
    </div>


    <div class="container">
        <div class="row " style="display:block;">
            @if(count($buildings) > 0)
            @foreach($buildings as $key => $building)
                @if($key%3 ==0 && $key !=0 )
                    <div class="clearfix"></div>
        </div>
        <div class="row" style="display:block;">
            @endif
            <div class="col-sm-3">
                <article class="col-item">

                    <div class="photo">
                        <a href="#"> <img src="https://unsplash.it/500/300?image=0" class="img-responsive"
                                          alt="Product Image"/> </a>
                    </div>

                    <div class="info">
                        <div class="row">
                            <div class="price-details col-md-12">
                                <p class="details">
                                    {{$building->desc}}
                                </p>
                                <h1>{{$building->name}} </h1>
                                <span class="price-new">${{$building->price}}</span>
                            </div>
                        </div>

                        <div class="separator clear-left">
                            <p>
                                <a href="#" class="hidden-sm"> اظهر التفاصيل </a>
                            </p>

                        </div>
                        <div class="clearfix"></div>
                    </div>
                </article>
            </div>
            @endforeach

        </div>
        @else
            <div class=" col-lg-8 alert alert-warning" >
                    <span style="float: right">
                                            طلبك غير متاح


                    </span>
            </div>
        @endif
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="center-block">
            {{$buildings->links()}}

        </div>

    </div>

@endsection



{{--<div class="col-sm-3">
    <article class="col-item">
        <div class="photo">
            <div class="options">
                <button class="btn btn-default" type="submit" data-toggle="tooltip" data-placement="top" title="Add to wish list">
                    <i class="fa fa-heart"></i>
                </button>
                <button class="btn btn-default" type="submit" data-toggle="tooltip" data-placement="top" title="Compare">
                    <i class="fa fa-exchange"></i>
                </button>
            </div>
            <div class="options-cart">
                <button class="btn btn-default" title="Add to cart">
                    <span class="fa fa-shopping-cart"></span>
                </button>
            </div>
            <a href="#"> <img src="https://unsplash.it/500/300?image=0" class="img-responsive" alt="Product Image" /> </a>
        </div>
        <div class="info">
            <div class="row">
                <div class="price-details col-md-6">
                    <p class="details">
                        Lorem ipsum dolor sit amet, consectetur..
                    </p>
                    <h1>Sample Product</h1>
                    <span class="price-new">$110.00</span>
                </div>
            </div>
        </div>
    </article>
</div>
<div class="col-sm-3">
    <article class="col-item">
        <div class="photo">
            <div class="options-cart-round">
                <button class="btn btn-default" title="Add to cart">
                    <span class="fa fa-shopping-cart"></span>
                </button>
            </div>
            <a href="#"> <img src="https://unsplash.it/500/300?image=0" class="img-responsive" alt="Product Image" /> </a>
        </div>
        <div class="info">
            <div class="row">
                <div class="price-details col-md-6">
                    <p class="details">
                        Lorem ipsum dolor sit amet, consectetur..
                    </p>
                    <h1>Sample Product</h1>
                    <span class="price-new">$110.00</span>
                </div>
            </div>
        </div>
    </article>
    <p class="text-center">Hover over image</p>
</div>


            <div class="col-sm-3">
                <article class="col-item">
                    <div class="options">
                        <button class="btn btn-default" type="submit" data-toggle="tooltip" data-placement="top" title="Add to wish list">
                            <i class="fa fa-heart"></i>
                        </button>
                        <button class="btn btn-default" type="submit" data-toggle="tooltip" data-placement="top" title="Compare">
                            <i class="fa fa-exchange"></i>
                        </button>
                    </div>
                    <div class="photo">
                        <a href="#"> <img src="https://unsplash.it/500/300?image=0" class="img-responsive" alt="Product Image" /> </a>
                    </div>
                    <div class="info">
                        <div class="row">
                            <div class="price-details col-md-6">
                                <p class="details">
                                    Lorem ipsum dolor sit amet, consectetur..
                                </p>
                                <h1>Sample Product</h1>
                                <span class="price-new">$110.00</span>
                            </div>
                        </div>
                    </div>
                </article>
            </div>--}}
