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


    @yield('header')
</head>
<body style="direction: rtl" lang="ar" class="amiri">
    <div id="app">
        <nav class="">
            <div class="header">
                <div class="container"> <a class="navbar-brand" style="float: right" href="{{url('/')}}"><i class="fa fa-paper-plane"></i> ONE</a>
                    <div class="menu pull-left"> <a class="toggleMenu" href="#"><img src="{{Request::root()}}/website/images/nav_icon.png" alt="" /> </a>
                        <ul class="nav" id="nav">
                            <li class="current"><a href="{{url('/home')}}">الرئيسية</a></li>



                            <li >
                                <a  class="nav-link dropdown-toggle" href="{{url('/buildings')}}" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    العقارات
                                </a>


                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{url('/buildings')}}">
                                        كل العقارات المتاحة

                                    </a>

                                    @foreach(buildingTypes() as $type)
                                    <a class="dropdown-item" href="{{url('/buildings/type/'.$type->id)}}">
                                        {{$type->name}}

                                    </a>
                                    @endforeach
                                    <a class="dropdown-item" href="{{url('/buildings/possession/0')}}">
                                        ايجار

                                    </a>
                                    <a class="dropdown-item" href="{{url('/buildings/possession/1')}}">
                                        تمليك

                                    </a>
                                </div>



                            </li>

                            <li><a href="about.html">من نحن</a></li>
                            <li><a href="services.html">خدماتنا</a></li>
                            <li><a href="contact.html">اتصل بنا </a></li>
                            <li>
                                <!-- Authentication Links -->
                                @guest
                                    <li >
                                        <a  href="{{ route('login') }}">تسجبل الدخول</a>
                                    </li>
                                    <li class="nav-item">
                                        @if (Route::has('register'))
                                            <a class="nav-link" href="{{ route('register') }}"> تسجيل عضوية جديدة </a>
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
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                                {{ __('Logout') }}
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
                <div class="follow-us"> <a class="fa fa-facebook social-icon" href="#"></a> <a class="fa fa-twitter social-icon" href="#"></a> <a class="fa fa-linkedin social-icon" href="#"></a> <a class="fa fa-google-plus social-icon" href="#"></a> </div>
                <div class="copy">
                    <p>Copyright &copy; 2015 Company Name. Design by <a href="http://www.templategarden.com" rel="nofollow">TemplateGarden</a></p>
                </div>
            </div>
        </div>

    </div>


{!! Html::script('website/js/responsive-nav.js') !!}
    {!! Html::script('website/js/bootstrap.min.js') !!}
    {!! Html::script('website/js/jquery.flexslider.js') !!}
    {!! Html::script('js/app.js') !!}
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    @yield('footer')

</body>
</html>
