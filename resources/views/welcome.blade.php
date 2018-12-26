@extends('layouts.app')
@section('title')
    {{siteSetting('sitename')}}

@endsection
@section("header")
{!! Html::style("quickview/css/reset.css") !!}
{!! Html::style("quickview/css/style.css") !!}
{!! Html::script("quickview/js/modernizr.js") !!}

@endsection

@section('content')
    <div class="banner text-center">
        <div class="container">
            <div class="banner-info">
                <h1> ابحث معنا عن عقار مناسب لك </h1>
                <div id="collapse1" class="collapse show">
                    <form  role="form" action="{{route('search')}}" method="get" class="form">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3 col-lg-4">
                                <div class="form-group">
                                    {{--<label class="control-label">Last Name</label>--}}
                                    <input type="text" class="form-control"  placeholder="اسم العقار" name="name" />
                                </div>

                            </div>
                            <div class="col-md-1 col-lg-4">
                                <div class="form-group">
                                    {{--<label class="control-label">نوع العقار</label>--}}
                                    {{--<input type="text" class="form-control" />--}}
                                    <select class="form-control" name="type_id">
                                        <option value=""> نوع العقار</option>
                                        @foreach(buildingTypes() as $type)

                                            <option
                                                value="{{$type->id}}">{{$type->name}}</option>

                                        @endforeach

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-1 col-lg-1">
                                <div class="form-group">
                                    {{--<label class="control-label">Middle.I</label>--}}
                                    <input class="form-control" type="text" placeholder="المساحة" name="square" />
                                </div>
                            </div>

                            <div class="col-md-2 col-lg-3">
                                <div class="form-group">
                                    {{--<label class="control-label">Date Of Birth</label>--}}
                                    {{--<div class="input-group date">--}}
                                        {{--<input class="form-control" type="text" />--}}
                                        {{--<span class="input-group-append">--}}
                                    {{--<button class="btn btn-outline-secondary" type="button">--}}
                                        {{--<i class="fa fa-calendar"></i>--}}
                                    {{--</button></span>--}}
                                    {{--</div>--}}
                                    <select class="form-control select2" name="address_id">
                                        <option value=""> مكان العقار</option>
                                        {{--@foreach(address() as $address)--}}

                                            {{--<option value="{{$address->id}}">{{$address->name}}</option>--}}

                                        {{--@endforeach--}}

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row" style="margin-top: -24px">
                            <div class="col-md-4 col-lg-4">
                                <div class="form-group home-search-input">
                                    {{--<label class="control-label">Mailing Address</label>--}}
                                    {{--<input type="text" class="form-control" />--}}
                                    <select class="form-control" name="property">
                                        <option value=""> نوع الملكية  </option>

                                        <option value="0"> ايجار</option>
                                        <option value="1"> تمليك</option>

                                    </select>
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-3">
                                <div class="form-group home-search-input">
                                    {{--<label class="control-label">City</label>--}}
                                    <input type="text" class="form-control" placeholder="  اقل قيمة للسعر " name="min" />
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-3">
                                <div class="form-group home-search-input">
                                    {{--<label class="control-label">State</label>--}}
                                    <input type="text" class="form-control" placeholder=" اقصى قيمة للسعر " name="max" />
                                </div>
                            </div>

                            <div class="col-md-3 col-lg-2">
                                <div class="form-group home-search-input">
                                    {{--<label class="control-label">Zip Code</label>--}}
                                    <input type="text" class="form-control" placeholder=" عدد الغرف " name="rooms" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-3 col-lg-12">
                                <div class="form-group">
                                    {{--<label class="control-label">High School College/Name</label>--}}
                                    <button  class="form-control btn btn-primary" >
                                        ابحث الان
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>

                <a class="banner_btn" href="/building/add"> اضف عقارك </a>
            </div>
        </div>
    </div>
    <div class="main">
       <div class="quickview amiri">
       <header>
                <h1>احدث العقارات المضافة</h1>

       </header>
        <ul class="cd-items cd-container">
            {{--<li class="cd-item">--}}
                {{--<img src="{{Request::root()}}/quickview/img/item-1.jpg" alt="Item Preview">--}}
                {{--<a href="#0" class="cd-trigger">Quick View</a>--}}
            {{--</li>--}}
            {{--  projects  --}}
           <div class="row" style="display: block">
            @foreach(latestBuildings() as $key => $building)
                   @if($key%4 ==0 && $key !=0 )
                       <div class="clearfix"></div>
                          </div>
                        <div class="row" style="display: block" >
                   @endif
            <li class="cd-item">
                @foreach($building->images as $image)
                <img src="{{Request::root()}}/{{$image->image_url}}" alt="Item Preview">
                    @break
                @endforeach
                <a href="#0" class="cd-trigger" id="{{$building->id}}"> عرض سريع</a>
            </li> <!-- cd-item -->
            @endforeach
           </div>

        </ul> <!-- cd-items -->

        <div class="cd-quick-view">
            <div class="cd-slider-wrapper">

                <ul class="cd-slider">
                    {{--  صور المشاريع--}}

                    {{--<li class="selected"><img src="{{Request::root()}}/quickview/img/item-1.jpg" alt="Product 1"></li>--}}
                    {{--<li><img src="{{Request::root()}}/quickview/img/item-2.jpg" alt="Product 2"></li>--}}
                    {{--<li><img src="{{Request::root()}}/quickview/img/item-3.jpg" alt="Product 3"></li>--}}

                </ul> <!-- cd-slider -->

                <ul class="cd-slider-navigation">
                    <li><a class="cd-next" href="#0">Prev</a></li>
                    <li><a class="cd-prev" href="#0">Next</a></li>
                </ul> <!-- cd-slider-navigation -->
            </div> <!-- cd-slider-wrapper -->

            <div class="cd-item-info">
                <h2 class="pull-right">Produt Title</h2><br>

                <p></p>


                <ul class="cd-item-action pull-right">
                    <li><button class="add-to-cart" href="">   اعرف اكتر  </button></li>
                    <li><a class="same" href="#0">   عقارات متشابهة      </a></li>
                </ul> <!-- cd-item-action -->

            </div> <!-- cd-item-info -->

            <a href="#0" class="cd-close">Close</a>
        </div>


       </div>
        <div class="content_white">
            <h2>Featured Services</h2>
            <p>Quisque cursus metus vitae pharetra auctor, sem massa mattis semat interdum magna.</p>
        </div>
        <div class="featured_content" id="feature">
            <div class="container">
                <div class="row text-center" >
                    <div class="col-mg-3 col-xs-3 feature_grid1"> <i class="fa fa-cog fa-3x"></i>
                        <h3 class="m_1"><a href="services.html">Legimus graecis</a></h3>
                        <p class="m_2">Lorem ipsum dolor sit amet, facilisis egestas sodales non luctus, sem quas potenti malesuada vel phasellus.</p>
                        <a href="services.html" class="feature_btn">More</a> </div>
                    <div class="col-mg-3 col-xs-3 feature_grid2"> <i class="fa fa-comments-o fa-3x"></i>
                        <h3 class="m_1"><a href="services.html">Mazim minimum</a></h3>
                        <p class="m_2">Lorem ipsum dolor sit amet, facilisis egestas sodales non luctus, sem quas potenti malesuada vel phasellus.</p>
                        <a href="services.html" class="feature_btn">More</a> </div>
                    <div class="col-md-3 col-xs-3 feature_grid2"> <i class="fa fa-globe fa-3x"></i>
                        <h3 class="m_1"><a href="services.html">Modus altera</a></h3>
                        <p class="m_2">Lorem ipsum dolor sit amet, facilisis egestas sodales non luctus, sem quas potenti malesuada vel phasellus.</p>
                        <a href="services.html" class="feature_btn">More</a> </div>
                    <div class="col-md-3 col-xs-3 feature_grid2"> <i class="fa fa-history fa-3x"></i>
                        <h3 class="m_1"><a href="services.html">Melius eligendi</a></h3>
                        <p class="m_2">Lorem ipsum dolor sit amet, facilisis egestas sodales non luctus, sem quas potenti malesuada vel phasellus.</p>
                        <a href="services.html" class="feature_btn">More</a> </div>
                </div>
            </div>
        </div>
        <div class="about-info">
            <div class="container">
                <div class="row">
                    <div class="col-md-8">
                        <div class="block-heading-two">
                            <h2><span>About Our Company</span></h2>
                        </div>
                        <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat. Duis autem vel eum iriure dolor in hendrerit in vulputate velit esse molestie consequat, vel illum dolore eu feugiat nulla facilisis at vero.</p>
                        <br>
                        <p>Sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit lobortis nisl ut aliquip ex ea commodo consequat.</p>
                        <a class="banner_btn" href="about.html">Read More</a> </div>
                    <div class="col-md-4">
                        <div class="block-heading-two">
                            <h3><span>Our Advantages</span></h3>
                        </div>
                        <div class="panel-group" id="accordion-alt3">
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseOne-alt3"> <i class="fa fa-angle-right"></i> Quisque cursus metus vitae pharetra auctor</a> </h4>
                                </div>
                                <div id="collapseOne-alt3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseTwo-alt3"> <i class="fa fa-angle-right"></i> Duis autem vel eum iriure dolor in hendrerit</a> </h4>
                                </div>
                                <div id="collapseTwo-alt3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseThree-alt3"> <i class="fa fa-angle-right"></i> Quisque cursus metus vitae pharetra auctor </a> </h4>
                                </div>
                                <div id="collapseThree-alt3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
                                    </div>
                                </div>
                            </div>
                            <div class="panel">
                                <div class="panel-heading">
                                    <h4 class="panel-title"> <a data-toggle="collapse" data-parent="#accordion-alt3" href="#collapseFour-alt3"> <i class="fa fa-angle-right"></i> Duis autem vel eum iriure dolor in hendrerit</a> </a> </h4>
                                </div>
                                <div id="collapseFour-alt3" class="panel-collapse collapse">
                                    <div class="panel-body">
                                        <p>Consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam, quis nostrud exerci tation ullamcorper suscipit.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="highlight-info">
            <div class="overlay spacer">
                <div class="container">
                    <div class="row text-center">
                        <div class="col-sm-3 col-xs-6"> <i class="fa fa-smile-o fa-5x"></i>
                            <h4>120+ Happy Clients</h4>
                        </div>
                        <div class="col-sm-3 col-xs-6"> <i class="fa fa-check-square-o fa-5x"></i>
                            <h4>600+ Projects Completed</h4>
                        </div>
                        <div class="col-sm-3 col-xs-6"> <i class="fa fa-trophy fa-5x"></i>
                            <h4>25 Awards Won</h4>
                        </div>
                        <div class="col-sm-3 col-xs-6"> <i class="fa fa-map-marker fa-5x"></i>
                            <h4>3 Offices</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="testimonial-area">
            <div class="testimonial-solid">
                <div class="container">
                    <h2>Client Testimonials</h2>
                    <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carousel-example-generic" data-slide-to="0" class="active"> <a href="#"></a> </li>
                            <li data-target="#carousel-example-generic" data-slide-to="1" class=""> <a href="#"></a> </li>
                            <li data-target="#carousel-example-generic" data-slide-to="2" class=""> <a href="#"></a> </li>
                            <li data-target="#carousel-example-generic" data-slide-to="3" class=""> <a href="#"></a> </li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="item active">
                                <p>"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam quis nostrud exerci tation."</p>
                                <p><strong>- John Doe -</strong></p>
                            </div>
                            <div class="item">
                                <p>"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam quis nostrud exerci tation."</p>
                                <p><strong>- Jane Doe -</strong></p>
                            </div>
                            <div class="item">
                                <p>"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam quis nostrud exerci tation."</p>
                                <p><strong>- John Smith -</strong></p>
                            </div>
                            <div class="item">
                                <p>"Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. Ut wisi enim ad minim veniam quis nostrud exerci tation."</p>
                                <p><strong>- Linda Smith -</strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('footer')
    {!! Html::style("website/css/select2.min.css") !!}
    {!! Html::script("website/js/select2.min.js") !!}

    {!! Html::script("quickview/js/velocity.min.js") !!}
    {!! Html::script("quickview/js/main.js") !!}

    <script>



        $('.select2').select2({
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



        $('.cd-trigger').on('click', function(event) {
            var liclass = '';
            var slider = '';
            id = this.id;
            url = 'admin-panel/buildings/'+id+'/images';

            $.ajax({
               url   : url,
               type : 'GET',
               dataType : 'JSON',
                success: function (data)
                {
                    images = data.images;
                    building =data.building;
                   for(var i =0;i<images.length;++i)
                   {

                       liclass = (i == 0) ? 'selected' : '';
                       slider += "<li class='"+liclass+"'><img src='{{Request::root()}}"+'/'+images[i].image_url +"' alt='Product "+[i+1]+ "'></li>";
                   }

                    $('.cd-slider').html(slider);
                   // console.log();
                    $('.cd-item-info h2').text(building.name);
                    $('.cd-item-info p').text(building.description);
                    $('.same').attr('href','/buildings/advanced/search?type_id='+building.type_id+'&square='+building.square);
                    $('.add-to-cart').attr('href','/buildings/'+building.id);
                },
                error : function ($data) {

                }
            });
        });


        $(document).on('click','.add-to-cart',function () {
           url = $(this).attr('href');
           $(location).attr('href',url);
        });

    </script>

@endsection
