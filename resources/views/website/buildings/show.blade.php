@extends('website.buildings.all')
@section('buildings')


    <div class="buildings">
        <div class="col-lg-9 pull-right">
            <div class="row request" style="">

                <div class="col-sm-12 width-view">
                    <article class="single">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card mb-10">
                                    <div class="card-header">
                                        <nav class="header-navigation">
                                            <a href="{{url('/buildings/')}}" class="btn btn-link">الرجوع لجميع
                                                العقارات</a>

                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسية</a></li>

                                                <li class="breadcrumb-item">
                                                    <a href="{{url('/buildings/possession')}}/{{$building->property}}">
                                                        {{propertyName($building->property)}}
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a
                                                        href="{{route('search',['rooms'=>$building->rooms])}}">{{$building->rooms}}
                                                        غرف</a></li>
                                                <li class="breadcrumb-item"><a
                                                        href="{{url('/buildings/type')}}/{{$building->type_id}}">{{$building->type->name}}</a>
                                                </li>
                                                <li class="breadcrumb-item active"
                                                    aria-current="page">{{$building->name}}</li>
                                            </ol>

                                            <div class="btn-group">
                                                <a href="#" class="btn btn-link btn-share">Share</a>
                                                <a href="#" class="btn btn-link">اضف عقار </a>
                                            </div>
                                        </nav>
                                    </div>

                                    <div class="card-body store-body">

                                        <div class="product-info">
                                            <div class="product-gallery">
                                                <div class="product-gallery-featured">
                                                    <img src="https://via.placeholder.com/350x350/ffcf5b" alt="">
                                                </div>

                                                <div class="product-gallery-thumbnails"
                                                     style="margin-top: 10px; margin-left: 3px;">
                                                    <ol class="thumbnails-list list-unstyled">
                                                        <li><img src="https://via.placeholder.com/350x350/ffcf5b"
                                                                 alt=""></li>
                                                        <li><img src="https://via.placeholder.com/350x350/f16a22"
                                                                 alt=""></li>
                                                        <li><img src="https://via.placeholder.com/350x350/d3ffce"
                                                                 alt=""></li>
                                                        <li><img src="https://via.placeholder.com/350x350/7937fc"
                                                                 alt=""></li>
                                                        <li><img src="https://via.placeholder.com/350x350/930000"
                                                                 alt=""></li>
                                                    </ol>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="product-payment-details" style="height: 388px">
                                            <h2 class="mb-5 " style="margin-left: 50px"> المواصفات </h2>
                                            <dl class="mb-5">
                                                <dd class="col-sm-7">{{$building->square}} متر</dd>
                                                <dt class="col-sm-3">المساحة</dt>

                                                <dd class="col-sm-7">{{propertyName($building->property)}}</dd>
                                                <dt class="col-sm-3">الملكية</dt>
                                                <br>
                                                <dd class="col-sm-7">{{$building->rooms}} غرف</dd>
                                                <dt class="col-sm-3">عدد الغرف</dt>

                                                <dd class="col-sm-7">{{$building->type->name}}</dd>
                                                <dt class="col-sm-3">النوع</dt>
                                                <br>
                                                <dd class="col-sm-7">{{buildingPrice($building->price)}}  </dd>
                                                <dt class="col-sm-3">السعر</dt>
                                                <br>
                                                <dd class="col-sm-7">{{$building->address}}</dd>
                                                <dt class="col-sm-3">عنوان العقار </dt>
                                                <dd class="col-sm-7">{{$building->created_at->diffForHumans()}}</dd>
                                                <dt class="col-sm-3">تاريخ اضافة</dt>
                                                <br>
                                            </dl>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="product-seller-recommended">


                                            <!-- /.recommended-items-->
                                            <div class="product-description mb-5">
                                                <div class="col-lg-12 border-class">
                                                    <h2 class="mb-5 pull-right">{{$building->name}}</h2>

                                                </div>

                                                <p style="    text-align: justify;">
                                                    {{$building->description}}
                                                </p>


                                            </div>

                                            <h3 class="mb-5">
                                                عرض المزيد من عقارات
                                                <a href="{{url('/user/' .$building->user->id  .'/buildings/')}}">{{$building->user->name}} </a>
                                            </h3>
                                            <div class="recommended-items card-deck">
                                                @foreach($sameBuildings as $same)
                                                    <div class="card">
                                                        <img src="https://via.placeholder.com/157x157" alt=""
                                                             class="card-img-top">
                                                        <a href="{{url('/buildings/'.$same->id)}}" class="recommended-items-a">

                                                        <div class="card-body">
                                                            <h5 class="card-title">{{$same->price}}</h5>
                                                            <span class="text-muted"><small>   {{$same->rooms . ' غرف'}}  - {{propertyName($same->property)}}  - {{$same->square}} -  {{$same->type->name}}</small></span>
                                                        </div>
                                                        </a>

                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="separation">
                                            <p class="mb-5 mt-5"><a href="{{url('/user/' .$building->user->id  .'/buildings/')}}">
                                                   {{$building->user->name}} عرض جميع عقارات
                                                </a></p>
                                            </div>

                                            <h3 class="mb-5">
                                                عقارات اخري قد تهمك
                                            </h3>
                                            <div class="recommended-items card-deck">
                                                @foreach($sametype as $type)
                                                    <div class="card">
                                                        <img src="https://via.placeholder.com/157x157" alt=""
                                                             class="card-img-top">
                                                        <a href="{{url('/buildings/'.$type->id)}}" class="recommended-items-a">

                                                        <div class="card-body">
                                                            <h5 class="card-title">{{$type->price}}</h5>
                                                            <span class="text-muted"><small>   {{$type->rooms . ' غرف'}}  - {{propertyName($type->property)}}  - {{$type->square}} -  {{$type->type->name}}</small></span>
                                                        </div>
                                                        </a>

                                                    </div>
                                                @endforeach
                                            </div>
                                            <div class="separation">
                                            <p class="mb-5 mt-5"><a href="{{url('/buildings/type')}}/{{$type->type_id}}">
                                                    عرض جميع العقارات من هذا النوع
                                                </a></p>
                                            </div>


                                        </div>
                                    </div>

                                 </div>
                            </div>
                        </div>
                    </article>
                </div>


            </div>
        </div>
        <div class="clearfix"></div>

    </div>
    <br>
@endsection


@section('footer')
    {!! Html::script('/customs/request.js') !!}

    {!! Html::script('/customs/show.js') !!}

@endsection()
