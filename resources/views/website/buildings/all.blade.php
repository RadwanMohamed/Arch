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
                <span class="pull-right">
                    تصفية النتائج
                </span>
                <span class="pull-left" id="slide-submenu">
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
            <br>
            <div class="">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title pull-right">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseTwo">
                            <span class="glyphicon glyphicon-search spanicon" style="margin-right:10px;">
                            </span>
                                بحث متقدم

                            </a>
                        </h4>
                    </div>
                    <div id="collapseTwo" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <form class="form-horizontal" role="form" action="{{route('search')}}"
                                              method="get" class="form">
                                            <div class="input-group" id="adv-search">

                                                <input type="text" class="form-control search-input"
                                                       placeholder="Search for snippets" name="name"/>

                                                <div class="input-group-btn">
                                                    <div class="btn-group" role="group">
                                                        <div class="dropdown dropdown-lg">

                                                            <button type="button" class="btn btn-default"
                                                                    data-toggle="dropdown" aria-expanded="false"><span
                                                                    class="caret"></span></button>

                                                            <div
                                                                class="dropdown-menu dropdown-menu-right dropdown-search"
                                                                role="menu">

                                                                <div class="form-group">
                                                                    <label for="filter" class="search-label">نوع
                                                                        العقار</label>
                                                                    <select class="form-control" name="type_id">
                                                                        <option value=""> اختر من القائمة</option>
                                                                        @foreach(buildingTypes() as $type)

                                                                            <option
                                                                                value="{{$type->id}}">{{$type->name}}</option>

                                                                        @endforeach

                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="filter" class="search-label">ملكية
                                                                        العقار</label>
                                                                    <select class="form-control" name="property">
                                                                        <option value=""> اختر من القائمة</option>

                                                                        <option value="0"> ايجار</option>
                                                                        <option value="1"> تمليك</option>

                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <label for="contain" class="search-label"> عدد
                                                                        الغرف </label>
                                                                    <input class="form-control" type="text"
                                                                           name="rooms"/>
                                                                </div>

                                                                <button type="submit"
                                                                        class="btn btn-primary search"><span
                                                                        class="glyphicon glyphicon-search"
                                                                        aria-hidden="true"></span></button>

                                                            </div>
                                                        </div>
                                                        <button type="submit" class="btn btn-primary search">
                                                            <span
                                                                class="glyphicon glyphicon-search"
                                                                aria-hidden="true"></span>
                                                        </button>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>

                                    </td>
                                </tr>

                            </table>

                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title pull-right">

                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseThree">
                                <span class="glyphicon glyphicon-pencil	  spanicon">
                                </span>
                                <span style="float: right">حسب السعر</span>
                            </a>
                        </h4>
                    </div>
                    <div id="collapseThree" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>


                                    <div class="modal-body">
                                        <div class="col-xs-3 col-xs-offset-5">
                                            <div id="loadbar" style="display: none;">
                                                <div class="blockG" id="rotateG_01"></div>
                                                <div class="blockG" id="rotateG_02"></div>
                                                <div class="blockG" id="rotateG_03"></div>
                                                <div class="blockG" id="rotateG_04"></div>
                                                <div class="blockG" id="rotateG_05"></div>
                                                <div class="blockG" id="rotateG_06"></div>
                                                <div class="blockG" id="rotateG_07"></div>
                                                <div class="blockG" id="rotateG_08"></div>
                                            </div>
                                        </div>

                                        <div class="quiz" id="quiz" data-toggle="buttons">
                                            <label class="element-animation1 btn btn-lg btn-primary btn-block"><span
                                                    class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span>
                                                <input type="radio" name="q_answer" value="1">1 One</label>
                                            <label class="element-animation2 btn btn-lg btn-primary btn-block"><span
                                                    class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span>
                                                <input type="radio" name="q_answer" value="2">2 Two</label>
                                            <label class="element-animation3 btn btn-lg btn-primary btn-block"><span
                                                    class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span>
                                                <input type="radio" name="q_answer" value="3">3 Three</label>
                                            <label class="element-animation4 btn btn-lg btn-primary btn-block"><span
                                                    class="btn-label"><i class="glyphicon glyphicon-chevron-right"></i></span>
                                                <input type="radio" name="q_answer" value="4">4 Four</label>
                                        </div>
                                    </div>


                                </tr>

                            </table>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">
                            <a data-toggle="collapse" data-parent="#accordion" href="#collapseFour"><span
                                    class="glyphicon glyphicon-th spanicon" style="margin-left: 14px">
                            </span>عدد الغرف</a>
                        </h4>
                    </div>
                    <div id="collapseFour" class="panel-collapse collapse">
                        <div class="panel-body">
                            <table class="table">
                                <tr>
                                    <td>
                                        <div class="qty mt-5">
                                            <span class="plus bg-dark">+</span>

                                            <input type="number" class="count" name="qty" value="1">
                                            <span class="minus bg-dark">-</span>

                                        </div>

                                    </td>
                                </tr>


                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>



    <div class="col-lg-9 pull-right">
        @include('layouts.errors')
        <div class="row" style="display:block;">
            @if(count($buildings) > 0)
                @foreach($buildings as $key => $building)
                    @if($key%3 ==0 && $key !=0 )
                        <div class="clearfix"></div>

                    @endif
                    <div class="col-sm-4">
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

            @else
                <div class="row">
                    <div class="col-md-12">
                        <div class="error-template">
                            <h1>
                                !Oops</h1>

                            <div class="error-details">
                                نأسف لاخبارك ان هذا المنتج غير متاح حاليا!
                            </div>

                        </div>
                    </div>
                </div>

            @endif
        </div>
    </div>
    <div class="clearfix"></div>
    <div class="row">
        <div class="center-block">

            {{$buildings->appends(Request::input())->links()}}
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


