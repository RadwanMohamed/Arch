<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!--  website -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {!! Html::style('website/css/bootstrap.min.css') !!}
    {!! Html::style('website/css/flexslider.css') !!}
    {!! Html::style('css/app.css') !!}

    {!! Html::style('website/css/style.css') !!}
    {!! Html::style('website/css/font-awesome.min.css') !!}
    {!! Html::script('website/js/jquery.min.js') !!}

    <script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
    <link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900' rel='stylesheet' type='text/css'>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        {{ config('app.name', 'موقع العقارات') }} |
        @yield('title')
    </title>
    <link href="https://fonts.googleapis.com/css?family=Amiri" rel="stylesheet">

<style>
    .banner{
        background: url({{ getSlider()}}) no-repeat center;

    }

</style>
    @yield('header')
</head>
<body style="direction: rtl" lang="ar" class="amiri">
    <div id="app">
        <nav class="">
            <div class="header">
                <div class="container"> <a class="navbar-brand" style="float: right" href="{{url('/')}}"><i class="fa fa-paper-plane"></i> ONE</a>
                    <div class="menu pull-left"> <a class="toggleMenu" href="#"><img src="{{Request::root()}}/website/images/nav_icon.png" alt="" /> </a>
                        <ul class="nav" id="nav">
                            <li class="current"><a id="nav" href="{{url('/home')}}">الرئيسية</a></li>



                            <li >
                                <a id="nav" class="nav-link dropdown-toggle " href="{{url('/buildings')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    العقارات
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a id="nav" class="dropdown-item" href="{{url('/buildings')}}">
                                        كل العقارات المتاحة

                                    </a>

                                    @foreach(buildingTypes() as $type)
                                    <a id="nav" class="dropdown-item" href="{{url('/buildings/type/'.$type->id)}}">
                                        {{$type->name}}

                                    </a>
                                    @endforeach
                                    <a id="nav" class="dropdown-item" href="{{url('/buildings/possession/0')}}">
                                        ايجار

                                    </a>
                                    <a id="nav" class="dropdown-item" href="{{url('/buildings/possession/1')}}">
                                        تمليك

                                    </a>
                                </div>



                            </li>

                            <li><a id="nav" href="{{route('contactus.index')}}">اتصل بنا </a></li>
                            <li>
                                <!-- Authentication Links -->
                                @guest
                                    <li >
                                        <a id="nav" href="{{ route('login') }}">تسجبل الدخول</a>
                                    </li>
                                    <li class="nav-item">
                                        @if (Route::has('register'))
                                            <a class="nav-link" id="nav" href="{{ route('register') }}"> تسجيل عضوية جديدة </a>
                                        @endif
                                    </li>
                                    </li>
                                    <li>
                                @else
                                    <li >
                                        <a  class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                            {{ Auth::user()->name }}
                                        </a>

                                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                            <a class="dropdown-item" href="/building/add">
                                                         اضف عقار جديد
                                            </a>
                                            <a class="dropdown-item" href="{{url('/user/' .Auth::id() .'/buildings/')}}">
                                                         عرض جميع عقاراتي المفعلة
                                            </a>
                                            <a class="dropdown-item" href="{{url('/buildings/'.Auth::id().'/unactivated')}}">
                                                         عرض جميع العقارات الغير مفعلة
                                            </a>
                                            <a class="dropdown-item" href="/{{Auth::id()}}/password/reset">
                                                                                تغيير كلمة السر الخاصة بك
                                            </a>
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                               تسجيل الخروج
                                            </a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </li>

                                @endguest
                            <div class="clear"></div>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="container">

            </div>
        </nav>


            @yield('content')
        <div class="footer">
            <div class="footer_bottom">
                <div class="follow-us"> <a class="fa fa-facebook social-icon" href="{{siteSetting('facebook')}}"></a> <a class="fa fa-twitter social-icon" href="{{siteSetting('twitter')}}"></a> <a class="fa fa-linkedin social-icon" href="{{siteSetting('linkedin')}}"></a> <a class="fa fa-google-plus social-icon" href="{{siteSetting('google')}}"></a> </div>
                <div class="copy">
                    <p>{{siteSetting('copyright')}}</p>
                </div>
            </div>
        </div>

    </div>


{!! Html::script('website/js/responsive-nav.js') !!}
    {!! Html::script('website/js/bootstrap.min.js') !!}
    {!! Html::script('website/js/jquery.flexslider.js') !!}
    {!! Html::script('js/app.js') !!}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    {{--<script src="https://cdnjs.cloudflare.com/ajax/libs/jqu/ery/3.3.1/core.js"></script>--}}


    @yield('footer')

</body>
</html>
