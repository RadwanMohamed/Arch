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
            <span href="#" class="list-group-item active" style="background-color: rgba(0,0,0,.03);">
                <span class="pull-right" style="color: #1a2226">
                    تصفية النتائج
                </span>
                <span class="pull-left" id="slide-submenu" style="color: #1a2226">
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
                                            @foreach(range(200,1000,200) as $range)
                                                <label
                                                    class="element-animation1 btn btn-lg btn-primary btn-block price-filter"
                                                    href="">
                                                <span class="btn-label">
                                                    <i class="glyphicon glyphicon-chevron-right"></i>
                                                </span>
                                                    <input type="radio" name="price" class="price-input"
                                                           value="{{$range}}">
                                                    <center>
                                                        {{($range == 1000)? '800 الف : مليون جنيه '  : ($range-200) . ' : ' . ($range) .'  الف  '   }}
                                                    </center>
                                                </label>
                                            @endforeach

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


                                        <div class="qty mt-5 rooms-no">
                                            <span class="plus bg-dark">+</span>
                                            <input type="text" class="count" name="rooms-filter" value="1">
                                            <span class="minus bg-dark">-</span>
                                        </div>

                                        <div class="qty mt-5">
                                            <button type="submit" class="btn btn-primary rooms-filter">
                                                <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
                                            </button>
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

@yield('buildings')



@endsection

@section('footer')
    {!! Html::script('/customs/request.js') !!}

@endsection

{{--
gazel

--}}
