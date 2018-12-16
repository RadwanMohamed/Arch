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
                                            <a href="{{url('/buildings/')}}" class="btn btn-link">الرجوع لجميع العقارات</a>

                                            <ol class="breadcrumb">
                                                <li class="breadcrumb-item"><a href="{{url('/')}}">الرئيسية</a></li>

                                                <li class="breadcrumb-item">
                                                    <a href="{{url('/buildings/possession')}}/{{$building->property}}">
                                                        {{propertyName($building->property)}}
                                                    </a>
                                                </li>
                                                <li class="breadcrumb-item"><a href="{{route('search',['rooms'=>$building->rooms])}}">{{$building->rooms}} غرف</a></li>
                                                <li class="breadcrumb-item"><a href="{{url('/buildings/type')}}/{{$building->type_id}}">{{$building->type->name}}</a></li>
                                                <li class="breadcrumb-item active" aria-current="page">T-Shirts</li>
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
                                                <dd class="col-sm-7">200م</dd>
                                                <dt class="col-sm-3">المساحة</dt>

                                                <dd class="col-sm-7">ايجار</dd>
                                                <dt class="col-sm-3">الملكية</dt>
                                                <br>
                                                <dd class="col-sm-7">4 غرف</dd>
                                                <dt class="col-sm-3">عدد الغرف</dt>

                                                <dd class="col-sm-7">فيلا</dd>
                                                <dt class="col-sm-3">النوع</dt>
                                                <br>
                                                <dd class="col-sm-7">1000 جنيه</dd>
                                                <dt class="col-sm-3">السعر</dt>
                                                <br>
                                                <dd class="col-sm-7">2010/2016</dd>
                                                <dt class="col-sm-3">تاريخ المنتج</dt>
                                                <br>
                                            </dl>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="product-seller-recommended">


                                            <!-- /.recommended-items-->
                                            <div class="product-description mb-5">
                                                <div class="col-lg-12">
                                                    <h2 class="mb-5 pull-right">اسم العقار</h2>

                                                </div>

                                                <hr>

                                                <p>شدّت الولايات جعل عن. عل بين أمام بالعمل, شيء منتصف استدعى أي, لمّ كثيرة يرتبط مقاومة ثم. دأبوا تجهيز مما أن. و العصبة العظمى التكاليف كان. مع حين حكومة حادثة الشهير.

                                                    تم وصل قائمة الخاصّة. دنو ان أواخر ميناء. جهة بتخصيص وقدّموا الفرنسية هو. اعلان معزّزة اتفاقية جُل ما. بل أخرى مواقعها الأبرياء تعد.

                                                    سابق وزارة و لها, بـ جنوب بهيئة الإمتعاض نفس. لان لم أحكم ا للحكومة, قد أضف وحتى اتفاق أصقاع, و أسر لكون حالية ضمنها. ضرب أم عقبت الضروري الشهيرة, قد عدم ماذا ايطاليا، الفرنسية, كل أضف معاملة الرئيسية. غريمه وأكثرها بعض ما. عدد في عملية علاقة التغييرات.

                                                    أم غير وعلى الواقعة, حصدت المشتّتون بين قد, إيو في بشكل وسمّيت. لمّ بخطوط الوراء العاصمة إذ. كل يكن ليبين الصعداء, تاريخ بالحرب المؤلّفة مما هو. بل حاول اتفاقية التقليدية الى, تم هذه الخاسرة التخطيط, بل خيار جديدة الى. ما ذات بهيئة الأسيوي, قتيل، بتطويق المنتصر أم حتى.</p>
                                            </div>

                                            <h3 class="mb-5">عرض المزيد من متجر احمد </h3>

                                            <div class="recommended-items card-deck">
                                                <div class="card">
                                                    <img src="https://via.placeholder.com/157x157" alt=""
                                                         class="card-img-top">
                                                    <div class="card-body">
                                                        <h5 class="card-title">U$ 55.00</h5>
                                                        <span class="text-muted"><small>  - الغرف -الملكية  - المساحة - النوع</small></span>
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <img src="https://via.placeholder.com/157x157" alt=""
                                                         class="card-img-top">
                                                    <div class="card-body">
                                                        <h5 class="card-title">U$ 55.00</h5>
                                                        <span class="text-muted"><small>T-Shirt Size X - Large - Nickony Brand</small></span>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <img src="https://via.placeholder.com/157x157" alt=""
                                                         class="card-img-top">
                                                    <div class="card-body">
                                                        <h5 class="card-title">U$ 55.00</h5>
                                                        <span class="text-muted"><small>T-Shirt Size X - Large - Nickony Brand</small></span>
                                                    </div>
                                                </div>
                                                <div class="card">
                                                    <img src="https://via.placeholder.com/157x157" alt=""
                                                         class="card-img-top">
                                                    <div class="card-body">
                                                        <h5 class="card-title">U$ 55.00</h5>
                                                        <span class="text-muted"><small>T-Shirt Size X - Large - Nickony Brand</small></span>
                                                    </div>
                                                </div>

                                            </div>
                                            <p class="mb-5 mt-5"><a href="#">See all ads from this seller</a></p>

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
